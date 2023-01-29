<?php

namespace App\Http\Resources;
use App\Models\main_service_user;

use Illuminate\Http\Resources\Json\JsonResource;

class orderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $order_status = main_service_user::where("order_number",$this->order_number)->first();
        return [
            "user_name"=>$this->users->name,
            "main_service_name"=>$this->main_services->name,
            "order_number"=>$this->order_number,
            "order_status"=>$order_status->status
        ];
    }
}
