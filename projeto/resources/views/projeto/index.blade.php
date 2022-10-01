@include("header")
    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h3>
                        @switch($iSituacao)
                            @case(1)
                                Em andamento
                                @break
                            @case(2)
                                Em alteração
                                @break
                            @case(3)
                                Cancelado
                                @break
                            @case(4)
                                Concluído
                                @break
                            @case(5)
                                Recusado 
                                @break
                            @case(7)
                            Pendente (Aguardando aceitação de terceiros)
                                @break
                            @case(8)
                            Pendente (Aguardando minha aceitação)
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
                                    <th>Cliente</th>
                                    <th>N. Telefone (Cliente)</th>
                                    <th>Data Atendimento</th>
                                    <th>Prazo Final</th>
                                    @if ($iSituacao != 5)
                                    <th>Ações</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oProjetos as $oProjeto)
                                    <tr>
                                        <td>{{$oProjeto->id}}</td>
                                        <td>{{$oProjeto->nome}}</td>
                                        <td>{{$oProjeto->nome_cliente}}</td>
                                        <td>{{$oProjeto->numero_tel_cliente}}</td>
                                        <td>{{$oProjeto->data_hora_atendimento}}</td>
                                        <td>{{$oProjeto->prazo_final}}</td>

                                        

                                        @if ($iSituacao == 7)
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" permite_alterar="{{$oProjeto->permite_alterar}}" name="button_alterar" onclick="redirecionaProjeto({{$oProjeto->id}})" class="btn btn-warning btn-sm" >Alterar</button>
                        
                                                    <button type="submit" id="cancelar_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-danger btn-sm">Cancelar</button> 
                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 8)
                                            <td>
                                                <div class="btn-group">
                                                    
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="consultaAtividades()">Visualizar Atividades</button>
                                                    <button type="submit" check_list="{{$iCodigoCheckList}}" atividade="{{$oAtividade->id}}" id="button_delete" class="btn btn-outline-danger btn-sm">Deletar</button> 
                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 1 || $iSituacao == 2)
                                            <td>
                                                <div class="btn-group">
                                                <button type="button" permite_alterar="{{$oProjeto->permite_alterar}}" name="button_alterar" onclick="redirecionaProjeto({{$oProjeto->id}})" class="btn btn-warning btn-sm" >Alterar</button>

                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 3)
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" check_list="{{$iCodigoCheckList}}" atividade="{{$oAtividade->id}}" id="button_delete" class="btn btn-outline-danger btn-sm">Deletar</button> 
                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 4)
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" check_list="{{$iCodigoCheckList}}" atividade="{{$oAtividade->id}}" id="button_delete" class="btn btn-outline-danger btn-sm">Deletar</button> 
                                                </div>
                                            </td>
                                        @endif
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{ URL::asset('/js/projeto/maintenance.js')}}"></script>
    <script>


        $( window ).on( "load", function() {
            const oBotaoAlterar = document.getElementsByName("button_alterar");

            for (let i = 0; i < oBotaoAlterar.length; i++) {
                if(oBotaoAlterar.item(i).getAttribute('permite_alterar') == 0) {
                    oBotaoAlterar.item(i).setAttribute('disabled', true);
                }
            }
        });

        function redirecionaProjeto(iProjeto) {
            window.location.href = 'http://localhost:8000/projeto_alteracao/'+iProjeto;
        }
    </script>