


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
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
        
                <div class="card-body">
                    <h1>Medidas</h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código Medida</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aMedidas as $aMedida)
                                    <tr>
                                        <td>{{$aMedida->id_medida}}</td>
                                        <td>{{$aMedida->descricao_medida}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="submit" onclick="modalIncluirMedida({{$iProjeto}}, {{$iComodo}}, {{$aMedida->id_medida}})" class="btn btn-info btn-sm">Incluir Medida</button> 
                                                <button type="button" onclick="redirecionaMedida({{$iProjeto}}, {{$iComodo}}, {{$aMedida->id_medida}})" class="btn btn-secondary btn-sm" >Medidas</button>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="modalArea({{$iProjeto}}, {{$iComodo}}, {{$aMedida->id_medida}})">Alterar</button>
                                                <button type="submit" id_projeto="{{$iProjeto}}" id_comodo="{{$iComodo}}" id_medida="{{$aMedida->id_medida}}" id_medida_anterior="{{$iMedida}}" id="button_delete" class="btn btn-danger btn-sm">Deletar</button> 
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    function modalArea(id_projeto, id_comodo, id_medida = null) {
        let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');

        var oForm = document.createElement('form');
            oForm.setAttribute('id', 'formulario');
            oForm.setAttribute('id_medida', id_medida);

        document.getElementById('staticBackdropLabel').innerHTML = id_medida ? 'Alterar Área' : 'Incluir Área';

        var oTable = document.createElement('table');
            oTable.setAttribute('class', 'table table-borderless');

        var oTbody = document.createElement('tbody');
            oTbody.setAttribute('id', 'tabela');
        
        oTable.appendChild(oTbody);

        var oSubmit = document.createElement('input');
            oSubmit.setAttribute('type', 'submit');
            oSubmit.setAttribute('id', id_medida ? 'update_area_medicao' :'area_medicao');
            oSubmit.setAttribute('value', id_medida ? 'Alterar' : 'Cadastrar');
            oSubmit.setAttribute('class', 'btn btn-primary');
            oSubmit.style.marginTop = '50px';
            oSubmit.style.marginLeft = '40%';

            oForm.appendChild(oTable);
            oForm.appendChild(document.createElement('br'));
         

            oForm.appendChild(oSubmit);

            conteudo.appendChild(oForm);
    
        newModal = new bootstrap.Modal(oModal);
        newModal.show();

        pushCampoProjeto(id_projeto);
        pushCampos(id_projeto, id_comodo, id_medida, true);
    }

    function pushCampoProjeto(id_projeto) {

        $.ajax({
            url: '/api/projeto/'+id_projeto,
            type: 'GET',
            success: function(result) {
          
                if(result) {
                    var oTr = document.createElement('tr');

                    var oTdLabel = document.createElement('td');
                        oTdLabel.style.width  = '15%';
                    var oTdId = document.createElement('td');
                        oTdId.style.width  = '15%';
                    var oTdDesc = document.createElement('td');

                    oLabelProjeto = document.createElement('label');
                    oLabelProjeto.setAttribute('for', 'id_projeto');
                    oLabelProjeto.style.textAlign  = 'center';
                    oLabelProjeto.innerHTML = 'Projeto:';

                    oProjetoId = document.createElement('input');
                    oProjetoId.setAttribute('type', 'text');
                    oProjetoId.setAttribute('name', 'id_projeto');
                    oProjetoId.setAttribute('id', 'id_projeto');
                    oProjetoId.setAttribute('class', 'form-control');
                    oProjetoId.setAttribute('disabled', 'true');
                    oProjetoId.value = id_projeto;

                    oProjetoDesc = document.createElement('input');
                    oProjetoDesc.setAttribute('type', 'text');
                    oProjetoDesc.setAttribute('name', 'desc_projeto');
                    oProjetoDesc.setAttribute('class', 'form-control');
                    oProjetoDesc.setAttribute('disabled', 'true');
                    oProjetoDesc.value = result.nome;

                    oTdLabel.appendChild(oLabelProjeto);
                    oTdId.appendChild(oProjetoId);
                    oTdDesc.appendChild(oProjetoDesc);

                    oTr.appendChild(oTdLabel);
                    oTr.appendChild(oTdId);
                    oTr.appendChild(oTdDesc);

                    document.getElementById('tabela').appendChild(oTr);
                };
            }
        });
    }

    function pushCampos(id_projeto, id_comodo, id_medida, bIncluirArea = false) {
        $.ajax({
            url: '/api/comodo/'+id_comodo+'/'+id_projeto,
            type: 'GET',
            success: function(result) {
                if(result) {
                    var oTr = document.createElement('tr');

                    var oTdLabel = document.createElement('td');
                    oTdLabel.style.width  = '15%';
                    var oTdId = document.createElement('td');
                    oTdId.style.width  = '15%';
                    var oTdDesc = document.createElement('td');

                    oLabelComodo = document.createElement('label');
                    oLabelComodo.setAttribute('for', 'id_comodo');
                    oLabelComodo.style.textAlign  = 'center';
                    oLabelComodo.innerHTML = 'Cômodo:';

                    oComodoId = document.createElement('input');
                    oComodoId.setAttribute('type', 'text');
                    oComodoId.setAttribute('name', 'id_comodo');
                    oComodoId.setAttribute('id', 'id_comodo');
                    oComodoId.setAttribute('class', 'form-control');
                    oComodoId.setAttribute('disabled', 'true');
                    oComodoId.value = id_comodo;

                    oComodoDesc = document.createElement('input');
                    oComodoDesc.setAttribute('type', 'text');
                    oComodoDesc.setAttribute('name', 'desc_projeto');
                    oComodoDesc.setAttribute('class', 'form-control');
                    oComodoDesc.setAttribute('disabled', 'true');
                    oComodoDesc.value = result.nome;

                    oTdLabel.appendChild(oLabelComodo);
                    oTdId.appendChild(oComodoId);
                    oTdDesc.appendChild(oComodoDesc);

                    oTr.appendChild(oTdLabel);
                    oTr.appendChild(oTdId);
                    oTr.appendChild(oTdDesc);

                    document.getElementById('tabela').appendChild(oTr);
                    
                    if (bIncluirArea) {
                        pushCampoDescricao(id_projeto, id_comodo, id_medida);
                    } 
                }
            },
            
            complete: function(data) {
                if (!bIncluirArea) {
                    pushCampoTipoUnidadeMedida();
                    pushCampoTipoMedida();
                    pushCampoTipoPonto();
                    pushCampoDescricao(id_projeto, id_comodo, null, true);
                    pushCampoMedicao();
                }
  
            }
        });
    }

    function pushCampoDescricao(id_projeto, id_comodo, id_medida, bIncluirMedida = false) {
        var oTr = document.createElement('tr');

        var oTdLabel = document.createElement('td');
        oTdLabel.style.width  = '15%';

        var oTdDesc = document.createElement('td');
        oTdDesc.setAttribute('colspan', 2);

        var oLabeDescricao = document.createElement('label');
        oLabeDescricao.setAttribute('for', 'descricao_medida');
        oLabeDescricao.innerHTML = bIncluirMedida ? 'Descrição' : 'Área:';

        var oDescricao = document.createElement('input');
        oDescricao.setAttribute('type', 'text');
        oDescricao.setAttribute('name', 'descricao_medida');
        oDescricao.setAttribute('id', 'descricao_medida');
        oDescricao.setAttribute('class', 'form-control');

        if (id_medida) {
            preencheInformacoesFormulario(id_projeto, id_comodo, id_medida);
        }

        oTdLabel.appendChild(oLabeDescricao);
        oTdDesc.appendChild(oDescricao);

        oTr.appendChild(oTdLabel);
        oTr.appendChild(oTdDesc);
        document.getElementById('tabela').appendChild(oTr);
    }

    function preencheInformacoesFormulario(id_projeto, id_comodo, id_medida) {
        $.ajax({
            url: '/api/area_medicoes/'+id_projeto+'/'+id_comodo+'/'+id_medida,
            type: 'GET',
            success: function(result) {
                console.log(result);
                if(result) {
                    document.getElementById('descricao_medida').value = result.descricao_medida;
                };
            }
        });
    }

    function modalIncluirMedida(id_projeto, id_comodo, id_medida) {
        let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');

        var oForm = document.createElement('form');
            oForm.setAttribute('id', 'formulario');

        document.getElementById('staticBackdropLabel').innerHTML = 'Incluir Medida';

        var oTable = document.createElement('table');
            oTable.setAttribute('class', 'table table-borderless');

        var oTbody = document.createElement('tbody');
            oTbody.setAttribute('id', 'tabela');
        
        oTable.appendChild(oTbody);

        var oSubmit = document.createElement('input');
            oSubmit.setAttribute('type', 'submit');
            oSubmit.setAttribute('id',  'incluir_medida');
            oSubmit.setAttribute('value', 'Cadastrar');
            oSubmit.setAttribute('class', 'btn btn-primary');
            oSubmit.style.marginTop = '50px';
            oSubmit.style.marginLeft = '40%';

            oForm.appendChild(oTable);
            oForm.appendChild(document.createElement('br'));
         

            oForm.appendChild(oSubmit);

            conteudo.appendChild(oForm);
    
        newModal = new bootstrap.Modal(oModal);
        newModal.show();

        pushCampoMedida(id_projeto, id_comodo, id_medida);
        pushCampoProjeto(id_projeto);
        pushCampos(id_projeto, id_comodo, id_medida);       
    }

    function pushCampoMedida(id_projeto, id_comodo, id_medida) {
        $.ajax({
            url: '/api/area_medicoes/'+id_projeto+'/'+id_comodo+'/'+id_medida,
            type: 'GET',
            success: function(result) {
          
                if(result) {
                    var oTr = document.createElement('tr');

                    var oTdLabel = document.createElement('td');
                        oTdLabel.style.width  = '15%';
                    var oTdId = document.createElement('td');
                        oTdId.style.width  = '15%';
                    var oTdDesc = document.createElement('td');

                    oLabelMedida = document.createElement('label');
                    oLabelMedida.setAttribute('for', 'id_medida_pai');
                    oLabelMedida.style.textAlign  = 'center';
                    oLabelMedida.innerHTML = 'Medida Pai:';

                    oMedidaId = document.createElement('input');
                    oMedidaId.setAttribute('type', 'text');
                    oMedidaId.setAttribute('name', 'id_medida_pai');
                    oMedidaId.setAttribute('id', 'id_medida_pai');
                    oMedidaId.setAttribute('class', 'form-control');
                    oMedidaId.setAttribute('disabled', 'true');
                    oMedidaId.value = id_medida;

                    oMedidaDesc = document.createElement('input');
                    oMedidaDesc.setAttribute('type', 'text');
                    oMedidaDesc.setAttribute('name', 'desc_medida');
                    oMedidaDesc.setAttribute('class', 'form-control');
                    oMedidaDesc.setAttribute('disabled', 'true');
                    oMedidaDesc.value = result.descricao_medida;

                    oTdLabel.appendChild(oLabelMedida);
                    oTdId.appendChild(oMedidaId);
                    oTdDesc.appendChild(oMedidaDesc);

                    oTr.appendChild(oTdLabel);
                    oTr.appendChild(oTdId);
                    oTr.appendChild(oTdDesc);

                    document.getElementById('tabela').appendChild(oTr);
                };
            }
        });
    }


    function pushCampoTipoUnidadeMedida() {
        var oTr = document.createElement('tr');

        var oTdLabel = document.createElement('td');
        oTdLabel.setAttribute('colspan', 2);
        var oTdTipo  = document.createElement('td');

        let oLabelSelect = document.createElement("label"),
            oSelect = document.createElement("select");

        oLabelSelect.setAttribute('id', 'tipo_unidade_medida_name');
        oLabelSelect.innerHTML = 'Tipo Unidade Medida:';

        oSelect.setAttribute('name', 'tipo_unidade_medida_name');
        oSelect.setAttribute('id', 'tipo_unidade_medida');
        oSelect.setAttribute('class', 'form-control');
        
        const aTipos = [
            { codigo: 1, descricao: 'Metro (m)'},
            { codigo: 2, descricao: 'Centímetro (cm)'},
            { codigo: 3, descricao: 'Milímetro (mm)'}
        ];

        aTipos.forEach(element => {
            const oOption = document.createElement('option');
                
            oOption.setAttribute('value', element.codigo);
            oOption.innerHTML =  element.descricao;

            oSelect.appendChild(oOption);
        });

        oTdLabel.appendChild(oLabelSelect);
        oTdTipo.appendChild(oSelect);

        oTr.appendChild(oTdLabel);
        oTr.appendChild(oTdTipo);


        document.getElementById('tabela').appendChild(oTr);
    }


 

    function pushCampoTipoMedida() {
        var oTr = document.createElement('tr');

        var oTdLabel = document.createElement('td');
        oTdLabel.setAttribute('colspan', 2);
        var oTdTipo  = document.createElement('td');

        let oLabelSelect = document.createElement("label"),
            oSelect = document.createElement("select");

        oLabelSelect.setAttribute('id', 'tipo_medida_name');
        oLabelSelect.innerHTML = 'Tipo Medida:';

        oSelect.setAttribute('name', 'tipo_medida_name');
        oSelect.setAttribute('id', 'tipo_medida');
        oSelect.setAttribute('class', 'form-control');
        
        const aTipos = [
            { codigo: 1, descricao: 'Altura (Vertical)'},
            { codigo: 2, descricao: 'Largura (Horizontal)'},
            { codigo: 3, descricao: 'Profundidade'},
            { codigo: 4, descricao: 'Inclinada'}
        ];

        aTipos.forEach(element => {
            const oOption = document.createElement('option');
                
            oOption.setAttribute('value', element.codigo);
            oOption.innerHTML =  element.descricao;

            oSelect.appendChild(oOption);
        });

        oTdLabel.appendChild(oLabelSelect);
        oTdTipo.appendChild(oSelect);

        oTr.appendChild(oTdLabel);
        oTr.appendChild(oTdTipo);

        document.getElementById('tabela').appendChild(oTr);
    }

    function pushCampoMedicao() {
        var oTr = document.createElement('tr');

            var oTdLabel = document.createElement('td');
            oTdLabel.style.width  = '15%';

            var oTdDesc = document.createElement('td');
            oTdDesc.setAttribute('colspan', 2);

            var oLabeMedicao = document.createElement('label');
            oLabeMedicao.setAttribute('for', 'medicao');
            oLabeMedicao.innerHTML = 'Medição';

            var oMedicao = document.createElement('input');
            oMedicao.setAttribute('type', 'text');
            oMedicao.setAttribute('name', 'medicao');
            oMedicao.setAttribute('id', 'medicao');
            oMedicao.setAttribute('class', 'form-control');

            oTdLabel.appendChild(oLabeMedicao);
            oTdDesc.appendChild(oMedicao);

            oTr.appendChild(oTdLabel);
            oTr.appendChild(oTdDesc);
            document.getElementById('tabela').appendChild(oTr);
    }

    function pushCampoTipoPonto() {
        var oTr = document.createElement('tr');

        var oTdLabel = document.createElement('td');
        oTdLabel.setAttribute('colspan', 2);
        var oTdTipo  = document.createElement('td');

        let oLabelSelect = document.createElement("label"),
            oSelect = document.createElement("select");

        oLabelSelect.setAttribute('id', 'tipo_ponto_name');
        oLabelSelect.innerHTML = 'Tipo Ponto:';

        oSelect.setAttribute('name', 'tipo_ponto_name');
        oSelect.setAttribute('id', 'tipo_ponto');
        oSelect.setAttribute('class', 'form-control');
        
        const aTipos = [
            { codigo: null, descricao: 'Selecione...'},
            { codigo: 1, descricao: 'Hidráulico'},
            { codigo: 2, descricao: 'Elétrico'},
        ];

        aTipos.forEach(element => {
            const oOption = document.createElement('option');
                
            oOption.setAttribute('value', element.codigo);
            oOption.innerHTML =  element.descricao;

            oSelect.appendChild(oOption);
        });

        oTdLabel.appendChild(oLabelSelect);
        oTdTipo.appendChild(oSelect);

        oTr.appendChild(oTdLabel);
        oTr.appendChild(oTdTipo);

        document.getElementById('tabela').appendChild(oTr);
    }


    function fechar() {
        let modal = document.getElementById('modal');
        modal.style.display = 'none';

        oModal = document.getElementById('conteudo_modal');

        while (oModal.firstChild) {
            oModal.removeChild(oModal.lastChild);
        }
    }

    function redirecionaMedida(iProjeto, iComodo, iMedida) {
            window.location.href = 'http://localhost:8000/medidas/'+iProjeto+'/'+iComodo+'/'+iMedida;
    }
</script>

@yield('javaScript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="{{ URL::asset('/js/medidas/maintenance.js')}}"></script>