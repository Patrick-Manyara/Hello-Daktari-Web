<?php

if(!defined('auth')) {
    http_response_code(401);
    exit();
}

$get_ip = site_visitor_data()['get_ip']; //global
writing_system_logs('User info: [ ' . json_encode(site_visitor_data()) . ' ]');

function site_visitor_data() {
    return [
        'get_ip'        => UserInfo::get_ip(),
        'get_os'        => UserInfo::get_os(),
        'get_device'    => UserInfo::get_device(),
        'get_browser'   => UserInfo::get_user_browser()
    ];
}

class UserInfo {

	private static function get_user_agent() {
		return  $_SERVER['HTTP_USER_AGENT'];
	}

	public static function get_ip() {
		$mainIp = '';
		
		if (getenv('HTTP_CLIENT_IP')) {
			$mainIp = getenv('HTTP_CLIENT_IP');
		} else if(getenv('HTTP_X_FORWARDED_FOR')) {
			$mainIp = getenv('HTTP_X_FORWARDED_FOR');
		} else if(getenv('HTTP_X_FORWARDED')) {
			$mainIp = getenv('HTTP_X_FORWARDED');
		} else if(getenv('HTTP_FORWARDED_FOR')) {
			$mainIp = getenv('HTTP_FORWARDED_FOR');
		} else if(getenv('HTTP_FORWARDED')) {
			$mainIp = getenv('HTTP_FORWARDED');
		} else if(getenv('REMOTE_ADDR')) {
			$mainIp = getenv('REMOTE_ADDR');
		} else {
			$mainIp = 'UNKNOWN';
		}
		
		return $mainIp;
	}

	public static function get_os() {

		$user_agent = self::get_user_agent();
		$os_platform    =   "Unknown OS Platform";
		
		$os_array       =   array(
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/webos/i'              =>  'Mobile',
			'/android/i'            =>  'Android',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/blackberry/i'         =>  'BlackBerry',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 10/i'     	=>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/win16/i'              =>  'Windows 3.11',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64'
		);

		foreach ($os_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}
		}
		
		return $os_platform;
	}

	public static function  get_user_browser() {

		$user_agent= self::get_user_agent();

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
			'/edge/i'       =>  'Edge',
			'/opera/i'      =>  'Opera',
			'/safari/i'     =>  'Safari',
			'/chrome/i'     =>  'Chrome',
			'/maxthon/i'    =>  'Maxthon',
			'/firefox/i'    =>  'Firefox',
			'/netscape/i'   =>  'Netscape',
			'/konqueror/i'  =>  'Konqueror',
			'/ubrowser/i'   =>  'UC Browser',
			'/mobile/i'     =>  'Handheld Browser',
			'/msie/i'       =>  'Internet Explorer',
			'/Trident/i'    =>  'Internet Explorer'
		);

		foreach ($browser_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}
		}

		return $browser;

	}

	public static function  get_device() {

		$tablet_browser = 0;
		$mobile_browser = 0;

		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
		}

		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
		}

		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
		}

		$mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
		
		$mobile_agents = array(
			'wapr','webc','winw','winw','xda ','xda-',
			'newt','noki','palm','pana','pant','phil','play','port','prox',
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp'
		);

		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		}

		if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
			$mobile_browser++;
	            //Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}

		if ($tablet_browser > 0) {
			return 'Tablet';
		}
		else if ($mobile_browser > 0) {
			return 'Mobile';
		}
		else {
			return 'Computer';
		}   
	}
}