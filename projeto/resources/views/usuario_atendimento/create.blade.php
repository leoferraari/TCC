<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="imagem/png" href="" />
    <title>TCC</title>
    <link href="{{ asset('/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @yield('style')
</head>

<body>

    <div class="container">

        <div class="d-flex justify-content-center align-items-center">
            
            <div class="card mt-5">
                <h1 style="text-align: center">Atendimento</h1>
                <article class="card-body">
                    <form method="POST" action="{{route('usuario_atendimento.store')}}">
                        {!! csrf_field() !!}

                        @php
                            if($errors->all()){
                                $values = old('municipios',[]);
                            }

                        @endphp
                        <livewire:dynamic-dropdown-atendimento></livewire:dynamic-dropdown-atendimento>
                        @livewireScripts
                       

                        <div id="buttonEnviar" class="col-md-12 mb-3">
                            <button  class="btn btn-primary" type="submit">Cadastrar</button>
                        </div>

                </article>
            </div>

        </div>

    </div>

    @yield('javaScript')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

 
<!-- <form method="POST" action="/auth/register">
    {!! csrf_field() !!}
 
    <div>
        Name
        <input type="text" name="nome" value="{{ old('nome') }}">
    </div>
 
    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
 
    <div>
        Password
        <input type="password" name="password">
    </div>
    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
        <button type="submit">Register</button>
    </div>
</form> -->