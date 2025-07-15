<x-frontend::layouts.master :title="'Business Document'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                    <div class="section-content dashboard-right">
                        <div class="dashboard-header">
                            <h2>Business Documents</h2>
                        </div>
                        <form action="{{ route('customer.upload_document') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-groupFile doc_section">
                        <label>Upload Images</label>
                        <div class="dropzone-wrapper" id="dropzone-wrapper">
                            <div class="dropzone-desc">
                                <i class="fa fa-upload" style="font-size: 24px;"></i>
                                <p>Drag & Drop or Click to Upload</p>
                            </div>
                            <input type="file" 
                            id="imageInput" 
                            name="documents[]" 
                            multiple 
                            accept=".jpg,.jpeg,.pdf"
                            style="opacity:0; position:absolute; top:0; left:0; right:0; bottom:0; width:100%; height:100%; cursor:pointer;">
                        </div>

                        <div id="preview-zone" class="mt-3 d-flex flex-wrap"></div>
                        @if ($errors->has('documents'))
                            <div class="errmsg">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first('documents') }}
                            </div>
                        @endif

                        @foreach ($errors->get('documents.*') as $messages)
                            @foreach ($messages as $message)
                                <div class="errmsg">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </div>
                            @endforeach
                        @endforeach
                      </div>
                            <div class="modal-btn text-end">
                                <button type="submit" class="btn">Save Changes</button>
                            </div>
                        </form>
                        {{-- <p>Uploaded Documents</p> --}}
                      @if (!empty($documentsList->documents))
                        <div class="row col-middle-gap">
                            <div class="col-cmn col-lg-12 col-md-12 col-sm-12">
                                <div class="mt-3 d-flex flex-wrap">
                                    @foreach ($documentsList->documents as $item)
                                        @if ($item->type === 'pdf')
                                            <div class="preview-box" id="doc_{{ $item->id }}">
                                                <div style="text-align: center;">
                                                    <a href="{{ asset('uploads/customerDoc/'.$item->file) }}" download><i class="fa fa-file-pdf" style="font-size: 48px; color: red;"></i></a>
                                                    <p style="margin-top: 5px;">Document PDF File</p>
                                                </div>
                                                <button type="button" class="remove-image" onclick="deleteDoc({{ $item->id }})">×</button>
                                            </div>
                                        @else
                                            <div class="preview-box" id="doc_{{ $item->id }}">
                                                <a href="{{ asset('uploads/customerDoc/'.$item->file) }}" download><img src="{{ asset('uploads/customerDoc/'.$item->file) }}" alt="Image" style="width:150px;"></a>
                                                <button type="button" class="remove-image" onclick="deleteDoc({{ $item->id }})">×</button>
                                            </div>
                                        @endif
                                    @endforeach
                                    
                                    
                                </div>
                            </div>
                        </div>
                      @endif
                    </div>
               </div>
            </div>
         </div>
      </section>

@section('script')
<script>
    function deleteDoc(id)
    {
        Swal.fire({
        title: "Do you want to delete the document?",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Don't save`
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("{{ route('customer.delete_document') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success == true) {
                    document.getElementById("doc_"+id).remove();
                    // alert(data.message);
                    // Optionally refresh or remove item from DOM
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        } else if (result.isDenied) {
            //
        }
        });
        
    }
</script>
@endsection
</x-frontend::layouts.master>
