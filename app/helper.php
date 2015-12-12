<?php 

Use Carbon\Carbon;

// page counter

function counter($page){

	$count_home = Counter::wherePage($page)->where('created_at', '>=', new DateTime('today'));

		if($count_home->count() > 0){
			$update_count = $count_home->first();
			$update_count->count = $update_count->count + 1;
			$update_count->save();
		}else{
			$create_count = new Counter;
			$create_count->page = $page;
			$create_count->count = 1;
			$create_count->save();
		}
}

function get_all_authors(){
  $author = User::where('author_name','!=','')->get();
  return $author;
}

function seo_url($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}


function get_user_details($id){
  $data = User::find($id);
  return $data;
}

function send_notifications($title, $message) {
    Log::info('push notification');

    $devices = MobileRegister::all();

	    foreach ($devices as $device) {
	    	
	    if ($push_notification == 1) {
	        if ($device->device_type == 'ios') {
	            /* WARNING:- you can't pass devicetoken as string in GCM or IOS push
	             * you have to pass array of devicetoken even thow it's only one device's token. */
	            /* send_ios_push("E146C7DCCA5EBD49803278B3EE0C1825EF0FA6D6F0B1632A19F783CB02B2617B",$title,$message,$type); */
	            send_ios_push($device->device_token, $title, $message);
	        } else {

	            $message = json_encode($message);

	            send_android_push($device->device_token, $title, $message);
	        }
	    }
	}
}

function send_ios_push($user_id, $title, $message) {

        include_once 'ios_push/apns.php';

    /* normally we have to send three perameters to ios device which are "alert","badge","sound", if it is not in aps{} object then push will not deliver.
     * in this array just add that veriable which's text in to "alert" you want to display in device screen as a notification
     * "status" is my strategy to display success or Filear or push data
     * "title" is a string which is send as a push string and i hed put it in this perameter because if ios developer wants that message then ios developer can get it from here
     * "messsage" is a bulk of data which is send from database
     *
     * don't concat title & message in alert if not required.
     *
     * if you want ot check the json will be proper or not then you can echo "$payload" variable which is generated in "apns.php"
     * and if you git is as a perfect json then only push data is perfect and may be send to device.
     *
     * i use "may" word in my sentence because if you hed made any mistake like devicetoken will not array if dubble jsonencode or etc then also it will not work.
     *
     * if in push you will not send perfect json then also it will not deliver to device
     * EXAMPLE of perfect json for ios push (formate taken from your "create_request" code. and also I put a comment in it. after formated array)
     *
      {
      "aps":{
      "alert":"message",
      "title":"title",
      "badge":1,
      "sound":"default",
      "message":{
      "unique_id":1,
      "request_id":2,
      "time_left_to_respond":"12 minutes",
      "request_data":{
      "owner":{
      "name":"first name last name",
      "picture":"picture",
      "phone":"+919876543210",
      "address":"address",
      "latitude":"22",
      "longitude":"77",
      "rating":1,
      "num_rating":1
      },
      "dog":{
      "name":"dog_name",
      "age":"dog_age",
      "breed":"dog_breed",
      "likes":"dog_likes",
      "picture":"dog_image"
      }
      }
      }
      }
      }
     */
    $msg = array("alert" => $title,
        "status" => "success",
        "title" => $title,
        "message" => $message,
        "badge" => 1,
        "sound" => "default");

    if (!isset($user_id) || empty($user_id)) {
        $deviceTokens = array();
    } else {
        $deviceTokens = array(trim($user_id));
    }

    $apns = new Apns();
    $apns->send_notification($deviceTokens, $msg);
}

function send_android_push($user_id, $message, $title) {
    require_once 'gcm/GCM_1.php';
    require_once 'gcm/const.php';

    if (!isset($user_id) || empty($user_id)) {
        $registatoin_ids = "0";
    } else {
        $registatoin_ids = trim($user_id);
    }
    if (!isset($message) || empty($message)) {
        $msg = "Message not set";
    } else {
        $msg = trim($message);
    }
    if (!isset($title) || empty($title)) {
        $title1 = "Message not set";
    } else {
        $title1 = trim($title);
    }

    $message = array(TEAM => $title1, MESSAGE => $msg);

    $gcm = new GCM();
    $registatoin_ids = array($registatoin_ids);
    $gcm->send_notification($registatoin_ids, $message);
    Log::info($gcm);
}


function total_view_count(){
	$count = Counter::where('page','home')->sum('count');
	return $count;
}

function get_view_by_date($date){
  $query = "SELECT sum(count) as count from counter where page='home' and DATE(created_at) = '".$date."'";
  $count = DB::select(DB::raw($query));
  return $count[0]->count;
}

function average_view_count(){
	$allvalue = Counter::where('page','home')->sum('count');
	$allday = Counter::where('page','home')->count();

	$perday = $allvalue/$allday;

	$perday = round($perday);

	return $perday;
}

function compare_view_count(){
	$count_today = Counter::wherePage('home')->where('created_at', '>=', new DateTime('today'));

	$count_yesterday = Counter::wherePage('home')->where('created_at', '=', Carbon::yesterday());

	$status = "";

	if($count_today > $count_yesterday){
    $status = 1;
	}else{
		$status = 0;
	}

	return $status;
}

function last_days($days){

  $views = Counter::orderBy('created_at','asc')->where('created_at', '>', Carbon::now()->subDays($days))->where('page','home');
  $arr = array();
  $arr['count'] = $views->count();
  $arr['get'] = $views->get();

  return $arr;

}

function device_count(){

  $ios_count = MobileRegister::where('device_type','ios')->count();
  $android_count = MobileRegister::where('device_type','android')->count();

  $response = array();

  $response['ios'] = $ios_count;
  $response['android'] = $android_count;

  return $response;

}

function import_db($mysql_username,$mysql_password,$mysql_host,$mysql_database)
{
    // Name of the file
    $filename = public_path().'/sql/news.sql';
    

    // Connect to MySQL server
    $db_conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password,$mysql_database) or die('Error connecting to MySQL server: ' . mysql_error());
    // Select database
    //mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($filename);
    // Loop through each line
    foreach ($lines as $line)
    {
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
        // Perform the query
        mysqli_query($db_conn,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
    }
    //echo "Tables imported successfully";

}




 ?>