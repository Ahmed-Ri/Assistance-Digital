<x-app-layout>


    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <div class="container" style="font-family: 'Roboto', sans-serif;">
        <div class="row">
            <div class="Col-12 col-lg-6 offset-lg-3">
                <div class="form-wrapper py-5">
                    <!-- form starts -->
                    <form action="{{ route('sauvegarder_donnees') }}" name="demoform" id="demoform" method="POST"
                        class="dropzone" enctype="multipart/form-data">

                        @csrf
                        
                        <h2 class="titre mb-4 text-center">Ajouter compagne</h2>
                        <div class="form-group row ">
                            <label for="date_debut" class="col-6 col-form-label fw-bold ">Date de début:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date_debut" name="date_debut" required 
                                       style="border: 1px solid #ced4da;border-radius: 4px; width: 100%;"> <!-- Added border-radius here -->
                            </div>
                        </div>
                        
                        <div class="form-group row ">
                            <label for="date_fin" class="col-6 col-form-label fw-bold ">Date de fin:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date_fin" name="date_fin" required 
                                       style="border: 1px solid #ced4da;border-radius: 4px;"> <!-- Added border-radius here -->
                            </div>
                        </div>
                        

                        <div class="form-group row ">
                            <label for="status" class="col-6 col-form-label fw-bold ">Statut:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status" name="status" disabled>
                                    <option value="En cours">En cours</option>
                                    <option value="Publier">Terminée</option>
                                </select>
                                <input type="hidden" name="status" value="En cours">
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="objectif" class="col-6 col-form-label fw-bold ">Objectif:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="objectif" name="objectif">
                                    <option value="fidelisation">Fidélisation</option>
                                    <option value="visibilite">Visibilité</option>
                                    <option value="notoriete">Notoriété</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reseaux" class="col-6 col-form-label fw-bold">Réseaux sociaux:</label>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="facebook" name="reseaux[]" value="facebook">
                                    <label class="form-check-label" for="facebook">Facebook</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="instagram" name="reseaux[]" value="instagram">
                                    <label class="form-check-label" for="instagram">Instagram</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="google" name="reseaux[]" value="google">
                                    <label class="form-check-label" for="google">Google</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="linkedin" name="reseaux[]" value="linkedin">
                                    <label class="form-check-label" for="linkedin">Linkedin</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="tiktok" name="reseaux[]" value="tiktok">
                                    <label class="form-check-label" for="tiktok">Tiktok</label>
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-group row ">
                            <label for="details" class="col-6 col-form-label fw-bold ">Détails:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="details" name="details" rows="3"style=" width: 100%;"></textarea>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label  class="col-6 col-form-label fw-bold ">Photo:</label>
                            <div class="col-sm-8 dropzone-previews dropzoneDragArea" style="margin:; padding: 20px; border: 1px dashed #939393; text-align: center; cursor: pointer;">
                                <span class="text-muted">Cliquer ou glisser les images ici</span>
                            </div>
                        </div>
                        <div class="form-group "style="text-align: center;">
	        				<button type="submit" class="btn btn-md btn-primary" id="submit-all"style="background-color: #268EE6; color: white; border: none; cursor: pointer;">Enregistrer</button>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">Annuler</a>

	        			</div>
                       
                    </form>
                    <!-- form end -->
                </div>
            </div>
        </div>
    </div>


    <script>
        Dropzone.autoDiscover = false; // Essential to prevent automatic instantiation.
    
        // Initialization of Dropzone
        var myDropzone = new Dropzone("#demoform", {
            url: "{{ route('sauvegarder_donnees') }}",
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
    </script>
    
    <style>
        .dz-message { display: none; }
    </style>
    



</x-app-layout>
