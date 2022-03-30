<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','module_name','module_code','price','description'];


    public function feature()
    {
        return $this->hasMany(Feature::class);
    }
}
