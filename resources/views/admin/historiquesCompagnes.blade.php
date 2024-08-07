<x-app-layout>
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-outline-primary mb-2">Retour</a>
        <table class="table table-secondary">
            <thead class="custom-thead">
                <tr>
                    <th>Vendeur</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    
                    <th>Objectif</th>
                    <th>Réseaux</th>
                    <th>Détails</th>
                    {{-- <th>Photo</th> --}}
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compagnes as $compagne)
                    <tr>
                        <td>{{ $compagne->User->name }}</td>
                        <td>{{ $compagne->date_debut }}</td>
                        <td>{{ $compagne->date_fin }}</td>
                        
                        <td>{{ $compagne->objectif }}</td>
                        <td>{{ $compagne->reseaux }}</td>
                        <td>{{ $compagne->details }}</td>
                        {{-- <td>
                            @if ($compagne->photo)
                                <img src="{{ asset($compagne->photo) }}"
                                    alt="Photo"style="width: 50px; height: 50px;">
                            @else
                                Aucune photo disponible
                            @endif
                        </td> --}}
                        <td>{{ $compagne->status }}</td>
                        <td>
                            <a href="{{ route('edit-compagne', $compagne->id) }}" class="btn" style="background-color: #268EE6; color: white; border: none;  cursor: pointer;">Éditer</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>

</x-app-layout>

  