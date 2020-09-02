<?php

namespace App\Models;
use App\Models\Materials;
use Illuminate\Database\Eloquent\Model;

class Material_Units extends Model
{
    protected $table = "material_units";
    public function material(){
        return $this->hasMany(Materials::class);
    }
}
