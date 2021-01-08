<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    {{-- setiap file memiliki struktur seperti
        
        head : untuk memanggil library css pada folder public,
        body: tempat diamana semua tampilan web dibuat
        script: untuk kode javascript

        adapun yang tidak memilikinya dipanggil dengan cara @include(nama file yang berisi head)
    --}}

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="url" content="{{ Request::url() }}" />

        <title>SIPMR</title>

        <link rel="shortcut icon" href="https://www.surfnetkids.com/newsletters/wp-content/uploads/2018/06/s-icon-500x500.png" type="image/x-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/helper.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #ccc;
                padding: 5px 25px;
                border-radius: 3px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                text-transform: uppercase;
                background: rgba(0,0,0,0.5);
                transition: .3s;
            }

            .links > a:hover {
                letter-spacing: .1rem;
                color: #fff;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body style="background: url('https://i.pinimg.com/originals/d6/74/e7/d674e764a10d6b4f8cdd011f030c886f.gif') no-repeat; background-size: cover; overflow: hidden ">
        <div class="flex-center position-ref full-height">
            {{-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}

            <div class="content">
                <h1 style="margin: 0; font-weight: bold">
                    SELAMAT DATANG!
                </h1>
                <h5  style="margin-top: 0; font-weight: bold">Palang Merah Remaja Penerbangan Cakra Nusantara</h5>

                <div class="links">
                    <a href="javascript:void(0)" data="sejarah">Sejarah</a>
                    <a href="javascript:void(0)" data="visi">Visi & Misi</a>
                    <a href="javascript:void(0)" data="struktur">Struktur Organisasi</a>
                    <a href="javascript:void(0)" data="login">Login</a>
                </div>
            </div>
        </div>

        @include('modals.sejarah');
        @include('modals.visi-misi');
        @include('modals.struktur');
        @include('modals.login');

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="{{asset('public/assets/js/helper.js')}}"></script>


        <script>
            
            // link untuk menampilkan modal (popup)
            $('.links a').click(function(){
                let data = $(this).attr('data');
                $('#'+data).modal('show');
            })

            // fungsi untuk login
            function login(f){
                // tampilkan animasi spiner pada tombol
                // let btn = $(f).find('button:submit'), def = btn.html(); 
                // btn.html(spiner).prop('disabled', true);

                // menghubungkan ke controller, mengirim data
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url('login'),
                    data: new FormData($(f)[0]),
                    contentType: false,
                    processData: false,
                    success: function(res){ console.log(res)
                        if(res == 201){ // jika hasil == 201 (kode sukses)
                            toast('Login berhasil');
                            goTo('admin')
                        }else{
                            toast('Login gagal');
                        }
                    }, error: function(err){ // jika error
                        toast('Login gagal');
                        console.log(err)
                    }
                })

                return false;
            }

        </script>
    </body>
</html>
