<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cars extends Model
{
    protected $table = "cars";
    public $timestamps = true;

    protected $fillable = [
		'make','model'
	];
}
