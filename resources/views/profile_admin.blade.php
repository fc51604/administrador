<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>Admin Profile | UniRent</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo/UniRent-V2.png" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('administradorHome') }}">
                <img src="/img/logo/UniRent-V2.png" alt="" width="100">
            </a>
            <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="{{ url('administradorHome') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="{{ url('utilizadoresFind') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="{{ url('propriedadesFind') }}">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="{{ url('extrasMap') }}">Extras</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END Nav bar -->

    <!-- Profile -->
    <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center pt-5 ">
        <div class="container profile-container">
            <div class="row">
                <!--<div class="col-4 profile-container__icon">
          <img class="m-3" src="img/logo/UniRent-V2.png" alt="" width="100">
                </div>-->
                <!-- Cartão do gajo-->
                <div class="col-3 pt-2" style="padding:2%;padding-bottom:0!important;padding-top:2%!important">
                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- Team Thumb-->
                        <div class="advisor_thumb"><img src="/img/profile/stormtrooper.jpg" alt="img profile">
                            <!-- Social Info-->
                            <div class="social-info"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i
                                        class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <!-- Team Details-->
                        @foreach ($data as $administrador)
                        <div class="single_advisor_details_info">
                            <h6>{{ $administrador['PrimeiroNome'] }} {{ $administrador['UltimoNome'] }}</h6>
                            <p class="designation">{{ $administrador['TipoConta'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-9">
                    <div class="row">
                        <div class="col">
                            <h1 class="pt-3 profile-container__welcomeUser">Welcome, {{ $administrador['PrimeiroNome'] }}</h1>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col profile-container__information">

                            @foreach ($data as $administrador)
                            <form action="/administradorProfile/{{ $administrador['Username'] }}" method="POST">
                                <input type="hidden" name="username" value="{{$administrador['Username']}}">
                                <div class="form-group row">
                                    <div class="form-group col">
                                        <h2 class="pt-3">Username: </h2>
                                        <div class="col-sm-5 ">
                                            <input type="text" class="form-control mt-2" id="inputPassword"
                                                name="nomeUser" value="{{ $administrador['Username'] }}" style='background-color:#E7EBEE' readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <h2 class="pt-3">Primeiro Nome: </h2>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control mt-2" id="inputPassword" style='background-color:#E7EBEE'
                                                name="primeiroNome" value="{{ $administrador['PrimeiroNome'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col">
                                        <h2 class="pt-3">Email:</h2>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control mt-2" id="inputPassword" name="mail" style='background-color:#E7EBEE'
                                                placeholder="CHANGE ME!" value="{{ $administrador['Email'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <h2 class="pt-3">Último Nome: </h2>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control mt-2" id="inputPassword" style='background-color:#E7EBEE'
                                                name="ultimoNome" value="{{ $administrador['UltimoNome'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col">
                                        <h2 class="pt-3">Password:</h2>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control mt-2" id="myInput" name="password" style='background-color:#E7EBEE'
                                                placeholder="CHANGE ME!" value="{{ $administrador['Password'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <div class="col-sm-5">
                                            <input style="margin-top:30%!important" type="checkbox" onclick="myFunction()"> Show Password
                                            <script>
                                                function myFunction() {
                                                    var x = document.getElementById("myInput");
                                                    if (x.type === "password") {
                                                        x.type = "text";
                                                    } else {
                                                        x.type = "password";
                                                    }
                                                } 
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="mt-3 btn btn-primary">Make Changes!</button>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END Profile -->
</body>