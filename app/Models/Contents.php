<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $table = 'contents';

    protected $fillable = [
        'id','id_category','name','description','image'
    ];

    public function category()
    {
    	return $this->belongsTo('App\Models\Categories', 'id_category');
    }
}
