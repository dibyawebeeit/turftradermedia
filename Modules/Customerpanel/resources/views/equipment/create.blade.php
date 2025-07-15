<x-frontend::layouts.master :title="'Add Equipment'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                    <div class="section-content dashboard-right">
                        <div class="dashboard-header">
                            <h2>Add Equipment</h2>
                        </div>
                        <form action="{{ route('customer.equipment.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- <div class="setting-title">
                                <h5>Information</h5>
                            </div> --}}
                            <div class="setting-card custom-table">
                                <div class="row clearfix">
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Serial Number / VIN </label>
                                            <input type="text" name="vin" class="form-control-4" placeholder="Serial Number / VIN" value="{{ old('vin') }}">
                                            @error('vin')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Manufacturer <span class="text-danger">*</span></label>
                                            <select name="manufacturer_id" class="form-control-4" required="">
                                                <option value="">--Select--</option>
                                            </select>
                                            @error('manufacturer_id')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Model <span class="text-danger">*</span></label>
                                            <select name="equipment_model_id" class="form-control-4" required="">
                                                <option value="">--Select--</option>
                                            </select>
                                            @error('equipment_model_id')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Category <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control-4" required="">
                                                <option value="">--Select--</option>
                                            </select>
                                            @error('category_id')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Year </label>
                                            <select name="year" class="form-control-4">
                                            <option value="">--Select--</option>
                                            @for ($i = date('Y', strtotime('+1 year')); $i >=1980 ; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                            </select>
                                            @error('year')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Hours </label>
                                            <input type="number" name="hours" min="0" class="form-control-4" value="0">
                                            @error('hours')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Condition </label>
                                            <select name="condition" class="form-control-4">
                                            <option value="">--Select--</option>
                                                <option value="New">New</option>
                                                <option value="Salvaged">Salvaged</option>
                                                <option value="Used" selected>Used</option>
                                            </select>
                                            @error('year')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Price <span class="text-danger">*</span></label>
                                            <input type="number" step="any" name="price" class="form-control-4" placeholder="Enter Price" required>
                                            @error('price')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-wrap">
                                            <select name="currency_id" class="form-control-4" required>
                                                @foreach ($currencyList as $currency)
                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Machine Location <span class="text-danger">*</span></label>
                                            <input type="text" name="machine_location" class="form-control-4" placeholder="Machine Location" required>
                                            @error('machine_location')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control-4" placeholder="Description" required></textarea>
                                            @error('description')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Details <span class="text-danger">*</span></label>
                                            <textarea name="details" class="form-control-4" placeholder="Details" required></textarea>
                                            @error('details')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Thumbnail <span class="text-danger">*</span></label>
                                            <br>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control-4" required>
                                            @error('thumbnail')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Preview</label>
                                            <br>
                                            <img id="thumbnailPreview" src="{{ noImage() }}" alt="Thumbnail" style="height: 100px;width:100px;">
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
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
                                    
                                </div>
                            </div>
                            <div class="modal-btn text-end">
                                <button type="submit" class="btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
               </div>
            </div>
         </div>
      </section>

@section('script')
<script>
document.getElementById('thumbnail').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('thumbnailPreview');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    } else {
        // Reset preview if not an image
        preview.src = "{{ noImage() }}";
    }
});
</script>

@endsection
</x-frontend::layouts.master>
