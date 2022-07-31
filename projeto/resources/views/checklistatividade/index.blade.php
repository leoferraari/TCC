

@include("header")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
           
                    <div class="card-body">
                        <a href="{{route('check_list_atividade.create', ['iCodigoCheckList'=>$iCodigoCheckList])}}" class="btn btn-lg btn-success">Adicionar</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <!-- VER -->
                                <tr>
                                    <th>CheckList</th>
                                    <th>Código</th>
                                    <th>Descrição</th>
                                    <th>Açõess</th>
                                </tr>
                                </thead>
                                <tbody>
                           
                                @foreach($oAtividades as $oAtividade)
                                     @isset($oAtividade->id)
                                    <tr>
                                   
                                        <td>{{$oAtividade->id}}</td>
                                        <td>{{$oAtividade->descricao}}</td>
                                   
                                        <td>
                                            <div class="btn-group">
                                                <form action="{{route('checklist_atividade.destroy', ['iCodigoCheckList'=>$oAtividade->id_checklist, $iCodigoAtividade => $oAtividade->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endisset
                                @endforeach
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


