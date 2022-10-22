


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
                    <button type="button"data-toggle="modal" data-target="#meuModal" onclick="modalArea({{$iProjeto }}, {{$iComodo}})" class="btn btn-info">Cadastrar Área de Medição (Parede)</button>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código Área</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aAreasMedicoes as $aArquivo)
                                    <tr>
                                        <td>{{$aArquivo->id_medida}}</td>
                                        <td>{{$aArquivo->descricao_medida}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning btn-sm" onclick="modalArea({{$iProjeto}}, {{$iComodo}}, {{$aArquivo->id_medida}})">Alterar</button>
                                                <button type="submit" id_projeto="{{$iProjeto}}" id_comodo="{{$iComodo}}" id_medida="{{$aArquivo->id_medida}}" id="button_delete" class="btn btn-danger btn-sm">Deletar</button> 
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
        pushCampoComodo(id_projeto, id_comodo, id_medida);
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


    function pushCampoComodo(id_projeto, id_comodo, id_medida) {

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
                    pushCampoDescricao(id_projeto, id_comodo, id_medida);
                }
            }
        });
    }

    function pushCampoDescricao(id_projeto, id_comodo, id_medida) {
        var oTr = document.createElement('tr');

        var oTdLabel = document.createElement('td');
        oTdLabel.style.width  = '15%';

        var oTdDesc = document.createElement('td');
        oTdDesc.setAttribute('colspan', 2);

        var oLabeDescricao = document.createElement('label');
        oLabeDescricao.setAttribute('for', 'descricao_medida');
        oLabeDescricao.innerHTML = 'Área:';

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

    function fechar() {
        let modal = document.getElementById('modal');
        modal.style.display = 'none';

        oModal = document.getElementById('conteudo_modal');

        while (oModal.firstChild) {
            oModal.removeChild(oModal.lastChild);
        }
    }
</script>

@yield('javaScript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="{{ URL::asset('/js/area_medicoes/maintenance.js')}}"></script>