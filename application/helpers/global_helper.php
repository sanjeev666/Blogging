<?php
require_once 'assets/razorpay-php/Razorpay.php';
use Razorpay\Api\Api;

// $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);
// $webhookBody should be raw webhook request body


function getOrderId($amount, $receipt){
	$api = new Api(api_key, api_secret);
	$orderData = [
	    'receipt'         => $receipt,
	    'amount'          => $amount * 100, // 2000 rupees in paise
	    'currency'        => 'INR',
	    'payment_capture' => 1 // auto capture
	];
	$razorpayOrder = $api->order->create($orderData);
	return $razorpayOrder['id'];
}

function pr(&$a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';
}



function timeago($date) {
	$timestamp = strtotime($date);	
	
	$strTime = array("second", "minute", "hour", "day", "month", "year");
	$length = array("60","60","24","30","12","10");

	$currentTime = time();
	if($currentTime >= $timestamp) {
		 $diff     = time()- $timestamp;
		 for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
		 $diff = $diff / $length[$i];
		 }

		 $diff = round($diff);
		 return $diff . " " . $strTime[$i] . " ago ";
	}
 }








function vd(&$a)
{
    echo '<pre>';
    var_dump($a);
    echo '</pre>';
}
function email($to, $from='', $mail_details)
{
	$CI =& get_instance();
	$CI->load->library('email');
    
	$config['mailtype'] = 'html';

	$config['protocol'] = "smtp";
	$config['smtp_host'] = SMTP_HOST;
	$config['smtp_port'] = SMTP_PORT;
	$config['smtp_user'] = SMTP_USER; 
	$config['smtp_pass'] = SMTP_PASSWORD;
	$config['charset'] = "utf-8";
	$config['mailtype'] = "html";
	//$config['smtp_crypto'] = "tls"; 

	$config['newline'] = "\r\n";

	$CI->email->initialize($config);
	$CI->email->set_newline("\r\n");
	$CI->email->set_crlf( "\r\n" );

    $CI->email->from(EMAIL_FROM);
    $CI->email->to($to); 
    
    $CI->email->subject($mail_details['subject']);
    $CI->email->message($mail_details['message']); 

    return $CI->email->send();
    // $CI->email->send(FALSE);
    // echo $CI->email->print_debugger();echo "asdasdfs";
    // exit;
}



// timezone diff convert to timezone
function converToTz($time="",$toTz='',$fromTz='')
{
    if(is_string($toTz)){
        $toTz = new DateTimeZone($toTz);
    }
    // timezone by php friendly values
    $date = new DateTime($time, $fromTz);
    $date->setTimezone($toTz);
    $time= $date->format('Y-m-d H:i:s');
    return $time;
}

function convertByOffsetToUserTZ($time="", $offset="")
{
	$date = date("Y-m-d H:i:s",strtotime($time . ' ' . $offset . " minutes"));
	return date("Y-m-d H:i:s",strtotime($date . "5 hours"));
}
function convertByOffsetToServerTZ($time="", $offset="")
{
	$date = date("Y-m-d H:i:s",strtotime($time . "-5 hours"));
	return date("Y-m-d H:i:s",strtotime($date . $offset . " minutes"));
}

function getRealPOST() {
    $pairs = explode("&", file_get_contents("php://input"));
    $vars = array();
    foreach ($pairs as $pair) {
        $nv = explode("=", $pair);
        $value = "";
        if(isset($nv[1])) {
        	$value = urldecode($nv[1]);
        }
        $name = urldecode($nv[0]);
        if(preg_match('/\[\]$/', $name ,$matches))
		{
			$name = str_replace('[]', '', $name);
			if(!isset($vars[$name])){
				$vars[$name] = array();
			}
			$vars[$name][] = $value;
			
		} else {
			$vars[$name] = $value;
		}
    }
    return $vars;
}

function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}



function is_ajax()
{
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
}


function is_valid_url($url)
{
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function load_img($filename, $params = array(), $tag = true)
{
    if($tag == true)
    {
        $params_str = "";
        foreach($params as $key=>$param)
        {
            $params_str .= $key.'="'.$param.'" ';
        }
        return '<img src="'.base_url()."resources/images/".$filename.'" '.$params_str.'>';
    }
    else
        return base_url()."resources/images/".$filename;
}

////function to load he external js files not pertaining to controllers and action
//file name would be relative to js folder
function load_js($js_file=NULL,$tag=true)
{
	if($js_file!=NULL){
        if(file_exists("./resources/js/".$js_file))
            return '<script type="text/javascript" src="'.base_url()."resources/js/".$js_file.'"></script>';
	}
}

function load_css($css_file=NULL)
{
	if($css_file!=NULL){
        if(file_exists("./resources/css/".$css_file))
            return '<link  type="text/css" rel="stylesheet" href="'.base_url()."resources/css/".$css_file.'" />';
	}
}

function getIndex(&$arrayName,$index)
{
	if(isset($arrayName[$index]))
		return $arrayName[$index];
	else
		return FALSE;
}

function formatDate($dt)
{
	$tstamp = strtotime($dt);
	return date("D jS M, Y ",$tstamp);
}

function formatTime($tstamp)
{
	return date("g:i a",$tstamp);
}

function ago($time)
{    
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $difference     = $now - $time;
    $tense         = "ago";

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j]";
}





