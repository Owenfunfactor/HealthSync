@if($errors->any())
    <div class="alert alert-danger">
        <ul class="my-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="modal fade" id="modification{{ $consultation->id }}" tabindex="-1" aria-labelledby="modification{{ $consultation->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modification{{ $consultation->id }}Label">Demande de Modification</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    @php
                        // Récupérer la consultation basée sur l'ID
                        $consultation = App\Models\Consultation_pediatrie::find($consultation->id);
                        // Filtrer les utilisateurs avec le type 'Traitant'
                        $users = $consultation->users->where('type_compte', 'Traitant');   
                    @endphp
                    <!-- Contenu du modal pour la demande de modification -->
                    <form action="{{route('Service_Infantile.demande_modification.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="motif" class="form-label">Motif de la demande</label>
                            <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
                        <input type="hidden" name="infirmier_id" value="{{Auth::user()->id}}">
                        @foreach ($users as $user)
                            <input type="hidden" name="medecin_id" value="{{$user->id}}">
                        @endforeach
                        @if ($consultation->suivie !== null)
                            <input type="hidden" name="suivie_id" value="{{$consultation->suivie->id}}">
                        @endif                  
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>
