


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Especialidade do Médico') }}</div>
                    <div class="card-body">
                        <a href="{{route('usuario_atendimento.create')}}" class="btn btn-lg btn-success">Criar Especialidade do Médico</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <!-- VER -->
                                <tr>
                                    <th>Estado</th>
                                    <th>Cidade</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oUsuariosAtendimentos as $oUsuarioAtendimento)
                                    <tr>
                                        <td>{{$oUsuarioAtendimento->id_usuario}}</td>
                                        <td>{{$oUsuarioAtendimento->id_municipio}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <form action="{{route('usuario_atendimento.destroy', ['id_municipio'=>$oUsuarioAtendimento->id_municipio])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
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


