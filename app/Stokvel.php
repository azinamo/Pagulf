<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Stokvel extends Model {

    protected  $table = 'stokvel';

    // has many users
    public function users()
    {
        return $this->hasMany('App\User');
    }

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

    public function userIsMember($stokvel_id)
    {
        $isMember = UserStokvel::firstByAttributes(array('stokvel_id' => $stokvel_id));
        if($isMember) return true;
        return false;
    }

}
