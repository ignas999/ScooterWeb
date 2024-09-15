<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <!-- basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- mobile metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <!-- site metas -->
        <title>Website</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- style css -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- Responsive-->
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <!-- Tweaks for older IEs-->
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
        <script src="//unpkg.com/alpinejs" defer></script>
        
     </head>
</head>

<body class="main-layout">
    
    <header class="header">   
           <div class="container-fluid">
              <div class="row">
                 <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <div class="full">
                       <div class="center-desk">
                          <div class="logo">
                             <a href="/"><img src="{{ asset('images/logo.png') }}" alt="#" /></a>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <nav class="navigation navbar navbar-expand-md navbar-dark ">
                       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                       </button>
                       <x-flash-message />
                       <div class="collapse navbar-collapse" id="navbarsExample04">
                          <ul class="navbar-nav mr-auto">

                           @auth
                           <li class="nav-item">
                              <form action="/logout" method="POST">
                                 @csrf
                                 <button class="button nav-link">Atsijungti</button>
                              </form>
                              
                             
                             
                           </li>
                           @else
                             <li class="nav-item">

                                <a class="nav-link" href="/">Pagrindinis</a>
                             </li>
                             <li class="nav-item">
                                <a class="nav-link" href="/about">Apie mus</a>
                             </li>
                             <li class="nav-item">
                                <a class="nav-link" href="/register">Registruotis</a>
                             </li>
                             <li class="nav-item d_none">
                                <a class="nav-link" href="/login">Prisijungti</a>
                             </li>
                          </ul>
                          @endauth
                       </div>
                    </nav>
                 </div>
              </div>
           </div>
        
        
     </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer">
           <div class="container">
              <div class="row">
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <img class="logo" src="{{ asset('images/logo.png') }}" alt="#"/>

                 </div>
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <h3>Apie mus</h3>
                    <ul class="about_us">
                       <li> Darbo laikas:
                        <br> I-V 9:00-18:00
                        <br> VI 10:00-14:00
                      </li>
                    </ul>
                 </div>
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <h3>Susisiekime</h3>
                    <ul class="conta">
                       <li>
                         El.Paštas: transportas@gmail.com
                        <br>
                        Konsultacijoms susisiekti: 870014251


                       </li>
                    </ul>
                 </div>
              </div>
           </div>
           <div class="copyright">
              <div class="container">
                 <div class="row">
                    <div class="col-md-12">
                       <p>© 2023 Visos teisės saugomos.</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </footer>


     
</body>
</html>