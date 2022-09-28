@include("header")

        <div class="container">

            <div class="d-flex justify-content-center align-items-center">
 
                <div class="card mt-5">
                <div style="background-color: black">
                    <ul class="nav__list" id="nav_perfil">
                        <li>
                            <button type="button" class="btn btn-secondary btn-sm"> <a href="{{route('check_list')}}" class="nav__link">CheckList's</a></button>
                        </li>

                        @if ($oUsuario->permite_projeto_terceirizado)
                            <li id="nav_atendimento">
                                <button type="button"  class="btn btn-secondary btn-sm"> <a href="{{route('usuario_atendimento.index')}}" class="nav__link">Atendimento</a></button>
                            </li>
                        @endif
                    </ul>
                </div>
                    <h1 style="text-align: center">Altere seu Cadastro</h1>
                    <article class="card-body">
                        <form method="POST" action="{{route('usuario/update', ['iCodigoUsuario' => $oUsuario->id])}}">
                        @csrf
                        @method("PUT")
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Primeiro nome</label>
                                    <input name="nome" type="text" class="form-control" id="validationCustom01" value="{{$oUsuario->nome}}" required>
                                    <!-- <div class="valid-feedback">
                                        Tudo certo!
                                    </div> -->
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="validationCustom02">Sobrenome</label>
                                    <input name="sobrenome" type="text" class="form-control" id="validationCustom02" value="{{$oUsuario->sobrenome}}"  required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom03">Apelido</label>
                                    <div class="input-group">
                                        <input name="apelido" type="text" class="form-control" id="validationCustom03" value="{{$oUsuario->apelido}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">E-mail</label>
                                    <input name="email" type="email" class="form-control" id="validationCustom04"  value="{{$oUsuario->email}}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom05">Data de Nascimento</label>
                                    <input name="data_nasc" type="date" class="form-control" id="validationCustom05" value="{{$oUsuario->data_nasc}}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom06">CPF</label>
                                    <input name="cpf" type="text" class="form-control" id="validationCustom06" value="{{$oUsuario->cpf}}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom09">CREA</label>
                                    <input name="crea" type="text" class="form-control" id="validationCustom09" value="{{$oUsuario->crea}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom10">Celular</label>
                                    <input name="celular" type="tel" class="form-control" id="validationCustom10" value="{{$oUsuario->celular}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom11">Telefone Fixo</label>
                                    <input name="telefone_fixo" type="tel"  class="form-control" id="validationCustom11" value="{{$oUsuario->telefone_fixo}}">
                                </div>
                            </div>

                        
                            <div class="form-row">
                                <div class="col-md-6 mb-3" >
                                    <label for="validationCustom12">Estado</label>
                                    <select class="custom-select" id="estado" onchange="getMunicipios()" name="estado" required>
                                        <option value="" selected>Selecione um Estado</option>
                                        @foreach ($oEstados as $estado) 
                                            <option codigoEstado="{{ $estado->id }}"  value="{{ $estado->sigla }}">{{ $estado->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3" id="div_cidade">
                                    <label id="label_municipio" for="validationCustom13">Cidade</label>
                                    <select class="custom-select" id="municipio" name="municipio" required>
                                    <option value="" selected>Selecione um Município</option>
                                        @foreach ($oMunicipios as $municipio) 
                                            <option value="{{ $municipio->id }}">{{ $municipio->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom14">Bairro</label>
                                    <input name="bairro" type="text" class="form-control" id="validationCustom14" value="{{$oEndereco->bairro}}" required>
                                </div>      
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom15">CEP</label>
                                    <input name="cep" type="text" class="form-control" id="validationCustom15" value="{{$oEndereco->cep}}" required>
                                </div>       
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom16">Número</label>
                                    <input name="numero_endereco" type="text" class="form-control" id="validationCustom16" value="{{$oEndereco->numero_endereco}}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom15">Complemento</label>
                                    <input name="complemento" type="text" class="form-control" id="validationCustom15" value="{{$oEndereco->complemento}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom8">Terceirizar projeto:</label>
                                    @if ($oUsuario->permite_projeto_terceirizado)
                                        <input type="checkbox" id="permite_projeto_terceirizado" name="permite_projeto_terceirizado" checked onchange="teste()">
                                    @endif

                                    @if (!$oUsuario->permite_projeto_terceirizado)
                                        <input type="checkbox" id="permite_projeto_terceirizado" name="permite_projeto_terceirizado" onchange="teste()">
                                    @endif

                               
                                </div>
                            </div>
                    
                            <div id="buttonEnviar" class="col-md-12 mb-3">
                                <button  class="btn btn-primary" type="submit">Alterar</button>
                            </div>
                        </form>


                        @yield('javaScript')
                        <script>
                            // Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
                            (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                    // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                                    var forms = document.getElementsByClassName('needs-validation');
                                    // Faz um loop neles e evita o envio
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                    form.addEventListener('submit', function(event) {
                                        if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                    });
                                }, false);

                                window.addEventListener('load', function() {
                                    var aEstados = document.getElementById('estado'),
                                        aMunicipios = document.getElementById('municipio');

                                    for (var index = 1; index < aEstados.length; index++) {
                                        if (aEstados.options[index].attributes.value.value == '{{$oEndereco->sigla}}') {      
                                            aEstados.options[index].setAttribute('selected', true)
                                        }
                                    }         
                                    
                                    for (var index = 1; index < aMunicipios.length; index++) {
                                        if (aMunicipios.options[index].attributes.value.value == '{{$oEndereco->cidade}}') {      
                                            aMunicipios.options[index].setAttribute('selected', true)
                                        }
                                    }            
                                    
                                    
                                }, false);
                            })();

                            function getMunicipios() {
                                var aEstados = document.getElementById('estado'),
                                    sEstadoSelecionado = document.getElementById('estado').value;

                       
                                for (var index = 1; index < aEstados.length; index++) {
                                
                                   if (aEstados.options[index].attributes.value.value == sEstadoSelecionado) {      
                                       var iCodigoEstado = aEstados.options[index].attributes.codigoEstado.value;
                                       break;
                                   }
                                }   
                          
                                $.ajax({
                                    url: '/api/cidades/'+iCodigoEstado,
                                    type: 'GET',
                                    success: function(result) {
                                        if(result) {
                                            document.getElementById('municipio').remove();
                                            document.getElementById('label_municipio').remove();

                                            let oDivCidade= document.getElementById('div_cidade'),
                                                oLabelSelect = document.createElement("label");
                                                oSelect = document.createElement("select");

                                                oLabelSelect.setAttribute('for', 'validationCustom3');
                                                oLabelSelect.setAttribute('id', 'label_municipio');
                                                oLabelSelect.innerHTML = 'Cidade:';

                                                oSelect.setAttribute('name', 'municipio');
                                                oSelect.setAttribute('id', 'municipio');
                                                oSelect.setAttribute('class', 'form-control');

                                            result.forEach(element => {
                                                const oOption = document.createElement('option');
                                                    
                                                oOption.setAttribute('value', element.id);
                                                oOption.innerHTML =  element.nome;

                                                oSelect.appendChild(oOption);
                                            });

                                            oDivCidade.appendChild(oLabelSelect);
                                            oDivCidade.appendChild(oSelect);
                                        };
                                    }
                                });
                            }


                            function teste() {
                                var oPermiteTerceirizacao = document.getElementById("permite_projeto_terceirizado"),
                                    oNavPerfil = document.getElementById('nav_perfil');

                                if (oPermiteTerceirizacao.checked) {
                                    let oItem = document.createElement("li"); //nav_atendimento
                                        oButton = document.createElement("button"),
                                        a = document.createElement('a'); 

                                        a.href = "{{route('usuario_atendimento.create')}}"; 
                                        a.setAttribute('class', 'nav__link');
                                        a.innerHTML = 'Atendimento';

                                        oItem.setAttribute('id', 'nav_atendimento');

                                        oButton.setAttribute('class', 'btn btn-secondary btn-sm');
                                        oButton.setAttribute('type', 'button');

                                        oButton.appendChild(a);

                                        oItem.appendChild(oButton);

                                        oNavPerfil.appendChild(oItem);
                
                                } else {
                                    document.getElementById('nav_atendimento').remove();
                                }
                            }
                        </script>
                    </article>
                </div>
            </div>
        </div>

