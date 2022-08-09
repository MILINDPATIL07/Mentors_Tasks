<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'Service_Type'
    ];

    /**
     * The Users that belong to the Services.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
