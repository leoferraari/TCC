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
                    <h1 style="text-align: center">Cadastre o Cômodo</h1>
                    <article class="card-body">
                        <form method="POST" action="{{route('comodo.store')}}">
                        {!! csrf_field() !!}
                  
                  
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <input name="id_projeto" type="number" class="form-control" value="{{$iProjeto}}"  hidden>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom15">Nome:</label>
                                    <input name="nome" type="text" class="form-control" placeholder="Digite o Nome do Cômodo">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom15">Descrição:</label>
                                    <textarea name="descricao" class="form-control"></textarea>
                                </div>
                            </div>

            
                            <div id="buttonEnviar" class="col-md-12 mb-3">
                                <button class="btn btn-primary" type="submit">Cadastrar</button>
                            </div>
                        </form>

                    </article>
                </div>
            </div>
        </div>


        @yield('javaScript')
    </body> 
</html>

