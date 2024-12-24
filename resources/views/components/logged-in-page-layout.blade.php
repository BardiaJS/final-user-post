<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Software</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
        integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous">
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/main.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap');
    </style>
</head>

<body>
    <header class="header-bar mb-3">
        <div class="container d-flex flex-column flex-md-row align-items-center p-3">
            <h4 class="my-0 mr-md-auto font-weight-normal"><a style="margin-right: 20px; color:black;"
                    href="/">Software</a></h4>
            @auth
                @if (auth()->user()->is_super_admin == true or auth()->user()->is_admin === true)
                    <form action="/add-users" method="GET" class="mb-0 pt-2 pt-md-0" style="margin-right: 5px">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-outline-primary">Add User</button>
                            </div>
                        </div>
                    </form>
                    <form action="/list/posts" method="GET" class="mb-0 pt-2 pt-md-0" style="margin-right: 5px">
                        <div class="row align-items-center">
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-outline-primary">Post List</button>
                            </div>
                        </div>
                    </form>
                    <form action="/list/users" method="GET" class="mb-0 pt-2 pt-md-0" style="margin-right: 5px">
                        <div class="row align-items-center">
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-outline-primary">Users</button>
                            </div>
                        </div>
                    </form>
                @endif



                <form action="/create-post-page" method="GET" class="mb-0 pt-2 pt-md-0" style="margin-right: 5px">
                    <div class="row align-items-center">
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-outline-primary">Create Posts</button>
                        </div>
                    </div>
                </form>

                <form action="/profile/{{ auth()->user()->id }}" method="GET" class="mb-0 pt-2 pt-md-0"
                    style="margin-right: 5px">
                    <div class="row align-items-center">
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-outline-primary">Profile</button>
                        </div>
                    </div>
                </form>
                <form action="/change-password-page" method="GET" class="mb-0 pt-2 pt-md-0" style="margin-right: 5px">
                    <div class="row align-items-center">
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-outline-primary">Chnage Password</button>
                        </div>
                    </div>
                </form>
                <form action="/post/public" method="GET" class="mb-0 pt-2 pt-md-0" style="margin-right: 5px">
                    <div class="row align-items-center">
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-outline-primary">Posts</button>
                        </div>
                    </div>
                </form>
                <form action="/logout" method="POST" class="mb-0 pt-2 pt-md-0">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-outline-primary">Sign out</button>
                        </div>
                    </div>
                </form>
            @endauth



        </div>
    </header>
    <!-- header ends here -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">

            <div class="container container--narrow">
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('failure'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">

            <div class="container container--narrow">
                <div class="alert alert-danger text-center">
                    {{ session('failure') }}
                </div>
            </div>
        </div>
    @endif
    {{ $slot }}

    <!-- footer begins -->
    <footer class="border-top text-center small text-muted py-3">
        <p class="m-0">Copyright &copy; {{ date('Y/m/d') }} <a href="/" class="text-muted">Software</a>. All
            rights reserved.
        </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        $('[data-toggle="tooltip"]').tooltip()
    </script>
</body>

</html>
