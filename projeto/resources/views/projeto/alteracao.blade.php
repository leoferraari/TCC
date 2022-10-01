@include("header")
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card mt-5">
                    <h1 style="text-align: center">Altere seu Projeto</h1>
                    <article class="card-body">
                        <form method="POST" id="form" action="{{route('projeto/update', ['iProjeto' => $oProjeto->id])}}">
                        {!! csrf_field() !!}
                                    
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom1">Nome</label>
                                    <input name="nome" type="text" class="form-control" id="validationCustom1" value="{{$oProjeto->nome}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom2">Descrição</label>
                                    <textarea name="descricao" id="validationCustom2" class="form-control">{{$oProjeto->descricao}}</textarea>
                                </div>
                            </div>
           
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom3">Nome Cliente</label>
                                    <input type="text" name="nome_cliente" id="validationCustom3" class="form-control" value="{{$oProjeto->nome_cliente}}"></input>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom4">E-mail Cliente</label>
                                    <input type="email" name="email_cliente" class="form-control" id="validationCustom4" value="{{$oProjeto->email_cliente}}"></input>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom11">Número Celular</label>
                                    <input name="numero_tel_cliente" type="tel"  class="form-control" id="validationCustom11" value="{{$oProjeto->numero_tel_cliente}}">
                                </div>
                            </div>
                    

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom6">Data Atendimento</label>
                                    <input name="data_hora_atendimento" type="date" class="form-control" id="validationCustom6" value="{{$oProjeto->data_hora_atendimento}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom7">Prazo Final</label>
                                    <input name="prazo_final" type="date" class="form-control" id="validationCustom7" value="{{$oProjeto->prazo_final}}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom7">Data Conclusão</label>
                                    <input name="data_conclusao" type="date" class="form-control" id="validationCustom7" value="{{$oProjeto->data_conclusao}}" disabled>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                <label>CheckList</label>
                                    <select class="form-control" name="id_checklist" id="id_checklist" required value="{{old('id')}}">
                                        <option value="0">Selecione...</option>
                                        @foreach($oCheckListUsuario as $oCheckList)
                                            <option value="{{$oCheckList->id}}">{{$oCheckList->nome}}</option>
                                        @endforeach
                                    </select>
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
                                    <select class="custom-select" id="municipio" name="municipio" onchange="onChangeMunicipio()"  required>
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
                                    <label for="validationCustom8">Projeto Terceirizado:</label>
                                    @if ($oProjeto->id_terceirizado)
                                        <input id_terceirizado="{{$oProjeto->id_terceirizado}}" onclick="projetoTerceirizado({{$iUsuario}})" type="checkbox" id="is_terceirizado" name="is_terceirizado" checked>
                                    @endif

                                    @if (!$oProjeto->id_terceirizado)
                                        <input onclick="projetoTerceirizado({{$iUsuario}})" type="checkbox" id="is_terceirizado" name="is_terceirizado">
                                    @endif
                        
                                </div>

                                <div class="col-md-6 mb-3" id="div_terceirizado">
                        
                                </div>
                            </div>
                            
                            <div id="buttonEnviar" class="col-md-12 mb-3">
                                <button class="btn btn-primary" type="submit">Alterar</button>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>


        @yield('javaScript')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>

            (function() {


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
                
                    projetoTerceirizado('{{$iUsuario}}', true);

                    if('{{$oProjeto->id_checklist}}') {
                        var aCheckList = document.getElementById('id_checklist');
                            for (var index = 0; index < aCheckList.length; index++) {
                                if (aCheckList.options[index].attributes.value.value == '{{$oProjeto->id_checklist}}') {
                                    aCheckList.options[index].setAttribute('selected', true)
                                }
                            }    
                    } 
                }, false);
            })();

            function onChangeMunicipio() {
                var bMunicipioPreenchido = document.getElementById("municipio").value != '';
                document.getElementById("is_terceirizado").disabled = !bMunicipioPreenchido;

                if(!bMunicipioPreenchido) {
                    document.getElementById("is_terceirizado").checked = false;
                    projetoTerceirizado('{{$iUsuario}}');
                }
            }

            function projetoTerceirizado(id_user, bAlteracao = false) {
                if (document.getElementById("is_terceirizado").checked) {
                    adicionaCampoTerceirizado();
                    carregaCampoTerceirizado(id_user, bAlteracao);  
                } else {
                    document.getElementById('teste').remove();
                    document.getElementById('label_terceirizado').remove();
                }
            }

            function adicionaCampoTerceirizado() {
                let oDivTerceirizado = document.getElementById('div_terceirizado'),
                    oLabelSelect = document.createElement("label");
                    oSelect = document.createElement("select");

                oLabelSelect.setAttribute('for', 'validationCustom3');
                oLabelSelect.setAttribute('id', 'label_terceirizado');
                oLabelSelect.innerHTML = 'Profissional:';

                oSelect.setAttribute('name', 'id_terceirizado');
                oSelect.setAttribute('id', 'teste');
                oSelect.setAttribute('class', 'form-control');

                oDivTerceirizado.appendChild(oLabelSelect);
                oDivTerceirizado.appendChild(oSelect);
            }
            
            function carregaCampoTerceirizado($id_user, bAlteracao = false) {
                $.ajax({
                    url: '/api/cidade_atendimento/'+document.getElementById("municipio").value+'/'+$id_user,
                    type: 'GET',
                    success: function(result) {
                        if(result) {
                            result.forEach(element => {
                                const oOption = document.createElement('option'),
                                      oSelect = document.getElementById('teste');
                                                
                                oOption.setAttribute('value', element.id);
                                oOption.innerHTML =  element.nome;

                                oSelect.appendChild(oOption);
                            });
                        };
                    },
                    complete: function(xhr, textStatus) {
                        if(bAlteracao) {
                            var aTerceirizados = document.getElementById('teste');
                   
                            for (var index = 0; index < aTerceirizados.length; index++) {
                                if (aTerceirizados.options[index].attributes.value.value == document.getElementById('is_terceirizado').getAttribute('id_terceirizado')) {
                            
                                    aTerceirizados.options[index].setAttribute('selected', true)
                                }
                            }    
                        } 
                    }   
                });
            }

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
                    async: false,
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
        </script>


@yield('javaScript')
<script type="module" src="{{ URL::asset('/js/projeto/maintenance.js')}}"></script>