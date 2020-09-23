<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //avoid Massassignment errorrrrs
    protected $fillable = ['name'];
}
