@extends('layouts.acceuil')

@section('content')

@php
$traitements = json_decode($suivie ? $suivie->consultation_pediatrie->traitement : $consultation->traitement, true);
$observations = json_decode(old('observation', $suivie->observation ?? '[]'), true);
$suivieTraitements = $suivie ? json_decode($suivie->follow_up, true) : [];
@endphp

<main id="main" class="main">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="my-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pagetitle">
        <h1>Enregistrer une Consultation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Pédiatrie</a></li>
                <li class="breadcrumb-item active">Consultation</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="container-fluid mt-5 col">
                        <div class="row justify-content-md-center">
                            <div class="col-md-10">
                                <div class="card px-5 py-3 mb-4 shadow">
                                    <form action="{{ route($suivie->exists ? 'Service_Infantile.suivie.update' : 'Service_Infantile.suivie.store', ['suivie' => $suivie]) }}" method="post" class="employee-form" id="consultation-form">
                                        @csrf
                                        @method($suivie->exists ? 'put' : 'post')
                                        <div>
                                            <div class="row mt-3 align-items-center">
                                                <x-input class="col" type="text" name="nom" label="Nom et Prénom" :value="old('nom', $suivie->nom)"></x-input>
                                            </div>
                                            @foreach ($traitements as $index => $traitement)
                                                @php
                                                    $checked = false;
                                                    $heureDebut = '';
                                                    $heureFin = '';
                                                    foreach ($suivieTraitements as $suivieTraitement) {
                                                        $parts = explode(',', $suivieTraitement);
                                                        if ($parts[0] === $traitement) {
                                                            $checked = true;
                                                            $heureDebut = $parts[1] ?? '';
                                                            $heureFin = $parts[2] ?? '';
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                <div class="row mt-2 align-items-center">
                                                    <div class="form-check mt-4 ms-3 col-3">
                                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault{{$index}}" data-index="{{$index}}" {{ $checked ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault{{$index}}">
                                                            {{ $traitement }}
                                                        </label>
                                                    </div>
                                                    <div class="col" id="time-fields-{{$index}}" style="display: {{ $checked ? 'flex' : 'none' }};">
                                                        <x-input class="col" type="time" id="heure_debut_{{$index}}" name="heure_debut_{{$index}}" label="Heure de début" :value="$heureDebut"></x-input>
                                                        <x-input class="col ms-3" type="time" id="heure_fin_{{$index}}" name="heure_fin_{{$index}}" label="Heure de fin" :value="$heureFin"></x-input>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div id="dynamicFieldsObservation" class="mt-2">
                                                @foreach ($observations as $i => $observation)
                                                    <div class="d-flex align-items-center mb-3 w-100">
                                                        <div class="flex-grow-1">
                                                            <x-input type="text" name="observation[]" label="Observation effectué" :value="$observation"></x-input>
                                                        </div>
                                                        @if ($i === 0)
                                                            <i class="fa fa-plus ml-2 text-dark add-field-observation" style="cursor: pointer;"></i>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                @if (empty($observations))
                                                    <div class="d-flex align-items-center mb-3 w-100">
                                                        <div class="flex-grow-1">
                                                            <x-input type="text" name="observation[]" label="Observation effectué" :value="''"></x-input>
                                                        </div>
                                                        <i class="fa fa-plus ml-2 text-dark add-field-observation" style="cursor: pointer;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            @if ($suivie == null)
                                                <div class="text-end mt-5">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            @else
                                                <div class="text-end mt-5">
                                                    <button type="submit" class="btn btn-primary">Editer</button>
                                                </div>  
                                            @endif
                                            
                                        </div>
                                        <input type="hidden" name="combined_traitements" id="combined_traitements">
                                        @if ($suivie == null)
                                            <input type="hidden" name="consultation_pediatrie_id" value="{{$consultation->id}}">
                                        @endif 
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section> 
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('.form-check-input');
        checkboxes.forEach(function(checkbox, index) {
            var timeFields = document.getElementById('time-fields-' + index);

            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    timeFields.style.display = 'flex';
                } else {
                    timeFields.style.display = 'none';
                }
            });
        });
    });

    $(document).ready(function() {
        function addNewFieldObservation() {
            var newField = `
                <div class="d-flex align-items-center mb-3 w-100">
                    <div class="flex-grow-1">
                        <x-input type="text" name="observation[]" label="Observation effectué" :value="''"></x-input>
                    </div>
                    <i class="fa fa-plus ml-2 text-dark add-field-observation" style="cursor: pointer;"></i>
                </div>
            `;
            $('#dynamicFieldsObservation').append(newField);
        }

        $('#dynamicFieldsObservation').on('click', '.add-field-observation', function() {
            addNewFieldObservation();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(function(checkbox) {
            var index = checkbox.dataset.index;
            var timeFields = document.getElementById('time-fields-' + index);
            
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    timeFields.style.display = 'flex';
                } else {
                    timeFields.style.display = 'none';
                }
            });
        });

        document.getElementById('consultation-form').addEventListener('submit', function (e) {
            var combinedTraitements = [];
            
            checkboxes.forEach(function(checkbox) {
                var index = checkbox.dataset.index;
                if (checkbox.checked) {
                    var traitement = checkbox.nextElementSibling.innerText.trim();
                    var heureDebut = document.getElementById('heure_debut_' + index).value;
                    var heureFin = document.getElementById('heure_fin_' + index).value;

                    if (heureDebut && heureFin) {
                        combinedTraitements.push(traitement + ',' + heureDebut + ',' + heureFin);
                    } else {
                        combinedTraitements.push(traitement + ',,');
                    }
                }
            });

            document.getElementById('combined_traitements').value = combinedTraitements.join(';');
        });
    });
</script>

@endsection
