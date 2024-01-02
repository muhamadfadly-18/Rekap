<?php

namespace App\Exports;

use App\Models\student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LatesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return student::with(['rombel', 'rayon', 'lates'])
            ->select('nis', 'name', 'rombel_id', 'rayon_id')
            ->withCount('Lates') 
            ->get()
            ->map(function ($student) {
                return [
                    'NIS' => $student->nis,
                    'Nama' => $student->name,
                    'Rombel' => $student->rombel->rombel, // Ambil nilai rombel dari relasi
                    'Rayon' => $student->rayon->rayon, // Ambil nilai rayon dari relasi
                    'Total Keterlambatan' => $student->lates_count,
                ];
            });
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Rombel', 'Rayon', 'Total Keterlambatan'];
    }
}