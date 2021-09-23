<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderinternal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderitems()
    {
        return $this->hasMany('App\Models\Oderitem');

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

}
