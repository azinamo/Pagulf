<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $provinces = array(
            array('id' => '1','name' => 'Gauteng'),
            array('id' => '2','name' => 'Western Cape'),
            array('id' => '3','name' => 'Eastern Cape'),
            array('id' => '4','name' => 'Kwazulu Natal'),
            array('id' => '5','name' => 'North West'),
            array('id' => '6','name' => 'Limpopo'),
            array('id' => '7','name' => 'Free State'),
            array('id' => '8','name' => 'Mpumalanga'),
            array('id' => '9','name' => 'Northern Cape')
        );

        DB::table('provinces')->insert( $provinces );

    }

}
