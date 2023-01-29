<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_main_upload extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];

    public function main_order()
    {
        return $this->hasMany(main_service_user::class);
    }
}
