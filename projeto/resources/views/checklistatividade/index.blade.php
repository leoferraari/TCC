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
                        <button type="button" onclick="criaFormulario({{$iCodigoCheckList}})" class="btn btn-info">Adicionar Atividade</button>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($oAtividades as $oAtividade)
                                     @isset($oAtividade->id)
                                    <tr>
                                        <td>{{$oAtividade->id}}</td>
                                        <td>{{$oAtividade->descricao}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-warning btn-sm" onclick="criaFormulario({{$iCodigoCheckList}}, {{$oAtividade->id}}, true)">Alterar</button>
                                                <button type="submit" check_list="{{$iCodigoCheckList}}" atividade="{{$oAtividade->id}}" id="button_delete" class="btn btn-outline-danger btn-sm">Deletar</button> 
                                            </div>
                                        </td>
                                    </tr>
                                    @endisset
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
    function criaFormulario(id_checklist, id_atividade = null, bAlteracao = false) {
        let bAltera = bAlteracao;

        let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');

        document.getElementById('staticBackdropLabel').innerHTML = bAltera ? 'Altere a Atividade' : 'Cadastre a(s) atividade(s)';

        oForm = document.createElement('form');
        oForm.setAttribute('id', 'formulario');
        oForm.setAttribute('atividade', id_atividade);
        
        oLabel = document.createElement('label');
        oLabel.setAttribute('for', 'id_checklist');
        oLabel.innerHTML = 'CheckList:';

        oInput = document.createElement('input');
        oInput.setAttribute('type', 'text');
        oInput.setAttribute('name', 'id_checklist');
        oInput.setAttribute('id', 'id_checklist');
        oInput.setAttribute('class', 'form-control');
        oInput.setAttribute('disabled', 'true');
        oInput.value = id_checklist;

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

        if (!bAltera) {
            oAtividade.setAttribute('id', getQuantidadeAtividade() == 0 ? 1 : getQuantidadeAtividade());
        } else {
            oAtividade.setAttribute('id', 'descricao');
        }

        oDivAtividades.appendChild(oLabelAtividades);
        oDivAtividades.appendChild(oAtividade);

        if (!bAlteracao) {
            oAdd = document.createElement('input');
            oAdd.setAttribute('type', 'button');
            oAdd.setAttribute('class', 'btn btn-success');
            oAdd.value = 'Adicionar';
            oAdd.setAttribute('onclick', 'adicionarAtividade()');
        }

        if (bAltera) {
            preencheInformacoesFormulario(id_checklist, id_atividade);
        }

        oSubmit = document.createElement('input');
        oSubmit.setAttribute('type', 'submit');
        oSubmit.setAttribute('id', bAltera ? 'button_update' : 'check_list_atividade');
        oSubmit.setAttribute('value', bAltera ? 'Alterar': 'Cadastrar');
        oSubmit.setAttribute('class', 'btn btn-primary');
        oSubmit.style.marginTop = '50px';
        oSubmit.style.marginLeft = '40%';
        
        oForm.appendChild(oLabel);
        oForm.appendChild(oInput);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oDivAtividades);
        oForm.appendChild(document.createElement('br'));

        if (!bAlteracao) {
            oForm.appendChild(oAdd);
            oForm.appendChild(document.createElement('br'));
        }
        oForm.appendChild(oSubmit);

        conteudo.appendChild(oForm);

        newModal = new bootstrap.Modal(oModal).show();
        newModal.show();

    }

    function preencheInformacoesFormulario(id_checklist, id_atividade) {
        $.ajax({
            url: '/api/check_list_atividade/'+id_checklist+'/'+id_atividade,
            type: 'GET',
            success: function(result) {
                if(result) {
                    console.log(result.descricao);
                    document.getElementById('id_checklist').value = result.id_checklist;
                    document.getElementById('descricao').value = result.descricao;
                };
            }
        });
    }

    function adicionarAtividade() {
        var oInput = document.createElement("input"),
            oBr = document.createElement("br");

            oInput.setAttribute('name', 'descricao[]');
            oInput.setAttribute('type', 'text');
            oInput.setAttribute('class', 'form-control');
            oInput.setAttribute('placeholder', 'Digite a atividade');
            oInput.setAttribute('id', getQuantidadeAtividade()+1); 

            document.getElementById("atividades").appendChild(oBr);
            document.getElementById("atividades").appendChild(oInput)
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
</script>

    @yield('javaScript')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{ URL::asset('/js/check_list_atividade/maintenance.js')}}"></script>


