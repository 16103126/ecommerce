<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <style>
        html{
            height: 100%;
        }
        
        h1,h2,h3,h4,h5,h6,p{
            font-family: 'Roboto Condensed';
        }
        table{
            font-family: 'Roboto Condensed';
            font-size: 1.25rem;
        }
        a{
            font-family: 'Roboto Condensed';
        }

        .btn{
            font-family: 'Roboto Condensed';
        }
        .nav-item {
        padding-top: 0.3125rem;
        padding-bottom: 0.3125rem;
        margin-right: 1rem;
        font-size: 1.25rem;
        text-decoration: none;
        white-space: nowrap;
        font-family: 'Roboto Condensed';
      }

      form{
        font-family: 'Roboto Condensed';
      }
      
      .navbar-brand{
        font-family: 'Roboto Condensed';
        font-size: 1.75rem;
      }
      </style>

      <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/admin/images/favicon/'.$setting->favicon) }}" />

     <!-- ========================= CSS here ========================= -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href='https://fonts.googleapis.com/css?family=Raleway:400,900' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>



    @stack('css')

</head>
<body>

    @include('partials.frontend.navbar')

    <div class="content">
        @yield('content')
    </div>

    @include('partials.frontend.footer')
    
   

    <!-- ========================= CSS here ========================= -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (Session::has('status'))
        <script>
            swal("{{Session('status')}}");
        </script>
    @endif

    @stack('js')

    <script>
        $(document).ready(function(){
            $('#language').on('change', function(){
                let url = $(this).val();
                window.location = url;
            });
        });

        $(document).ready(function(){
            $('#currency').on('change', function(){
                let url = $(this).val();
                window.location = url;
            });
        });

    </script>

</body>
</html>