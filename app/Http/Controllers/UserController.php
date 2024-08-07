<?php

namespace App\Http\Controllers;

use App\Models\Compagne;
use App\Models\ImageUpload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function indexForm()
    {
        $users = User::paginate(5);
        return view('formulaire_utilisateur', compact('users'));
    }
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'status' => 'required|string',
            'objectif' => 'required|string',
            'reseaux' => 'required|array',
            'details' => 'nullable|string',
            'files.*' => 'sometimes|file|image|max:5000', // Validation pour les fichiers images
        ]);
    
        // Vérification de l'existence d'une compagne similaire
        $existingCompagne = Compagne::where('date_debut', $request->date_debut)
                                     ->where('date_fin', $request->date_fin)
                                     ->where('status', $request->status)
                                     ->where('objectif', $request->objectif)
                                     ->whereJsonContains('reseaux', $request->reseaux)
                                     ->first();
    
        if (!$existingCompagne) {
            // Création d'une nouvelle compagne si elle n'existe pas déjà
            $compagne = new Compagne();
            $compagne->date_debut = $request->input('date_debut');
            $compagne->date_fin = $request->input('date_fin');
            $compagne->status = $request->input('status');
            $compagne->objectif = $request->input('objectif');
            $compagne->reseaux = json_encode($request->input('reseaux'));
            $compagne->details = $request->input('details');
            $compagne->user()->associate(auth()->user()); // Association avec l'utilisateur connecté
            $compagne->save();
    
            // Gestion des fichiers images
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
    
        // Redirection avec un message de succès
        return redirect()->route('home')->with('success', 'Compagne et images sauvegardées avec succès!');
    }

    
    
    
       
//Méthode Compagne

       public function indexHistorique()
{
    // Récupérer l'ID de l'utilisateur connecté
    $userId = auth()->user()->id;
    // Récupérer les compagnes de l'utilisateur connecté avec pagination
    $compagnes = Compagne::where('user_id', $userId)->with('images')->latest()->paginate(100); 

    // Passer les données à une vue
    return view('historique')->with('compagnes', $compagnes);
}


public function editCompagne($id)
{
    $compagne = Compagne::with('images')->findOrFail($id); // Charge également les images
    return view('FormCompagne', compact('compagne')); // Retourne la vue d'édition avec les données de la campagne
}



public function updateCompagne(Request $request, $id)
{
    // Validation des entrées
    $request->validate([
        'date_debut' => 'required|date',
        'date_fin' => 'required|date',
        'status' => 'required|string',
        'objectif' => 'required|string',
        'reseaux' => 'required|string',
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
    $compagne->reseaux = $request->input('reseaux');
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

    // Redirection avec un message de succès
    return redirect()->route('home')->with('success', 'Compagne mise à jour avec succès!');
}

public function deleteImage($id)
{
    $image = ImageUpload::findOrFail($id);
    Storage::delete($image->filename); // Supprime le fichier
    $image->delete(); // Supprime l'entrée de la base de données

    return response()->json(['success' => true]);
}




}
