<?php

namespace App\Models;

use Hamcrest\Description;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;


    protected $casts = [
        "language" => "array",
        "date" => "date"
    ];

    protected $fillable = [ 
        "title",
        "description",
        "image",
        "link",
        "date",
        "language",
        "type_id"
    ];



    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technology(){
        return $this->belongsToMany(Technology::class);
    }
}
