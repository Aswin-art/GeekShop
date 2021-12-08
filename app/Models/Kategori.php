<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];

   /**
    * Get all of the comments for the Kategori
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function produk()
   {
       return $this->hasMany(Produk::class);
   }
}
