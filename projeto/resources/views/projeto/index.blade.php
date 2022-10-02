@include("header")
    <div class="container">
 
        <div id="listagem_projeto" class="row justify-content-center" id_situacao="{{$iSituacao}}">
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
                        <!-- <a href="{{route('projeto.create')}}" class="btn btn-lg btn-success">Criar Projeto</a> -->
                  
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
                                                    @if($oProjeto->permite_alterar)
                                                        <button type="button" permite_alterar="{{$oProjeto->permite_alterar}}" name="button_alterar" onclick="redirecionaProjeto({{$oProjeto->id}})" class="btn btn-warning btn-sm" >Alterar</button>
                                                    @endif
                                                    <button type="submit" id="cancelar_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-danger btn-sm">Cancelar</button> 
                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 8)
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" id="aceitar_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-success btn-sm">Aceitar</button>     
                                                    <button type="submit" id="recusar_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-danger btn-sm">Recusar</button> 

                                                    @if($oProjeto->id_checklist)
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="visualizarAtividades({{$oProjeto->id_usuario}}, {{$oProjeto->id_checklist}})">Visualizar Atividades</button>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 1 || $iSituacao == 2)
                                            <td>
                                                <div class="btn-group">
                                                @if($oProjeto->permite_alterar)
                                                    <button type="button" permite_alterar="{{$oProjeto->permite_alterar}}" name="button_alterar" onclick="redirecionaProjeto({{$oProjeto->id}})" class="btn btn-warning btn-sm" >Alterar</button>
                                                    <button type="button" name="button_comodos" onclick="redirecionaComodoProjeto({{$oProjeto->id}})" class="btn btn-primary btn-sm" >Cômodos</button>
                                                    <button type="submit" id="concluir_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-success btn-sm">Concluir</button> 
                                                    <button type="submit" id="cancelar_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-danger btn-sm">Cancelar</button> 
                                                @endif
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

        function redirecionaComodoProjeto(iProjeto) {
            window.location.href = 'http://localhost:8000/comodos/'+iProjeto;
        }

        function visualizarAtividades(id_usuario, id_checklist) {
            let bAltera = id_checklist ? true : false;

            oModal = document.querySelector('.modal_leo');

            //Limpa o Modal (Isso serve para quando ficar clicando no botão "Novo")
            while (oModal.firstChild) {
                oModal.removeChild(oModal.lastChild);
            }

            oModal.style.display = 'block';

            oDivFechar = document.createElement('div');
            oDivFechar.setAttribute('class', 'fechar');
            oDivFechar.setAttribute('onclick', 'fechar()');
            oDivFechar.innerHTML = 'X';
            oModal.appendChild(oDivFechar);
            
            oH1 = document.createElement('h1');
            oH1.innerHTML = 'Atividades';
            oH1.style.textAlign = 'center';

            oLista = document.createElement('ol');
            oLista.setAttribute('id', 'lista');
    
            buscaAtividadesCheckList(id_usuario, id_checklist);
 
            oModal.appendChild(oH1);
            oModal.appendChild(document.createElement('br'));

            oModal.appendChild(oLista);
        }

        function fechar() {
            let modal = document.querySelector('.modal_leo');
            modal.style.display = 'none';
        }

        function buscaAtividadesCheckList(id_usuario, id_checklist) {
            $.ajax({
                url: '/api/check_list_visualizacao/'+id_checklist+'/'+id_usuario,
                type: 'GET',
                success: function(atividades) {
                    console.log(atividades);
                    if(atividades) {

                        for (let index = 0; index < atividades.length; index++) {
                            var oLi = document.createElement('li');
                                oLi.innerHTML = index+1 +' - ' +atividades[index]['descricao'];
                                document.getElementById('lista').appendChild(oLi);
                        }
                    };
                }
            });
        }
</script>