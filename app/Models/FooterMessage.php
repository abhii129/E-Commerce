<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterMessage extends Model
{
    // Specify the table name if it doesn't follow Laravel's convention
    protected $table = 'footer_messages'; // Optional if you have custom table name

    // Define fillable attributes (columns that can be mass-assigned)
    protected $fillable = ['section', 'message'];
}
