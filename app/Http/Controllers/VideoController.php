<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller{

    public function create(Request $request){
        $video = new Video([
            'Titre' => $request->get('Titre'),
            'Lien' => $request->get('lien')
        ]);
        $video->save();
        return response('success', 200);
    }

    public function getAll()
    {
        return Video::all();
    }

    public function getSingle(Request $request){
        return Video::where('Id', $request->get('Id'))->first();
    }
}

?>
