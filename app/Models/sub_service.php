<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_service extends Model
{
    use HasFactory;
    protected $guarded =['id','created_at','updated_at'];
    public function main_service()
    {
        return $this->belongsTo(main_service::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('order_number','status')->withTimestamps();
    }
}
