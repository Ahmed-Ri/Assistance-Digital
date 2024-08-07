<x-app-layout>
    
    <div class="container ">
        <!-- User Management Section -->
        <div class="titre d-flex justify-content-between align-items-center mb-1">
            <h2>Gestion des comptes</h2>
            <a href="{{ route('utilisateur.create') }}" class="btn mt-3 mb-2 ml-4"
               style="background-color: #268EE6; color: white; border: none; cursor: pointer;">+ Nouveau</a>
        </div>
        <div id="user-table-container">
            <table class="table table-secondary-emphasis table-striped mt-1">
                <thead class="custom-thead">
                    <tr>
                        <th>Client</th>
                        <th>Entreprise</th>
                        <th>Abonnement</th>
                        <th>Téléphone</th>
                        <th>Mot de passe</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->nom }} {{ $user->prenom }}</td>
                            <td>{{ $user->entreprise }}</td>
                            <td>{{ $user->abonnement }}</td>
                            <td>{{ $user->telephone }}</td>
                            <td>**********</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn"
                                   style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Editer</a>
                                   <a href="{{ route('admin.users.createCampaign', $user->id) }}" class="btn" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Ajouter Compagne</a>
                                </td>
                        </tr> @endforeach
                </tbody>
            </table>
        </div>
        <div id="mobile-user-view-container">
    </div>

    <!-- Campaign Management Section -->
    <div class="titre d-flex justify-content-between align-items-center mt-5 mb-2">
        <h2>Gestion des compagnes</h2>
       
    </div>
    <div id="campaign-table-container">
        <table class="table table-secondary-emphasis table-striped mt-3">
            <thead class="custom-thead">
                <tr>
                    <th>Client</th>
                    <th>Entreprise</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Objectif</th>
                    <th>Réseaux</th>
                    <th>Détails</th>
                    {{-- <th>Photo</th> --}}
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compagnes as $compagne)
                    <tr>
                        <td>{{ $compagne->User->nom }}</td>
                        <td>{{ $compagne->User->entreprise }}</td>
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
                        <td>{{ $compagne->details }}</td>
                       
                        <td>{{ $compagne->status }}</td>
                        <td>
                            <a href="{{ route('edit-compagne', $compagne->id) }}" class="btn "
                                style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Editer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="mobile-campaign-view-container"></div>
    </div>
    <div class="container ">
        <select id="userDropdown" class="form-select" style="width: 180px">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->nom }} (ID: {{ $user->id }})</option>
            @endforeach
        </select>
        <button id="addRowBtn" class="btn btn-primary mt-2">Ajouter</button>
        <div id="myGrid" class="ag-theme-alpine-dark" style="height: 350px; width: 100%; margin-top: 20px;"></div>
    </div>
    


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const users = @json($users);
            class DatePickerEditor {
    init(params) {
        this.eInput = document.createElement('input');
        this.eInput.type = 'date';
        this.eInput.value = params.value || '';

        // Assurez-vous que la date est au format YYYY-MM-DD
        this.eInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                params.stopEditing();
            }
        });
    }

    // Gets called once when grid ready to insert the element
    getGui() {
        return this.eInput;
    }

    // Gets called once by grid after editing is finished
    getValue() {
        return this.eInput.value;
    }

    // Gets called once after GUI is attached to DOM.
    afterGuiAttached() {
        this.eInput.focus();
        this.eInput.select();
    }
}

            const gridOptions = {
                columnDefs: [
                    { headerName: 'Date', field: 'date', editable: true,cellStyle: { color: 'white' },
                    headerClass: 'custom-header',  cellEditor: DatePickerEditor,
                cellRenderer: (params) => {
                    // Format the date to a readable format
                    if (params.value) {
                        return new Date(params.value).toLocaleDateString();
                    }
                    return '';
                }},
                    { headerName: 'Eentreprise', field: 'user.nom', editable: true,width: 150, },
                    { headerName: 'User ID', field: 'user_id', editable: true,width: 100, },
                    { headerName: 'ID Indicateur', field: 'id', editable: false,width: 150, },
                    { headerName: 'Trafic Facebook', field: 'trafic_facebook', editable: true,width: 150 },
                    { headerName: 'Trafic Instagram', field: 'trafic_instagram', editable: true,width: 150, },
                    { headerName: 'Trafic Google', field: 'trafic_google', editable: true,width: 150, },
                    { headerName: 'Trafic Site', field: 'trafic_site', editable: true,width: 150, },
                    { headerName: 'Note Facebook', field: 'note_facebook', editable: true,width: 150, },
                    { headerName: 'Note Instagram', field: 'note_instagram', editable: true,width: 150, },
                    { headerName: 'Note Google', field: 'note_google', editable: true,width: 150, },
                    { headerName: 'Note Site', field: 'note_site', editable: true,width: 150, },
                    { headerName: 'Followers Facebook', field: 'followers_facebook', editable: true,width: 150, },
                    { headerName: 'Followers Instagram', field: 'followers_instagram', editable: true,width: 150, },
                    { headerName: 'Followers LinkedIn', field: 'followers_linkedin', editable: true,width: 150, },
                    { headerName: 'Apparition Site', field: 'apparition_site', editable: true },
                    { headerName: 'Apparition Facebook', field: 'apparition_facebook', editable: true },
                    { headerName: 'Apparition Instagram', field: 'apparition_instagram', editable: true },
                    { headerName: 'Commentaire Facebook', field: 'commentaire_facebook', editable: true },
                    { headerName: 'Commentaire Instagram', field: 'commentaire_instagram', editable: true },
                    { headerName: 'Commentaire Google', field: 'commentaire_google', editable: true },
                    { headerName: 'Commentaire Site', field: 'commentaire_site', editable: true },
                    { headerName: 'Observation', field: 'observation', editable: true },
                    { headerName: 'Termes', field: 'termes', editable: true }
                ],
                rowData: @json($indicateurs),
                defaultColDef: {
                    sortable: true,
                    filter: true,
                    resizable: true
                },
                onCellValueChanged: onCellValueChanged,
            };

            const gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);

            document.getElementById('addRowBtn').addEventListener('click', function() {
                const userId = document.getElementById('userDropdown').value;
                const user = users.find(user => user.id == userId);
                const newItem = {
                    id: null,
                    trafic_facebook: 0,
                    trafic_instagram: 0,
                    trafic_google: 0,
                    trafic_site: 0,
                    note_facebook: 0,
                    note_instagram: 0,
                    note_google: 0,
                    note_site: 0,
                    followers_facebook: 0,
                    followers_instagram: 0,
                    followers_linkedin: 0,
                    apparition_site: 0,
                    apparition_facebook: 0,
                    apparition_instagram: 0,
                    date: '',
                    commentaire_facebook: '',
                    commentaire_instagram: '',
                    commentaire_google: '',
                    commentaire_site: '',
                    observation: '',
                    termes: '',
                    user_id: user.id,
                    user: {
                        nom: user.nom
                    }
                };

                // Envoyer la nouvelle ligne au serveur
                fetch('/add-indicateur', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify(newItem)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        newItem.id = data.id; // Mettre à jour l'ID de la nouvelle ligne avec l'ID généré par le serveur
                        gridOptions.api.applyTransaction({
                            add: [newItem],
                            addIndex: 0
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            function onCellValueChanged(event) {
                console.log('Data after change is', event.data);
                console.log('Column Id after change is', event.column.colId);
                console.log('New value is', event.newValue);

                fetch('/update-indicateur', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            id: event.data.id,
                            field: event.column.colId,
                            value: event.newValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
        window.onload = function() {
        function adjustVisibility(tableId, mobileId) {
            var tableContainer = document.getElementById(tableId);
            var mobileContainer = document.getElementById(mobileId);

            if (window.innerWidth <= 768) {
                tableContainer.style.display = 'none';
                mobileContainer.style.display = 'block';
                createMobileView(mobileId);
            } else {
                tableContainer.style.display = 'block';
                mobileContainer.style.display = 'none';
            }
        }

        function createMobileView(containerId) {
            var container = document.getElementById(containerId);
            var data = containerId.includes('user') ? @json($users) : @json($compagnes);
            container.innerHTML = '';

            if (data.length > 0) {
                data.forEach(function(item) {
                    var card = document.createElement('div');
                    card.className = 'article-card';
                    card.innerHTML = generateCardHTML(item, containerId.includes('user'));
                    container.appendChild(card);
                });
            } else {
                var noDataMessage = document.createElement('div');
                noDataMessage.innerText = 'Aucune donnée trouvée.';
                container.appendChild(noDataMessage);
            }
        }

        function generateCardHTML(item, isUser) {
            if (isUser) {
                return `
                        <div class="user-details">
                            <div>${item.entreprise}</div>
                            
                            
                            
                            
                        </div>
                        <div class="user-actions">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Voir</a>
                        </div>
                    `;
            } else {
                return `
                        <div class="campaign-details">
                            <div> ${item.user.entreprise}</div>
                            
                            <div>${item.date_debut}</div>
                            
                        </div>
                        <div class="campaign-actions">
                            <a href="/compagnes/edit/${item.id}" class="btn" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Éditer</a>
                        </div>
                    `;
            }
        }

        // Initial visibility adjustment
        adjustVisibility('user-table-container', 'mobile-user-view-container');
        adjustVisibility('campaign-table-container', 'mobile-campaign-view-container');

        // Reapply visibility adjustment on window resize
        window.onresize = function() {
            adjustVisibility('user-table-container', 'mobile-user-view-container');
            adjustVisibility('campaign-table-container', 'mobile-campaign-view-container');
        };
    };
    </script>
</x-app-layout>
