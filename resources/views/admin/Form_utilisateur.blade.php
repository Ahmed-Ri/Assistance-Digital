<x-app-layout>
    
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Retour</a>

        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="form-wrapper py-5">
                    <h2 class="titre text-center mb-4">Modifier l'Utilisateur</h2>
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label for="nom" class="col-md-3 col-form-label fw-bold">Nom</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prenom" class="col-md-3 col-form-label fw-bold">Prénom</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label fw-bold">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telephone" class="col-md-3 col-form-label fw-bold">Téléphone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $user->telephone }}">
                            </div>
                        </div>
    
                        <h3 class="titre mt-4 mb-3">Informations Entreprise</h3>
                        <div class="form-group row">
                            <label for="entreprise" class="col-md-3 col-form-label fw-bold">Entreprise</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="entreprise" name="entreprise" value="{{ $user->entreprise }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adresse" class="col-md-3 col-form-label fw-bold">Adresse</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $user->adresse }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telephoneE" class="col-md-3 col-form-label fw-bold">Téléphone Entreprise</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="telephoneE" name="telephoneE" value="{{ $user->telephoneE }}">
                            </div>
                        </div>
    
                        <h3 class="titre mt-4 mb-3">Réseaux</h3>
                        <div class="form-group row">
                            <label for="UrlFacebook" class="col-md-3 col-form-label fw-bold">URL Facebook</label>
                            <div class="col-md-9">
                                <input type="url" class="form-control" id="UrlFacebook" name="UrlFacebook" value="{{ $user->UrlFacebook }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="UrlInstagram" class="col-md-3 col-form-label fw-bold">URL Instagram</label>
                            <div class="col-md-9">
                                <input type="url" class="form-control" id="UrlInstagram" name="UrlInstagram" value="{{ $user->UrlInstagram }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="UrlGoogle" class="col-md-3 col-form-label fw-bold">URL Google</label>
                            <div class="col-md-9">
                                <input type="url" class="form-control" id="UrlGoogle" name="UrlGoogle" value="{{ $user->UrlGoogle }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="UrlSite" class="col-md-3 col-form-label fw-bold">URL Site</label>
                            <div class="col-md-9">
                                <input type="url" class="form-control" id="UrlSite" name="UrlSite" value="{{ $user->UrlSite }}">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="abonnement" class="col-md-3 col-form-label fw-bold">Abonnement</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="abonnement" name="abonnement" value="{{ $user->abonnement }}">
                            </div>
                        </div>
                        
                        <!-- Ajout de la sélection de statut -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label fw-bold">Statut</label>
                            <div class="col-md-9">
                                <select id="status" name="status" class="form-control">
                                    <option value="pendant" {{ $user->status == 'pendant' ? 'selected' : '' }}>pendant</option>
                                    <option value="vérifié" {{ $user->status == 'vérifié' ? 'selected' : '' }}>Vérifié</option>
                                </select>
                            </div>
                        </div>
                        <h3 class="titre mt-4 mb-3">Images</h3>
                        <div class="form-group row">
                            <label for="imageFacebook" class="col-md-3 col-form-label fw-bold">Image Facebook</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" id="imageFacebook" name="imageFacebook">
                                @if($user->imageFacebook)
                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $user->imageFacebook)) }}" alt="Image Facebook" class="img-thumbnail mt-2" style="max-width: 150px;">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imageInstagram" class="col-md-3 col-form-label fw-bold">Image Instagram</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" id="imageInstagram" name="imageInstagram">
                                @if($user->imageInstagram)
                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $user->imageInstagram)) }}" alt="Image Instagram" class="img-thumbnail mt-2" style="max-width: 150px;">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imageGoogle" class="col-md-3 col-form-label fw-bold">Image Google</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" id="imageGoogle" name="imageGoogle">
                                @if($user->imageGoogle)
                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $user->imageGoogle)) }}" alt="Image Google" class="img-thumbnail mt-2" style="max-width: 150px;">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imageSite" class="col-md-3 col-form-label fw-bold">Image Site</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" id="imageSite" name="imageSite">
                                @if($user->imageSite)
                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $user->imageSite)) }}" alt="Image Site" class="img-thumbnail mt-2" style="max-width: 150px;">
                                @endif
                            </div>
                        </div>

                      
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
