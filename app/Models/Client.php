<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function building(){
        return $this->belongsTo('App\Models\Building');
    }

    public function package(){
        return $this->belongsTo('App\Models\Package');
    }

}
