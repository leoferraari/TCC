@include("header")
    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
           
                    <div class="card-body">
                        <a href="{{route('usuario_atendimento.create')}}" class="btn btn-lg btn-success">Inclusão Múltipla</a>
                        <button type="button" onclick="testeForm({{$iUsuario}})" class="btn btn-info">Inclusão Individual</button>
                        <button type="button" id="excluir_todos" codigo_usuario="{{$iUsuario}}" class="btn btn-danger">Excluir todos</button>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <!-- VER -->
                                <tr>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Sigla</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oUsuarioAtendimentos as $oAtendimento)
                                    <tr>
                                        <td>{{$oAtendimento->nome_cidade}}</td>
                                        <td>{{$oAtendimento->nome_estado}}</td>
                                        <td>{{$oAtendimento->sigla_estado}}</td>
                                   
                                        <td>
                                            <div class="btn-group">
                                                <button type="submit" codigo_usuario="{{$iUsuario}}" codigo_cidade="{{$oAtendimento->codigo_cidade}}" id="button_delete" class="btn btn-sm btn-danger">Deletar</button>
                                            </div>
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

    <div class="modal_leo">
    </div>


    <script>

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{ URL::asset('/js/usuario_atendimento/maintenance.js')}}"></script>

