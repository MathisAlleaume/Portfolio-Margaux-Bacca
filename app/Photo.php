<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    protected $table = 'photo';
    protected $fillable = [
        'Collection_Id', 'Image', 'Periode', 'Lieu'
    ];
    public $timestamps = true;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
