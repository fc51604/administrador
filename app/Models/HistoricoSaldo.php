<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class HistoricoSaldo extends Model 
{
    protected $table = 'HistoricoSaldo';
    protected $primaryKey = 'IdSaldo';
    public $incrementing = false;
    public $timestamps = false;
}