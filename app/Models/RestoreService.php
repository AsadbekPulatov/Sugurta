<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestoreService extends Model
{
    use HasFactory;

    public function user_service(){
        return $this->belongsTo(UserService::class, 'user_service_id', 'id');
    }
}
