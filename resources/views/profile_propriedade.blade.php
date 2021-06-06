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
                        <a class="nav-link text-black text-end" href="{{ url('establishments') }}">Establishments</a>
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
                <div class="col-3 pt-2" style="padding:2%;padding-bottom:0!important;padding-top:4%!important">
                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp; margin-bottom:6%;">
                        <!-- Team Thumb-->
                        <div class="advisor_thumb"><img src="/img/QUARTO.jpg" alt="img profile" style="height:18rem">
                            <!-- Social Info-->
                            <div class="social-info"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i
                                        class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <!-- Team Details-->
                        @foreach ($data as $propriedade)
                        <div class="single_advisor_details_info">
                            <h6>Property Id: {{ $propriedade['IdPropriedade'] }}</h6>
                            <p class="designation">Landlord Id: {{ $propriedade['IdSenhorio'] }}</p>
                        </div>
                    </div>
                    <form action="/propriedadesDelete/{{ $propriedade['IdPropriedade'] }}" method="POST">
                        <button type="submit" class="mt-3 btn btn-danger" id="deleteButton" style="float:left">Delete Property</button>
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
                            <form action="/propriedadesProfile/{{ $propriedade['IdPropriedade'] }}" method="POST">
                            <input type="hidden" class="form-control mt-2" id="inputPassword" name="idpropriedade"
                                        value="{{ $propriedade['IdPropriedade'] }}" style='background-color:#E7EBEE'>
                            <input type="hidden" class="form-control mt-2" id="inputPassword" name="idsenhorio"
                                        value="{{ $propriedade['IdSenhorio'] }}" style='background-color:#E7EBEE'>
                            <input type="hidden" class="form-control mt-2" id="inputPassword" name="latitude"
                                        value="{{ $propriedade['Latitude'] }}" style='background-color:#E7EBEE'>
                            <input type="hidden" class="form-control mt-2" id="inputPassword" name="longitude"
                                        value="{{ $propriedade['Longitude'] }}" style='background-color:#E7EBEE'>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Property Type: </h2>
                                    <div class="col-sm-8 ">
                                        <input type="text" class="form-control mt-2" id="inputPassword"
                                            name="type" value="{{ $propriedade['TipoPropriedade'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Location: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword"
                                            name="location" value="{{ $propriedade['Localizacao'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Bathrooms:</h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="bathrooms"
                                        value="{{ $propriedade['CasasBanho'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Area:</h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="area"
                                        value="{{ $propriedade['AreaMetros'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Price: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword"
                                            name="price" value="{{ $propriedade['Preco'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Conservation State: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="state"
                                        value="{{ $propriedade['EstadoConservacao'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Description:</h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="description"
                                        value="{{ $propriedade['Descricao'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Rooms: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="rooms"
                                        value="{{ $propriedade['NumeroQuartos'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Solar Orientation: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="orientation"
                                        value="{{ $propriedade['OrientacaoSolar'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Capacity:</h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="capacity"
                                        value="{{ $propriedade['Lotacao'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Internet Access: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="internet"
                                        value="{{ $propriedade['internetAcess'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Cleaning: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="cleaning"
                                        value="{{ $propriedade['limpeza'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Youngest Limit:</h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="youngest"
                                        value="{{ $propriedade['faixaEtariaMin'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Oldest Limit: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="oldest"
                                        value="{{ $propriedade['faixaEtariaMax'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Male: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="male"
                                        value="{{ $propriedade['generoMasc'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <h2 class="pt-3">Female:</h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="female"
                                        value="{{ $propriedade['generoFemin'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Smokers: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="smokers"
                                        value="{{ $propriedade['aceitaFumadores'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <h2 class="pt-3">Pets: </h2>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control mt-2" id="inputPassword" name="pets"
                                        value="{{ $propriedade['aceitaAnimais'] }}" style='background-color:#E7EBEE'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-left:10%">
                                <div class="form-group col">
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="col-sm-8" style="padding-top:10%;padding-left:13%">
                                        <button type="submit" class="mt-3 btn btn-primary ">Make Changes!</button>
                                    </div>
                                </div>
                            </div>
                            </div>
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