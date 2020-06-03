<?php


namespace App\Models\Base;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

    public function getDeletedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

}
