


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TCC</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="{{ asset('/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>@yield('titulo')</title>
  </head>
    <header>
        <div class="menu-bg">	<!-- card - Bloco -->
            <div class="menu"> <!-- Elemento modificador -->
                <div class="menu__logo">
                    <a href="/dashboard"><img src="{{ asset('/img/arq.png') }}" alt="logos" id="logo__nasa"></a>
    
                </div> <!-- .menu__logo -->
                <nav class="nav">
                    <ul class="nav__list"> <!-- Elemento modificador -->
                        <li><a href="{{route('projeto.create')}}" class="nav__link">Novo Projeto</a></li>
                        
                        <!-- <li><a href="{{route('usuario_atendimento.create')}}" class="nav__link">Atendimento</a></li> -->
                        <!-- <li><a href="/comodo/create/1" class="nav__link">Cômodos</a></li>   -->
                    
                
                        <li><a href="{{route('perfil')}}" class="nav__link">Meu Perfil</a></li>
                        <!-- <li><a href="{{route('dashboard')}}" class="nav__link">Mot</a></li> -->
                        <li><a href="{{route('logout')}}" class="nav__link">Sair</a></li>
                    </ul> <!-- .nav__list -->
                </nav> <!-- .nav -->
                <!-- <input type="hidden" id="jwttoken"  value="{{session('jwt-token')->original['access_token']}}"> -->
            </div> <!-- .menu -->
        </div> <!-- .menu-bg -->
    </header>
</html>