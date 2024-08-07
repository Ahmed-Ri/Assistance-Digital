<x-app-layout>
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-outline-primary mt-2 ">Retour</a>
        <div class="responsive-table "id="catalogue-responsive">

            <table id="table" class="table table-secondary-emphasis table-striped mt-2 ">
                <thead class="custom-thead">
                    <tr>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Objectif</th>
                        <th>Réseaux</th>
                        {{-- <th>Détails</th> --}}
                        <th>Images</th>
                        <th>Statut</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compagnes as $compagne)
                        <tr>
                            <td>{{ $compagne->date_debut }}</td>
                            <td>{{ $compagne->date_fin }}</td>
                            <td>{{ $compagne->objectif }}</td>
                            <td>
                                @if (is_array(json_decode($compagne->reseaux, true)))
                                    @foreach (json_decode($compagne->reseaux, true) as $reseau)
                                        <span class="badge bg-primary">{{ $reseau }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-secondary">Aucun Réseau</span>
                                @endif
                            </td>
                            {{-- <td>{{ $compagne->details }}</td> --}}
                            <td>
                                @if ($compagne->images->isNotEmpty())
                                    <img src="{{ Storage::url($compagne->images->first()->filename) }}"
                                        alt="Photo de campagne" style="width: 50px; height: 50px;">
                                @else
                                @endif
                            </td>
                            <td>{{ $compagne->status }}</td>
                            <td>
                                <a href="{{ route('edit_form', $compagne->id) }}" class="btn btn-outline-primary">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
           
            <div class="d-flex justify-content-center mt-3">
                {{ $compagnes->links() }}
            </div>
        </div>
       
    </div>
    <div id="mobile-view-container">
        <!-- Conteneur pour la vue mobile -->
    </div>

    <script>
        window.onload = function() {
            var tableContainer = document.getElementById('catalogue-responsive');
            var mobileContainer = document.getElementById('mobile-view-container');

            function adjustVisibility() {
                if (window.innerWidth <= 768) {
                    tableContainer.style.display = 'none';
                    mobileContainer.style.display = 'block';
                    createMobileView();
                } else {
                    tableContainer.style.display = 'block';
                    mobileContainer.style.display = 'none';
                }
            }

            function createMobileView() {

                var campaignData =
                @json($compagnes->items()); // Modifier pour s'assurer que la pagination ne pose pas de problème

                mobileContainer.innerHTML = '';

                if (campaignData.length > 0) {
                    campaignData.forEach(function(compagne) {
                        var card = document.createElement('div');
                        card.className = 'article-card';
                        card.innerHTML = `
                        
                            <div class="campaign-details">
                                <div>${compagne.date_debut}</div>                               
                                <div>${compagne.objectif}</div>                              
                            </div>
                            <div class="campaign-actions">
                                <a href="/formulaire/edit/${compagne.id}" class="btn" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Voir</a>
                            </div>
                        `;
                        mobileContainer.appendChild(card);
                    });
                } else {
                    var noCampaignsMessage = document.createElement('div');
                    noCampaignsMessage.innerText = 'Aucune campagne trouvée.';
                    mobileContainer.appendChild(noCampaignsMessage);
                }
            }

            adjustVisibility();
            window.onresize = adjustVisibility;
        };
    </script>




</x-app-layout>
