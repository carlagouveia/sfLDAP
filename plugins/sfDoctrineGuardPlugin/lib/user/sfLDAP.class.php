<?php
/**
 * sfLDAP
 *
 * An abstraction layer for Kerberos-LDAP server authentication within Symfony and sfGuard
 *
 * @author Carla Gouveia <carlajessica@gmail.com>
 * @package sfldap
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version 1.0
 */
class sfLDAP {

	protected static $ldap;
	
	public static function connect() {
		self::$ldap = ldap_connect(sfConfig::get('app_ldap_host'), sfConfig::get('app_ldap_port'));
		ldap_set_option(self::$ldap, LDAP_OPT_PROTOCOL_VERSION, sfConfig::get('app_ldap_protocol'));
	}
	
	public static function auth($user, $password){
		self::connect();
		$bind = ldap_bind(self::$ldap, "krbPrincipalName=$user@USERS," . sfConfig::get('app_ldap_dn'), $password);
		
		if($bind) {
			$search = ldap_search(self::$ldap, "krbPrincipalName=$user@USERS," . sfConfig::get('app_ldap_default_dn'), "(uid=$user)");			
			$data = ldap_get_entries(self::$ldap, $search);			
			return true;
		} else {
			return false;
		}
		
	}
}
