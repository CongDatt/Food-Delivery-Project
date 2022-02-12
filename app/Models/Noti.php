<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noti extends Model
{
    protected $fillable = ['user_id', 'title','message', 'status'];
    use HasFactory;
}
