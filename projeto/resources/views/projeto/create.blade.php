@include("header")
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card mt-5">
                    <h1 style="text-align: center">Cadastre seu Projeto</h1>
                    <article class="card-body">
                        <form method="POST" action="{{route('projeto.store')}}">
                        {!! csrf_field() !!}
                                    
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom1">Nome</label>
                                    <input name="nome" type="text" class="form-control" id="validationCustom1" placeholder="Digite o Nome do Projeto">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom2">Descrição</label>
                                    <textarea name="descricao" id="validationCustom2" class="form-control"></textarea>
                                </div>
                            </div>
           
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom3">Nome Cliente</label>
                                    <input type="text" name="nome_cliente" id="validationCustom3" class="form-control" placeholder="Digite o Nome do Cliente"></input>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom4">E-mail Cliente</label>
                                    <input type="email" name="email_cliente" class="form-control" id="validationCustom4" placeholder="Digite o e-mail do Cliente"></input>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom11">Número Celular</label>
                                    <input name="numero_tel_cliente" type="tel"  class="form-control" id="validationCustom11" placeholder="Digite seu número">
                                </div>
                            </div>

                            <!-- <div class="form-row">
                                <div class="col-md-12 mb-3">
                                <label for="validationCustom5">Situação</label>
                                    <select id="validationCustom5" class="form-control" name="situacao" required>
                                        <option value="1">Pendente</option>
                                        <option value="2">Em andamento</option>
                                        <option value="3">Em alteração</option>
                                        <option value="4">Cancelado</option>
                                        <option value="5">Concluído</option>
                                    </select>
                                </div>
                            </div> -->
                    

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom6">Data Atendimento</label>
                                    <input name="data_hora_atendimento" type="date" class="form-control" id="validationCustom6" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom7">Prazo Final</label>
                                    <input name="prazo_final" type="date" class="form-control" id="validationCustom7" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom7">Data Conclusão</label>
                                    <input name="data_conclusao" type="date" class="form-control" id="validationCustom7" disabled>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                <label>CheckList</label>
                                    <select class="form-control" name="id_checklist" required value="{{old('id')}}">
                                        <option value="0">Selecione...</option>
                                        @foreach($oCheckListUsuario as $oCheckList)
                                            <option value="{{$oCheckList->id}}">{{$oCheckList->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <livewire:dynamic-dropdown></livewire:dynamic-dropdown>
                        @livewireScripts

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom14">Bairro</label>
                                <input name="bairro" type="text" class="form-control" id="validationCustom14" placeholder="Bairro" required>
                            </div>      
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom15">CEP</label>
                                <input name="cep" type="text" class="form-control" id="validationCustom15" placeholder="CEP" required>
                            </div>       
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom16">Número</label>
                                <input name="numero_endereco" type="text" class="form-control" id="validationCustom16" placeholder="Número" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom15">Complemento</label>
                                <input name="complemento" type="text" class="form-control" id="validationCustom15" placeholder="Complemento">
                            </div>
                        </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom8">Projeto Terceirizado:</label>

                                    <input onclick="projetoTerceirizado({{$iUsuario}})" type="checkbox" id="is_terceirizado" name="is_terceirizado" disabled>
                                </div>

                                <div class="col-md-6 mb-3" id="div_terceirizado">
                        
                                </div>
                            </div>
                            
                            <div id="buttonEnviar" class="col-md-12 mb-3">
                                <button class="btn btn-primary" type="submit">Cadastrar</button>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>


        @yield('javaScript')
        <!-- <label for="validationCustom3">Profissional</label>
                                    <input type="text" name="id_terceirizado" id="validationCustom3" class="form-control"></input> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>

            function onChangeMunicipio() {
        
                var bMunicipioPreenchido = document.getElementById("municipio").value != '';
                document.getElementById("is_terceirizado").disabled = !bMunicipioPreenchido;

                if(!bMunicipioPreenchido) {
                    document.getElementById("is_terceirizado").checked = false;
                    projetoTerceirizado();
                }
            }

            function projetoTerceirizado($id_user) {
                if (document.getElementById("is_terceirizado").checked) {
                    adicionaCampoTerceirizado();
                    carregaCampoTerceirizado($id_user);   
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
            
            function carregaCampoTerceirizado($id_user) {
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
                    }
                });
            }
        </script>


@yield('javaScript')
<script type="module" src="{{ URL::asset('/js/projeto/maintenance.js')}}"></script>