@include("header")
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card mt-5">
                    <h1 style="text-align: center">Cadastre sua CheckList</h1>
                    <article class="card-body">
                        <form method="POST" action="{{route('check_list.store')}}">
                        {!! csrf_field() !!}
                  
                  

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom15">Nome</label>
                                    <input name="nome" type="text" class="form-control" placeholder="Digite o Nome da CheckList">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom15">Descrição</label>
                                    <textarea name="descricao" class="form-control"></textarea>
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


