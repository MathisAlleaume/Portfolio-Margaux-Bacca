<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller{

    public function create(Request $request){
        $video = new Video([
            'Titre' => $request->get('Titre'),
            'Cover' => $request->get('Cover')
        ]);
        $video->save();
        return response('success', 200);
    }

    public function edit(Request $request){
        $video = Video::find($request->get('Id'));
        $video->Titre = $request->get('Titre');
        $video->Lien = $request->get('Lien');
        $video->save();
        return response($video, 200);
    }

    public function getAll()
    {
        return Video::all();
    }

    public function getSingle(Request $request){
        return Video::where('Id', $request->get('Id'))->first();
    }

    public function delete(Request $request){
        Video::where('Id', $request->get('Id'))->delete();
        return response('success', 200);
    }
}

?>
