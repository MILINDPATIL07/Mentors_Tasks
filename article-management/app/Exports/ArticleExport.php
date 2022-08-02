<?php

namespace App\Exports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticleExport implements FromCollection, withHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'id',
            'article_name',
            'article_description',
            'category',
            'image',
            'status'
        ];
    }
    public function collection()
    {
        return Article::all(
            'id',
            'article_name',
            'article_description',
            'category',
            'image',
            'status'
        );
    }
}
