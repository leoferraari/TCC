


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
                    <button type="button" onclick="mostrarModal({{$iProjeto}})" class="btn btn-info">Incluir Arquivo</button>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descrição</th>
                                    <th>Endereço URL</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aArquivos as $aArquivo)
                                    <tr>
                                        <td>{{$aArquivo->id}}</td>
                                        <td>{{$aArquivo->descricao}}</td>
                                        <td>{{$aArquivo->endereco_url}}</td>
                                        <td>
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-sm" onclick="mostrarModal({{$iProjeto}}, {{$aArquivo->id}})">Alterar</button>
                                             <button type="submit" id_projeto="{{$iProjeto}}" id_arquivo="{{$aArquivo->id}}" id="button_delete" class="btn btn-danger btn-sm">Deletar</button> 
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

    function mostrarModal(id_projeto, id_arquivo = null) {
        let oModal = document.getElementById('modal'),
            conteudo = document.getElementById('conteudo_modal');
        let bAltera = id_arquivo ? true : false;

        oForm = document.createElement('form');
        oForm.setAttribute('id_projeto', id_projeto);
        oForm.setAttribute('id_arquivo', id_arquivo);
        oForm.setAttribute('id', 'formulario');

        oLabelProjeto = document.createElement('label');
        oLabelProjeto.setAttribute('for', 'id_projeto');
        oLabelProjeto.innerHTML = 'Projeto:';

        oProjeto = document.createElement('input');
        oProjeto.setAttribute('type', 'text');
        oProjeto.setAttribute('name', 'id_projeto');
        oProjeto.setAttribute('id', 'id_projeto');
        oProjeto.setAttribute('class', 'form-control');
        oProjeto.setAttribute('disabled', 'true');
        oProjeto.value = id_projeto;

        oLabel = document.createElement('label');
        oLabel.setAttribute('for', 'nome');
        oLabel.innerHTML = 'Nome:';

        document.getElementById('staticBackdropLabel').innerHTML = bAltera ? 'Altere o Arquivo' : 'Cadastre seu Arquivo';

        oLabelDescricao = document.createElement('label');
        oLabelDescricao.setAttribute('for', 'descricao');
        oLabelDescricao.innerHTML = 'Descrição:';

        oDescricao = document.createElement('textarea');
        oDescricao.setAttribute('id', 'descricao');
        oDescricao.setAttribute('name', 'descricao');
        oDescricao.setAttribute('class', 'form-control');

        oLabel = document.createElement('label');
        oLabel.setAttribute('for', 'endereco');
        oLabel.innerHTML = 'Endereço URL:';

        oInput = document.createElement('input');
        oInput.setAttribute('type', 'text');
        oInput.setAttribute('name', 'endereco_url');
        oInput.setAttribute('id', 'endereco_url');
        oInput.setAttribute('class', 'form-control');
        oInput.setAttribute('placeholder', 'Endereço do arquivo');

        if (bAltera) {
            preencheInformacoesFormulario(id_arquivo, id_projeto);
        }

        oSubmit = document.createElement('input');
        oSubmit.setAttribute('type', 'submit');
        oSubmit.setAttribute('id', bAltera ? 'button_update' : 'arquivo_projeto');
        oSubmit.setAttribute('value', bAltera ? 'Alterar': 'Cadastrar');
        oSubmit.setAttribute('class', 'btn btn-primary');
        oSubmit.style.marginTop = '50px';
        oSubmit.style.marginLeft = '40%';

        oForm.appendChild(oLabelProjeto);
        oForm.appendChild(oProjeto);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oLabel);
        oForm.appendChild(oInput);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oLabelDescricao);
        oForm.appendChild(oDescricao);
        oForm.appendChild(document.createElement('br'));

        oForm.appendChild(oSubmit);

        conteudo.appendChild(oForm);

        newModal = new bootstrap.Modal(oModal).show();
        newModal.show();
    }

    function preencheInformacoesFormulario(id_arquivo, id_projeto) {
        $.ajax({
            url: '/api/arquivo_projeto/'+id_arquivo+'/'+id_projeto,
            type: 'GET',
            success: function(result) {
                if(result) {
                    document.getElementById('id_projeto').value = result.id_projeto;
                    document.getElementById('endereco_url').value = result.endereco_url;
                    document.getElementById('descricao').value = result.descricao;
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
<script type="module" src="{{ URL::asset('/js/arquivo_projeto/maintenance.js')}}"></script>