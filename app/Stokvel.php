<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Stokvel extends Model {

    protected  $table = 'stokvel';

    // has many users
    //public function users()
    //{
        //return $this->hasMany('App\User');
    //}

    // has many payment logs
    public function paymentLogs()
    {
        return $this->hasMany('PaymentLogs', 'stokvel_id');
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


    public function userIsMember($stokvel_id)
    {
        $isMember = UserStokvel::firstByAttributes(array('stokvel_id' => $stokvel_id));
        if($isMember) return true;
        return false;
    }

}
