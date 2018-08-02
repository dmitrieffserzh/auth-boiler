<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/';


    public function __construct() {
        $this->middleware('guest');
    }


    protected function validator(array $data) {
        return Validator::make($data, [
            'nickname'   => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:30',
            'last_name'  => 'required|string|max:30',
            'birthday'   => 'required|string|max:255',
            'gender'     => 'required|integer|min:1|max:2',
        ]);
    }


    protected function create(array $data) {

    	// Create user
        $user = User::create([
            'nickname'                => $data['nickname'],
            'email'                   => $data['email'],
            'password'                => Hash::make($data['password']),
            'registration_ip'         => request()->ip(),
            'registration_user_agent' => request()->header('User-Agent'),
        ]);

	    // Create user profile
	    $profile              = new Profile();
	    $profile->first_name  = $data['first_name'];
	    $profile->last_name   = $data['last_name'];
	    $profile->birthday    = $data['birthday'];
	    $profile->gender      = $data['gender'];

	    $user->profile()->save($profile);

	    return $user;
    }
}
