<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;
    protected $table = 'agences';
    protected $fillable =['name','code'];
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
    ];
}
