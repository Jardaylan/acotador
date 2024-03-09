<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acotador extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'acotador';

    protected $fillable = [
        'url_link',
        'token'
    ];
}
