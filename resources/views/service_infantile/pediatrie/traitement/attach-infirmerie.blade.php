<!-- Formulaire Modal -->
<div class="modal fade" id="attach_infirmerie{{ $consultation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lier un infirmier/infirmière</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="infirmerie-form-{{ $consultation->id }}" action="{{ route('consultation.attachInfirmerie', ['consultation' => $consultation->id]) }}" method="post">
                    @csrf

                    <input type="hidden" name="user_id" id="selected-infirmerie-{{ $consultation->id }}">
            
                    <div class="mt-3">
                        <label for="infirmerie-select-{{ $consultation->id }}" class="form-label">Nom infirmier(ère)/Aide soignat(e)</label>
                        <select class="col form-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="nom_infirmier[]" id="infirmerie-select-{{ $consultation->id }}">
                            <option value="">Sélectionner un infirmier(ère)/Aide soignat(e)</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" onclick="setSelectedInfirmiers({{ $consultation->id }})">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form[id^="infirmerie-form-"]');
        
        forms.forEach(form => {
            const consultationId = form.id.split('-')[2];
            const medecinSelect = document.getElementById(`infirmerie-select-${consultationId}`);

            // Fetch all infirmiers when the modal is shown
            $(`#attach_infirmerie${consultationId}`).on('show.bs.modal', function() {
                fetch(`/getAllInfirmiers`)
                    .then(response => response.json())
                    .then(data => {
                        medecinSelect.innerHTML = '<option value="">Sélectionner un infirmier/infirmière</option>';
                        data.forEach(infirmier => {
                            const option = document.createElement('option');
                            option.value = infirmier.id;
                            option.textContent = infirmier.name;
                            medecinSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur:', error));
            });
        });
    });

    function setSelectedInfirmiers(consultationId) {
        const InfirmierSelect = document.getElementById(`infirmerie-select-${consultationId}`);
        const selectedInfirmiersInput = document.getElementById(`selected-infirmerie-${consultationId}`);
        const selectedOptions = Array.from(InfirmierSelect.selectedOptions).map(option => option.value);
        selectedInfirmiersInput.value = selectedOptions.join(',');
    }
</script>
