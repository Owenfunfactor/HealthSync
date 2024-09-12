@extends('layouts.acceuil')

@section('content')

<main id="main" class="main">

@if(session('status'))
  <div class="alert alert-success" id="status-alert">
    {{ session('status') }}
  </div>
@endif

    <div class="pagetitle">
      <h1>Vos patients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Pédiatrie</li>
          <li class="breadcrumb-item active">Vos patients en attente</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

              <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  
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
                                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal{{ $child->id }}"><i class="fa fa-eye"></i></a>
                                      @include('service_infantile.pediatrie.create-modal')
                                      <a class="btn btn-success" href="{{route('list_consultation', $child)}}"><i class="fa fa-right-to-bracket"></i></a>
                                      <a href="{{ route('Service_Infantile.create_with_user', $child) }}" class="btn btn-primary"><i class="fa fa-book-medical"></i></a>
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
        </div>
      </div>
    </section>
</main>

@endsection


