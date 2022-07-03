@extends('templates.layouts.master')

@section('content')

<div class="card text-center">
    <header class="card-header row justify-content-center">
        <h1>Estados</h1>
    </header>
    <main class="card-body row justify-content-center mt-3">
        <div class="col-10 col-sm-10 col-md-10 col-lg-10 mt-4">
            <table id="data-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <td scope="col"> Código </td>
                        <td scope="col"> Nome </td>
                        <td scope="col"> Sigla </td>
                        <td scope="col"> Menu </td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="form-row justify-content-center">
                <a href="{{route('states.create')}}" class="col-6 btn btn-primary"> Cadastrar </a>
            </div>
        </div>

       
    </main>
</div>

@endsection()

@section('javascript')
    <script type="module" src="{{ URL::asset('/js/states/datatable.js')}}"></script>
    <script type="module" src="{{ URL::asset('/js/states/maintenance.js')}}"></script>
@endsection
