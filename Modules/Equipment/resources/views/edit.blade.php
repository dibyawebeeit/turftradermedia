<x-dashboard::layouts.master :title="'Edit Equipment'">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li> --}}
                                <li class="breadcrumb-item active">Edit Equipment</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Equipment</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('equipment.update',$equipment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="vin" class="form-label">Serial Number / VIN <sup>*</sup></label>
                                            <input type="text" class="form-control" name="vin"
                                                placeholder="Serial Number / VIN" value="{{ old('vin',$equipment->vin) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Manufacturer <sup>*</sup></label>
                                            <select name="manufacturer_id" id="manufacturer" class="form-control" required="">
                                                <option value="">--Select--</option>
                                                @foreach ($manufacturerList as $manufacturer)
                                                    <option value="{{ $manufacturer->id }}" {{ $equipment->manufacturer_id==$manufacturer->id?'selected':'' }}>{{ $manufacturer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="model" class="form-label">Model <sup>*</sup></label>
                                            <select name="equipment_model_id" id="equipment_model" class="form-control" required="">
                                                <option value="">--Select--</option>
                                                @foreach ($modelList as $item)
                                                    <option value="{{ $item->id }}" {{ $equipment->equipment_model_id==$item->id?'selected':'' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category <sup>*</sup></label>
                                            <select name="category_id" class="form-control" required="">
                                                <option value="">--Select--</option>
                                                @foreach ($categoryList as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ old('category_id', $equipment->category_id) == $key ? 'selected' : '' }}
                                                        {{ in_array($key, $parentIds) ? 'disabled' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">Year <sup>*</sup></label>
                                            <select name="year" class="form-control" required>
                                            <option value="">--Select--</option>
                                            @for ($i = date('Y', strtotime('+1 year')); $i >=1980 ; $i--)
                                                <option value="{{ $i }}" {{ old('year',$equipment->year)==$i?'selected':'' }}>{{ $i }}</option>
                                            @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="hours" class="form-label">Hours <sup>*</sup></label>
                                            <input type="number" name="hours" min="0" class="form-control" value="{{ old('hours',$equipment->hours) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="condition" class="form-label">Condition <sup>*</sup></label>
                                            <select name="condition" class="form-control">
                                            <option value="">--Select--</option>
                                                <option value="New" {{ $equipment->condition=='New'?'selected':'' }}>New</option>
                                                <option value="Salvaged" {{ $equipment->condition=='Salvaged'?'selected':'' }}>Salvaged</option>
                                                <option value="Used" {{ $equipment->condition=='Used'?'selected':'' }}>Used</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price <sup>*</sup></label>
                                            <div class="d-flex gap-1">
                                            <input type="number" step="any" name="price" class="form-control" placeholder="Enter Price" value="{{ old('price',$equipment->price) }}" required>
                                            <select name="currency_id" class="form-control" required>
                                                @foreach ($currencyList as $currency)
                                                    <option value="{{ $currency->id }}" {{ $equipment->currency_id==$currency->id?'selected':'' }}>{{ $currency->name }}</option>
                                                @endforeach
                                                
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="stock_no" class="form-label">Stock Number</label>
                                            <input type="text" name="stock_no" class="form-control" value="{{ old('stock_no',$equipment->stock_no) }}" placeholder="Stock Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="machine" class="form-label">Machine Location</label>
                                            <input type="text" name="machine_location" class="form-control" placeholder="Machine Location" value="{{ old('machine_location',$equipment->machine_location) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label">Description</label>
                                            <textarea name="description" class="editor form-control" placeholder="Description" required>{{ old('description',$equipment->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="details" class="form-label">Details</label>
                                            <textarea name="details" class="editor form-control" placeholder="Details" required>{{ old('details',$equipment->details) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="company_name" class="form-label">Company Name</label>
                                            <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{ old('company_name',$equipment->company_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="contact_name" class="form-label">Contact Name</label>
                                            <input type="text" name="contact_name" class="form-control" placeholder="Contact Name" value="{{ old('contact_name',$equipment->contact_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="contact_email" class="form-label">Contact Email</label>
                                            <input type="email" name="contact_email" class="form-control" placeholder="Contact Email" value="{{ old('contact_email',$equipment->contact_email) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="contact_no" class="form-label">Contact No</label>
                                            <input type="tel" name="contact_no" class="form-control" placeholder="Contact No" value="{{ old('contact_no',$equipment->contact_no) }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Thumbnail </label>
                                            <input type="file" class="form-control" name="thumbnail" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            @if ($equipment->thumbnail =='')
                                                <img src="{{ noImage() }}" alt="" style="height: 100px;width:100px;">
                                            @else
                                                <img src="{{ asset('uploads/equipmentImage/'.$equipment->thumbnail) }}" alt="" style="height: 100px;width:100px;">
                                            @endif
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="siteurl" class="form-label">Publish Status <sup>*</sup></label>
                                            <br>
                                            <input type="checkbox" id="switch1" name="publish_status" {{ $equipment->publish_status==1?'checked':'' }} data-switch="bool"/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="siteurl" class="form-label">Admin Approval <sup>*</sup></label>
                                            <br>
                                            <input type="checkbox" id="switch2" name="admin_approval" {{ $equipment->admin_approval==1?'checked':'' }} data-switch="bool"/>
                                            <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Images </label>
                                            <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                                        </div>
                                    </div>
                                </div>
                                @if (count($equipment->images) > 0)
                                    <div class="col-md-12">
                                        <h4>Gallery</h4>
                                        <div class="mb-3">
                                                <div class="row justify-content-center">
                                                    @foreach ($equipment->images as $item)
                                                        <div class="col-md-2" id="doc_{{ $item->id }}">
                                                            
                                                            <img src="{{ asset('uploads/equipmentImage/'.$item->file) }}" alt="Image" style="height: 100px;width:100px;">
                                                            <button type="button" class="remove-image" onclick="deleteDoc({{ $item->id }})">×</button>
                                                            
                                                        </div>
                                                        
                                                    @endforeach
                                                </div>
                                        </div>
                                    </div>
                                    @endif
                                    <h4>SEO Section</h4>
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="meta_title" class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ old('meta_title',$equipment->meta_title) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                            <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keyword" value="{{ old('meta_keyword',$equipment->keyword) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="meta_desc" class="form-label">Meta Desc</label>
                                            <textarea name="meta_desc" class="form-control" placeholder="Meta Keyword">{{ old('meta_desc',$equipment->meta_desc) }}</textarea>
                                        </div>
                                    </div>
                                    </div>


                                <div class="text-end">
                                    <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i>
                                        Save</button>
                                </div>
                            </form>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div>
        <!-- container -->

    </div>

@section('script')
<script>


let manufacturer = document.querySelector("#manufacturer");
let equipmentModelSelect = document.querySelector("#equipment_model");

manufacturer.addEventListener("change",function(e){
    let manufacturerId = e.target.value;
    if(manufacturerId != '')
    {
        fetch("{{ route('equipment.getEquipmentModel') }}", {
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
        title: "Do you want to delete the image?",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Don't save`
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("{{ route('equipment.delete_equipment_image') }}", {
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
</x-dashboard::layouts.master>