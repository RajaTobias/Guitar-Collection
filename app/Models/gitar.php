<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gitar extends Model
{
    use SoftDeletes;
 
    protected $table = "gitar";
   protected $dates = ['deleted_at'];
   public $timestamps = true;
   protected $useSoftDeletes = true;
}
