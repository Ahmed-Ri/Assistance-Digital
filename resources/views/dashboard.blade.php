<x-app-layout>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <style>
        .swiper {
            width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .swiper-slide {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .sub-card {
            width: 100%;
            max-width: 180px;
            /* Controls the max size of the cards */
            margin: auto;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rating-number,
        .stars {
            margin-left: 2px;
            margin-right: 2px;
            font-size: 14px;
        }

        .sub-card img {
            width: 180px;
            height: 180px;
        }
    </style>


    <div class="container ">
        <div id="compagnesection">
            <div class="d-flex justify-content-start ">
                <div class="titree mr-2">Bonjour {{ $users->nom }} {{ $users->prenom }} </div>
                <img src="/assets/image/Slt.png" style="width: 30px; height: 30px;" alt="">
            </div>
            <div  style="color: #c2c2c2;">Entreprise {{ $users->entreprise }}</div>
        </div>
        <div class="card mx-auto mt-1 ">
            <h2 class="titre mb-2">Mes pages</h2>
            <div class="swiper mySwiper" id="myCustomSwiper">
                <div class="swiper-wrapper">
                    <!-- Swiper Slide for Facebook -->
                    <div class="swiper-slide">
                        <div class="sub-card">
                            <div class="mb-2 mt-2 d-flex align-items-center justify-content-center">
                                <img src="/assets/image/facebook.png" alt="Icon"
                                    style="width: 20px; height: 20px; vertical-align: middle;">
                                <strong class="rating-number">{{ $derniereNoteFacebook }}</strong>
                                <span class="stars" data-rating="{{ $derniereNoteFacebook }}"></span>
                                <strong style="font-size: 14px;">({{ $Commentaire_facebook }})</strong>
                            </div>
                            @if ($users->imageFacebook)
                                <a href="{{ $users->UrlFacebook }}" target="_blank">
                                    <img src="{{ asset($users->imageFacebook) }}" alt="Image">
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- Swiper Slide for Instagram -->
                    <div class="swiper-slide">
                        <div class="sub-card">
                            <div class="mb-2 mt-2 d-flex align-items-center justify-content-center">
                                <img src="/assets/image/instagram.png" alt="Icon"
                                    style="width: 20px; height: 20px; vertical-align: middle;">
                                {{-- <strong class="rating-number">{{ $derniereNoteInstagram }}</strong>
                                <span class="stars" data-rating="{{ $derniereNoteInstagram }}"></span>
                                <strong style="font-size: 14px;">({{ $Commentaire_instagram }})</strong> --}}
                            </div>

                            @if ($users->imageInstagram)
                                <a href="{{ $users->UrlInstagram }}" target="_blank">
                                    <img src="{{ asset($users->imageInstagram) }}" alt="Image">
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- Swiper Slide for Google -->
                    <div class="swiper-slide">
                        <div class="sub-card">
                            <div class="mb-2 mt-2 d-flex align-items-center justify-content-center">
                                <img src="/assets/image/google.png" alt="Icon"
                                    style="width: 20px; height: 20px; vertical-align: middle;">
                                <strong class="rating-number">{{ $derniereNoteGoogle }}</strong>
                                <span class="stars" data-rating="{{ $derniereNoteGoogle }}"></span>
                                <strong style="font-size: 14px;">({{ $Commentaire_google }})</strong>
                            </div>

                            @if ($users->imageGoogle)
                                <a href="{{ $users->UrlGoogle }}" target="_blank">
                                    <img src="{{ asset($users->imageGoogle) }}" alt="Image">
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- Swiper Slide for Website -->
                    <div class="swiper-slide">
                        <div class="sub-card">
                            <div class="mb-2 mt-2 d-flex align-items-center justify-content-center">
                                <img src="/assets/image/web.png" alt="Icon"
                                    style="width: 20px; height: 20px; vertical-align: middle;">
                                <strong class="rating-number">{{ $derniereNoteSite }}</strong>
                                <span class="stars" data-rating="{{ $derniereNoteSite }}"></span>
                                {{-- <strong style="font-size: 14px;">({{ $Commentaire_site }})</strong> --}}
                            </div>

                            @if ($users->imageSite)
                                <a href="{{ $users->UrlInstagram }}" target="_blank">
                                    <img src="{{ asset($users->imageSite) }}" alt="Image">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination "></div>
                <!-- Add Navigation -->
                <div class="swiper-button-prev my-custom-prev"></div>
                <div class="swiper-button-next my-custom-prev"></div>
            </div>
        </div>

        {{-- <div>
            <form method="GET" id="filters-form">
                <input class="dateInput my-3" type="text" name="daterange" value="01/12/2024 - 31/12/2024" />
            </form>
        </div> --}}

        <div class="card">
            <h2 class="titre">Mes indicateurs</h2>
            <div class="button-container mt-2">
                <button style="padding: 5px;" class="clicked" onclick="showContent('trafic')">Visites</button>
                <button style="padding: 5px;" onclick="showContent('notes')">Notes</button>
                <button style="padding: 5px;" onclick="showContent('followers')">Followers</button>
                <button style="padding: 5px;" onclick="showContent('apparition')">Apparitions</button>
            </div>

            <div style="margin-top: 20px; box-shadow: 1px 2px 4px 1px rgba(0,0,0,0.2);">
                <div id="traficContent" class="content" style="padding: 10px;">
                    <canvas id="graphique1"></canvas>
                </div>

                <div id="notesContent" class="content" style="display: none; padding: 10px;">
                    <canvas id="graphique2"></canvas>
                </div>

                <div id="followersContent" class="content" style="display: none; padding: 10px;">
                    <canvas id="graphique3"></canvas>
                </div>

                <div id="apparitionContent" class="content" style="display: none; padding: 10px;">
                    <canvas id="graphique4"></canvas>
                </div>
            </div>
        </div>





        <div class="card" style="height: 350px;">
             <h2 class="titre">Mes tendances</h2>
            <div class="content-container">
                <div id="requetesContent " class="content">
                    <div class="swiper mySwiper" id="myCustomSwiper">
                        <div class="swiper-wrapper">
                            @foreach (array_chunk($termsArray, 4) as $termChunk)
                                <div class="swiper-slide">
                                    <div class="sub-cardd d-flex flex-column align-items-center justify-content-center">
                                        @foreach ($termChunk as $term)
                                            <div class="termes mb-2">{{ $term }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Navigation -->
                        <div class="swiper-button-prev my-custom-prev"></div>
                        <div class="swiper-button-next my-custom-next"></div>
                    </div>
                </div>
            </div>
        </div>
        










        <div class="card mx-auto mt-2 " id="mes-compagnes-section">
            <div class="compagnes-boutton-responsive ">
                <h2 class=" titre ">Ma compagne</h2>

            </div>
            @if (isset($derniereCompagne))

                <div class="row">
                    <div class="col-md-8"> <!-- Ajustez la taille de la colonne au besoin -->
                        <form action="{{ route('update_form', $derniereCompagne->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- Directive Blade pour spécifier la méthode PUT --}}

                            {{-- Champ Date de début --}}
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="date_debut" name="date_debut"
                                        value="{{ $derniereCompagne->date_debut ?? '' }}" disabled
                                        style="border: 1px solid #ced4da;border-radius: 4px; ">
                                </div>
                            </div>

                            {{-- Champ Date de fin --}}
                            {{-- <div class="form-group row">
                                <label for="date_fin" class="col-sm-4 col-form-label fw-bold text-start">Date
                                    de fin</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="date_fin" name="date_fin"
                                        value="{{ $derniereCompagne->date_fin ?? '' }}" disabled>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row">
                                <label for="status"
                                    class="col-sm-4 col-form-label fw-bold text-start">Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="status" name="status" disabled>
                                        <option value="EnCours"
                                            {{ $derniereCompagne->status == 'EnCours' ? 'selected' : '' }}>
                                            En cours</option>
                                        <option value="publier"
                                            {{ $derniereCompagne->status == 'publier' ? 'selected' : '' }}>
                                            Publier</option>
                                    </select>
                                </div>
                            </div> --}}
                            {{-- Sélecteur Objectif --}}
                            {{-- <div class="form-group row">
                                <label for="objectif"
                                    class="col-sm-4 col-form-label fw-bold text-start">Objectif</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="objectif" name="objectif" disabled>
                                        <option value="fidelisation"
                                            {{ $derniereCompagne->objectif == 'fidelisation' ? 'selected' : '' }}>
                                            Fidélisation</option>
                                        <option value="visibilite"
                                            {{ $derniereCompagne->objectif == 'visibilite' ? 'selected' : '' }}>
                                            Visibilité</option>
                                        <option value="notoriete"
                                            {{ $derniereCompagne->objectif == 'notoriete' ? 'selected' : '' }}>
                                            Notoriété</option>
                                    </select>
                                </div>
                            </div> --}}

                            {{-- Sélecteur Réseaux sociaux --}}
                            {{-- <div class="form-group row">
                                <label for="reseaux" class="col-sm-4 col-form-label fw-bold text-start">Réseaux
                                    sociaux</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="reseaux" name="reseaux" disabled>
                                        <option value="facebook"
                                            {{ $derniereCompagne->reseaux == 'facebook' ? 'selected' : '' }}>
                                            Facebook</option>
                                        <option value="instagram"
                                            {{ $derniereCompagne->reseaux == 'instagram' ? 'selected' : '' }}>
                                            Instagram</option>
                                        <option value="google"
                                            {{ $derniereCompagne->reseaux == 'google' ? 'selected' : '' }}>
                                            Google</option>
                                    </select>
                                </div>
                            </div> --}}

                            {{-- Champ Détails --}}
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="details" name="details" rows="8" disabled
                                        style="border: 1px solid #ced4da; ">{{ $derniereCompagne->details ?? '' }}</textarea>
                                </div>
                            </div>


                            <div class="form-group row images-container">
                                {{-- <label for="details"
                                    class="col-sm-4 col-form-label fw-bold text-start">Photos</label> --}}
                                {{-- Section pour afficher les images téléchargées --}}
                                @if ($derniereImages->isNotEmpty())
                                    <div class="col-sm-8">
                                        <div style="border: 2px dotted #ccc; padding: 10px;" id="images">
                                            <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                                                @foreach ($derniereImages as $image)
                                                    <img src="{{ Storage::url($image->filename) }}" alt="Image"
                                                        style="height: 100px; width: auto; object-fit: cover; margin: 10px;border: 1px solid #ced4da;border-radius: 4px;">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- <p>Aucune image disponible pour cette campagne.</p> --}}
                                @endif
                            </div>

                        </form>
                    </div>
                    <div class="col-md-4">
                        <!-- Espace pour contenu additionnel ou laissé vide -->
                    </div>
                </div>
            @else
                {{-- <p>Aucune campagne récente trouvée.</p> --}}
            @endif
            <div class="compagne_boutton">
                <a href="{{ route('formulaire') }}" class="btn mr-2"
                    style="background-color: #268EE6; color: white; border: none;  cursor: pointer;">+Nouveau</a>
                <a href="{{ route('historique') }}" class="btn btn-outline-primary">Historique</a>
            </div>
        </div>







        <div class="card  mx-auto mt-2">
            <h2 class="titre mb-2">Observations de l'expert</h2>

            <div class=" observation">
                <div style="display: flex; justify-content: center; align-items: center; ">
                    <img src="/assets/image/bonhome.png" style="height: 180px; width: auto; " alt="">
                </div>

                <div class="card obs" style="height: 200px; text-align: left;color: rgb(156, 156, 156); ">
                    {{ $Observation }}
                </div>
            </div>
            <h3>Mise à jour du : {{ $Dates }} </h3>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
       var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1, // Défaut pour les grands écrans
            spaceBetween: 10, // Espace entre les slides
            observer: true, // Permet à Swiper de s'adapter aux changements DOM
            observeParents: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                // Active Swiper seulement à partir de 768px et en dessous
                768: {
                    slidesPerView: 4,
                    spaceBetween: 10
                },
                600: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }
            }
        });
        var mySwiper = new Swiper('.mySwiper', {
            direction: 'horizontal',
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: -40
                }
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            var stars = document.querySelectorAll('.stars');
            stars.forEach(function(star) {
                var rating = parseInt(star.getAttribute('data-rating'));
                var output = [];
                for (var i = 1; i <= 5; i++) {
                    if (i <= rating) {
                        output.push('<i class="fas fa-star" style="color: orange;"></i>'); // Étoile pleine
                    } else {
                        output.push('<i class="far fa-star" style="color: grey;"></i>'); // Étoile vide
                    }
                }
                star.innerHTML = output.join('');
            });
        });


        $(document).ready(function() {
            $('input.rating').each(function() {
                $(this).rating('refresh', {
                    disabled: true, // rend le champ de notation en lecture seule
                    showClear: false, // ne montre pas le bouton de réinitialisation
                    showCaption: true // montre la légende des étoiles si vous souhaitez l'activer
                });
            });
        });


        // $(function() {
        //     // Fonction pour lire une date du stockage local
        //     function getDateFromLocalStorage(key, defaultValue) {
        //         var storedValue = localStorage.getItem(key);
        //         return storedValue ? moment(storedValue, 'YYYY-MM-DD').format('DD/MM/YYYY') : defaultValue;
        //     }

        //     // Initialiser les dates de début et de fin
        //     var startDate = getDateFromLocalStorage('startDate', '28/12/2023');
        //     var endDate = getDateFromLocalStorage('endDate', '03/01/2024');

        //     // Initialiser le daterangepicker
        //     $('input[name="daterange"]').daterangepicker({
        //         opens: 'center',
        //         autoApply: true,
        //         locale: {
        //             format: 'DD/MM/YYYY',
        //             separator: ' - ',
        //             applyLabel: 'Appliquer',
        //             cancelLabel: 'Annuler',
        //             fromLabel: 'De',
        //             toLabel: 'À',
        //             customRangeLabel: 'Personnalisé',
        //             weekLabel: 'Sem',
        //             daysOfWeek: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        //             monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août',
        //                 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        //             ],
        //             firstDay: 1
        //         },
        //         startDate: startDate,
        //         endDate: endDate
        //     }, function(start, end, label) {
        //         // Mettre à jour le localStorage avec les nouvelles dates
        //         localStorage.setItem('startDate', start.format('YYYY-MM-DD'));
        //         localStorage.setItem('endDate', end.format('YYYY-MM-DD'));

        //         // Mise à jour immédiate du daterangepicker avec les nouvelles dates
        //         $('input[name="daterange"]').data('daterangepicker').setStartDate(start.format(
        //             'DD/MM/YYYY'));
        //         $('input[name="daterange"]').data('daterangepicker').setEndDate(end.format('DD/MM/YYYY'));

        //         // Empêcher la soumission immédiate du formulaire
        //         setTimeout(function() {
        //             $('#filters-form').submit();
        //         }, 100); // Retarder légèrement la soumission pour permettre la mise à jour des dates
        //     });
        // });



        // Graphique Trafic
      // Graphique 1 : Trafic
