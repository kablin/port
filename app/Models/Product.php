<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Status;

class Product extends Model
{
    use HasFactory,SoftDeletes, Status;

    protected $table = 'products';
}
