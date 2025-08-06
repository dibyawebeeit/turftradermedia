<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>{{ $title ?? 'Home' }} - {{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="keywords" content="{{ $keywords ?? '' }}">
        <meta name="author" content="{{ $author ?? 'Turf Trader Media' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Vite CSS --}}
        {{-- {{ module_vite('build-frontend', 'resources/assets/sass/app.scss') }} --}}
        <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="stylesheet" href="{{ asset('frontendassets/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontendassets/css/style.css') }}">
      
        <link rel="stylesheet" href="{{ asset('frontendassets/css/style-main.css') }}">
        <link rel="icon" href="{{asset('uploads/siteImage/'.sitesetting()->favicon)}}" sizes="32x32" />
        <link rel="icon" href="{{asset('uploads/siteImage/'.sitesetting()->favicon)}}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{asset('uploads/siteImage/'.sitesetting()->favicon)}}" />
        <meta name="msapplication-TileImage" content="{{asset('uploads/siteImage/'.sitesetting()->favicon)}}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
       <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
        <script src="{{ asset('frontendassets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
            <link rel="stylesheet" href="{{ asset('frontendassets/css/custom.css') }}">

    </head>

    <body>

        <x-frontend::layouts.header />

        {{ $slot }}

        {{-- Vite JS --}}
        {{-- {{ module_vite('build-frontend', 'resources/assets/js/app.js') }} --}}

        <x-frontend::layouts.footer />


        <link rel="stylesheet" href="{{ asset('frontendassets/css/jquery.fancybox.min.css') }}" />
        <script src="{{ asset('frontendassets/js/jquery.fancybox.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('frontendassets/css/slick.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontendassets/css/slick-theme.css') }}" />
        <script src="{{ asset('frontendassets/js/slick.js') }}"></script>
        <script src="{{ asset('frontendassets/js/main-script.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script> 
            $(document).ready(function() {
                var table = $('#example').DataTable({ 
                        select: false,
                        "columnDefs": [{
                            className: "Name", 
                            "targets":[0],
                            "visible": false,
                            "searchable":false
                        }]
                    });//End of create main table

                
                // $('#example tbody').on( 'click', 'tr', function () {
                
                //     alert(table.row( this ).data()[0]);

                // } );
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const editors = document.querySelectorAll('.ckeditor');

                editors.forEach(editor => {
                    ClassicEditor
                        .create(editor)
                        .catch(error => {
                            console.error('CKEditor Error:', error);
                        });
                });
            });
        </script>

        <script>
            let imageDataTransfer = new DataTransfer();

            const input = document.getElementById('imageInput');
            const dropzone = document.getElementById('dropzone-wrapper');
            const previewZone = document.getElementById('preview-zone');

            if(input && dropzone && previewZone)
            {
                // Handle file selection
                input.addEventListener('change', function (e) {
                    handleFiles(this.files);
                });

                // Handle drag events
                dropzone.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    dropzone.classList.add('dragover');
                });

                dropzone.addEventListener('dragleave', function (e) {
                    e.preventDefault();
                    dropzone.classList.remove('dragover');
                });

                dropzone.addEventListener('drop', function (e) {
                    e.preventDefault();
                    dropzone.classList.remove('dragover');

                    let droppedFiles = e.dataTransfer.files;
                    handleFiles(droppedFiles);
                });
            }
            

            // Handle new files
            function handleFiles(files) {
                Array.from(files).forEach((file, index) => {
                    const previewBox = document.createElement('div');
                    previewBox.classList.add('preview-box');
                    const fileType = file.type;

                    const reader = new FileReader();

                    reader.onload = function (e) {
                        let previewContent = '';

                        if (fileType.startsWith('image/')) {
                            previewContent = `<img src="${e.target.result}" alt="Image" style="width:150px;">`;
                        } else if (fileType === 'application/pdf') {
                            previewContent = `
                                <div style="text-align: center;">
                                    <i class="fa fa-file-pdf" style="font-size: 48px; color: red;"></i>
                                    <p style="margin-top: 5px;">${file.name}</p>
                                </div>`;
                        } else {
                            return; // Skip unsupported file types
                        }

                        previewBox.innerHTML = `
                            ${previewContent}
                            <button type="button" class="remove-image">&times;</button>
                        `;

                        previewBox.querySelector('.remove-image').addEventListener('click', function () {
                            const allPreviews = Array.from(previewZone.children);
                            const removeIndex = allPreviews.indexOf(previewBox);
                            imageDataTransfer.items.remove(removeIndex);
                            previewBox.remove();
                            syncInput();
                        });

                        previewZone.appendChild(previewBox);
                    };

                    reader.readAsDataURL(file);
                    imageDataTransfer.items.add(file);
                });

                syncInput();
            }

            function syncInput() {
                input.files = imageDataTransfer.files;
            }
        </script>

        {{-- <script src="{{ asset('frontendassets/js/google-translate.js') }}"></script> --}}

        

        @yield('script')


    </body>
</html>