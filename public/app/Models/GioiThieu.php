<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GioiThieu extends Model
{
    use HasFactory;
    protected $table = 'gioithieu';
    public $primaryKey = 'id';
    protected $fillable =[
        'title', 'content'
    ];
}
