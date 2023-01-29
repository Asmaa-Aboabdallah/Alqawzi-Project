<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P2P_service extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];
    public function users()
    {
        return $this->belongsTo(user::class,'user_id');
    }

    public function order()
    {
        return $this->belongsTo(sub_service_user::class,'subOrder_id');
    }
}
