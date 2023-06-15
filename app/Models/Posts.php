<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // definisi class
    protected $table = "posts";

    protected $fillable = [
        'title',
        'content'
    ];
}


?>

<!--  -->
