@include("header")
   
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card mt-5">
                    <h1 style="text-align: center">Cadastre a Atividade</h1>
                    <article class="card-body">
                        <form method="POST" action="{{route('check_list_atividade.store')}}">
                        {!! csrf_field() !!}
                  
                  
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                <label>CheckList</label>
                                    <select class="form-control" name="id_checklist" required value="{{old('id')}}">
                                        @foreach($oCheckListUsuario as $oCheckList)
                                            <option value="{{$oCheckList->id}}">{{$oCheckList->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3" id="atividades">
                                    <label for="validationCustom2">Atividades</label>
                                    <input name="descricao[]" type="text" class="form-control" placeholder="Digite a atividade">
                                </div>
                            </div>

                            <div onclick="adicionarAtividade()" style="background-color: red" id="addAtividade" class="row mx-3 my-2">
                                <p>Adicionar Atividade</a>
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
        <script>
            function adicionarAtividade() {

                var oInput = document.createElement("input"),
                    oBr = document.createElement("br");
                
                oInput.setAttribute('name', 'descricao[]');
                oInput.setAttribute('type', 'text');
                oInput.setAttribute('class', 'form-control');
                oInput.setAttribute('placeholder', 'Digite a atividade');

        
                document.getElementById("atividades").appendChild(oBr);
                document.getElementById("atividades").appendChild(oInput)
            }
            </script>

