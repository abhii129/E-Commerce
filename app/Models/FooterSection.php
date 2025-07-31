<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/FooterSection.php

class FooterSection extends Model
{
    protected $fillable = ['section_key', 'data'];
    protected $casts = ['data' => 'array'];
}

