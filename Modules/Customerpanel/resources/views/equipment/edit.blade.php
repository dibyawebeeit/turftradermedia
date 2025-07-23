<x-frontend::layouts.master :title="'Edit Equipment'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                    <div class="section-content dashboard-right">
                        <div class="dashboard-header">
                            <h2>Edit Equipment</h2>
                        </div>
                        <form action="{{ route('customer.equipment.update',$equipment->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            {{-- <div class="setting-title">
                                <h5>Information</h5>
                            </div> --}}
                            <div class="setting-card custom-table">
                                <div class="row clearfix">
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Serial Number / VIN </label>
                                            <input type="text" name="vin" class="form-control-4" placeholder="Serial Number / VIN" value="{{ old('vin',$equipment->vin) }}">
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
                                            <select name="manufacturer_id" id="manufacturer" class="form-control-4" required="">
                                                <option value="">--Select--</option>
                                                @foreach ($manufacturerList as $manufacturer)
                                                    <option value="{{ $manufacturer->id }}" {{ $equipment->manufacturer_id==$manufacturer->id?'selected':'' }}>{{ $manufacturer->name }}</option>
                                                @endforeach
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
                                            <select name="equipment_model_id" id="equipment_model" class="form-control-4" required="">
                                                <option value="">--Select--</option>
                                                @foreach ($modelList as $item)
                                                    <option value="{{ $item->id }}" {{ $equipment->equipment_model_id==$item->id?'selected':'' }}>{{ $item->name }}</option>
                                                @endforeach
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
                                                @foreach ($categoryList as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ old('category_id', $equipment->category_id) == $key ? 'selected' : '' }}
                                                        {{ in_array($key, $parentIds) ? 'disabled' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
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
                                            <label class="col-form-label">Year <span class="text-danger">*</span></label>
                                            <select name="year" class="form-control-4" required>
                                            <option value="">--Select--</option>
                                            @for ($i = date('Y', strtotime('+1 year')); $i >=1980 ; $i--)
                                                <option value="{{ $i }}" {{ old('year',$equipment->year)==$i?'selected':'' }}>{{ $i }}</option>
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
                                            <input type="number" name="hours" min="0" class="form-control-4" value="{{ old('hours',$equipment->hours) }}">
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
                                                <option value="New" {{ $equipment->condition=='New'?'selected':'' }}>New</option>
                                                <option value="Salvaged" {{ $equipment->condition=='Salvaged'?'selected':'' }}>Salvaged</option>
                                                <option value="Used" {{ $equipment->condition=='Used'?'selected':'' }}>Used</option>
                                            </select>
                                            @error('condition')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Price <span class="text-danger">*</span></label>
                                    
                                            
                                        </div>
                                        
                                        
                                        <div class="form-wrap form-wrap-price">
                                                <input type="number" step="any" name="price" class="form-control-4" placeholder="Enter Price" value="{{ old('price',$equipment->price) }}" required>
                                            @error('price')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                            <select name="currency_id" class="form-control-4" required>
                                                @foreach ($currencyList as $currency)
                                                    <option value="{{ $currency->id }}" {{ $equipment->currency_id==$currency->id?'selected':'' }}>{{ $currency->name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                          
                                              
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Stock Number </label>
                                            <input type="text" name="stock_no" class="form-control-4" value="{{ old('stock_no',$equipment->stock_no) }}" placeholder="Stock Number">
                                            @error('stock_no')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Machine Location <span class="text-danger">*</span></label>
                                            <input type="text" name="machine_location" class="form-control-4" placeholder="Machine Location" value="{{ old('machine_location',$equipment->machine_location) }}" required>
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
                                            <textarea name="description" class="ckeditor form-control-4" placeholder="Description" >{{ old('description',$equipment->description) }}</textarea>
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
                                            <textarea name="details" class="ckeditor form-control-4" placeholder="Details" >{{ old('details',$equipment->details) }}</textarea>
                                            @error('details')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
                                        <h4>Seller Information</h4>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" name="company_name" class="form-control-4" placeholder="Company Name" value="{{ old('company_name',$equipment->company_name) }}" required>
                                            @error('company_name')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Contact Name <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_name" class="form-control-4" placeholder="Contact Name" value="{{ old('contact_name',$equipment->contact_name) }}" required>
                                            @error('contact_name')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Contact Email <span class="text-danger">*</span></label>
                                            <input type="email" name="contact_email" class="form-control-4" placeholder="Contact Email" value="{{ old('contact_email',$equipment->contact_email) }}" required>
                                            @error('contact_email')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Contact No <span class="text-danger">*</span></label>
                                            <input type="tel" name="contact_no" class="form-control-4" placeholder="Contact No" value="{{ old('contact_no',$equipment->contact_no) }}" required>
                                            @error('contact_no')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
                                        <h4>Gallery Information</h4>
                                        <span>*Accepted formats: JPEG, JPG, PNG, WEBP. Maximum file size: 1 MB.</span>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Thumbnail </label>
                                            <br>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control-4">
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
                                            <img id="thumbnailPreview" src="{{ asset('uploads/equipmentImage/'.$equipment->thumbnail) }}" alt="Thumbnail" style="height: 100px;width:100px;">
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
                                            name="images[]" 
                                            multiple 
                                            accept=".jpg,.jpeg,.webp,.png"
                                            style="opacity:0; position:absolute; top:0; left:0; right:0; bottom:0; width:100%; height:100%; cursor:pointer;">
                                        </div>

                                        <div id="preview-zone" class="mt-3 d-flex flex-wrap"></div>
                                        @if ($errors->has('images'))
                                            <div class="errmsg">
                                                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first('images') }}
                                            </div>
                                        @endif

                                        @foreach ($errors->get('images.*') as $messages)
                                            @foreach ($messages as $message)
                                                <div class="errmsg">
                                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    @if (!empty($equipment->images))
                                        <div class="row col-middle-gap">
                                            <div class="col-cmn col-lg-12 col-md-12 col-sm-12">
                                                <div class="mt-3 d-flex flex-wrap">
                                                    @foreach ($equipment->images as $item)
                                                        <div class="preview-box" id="doc_{{ $item->id }}">
                                                            <a href="{{ asset('uploads/equipmentImage/'.$item->file) }}" download>
                                                                <img src="{{ asset('uploads/equipmentImage/'.$item->file) }}" alt="Image" style="width:150px;height:100px;"></a>
                                                            <button type="button" class="remove-image" onclick="deleteDoc({{ $item->id }})">×</button>
                                                        </div>
                                                    @endforeach
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-cmn col-lg-12">
                                        <h4>SEO Information</h4>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Meta Title <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_title" class="form-control-4" placeholder="Meta Title" value="{{ old('meta_title',$equipment->meta_title) }}" required>
                                            @error('meta_title')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-6">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Meta Keyword </label>
                                            <input type="text" name="meta_keyword" class="form-control-4" placeholder="Meta Keyword" value="{{ old('meta_keyword',$equipment->keyword) }}">
                                            @error('meta_keyword')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-12">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Meta Description </label>
                                            <textarea name="meta_desc" class="form-control-4" placeholder="Meta Keyword">{{ old('meta_desc',$equipment->meta_desc) }}</textarea>
                                            @error('meta_desc')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-cmn col-lg-4">
                                        <div class="mb-3">
                                            <label for="switch1" class="form-label">Publish Status <sup>*</sup></label><br>
                                            <label class="my-toggle">
                                                <input type="checkbox" id="switch1" name="publish_status" {{ $equipment->publish_status == 1 ? 'checked' : '' }}>
                                                <span class="my-slider"></span>
                                            </label>
                                        </div>
                                    </div> --}}
                                    
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

let manufacturer = document.querySelector("#manufacturer");
let equipmentModelSelect = document.querySelector("#equipment_model");

manufacturer.addEventListener("change",function(e){
    let manufacturerId = e.target.value;
    if(manufacturerId != '')
    {
        fetch("{{ route('customer.getEquipmentModel') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                manufacturerId: manufacturerId,         // example data
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status==true)
            {
                let result = data.data;
                populateEquipmentModels(result);
                
                // console.log('Success:', data.data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    else
    {
        equipmentModelSelect.innerHTML = '<option value="">--Select--</option>';
    }
});
function populateEquipmentModels(data) {
    equipmentModelSelect.innerHTML = '<option value="">--Select--</option>';

    for (let id in data) {
        let option = document.createElement("option");
        option.value = id;
        option.textContent = data[id];
        equipmentModelSelect.appendChild(option);
    }
}

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
            fetch("{{ route('customer.delete_equipment_image') }}", {
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