<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Adldap\Laravel\Facades\Adldap;
// use Adldap\AdldapInterface;

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
    protected $redirectTo = '/home';

    /**
     * @var Adldap
     */
    // protected $ldap;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->ldap = $ldap;
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Login.
     * Test les entrée d'auth du guest, compare avec le LDAP, ajoute si existe dans LDAP et pas dans DB.
     * @author Sylvain Picard
     * @author Vincent Danjean
     * @category Controller method
     * @param \Illuminate\Http\Request $requets
     * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        /* Get request data */
        $username = $request->username;
        $password = $request->password;
        return redirect()->home();
        //$user = Adldap::search()->users()->find($username);
        
        // Finding a user:
        // $user = Adldap::search()->users()->find($username);
        // $users = $this->ldap->search()->users()->get();

        // $ldapconn = ldap_connect("ldaps://chu-lyon.fr") // 'ldaps://chu-lyon.fr'
        // or die("Could not connect to LDAP server.");

        // if ($ldapconn) {
        //     // binding to ldap server
        //     $ldapbind = ldap_bind($ldapconn, $username.'@chu-lyon.fr', $password); //$username.'@chu-lyon.fr'
        //     // verify binding
        //     if ($ldapbind) {
        //         echo "LDAP bind successful...";
        //     } else {
        //         echo "LDAP bind failed...";
        //     }
        // }

        /* $group = 'CN=DL_NGS_Users_Full_Access,OU=Groupes et user applicatifs,DC=chu-lyon,DC=fr';
        $username = $request->username;
        $password = $request->password;

        $filter = "(&(objectClass=user)(sAMAccountName=" . $username . ")(memberOf:1.2.840.113556.1.4.1941:=" . $group . "))";
        $searchOU = "DC=chu-lyon,DC=FR";
        
        // Messages d'erreur
        $error_message = 'Accès non autorisé : veuillez contacter la cellule de BioInfo.';
        
        $ldapconn = User::chu_ad_connect();

        if (!$ldapconn) {
            return back()->with('error', 'Erreur avec le serveur LDAP : veuillez contacter la cellule de BioInfo.');
        } else {
            //testMotdepasse
            if (! @ldap_bind($ldapconn, $username . '@chu-lyon.fr', $password)){
                // IF USER CREDITS NOT FOUND
                Log::error('LDAP bind error for ' . $username . ': ' . ldap_error($ldapconn));
                return back()->with('error','Login ou mot de passe non reconnu.');
            } else {
                // Search if the person belongs to the group
                $find = ldap_search($ldapconn, $searchOU, $filter);
                $count = ldap_count_entries($ldapconn, $find);
                // If she belongs to the group
                if ($count === false || $count == 0){
                    return back()->with('error', $error_message);
                } else {
                    $entries = ldap_get_entries($ldapconn, $find);
                    $displayname = $entries[0]['displayname'][0];
                    $firstname = explode(', ', $displayname)[1];
                    $lastname = explode(', ', $displayname)[0];
                    $username = $firstname . ' ' . $lastname;
                    $email = $entries[0]['mail'][0];

                    if (! auth()->attempt(['email' => $email, 'password' => $request -> password])) {
                         
                        $test_user = User::where('email', $email)->first();
                        
                        // if the User exists and his password changed
                        if (count((array)$test_user) != 0) {
                            $user = $test_user;
                            $user -> password = bcrypt($request -> password);
                            $user->save();
                        } else {
                            // if the User does not exist
                            $user = new User;
                            $user -> name = $username;
                            $user -> email = $email;
                            $user -> password = bcrypt($request -> password);
                            $user->save();
                        }
                        return redirect()->home();
                    }
                    return redirect()->home();
                }
            }
        }
        ldap_close($ldapconn); */
    }
}