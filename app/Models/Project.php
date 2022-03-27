<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['project_name','client_name'];

    public function module()
    {
        return $this->hasMany(Module::class);
    }
}
