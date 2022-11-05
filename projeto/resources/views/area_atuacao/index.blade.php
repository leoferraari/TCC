


@include("header")
<div class="container">
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
              
                                    
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom1">Nome</label>
                                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Digite o Nome do Arquiteto">
                                </div>
                            </div>

                            <livewire:dynamic-dropdown></livewire:dynamic-dropdown>
                            @livewireScripts

                            
                            <div id="buttonEnviar" class="col-md-12 mb-3">
                                <button class="btn btn-primary" onclick="redirecionaFiltroAtuacao()" type="submit">Filtrar</button>
                            </div>
              
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Celular</th>
                                    <th>E-mail</th>
                                    <th>Município</th>
                                    <th>Estado</th>
                                    <th>Sigla</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aAreas as $oAreaAtuacao)
                                    <tr>
                                        <td>{{$oAreaAtuacao->nome}}</td>
                                        <td>{{$oAreaAtuacao->celular}}</td>
                                        <td>{{$oAreaAtuacao->email}}</td>
                                        <td>{{$oAreaAtuacao->municipio}}</td>
                                        <td>{{$oAreaAtuacao->estado_nome}}</td>
                                        <td>{{$oAreaAtuacao->estado_sigla}}</td>
                                        <td>
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm" onclick="visualizarInfoArquiteto({{$oAreaAtuacao->codigo_usuario}})">+ Informações</button>
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

function visualizarInfoArquiteto(iArquitetoTerceirizado) {
       
       let oModal = document.getElementById('modal'),
       conteudo = document.getElementById('conteudo_modal');

       document.getElementById('staticBackdropLabel').innerHTML = 'Informações do Arquitet';

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
       oLabelCelular.innerHTML = 'Telefone Fixo:';
    
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

    function redirecionaFiltroAtuacao() { 
        debugger;
        var sNome = document.getElementById('nome').value ? document.getElementById('nome').value : null; 
        var iMunicipio = document.getElementById('municipio').value ? document.getElementById('municipio').value : null;

        window.location.href = 'http://localhost:8000/area_atuacao/search/'+iMunicipio+'/'+sNome;
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