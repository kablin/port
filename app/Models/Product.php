<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Traits\Status;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Product extends Model
{
    use HasFactory,SoftDeletes, Status;

    protected $table = 'products';

    protected $fillable = ['article','status','name','data'];

    protected $casts = ['data'=>AsArrayObject::class];

    protected function Status(): Attribute
    {
      return Attribute::make(
        get: fn (string $value) =>  $value=='available' ? "Доступен" : "Недоступен" ,
      );
    }



}
