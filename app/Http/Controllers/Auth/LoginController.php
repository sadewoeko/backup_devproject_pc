<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
/*
|--------------------------------------------------------------------------
| Model yang berkaitan dengan General Controller
|--------------------------------------------------------------------------
*/
use Models\sessions as Sessions;
use App\Models\menu as ModelMenu;
use App\Models\user as ModelUser;
use App\user as User;
use DateTime;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	
	
	public function login()
    {
        $username=request()->input('username');
        $password=request()->input('password');
        $res='Login Berhasil';
        
		$succes_ldap = true;
        if ($succes_ldap == true){
            $Sessions = new Sessions();
            $cekSession = $Sessions->cekSession($username);
            if (Auth::attempt(['username' => $username, 'password' => 'ebi'])) {
                if(!$cekSession){
                    $deleteSession = $Sessions::where('username','=',$username)->delete();
                }
                
                $succesAuth = true;
                if(Auth::user()['status'] == 1){
                    $kill_at = Auth::user()['kill_at'];    
                    $date = new DateTime($kill_at);
                    $now = new DateTime();
                    
                    $diff  = date_diff( $date, $now );
                    $jam = $diff->h;
                    $menit = $diff->i;
                    $interval = (($jam * 60) + $menit);
                    if($interval > 60){
                        $userModel = new User();
                        $userModel = $userModel::where('nik',"=",Auth::user()['nik'])->first();
                        $userModel->status = 0;
                        try 
                        {
                            $userModel->save();
                        } 
                        catch (Illuminate\Database\QueryException $e) 
                        {
                            $res = $e->errorInfo[1];
                            $succesAuth = false;
                        }
                    }
                    else{
                        $succesAuth = false;
                        $res ="User Inactive";
                    }
                }
                
                if($succesAuth){
                    session()->put('nik',Auth::user()['nik']);
                    session()->put('username',Auth::user()['username']);
                    session()->put('nama',Auth::user()['nama']);
                    session()->put('job',Auth::user()['job']);			
                    session()->put('menu',ModelMenu::listMenuLevel());
                    session()->put('listmenu',ModelMenu::listLinkMenuAktif());
                    
                    // insert to session
                    $Sessions['id'] = session()->getId();
                    $Sessions['username'] = $username;
                    $Sessions['ip_addres'] = request()->ip();
                    $Sessions->save(); 
                    return redirect('/');                    
                } 
            }  
        }
		else{
			$res='Username tidak terdaftar';
		}
		
		session()->flash('res',$res);
		return view('login');
    }
    
	/*
    public function login()
    {
        $dn = '';
         $ldap['user'] = 'hr_receiver';
         $ldap['pass'] = 'Tsel2008';
         $ldap['host'] = '10.65.181.233';
         $ldap['port'] = 389;
         $ldap['dn'] = 'cn=hr_receiver,ou=outsources,ou=headoffice,dc=Telkomsel,dc=co,dc=id';
         //$ldap['user'] = 'AssetMgtConn';
         //$ldap['pass'] = 'Tsel2012';
         //$ldap['dn'] = 'cn=AssetMgtConn,ou=outsources,ou=headoffice,dc=Telkomsel,dc=co,dc=id';

         $ldap['base'] = '';
         $ldap['conn'] = ldap_connect($ldap['host'], $ldap['port'])
         or die("Could not connect to {$ldap['host']}");
         //echo"\n" . $ldap['conn'];exit;
         ldap_set_option ($ldap['conn'], LDAP_OPT_REFERRALS, 0);
         ldap_set_option($ldap['conn'], LDAP_OPT_PROTOCOL_VERSION, 3);

         if ($ldap['conn']){
             //echo "\nmasuk sini..";
             $r = 0;
             $r = ldap_bind($ldap['conn'], $ldap['dn'], $ldap['pass']);
            // $caris=sprintf("ou=%s,dc=Telkomsel,dc=co,dc=id",$list_ou);
            // Ini cek user login-nya ada tidak di Active Directory
            // $sr=ldap_search($ldap['conn'],"dc=Telkomsel,dc=co,dc=id","sAMAccountName=".$_POST["login-username"]);
            // echo "nik:".$nik;
            $user = '17010419';
            $sr = ldap_search($ldap['conn'], "dc=Telkomsel,dc=co,dc=id", "sAMAccountName=" . $user);
             if (ldap_count_entries($ldap['conn'], $sr) == 1)
                {
                 $entry = ldap_first_entry($ldap['conn'], $sr);
                 $attrs = ldap_get_attributes($ldap['conn'], $entry);
                 $info = ldap_get_entries($ldap['conn'], $sr);

                print_r($info);
                 }
             }
             die();

    }
    
    public function login()
    {
        $username=request()->input('username');
        $password=request()->input('password');
        $res='Login Berhasil';
		if (Auth::attempt(['username' => $username, 'password' => $password])) {
			session()->put('nik',Auth::user()['nik']);
			session()->put('username',Auth::user()['username']);
			session()->put('nama',Auth::user()['nama']);
			session()->put('job',Auth::user()['job']);			
			session()->put('menu',ModelMenu::listMenuLevel());
			session()->put('listmenu',ModelMenu::listLinkMenuAktif());
            return redirect('/');
        }
		else
		{
			$res='Username / Password Salah';
		}
		
		session()->flash('res',$res);
        return view('login');
    }
    */
    
    public function showLoginForm()
    {
        if(Auth::check())
        {
            return redirect('/');
        }
		
		//$password = Hash::make('ebi');
        return view('login');
    }
	
	public function logout()
    {
        if(session()->getId() != NULL) {
            $Sessions = new Sessions();
            $DeleteId = $Sessions::where('username','=', session()->get('username'))->delete();
        }
        Auth::logout();
		session()->flush();
        return redirect('login');
    }
}
