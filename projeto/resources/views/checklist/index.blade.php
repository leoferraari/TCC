

@include("header")
    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
           
                    <div class="card-body">
                        <a href="{{route('check_list.create')}}" class="btn btn-lg btn-success">Adicionar</a>
                        <button type="button" onclick="testeForm({{$id_usuario}})" class="btn btn-info">Add JS</button>
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
                                @foreach($oCheckLists as $oCheckList)
                                    <tr>
                                        <td>{{$oCheckList->id}}</td>
                                        <td>{{$oCheckList->nome}}</td>
                                        <td>{{$oCheckList->descricao}}</td>
                                   
                                        <td>
                                            <div class="btn-group">
                                                <form action="{{route('check_list.destroy', ['iCodigoCheckList'=>$oCheckList->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                                </form>

                                                <form action="{{route('check_list_atividade', ['iCodigoCheckList'=>$oCheckList->id])}}" method="POST">
                                                    @csrf
                                                    @method('GET')
                                                    <button type="submit" class="btn btn-sm btn-primary">Atividades</button>
                                                </form>
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

    <div class="mensagemTeste">
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function testeForm(id_usuario, id) {
        let bAltera = id ? true : false;

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
        oForm.setAttribute('id', 'formLogin');
        // oForm.setAttribute('onsubmit', bAltera ? 'alterarTimeCampeonato('+id+')' : 'cadastrarTimeCampeonato()');
        // oForm.setAttribute('action', "{{route('check_list.store')}}");
        

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

        oLabelCampeonato = document.createElement('label');
        oLabelCampeonato.setAttribute('for', 'descricao');
        oLabelCampeonato.innerHTML = 'Descrição:';

        oCampeonato = document.createElement('textarea');
        // oCampeonato.setAttribute('type', 'textarea');
        oCampeonato.setAttribute('id', 'descricao');
        oCampeonato.setAttribute('name', 'descricao');
        oCampeonato.setAttribute('class', 'form-control');


        if (bAltera) {
            oInput.value = id_campeonato;
            oCampeonato.value = id_time;
        }

        oSubmit = document.createElement('input');
        oSubmit.setAttribute('type', 'submit');
        oSubmit.setAttribute('id', 'checklist');
        oSubmit.setAttribute('value', bAltera ? 'Alterar': 'Cadastrar');
        oSubmit.setAttribute('class', 'btn btn-primary');
        oSubmit.style.marginTop = '50px';
        oSubmit.style.marginLeft = '40%';
        
        oForm.appendChild(oH1);
        oForm.appendChild(oLabel);
        oForm.appendChild(oInput);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oLabelCampeonato);
        oForm.appendChild(oCampeonato);
        oForm.appendChild(document.createElement('br'));
        oForm.appendChild(oSubmit);

        oModal.appendChild(oForm);
        
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
<script type="module" src="{{ URL::asset('/js/cities/maintenance.js')}}"></script>