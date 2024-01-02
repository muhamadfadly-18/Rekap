<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lates extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date_time',
        'information',
        'bukti',

    ];

    // Definisikan relasi belongsTo dengan model Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id','id'); // Sesuaikan dengan nama foreign key yang Anda gunakan
    }
}
