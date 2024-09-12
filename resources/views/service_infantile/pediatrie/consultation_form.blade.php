@extends('layouts.acceuil')

@section('content')

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
 
          <div class="container-fluid  mt-5 col">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10 ">
                            <div class="card px-5 py-3 mb-4 shadow">
                            
                            <div class="nav nav-fill my-3 d-flex">
                                <label class="nav-link shadow-sm step0 border flex-fill m-2">Etape 1</label>
                                <label class="nav-link shadow-sm step1 border flex-fill m-2">Etape 2</label>
                                <label class="nav-link shadow-sm step2 border flex-fill m-2">Etape 3</label>
                                <label class="nav-link shadow-sm step3 border flex-fill m-2">Etape 4</label>
                            </div>

                                <form action="{{ route($consultation->exists ? 'Service_Infantile.consultation.update' : 'Service_Infantile.consultation.store', ['consultation' => $consultation]) }}" method="post" class="employee-form"  enctype="multipart/form-data">
                                @csrf
                                @method($consultation->exists ? 'put' : 'post')

                                <div class="form-section">
                                    <x-input type="textarea" name="motif" label="Motif de consultation" :value="old('motif', $consultation->motif)"></x-input>
                                    <x-input type="text" name="antecedant_medicaux" label="Antécédant médicaux" :value="old('antecedant_medicaux', $consultation->antecedant_medicaux)"></x-input>
                                    <div class="row mt-3">
                                        <x-input class="col" type="select" label="Suivie Grosse" name="suivie_grossesse" id="suivie_grossesse" :options="['' => 'Sélectionner une option', 'oui' => 'Oui', 'non' => 'Non']"></x-input>
                                        <x-input class="col" type="text" name="motif_non_suivie_grossesse" label="Motif Non Suivie Grossesse" id="motif_non_suivie_grossesse" :value="old('motif_non_suivie_grossesse', $consultation->motif_non_suivie_grossesse)"></x-input>
                                    </div>
                                    <x-input class="col mt-3" type="select" name="type_accouchement" label="Type d'accouchement"  :options="['Acouchement utocique' => 'Acouchement utocique', 'Acouchement dirigé médicamenteux' => 'Acouchement dirigé médicamenteux', 'Acouchement dirigé par forceps' => 'Acouchement dirigé par forceps','Acouchement dirigé par ventouse' => 'Acouchement dirigé par ventouse','Césarienne' => 'Césarienne', 'Autre' => 'Autre']"></x-input>
                                    <div class="row mt-3">
                                        <x-input class="col" type="number" label="Heure naissance" name="dure_naissance" :value="old('dure_naissance', $consultation->dure_naissance)"></x-input>
                                        <x-input class="col" type="select" name="reanimation_neonatale" label="Réanimation Néonatale" :options="['Oui'=>'Oui','Non'=>'Non']"></x-input>
                                    </div>
                                    <div class="row mt-3">
                                        <x-input class="col" type="select" name="infection_neonatal" label="Infection Néonatal" id="infection_neonatal" :options="['Oui' => 'Oui', 'Non' => 'Non']"></x-input>
                                        <x-input class="col" type="text" name="traitement_medical_infection" label="Traitement Médical réalisé" id="traitement_medical_infection" :value="old('traitement_medical_infection', $consultation->traitement_medical_infection)"></x-input>
                                    </div>
                                    <div class="row mt-3">
                                        <x-input class="col" type="select" name="ictere_neonatal" label="Ictère Néonatale" :options="['Oui' => 'Oui', 'Non' => 'Non']"></x-input>
                                        <x-input class="col" type="select" name="transfusion" label="Transfusion sanguine" id="transfusion" :options="['Oui' => 'Oui', 'Non' => 'Non']"></x-input>
                                    </div>
                                    <div class="row mt-3">
                                        <x-input class="col" type="number" name="nb_transfusion" label="Nombre de transfusion" id="nb_transfusion" :value="old('nb_transfusion', $consultation->nb_transfusion)"></x-input>
                                        <x-input class="col" type="text" name="autre_info" label="Autre information" :value="old('autre_info', $consultation->autre_info)"></x-input>
                                    </div>
                                    <div class="row mt-3">
                                        <x-input class="col" type="select" name="vaccination_ajour" label="Vaccination à Jour" :options="['Oui' => 'Oui', 'Non' => 'Non']"></x-input>
                                        <x-input class="col" type="text" name="autre_antecedant" label="Autre Antécédants Pertinent" :value="old('autre_antecedant', $consultation->autre_antecedant)"></x-input>
                                    </div>
                                    <x-input type="text" name="antecedant_chirurgicaux" label="Antécédant Chirurgicaux" :value="old('antecedant_chirurgicaux', $consultation->antecedant_chirurgicaux)"></x-input>   
                                </div>



                                <div class="form-section">
                                    <div class="row">
                                      <x-input class="col" type="number" name="temperature" label="Température" :value="old('temperature', $consultation->temperature)"></x-input>
                                      <x-input class="col" type="number" name="poids" label="Poids" :value="old('poids', $consultation->poids)"></x-input>
                                    </div>

                                    <div class="row mt-2">
                                      <x-input class="col" type="number" name="taille" label="Taille" :value="old('taille', $consultation->taille)"></x-input>
                                      <x-input class="col" type="number" name="frequence_cardiaque" label="Fréquence Cardiaque" :value="old('frequence_cardiaque', $consultation->frequence_cardiaque)"></x-input>
                                    </div>

                                    <div class="row mt-2">
                                      <x-input class="col" type="number" name="pouls" label="Pouls" :value="old('pouls', $consultation->pouls)"></x-input>
                                      <x-input class="col" type="number" name="frequence_respiratoire" label="Fréquence Respiratoire" :value="old('frequence_respiratoire', $consultation->frequence_respiratoire)"></x-input>
                                    </div>

                                    <div class="row mt-2">
                                      <x-input class="col" type="text" name="etat_general" label="Etat Général" :value="old('etat_general', $consultation->etat_general)"></x-input>
                                      <x-input class="col" type="text" name="autre_etat" label="Autre à préciser" :value="old('autre_etat', $consultation->autre_etat)"></x-input>
                                    </div>

                                    <div class="row mt-2">
                                      <!-- Tu as oublié d'inclure muqueuse-->
                                      <x-input class="col" type="text" name="mucqueuse" label="Muqueuse" :value="old('mucqueuse', $consultation->mucqueuse)"></x-input>
                                      <x-input class="col" type="text" name="aute_info" label="Autre info" :value="old('aute_info', $consultation->aute_info)"></x-input>
                                    </div>
                                    <x-input type="textarea" name="signe_physique" label="  Signe Physique" :value="old('signe_physique', $consultation->signe_physique)"></x-input>   
                                </div>

                                <div class="form-section">
                                    <x-input class="col" type="text" name="suspission_diagnostic" label="Suspission Diagnostic" :value="old('suspission_diagnostic', $consultation->suspission_diagnostic)"></x-input>
                                    <div class="row">
                                      <x-input class="col" type="select" name="bilan_biologique" label="Bilan Biologique" :options="['NFS + Plaquettes' => 'NFS + Plaquettes', 'GSRh' => 'GSRh', 'GE/DP' => 'GE/DP', 'TP-TCK' => 'TP-TCK', 'CRP' => 'CRP', 'VS' => 'VS', 'Inogramme sanguin' => 'Inogramme sanguin', 'Calcémie' => 'Calcémie', 'Protidémie' => 'Protidémie', 'Phosphate-alcaline' => 'Phosphate-alcaline', 'Phosphorémie' => 'Phosphorémie']"></x-input>
                                      <x-input class="col" type="text" name="autre_bilan" label="Autre bilan nécessaire" :value="old('autre_bilan', $consultation->autre_bilan)"></x-input>
                                      <x-input class="col" type="text" name="bilan_radiologique" label="Bilan Radiologique" :value="old('bilan_radiologique', $consultation->bilan_radiologique)"></x-input>  
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label for="image" class="form-label">Résultat Bilan Radiologique</label>
                                            <input type="file" class="form-control" name="resultat_img_radiologie">
                                        </div>
                                        <x-input class="col" type="text" name="resultat_biologie" label="Résultat Bilan Radiologique" :value="old('resultat_biologie', $consultation->resultat_biologie)"></x-input>
                                    </div>
                                    
                                    <x-input class="col mt-3" type="text" name="diagnostic" label="Diagnostique Retenue" :value="old('diagnostic', $consultation->diagnostic)"></x-input>
                                </div>

                                <div class="form-section">

                               @if (!$consultation->exists)
                               
                                <div id="dynamicFieldsTraitement">
                                        <div class="d-flex align-items-center mb-3 w-100">
                                            <div class="flex-grow-1">
                                                <x-input type="text" name="traitement[]" label="Type traitement et détail" :value="old('traitement.0', $consultation->traitement[0] ?? '')"></x-input>
                                            </div>
                                            <i class="fa fa-plus ml-2 text-dark add-field-traitement" style="cursor: pointer;"></i>
                                        </div>
                                </div>

                                    <div id="dynamicFieldsMedicament">
                                        <div class="d-flex align-items-center mb-3 w-100">
                                            <div class="flex-grow-1">
                                                <x-input type="text" name="prescription[]" label="Médicament et heure d'administration" :value="old('prescription.0', $consultation->prescription[0] ?? '')"></x-input>
                                            </div>
                                            <i class="fa fa-plus ml-2 text-dark add-field-medicament" style="cursor: pointer;"></i>
                                        </div>
                                    </div>

                               @else 
                                    @foreach ($traitements as $key => $traitement)
                                        <div id="dynamicFieldsTraitement">
                                                <div class="d-flex align-items-center mb-3 w-100">
                                                    <div class="flex-grow-1">
                                                        <x-input type="text" name="traitement[]" label="Type traitement et détail" :value="old('traitement.' . $key, $traitement)"></x-input>
                                                    </div>
                                                    <i class="fa fa-plus ml-2 text-dark add-field-traitement" style="cursor: pointer;"></i>
                                                </div>
                                        </div>
                                    @endforeach  

                                    @foreach ($prescriptions as $key => $prescription)
                                        <div id="dynamicFieldsTraitement">
                                                <div class="d-flex align-items-center mb-3 w-100">
                                                    <div class="flex-grow-1">
                                                        <x-input type="text" name="prescription[]" label="Type traitement et détail" :value="old('prescription.' . $key, $prescription)"></x-input>
                                                    </div>
                                                    <i class="fa fa-plus ml-2 text-dark add-field-traitement" style="cursor: pointer;"></i>
                                                </div>
                                        </div>
                                    @endforeach      
                               @endif
                                    <div class="row">
                                      <x-input class="col" type="text" name="evolution" label="Evolution" :value="old('evolution', $consultation->evolution)"></x-input>
                                      <x-input class="col" type="text" name="pronostic" label="Pronostic" :value="old('pronostic', $consultation->pronostic)"></x-input>  
                                    </div>
                                    <div class="row mt-2">
                                        <x-input class="col" type="text" name="diagnostic_sortie" label="Diagnostic de Sortie" :value="old('diagnostic_sortie', $consultation->diagnostic_sortie)"></x-input>
                                        <x-input class="col" type="text" name="type_sortie" label="Type de Sortie" :value="old('type_sortie', $consultation->type_sortie)"></x-input>
                                    </div>
                                    <x-input class="col mt-3" type="date" name="date_sortie" label="Date de Sortie" :value="old('date_sortie', $consultation->date_sortie)"></x-input>
                                </div>

                                @if (!$consultation->exists)
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="child_id" value="{{$child->id}}">
                                @endif
                                
                                
                            <div class="form-navigation mt-3">
                                <button type="button" class="previous btn btn-primary float-left">&lt; Précédent</button>
                                <button type="button" class="next btn btn-primary float-right">Suivant &gt;</button>
                                <button type="submit" class="btn btn-success float-right">Enregistrer</button>
                            </div>

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
 <!-- Script Formulaire -->
 $(function(){
    var $sections = $('.form-section');

    function navigateTo(index) {
        $sections.removeClass('current').eq(index).addClass('current');

        $('.form-navigation .previous').toggle(index > 0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);

        // Change color of current step
        const step = document.querySelector('.step' + index);
        step.style.backgroundColor = "#17a2b8";
        step.style.color = "white";
    }

    function curIndex() {
        return $sections.index($sections.filter('.current'));
    }

    $('.form-navigation .previous').click(function() {
        // Reset color of current step before navigating back
        const currentIndex = curIndex();
        const currentStep = document.querySelector('.step' + currentIndex);
        currentStep.style.backgroundColor = "";
        currentStep.style.color = "";

        navigateTo(currentIndex - 1);
    });

    $('.form-navigation .next').click(function() {
        $('.employee-form').parsley().whenValidate({
            group: 'block-' + curIndex()
        }).done(function() {
            navigateTo(curIndex() + 1);
        });
    });

    $sections.each(function(index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
    });

    navigateTo(0);
});
</script>


