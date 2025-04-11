<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LienHe extends Model
{
    protected $table = 'lienhe';
    protected $primaryKey = 'lienhe_id';
    protected $fillable = ['hovaten', 'email', 'diachi', 'sdt', 'loinhan'];
    use HasFactory;
}
