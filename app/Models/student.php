<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\rombel;
use App\Models\rayon;
use App\Models\lates;


class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'rombel_id',
        'rayon_id',
    ];

   
        
          
            public function rombel()
            {
                return $this->belongsTo(rombel::class, 'rombel_id');
            }
        
            public function rayon()
            {
                return $this->belongsTo(rayon::class, 'rayon_id');
            }
            public function lates()
            {
                return $this->hasMany(Lates::class);
            }
}