var ctx1 = document.getElementById('graphique1').getContext('2d');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [
            {
                label: 'Instagram',
                data: @json($traficInstagram),
                backgroundColor: 'rgba(255, 159, 64, 0.2)', // Orange clair
                borderColor: 'rgba(255, 159, 64, 1)', // Orange
                borderWidth: 1,
            },
            {
                label: 'Facebook',
                data: @json($traficFacebook),
                backgroundColor: 'rgba(135, 206, 250, 0.2)', // Bleu ciel
                borderColor: 'rgba(135, 206, 250, 1)', // Bleu ciel
                borderWidth: 1,
            },
            {
                label: 'Google',
                data: @json($traficGoogle),
                backgroundColor: 'rgba(0, 255, 0, 0.2)', // Vert clair
                borderColor: 'rgba(0, 255, 0, 1)', // Vert
                borderWidth: 1,
            },
            {
                label: 'Site',
                data: @json($traficSite),
                backgroundColor: 'rgba(169, 169, 169, 0.2)', // Gris clair
                borderColor: 'rgba(169, 169, 169, 1)', // Gris
                borderWidth: 1,
            },
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
        },
        animation: {
            duration: 0
        },
    },
});

// Graphique 2 : Followers
var ctx2 = document.getElementById('graphique2').getContext('2d');
new Chart(ctx2, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [
            {
                label: 'Facebook',
                data: @json($note_facebook),
                backgroundColor: 'rgba(135, 206, 250, 0.2)', // Bleu ciel
                borderColor: 'rgba(135, 206, 250, 1)', // Bleu ciel
                borderWidth: 1,
            },
            {
                label: 'Google',
                data: @json($note_google),
                backgroundColor: 'rgba(0, 255, 0, 0.2)', // Vert clair
                borderColor: 'rgba(0, 255, 0, 1)', // Vert
                borderWidth: 1,
            },
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
        },
        animation: {
            duration: 0
        },
    },
});

