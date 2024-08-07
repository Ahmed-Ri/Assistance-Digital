

<x-app-layout>
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Retour</a>

        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
                <div class="form-wrapper py-5">
                    <form class="mt-2" action="{{ route('utilisateur.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- CSRF token for security -->
                        
                        <h2 class="titre text-center mb-4">Ajouter utilisateur</h2>
                        
                        
                        <div class="form-group row">
                            <label for="nom" class="col-6 col-form-label fw-bold">Nom:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prenom" class="col-6 col-form-label fw-bold">Prénom:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-6 col-form-label fw-bold">Email:</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password" class="col-6 col-form-label fw-bold">Mot de passe:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="telephone" class="col-6 col-form-label fw-bold">Téléphone:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="entreprise" class="col-6 col-form-label fw-bold">Entreprise:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="entreprise" name="entreprise" placeholder="Entreprise">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="adresse" class="col-6 col-form-label fw-bold">Adresse:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="telephoneE" class="col-6 col-form-label fw-bold">Téléphone Entreprise:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="telephoneE" name="telephoneE" placeholder="Téléphone Entreprise">
                            </div>
                        </div>
                        
                        <!-- Social Media URLs -->
                        <div class="form-group row">
                            <label for="UrlFacebook" class="col-6 col-form-label fw-bold">URL Facebook:</label>
                            <div class="col-sm-6">
                                <input type="url" class="form-control" id="UrlFacebook" name="UrlFacebook" placeholder="URL Facebook">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="UrlInstagram" class="col-6 col-form-label fw-bold">URL Instagram:</label>
                            <div class="col-sm-6">
                                <input type="url" class="form-control" id="UrlInstagram" name="UrlInstagram" placeholder="URL Instagram">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="UrlGoogle" class="col-6 col-form-label fw-bold">URL Google:</label>
                            <div class="col-sm-6">
                                <input type="url" class="form-control" id="UrlGoogle" name="UrlGoogle" placeholder="URL Google">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="UrlSite" class="col-6 col-form-label fw-bold">URL Site:</label>
                            <div class="col-sm-6">
                                <input type="url" class="form-control" id="UrlSite" name="UrlSite" placeholder="URL Site">
                            </div>
                        </div>
                        
                        <!-- File Inputs for Images -->
                        <div class="form-group row">
                            <label for="imageFacebook" class="col-6 col-form-label fw-bold">Image Facebook:</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="imageFacebook" name="imageFacebook">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="imageInstagram" class="col-6 col-form-label fw-bold">Image Instagram:</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="imageInstagram" name="imageInstagram">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="imageGoogle" class="col-6 col-form-label fw-bold">Image Google:</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="imageGoogle" name="imageGoogle">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="imageSite" class="col-6 col-form-label fw-bold">Image Site:</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="imageSite" name="imageSite">
                            </div>
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-md btn-primary" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
