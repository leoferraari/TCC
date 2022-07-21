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
                <h1 style="text-align: center">Registre-se</h1>
                <article class="card-body">
                    <form method="POST" action="/auth/register">
                    {!! csrf_field() !!}
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Primeiro nome</label>
                                <input name="nome" type="text" class="form-control" id="validationCustom01" placeholder="Nome" required>
                                <!-- <div class="valid-feedback">
                                    Tudo certo!
                                </div> -->
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom02">Sobrenome</label>
                                <input name="sobrenome" type="text" class="form-control" id="validationCustom02" placeholder="Sobrenome" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom03">Apelido</label>
                                <div class="input-group">
                                    <input name="apelido" type="text" class="form-control" id="validationCustom03" placeholder="Apelido">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom04">E-mail</label>
                                <input name="email" type="email" class="form-control" id="validationCustom04" placeholder="E-mail" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Data de Nascimento</label>
                                <input name="data_nasc" type="date" class="form-control" id="validationCustom05" placeholder="Data de Nascimento" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom06">CPF</label>
                                <input name="cpf" type="text" class="form-control" id="validationCustom06" placeholder="CPF" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom07">Senha</label>
                                <input name="password" type="password" class="form-control" id="validationCustom07" placeholder="Senha" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom08">Confirmação de Senha</label>
                                <input name="password_confirmation" type="password" class="form-control" id="validationCustom08" placeholder="Confirme sua senha" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom09">CREA</label>
                                <input name="crea" type="text" class="form-control" id="validationCustom09" placeholder="CREA" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom10">Celular</label>
                                <input name="celular" type="tel" class="form-control" id="validationCustom10" placeholder="Celular" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom11">Telefone Fixo</label>
                                <input name="telefone_fixo" type="tel"  class="form-control" id="validationCustom11" placeholder="Telefone Fixo">
                            </div>
                        </div>

                       
                        <livewire:dynamic-dropdown></livewire:dynamic-dropdown>
                        @livewireScripts

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom14">Bairro</label>
                                <input name="bairro" type="text" class="form-control" id="validationCustom14" placeholder="Bairro" required>
                            </div>      
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom15">CEP</label>
                                <input name="cep" type="text" class="form-control" id="validationCustom15" placeholder="CEP" required>
                            </div>       
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom16">Número</label>
                                <input name="numero_endereco" type="text" class="form-control" id="validationCustom16" placeholder="Número" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom15">Complemento</label>
                                <input name="complemento" type="text" class="form-control" id="validationCustom15" placeholder="Complemento">
                            </div>
                        </div>
                  
                        <div id="buttonEnviar" class="col-md-12 mb-3">
                            <button  class="btn btn-primary" type="submit">Cadastrar</button>
                        </div>
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