<script>
    $(document).ready(function() {
        function toggleFields() {
            $('#motif_non_suivie_grossesse').closest('.form-group').toggle($('#suivie_grossesse').val() === 'non');
            $('#traitement_medical_infection').closest('.form-group').toggle($('#infection_neonatal').val() === 'Oui');
            $('#nb_transfusion').closest('.form-group').toggle($('#transfusion').val() === 'Oui');
        }

        // Initial call to hide/show the fields based on the initial values
        toggleFields();

        // Listen for changes on the select fields
        $('#suivie_grossesse, #infection_neonatal, #transfusion').change(function() {
            toggleFields();
        });
    });
</script>

<!-- Script pour dupliquer un champ -->   

<script>
        $(document).ready(function() {
            // Fonction pour ajouter un nouveau champ "Traitement"
            function addNewFieldTraitement() {
                var newField = `
                    <div class="d-flex align-items-center mb-3 w-100">
                        <div class="flex-grow-1">
                            <x-input type="text" name="traitement[]" label="Type traitement et détail" :value="''"></x-input>
                        </div>
                        <i class="fa fa-plus ml-2 text-dark add-field-traitement" style="cursor: pointer;"></i>
                    </div>
                `;
                $('#dynamicFieldsTraitement').append(newField);
            }

            // Fonction pour ajouter un nouveau champ "Médicament et heure d'administration"
            function addNewFieldMedicament() {
                var newField = `
                    <div class="d-flex align-items-center mb-3 w-100">
                        <div class="flex-grow-1">
                            <x-input type="text" name="prescription[]" label="Médicament et heure d'administration" :value="''"></x-input>
                        </div>
                        <i class="fa fa-plus ml-2 text-dark add-field-medicament" style="cursor: pointer;"></i>
                    </div>
                `;
                $('#dynamicFieldsMedicament').append(newField);
            }

            // Ajouter un nouveau champ "Traitement" lors du clic sur l'icône plus
            $('#dynamicFieldsTraitement').on('click', '.add-field-traitement', function() {
                addNewFieldTraitement();
            });

            // Ajouter un nouveau champ "Médicament et heure d'administration" lors du clic sur l'icône plus
            $('#dynamicFieldsMedicament').on('click', '.add-field-medicament', function() {
                addNewFieldMedicament();
            });
        });
</script>

@endsection