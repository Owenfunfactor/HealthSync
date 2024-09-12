<div class="modal fade" id="exampleModal{{$child->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$child->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel{{$child->id}}">Information du patient</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        

      <div class="mt-3">
          <p><strong>N° du dossier : </strong>{{ \Carbon\Carbon::parse($child->date_naissance)->format('Ymd') }}</p>
          @foreach ($child->users as $user)
          <p><strong>Nom et prénom du médecin traitant : </strong>{{$user->name}}</p>
          @endforeach
      </div>

      <div class="mt-4 text-center  d-block border-top border-bottom border-top-3 border-bottom-3">
          <h4>Identité de l'enfant</h4>
      </div>

      <div class="mt-4">
          <div class="row">
            <p class="col"><strong>Nom et prénom : </strong>{{$child->nom}}</p>
            <p class="col text-end"><strong>Sexe : </strong>{{$child->sexe}}</p> 
          </div>
          <div class="row">
            <p class="col"><strong>Age : </strong>{{$child->date_naissance}}</p>
            <p class="col text-end"><strong>Profession : </strong>{{$child->profession}}</p> 
          </div>
          <div class="row">
            <p class="col"><strong>Département : </strong>{{$child->departement}}</p>
            <p class="col text-end"><strong>Commune : </strong>{{$child->commune}}</p> 
          </div>
          <div class="row">
            <p class="col"><strong>Quartier : </strong>{{$child->quartier}}</p>
            <p class="col text-end"><strong>Téléphone : </strong>{{$child->phone}}</p> 
          </div>
          <p><strong>Adresse : </strong>{{$child->adresse}}</p> 
      </div>

      <div class="mt-4 text-center  d-block border-top border-bottom border-top-3 border-bottom-3">
          <h4>Identité des parents</h4>
      </div><br>

      <h4 class="mt-3">Information sur le père / tuteur de l'enfant</h4>

      <div class="mt-4">
          <div class="row">
            <p class="col"><strong>Nom et prénom : </strong>{{$child->nom_pere}}</p>
            <p class="col text-end"><strong>Age : </strong>{{$child->age_pere}}</p> 
          </div>
          <div class="row">
            <p class="col"><strong>Profession : </strong>{{$child->profession_pere}}</p>
            <p class="col text-end"><strong>Téléphone : </strong>{{$child->tel_pere}}</p> 
          </div>
          <p><strong>Adresse : </strong>{{$child->adresse_pere}}</p><br> 
      </div><br>

      <h4>Information sur la mère / tutrice de l'enfant</h4>

      <div class="mt-4">
          <div class="row">
            <p class="col"><strong>Nom et prénom : </strong>{{$child->nom_mere}}</p>
            <p class="col text-end"><strong>Age : </strong>{{$child->age_mere}}</p> 
          </div>
          <div class="row">
            <p class="col"><strong>Profession : </strong>{{$child->profession_mere}}</p>
            <p class="col text-end"><strong>Téléphone : </strong>{{$child->tel_mere}}</p> 
          </div>
          <p><strong>Adresse : </strong>{{$child->adresse_mere}}</p> 
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
