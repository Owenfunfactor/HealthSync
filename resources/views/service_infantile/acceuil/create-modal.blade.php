<!-- Formulaire Modal -->
<div class="modal fade" id="myModal{{$child->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrer un médecin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="medecin-form-{{$child->id}}" action="{{ route('child.attachUser', ['child' => $child->id]) }}" method="post">
                    @csrf

                    <input type="hidden" name="user_id" id="selected-medecins-{{$child->id}}">
                    <div class="mb-1">

                    <label for="department-select-{{$child->id}}" class="form-label">Département</label>
                    <select class="col form-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm department-select" name="departement" data-child-id="{{$child->id}}" id="department-select-{{$child->id}}">
                        <option value="" selected>Sélectionner un département</option>
                        <option value="Pediatrie">Pédiatrie</option>
                        <option value="Neonatologie">Néonatologie</option>
                        <option value="Chirurgie Pediatrie">Chirurgie Pédiatrie</option>
                    </select>

                    <div class="mt-3">
                        <label for="medecin-select-{{$child->id}}" class="form-label">Nom Médecin</label>
                        <select class="col form-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm medecin-select" name="nom_medecin[]" id="medecin-select-{{$child->id}}">
                            <option value="">Sélectionner un médecin</option>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" onclick="setSelectedMedecins({{$child->id}})">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
