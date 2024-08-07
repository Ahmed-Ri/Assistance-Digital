<?php

namespace App\Http\Controllers;

use App\Models\Compagne;
use App\Models\ImageUpload;
use App\Models\Indicateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
   
    
    
    
    public function index()
{
    $indicateurs = Indicateur::with('user')->get();
    $users = User::all(['id', 'nom']); // Charger tous les utilisateurs avec leurs IDs et noms

    return view('indicateurs', ['indicateurs' => $indicateurs, 'users' => $users]);
}
public function storee(Request $request)
{
    $validated = $request->validate([
        'trafic_facebook' => 'nullable|integer',
        'trafic_instagram' => 'nullable|integer',
        'trafic_google' => 'nullable|integer',
        'trafic_site' => 'nullable|integer',
        'note_facebook' => 'nullable|numeric',
        'note_instagram' => 'nullable|numeric',
        'note_google' => 'nullable|numeric',
        'note_site' => 'nullable|numeric',
        'followers_facebook' => 'nullable|integer',
        'followers_instagram' => 'nullable|integer',
        'followers_linkedin' => 'nullable|integer',
        'apparition_site' => 'nullable|integer',
        'apparition_facebook' => 'nullable|integer',
        'apparition_instagram' => 'nullable|integer',
        'date' => 'nullable|date',
        'commentaire_facebook' => 'nullable|string',
        'commentaire_instagram' => 'nullable|string',
        'commentaire_google' => 'nullable|string',
        'commentaire_site' => 'nullable|string',
        'observation' => 'nullable|string',
        'termes' => 'nullable|string',
        'user_id' => 'nullable|integer|exists:users,id'
    ]);
    // Log::info('Données validées pour création d\'indicateur:', $validated);
    $indicateur = Indicateur::create($validated);
    
    return response()->json($indicateur);
}
    
    // IndicateurController.php
public function updatee(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|integer|exists:indicateurs,id',
        'field' => 'required|string',
        'value' => 'required',
    ]);

    $indicateur = Indicateur::find($validated['id']);
    if ($indicateur) {
        $indicateur->{$validated['field']} = $validated['value'];
        $indicateur->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}




    // public function storee(Request $request)
    // {
    //     // Valider les données
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'trafic_facebook' => 'required|string',
    //         // Ajouter des règles de validation pour les autres champs
    //     ]);

    //     // Créer un nouvel enregistrement
    //     Indicateur::create($request->all());

    //     // Rediriger ou renvoyer une réponse
    //     return redirect('/indicateurs')->with('success', 'Indicateur ajouté avec succès!');
    // }
    
    public function createCampaign(User $user)
    {
        return view('admin.creerCompagne', compact('user'));
    }

    public function storeCampaign(Request $request, User $user)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'status' => 'required|string',
            'objectif' => 'required|string',
            'reseaux' => 'required|array',
            'details' => 'nullable|string',
            'files.*' => 'sometimes|file|image|max:5000',
        ]);

        $existingCompagne = Compagne::where('date_debut', $request->date_debut)
        ->where('date_fin', $request->date_fin)
        ->where('status', $request->status)
        ->where('objectif', $request->objectif)
        ->whereJsonContains('reseaux', $request->reseaux)
        ->first();

        if (!$existingCompagne) {
            $compagne = new Compagne();
            $compagne->date_debut = $request->input('date_debut');
            $compagne->date_fin = $request->input('date_fin');
            $compagne->status = $request->input('status');
            $compagne->objectif = $request->input('objectif');
            $compagne->reseaux = json_encode($request->input('reseaux'));
            $compagne->details = $request->input('details');
            $compagne->user()->associate($user);
            $compagne->save();

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $filename = $file->store('images', 'public');
                    $image = new ImageUpload();
                    $image->filename = $filename;
                    $image->compagne_id = $compagne->id;
                    $image->save();
                }
            }
        }

        return redirect()->route('home')->with('success', 'Campagne et images sauvegardées avec succès!');
    }
    
public function editCompagne($id)
{
    $compagne = Compagne::with('images')->findOrFail($id);
    return view('admin.editCompagne', compact('compagne'));
}
    public function updateCompagne(Request $request, $id)
    {
        
         // Validation des entrées
    $request->validate([
        'date_debut' => 'required|date',
        'date_fin' => 'required|date',
        'status' => 'required|string',
        'objectif' => 'required|string',
        'reseaux' => 'array',
        'details' => 'nullable|string',
        'files.*' => 'sometimes|file|image|max:5000', // Validation pour les fichiers images
    ]);

    // Récupération de la campagne
    $compagne = Compagne::findOrFail($id);

    // Mise à jour des champs de la campagne
    $compagne->date_debut = $request->input('date_debut');
    $compagne->date_fin = $request->input('date_fin');
    $compagne->status = $request->input('status');
    $compagne->objectif = $request->input('objectif');
    $compagne->reseaux = json_encode ($request->input('reseaux', []));
    $compagne->details = $request->input('details');
    $compagne->save();

    // Gestion des fichiers images
    if ($request->hasFile('files')) {
        // Ajout des nouveaux fichiers
        foreach ($request->file('files') as $file) {
            $filename = $file->store('images', 'public');
            $image = new ImageUpload();
            $image->filename = $filename;
            $image->compagne_id = $compagne->id;
            $image->save();
        }
    }
    return redirect()->route('home')->with('success', 'Informations de l\'utilisateur mises à jour avec succès.');
}

