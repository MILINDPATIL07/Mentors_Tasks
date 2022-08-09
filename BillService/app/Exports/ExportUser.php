<?php
namespace App;
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection, withHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return ['id','name','email','gender','age','status','photo'.'approve' ];
    }
    public function collection()
    {
        return User::all( 'id','name','email','gender','age','status','photo','approve'
       );
    }
}
