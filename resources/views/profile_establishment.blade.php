<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>Extras | UniRent</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo/UniRent-V2.png"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>  
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
                        <a class="nav-link text-black text-end" href="{{ url('findEstablishment') }}">Establishments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END Nav bar -->
    
    <!-- Banner -->
    <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
      <div class="container profile-container" style="padding-top:2%!important;padding-bottom:2%!important;padding-left:6%!important;padding-right:6%!important">
         <div class="breaddiv" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/administradorHome">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/findEstablishment">Find Establishement</a></li>
            <li class="breadcrumb-item active" aria-current="page">Establishment Profile</li>
            </ol>
        </div>
        <div class="row">
            <div class="col profile-container__information">
                @foreach ($data as $local)
                <form action="/updateEstablishment/{{ $local['Id'] }}" method="POST">
                    <div class="form-group row">
                        <div class="form-group col">
                            <h2 class="pt-3">Type: </h2>
                            <div class="col-sm-5 ">
                                <select id="inputPassword" name="type">
                                    <option value="{{$local['Tipo']}}">{{$local['Tipo']}}</option>
                                    <option value="Gym">Gym</option>
                                    <option value="Supermarket">Supermarket</option>
                                    <option value="Hospital">Hospital</option>
                                    <option value="Restaurant">Restaurant</option>
                                    <option value="Bus">Bus</option>
                                    <option value="Train">Train</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col">
                            <h2 class="pt-3">Name: </h2>
                            <div class="col-sm-5">
                                <input type="text" class="form-control mt-2" id="inputPassword" style='background-color:#E7EBEE'
                                    name="name" value="{{$local['Nome']}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col">
                            <h2 class="pt-3">Latitude: </h2>
                            <div class="col-sm-5">
                                <input type="text" class="form-control mt-2" id="inputPassword" style='background-color:#E7EBEE'
                                    name="latitude" value="{{$local['Latitude']}}">
                            </div>
                        </div>
                        <div class="form-group col">
                            <h2 class="pt-3">Longitude: </h2>
                            <div class="col-sm-5">
                                <input type="text" class="form-control mt-2" id="inputPassword" style='background-color:#E7EBEE'
                                    name="longitude" value="{{$local['Longitude']}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col">
                            <h2 class="pt-3">Description: </h2>
                            <div class="col-sm-5">
                                <input type="text" class="form-control mt-2" id="inputPassword" style='background-color:#E7EBEE'
                                    name="description" value="{{$local['Descricao']}}">
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="col-sm-8" style="padding-top:5%">
                                <button type="submit" class="mt-3 btn btn-primary ">Make Changes!</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
      </div>
    </div> 
    <!-- END Banner -->
  
  </body>