


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
                    <button type="button" onclick="mostrarModal({{$id_usuario}})" class="btn btn-info">Incluir</button>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($oCheckLists as $oCheckList)
                                <tr>
                                    <td>{{$oCheckList->id}}</td>
                                    <td>{{$oCheckList->nome}}</td>
                                    <td>{{$oCheckList->descricao}}</td>
                                
                                    <td>
                                        <div class="btn-group">
                                            <button type="submit" id_usuario="{{$id_usuario}}" id_checklist="{{$oCheckList->id}}" id="button_delete" class="btn btn-danger btn-sm">Deletar</button> 
                                            <button type="button" class="btn btn-warning btn-sm" onclick="mostrarModal({{$id_usuario}}, {{$oCheckList->id}})">Alterar</button>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="consultaAtividades({{$oCheckList->id}})">Atividades</button>
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
<script>

    function mostrarModal(id_usuario, id_checklist) {
        let bAltera = id_checklist ? true : false;

        let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');

        oForm = document.createElement('form');
        oForm.setAttribute('usuario', id_usuario);
        oForm.setAttribute('id', 'formulario');
        oForm.setAttribute('checklist', id_checklist);

        oLabel = document.createElement('label');
        oLabel.setAttribute('for', 'nome');
        oLabel.innerHTML = 'Nome:';

        document.getElementById('staticBackdropLabel').innerHTML = bAltera ? 'Altere sua Checklist' : 'Cadastre sua Checklist';

        oInput = document.createElement('input');
        oInput.setAttribute('type', 'text');
        oInput.setAttribute('name', 'nome');
        oInput.setAttribute('id', 'nome');
        oInput.setAttribute('class', 'form-control');
        oInput.setAttribute('placeholder', 'Digite o Nome da CheckList');

        oLabelDescricao = document.createElement('label');
        oLabelDescricao.setAttribute('for', 'descricao');
        oLabelDescricao.innerHTML = 'Descrição:';

        oDescricao = document.createElement('textarea');
        oDescricao.setAttribute('id', 'descricao');
        oDescricao.setAttribute('name', 'descricao');
        oDescricao.setAttribute('class', 'form-control');

        if (bAltera) {
            preencheInformacoesFormulario(id_usuario, id_checklist);
        }

        oDivAtividades = document.createElement('div');
        oDivAtividades.setAttribute('id', 'atividades');

        oLabelAtividades = document.createElement('label');
        oLabelAtividades.setAttribute('for', 'atividades');
        oLabelAtividades.innerHTML = 'Atividade:';

        oAtividade = document.createElement('input');
        oAtividade.setAttribute('type', 'text');
        oAtividade.setAttribute('name', bAltera ? 'descricao' : 'descricao[]');
        oAtividade.setAttribute('class', 'form-control');
        oAtividade.setAttribute('placeholder', 'Digite a atividade');
        oAtividade.required  = true;

        if (!bAltera) {
            oAtividade.setAttribute('id', getQuantidadeAtividade() == 0 ? 1 : getQuantidadeAtividade());
        } else {
            oAtividade.setAttribute('id', 'descricao');
        }

        if (!bAltera) {
            oAdd = document.createElement('input');
            oAdd.setAttribute('type', 'button');
            oAdd.setAttribute('class', 'btn btn-success');
            oAdd.value = 'Adicionar';
            oAdd.setAttribute('onclick', 'adicionarAtividade()');
        }

        oDivAtividades.appendChild(oLabelAtividades);
        oDivAtividades.appendChild(oAtividade);

        oSubmit = document.createElement('input');
        oSubmit.setAttribute('type', 'submit');
        oSubmit.setAttribute('id', bAltera ? 'button_update' : 'checklist');
        oSubmit.setAttribute('value', bAltera ? 'Alterar': 'Cadastrar');
        oSubmit.setAttribute('class', 'btn btn-primary');
        oSubmit.style.marginTop = '50px';
        oSubmit.style.marginLeft = '40%';

        oForm.appendChild(oLabel);
        oForm.appendChild(oInput);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oLabelDescricao);
        oForm.appendChild(oDescricao);
        oForm.appendChild(document.createElement('br'));

        if (!bAltera) {
            oForm.appendChild(oDivAtividades);
            oForm.appendChild(document.createElement('br'));
            oForm.appendChild(oAdd);
            oForm.appendChild(document.createElement('br'));
        }

        oForm.appendChild(oSubmit);

        conteudo.appendChild(oForm);

        newModal = new bootstrap.Modal(oModal).show();
        newModal.show();
    }

    
    function preencheInformacoesFormulario(id_usuario, id_checklist) {
        $.ajax({
            url: '/api/check_list_js/'+id_checklist+'/'+id_usuario,
            type: 'GET',
            success: function(result) {
                if(result) {
                    console.log(result);
                    document.getElementById('nome').value = result.nome;
                    document.getElementById('descricao').value = result.descricao;
                };
            }
        });
    }

    function consultaAtividades(iCheckList) {
        window.location.href = 'http://localhost:8000/check_list_atividade/'+iCheckList;
    }

    function fechar() {
        let modal = document.getElementById('modal');
        modal.style.display = 'none';

        oModal = document.getElementById('conteudo_modal');

        while (oModal.firstChild) {
            oModal.removeChild(oModal.lastChild);
        }
    }

    function getQuantidadeAtividade() {
        return document.getElementsByName("descricao[]").length;
    }

    function adicionarAtividade() {
        var oInput = document.createElement("input"),
            oBr = document.createElement("br");

        oInput.setAttribute('name', 'descricao[]');
        oInput.setAttribute('type', 'text');
        oInput.setAttribute('class', 'form-control');
        oInput.setAttribute('placeholder', 'Digite a atividade');
        oInput.setAttribute('id', getQuantidadeAtividade()+1); 
        oInput.required  = true;

        document.getElementById("atividades").appendChild(oBr);
        document.getElementById("atividades").appendChild(oInput);
    }
</script>

@yield('javaScript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="{{ URL::asset('/js/check_list/maintenance.js')}}"></script>