@extends('layouts.acceuil')

@section('content')
<main id="main" class="main">

@if(session('status'))
  <div class="alert alert-success" id="status-alert">
    {{ session('status') }}
  </div>
@endif

    <div class="pagetitle">
      <h1>Demande reçue</h1>
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
                        <th scope="col">Nom infirmier</th>
                        <th scope="col">Nom Patient</th>
                        <th scope="col">Traitement Prescrit</th>
                        <th scope="col">Information précédentes</th>
                        <th scope="col">Motif</th>
                        <th scope="col" class="text-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($modifications as $modification)
                            @if ($modification->status == 0)
                            <tr id="modification-{{ $modification->id }}">
                                <td>{{ $modification->infirmier->name }}</td>
                                <td>{{ $modification->suivie->consultation_pediatrie->child->nom }}</td>
                                <td>{{ implode(", ", json_decode($modification->suivie->consultation_pediatrie->traitement, true)) }}</td>
                                <td>{{ implode(", ", json_decode($modification->suivie->follow_up, true)) }}</td>
                                <td>{{ $modification->motif }}</td>
                                <td>
                                  <div class="d-flex gap-2 w-100 justify-content-end">
                                      <a class="btn btn-success approve-modification" data-id="{{ $modification->id }}"><i class="fa fa-thumbs-up"></i></a>
                                      <a class="btn btn-danger reject-modification" data-id="{{ $modification->id }}"><i class="fa fa-thumbs-down"></i></a>
                                  </div>
                                </td>
                            </tr>
                            @endif
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
$(document).ready(function() {
    $('.approve-modification').on('click', function() {
        var modificationId = $(this).data('id');
        
        $.ajax({
            url: '/modification/' + modificationId + '/approve',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#modification-' + modificationId).remove();
                    alert('Modification approuvée avec succès.');
                } else {
                    alert('Une erreur s\'est produite. Veuillez réessayer.');
                }
            }
        });
    });

    $('.reject-modification').on('click', function() {
        var modificationId = $(this).data('id');
        
        $.ajax({
            url: '/modification/' + modificationId + '/reject',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#modification-' + modificationId).remove();
                    alert('Modification rejetée avec succès.');
                } else {
                    alert('Une erreur s\'est produite. Veuillez réessayer.');
                }
            }
        });
    });
});
</script>

@endsection