public function deleteimages($id)
{
    $image = ImageUpload::findOrFail($id);
    Storage::delete($image->filename); // Supprime le fichier
    $image->delete(); // Supprime l'entrée de la base de données

    return response()->json(['success' => true]);
}




    public function create()
    {
       
        $users = User::all(); // Récupère tous les utilisateurs
        return view('admin.CreerUtilisateur', compact('users'));
    }
    public function storeAdmin(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|',
        'password' => 'required|string|min:8',
        'telephone' => 'nullable|string|max:255',
        'entreprise' => 'nullable|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'telephoneE' => 'nullable|string|max:255',
        'UrlFacebook' => 'nullable|url',
        'UrlInstagram' => 'nullable|url',
        'UrlGoogle' => 'nullable|url',
        'abonnement' => 'nullable|string|max:255',
        'imageFacebook' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'imageInstagram' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'imageGoogle' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'imageSite' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Création d'une nouvelle instance d'Utilisateur
    $users = new User([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash du mot de passe pour la sécurité
        'telephone' => $request->telephone,
        'entreprise' => $request->entreprise,
        'adresse' => $request->adresse,
        'telephoneE' => $request->telephoneE,
        'UrlFacebook' => $request->UrlFacebook,
        'UrlInstagram' => $request->UrlInstagram,
        'UrlGoogle' => $request->UrlGoogle,
        'abonnement' => $request->abonnement,
    ]);

    $imageFields = ['imageFacebook', 'imageInstagram', 'imageGoogle', 'imageSite'];
    foreach ($imageFields as $imageField) {
        if ($request->hasFile($imageField)) {
            $path = $request->file($imageField)->store('public/images');
            // Convertir le chemin de stockage en URL accessible
            $users->$imageField = Storage::url($path);
        }
    }
    
    
    // Sauvegarde de l'user dans la base de données
    $users->save();

    // Redirection vers une route de votre choix avec un message de succès
    return redirect()->route('home')->with('success', 'Utilisateur ajouté avec succès!');
}
public function edit($userId)
{
    $user = User::findOrFail($userId); // Assurez-vous d'utiliser le modèle User approprié
    return view('admin.Form_utilisateur', compact('user'));
}

public function update(Request $request, $userId)
{
    // Trouver l'utilisateur en utilisant l'ID
    $user = User::findOrFail($userId);

    // Validation des données entrantes
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
        'password' => 'nullable|string|min:8',
        'telephone' => 'nullable|string|max:255',
        'entreprise' => 'nullable|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'telephoneE' => 'nullable|string|max:255',
        'UrlFacebook' => 'nullable|url',
        'UrlInstagram' => 'nullable|url',
        'UrlGoogle' => 'nullable|url',
        'abonnement' => 'nullable|string|max:255',
        'imageFacebook' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'imageInstagram' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'imageGoogle' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'imageSite' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         'status' => 'required|in:pendant,vérifié'
    ]);

    // Mise à jour des champs utilisateur
    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }
    $user->telephone = $request->telephone;
    $user->entreprise = $request->entreprise;
    $user->adresse = $request->adresse;
    $user->telephoneE = $request->telephoneE;
    $user->UrlFacebook = $request->UrlFacebook;
    $user->UrlInstagram = $request->UrlInstagram;
    $user->UrlGoogle = $request->UrlGoogle;
    $user->abonnement = $request->abonnement;
    $user->status = $request->status;

    // Gérer les uploads d'images et mettre à jour les champs correspondants
    $imageFields = ['imageFacebook', 'imageInstagram', 'imageGoogle', 'imageSite'];
    foreach ($imageFields as $imageField) {
        if ($request->hasFile($imageField)) {
            // Supprimer l'ancienne image si elle existe
            if ($user->$imageField) {
                Storage::delete($user->$imageField);
            }

            // Sauvegarder la nouvelle image et mettre à jour le champ
            $path = $request->file($imageField)->store('public/images');
            $user->$imageField = Storage::url($path);
        }
    }

    // Sauvegarder les modifications
    $user->save();

    // Redirection vers une route de votre choix avec un message de succès
    return redirect()->route('home', ['user' => $userId])->with('success', 'Informations de l\'utilisateur mises à jour avec succès.');
}



}
