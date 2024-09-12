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
      <h1>Création d'un patient</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
          <li class="breadcrumb-item active">Créer un patient</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <div class="container-fluid  mt-5">
                    <div class="row justify-content-md-center">
                        <div class="col-md-9 ">
                            <div class="card px-5 py-3 mb-4 shadow">
                            
                                <div class="nav nav-fill my-3">
                                    <label class="nav-link shadow-sm step0    border ml-2 ">Identité de l'enfant</label>
                                    <label class="nav-link shadow-sm step1   border ml-2 " >Information sur le père</label>
                                    <label class="nav-link shadow-sm step2   border ml-2 " >Information sur la mère</label>
                                </div>
                                <form action="{{ route($child->exists ? 'Service_Infantile.child.update' : 'Service_Infantile.child.store', ['child' => $child]) }}" method="post" class="employee-form">
                                @csrf
                                @method($child->exists ? 'put' : 'post')

                                <div class="form-section">
                                    <x-input type="text" name="nom" label="Nom et Prénom" :value="old('nom', $child->nom)"></x-input>
                                    <div class="row">
                                        <x-input class="col" type="select" label="Sexe" name="sexe" :options="['' => '', 'masculin' => 'Masculin', 'feminin' => 'Féminin']" />
                                        <x-input class="col" type="date" name="date_naissance" label="Date de naissance" :value="old('date_naissance', $child->date_naissance)"/>
                                    </div>
                                    <div class="row mt-2">
                                        <x-input class="col" type="text" name="profession" label="Profession" :value="old('profession', $child->profession)"></x-input>
                                        <x-input class="col" type="select" id="departement" name="departement" label="Département" :options="[
                                            'Alibori' => 'Alibori', 
                                            'Atacora' => 'Atacora', 
                                            'Atlantique' => 'Atlantique', 
                                            'Borgou' => 'Borgou', 
                                            'Collines' => 'Collines', 
                                            'Coufo' => 'Coufo', 
                                            'Donga' => 'Donga', 
                                            'Littoral' => 'Littoral', 
                                            'Mono' => 'Mono', 
                                            'Ouémé' => 'Ouémé', 
                                            'Plateau' => 'Plateau', 
                                            'Zou' => 'Zou'
                                        ]">
                                        </x-input>
                                    </div>
                                    <div class="row mt-2">
                                        <x-input class="col" type="select" id="commune" name="commune" label="Commune" :options="['' => '']"></x-input>
                                        <x-input class="col" type="text" name="quartier" label="Quartier" :value="old('quartier', $child->quartier)"></x-input>
                                    </div>
                                    <div class="row mt-2">
                                        <x-input class="col" type="text" name="phone" label="Téléphone" :value="old('phone', $child->phone)"></x-input>
                                        <x-input class="col" type="text" name="adresse" label="Adresse" :value="old('adresse', $child->adresse)"></x-input>
                                    </div>
                                    
                                </div>


                                <div class="form-section">
                                    <div class="row">
                                        <x-input class="col" type="text" name="nom_pere" label="Nom du père" :value="old('nom_pere', $child->nom_pere)"></x-input>
                                        <x-input class="col" type="number" name="age_pere" label="Age du père" :value="old('age_pere', $child->age_pere)"></x-input>
                                    </div>

                                    <div class="row mt-2">
                                        <x-input class="col" type="text" name="profession_pere" label="Profession du Père" :value="old('profession_pere', $child->profession_pere)"></x-input>
                                        <x-input class="col" type="number" name="tel_pere" label="Téléphone du Père" :value="old('tel_pere', $child->tel_pere)"></x-input>
                                    </div>

                                    <x-input class="col" type="text" name="adresse_pere" label="Adresse du Père" :value="old('adresse_pere', $child->adresse_pere)"></x-input>

                                </div>


                                <div class="form-section">
                                    <div class="row">
                                        <x-input class="col" type="text" name="nom_mere" label="Nom de la mère" :value="old('nom_mere', $child->nom_mere)"></x-input>
                                        <x-input class="col" type="number" name="age_mere" label="Age de la mère" :value="old('age_mere', $child->age_mere)"></x-input>
                                    </div>

                                    <div class="row mt-2">
                                        <x-input class="col" type="text" name="profession_mere" label="Profession de la mère" :value="old('profession_mere', $child->profession_mere)"></x-input>
                                        <x-input class="col" type="number" name="tel_mere" label="Téléphone de la mère" :value="old('tel_mere', $child->tel_mere)"></x-input>
                                    </div>

                                    <x-input class="col" type="text" name="adresse_mere" label="Adresse de la Père" :value="old('adresse_mere', $child->adresse_mere)"></x-input>

                                </div>


                            <div class="form-navigation mt-3">
                                <button type="button" class="previous btn btn-primary float-left">&lt; Précédent</button>
                                <button type="button" class="next btn btn-primary float-right">Suivant &gt;</button>
                                @if($child->exists)
                                    <button type="submit" class="btn btn-success float-right">Enregistrer</button>
                                @else
                                    <button type="submit" class="btn btn-success float-right">Créer</button>
                                @endif
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


 <!-- Script Formulaire -->
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
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer les éléments DOM des champs département et commune
    let departement = document.getElementById('departement');
    let commune = document.getElementById('commune');

    // Tableau d'associations département -> communes (remplacez avec vos données réelles)
    let communesParDepartement = {
        'Alibori': ['Banikoara', 'Gogounou', 'Kandi','Karimama','Malanville','Segbana'],
        'Atacora': ['Boukoumbé', 'Cobly','Kérou','Kouandé','Matéri','Natitingou','Péhunco','Tanguiéta','Toucountouna'],
        'Atlantique': ['Abomey-Calavi', 'Allada','Kpomassè','Ouidah','Sô-Ava','Toffo','Tori-Bossito','Zè'],
        'Borgou': ['Bembéréké', 'Kalalé','N\'Dali','Nikki','Parakou','Pèrèrè','Sinendé','Tchaourou'],
        'Collines': ['Bantè', 'Dassa-Zoumè','Glazoué','Ouèssè','Savalou','Savè'],
        'Coufo': ['Aplahoué', 'Djakotomey','Dogbo-Tota','Klouékanmè','Lalo','Toviklin'],
        'Donga': ['Bassila', 'Copargo','Djougou','Ouaké'],
        'Littoral': ['Cotonou'],
        'Mono': ['Athiémé', 'Bopa','Comè','Grand-Popo','Houéyogbé','Lokossa'],
        'Ouémé': ['Adjarra', 'Adjohoun','Aguégués','Akpro-Missérété','Avrankou','Bonou','Dangbo','Porto-Novo','Sèmè-Kpodji'],
        'Plateau': ['Adja-Ouèrè', 'Ifangni','Kétou','Pobè','Sakété'],
        'Zou': ['Abomey', 'Agbangnizoun','Bohicon','Covè','Djidja','Ouinhi','Zagnanado','Za-Kpota','Zogbodomey']
        // Ajoutez les autres départements et leurs communes ici
    };

    // Fonction pour mettre à jour les options du champ commune en fonction du département sélectionné
    function updateCommunes() {
        let selectedDepartement = departement.value;
        let communes = communesParDepartement[selectedDepartement] || [];

        // Vider les options actuelles du champ commune
        commune.innerHTML = '';

        // Ajouter les nouvelles options basées sur le département sélectionné
        communes.forEach(function(communeName) {
            let option = document.createElement('option');
            option.textContent = communeName;
            option.value = communeName;
            commune.appendChild(option);
        });
    }

    // Écouter les changements sur le champ département pour mettre à jour le champ commune
    departement.addEventListener('change', updateCommunes);

    // Appel initial pour charger les communes au chargement de la page (si un département est déjà sélectionné)
    updateCommunes();
});
</script>


@endsection