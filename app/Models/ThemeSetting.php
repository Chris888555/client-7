<?php

// app/Models/ThemeSetting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = [
    'sidebar_bg',
    'nav_hover_bg_color',
    'nav_text_color',
    'nav_text_hover_color',
    'icon_bg_color', 
    'icon_text',
    'logo_color',
];

}