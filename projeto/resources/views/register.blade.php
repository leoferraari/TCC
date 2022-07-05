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
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Primeiro nome</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nome" required>
                                <!-- <div class="valid-feedback">
                                    Tudo certo!
                                </div> -->
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom02">Sobrenome</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Sobrenome" required>
                                <div class="valid-feedback">
                                    Tudo certo!
                                </div>
                            </div>
                     
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom03">Apelido</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="validationCustom03" placeholder="Usuário">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom04">E-mail</label>
                                <input type="text" class="form-control" id="validationCustom04" placeholder="E-mail" required>
                                <div class="valid-feedback">
                                    Tudo certo!
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Data de Nascimento</label>
                                <input type="data" class="form-control" id="validationCustom04" placeholder="Data de Nascimento" required>
                                <div class="valid-feedback">
                                    Tudo certo!
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                    <label for="validationCustom05">CPF</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="CPF" required>
                                    <!-- <div class="valid-feedback">
                                        Tudo certo!
                                    </div> -->
                            </div>
                            <div class="col-md-4 mb-3">
                                    <label for="validationCustom06">Senha</label>
                                    <input type="text" class="form-control" id="validationCustom06" placeholder="Senha" required>
                                    <!-- <div class="valid-feedback">
                                        Tudo certo!
                                    </div> -->
                            </div>
                            <div class="col-md-4 mb-3">
                                    <label for="validationCustom07">Confirmação de Senha</label>
                                    <input type="text" class="form-control" id="validationCustom07" placeholder="Confirme sua senha" required>
                                    <!-- <div class="valid-feedback">
                                        Tudo certo!
                                    </div> -->
                            </div>
                        </div>

                       
                        <livewire:dynamic-dropdown></livewire:dynamic-dropdown>
                        @livewireScripts
                   

                  
    
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </form>

                    <script>
                        // Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
                        (function() {
                            'use strict';
                            window.addEventListener('load', function() {
                                // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                                var forms = document.getElementsByClassName('needs-validation');
                                // Faz um loop neles e evita o envio
                                var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                                });
                            }, false);
                        })();
                    </script>
           

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
        <input type="text" name="name" value="{{ old('name') }}">
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
    </div>

       @include('dynamic-dropdown/index')
 
    <div>
        <button type="submit">Register</button>
    </div>
</form> -->