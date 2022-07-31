

@include("header")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
           
                    <div class="card-body">
                        <a href="{{route('check_list.create')}}" class="btn btn-lg btn-success">Adicionar</a>
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


