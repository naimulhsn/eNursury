<?php

namespace app\Http\Controllers\Auth;

use app\User;
use app\General;
use app\Seller;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use app\Rules\ValidGender;
use app\Rules\ValidPhone;
class RegisterController extends Controller
{
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['type']=='general'){
            return Validator::make($data, [
                'type' =>'required',
                'name' => ['required', 'string', 'max:255'],
                'district' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        }
        else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'district' => ['required','string'],
                'location' => ['required','string'],
                'about' => ['required','string'],
                'cover' => ['required','max:100000000|mimes:jpg,jpeg,png,gif,svg'],
                'phone'=> [new ValidPhone],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \app\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        
        $access_key = '77b849298045c6710081ba2e64687cee';
        // Initialize CURL:
        $ch = curl_init('http://api.ipstack.com/check?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);
        // Decode JSON response:
        $api_result = json_decode($json, true);
        $latitude = $api_result['latitude'];
        $longitude = $api_result['longitude'];


        if($data['type']=='general'){
            $genral=General::create([
                'name' => $data['name'],
                'user_id' => $user->id,
                'district' => $data['district'],
                'latitude' => $latitude,
                'longitude' => $longitude
            ]);
        }
        else{
            $seller = Seller::create([
                'name' => $data['name'],
                'user_id' => $user->id,
                'district' => $data['district'],
                'location' => $data['location'],
                'about' => $data['about'],
                'phone' => $data['phone'],
                'latitude' => $latitude,
                'longitude' => $longitude,
                'distance' => $latitude*$longitude*100
            ]);
        }
        return $user;
    }
}
