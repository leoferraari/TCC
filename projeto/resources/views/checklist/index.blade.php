

@include("header")
    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
           
                    <div class="card-body">
                        <a href="{{route('check_list.create')}}" class="btn btn-lg btn-success">Adicionar</a>
                        <button type="button" onclick="criaFormulario({{$id_usuario}})" class="btn btn-info">Add JS</button>
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
                                                <button type="submit" id_usuario="{{$id_usuario}}" id_checklist="{{$oCheckList->id}}" id="button_delete" class="btn btn-outline-danger btn-sm">Deletar</button> 
                                                <button type="button" class="btn btn-warning btn-sm" onclick="criaFormulario({{$id_usuario}}, {{$oCheckList->id}})">Alterar</button>
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
    <div class="modal_leo">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function criaFormulario(id_usuario, id_checklist) {
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
        oForm = document.createElement('form');
        oForm.setAttribute('usuario', id_usuario);
        oForm.setAttribute('id', 'formulario');
        oForm.setAttribute('checklist', id_checklist);
        
        oH1.innerHTML = bAltera ? 'Alteração da CheckList': 'Cadastre sua CheckList';
        oH1.style.textAlign = 'center';

        oLabel = document.createElement('label');
        oLabel.setAttribute('for', 'nome');
        oLabel.innerHTML = 'Nome:';

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

        oSubmit = document.createElement('input');
        oSubmit.setAttribute('type', 'submit');
        oSubmit.setAttribute('id', bAltera ? 'button_update' : 'checklist');
        oSubmit.setAttribute('value', bAltera ? 'Alterar': 'Cadastrar');
        oSubmit.setAttribute('class', 'btn btn-primary');
        oSubmit.style.marginTop = '50px';
        oSubmit.style.marginLeft = '40%';
        
        oForm.appendChild(oH1);
        oForm.appendChild(oLabel);
        oForm.appendChild(oInput);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oLabelDescricao);
        oForm.appendChild(oDescricao);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oSubmit);

        oModal.appendChild(oForm);
        
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
        let modal = document.querySelector('.modal_leo');
        modal.style.display = 'none';
    }
</script>

@yield('javaScript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="{{ URL::asset('/js/check_list/maintenance.js')}}"></script>