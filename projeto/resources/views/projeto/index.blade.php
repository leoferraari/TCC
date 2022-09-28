@include("header")
    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h3>
                    @switch($iSituacao)
                        @case(1)
                            Pendente (Aguardando aceitação de terceiros)
                            @break
                        @case(2)
                            Pendente (Aguardando minha aceitação)
                            @break
                        @case(3)
                            Em andamento
                            @break
                        @case(4)
                            Em alteração
                            @break
                        @case(5)
                            Cancelado
                            @break
                        @case(6)
                            Concluído
                            @break
                        @case(7)
                            Recusado 
                            @break
                    @endswitch

                    </h3>
                    <div class="card-body">
                        <a href="{{route('projeto.create')}}" class="btn btn-lg btn-success">Criar Projeto</a>
                  
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <!-- VER -->
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oProjetos as $oProjeto)
                                    <tr>
                                        <td>{{$oProjeto->id}}</td>
                            
                                   
                                
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>