<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    use HasFactory;
    protected $fillable = ["tran_id","product_id","tran_type","amount","tran_detail","prices"];
}
