<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenPushNotifications extends Model
{
    use HasFactory;
    protected $fillable=['expo_token','user_id'];
}
