<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>User Profile | UniRent</title>
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
            <a class="navbar-brand" href="#">
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
                <div class="col-3 pt-2">
                    <div style="margin:5%;margin-top:15%">
                        @foreach ($data as $propriedade)
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <div class="mt-3" style="padding-top:25%;padding-bottom:25%">
                                        <h4>Property Id: {{ $propriedade['IdPropriedade'] }}</h4>
                                        <h5>Landlord Id: {{ $propriedade['IdSenhorio'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="/propriedadesDelete/{{ $propriedade['IdPropriedade'] }}" method="POST">
                        <button type="submit" class="mt-3 btn btn-danger" id="deleteButton">Delete Property</button>
                    </form>
                </div>
                <div class="col-9" style="padding:2%">
                    <div class="row">
                        <div class="col">
                            <h1 class="pt-3 profile-container__welcomeUser"></h1>
                            @endforeach
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:2%">
                        <div class="col profile-container__information">

                            @foreach ($data as $propriedade)
                            <input type="hidden" name="username" value="{{$propriedade['TipoPropriedade']}}">
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Property Type: </h2>
                                    <div class="col-sm-3 ">
                                        <input type="text" class="form-control mt-2" id="inputPassword"
                                            name="nomeUser" value="{{ $propriedade['TipoPropriedade'] }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Location: </h2>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control mt-2" id="inputPassword"
                                            name="primeiroNome" value="{{ $propriedade['Localizacao'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Area:</h2>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="mail"
                                        value="{{ $propriedade['AreaMetros'] }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Price: </h2>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control mt-2" id="inputPassword"
                                            name="ultimoNome" value="{{ $propriedade['Preco'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Description:</h2>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="mail"
                                        value="{{ $propriedade['Descricao'] }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Room Number: </h2>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="mail"
                                        value="{{ $propriedade['NumeroQuartos'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Lotation:</h2>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="mail"
                                        value="{{ $propriedade['Lotacao'] }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Availability: </h2>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="mail"
                                        value="{{ $propriedade['Disponibilidade'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%;padding-bottom:3%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Bathrooms:</h2>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="mail"
                                        value="{{ $propriedade['CasasBanho'] }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Conservation State: </h2>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="mail"
                                        value="{{ $propriedade['EstadoConservacao'] }}" readonly>
                                    </div>
                                </div>
                            </div>
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