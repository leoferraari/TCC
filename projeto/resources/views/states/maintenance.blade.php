@extends('templates.layouts.master')

@section('content')

<div class="card text-center">

    <header class="card-header row justify-content-center">
        @if ($route === 'create')
            <h2> Cadastrando Estado </h2>
        @elseif ($route === 'edit')
            <h2> Editando o Estado </h2>
        @elseif ($route === 'show')
            <h2> Visualizando o Estado </h2>
        @endif
    </header>

    <main class="card-body row justify-content-center mt-3">

        <section class="col-10 col-sm-12 col-md-8 col-lg-8">

            <div class="form-row justify-content-center">

                @if ($route !== 'create')
                    <div class="form-group col-sm-8 col-md-10 col-lg-8">

                        <label for="id"> Código: </label>
                        <input type="text"
                            class="form-control"
                            id="id"
                            name="id"
                            placeholder="Código"
                            value=""
                            disabled
                        >

                    </div>
                @endif
            </div>

            <div class="form-row justify-content-center">

                <div class="form-group col-sm-8 col-md-10 col-lg-8">

                    <label for="name"> Nome: </label>
                    <input type="text"
                        class="form-control was-validated"
                        id="name"
                        name="name"
                        placeholder="Nome"
                        data-required="true"
                        @if ($route !== 'create') value="" @endif
                        @if ($route === 'show') disabled @endif
                    >
                </div>
            </div>

            <div class="form-row justify-content-center">

                <div class="form-group col-sm-8 col-md-10 col-lg-8">

                    <label for="initials"> Sigla: </label>
                    <input type="text"
                        class="form-control"
                        id="initials"
                        name="initials"
                        maxlength="2"
                        placeholder="Sigla"
                        data-required="false"
                        @if ($route !== 'create') value="" @endif
                        @if ($route === 'show') disabled @endif
                    >

                </div>

            </div>


            @if ($route !== 'show')
                <div class="form-row justify-content-center">

                    @if ($route === 'create')
                        <input type="submit"
                            value="Adicionar"
                            id="store-state"
                            class="btn btn-primary col-sm-8 col-md-10 col-lg-8 py-2"
                        >

                    @elseif ($route === 'edit')

                        <a href="#modalUpdate"
                            class="btn btn-primary col-sm-8 col-md-10 col-lg-8 py-2 mt-1"
                            data-toggle="modal"
                            data-target="#modalUpdate"
                        >
                            Atualizar
                        </a>

                        <x-modals.update element="registro" article="o" />
                    @endif

                </div>
            @endif

            <div class="form-row justify-content-center">

                <a href="#" onclick="goBack()" class="btn btn-danger col-sm-8 col-md-10 col-lg-8 py-2 mt-1">
                    Voltar
                </a>

            </div>

        </section>

    </main>
</div>
@endsection()

@section('javascript')
    <script type="module" src="{{ URL::asset('/js/states/maintenance.js')}}"></script>
@endsection


