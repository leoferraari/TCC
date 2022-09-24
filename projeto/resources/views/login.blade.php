<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="imagem/png" href="" />
    <title>TCC</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @yield('style')
</head>

<body>

    <div class="container">

        <div class="d-flex justify-content-center align-items-center">

            <div class="card mt-5">

                <article class="card-body">

                    <form method="POST" action="{{route('authenticate')}}">
                        @csrf

                        <div class="form-row mx-3 my-2">

                            <div class="form-group">

                                <label for="inputEmail">
                                    E-mail
                                </label>
                                <input type="email" class="form-control" id="email"
                                        name="email" placeholder="nome@gmail.com">

                            </div>

                        </div>

                        <div class="form-row mx-3 my-2">

                            <div class="form-group">

                                <label id="inputSenha">
                                    Senha
                                </label>
                                <input type="password" class="form-control" id="password"
                                    name="password" placeholder="******">


                            </div>

                        </div>

                  

                        <div class="form-row mx-3 my-2">

                            <div class="form-group">

                                <input type="submit" value="Logar"
                                class="btn btn-primary py-2">

                            </div>

                        </div>

                    </form>

                </article>


                <div class="card-footer bg-transparent">

                    <div class="row mx-3 my-2">
                        <a href="/register"> Registre-se </a>
                    </div>

                </div>

            </div>

        </div>

    </div>


    @yield('javaScript')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
