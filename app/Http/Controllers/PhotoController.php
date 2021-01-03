<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller{

    public function create(Request $request){
        $collection = Collection::find($request->get('collection'));
        $a = [];
        if($collection->Type == 1){
            $path = "/public/imgs/photos/Collection_" . $collection->Titre."/";
        }elseif($collection->Type == 2){
            $path = "/public/imgs/dessins/Collection_" . $collection->Titre."/";
        }

            $photo = new Photo([
                'Collection_Id' => $collection->Id,
                'Image' => null
            ]);

            $cpt = Photo::where("Collection_Id", $collection->Id)->count();
            $cpt++;
            $fichier = $request->file('file');
                $photo->Image = "test";
            $extension =pathinfo($request->file->getClientOriginalName(), PATHINFO_EXTENSION);
            Storage::put($path."/".$photo->Image.".".$extension, $fichier);

            // $photo->save();
            // $photo->Image = $collection->Titre."-".$cpt;
            // $photo->save();
            // $fullpath = $path."-".$photo->Image;


        return response($fichier, 200);
    }

    public function edit(Request $request){
        $video = Photo::find($request->get('Id'));
        $video->Titre = $request->get('Titre');
        $video->Lien = $request->get('Lien');
        $video->save();
        return response($video, 200);
    }

    public function getAll()
    {
        return Photo::all();
    }

    public function getSingle(Request $request){
        return Photo::where('Id', $request->get('Id'))->first();
    }

    public function delete(Request $request){
        Photo::where('Id', $request->get('Id'))->delete();
        return response('success', 200);
    }

}

?>
