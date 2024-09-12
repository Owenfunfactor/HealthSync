@extends('layouts.acceuil')

@section('content')

<main id="main" class="main">

@if(session('status'))
  <div class="alert alert-success" id="status-alert">
    {{ session('status') }}
  </div>
@endif

    <div class="pagetitle">
      <h1>Les Consultations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Section Consultation</li>
          <li class="breadcrumb-item active">Liste des Consultations de {{$child->nom}}</li>
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
                  <h5 class="card-title">Consultations</h5>

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom Patient</th>
                        <th scope="col">Nom Médecin</th>
                        <th scope="col">Date Consultation</th>
                        <th scope="col" class="text-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultations as $consultation)
                            <tr>
                                <td>{{ $consultation->id }}</td>
                                <td>{{ $child->nom }}</td>
                                @foreach ($child->users as $user)
                                <td>{{ $user->name }}</td>
                                @endforeach
                                <td>{{ $consultation->created_at->format('d/m/Y') }}</td>
                                <td>
                                  <div class="d-flex gap-2 w-100 justify-content-end">
                                      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#attach_infirmerie{{ $consultation->id }}">
                                          <i class="fa fa-user-doctor"></i>
                                      </button>
                                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#monModal{{ $child->id }}"><i class="fa fa-eye"></i></a>
                                      <a href="{{ route('Service_Infantile.consultation.edit', $consultation) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                                      <!-- Début modal -->
                                      <div class="modal fade" id="monModal{{$consultation->id}}" tabindex="-1" aria-labelledby="monModal{{$consultation->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel{{$consultation->id}}">Information du patient</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <!-- Corps du modal -->
                                              <div class="mt-3">
                                                <p><strong>N° du dossier : </strong>{{$consultation->child->id}}</p>
                                                @foreach ($consultation->child->users as $user)
                                                <p><strong>Nom et prénom du médecin traitant : </strong>{{$user->name}}</p>
                                                @endforeach
                                              </div>

                                              <!-- Identité de l'enfant -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h4>Identité de l'enfant</h4>
                                              </div>
                                              <div class="mt-4">
                                                <div class="row">
                                                  <p class="col"><strong>Nom et prénom : </strong>{{$consultation->child->nom}}</p>
                                                  <p class="col text-end"><strong>Sexe : </strong>{{$consultation->child->sexe}}</p> 
                                                </div>
                                                <div class="row">
                                                  <p class="col"><strong>Age : </strong>{{$consultation->child->date_naissance}}</p>
                                                  <p class="col text-end"><strong>Profession : </strong>{{$consultation->child->profession}}</p> 
                                                </div>
                                                <div class="row">
                                                  <p class="col"><strong>Département : </strong>{{$consultation->child->departement}}</p>
                                                  <p class="col text-end"><strong>Commune : </strong>{{$consultation->child->commune}}</p> 
                                                </div>
                                                <div class="row">
                                                  <p class="col"><strong>Quartier : </strong>{{$consultation->child->quartier}}</p>
                                                  <p class="col text-end"><strong>Téléphone : </strong>{{$consultation->child->phone}}</p> 
                                                </div>
                                                <p><strong>Adresse : </strong>{{$consultation->child->adresse}}</p> 
                                              </div>

                                              <!-- Identité des parents -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h4>Identité des parents</h4>
                                              </div>
                                              
                                              <h4 class="mt-3">Information sur le père / tuteur de l'enfant</h4>
                                              <div class="mt-4">
                                                <div class="row">
                                                  <p class="col"><strong>Nom et prénom : </strong>{{$consultation->child->nom_pere}}</p>
                                                  <p class="col text-end"><strong>Age : </strong>{{$consultation->child->age_pere}}</p> 
                                                </div>
                                                <div class="row">
                                                  <p class="col"><strong>Profession : </strong>{{$consultation->child->profession_pere}}</p>
                                                  <p class="col text-end"><strong>Téléphone : </strong>{{$consultation->child->tel_pere}}</p> 
                                                </div>
                                                <p><strong>Adresse : </strong>{{$consultation->child->adresse_pere}}</p><br> 
                                              </div>
                                              
                                              <h4>Information sur la mère / tutrice de l'enfant</h4>
                                              <div class="mt-4">
                                                <div class="row">
                                                  <p class="col"><strong>Nom et prénom : </strong>{{$consultation->child->nom_mere}}</p>
                                                  <p class="col text-end"><strong>Age : </strong>{{$consultation->child->age_mere}}</p> 
                                                </div>
                                                <div class="row">
                                                  <p class="col"><strong>Profession : </strong>{{$consultation->child->profession_mere}}</p>
                                                  <p class="col text-end"><strong>Téléphone : </strong>{{$consultation->child->tel_mere}}</p> 
                                                </div>
                                                <p><strong>Adresse : </strong>{{$consultation->child->adresse_mere}}</p> 
                                              </div><br>
                                              
                                              <h4 class="mt-3 text-center">Infos Consultations</h4><br>
                                                @foreach($consultation->users->where('type_compte', 'Traitant') as $user)
                                                  <p><strong>Nom du médecin Traitant : </strong>{{ $user->name }}</p>
                                                @endforeach
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Motif de consultation</h5>
                                              </div>
                                              <p>{{$consultation->motif}}</p>
                                              
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Antécédents liés à l'enfant</h5>
                                              </div>
                                              <p><strong>Antécédant médicaux : </strong>{{$consultation->motif}}</p>
                                              <p><strong>Suivie Grossesse : </strong>{{$consultation->suivie_grossesse}}</p>
                                              @if ($consultation->motif_non_suivie_grossesse !== null)
                                                <p><strong>Motif non suivie Grossesse : </strong>{{$consultation->motif_non_suivie_grossesse}}</p>
                                              @endif
                                              <p><strong>Durée de naissance : </strong>{{$consultation->dure_naissance}}</p>
                                              <p><strong>Type accouchement : </strong>{{$consultation->type_accouchement}}</p>
                                              <p><strong>Réanimation néonatal : </strong>{{$consultation->reanimation_neonatale}}</p>
                                              <p><strong>Infection néonatal : </strong>{{$consultation->infection_neonatal}}</p>
                                              @if ($consultation->traitement_medical_infection !== null)
                                                <p><strong>Traitement médical en cas d'infection : </strong>{{$consultation->traitement_medical_infection}}</p>
                                              @endif
                                              <p><strong>Ictère néonatal : </strong>{{$consultation->ictere_neonatal}}</p>
                                              <p><strong>Transfusion : </strong>{{$consultation->transfusion}}</p>
                                              @if ($consultation->nb_transfusion !== null)
                                                <p><strong>Nombre de Transfusion : </strong>{{$consultation->nb_transfusion}}</p>
                                              @endif
                                              @if ($consultation->autre_info !== null)
                                                <p><strong>Autres Informations Pertinentes : </strong>{{$consultation->autre_info}}</p>
                                              @endif
                                              <p><strong>Vaccination à jour : </strong>{{$consultation->vaccination_ajour}}</p>
                                              @if ($consultation->autre_antecedant !== null)
                                                <p><strong>Autres Antécédants : </strong>{{$consultation->autre_antecedant}}</p>
                                              @endif
                                              <p><strong>Antécédants chirurgicaux : </strong>{{$consultation->antecedant_chirurgicaux}}</p>
                                              
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Examens Clinique</h5>
                                              </div>
                                              <p><strong>Température : </strong>{{$consultation->temperature}}</p>
                                              <p><strong>Poids : </strong>{{$consultation->poids}}</p>
                                              <p><strong>Taille : </strong>{{$consultation->taille}}</p>
                                              <p><strong>Fréquence Cardiaque : </strong>{{$consultation->frequence_cardiaque}}</p>
                                              <p><strong>Fréquence Respiratoire : </strong>{{$consultation->frequence_respiratoire}}</p>
                                              <p><strong>Etat général : </strong>{{$consultation->etat_general}}</p>
                                              @if ($consultation->autre_etat !== null)
                                                <p><strong>Autres états : </strong>{{$consultation->autre_etat}}</p>
                                              @endif
                                              <p><strong>Mucqueuse : </strong>{{$consultation->mucqueuse}}</p>
                                              @if ($consultation->aute_info !== null)
                                                <p><strong>Autres info : </strong>{{$consultation->aute_info}}</p>
                                              @endif
                                              <p><strong>Signe physique : </strong>{{$consultation->signe_physique}}</p>
                                              
                                                      <!-- Bilan paracliniques demandés -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Bilan paracliniques demandés</h5>
                                              </div>
                                              <p><strong>Bilan biologique : </strong>{{$consultation->bilan_biologique}}</p>
                                              <p><strong>Bilan Radiologique : </strong>{{$consultation->bilan_radiologique}}</p>

                                              <!-- Suspicion diagnostic -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Suspicion diagnostic</h5>
                                              </div>
                                              <p><strong>Suspicion diagnostic : </strong>{{$consultation->suspission_diagnostic}}</p>

                                              <!-- Résultat bilan paracliniques -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Résultat bilan paracliniques</h5>
                                              </div>
                                              <p><strong>Résultat biologique : </strong>{{$consultation->resultat_biologie}}</p>
                                              <p><strong>Résultat image Radiologique :</strong> <br><img src="{{ asset('assets/img_2/' . $consultation->resultat_img_radiologie) }}" alt="Image de radio" style="width: 300px; height: auto;"><br></p>

                                              <!-- Diagnostic Retenu -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Diagnostic Retenu</h5>
                                              </div>
                                              <p><strong>Diagnostic : </strong>{{$consultation->diagnostic}}</p>

                                              <!-- Traitement -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Traitement</h5>
                                              </div>
                                              <p><strong>Traitement : </strong>{{ implode(", ", json_decode($consultation->traitement, true)) }}</p>
                                              <p><strong>Prescription : </strong>{{ implode(", ", json_decode($consultation->prescription, true)) }}</p>
                                              @if ($consultation->suivie !== null)
                                                <p><strong>Nom Infirmier/infirmière : </strong>{{$consultation->suivie->nom}}</p>
                                                <p><strong>Suivie traitement : </strong>{{ implode(", ", json_decode($consultation->suivie->follow_up, true)) }}</p>
                                                <p><strong>Observation : </strong>{{ implode(", ", json_decode($consultation->suivie->observation, true)) }}</p>
                                              @endif

                                              <!-- Evolution et sortie des patients -->
                                              <div class="mt-4 text-center d-block border-top border-bottom border-top-3 border-bottom-3">
                                                <h5>Évolution et sortie des patients</h5>
                                              </div>
                                              <p><strong>Évolution : </strong>{{$consultation->evolution}}</p>
                                              <p><strong>Pronostic : </strong>{{$consultation->pronostic}}</p>
                                              <p><strong>Diagnostic sortie : </strong>{{$consultation->diagnostic_sortie}}</p>
                                              <p><strong>Type de sortie : </strong>{{$consultation->type_sortie}}</p>
                                              <p><strong>Date de sortie : </strong>{{ \Carbon\Carbon::parse($consultation->date_sortie)->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Fin modal -->
                                       @include('service_infantile.pediatrie.traitement.attach-infirmerie')
                                  </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
</main>      
@endsection
