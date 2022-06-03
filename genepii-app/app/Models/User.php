<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    /**
     * User - Admin.
     * Checks if user is admin.
     */
    public function isAdmin()
    {
        return $this->admin ? true : false; // this looks for an admin column in your users table
    }

    /**
     * LDAP Connexion
     * @return LDAP\Connection|false LDAP connexion to chu's AD
     */
    public static function chu_ad_connect() {
        $host = 'ldaps://chu-lyon.fr';
        
        if (PHP_VERSION_ID < 70100) {
            putenv('LDAPTLS_CACERT=/etc/ssl/chu-certs/chu-all.crt');
        }
        
        // Acces to AD server
        $ldapconn = @ldap_connect($host);
        if (!$ldapconn) {
            Log::error('Erreur avec le serveur ldap : '.ldap_error($ldapconn));
            return $ldapconn;
        }
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_HARD);
        if (PHP_VERSION_ID >= 70100) {
            ldap_set_option($ldapconn, LDAP_OPT_X_TLS_CACERTFILE, '/etc/ssl/chu-certs/chu-all.crt');
        }
        return $ldapconn;
    }
}
