<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model {

	// has many users
    public function users()
    {
        return $this->hasMany('User', 'province_id')->order();
    }

}
