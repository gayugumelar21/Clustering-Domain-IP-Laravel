<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpClassB extends Model
{
    use HasFactory;

    protected $fillable = ['domain', 'ip_address'];
}
