<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_service_user extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];
    public function users()
    {
        return $this->belongsTo(user::class,'user_id');
    }

    public function sub_services()
    {
        return $this->belongsTo(sub_service::class,'sub_service_id');
    }

    public function admin_sub_uploads()
    {
        return $this->belongsTo(admin_sub_upload::class);
    }

}
