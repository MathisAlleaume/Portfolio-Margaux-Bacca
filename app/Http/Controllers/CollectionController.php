<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CollectionController extends Controller
{

    public function create(Request $request)
    {
        $Collection = new Collection([
            'Titre' => $request->get('Titre'),
            'Cover' => $request->get('Cover'),
            'Type' => $request->get('Type'),
            'Dossier' => null
        ]);
        if($request->get('Type') == 1){
            $path = storage_path() . "/app/public/imgs/photos/Collection_" . $Collection->Titre;
        }elseif($request->get('Type') == 2){
            $path = storage_path() . "/app/public/imgs/dessins/Collection_" . $Collection->Titre;
        }

        File::makeDirectory($path, $mode = 0777, true, true);
        $Collection->Dossier = $path;
        $Collection->save();
        return response($Collection, 200);
    }

    public function edit(Request $request)
    {
        $Collection = Collection::find($request->get('Id'));
        $Collection->Titre = $request->get('Titre');
        $Collection->Cover = $request->get('Cover');
        $Collection->Type = $request->get('Type');
        $Collection->save();
        return response($Collection, 200);
    }

    public function getAll()
    {
        return Collection::all();
    }

    public function getSingle(Request $request)
    {
        return Collection::where('Id', $request->get('Id'))->first();
    }

    public function delete(Request $request)
    {
        Collection::where('Id', $request->get('Id'))->delete();
        return response('success', 200);
    }

    public function getPhotos(Request $request)
    {
            return response(Photo::where('Collection_Id', $request->get('Id'))->get(), 200);
    }
}
