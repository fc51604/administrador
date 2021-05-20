<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <!-- <title>User | UniRent</title> -->
    <link rel="shortcut icon" type="image/jpg" href="img/logo/UniRent-V2.png" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="/JS/sidebar.js"></script>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
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

    <!-- Banner -->
    <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <!--good-->
                <div class="col profile-container">
                    <div class="row m-1">
                        <!-- main -->
                        <div class="col-3 pt-2">
                            <!-- Inicio Search Form-->
                            <br>
                            <form action="{{url('/propriedadesFind')}}" type="get" novalidate="novalidate">
                                <div class="form-row">
                                    <div class="col p-2">
                                        <select class="form-control search-slt" name="tipoProp"
                                            id="exampleFormControlSelect1">
                                            <option name="query5" value="">Anything</option>
                                            <option name="query3" value="Quarto">Quarto</option>
                                            <option name="query4" value="Casa">Casa</option>
                                        </select>
                                        <small id="emailHelp" class="p-1 form-text text-muted">Select the property type</small>
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" class="form-control search-slt" placeholder="Location"
                                            name="localizacao">
                                        <small id="emailHelp" class="p-1 form-text text-muted">Insert location</small>
                                    </div>
                                    <div class="col p-2">
                                        <select class="form-control search-slt" name="areaMetros" id="exampleFormControlSelect1">
                                            <option name="query5" value="">Anything</option>
                                            <option name="query3" value="7">< 7m2</option>
                                            <option name="query4" value="10">< 10m2</option>
                                            <option name="query5" value="20">< 20m2</option>
                                            <option name="query5" value="50">< 50m2</option>
                                            <option name="query5" value="100">< 100m2</option>
                                            <option name="query5" value="200">< 200m2</option>
                                        </select>
                                        <small id="emailHelp" class="p-1 form-text text-muted">Select the property size</small>
                                    </div>
                                    <div class="col p-2">
                                        <select class="form-control search-slt" name="preco" id="exampleFormControlSelect1">
                                            <option name="query5" value="">Anything</option>
                                            <option name="query3" value="200">< 200€</option>
                                            <option name="query4" value="400">< 400€</option>
                                            <option name="query5" value="600">< 600€</option>
                                            <option name="query5" value="800">< 800€</option>
                                            <option name="query5" value="1000">< 1000€</option>
                                        </select>
                                        <small id="emailHelp" class="p-1 form-text text-muted">Select the property price</small>
                                    </div>
                                    <div class="col text-center mt-5 p-2">
                                        <button type="submit" class="btn btn-primary wrn-btn table-btn">Search</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Fim Search Form -->
                        </div>
                        <div class="col-9" style="height:40rem!important">
                            <div id="bodywrap">
                                <div class="row">
                                    <div class="large-10 columns">
                                        <div class="scroll-window-wrapper">
                                            <div class="scroll-window" style="height:36rem!important">
                                                <table class="table table-striped table-hover user-list fixed-header table-properties">
                                                    <thead class="table-head">
                                                        <th class="table-headP"><div>Id</div></th>
                                                        <th class="table-headP"><div>Type</div></th>
                                                        <th class="table-headP"><div>Location</div></th>
                                                        <th class="table-headP"><div>Area</div></th>
                                                        <th class="table-headP"><div>Price</div></th>
                                                        <th><div></div></th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($propriedades as $row)
                                                        <tr>
                                                            <td id="table-rows">{{$row['IdPropriedade']}}</td>
                                                            <td id="table-rows">{{$row['TipoPropriedade']}}</td>
                                                            <td id="table-rows">{{$row['Localizacao']}}</td>
                                                            <td id="table-rows">{{$row['AreaMetros']}}m2</td>
                                                            <td id="table-rows">{{$row['Preco']}}€</td>
                                                            <td class="text-right buttons-properties">
                                                                <form action="/propriedadesDelete/{{ $row['IdPropriedade'] }}" method="POST">
                                                                    <a class="mt-2 btn btn-primary" id="button-view" href="{{ url('propriedadesProfile/'.$row['IdPropriedade']) }}" style="margin-top:8%!important">View Property</a>
                                                                    <button type="submit" class="mt-2 btn btn-danger" id="deleteButton" style="margin-top:8%!important;float:right">X</button>
                                                                </form>			
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Banner -->
</body>