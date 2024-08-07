<x-app-layout>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="form-wrapper py-5">
                    <!-- Form starts -->
                    <form action="{{ route('update-compagne', $compagne->id) }}" name="demoform" id="demoform" method="POST" class="dropzone" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Date de début -->
                        <div class="form-group row">
                            <label for="date_debut" class="col-6 col-form-label fw-bold">Date de début:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $compagne->date_debut }}" required style="border: 1px solid #ced4da;border-radius: 4px; width: 100%;">
                            </div>
                        </div>

                        <!-- Date de fin -->
                        <div class="form-group row">
                            <label for="date_fin" class="col-6 col-form-label fw-bold">Date de fin:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $compagne->date_fin }}" required style="border: 1px solid #ced4da;border-radius: 4px; width: 100%;">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group row">
                            <label for="status" class="col-6 col-form-label fw-bold">Status:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status" name="status">
                                    <option value="En cours" @if ($compagne->status == 'En cours') selected @endif>En cours</option>
                                    <option value="Terminée" @if ($compagne->status == 'Terminée') selected @endif>Terminée</option>
                                </select>
                            </div>
                        </div>

                        <!-- Objectif -->
                        <div class="form-group row">
                            <label for="objectif" class="col-6 col-form-label fw-bold">Objectif:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="objectif" name="objectif">
                                    <option value="fidelisation" @if ($compagne->objectif == 'fidelisation') selected @endif>Fidélisation</option>
                                    <option value="visibilite" @if ($compagne->objectif == 'visibilite') selected @endif>Visibilité</option>
                                    <option value="notoriete" @if ($compagne->objectif == 'notoriete') selected @endif>Notoriété</option>
                                </select>
                            </div>
                        </div>

                        <!-- Réseaux sociaux -->
                        <div class="form-group row">
                            <label for="reseaux" class="col-6 col-form-label fw-bold">Réseaux sociaux:</label>
                            <div class="col-sm-8">
                                @php
                                    // Supposons que $compagne est une instance de votre modèle contenant les données existantes
                                    $reseaux = json_decode($compagne->reseaux, true) ?? [];
                                @endphp
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="facebook" name="reseaux[]" value="facebook"
                                        {{ in_array('facebook', $reseaux) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="facebook">Facebook</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="instagram" name="reseaux[]" value="instagram"
                                        {{ in_array('instagram', $reseaux) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="instagram">Instagram</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="google" name="reseaux[]" value="google"
                                        {{ in_array('google', $reseaux) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="google">Google</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="linkedin" name="reseaux[]" value="linkedin" 
                                    {{ in_array('linkedin', $reseaux) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="linkedin">Linkedin</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="tiktok" name="reseaux[]" value="tiktok" 
                                    {{ in_array('tiktok', $reseaux) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tiktok">Tiktok</label>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Détails -->
                        <div class="form-group row">
                            <label for="details" class="col-6 col-form-label fw-bold">Détails:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="details" name="details" rows="3" style="width: 100%;">{{ $compagne->details }}</textarea>
                            </div>
                        </div>

                        <!-- Dropzone File Upload -->
                        <div class="form-group row">
                            <label class="col-6 col-form-label fw-bold">Photo:</label>
                            <div class="col-sm-8 dropzone-previews dropzoneDragArea" style="margin:; padding: 20px; border: 1px dashed #939393; text-align: center; cursor: pointer;">
                                <span class="text-muted">Cliquer ou glisser les images ici</span>
                            </div>
                        </div>

                        <!-- Existing Images with delete option -->
                        <div class="form-group row">
                            <label class="col-12 col-form-label fw-bold">Images actuelles:</label>
                            <div class="row">
                                @forelse ($compagne->images as $image)
                                    <div class="col-6 col-md-3 text-center mb-3" id="image-container-{{ $image->id }}" style="display: flex; flex-direction: column; align-items: center;">
                                        <img src="{{ Storage::url($image->filename) }}" class="img-fluid img-thumbnail" style="height: 100px; width: auto; object-fit: cover;">
                                        <button type="button" class="btn btn-outline-danger mt-2 remove-images" data-id="{{ $image->id }}">X</button>
                                    </div>
                                @empty
                                    <p class="text-center col-12">Aucune image disponible.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-6">
                                <button type="submit" class="btn btn-md btn-primary" id="submit-all" style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Enregistrer</button>
                                <a href="{{ route('home') }}" class="btn btn-outline-primary">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <script>
             Dropzone.autoDiscover = false; // Essential to prevent automatic instantiation.
    
    // Initialization of Dropzone
    var myDropzone = new Dropzone("#demoform", {
        url: "{{ route('update-compagne', $compagne->id) }}",
        autoProcessQueue: false,
        previewsContainer: 'div.dropzone-previews',
        clickable: 'div.dropzone-previews', // Make the preview container clickable
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 10,
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        paramName: "files", // The name that will be used to transfer the file
        dictDefaultMessage: "", // Removes default message
        init: function() {
            var submitButton = document.getElementById("submit-all");
            var form = document.getElementById("demoform");

            submitButton.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (this.getQueuedFiles().length > 0) {
                    this.processQueue(); // Process the files queued for upload
                } else {
                    form.submit(); // Submit form directly if no files are queued for upload
                }
            }.bind(this)); // Bind this Dropzone instance to function

            this.on("queuecomplete", function() {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    form.submit(); // submit form when all files are uploaded
                }
            });

            this.on("sending", function(file, xhr, formData) {
                formData.append("_token", document.querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'));
            });

            this.on("successmultiple", function(files, response) {
                console.log("Success!", response);
            });

            this.on("errormultiple", function(files, response) {
                console.log("Error!", response);
            });
        }
    });
       

            // Gestion de la suppression des images avec une requête AJAX
            document.querySelectorAll('.remove-images').forEach(button => {
                button.addEventListener('click', function() {
                    const imageId = this.getAttribute('data-id');
                    if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
                        fetch(`/delete_images/${imageId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Supprimez le conteneur de l'image du DOM
                                    const imageElement = document.getElementById(`image-container-${imageId}`);
                                    if (imageElement) {
                                        imageElement.remove();
                                    }
                                } else {
                                    alert("Erreur lors de la suppression de l'image.");
                                }
                            })
                            .catch(error => {
                                console.error('Erreur:', error);
                                alert("Erreur de communication avec le serveur.");
                            });
                    }
                });
            });
        
    </script>

</x-app-layout>
