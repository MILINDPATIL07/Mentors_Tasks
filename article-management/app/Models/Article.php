<?php
namespace App;
namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Article extends Model
{
    use Sortable;
    // use HasFactory;
    protected $fillable = [
        'article_name',
        'article_description',
        'category',
        'image',
        'created_by',
        'status',
    ];
    public $sortable = ['id', 'article_name', 'article_description', 'category', 'image','created_by','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
