@include("header")
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="{{ asset('/styles.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  
    
    <title>@yield('titulo')</title>
  </head>

	<body>
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
   
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 mb-3" id="card_projeto" onclick="redirecionaConsultaProjeto(1, {{session('id_user')}})">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5" id="numero_projeto">  
                {{$aInfoProjetos[0]->numero_projetos}}
              </div>
              <div class="card-footer d-flex">
                1 - Pendente (Aguardando aceitação de terceiros)
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          @if($bPermiteTerceirizacao)
            <div class="col-md-3 mb-3" id="card_projeto" onclick="redirecionaConsultaProjeto(2, {{session('id_user')}})">
              <div class="card bg-dark text-white h-100">
                <div class="card-body py-5" id="numero_projeto">
                  {{$aInfoProjetos[1]->numero_projetos}}
                </div>
                <div class="card-footer d-flex">
                2- Pendente (Aguardando minha aceitação)
                  <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                  </span>
                </div>
              </div>
            </div>
          @endif

          <div class="col-md-3 mb-3" id="card_projeto" onclick="redirecionaConsultaProjeto(3, {{session('id_user')}})">
            <div class="card bg-info text-white h-100">
              <div class="card-body py-5" id="numero_projeto">
              {{$aInfoProjetos[2]->numero_projetos}}
              </div>
              <div class="card-footer d-flex">
                3 - Em Andamento
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3" id="card_projeto" onclick="redirecionaConsultaProjeto(4, {{session('id_user')}})">
            <div class="card bg-warning text-dark h-100">
              <div class="card-body py-5" id="numero_projeto">
                {{$aInfoProjetos[3]->numero_projetos}}
              </div>
              <div class="card-footer d-flex">
                4 - Em Alteração 
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3" id="card_projeto" onclick="redirecionaConsultaProjeto(5, {{session('id_user')}})">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5" id="numero_projeto">
                {{$aInfoProjetos[4]->numero_projetos}}
              </div>
              <div class="card-footer d-flex">
                5 - Cancelado
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3" id="card_projeto" onclick="redirecionaConsultaProjeto(6, {{session('id_user')}})">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5" id="numero_projeto"> 
                {{$aInfoProjetos[5]->numero_projetos}}
              </div>
              <div class="card-footer d-flex">
                6 - Concluído 
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3" id="card_projeto" onclick="redirecionaConsultaProjeto(7, {{session('id_user')}})">
            <div class="card bg-secondary text-white h-100">
              <div class="card-body py-5" id="numero_projeto">
              {{$aInfoProjetos[6]->numero_projetos}}
              </div>
              <div class="card-footer d-flex">
                7 - Recusado 
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          
        </div>
        </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    <script>
      function redirecionaConsultaProjeto(iCodigoSituacao, iUsuario) {
        window.location.href = 'http://localhost:8000/api/projeto/'+iCodigoSituacao+'/'+iUsuario;
      }
    </script>
  </body>
</html>
