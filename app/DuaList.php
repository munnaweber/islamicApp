<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DuaList extends Model
{
    public function getCat(){
    	return $this->belongsTo("App\MainCategory", "category", "id");
    }
}
