@include("header")
    <div class="container">
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="fechar()"></button>
                    </div>
                    <div  id="conteudo_modal" class="modal-body">
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  onclick="fechar()" data-bs-dismiss="modal">Fechar</button>
                    </div> -->
                </div>
            </div>
        </div>
 
        <div teste="{{$bPossuiProjeto}}" id="listagem_projeto" class="row justify-content-center" id_situacao="{{$iSituacao}}">
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <!-- VER -->
                                <tr>
                                <!-- <th>Código</th> -->
                                    <th>Nome</th>
                                    <th>Cliente</th>
                                    <th>E-mail</th>
                                    <th>Data</th>
                                    <th>Hora</th>
               
                                
                                    <th>Ações</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oProjetos as $oProjeto)
                                    <tr>
                                     
                                    <!-- <td>{{$oProjeto->id}}</td> -->
                                        <td>{{$oProjeto->nome}}</td>
                                        <td>{{$oProjeto->nome_cliente}}</td>
                                        <td>{{$oProjeto->email_cliente}}</td>
                                        <td>{{$oProjeto->data_atendimento}}</td>
                                        <td>{{$oProjeto->hora_atendimento}}</td>
                                 

                                        @if ($iSituacao == 7)
                                            <td>
                                                <div class="btn-group">
                                                    @if($oProjeto->permite_alterar)
                                                        <button type="button" permite_alterar="{{$oProjeto->permite_alterar}}" name="button_alterar" onclick="redirecionaProjeto({{$oProjeto->id}})" class="btn btn-warning btn-sm" >Alterar</button>
                                                    @endif

                                                    @if($oProjeto->permite_alterar && $oProjeto->id_terceirizado)
                                                    <button type="button" class="btn btn-info btn-sm" onclick="visualizarInfoArquiteto({{$oProjeto->id_terceirizado}})">Info. Arquiteto</button>
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


                                                    @if($oProjeto->permite_alterar && $oProjeto->id_terceirizado)
                                                        <button type="button" class="btn btn-info btn-sm" onclick="visualizarInfoArquiteto({{$oProjeto->id_terceirizado}})">Info. Arquiteto</button>
                                                    @endif

                                                    @if(!$oProjeto->permite_alterar)
                                                        
                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="redirecionaInfoProjeto({{$oProjeto->id}})">Info. Projeto</button>
                                                    @endif

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
                                                    @endif

                                                    <button type="button" name="button_comodos" onclick="redirecionaComodoProjeto({{$oProjeto->id}})" class="btn btn-primary btn-sm" >Cômodos</button>
                                                    
                                                    @if($oProjeto->id_checklist)
                                                        <button type="button" id="{{$oProjeto->id}}" permite_concluir_atividade="{{$oProjeto->permite_concluir_atividade}}" name="button_concluir_atividades" onclick="concluirAtividades({{$oProjeto->id_checklist}}, {{$oProjeto->id}})" class="btn btn-secondary btn-sm" >Atividades</button>
                                                    @endif

                                                    @if($oProjeto->permite_alterar && $oProjeto->id_terceirizado)
                                                        <button type="button" class="btn btn-info btn-sm" onclick="visualizarInfoArquiteto({{$oProjeto->id_terceirizado}})">Info. Arquiteto</button>
                                                    @endif

                                                    @if(!$oProjeto->permite_alterar)
                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="redirecionaInfoProjeto({{$oProjeto->id}})">Info. Projeto</button>
                                                    @endif

                                                    @if(!$oProjeto->permite_alterar || !$oProjeto->id_terceirizado)
                                                        <button type="submit" id="concluir_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-success btn-sm">Concluir</button> 
                                                    @endif

                                                    @if($oProjeto->permite_alterar)
                                                        <button type="submit" id="cancelar_projeto" id_projeto="{{$oProjeto->id}}" class="btn btn-danger btn-sm">Cancelar</button> 
                                                    @endif

                                                    <button type="button" onclick="redirecionaArquivosProjeto({{$oProjeto->id}})" class="btn btn-dark btn-sm">Arquivos</button> 
                                               
                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 3 || $iSituacao == 5)
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" id_projeto="{{$oProjeto->id}}" situacao="3" id="button-confirm-reabrir" class="btn btn-warning btn-sm">Reabrir</button> 
                                                </div>
                                            </td>
                                        @endif

                                        @if ($iSituacao == 4)
                                            <td>
                                                <div class="btn-group">
                                                    @if($oProjeto->permite_alterar)
                                                        <button type="button" permite_alterar="{{$oProjeto->permite_alterar}}" name="button_alterar" onclick="redirecionaProjeto({{$oProjeto->id}})" class="btn btn-warning btn-sm" >Alterar</button>
                                                    @endif

                                                    <button type="button" name="button_comodos" onclick="redirecionaComodoProjeto({{$oProjeto->id}})" class="btn btn-primary btn-sm" >Cômodos</button>
                                                    
                                                    @if($oProjeto->id_checklist)
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="visualizarAtividades({{$oProjeto->id_usuario}}, {{$oProjeto->id_checklist}})">Visualizar Atividades</button>
                                                    @endif

                                                    @if($oProjeto->permite_alterar && $oProjeto->id_terceirizado)
                                                        <button type="button" class="btn btn-info btn-sm" onclick="visualizarInfoArquiteto({{$oProjeto->id_terceirizado}})">Info. Arquiteto</button>
                                                    @endif

                                                    <button type="button" onclick="redirecionaArquivosProjeto({{$oProjeto->id}})" class="btn btn-dark btn-sm">Arquivos</button>  
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

        function redirecionaInfoProjeto(iProjeto) {
            window.location.href = 'http://localhost:8000/projeto_informacao/'+iProjeto;
        }

        function redirecionaComodoProjeto(iProjeto) {
            window.location.href = 'http://localhost:8000/comodos/'+iProjeto;
        }

        function redirecionaArquivosProjeto(iProjeto) {
            window.location.href = 'http://localhost:8000/arquivo_projeto/'+iProjeto;
        }

        function visualizarInfoArquiteto(iArquitetoTerceirizado) {
       
            let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');

            document.getElementById('staticBackdropLabel').innerHTML = 'Informações do Arquiteto Terceirizado';

            oLabelNome = document.createElement('label');
            oLabelNome.setAttribute('for', 'nome');
            oLabelNome.innerHTML = 'Nome Completo:';

            oNome = document.createElement('input');
            oNome.setAttribute('type', 'text');
            oNome.setAttribute('name', 'nome');
            oNome.setAttribute('id', 'nome');
            oNome.setAttribute('class', 'form-control');
            oNome.setAttribute('disabled', 'true');

            oLabelEmail = document.createElement('label');
            oLabelEmail.setAttribute('for', 'email');
            oLabelEmail.innerHTML = 'E-mail:';
         
            oEmail = document.createElement('input');
            oEmail.setAttribute('type', 'text');
            oEmail.setAttribute('name', 'email');
            oEmail.setAttribute('id', 'email');
            oEmail.setAttribute('class', 'form-control');
            oEmail.setAttribute('disabled', 'true');

            oLabelCrea = document.createElement('label');
            oLabelCrea.setAttribute('for', 'crea');
            oLabelCrea.innerHTML = 'CREA:';
         
            oCrea = document.createElement('input');
            oCrea.setAttribute('type', 'text');
            oCrea.setAttribute('name', 'crea');
            oCrea.setAttribute('id', 'crea');
            oCrea.setAttribute('class', 'form-control');
            oCrea.setAttribute('disabled', 'true');

            oLabelTelFixo = document.createElement('label');
            oLabelTelFixo.setAttribute('for', 'telefone_fixo');
            oLabelTelFixo.innerHTML = 'Telefone Fixo:';
         
            oTelFixo = document.createElement('input');
            oTelFixo.setAttribute('type', 'text');
            oTelFixo.setAttribute('name', 'telefone_fixo');
            oTelFixo.setAttribute('id', 'telefone_fixo');
            oTelFixo.setAttribute('class', 'form-control');
            oTelFixo.setAttribute('disabled', 'true');

            oLabelCelular = document.createElement('label');
            oLabelCelular.setAttribute('for', 'celular');
            oLabelCelular.innerHTML = 'Celular:';
         
            oCelular = document.createElement('input');
            oCelular.setAttribute('type', 'text');
            oCelular.setAttribute('name', 'celular');
            oCelular.setAttribute('id', 'celular');
            oCelular.setAttribute('class', 'form-control');
            oCelular.setAttribute('disabled', 'true');


            buscaArquiteto(iArquitetoTerceirizado);
            
            conteudo.appendChild(oLabelNome);
            conteudo.appendChild(oNome);
            conteudo.appendChild(document.createElement('br'));
            conteudo.appendChild(oLabelEmail);
            conteudo.appendChild(oEmail);
            conteudo.appendChild(document.createElement('br'));
            conteudo.appendChild(oLabelCrea);
            conteudo.appendChild(oCrea);
            conteudo.appendChild(document.createElement('br'));
            conteudo.appendChild(oLabelTelFixo);
            conteudo.appendChild(oTelFixo);
            conteudo.appendChild(document.createElement('br'));
            conteudo.appendChild(oLabelCelular);
            conteudo.appendChild(oCelular);

        

            newModal = new bootstrap.Modal(oModal);
            newModal.show();

        }

        function visualizarAtividades(id_usuario, id_checklist) {

            let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');

            document.getElementById('staticBackdropLabel').innerHTML = 'Atividades';

            oLista = document.createElement('ol');
            oLista.setAttribute('id', 'lista');
    
            buscaAtividadesCheckList(id_usuario, id_checklist);

            conteudo.appendChild(oLista);

            newModal = new bootstrap.Modal(oModal);
            newModal.show();
        }

        function concluirAtividades(id_checklist, id_projeto) {

            var oForm = document.createElement('form');
                oForm.setAttribute('id_projeto', id_projeto);
                oForm.setAttribute('id_checklist', id_checklist);
                oForm.setAttribute('id', 'formulario');


            let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');

            document.getElementById('staticBackdropLabel').innerHTML = 'Atividades Concluídas';

            oTable = document.createElement('table');
            oTable.setAttribute('class', 'table table-borderless');

            oThead = document.createElement('thead');

            oCabecalho = document.createElement('tr');
            oTh1 = document.createElement('th');
            oTh2 = document.createElement('th');
            oTh3 = document.createElement('th');

            oTh1.setAttribute('scope', 'col'); 
            oTh1.innerHTML = 'Código';
            oTh2.setAttribute('scope', 'col'); 
            oTh2.innerHTML = 'Descrição';
            oTh3.setAttribute('scope', 'col'); 
            oTh3.innerHTML = 'Concluído';

            oThead.appendChild(oTh1);
            oThead.appendChild(oTh2);
            oThead.appendChild(oTh3);

            oTbody = document.createElement('tbody');
            oTbody.setAttribute('id', 'tabela');

            oTable.appendChild(oThead);
            oTable.appendChild(oTbody);

            buscaAtividadesConclusao(id_checklist,id_projeto, Number(document.getElementById(id_projeto).getAttribute('permite_concluir_atividade')) == 1);
                

            if (Number(document.getElementById(id_projeto).getAttribute('permite_concluir_atividade')) == 1) {
                oSubmit = document.createElement('input');
                oSubmit.setAttribute('type', 'submit');
                oSubmit.setAttribute('id', 'concluir_atividade');
                oSubmit.setAttribute('value', 'Concluir');
                oSubmit.setAttribute('class', 'btn btn-primary');
                oSubmit.style.marginTop = '50px';
                oSubmit.style.marginLeft = '40%';
            }
            
            oForm.appendChild(oTable);
            oForm.appendChild(document.createElement('br'));

            if (Number(document.getElementById(id_projeto).getAttribute('permite_concluir_atividade')) == 1) {
                oForm.appendChild(oSubmit);
            }

            conteudo.appendChild(oForm);

            var newModal = new bootstrap.Modal(oModal).show();
            newModal.show();
        }

        function fechar() {
            let modal = document.getElementById('modal');
            modal.style.display = 'none';

            oModal = document.getElementById('conteudo_modal');

            while (oModal.firstChild) {
                oModal.removeChild(oModal.lastChild);
            }
        }

        function buscaArquiteto(iArquiteto) {
            $.ajax({
                url: '/api/info_arquiteto/'+iArquiteto,
                type: 'GET',
                success: function(info_arquiteto) {
                    console.log(info_arquiteto);
                    if(info_arquiteto) {
                        document.getElementById('nome').value = info_arquiteto.nome;
                        document.getElementById('email').value = info_arquiteto.email;
                        document.getElementById('crea').value = info_arquiteto.crea;
                        document.getElementById('celular').value = info_arquiteto.celular;
                        document.getElementById('telefone_fixo').value = info_arquiteto.telefone_fixo;
                    };
                }
            });
        }

        function buscaAtividadesCheckList(id_usuario, id_checklist) {
            $.ajax({
                url: '/api/check_list_visualizacao/'+id_checklist+'/'+id_usuario,
                type: 'GET',
                success: function(atividades) {
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


        function buscaAtividadesConclusao(id_checklist, id_projeto, bPermiteAlterar) {
            $.ajax({
                url: '/api/check_list_atividade/concluir_atividade/'+id_checklist+'/'+id_projeto,
                type: 'GET',
                success: function(atividades) {
                    if(atividades) {

                        for (let index = 0; index < atividades.length; index++) {
                            var oTr = document.createElement('tr');
                            var oTh = document.createElement('th');

                             oTh.setAttribute('scope', 'row'); 

                            var oTdDesc = document.createElement('td');
                            var oTdConc = document.createElement('td');
                       
                        
                            if (bPermiteAlterar) {
                                var oInputCheckbox = document.createElement('input');                     
                                oInputCheckbox.setAttribute('type', 'checkbox');
                                oInputCheckbox.setAttribute('name', 'concluido[]');
                                oInputCheckbox.setAttribute('id', atividades[index]['id']);
                            }

                            oTh.innerHTML = atividades[index]['id'];
                            oTdDesc.innerHTML = atividades[index]['descricao'];
   
                            if (bPermiteAlterar && atividades[index]['concluido'] == 1) {
                                oInputCheckbox.checked = true;
                            }

                            if (bPermiteAlterar) {
                                oTdConc.appendChild(oInputCheckbox);
                            } else {
                                oTdConc.innerHTML = atividades[index]['concluido'] == 1 ? 'Sim' : 'Não';
                            }

                            oTr.appendChild(oTh);
                            oTr.appendChild(oTdDesc);
                            oTr.appendChild(oTdConc);

                            document.getElementById('tabela').appendChild(oTr);
                        }
                    };
                }
            });
        }
</script>  