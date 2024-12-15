<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'status',
        'category_id',
        'due_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id','id');
    }

}
