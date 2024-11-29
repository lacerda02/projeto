@extends('/main')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">


        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">

                  <h6 class="font-weight-normal mb-0">Estamos felizes por te ter de volta. Voc tem <span class="text-primary">3 mensagens não lidas!</span></h6>
                 

                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> Hoje ({{ now()->format('d M Y') }})
                      </button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{asset('assets/images/dashboard/people.svg')}}" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>27<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Chibuto</h4>
                        <h6 class="font-weight-normal">Mozambique</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                      <div class="card-body">
                          <p class="mb-4">Total de Denúncias Anônimas</p>
                          <p class="fs-30">{{ $totalDenunciasAnonimas }}</p>
                      </div>
                  </div>
              </div>
      
              <!-- Total de Denúncias Fáceis -->
              <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                      <div class="card-body">
                          <p class="mb-4">Total de Denúncias Facíl</p>
                          <p class="fs-30">{{ $totalDenunciasFacil }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <!-- Total de Usuários -->
              <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                      <div class="card-body">
                          <p class="mb-4">Total de Usuários</p>
                          <p class="fs-30">{{ $totalUsuarios }}</p>
                      </div>
                  </div>
              </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

    </div>

    </div>
  </div>


@endsection

