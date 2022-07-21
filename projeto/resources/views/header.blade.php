<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  
    
    <title>@yield('titulo')</title>
  </head>
<header>
    <div class="menu-bg">	<!-- card - Bloco -->
        <div class="menu"> <!-- Elemento modificador -->
            <div class="menu__logo">
                <a href="/motivacao"><img src="{{ asset('/img/arq.png') }}" alt="logos" id="logo__nasa"></a>

            </div> <!-- .menu__logo -->
            <nav class="nav">
                <ul class="nav__list"> <!-- Elemento modificador -->
                    <li><a href="{{route('projeto.create')}}" class="nav__link">Novo Projeto</a></li>
                    <li><a href="{{route('check_list.create')}}" class="nav__link">Check-List</a></li>
                    <li><a href="#teste" class="nav__link">Teste 2</a></li>
                    <li><a href="#meu_perfil" class="nav__link">Meu Perfil</a></li>
                    <li><a href="{{route('logout')}}" class="nav__link">Sair</a></li>
                </ul> <!-- .nav__list -->
            </nav> <!-- .nav -->
        </div> <!-- .menu -->
    </div> <!-- .menu-bg -->
</header>
</html>