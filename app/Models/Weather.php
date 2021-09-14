<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Weather extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static $key = "e9f8e4047ae6e82cd069175f9d123a8b";
    public static $url = "http://api.openweathermap.org/data/2.5/weather?q=";

    public static function forecast($city)
    {
       return Http::get(self::$url . trim($city, '"\'') . '&appid=' . self::$key);
    }
}
