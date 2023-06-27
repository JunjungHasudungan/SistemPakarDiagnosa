<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- link Toast --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
        {{-- confirm  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>

  // sweet alert success
  window.addEventListener('toastr:info', event => {
                toastr.info(event.detail.message);
            });

            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
                }
                });

            window.addEventListener('swal:modal', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type
                });
            });

            window.addEventListener('swal:error', event => {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Anda belum memiliki mata pelajaran..',
                    }).then( empty =>{
                        if(empty){
                            window.livewire.emit('showEmpySubject');
                        }
                    })
            });

            // sweet alert delete data classroom
            window.addEventListener('swal:confirm', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: false,
                })
                .then( will_delete => {
                    if(will_delete){
                        window.livewire.emit('deleteClassroom', event.detail.id);
                    }else{
                        swal("Data masih ada..");
                    }
                })
            });


            // eventListener confirm delete mata pelajaran
            window.addEventListener('swal:confirm', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: false,
                })
                .then( will_delete => {
                    if(will_delete){
                        window.livewire.emit('deleteSubject', event.detail.id);
                    }else{
                        swal("Data Mata Pelajaran masih ada..");
                    }
                })
            });

            // event listener info delete subject
            window.addEventListener('solusiDeleted', event => {
                swal(
                    'Deleted!',
                    'Data Solusi deleted successfully',
                    'success'
                )
            });



            // event Listener confirmation delete data solusi base on id
            window.addEventListener('swal:confirm', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: false,
                })
                .then( will_delete => {
                    if(will_delete){
                        window.livewire.emit('deleteSolusi', event.detail.id);
                    }else{
                        swal("Data masih ada..");
                    }
                })
            });

            // event listener info delete data solusi
            window.addEventListener('solusiDeleted', event => {
                swal(
                    'Deleted!',
                    'Data Berhasil Dihapus..',
                    'success'
                )
            });

             // event Listener confirmation delete data gejala base on id
             window.addEventListener('swal:confirm', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: false,
                })
                .then( will_delete => {
                    if(will_delete){
                        window.livewire.emit('deleteGejala', event.detail.id);
                    }else{
                        swal("Data masih ada..");
                    }
                })
            });

            // event listener info delete data gejala
                        window.addEventListener('gejalaDeleted', event => {
                swal(
                    'Deleted!',
                    'Data Berhasil Dihapus..',
                    'success'
                )
            });

        </script>
    </body>
</html>
