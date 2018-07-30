<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $uploads = '/codehacking/public/images/';


    protected $fillable = ['file'];
    
    //VVI - Below, File of getFileAttribute is from file column of photo table of the database.
    public function getFileAttribute($photo) {
        
        return $this->uploads . $photo;
        
    }
}
