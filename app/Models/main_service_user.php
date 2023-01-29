<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_service_user extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];

    public function users()
    {
        return $this->belongsTo(user::class,'user_id');
    }

    public function main_services()
    {
        return $this->belongsTo(main_service::class,'main_service_id');
    }

    public function admin_main_uploads()
    {
        return $this->belongsTo(admin_main_upload::class);
    }

}
