<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller{

    public function create(Request $request){
        $files = $request->get('files');
        $collection = Collection::find($request->get('collectionID'));
        if($collection->Type == 1){
            $path = storage_path() . "/app/public/imgs/photos/Collection_" . $collection->Titre."/";
        }elseif($collection->Type == 2){
            $path = storage_path() . "/app/public/imgs/dessins/Collection_" . $collection->Titre."/";
        }
        foreach($files as $img){
            $photo = new Photo([
                'Collection_Id' => $collection->Id,
                'Image' => null
            ]);
            $photo->save();
            $photo->Image = $collection->Titre.$photo->Id;
            $photo->save();
            // Storage::put($path, $img->file);
            return($img);
        }

        return response('success', 200);
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
