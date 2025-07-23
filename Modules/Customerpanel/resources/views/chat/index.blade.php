<x-frontend::layouts.master :title="'Equipment List'">
    <hr>
    <style>
    .my-message {
        background-color: #e0f7fa;
        color: #000;
        padding: 8px 12px;
        border-radius: 16px;
        max-width: 70%;
        margin: 4px 0;
        text-align: right;
    }

    .other-message {
        background-color: #f0f0f0;
        color: #000;
        padding: 8px 12px;
        border-radius: 16px;
        max-width: 70%;
        margin: 4px 0;
        text-align: left;
    }
</style>

    <section class="productlist-row-list p-t-60 p-b-60">
        <div class="datatable-form">
            <div class="container">
                <div class="row col-middle-gap">
                
                    <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                    <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                    <div class="section-content dashboard-right change-pass">
                        <div class="dashboard-header">
                            <h2>Chat</h2>
                        </div>
                        
                        <div style="display: flex; gap: 20px;">
                            <!-- Sidebar: Search + Threads -->
                            <div style="width: 250px;">
                                <div style="margin-bottom: 12px;">
                                    <input
                                        type="text"
                                        id="userSearch"
                                        placeholder="🔍 Search user..."
                                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;"
                                    />
                                </div>

                                <div id="searchResults" style="margin-bottom: 16px;"></div>

                                <ul id="threadList"
                                    style="list-style: none; padding: 0; margin: 0; border: 1px solid #ccc; border-radius: 8px; max-height: 400px; overflow-y: auto;">
                                </ul>
                            </div>

                                <!-- Chat window -->
                                <div style="flex: 1; display: flex; flex-direction: column; height: 450px; border: 1px solid #ccc; border-radius: 8px; overflow: hidden;">
                                    <!-- Messages display -->
                                    <div id="messages"
                                        style="flex: 1; padding: 10px; overflow-y: auto; background: #fefefe;">
                                        <!-- Messages will be injected here -->
                                    </div>

                                    <!-- Message send box -->
                                    <form id="messageForm"
                                        style="display: flex; gap: 8px; border-top: 1px solid #ddd; padding: 10px; background-color: #f9f9f9;">
                                        <input type="hidden" id="receiver_id">
                                        <input
                                            type="text"
                                            id="messageInput"
                                            placeholder="Type your message..."
                                            style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 6px;"
                                        />
                                        <button type="submit"
                                                style="background-color: #28a745; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                                            Send
                                        </button>
                                    </form>
                                </div>
                            </div>



                    </div>
                </div>
                </div>
            </div>
        </div>
      </section>

@section('script')

<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.iife.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    
    
    
    window.Pusher = Pusher;
    window.Pusher.logToConsole = true; // 👈 shows everything

    const echo = new Echo({
        broadcaster: 'pusher',
        key: "{{ env('PUSHER_APP_KEY') }}",
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
        forceTLS: true,
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    });

    const userId = {{ auth('customer')->user()->id }};
    //console.log("Connecting to: chat." + userId);

    const chatChannel = echo.private(`chat.${userId}`);

    // debug logs
    // chatChannel
    // .listen('.NewMessageSent', (e) => {
    //     console.log("✅ Received:", e);
    // })
    // .subscribed(() => {
    //     console.log("✅ Subscribed to chat." + userId);
    // })
    // .error(err => {
    //     console.error("❌ Subscription error:", err);
    // });

    // ✅ Test Pusher connection status
    echo.connector.pusher.connection.bind('connected', () => {
        console.log('✅ Connected to Pusher!');
    });

    echo.connector.pusher.connection.bind('error', err => {
        console.error('❌ Pusher error:', err);
    });


     // 👇 Listen for chat events
    echo.private(`chat.${userId}`)
    .listen('.NewMessageSent', (e) => {
        console.log("🔔 New Message Received:", e);
        const currentReceiverId = parseInt(document.getElementById('receiver_id').value);

        // If current open chat matches sender
        if (e.sender_id === currentReceiverId) {
            const msgBox = document.getElementById('messages');
            msgBox.innerHTML += `
                <div style="display:flex; justify-content: flex-start;">
                    <div class="other-message">
                         ${e.message}
                    </div>
                </div>
            `;
            msgBox.scrollTop = msgBox.scrollHeight; // Auto scroll
        } else {
            // Optional: highlight thread in threadList
            loadThreads(); // Reload to update new messages if needed
        }
    });

    document.getElementById('userSearch').addEventListener('input', function () {
        const q = this.value;
        if (q.length < 2) return;
        fetch(`/customer/chat/search?q=${q}`)
            .then(res => res.json())
            .then(users => {
                let html = '';
                users.forEach(u => {
                    html += `<div onclick="initiateChat(${u.id})">${u.first_name} ${u.last_name} (${u.role})</div>`;
                });
                document.getElementById('searchResults').innerHTML = html;
            });
    });

    window.initiateChat = function (receiverId) {
        fetch(`/customer/chat/initiate/${receiverId}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(res => res.json()).then(() => {
            loadThreads();
        });
    };

    window.loadThreads = function () {
        fetch('/customer/chat/threads')
            .then(res => res.json())
            .then(threads => {
                let html = '';
                threads.forEach(t => {
                    const other = t.sender_id == userId ? t.receiver : t.sender;
                    html += `
                        <li 
                            onclick="loadMessages(${other.id}, this)" 
                            style="padding: 10px 12px; cursor: pointer; border-bottom: 1px solid #eee;"
                            class="chat-thread-item"
                        >
                            ${other.first_name} ${other.last_name}
                        </li>
                    `;
                });
                document.getElementById('threadList').innerHTML = html;
            });
    };

    window.loadMessages = function (otherId, el = null) {
         // Remove active class from all thread items
            document.querySelectorAll('.chat-thread-item').forEach(item => {
                item.style.backgroundColor = '';
                item.style.fontWeight = '';
            });

            // Add active style to clicked item
            if (el) {
                el.style.backgroundColor = '#d1ecf1';
                el.style.fontWeight = 'bold';
            }

        document.getElementById('receiver_id').value = otherId;
        fetch(`/customer/chat/messages/${otherId}`)
            .then(res => res.json())
            .then(data => {
                let html = '';
                data.forEach(msg => {
                    const isMe = msg.sender_id == userId;
                    html += `
                        <div style="display: flex; justify-content: ${isMe ? 'flex-end' : 'flex-start'};">
                            <div class="${isMe ? 'my-message' : 'other-message'}">
                                 ${msg.message}
                            </div>
                        </div>
                    `;
                });
                document.getElementById('messages').innerHTML = html;

                // 👇 Add this line
                const msgBox = document.getElementById('messages');
                msgBox.scrollTop = msgBox.scrollHeight;
            });
    };

    document.getElementById('messageForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const msg = document.getElementById('messageInput').value;
        const receiverId = document.getElementById('receiver_id').value;
        fetch('/customer/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: msg, receiver_id: receiverId })
        }).then(res => res.json()).then(data => {
            document.getElementById('messages').innerHTML += `
                <div style="display:flex; justify-content: flex-end;">
                    <div class="my-message">
                     ${data.message}
                    </div>
                </div>
            `;
            document.getElementById('messageInput').value = '';

            // 👇 Add this line
            const msgBox = document.getElementById('messages');
            msgBox.scrollTop = msgBox.scrollHeight;
        });
    });

    loadThreads(); // Load chat list on page load

});
</script>
@endsection
</x-frontend::layouts.master>