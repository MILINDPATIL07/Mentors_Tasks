<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdminExport implements FromCollection, withHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',

        ];
    }
    public function collection()
    {
        return User::all( 'id',
        'name',
        'email',
       );
    }
}
