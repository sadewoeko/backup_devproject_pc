<?php

namespace App\Modules\Auth\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use App\User;
use App\Company;
use Auth;
use App\Country;
use App\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use App\Mail\NotifSignUp;
use Redirect;


class AuthPahala extends Controller {
    
    public $controller_name = 'Auth';
  
    public function index() {
        $countries = Country::get();
        $cities = City::get();

        return view($this->controller_name .'::auth', compact('countries', 'cities'));
    }

    public function register(Request $request) {
        $user = User::where('email', $request->input('email'))->first();
        
        $test = input::all();
        if ($user != NULL) {
            return redirect()->route('auth.index')
                             ->with('error-register', 'Email already registered!')
                             ->withInput($test); 
        }

        $password = Hash::make($request->input('password'));    
        
        $rules = ['captcha' => 'required|captcha'];
        
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //return redirect()->route('auth.index')->with('error-register', 'Wrong captcha');
            return Redirect::back()
                             ->with('error-register', 'Wrong captcha')
                             ->withInput($test);
        }

        $user = new User;
        

        $user->image = 0;
        $user->email = $request->input('email');
        $user->full_name = $request->input('full_name');
        $user->gender = $request->input('gender');
        $user->password = $password;
        $user->cellphone = $request->input('cellphonecode') . $request->input('cellphonenumber');
        $user->cellphone2 = $request->input('cellphonecode2') . $request->input('cellphonenumber2');
        $user->address = $request->input('address');
        $user->country_id = $request->input('country_id');
        $user->state_id = $request->input('state_id');
        $user->city_id = $request->input('city_id');
        $user->website = $request->input('website');
        
        
        if ($request->input('buyer_seller') == 'both') {
            $user->seller = 1;
            $user->buyer = 1;
        } else {
            if ($request->input('buyer_seller') == 'seller') {
                $user->seller = 1;
                $user->buyer = 0;
            } else {
                $user->seller = 0;
                $user->buyer = 1;
            }
        }

        $user->status = 0;

        $user->save();

        $get_id = DB::table('users')
                    ->select('id')
                    ->orderBy('id', 'desc')
                    ->limit('1')
                    ->get();
        if(empty($request->input('company_name'))){
            $company = new Company;

            $company->user_id = $get_id[0]->id;
            $company->company_name = 'no data';
            $company->address_company = 'no data';
            $company->office_phone = 0;
            $company->office_phone2 = 0;
            $company->desc_company = 'no data';
            
            $company->save();
            
            Mail::to($request->email)->send(new NotifSignUp($request->input('email'), $request->input('password')));
        
            return redirect()->route('auth.index')->with('status', 'Success.. Then Sign In');
        }else{

        $company = new Company;

        $company->user_id = $get_id[0]->id;
        $company->company_name = $request->input('company_name');
        $company->address_company = $request->input('address_company');
        $company->office_phone = $request->input('office_phone');
        $company->office_phone2 = $request->input('office_phone2');
        if(empty($request->input('desc_company'))){
            $company->desc_company = 'no data';
            }else{
            $company->desc_company = $request->input('desc_company');
            }
        
        $company->save();

        Mail::to($request->email)->send(new NotifSignUp($request->input('email'), $request->input('password')));
        
        return redirect()->route('auth.index')->with('status', 'Success.. Then Sign In');
        }
    }

    public function login(Request $request) {

        $user = User::where('email', $request->input('email'))->first();

        if ($user == NULL) {
            return redirect()->route('auth.sign-in')->with('error-login', 'Email Not Found!');      
        }

        $credential = Hash::make($request->input('password'));

        if (Hash::check($request->input('password'), $user->password)) {
            // create session
            session()->put('email', $user->email);
            session()->put('full_name', $user->full_name);
            session()->put('id', $user->id);
            session()->put('gender',$user->gender);

            return redirect()->route('index')->with('login-message', 'Welcome at pahalakita.com. we hope today is more successful');

        } 

        return redirect()->route('auth.sign-in')->with('error-login', 'Wrong Password!'); 

    }

    public function logout(Request $request) {   
        session()->flush();
        return redirect()->route('index');
    }

    public function signIn() {
        return view($this->controller_name .'::sign-in');
    }

    public function forgotPassword() {
        return view($this->controller_name .'::forgot-password');
    }

    public function resetPassword($token) {
        $user = User::where('token', '=', $token)->first();
        if (empty($user)) {
            return 'Not Found!';
        }
        return view($this->controller_name .'::reset-password', compact('token'));        
    }

    public function submitResetPassword(Request $request)
    {
        $password = Hash::make($request->input('password'));    

        User::where('token', '=', $request->input('token'))
          ->update(['password' => $password]);

        User::where('token', '=', $request->input('token'))
          ->update(['token' => null]);
          
          return redirect()->route('auth.sign-in')->with('success-reset', 'Your password has been changed!');
          
    }

    public function generateForgotPassword(Request $request) {
        $user = User::where('email', '=', $request->input('email'))->first();

        if (empty($user)) {
            return redirect()->route('auth.forgot-password')->with('error-forgot', 'Email Not Found!');                  
        }
        
        $token = $this->generateToken($user);
        $this->storeToken($user->email, $token);
        $this->sendEmailForgot($user->email, $user->full_name, $token);
        
        return redirect()->route('auth.forgot-password')->with('success-forgot', 'We have sent you email to change your password!');
    }

    private function sendEmailForgot($email, $full_name, $token)
    {
        Mail::to($email)->send(new ForgotPassword($full_name, $token));                 
    }

    private function generateToken($user)
    {
        $token = str_replace ('/', '', Hash::make($user->email));
        return $token;
    }

    private function storeToken($email, $token)
    {
        User::where('email', '=', $email)
          ->update(['token' => $token]);
    }
}
