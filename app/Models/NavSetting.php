<?php

// app/Models/NavSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nav_bg_color', 
        'nav_text_color',
        'nav_text_list_hover_color',
        'nav_list_bg_hover_color',
    ];
}
