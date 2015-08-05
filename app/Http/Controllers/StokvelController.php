<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Stokvel;
use App\UserStokvel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use Auth;
use DB;

class StokvelController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $stokvels = Stokvel::all();
        return view('stokvels.list', array('stokvels' => $stokvels));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('stokvels.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $rules = array(
            'name' => 'required',
            'start_date' => 'required',
            'end_date'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('stokvels/create')->withErrors($validator)->withInput();
        } else {
            $stokvel = new Stokvel();
            $stokvel->name = Input::get('name');
            $stokvel->amount = Input::get('amount');
            $start_date = str_replace('/', '-', Input::get('start_date'));
            $end_date = str_replace('/', '-', Input::get('end_date'));

            $stokvel->start_date = date('Y-m-d', strtotime($start_date));
            $stokvel->end_date   = date('Y-m-d', strtotime($end_date));
            $stokvel->is_active  = (Input::get('is_active') == 'on' ? TRUE : FALSE) ;
            $stokvel->save();

            Session::flash('message', 'Successfully created stokvel');
            return Redirect::to('stokvels');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $stokvel = Stokvel::find($id);
        return view('stokvels.edit')->with('stokvel', $stokvel);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $rules = array(
            'name' => 'required',
            'start_date' => 'required',
            'end_date'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('stokvels/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            $stokvel = Stokvel::find($id);
            $stokvel->name = Input::get('name');
            $stokvel->amount = Input::get('amount');
            $start_date = str_replace('/', '-', Input::get('start_date'));
            $end_date = str_replace('/', '-', Input::get('end_date'));

            $stokvel->start_date = date('Y-m-d', strtotime($start_date));
            $stokvel->end_date   = date('Y-m-d', strtotime($end_date));
            $stokvel->is_active  = (Input::get('is_active') == 'on' ? TRUE : FALSE) ;
            $stokvel->save();

            Session::flash('message', 'Successfully updated stokvel');
            return Redirect::to('stokvels');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $stokvel = Stokvel::find($id);
        $stokvel->delete();

        Session::flash('message', 'Successfully deleted stokvel');
        return Redirect::to('stokvels');
	}


    public function join($id)
    {
        $userStokvel = new UserStokvel();
        $userStokvel->user_id = Auth::user()->id;
        $userStokvel->stokvel_id = $id;
        $userStokvel->save();

        Session::flash('message', 'You have successfully joined the stokvel');
        return Redirect::to('stokvels');
    }


    public function exitStokvel($id)
    {
        $userStokvel = UserStokvel::firstByAttributes(array('user_id' => Auth::user()->id, 'stokvel_id' => $id ));
        if($userStokvel)
        {
           $userStokvel->delete();
        }

        Session::flash('message', 'You have successfully exited the stokvel');
        return Redirect::to('stokvels');
    }

    public function invite($id)
    {
       return view('stokvels.invite', array('stokvel' => Stokvel::find($id)));
    }

    public function sendInvite($id)
    {
        $stokvel = Stokvel::find($id);
        Mail::send('emails.invite', array('' => ''), function($message){
            $message->to(Input::get('email_address'))->subject(Auth::user()->first_name.' invited you to join '.$stokvel->name);
        });
    }

    public function users($id)
    {
        $user_stokvel = UserStokvel::where('stokvel_id', '=', $id)->get();
        return view('stokvels.users', array('user_stokvel' => $user_stokvel, 'stokvel' => Stokvel::find($id)));
    }

    public function generate($id)
    {
        $stokvel_users = UserStokvel::where('stokvel_id', '=', $id)->get();
        $list = array();
        $available_positions = 0;
        foreach($stokvel_users as $stokvel_user)
        {
            $list[$stokvel_user->user->province_id][] = $stokvel_user->user_id;
            $available_positions++;
        }
        $positions = range(1, $available_positions);
        //echo "positions -- ".$available_positions;
        $i = 0;
        foreach($list as $province => $province_users)
        {
            array_rand($province_users);
            foreach($province_users as $index => $user)
            {
                if(isset($positions[$i]))
                {
                    $user_positions[$user] = $positions[$i];
                }
                $i++;
            }
        }
        foreach($stokvel_users as $stokvel_user)
        {
            if(isset($user_positions[$stokvel_user->user_id]))
            {
                //$stk = UserStokvel::find($stokvel_user->id);
                //$stk->position = $user_positions[$stokvel_user->user_id];
                //$stk->save();
                DB::table('user_stokvels')
                    ->where('stokvel_id', $stokvel_user->stokvel_id)->where('user_id', $stokvel_user->user_id)
                    ->update(['position' => $user_positions[$stokvel_user->user_id]]);
            }
        }
        DB::table('stokvel')->where('id', $id)->update(['has_payment_order' => TRUE]);

        Session::flash('message', 'You have successfully generated the stokvel payment order');
        return Redirect::to('stokvels/users/'.$id);
    }
}
