<?php

namespace Modules\Customerpanel\Http\Controllers;

use App\Events\NewMessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Models\Customer;
use Modules\Customerpanel\Models\Chat;
use Modules\Customerpanel\Models\ChatThread;

class ChatController extends Controller
{
    public $activemenu;
    public $activeCustomerId;

    public function __construct()
    {
        // Ensure middleware has already run
        $this->middleware(function ($request, $next) {
            if (Auth::guard('customer')->check()) {
                $this->activeCustomerId = Auth::guard('customer')->id();
            }

            return $next($request);
        });
    }
    
    public function index()
    {
        $this->activemenu = "chat";
        $data['activemenu'] = $this->activemenu;

        return view('customerpanel::chat.index', $data);
    }

    public function searchUsers(Request $request)
    {
        if(Auth::guard('customer')->user()->role =='seller')
        {
            $role ='buyer';
        }
        else
        {
            $role ='seller';
        }
        $q = $request->input('q');
        $users = Customer::where('id', '!=', $this->activeCustomerId)
                    ->where('first_name', 'like', "%$q%")
                    ->where('role',$role)
                    ->get();
        return response()->json($users);
    }

    public function initiateChat($receiver_id)
    {
        $thread = ChatThread::firstOrCreate([
            'sender_id' => $this->activeCustomerId,
            'receiver_id' => $receiver_id
        ]);

        return response()->json(['success' => true, 'thread_id' => $thread->id]);
    }

    public function getThreads()
    {

        $threads = ChatThread::where('sender_id', $this->activeCustomerId)
            ->orWhere('receiver_id', $this->activeCustomerId)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        return response()->json($threads);
    }

    public function fetchMessages($id)
    {
        $messages = Chat::where(function($q) use ($id) {
            $q->where('sender_id', $this->activeCustomerId)
              ->where('receiver_id', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('sender_id', $id)
              ->where('receiver_id', $this->activeCustomerId);
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $chat = Chat::create([
            'sender_id' => $this->activeCustomerId,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        $chat->load('sender');

        

        broadcast(new NewMessageSent($chat))->toOthers();

        return response()->json($chat);
    }

    
}