// Graphique 3 : Followers
var ctx3 = document.getElementById('graphique3').getContext('2d');
new Chart(ctx3, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [
            {
                label: 'Facebook',
                data: @json($followersFacebook),
                backgroundColor: 'rgba(135, 206, 250, 0.2)', // Bleu ciel
                borderColor: 'rgba(135, 206, 250, 1)', // Bleu ciel
                borderWidth: 1,
            },
            {
                label: 'Instagram',
                data: @json($followersInstagram),
                backgroundColor: 'rgba(255, 159, 64, 0.2)', // Orange clair
                borderColor: 'rgba(255, 159, 64, 1)', // Orange
                borderWidth: 1,
            },
            {
                label: 'LinkedIn',
                data: @json($followersLinkedin),
                backgroundColor: 'rgba(105, 105, 105, 0.2)', // Gris foncé
                borderColor: 'rgba(105, 105, 105, 1)', // Gris foncé
                borderWidth: 1,
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        animation: {
            duration: 0
        }
    }
});

// Graphique 4 : Apparitions
var ctx4 = document.getElementById('graphique4').getContext('2d');
new Chart(ctx4, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [
            {
                label: 'Site',
                data: @json($apparitionSite),
                backgroundColor: 'rgba(169, 169, 169, 0.2)', // Gris clair
                borderColor: 'rgba(169, 169, 169, 1)', // Gris
                borderWidth: 1,
            },
            {
                label: 'Facebook',
                data: @json($apparitionFacebook),
                backgroundColor: 'rgba(135, 206, 250, 0.2)', // Bleu ciel
                borderColor: 'rgba(135, 206, 250, 1)', // Bleu ciel
                borderWidth: 1,
            },
            {
                label: 'Instagram',
                data: @json($apparitionInstagram),
                backgroundColor: 'rgba(255, 159, 64, 0.2)', // Orange clair
                borderColor: 'rgba(255, 159, 64, 1)', // Orange
                borderWidth: 1,
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        animation: {
            duration: 0
        }
    }
});



        function showContent(type) {
            // Masquer tous les contenus
            var contents = document.getElementsByClassName('content');
            for (var i = 0; i < contents.length; i++) {
                contents[i].style.display = 'none';
            }

            // Réinitialiser la couleur de tous les boutons
            var buttons = document.getElementsByTagName('button');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove('clicked');
            }

            // Afficher le contenu correspondant au type sélectionné
            document.getElementById(type + 'Content').style.display = 'block';

            // Mettre en surbrillance le bouton cliqué
            event.currentTarget.classList.add('clicked');
        }

        function adjustStylesForMobile() {
            var contents = document.getElementsByClassName('content');
            // Vérifie si la largeur de l'écran est inférieure ou égale à 720px
            if (window.innerWidth <= 720) {
                for (var i = 0; i < contents.length; i++) {
                    contents[i].style.flexDirection = 'column';
                    contents[i].style.width = '100%';
                    contents[i].style.height = '300px';
                }
            } else {
                for (var i = 0; i < contents.length; i++) {
                    contents[i].style.flexDirection = 'row';
                    contents[i].style.width = '100%';
                    contents[i].style.height = '350px';
                }
            }
        }

        // Ajuster les styles lors du chargement initial
        adjustStylesForMobile();

        // Ajuster les styles lors du redimensionnement de la fenêtre
        window.onresize = adjustStylesForMobile;
    </script>



</x-app-layout>
