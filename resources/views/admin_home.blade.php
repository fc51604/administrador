<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>Home | UniRent</title>
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
          <img src="img/logo/UniRent-V2.png" alt="" width="100">
        </a>
      </div>
    </nav>
    <!-- END Nav bar -->
    
    <!-- Banner -->
    <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
      <div class="container profile-container" style="padding:6%!important">
        <div class="row">
          <div class="col-2 profile-container__icon">
            <img class="m-1" src="img/profile/stormtrooper.jpg" alt="" width="100">
          </div>
          <div class="col-8">
            <div class="row-2">
              <div class="col-2">
                <h1 class="pt-3 profile-container__welcomeUser">Welcome,</h1>
                <h1 class="pb-3 profile-container__nameUser" id="nameUser">admin</h1>
              </div>
            </div>
            <div class="row">
                <div class="d-grid col-12 ms-auto">
                  <a class="btn btn-primary btn-lg" id="button-view" href="{{ url('administradorProfile/unirent_admin') }}">Profile</a>
                </div>
            </div>
            <div class="row">
              <p>  </p>
            </div>
            <div class="row">
                <div class="d-grid col-12 ms-auto">
                  <a class="btn btn-primary btn-lg" id="button-view" href="{{ url('utilizadoresFind') }}">Users</a>
                </div>
            </div>
            <div class="row">
              <p>  </p>
            </div>
            <div class="row">
                <div class="d-grid col-12 ms-auto">
                  <a class="btn btn-primary btn-lg" id="button-view" href="{{ url('propriedadesFind') }}">Properties</a>
                </div>
            </div>
            <div class="row">
              <p>  </p>
            </div>
            <div class="row">
                <div class="d-grid col-12 ms-auto">
                  <a class="btn btn-primary btn-lg" id="button-view" href="{{ url('establishments') }}">Establishments</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <!-- END Banner -->
  
  </body>
  