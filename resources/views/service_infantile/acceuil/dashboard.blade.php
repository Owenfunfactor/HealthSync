@extends('layouts.acceuil')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Acceuil</li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Patients </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                       <i class="fa fa-user" style="color: #74C0FC;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$childnumber}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Consultation</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa fa-user-doctor" style="color: #63E6BE;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$consultationnumber}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">


                <div class="card-body">
                  <h5 class="card-title">Diagnostic le plus courant</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa fa-stethoscope"></i>
                    </div>
                    <div class="ps-3">
                      <p>{{$mostCommonDiagnostic}}</p>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
                <div class="card">   
                    <div class="card-body">
                        <h5 class="card-title">Rapport <span>/Ce Mois-ci</span></h5>

                        <!-- Line Chart -->
                        <div id="reportsChart"></div>
                        <script>
                        $(document).ready(function() {
                              $.ajax({
                                  url: '{{ route("statistics") }}',
                                  method: 'GET',
                                  success: function(data) {
                                      const days = data.map(item => item.day);
                                      const childCounts = data.map(item => item.child_count);
                                      const consultationCounts = data.map(item => item.consultation_count);

                                      let options = {
                                          series: [
                                              {
                                                  name: 'Patients',
                                                  data: childCounts
                                              },
                                              {
                                                  name: 'Consultations',
                                                  data: consultationCounts
                                              }
                                          ],
                                          chart: {
                                              height: 350,
                                              type: 'line',
                                              toolbar: {
                                                  show: false
                                              }
                                          },
                                          colors: ['#4154f1', '#2eca6a'], // Bleu pour patients, Vert pour consultations
                                          xaxis: {
                                              categories: days,
                                              title: {
                                                  text: 'Jours du Mois'
                                              }
                                          },
                                          yaxis: {
                                              title: {
                                                  text: 'Nombre'
                                              }
                                          },
                                          stroke: {
                                              curve: 'smooth'
                                          },
                                          dataLabels: {
                                              enabled: false
                                          },
                                          fill: {
                                              type: "gradient",
                                              gradient: {
                                                shadeIntensity: 0.1,
                                                opacityFrom: 0.8,
                                                opacityTo: 0.6,
                                                stops: [0, 90, 100]
                                              }
                                          },
                                          tooltip: {
                                              shared: true,
                                              intersect: false
                                          }
                                      };

                                      let chart = new ApexCharts(document.querySelector("#reportsChart"), options);
                                      chart.render();
                                  },
                                  error: function(xhr, status, error) {
                                      console.error('Erreur de récupération des données:', error);
                                  }
                              });
                          });

                        </script>
                        <!-- End Line Chart -->

                    </div>
                </div>
            </div>

            <!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Les 10 derniers patients</h5>

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Age</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Profession</th>
                        <th scope="col">Adresse</th>
                        <th scope="col" class="text-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($children as $child)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($child->date_naissance)->format('Ymd') }}</td>
                                <td>{{ $child->nom }}</td>
                                <td>
                                  @if ($child->years > 0)
                                    {{ $child->years }} ans
                                    @else
                                    @if ($child->months > 0)
                                      {{ $child->months }} mois
                                    @endif
                                    @if ($child->days > 0)
                                      {{ $child->days }} jours
                                    @endif
                                  @endif
                                </td>
                                <td>{{ $child->sexe }}</td>
                                <td>{{ $child->profession }}</td>
                                <td>{{ $child->adresse }}</td>
                                <td>
                                  <div class="d-flex gap-2 w-100 justify-content-end">
                                      <a href="{{ route('child.download-qrcode', $child->id) }}" class="btn btn-secondary"><i class="fa fa-qrcode"></i></a>
                                      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$child->id}}">
                                        <i class="fa fa-eye"></i>
                                      </button>
                                      
                                      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal{{ $child->id }}">
                                        <i class="fa fa-user-doctor"></i>
                                      </button>
                                      @include('service_infantile.acceuil.create-modal')
                                      @include('service_infantile.acceuil.info_patient')
                                        <a href="{{ route('Service_Infantile.child.edit', $child) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('Service_Infantile.child.destroy', $child) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce patient ?');">
                                          @csrf
                                          @method('delete')
                                          <button class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>    
                                          </button>
                                        </form>
                                  </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->


          </div>
        </div><!-- End Left side columns -->

        

      </div>
    </section>

  </main><!-- End #main -->

@endsection

  

 