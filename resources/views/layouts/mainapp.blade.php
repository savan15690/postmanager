@php
    use App\User;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Post Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{!! asset('public/css/bootstrap.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script type="text/javascript" src="{!! asset('public/js/jquery-3.3.1.min.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

</head>
<body>

    <div class="container">
        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="{{url('posts')}}">Post Manager</a>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto"></ul>
                    {{-- Check if user is logged in --}}
                    @if (session()->has('is_loggedin'))
                        @php
                            $userName = User::find(session('user_id'))->name;
                        @endphp
                        <span class="navbar-brand">Logged In as : @php echo $userName; @endphp</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="navbar-brand" href="{{url('logout')}}">Logout</a>
                    @else
                        <a class="navbar-brand" href="{{'login'}}">Login</a><br/>
                        <a class="navbar-brand" href="">|</a><br/>
                        <a class="navbar-brand" href="{{url('register')}}">Register</a>
                    @endif
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Copyright &copy; 2018</a>
        </nav>
    </div>

    <script type="text/javascript">
        $(".post-tags").select2({
            tags: true
        });
    </script>

</body>
</html>