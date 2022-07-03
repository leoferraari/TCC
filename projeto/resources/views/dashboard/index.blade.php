@extends('templates.layouts.master')

    @section('content')

        <main class="d-flex justify-content-between">
            @include('templates.layouts.aside')
            <div class="col-10 d-flex flex-column">
                <section id="sectionTable">
                    <table id="data-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <td scope="col"> Código </td>
                                <td scope="col"> Nome </td>
                                <td scope="col"> Franquia </td>
                                <td scope="col"> Cidade </td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script><script src="./assets/js/script.js"></script></body>
        <script type="module" src="{{ URL::asset('/js/index/datatable.js')}}"></script>

    @endsection

    @section('javaScript')
    <script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="./node_modules/popper.js/dist/popper.min.js"></script>
    <script src="./node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        });
    </script>
@endsection
