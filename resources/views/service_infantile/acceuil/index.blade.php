@extends('layouts.acceuil')

@section('content')

<main id="main" class="main">

@if(session('status'))
  <div class="alert alert-success" id="status-alert">
    {{ session('status') }}
  </div>
@endif


  <div class="pagetitle">
      <h1>Liste des patients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Acceuil</li>
          <li class="breadcrumb-item active">Tous les patients</li>
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
                   
                  <table class="table datatable" id="example">
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
                                        <a href="{{ route('Service_Infantile.child.edit', $child->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
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
        </div>
      </div>
    </section>
</main> 

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const departmentSelects = document.querySelectorAll('.department-select');
    departmentSelects.forEach(departmentSelect => {
        departmentSelect.addEventListener('change', function () {
            const department = this.value;
            const childId = this.dataset.childId;
            const medecinSelect = document.getElementById(`medecin-select-${childId}`);
            
            if (department) {
                fetch(`/get-medecins?department=${department}`)
                    .then(response => response.json())
                    .then(data => {
                        medecinSelect.innerHTML = '<option value="">Sélectionner un médecin</option>';
                        data.forEach(medecin => {
                            const option = document.createElement('option');
                            option.value = medecin.id;
                            option.textContent = medecin.name;
                            medecinSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching medecins:', error));
            } else {
                medecinSelect.innerHTML = '<option value="">Sélectionner un médecin</option>';
            }
        });
    });
});

function setSelectedMedecins(childId) {
    const medecinSelect = document.getElementById(`medecin-select-${childId}`);
    const selectedMedecinsInput = document.getElementById(`selected-medecins-${childId}`);
    const selectedOptions = Array.from(medecinSelect.selectedOptions).map(option => option.value);
    selectedMedecinsInput.value = selectedOptions.join(',');
}
</script>


@endsection