function lq()
{
	// helper to show last query
	$CI =& get_instance();
	echo "<pre class='smalltext'>".htmlentities($CI->db->last_query())."</pre>";
}


function getCurrentDateTime()
{
	return date("Y-m-d G:i:s");
}

function trim_text($string, $limit = 10, $dots = TRUE)
{    
    //echo $dots;
    $stringlen = strlen($string);
    

    if($stringlen > $limit)
    {
        if($dots)
        {
            $temp_string = substr($string, 0, ($limit - 3));
            $new_string = $temp_string."...";
            echo $new_string;
        }
        else
        {
            $temp_string = substr($string, 0, $limit);
            $new_string = $temp_string;
            echo $new_string;
        }
    }
    else
    {
        echo $string;
    }

}

function recursive_remove_directory($directory, $empty=FALSE)
{
	// if the path has a slash at the end we remove it here
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}

	// if the path is not valid or is not a directory ...
	if(!file_exists($directory) || !is_dir($directory))
	{
		// ... we return false and exit the function
		return FALSE;

	// ... if the path is not readable
	}elseif(!is_readable($directory))
	{
		// ... we return false and exit the function
		return FALSE;

	// ... else if the path is readable
	}else{

		// we open the directory
		$handle = opendir($directory);

		// and scan through the items inside
		while (FALSE !== ($item = readdir($handle)))
		{
			// if the filepointer is not the current directory
			// or the parent directory
			if($item != '.' && $item != '..')
			{
				// we build the new path to delete
				$path = $directory.'/'.$item;

				// if the new path is a directory
				if(is_dir($path)) 
				{
					// we call this function with the new path
					recursive_remove_directory($path);

				// if the new path is a file
				}else{
					// we remove the file
					unlink($path);
				}
			}
		}
		// close the directory
		closedir($handle);

		// if the option to empty is not set to true
		if($empty == FALSE)
		{
			// try to delete the now empty directory
			if(!rmdir($directory))
			{
				// return false if not possible
				return FALSE;
			}
		}
		// return success
		return TRUE;
	}
}



function normalize_str($str)
{
$invalid = array('á'=>'a', 'Á'=>'a', 'č'=>'c', 'Č'=>'c', 'ď'=>'d', 'Ď'=>'d',
			'é'=>'e','ě'=>'e','É'=>'e','Ě'=>'e','í'=>"i",'Í'=>'i','ň'=>'n','Ň'=>'n',
			'ó'=>'o','Ó'=>'o','ř'=>'r','Ř'=>'r','š'=>'s','Š'=>'s','ť'=>'t','Ť'=>'t','ú'=>'u',
			'Ú'=>'u','ů'=>'u','Ů'=>'u','ž'=>'z','Ž'=>'z'
			);

 
$str = str_replace(array_keys($invalid), array_values($invalid), $str);
 
return $str;
}
function is_allowed()
{
	return TRUE;
}





function addhttp($url,$secure='') {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http{$secure}://" . $url;
    }
    return $url;
}

function array_count_values_of($value, $array) {
	$counts = array_count_values($array);
	if(isset($counts[$value]))
		return $counts[$value];
	else
		return 0;
}


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

 


 function _ToCamelCase($string, $capitalizeFirstCharacter = false) 
{

    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

    if (!$capitalizeFirstCharacter) {
        $str[0] = strtolower($str[0]);
    }

    return $str;
}










function getSingleData($tableName = '',$conditions = array()){
 $CI =& get_instance();
 if($tableName == '')
  return array();

 return $CI->db->get_where($tableName,$conditions)->row_array();
}

function get_encode($id)
{
    $CI =& get_instance();
    return str_replace(array('+', '/', '='), array('-', '_', '~'), $CI->encrypt->encode($id));
}

function get_decode($id)
{
    $CI =& get_instance();
    return $CI->encrypt->decode(str_replace(array('-', '_', '~','%7E'), array('+', '/', '=','='), $id));
}

// function sendsms($number, $message_body, $return = '0'){       
//         $sender = 'Tailor App';  // Need to change
//         $smsGatewayUrl = base_url();
//         // pr($smsGatewayUrl);
//         $apikey = '65q7z3hs49xxxxxx'; // Change   
//         $textmessage = "dcdc";
//         $textmessage = urlencode($textmessage);
//         // pr($textmessage);
//         $api_element = '/api/web/send/';
//         $api_params = $api_element.'?apikey='.$apikey.'&sender='.$sender.'&to='.$number.
// '&message='.$textmessage;    
// // pr($api_params);
//         $smsgatewaydata = $smsGatewayUrl.$api_params;
//         $url = $smsgatewaydata;
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_POST, false);
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         $output = curl_exec($ch);
//         curl_close($ch);        
//         if(!$output){
//            $output =  file_get_contents($smsgatewaydata);
//         }

//         if($return == '1'){
//             return $output;            
//         }else{
//             echo "Sent";
//         }        
//     }