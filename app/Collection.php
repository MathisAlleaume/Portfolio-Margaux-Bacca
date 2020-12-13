<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    protected $table = 'collection';
    protected $fillable = [
        'Titre', 'Cover', 'Type', 'Dossier'
    ];
    public $timestamps = true;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
