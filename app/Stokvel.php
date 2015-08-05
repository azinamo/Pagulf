<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Auth;
class Stokvel extends Model {

    protected  $table = 'stokvel';


    // has many payment logs
    public function paymentLogs()
    {
        return $this->hasMany('PaymentLogs', 'stokvel_id')->order();
    }

    // has many payment orders
    public function paymentOrders()
    {
        return $this->hasMany('PaymentOrder', 'stokvel_id')->order();
    }

    // has many payment orders
    public function userStokvels()
    {
        return $this->belongsToMany('App\UserStokvel', 'user_stokvels');
    }

    // has many payment orders
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_stokvels');
    }


    public function userIsMember($stokvel_id, $user_id)
    {
        $isMember = UserStokvel::firstByAttributes(array('stokvel_id' => $stokvel_id, 'user_id' => $user_id));
        if($isMember) return true;
        return false;
    }

}
