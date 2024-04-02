<?php
// my helpers
//how to create from url https://laravelcode.com/post/how-to-create-custom-helper-in-laravel-55
//last_update 27-12-2020
/* /////////////////------->powered BY: ENG \ Mohamed saeed ali    <---------------\\\\\\\\\\\\\\\\\\\\\
* /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
* /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */

use Illuminate\Support\Facades\Session;

function add_btn_edit($uri='',$attributes='')
{
    return '<a href="'.$uri.'" '.$attributes.' class="btn  btn-sm btn-primary" >
        <i class="icon-md fas fa-pencil-alt"></i>
        </a>';
}
// delete button
function add_btn_delete($uri='',$attributes='')
{
    return '<a onclick="return confirm(\' '.__('admin::ms_lang.r_u_sure_delete').'\');" '.$attributes.' class="btn  btn-sm btn-danger">
        <i class="icon-md fas fa-trash"></i>
        </a>';
}
// delete button
function add_btn_undelete($uri='',$attributes='')
{
    return '<a onclick="return confirm(\' '.__('ms_lang.r_u_sure_undelete').'\');" '.$attributes.' class="btn  btn-sm btn-warning pl-1 pr-1">
        <i class="icon-md fas fa-trash-restore-alt"></i>'.trans('ms_lang.btn_undelete').'
        </a>';
}
// delete button
function add_btn_fulldelete($uri='',$attributes='')
{
    return '<a onclick="return confirm(\' '.__('ms_lang.r_u_sure_fulldelete').'\');" '.$attributes.' class="btn  btn-sm btn-danger pl-1 pr-1">
        <i class="icon-md  fas fa-trash-alt"></i>'.trans('ms_lang.btn_full_delete').'
        </a>';
}
/// active button
function add_btn_active($uri='',$attributes='',$status_v='Y',$act_w='')
{
    if($status_v=='Y')
    {
        $styl='success';
        $act_w='&nbsp;'.__('admin::ms_lang.active').' &nbsp;';
    }
    else
    {
        $styl='warning';
        $act_w= __('admin::ms_lang.disactive');
    }
    return '<a href="'.$uri.'" '.$attributes.' class="btn  btn-sm btn-'.$styl.'" style="padding: 9px 0px;font-weight: bolder">'.$act_w.' </a>';
}
/// busy button
function add_btn_busy($uri='',$attributes='',$status_v=1,$act_w='')
{
    if($status_v=='Y')
    {
        $styl='success';
        $act_w=__('ms_lang.avilable');
    }
    else
    {
        $styl='warning';
        $act_w='&nbsp;'.__('ms_lang.closed').'&nbsp;';
    }
    return '<a href="'.$uri.'" '.$attributes.' class="btn btn-default btn-'.$styl.'" style="padding: 9px 0px;font-weight: bolder">'.$act_w.' </a>';
}
/// busy button
function btn_reserved($uri='',$attributes='',$status_v=1,$act_w='&nbsp;فـــارغ&nbsp;')
{
    if($status_v=='N')
    {
        $styl='success';
        $act_w='&nbsp;فـــارغ&nbsp;';
    }
    else
    {
        $styl='warning';
        $act_w='&nbsp;محجوز';
    }
    return '<a href="'.$uri.'" '.$attributes.' class="btn btn-default btn-'.$styl.'" style="padding: 9px 0px;font-weight: bolder">'.$act_w.' </a>';
}
             ////////////////////////////////////////////////////////////////////////////////////////
            ///////////////               random string with length    ///////////////////
           ////////////////////////////////////////////////////////////////////////////////////////
/////////////////////return random string and number ; ////////////////////////////////////////////

function randomString($length = 7) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}


/////////////////////return random string and number ; ////////////////////////////////////////////

function randomNumber($length = 7) {
	$str = "";
	$characters = array_merge(range('0','9'), range('0','9'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}


             ////////////////////////////////////////////////////////////////////////////////////////
            ///////////////                cut_arbic_text    ///////////////////
           ////////////////////////////////////////////////////////////////////////////////////////
/////////////////////return name with function pathinfo($name,PATHINFO_EXTENSION); /////////////

function cut_arabic_text($text,$length){
   $text = strip_tags($text);
    if (strlen($text) > $length) {
        // truncate string
        $textCut = substr($text, 0, $length);
        // make sure it ends in a word so assassinate doesn't become محمد سعي...
        $cut_text = substr($textCut, 0, strrpos($textCut, ' '));
        return $cut_text;
    }else{
        return $text;
    }

}

             ////////////////////////////////////////////////////////////////////////////////////////
            ///////////////              create title to url for seo   ///////////////////
           ////////////////////////////////////////////////////////////////////////////////////////
/////////////////////return name with function pathinfo($name,PATHINFO_EXTENSION); /////////////

function title_2url($title , $length=200){
    $new_title= str_replace(array(' ','"',"'",'/','&','%','@',';',',','،'), '-', trim($title));
    $new_title=cut_arabic_text($new_title,$length);
    return $new_title;
}

             ////////////////////////////////////////////////////////////////////////////////////////
            ///////////////               fuction calculate date post articles   ///////////////////
           ////////////////////////////////////////////////////////////////////////////////////////
// calculate date post articless ///////////------------------>>
function time_publising($time_insert){
           $time=time();
           $time_insert1=strtotime($time_insert);
           $timeall=$time-$time_insert1;
           // ist`s now
           if($timeall ==0){
                $text_view= "الآن";
            //less than minute
           }elseif($timeall<60){
                $text_view= "قبل اقل من دقيقة";
           //more than minute
           }elseif($timeall>=60 and $timeall<(60*60)){
                $in=$timeall/60;
                $in=floor($in);
                $text_view="قبل (".$in.") دقيقة";
            //more than hour
           }elseif($timeall>=(60*60) and $timeall<(60*60*24)){
                $in=$timeall/3600;
                $in=floor($in);
                $text_view="قبل (".$in.") ساعة";
            //more than day
           }elseif($timeall >= (60*60*24) and $timeall<(60*60*24*7)){
                $in=$timeall/86400;
                $in=floor($in);
                $text_view="قبل (".$in.") ايام";
            //more than weak
           }elseif($timeall >=(60*60*24*7) and $timeall<(60*60*24*30)){
                $in=$timeall/604800;
                $in=floor($in);
                $text_view="قبل (".$in.") اسبوع";
            //more than month
           }elseif($timeall >=(60*60*24*30) and $timeall<(60*60*24*30*12)){
                $in=$timeall/2419200;
                $in=floor($in);
                $text_view="قبل (".$in.") اشهر";
            //min 1 year--> max 3 years
           }elseif($timeall >=(60*60*24*30*12) and $timeall<(60*60*24*30*12*3)){
                $in=$timeall/29030400;
                $in=floor($in);
                $text_view="قبل (".$in.") سنة";
           //after 3 years
           }elseif($timeall >=(60*60*24*30*12*3)){
                $text_view="أكثر من ثلاث سنوات";
           }
return $text_view;
}
////////////------ END calculate date post articless ---------<<

function get_month_name($month,$full_name=1)
{
    $months = array(
        1   =>  'January',
        2   =>  'February',
        3   =>  'March',
        4   =>  'April',
        5   =>  'May',
        6   =>  'June',
        7   =>  'July',
        8   =>  'August',
        9   =>  'September',
        10  =>  'October',
        11  =>  'November',
        12  =>  'December'
    );
    if($full_name==0)
    {
        return substr($months[$month], 0,3);
    }
    return $months[$month];
}

function date_ar_lang($A){

    switch($A){
       case 1:
            echo"يناير";
            break;
       case 2:
            echo"فبراير";
            break;
       case 3:
            echo"مـارس";
            break;
       case 4:
            echo"ابريـل";
            break;
       case 5:
            echo"مـايـو";
            break;
       case 6:
            echo"يــونيـو";
            break;
       case 7:
            echo "يـولـيـو";
            break;
       case 8:
            echo"اغسطـس";
            break;
       case 9:
            echo"سبتمبـر";
            break;
       case 10:
            echo"اكتوبر";
            break;
       case 11:
            echo"نوفمبر";
            break;
       case 12:
            echo"ديسمبر";
            break;
    }
}
function day_arbic(){
    $A=date("w");
    switch($A){
       case 0:
            echo"الاحد";
            break;
       case 1:
            echo"الاثنين";
            break;
       case 2:
            echo"الثلاثاء";
            break;
       case 3:
            echo"الاربعاء";
            break;
       case 4:
            echo"الخميـس";
            break;
       case 5:
            echo"الجمعــــــــــه";
            break;
       case 6:
            echo"السبــــــــــت";
            break;
    }
}
function date_arabic($d){
    $arr_d=explode("-",$d);
    $y=$arr_d[0];
    $m=date_ar_lang($arr_d[1]);
    $d=$arr_d[2];
    $dat=$y." ".$m."  ".$d;
    return $dat;
}
function date_only($d){
    $arr_d=explode(" ",$d);
    return $arr_d[0];
}

function date_with_add_days($days_added=1,$date=''){
    if($date == '')
    {
        $date=date("Y-m-d");
    }
    $date_c=date_create($date);
    date_add($date_c,date_interval_create_from_date_string($days_added." days"));
    return date_format($date_c,"Y-m-d");
}

// Create a standard data format for insertion of PHP dates into MySQL
function date_convert($date) {
    return date('Y-m-d H:i:s', strtotime($date));
  }
//////////////////////////-------------------------------------END --------------------<<
////////////////////////////////////////////////////////////////////////////////////////
///////////////               fuction  date time zone  ///////////////////
////////////////////////////////////////////////////////////////////////////////////////
function set_dt_zone_cairo($zon='Africa/Cairo'){
    date_default_timezone_set($zon);
    $d=date('Y-m-d H:i:s', time());
    return $d;
}
function set_dt_zone($zon='date_default_timezone_get'){
    date_default_timezone_set($zon);
    $d=date('Y-m-d H:i:s', time());
    return $d;
}
////////////////////---------------------------END -------------------------------<<
///////////////////////////   Convert Currency  ///////////////////////////////
function currencyConverter($currency_from,$currency_to,$currency_input){
    $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
    $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
    $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
    $yql_session = file_get_contents($yql_query_url);
    $yql_json =  json_decode($yql_session,true);
    $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];
    return $currency_output;
}
//////////////////////////-------------------------------------END --------------------<<
////////////////////////////////////////////////////////////////////////////////////////
///////////////               fuction  convert lat&long to string address //////////////
////////////////////////////////////////////////////////////////////////////////////////
function convert_lat_long_to_address($lat ,$long){
    //get address from google map
    $geolocation = $lat.','.$long;
    //echo $geolocation."<br/>";
    $request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=false';
    $file_contents = file_get_contents($request);
    $json_decode = json_decode($file_contents);
    if(isset($json_decode->results[0])) {
        $response = array();
        foreach($json_decode->results[0]->address_components as $addressComponet) {
            if(in_array('political', $addressComponet->types)) {
                    $response[] = $addressComponet->long_name;
            }
        }
        if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
        if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; }
        if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
        if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
        if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }
        if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
            //echo "<br/>Address:: ".$first;
            $address=$first;
            //echo "<br/>City:: ".$second;
            $city=$second;
            //echo "<br/>State:: ".$fourth;
            $state=$fourth;
            //echo "<br/>Country:: ".$fifth;
            $country=$fifth;
        }else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  ) {
            //echo "<br/>Address:: ".$first;
            $address=$first;
            //echo "<br/>City:: ".$second;
            $city=$second;
            //echo "<br/>State:: ".$third;
            $state=$third;
            //echo "<br/>Country:: ".$fourth;
            $country=$fourth;
        }else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
            //echo "<br/>City:: ".$first;
            $city=$first;
            //echo "<br/>State:: ".$second;
            $state=$second;
            //echo "<br/>Country:: ".$third;
            $country=$third;
        }else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
            //echo "<br/>State:: ".$first;
            $state=$first;
            //echo "<br/>Country:: ".$second;
            $country=$second;
        }else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
            //echo "<br/>Country:: ".$first;
            $country=$first;
        }
    }
    if(!isset($country)){
        $country='';
    }
    if(!isset($city)){
        $city='';
    }
    if($country=='Saudi Arabia'){
        $city_g=$city;
        $place=$address;
    }elseif($country=='Egypt'){
        $city_g=$state;
        $place=$city;
    }else{
        $city_g=$state;
        $place=$city;
    }
    $v=$city_g.'-'.$place.'-'.$address;
    return $v;
}
//////////////////////////-------------------------------------END --------------------<<
////////////////////////////////////////////////////////////////////////////////////////
///////////////               fuction  Rounding out the half or the correct  ///////////
////////////////////////////////////////////////////////////////////////////////////////

function round_half_five($no) {
    $i=0;
    if($no <1){
        $no=$no+1;
        $i=1;
    }
    if(is_numeric($no) && strpos($no, ".") !== false){
        $no = strval($no);
        $no = explode('.', $no);
        $decimal = floatval('0.'.substr($no[1],0,2)); // cut only 2 number
        if($decimal > 0) {
            if($decimal <= 0.35) {
                $num= floatval($no[0]);
            } elseif($decimal > 0.35 && $decimal <= 0.5) {
                $num= floatval($no[0]) +0.5;
            } elseif($decimal > 0.5 && $decimal <= 0.75) {
                $num= floatval($no[0]) +0.5;
            } elseif($decimal > 0.75 && $decimal <= 0.99) {
                $num= floatval($no[0]) + 1;
            }
        } else {
            $num= floatval($no);
        }
    }else{
        $num=$no;
    }
    if($i==1){
        $num_g=$num-1;
    }else{
       $num_g= $num;
    }
    return $num_g;
}
//////////////////////////-------------------------------------END --------------------<<
////////////////////////////////////////////////////////////////////////////////////////
///////////////               fuction  Rounding out the half or the correct  ///////////
////////////////////////////////////////////////////////////////////////////////////////
function discount_get_value($value=0,$discount=0)
{
    $discount_v=($value / 100)* $discount;
    $discount_f=$value - $discount_v;
    return $discount_f;
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

//////////////////////update Views

// function _update_num_views($id,$row_update,$table,$valu=1)
// {
//     $db=& get_instance();
//     $db->db->where('id', $id);
//     $db->db->set($row_update, '`'.$row_update.'`+'.$valu.'', FALSE);
//     $db->db->update($table);
// }
// //////////////////////update Views

// function _update_col_value($id,$row_update,$table,$valu='')
// {
//     $db=& get_instance();
//     $db->db->where('id', $id);
//     $db->db->set($row_update, '"'.$valu.'"', FALSE);
//     $db->db->update($table);
// }

function url_chk($url_go)
{
    if(substr($url_go, 0,7) == 'http://' || substr($url_go, 0,7) == 'https://')
    {
        $url_chekd=$url_go;
    }else
    {
        $url_chekd='http://'.$url_go;
    }
    return $url_chekd;
}


function img_chk_exist($img,$default_img='uploads/logo.png')
{   //public/
    if(file_exists('uploads/'.$img) && !empty($img))
    {
        $src_go=url('uploads/'.$img);
    }
    else
    {
        $src_go=url($default_img);
    }
    return $src_go;
}

//send sms by plivo getway
function send_sms_from_polivo($reciever_number='+201063474777',$msg_send='رسالة اختبارية',$number_caller_id='+15671234567')
{
    $CI =&get_instance();
    $CI->load->library('plivo');
    $sms_data = array(
        'src' => $number_caller_id, //The phone number to use as the caller id (with the country code). E.g. For USA 15671234567
        'dst' => $reciever_number, // The number to which the message needs to be send (regular phone numbers must be prefixed with country code but without the ‘+’ sign) E.g., For USA 15677654321.
        'text' => $msg_send, // The text to send
        'type' => 'sms', //The type of message. Should be 'sms' for a text message. Defaults to 'sms'
        'url' => base_url() . 'index.php/plivo_test/receive_sms', // The URL which will be called with the status of the message.
        'method' => 'POST', // The method used to call the URL. Defaults to. POST
    );
    // look up available number groups
    $response_array = $CI->plivo->send_sms($sms_data);
    if ($response_array[0] == '200')
    {
        $data["response"] = json_decode($response_array[1], TRUE);
        //print_r($data["response"]);
    }
    else
    {
        //the response wasn't good, show the error
        //print_r($response_array);
    }
}

//send sms by yamamah getway
function send_sms_from_yamamah($reciever_number="569000711",$msg_send="رسالة اختبارية",$tag_name="SUREFANNI")
{
    $sms_data = [
        "Username" => "",
        "Password" => "", //
        "Tagname" => $tag_name,
        "RecepientNumber" => $reciever_number,
        "VariableList" => "",
        "ReplacementList" => "",
        "Message" => $msg_send,
        "SendDateTime" => 0, //set your datetime as the following: yyyyMMddHHmm e.g. 201312231330 Else set this parameter equal 0
        "EnableDR" => false // if you want Request Delivery Report, this property take true or false.
    ];
    $client = new GuzzleHttp\Client();
    $res = $client->request('POST', 'http://api.yamamah.com/SendSMS', [
        'json' =>$sms_data
    ]);
    //echo $res->getStatusCode(); // 200
    return $res->getBody(); //
}

//send sms by kwtsms getway
function send_sms_from_kwtsms($reciever_number="569000711",$msg_send="رسالة اختبارية",$tag_name="")
{
    $sms_data = [
        "username" => "",
        "password" => "", //
        "sender" => $tag_name,
        "mobile" => $reciever_number,
        "lang" => 3,
        "message" => $msg_send
    ];
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://kwtsms.com/API/send/', [
        'query' =>$sms_data
    ]);
    return $res->getBody();
}

//send sms by yamamah getway
function send_sms_from_malath($reciever_number="966504898156",$msg_send="رسالة اختبارية",$encode="")
{
    $UserName=config('malath_sms.user_name');
    $Password=config('malath_sms.password');
    //$Originator=config('malath_sms.originator');
    $DTT_SMS    = new \Vzool\Malath\Malath_SMS($UserName, $Password, $encode);
    $SenderName =$DTT_SMS->GetSenders();
    $Send = $DTT_SMS->Send_SMS($reciever_number, $SenderName[0], $msg_send);
    return $Send;
}

function sendMessage($message='MSO',$users=array()){
    $content = array(
                "en" => $message
            );

    $fields = array(
                'app_id' => config('onesignal.appId'),
                //'include_player_ids' => $users ,
                //'included_segments' => array('All'),
                'data' => array("foo" => "bar"),
                'contents' => $content
            );
    if(empty($users))
    {
        $fields['included_segments']=array('All');
    }else
    {
        $fields['include_player_ids']=$users;
    }

    $fields = json_encode($fields);

    //print("\nJSON sent:\n");
    print("<script type='text/javascript'>
            console.dir('".$fields."');
           </script>");

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json; charset=utf-8',
                                            'Authorization: Basic {{ config("onesignal.reset_api_key") }}'
                                              ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function sendMessage_onesignal_2app($type='1',$title='MSO',$message='MSO',$img='uploads/logo.png',$title_en='MSO',$message_en='MSO',$data_send=array(),$users=array()){
    $data_send["type"] = (int)$type;
    $data_send["title"] = $title;
    $data_send["title_en"] = $title_en;
    $data_send["img"] = img_chk_exist($img);
    $data_send["message"] = $message;
    $data_send["message_en"] = $message_en;
    //end data
    $content = ["en" => $message];
    $headings= ["en" => $title]; //<---- this will add heading
    $fields = array(
        'app_id' => config('onesignal.appId'),
        'data' => $data_send,
        'isAndroid'=> config('onesignal.send_2android'),
        'isIos'=> config('onesignal.send_2ios'),
        'content_available'=>true,
        'small_icon'    => 'ic_launcher-web',
        //'large_icon' =>"ic_launcher_round.png",
        'contents' => $content,
        'headings'=> $headings //<---- include it to request
    );
    if(empty($users))
    {
        $fields['included_segments']=array('All');
    }else
    {
        $fields['include_player_ids']=$users;
    }
    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json; charset=utf-8',
                        'Authorization: Basic '.config("onesignal.reset_api_key").''
                                              ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendedMessage_onesignal_get($limit=25,$offset=0,$kind=1)
{
    $app_id="{{ config('onesignal.appId') }}";
    $reset_api_key="{{ config('onesignal.reset_api_key') }}";
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://onesignal.com/api/v1/notifications?app_id=".$app_id."&limit=".$limit."&offset=".$offset."",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic ".$reset_api_key."",
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    echo $response;
}

// ////////////// start functions in laravel 5.6  day 29-4-2018 ===== ///////
function upload_file ( $file='img',$r_name='mso',$max_size=2048,$types='gif|jpg|png|jpeg')
{
    if ($request->hasFile($file)) {
        $file = $request->file($file);
        //$path = $request->img->path();    //$extension = $request->img->extension();
        $file_name = date('Y_m_d_h_i_s_').str_slug($r_name).'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/public/uploads');
        $filePath = $destinationPath. "/".  $file_name;
        $file->move($destinationPath, $file_name);
        return $file_name;
    }
}

function filter_kewords_ms($text='',$type_action='replace',$replaced_with=" ")
{
    $filtered_list = array(
        'sex',
        'sEx',
        'SEX',
        'رجلة',
        'ركلة',
        'خايس',
        'الزج',

    );
    if ($type_action == 'replace') {
        // to filter keywords
        $filtered = str_replace($filtered_list, $replaced_with, $text);
        return $filtered;
    }
    else
    {
        // to check keywords
        $filtered_list_im=implode('|',$filtered_list);
        if (preg_match('('.$filtered_list_im.')',$text) == 1) {
            return true;
        }
    }
}

// Function to get the user IP address
function getIpAddress()
{
    $ipAddress = '';
    if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
        // to get shared ISP IP address
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check for IPs passing through proxy servers
        // check if multiple IP addresses are set and take the first one
        $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipAddressList as $ip) {
            if (! empty($ip)) {
                // if you prefer, you can check for valid IP address here
                $ipAddress = $ip;
                break;
            }
        }
    } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (! empty($_SERVER['HTTP_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED'];
    } else if (! empty($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddress;
}
function get_weather($all_data='', $latitude='',$longitude='')
{
    if($latitude =='' || $longitude =='')
    {
        $gt_latlong = file_get_contents('http://ip-api.com/json/'.getIpAddress());
        $latlong = json_decode($gt_latlong);
        $latitude=$latlong->{'lat'};
        $longitude=$latlong->{'lon'};
        date_default_timezone_set($latlong->{'timezone'});
    }
    $weather = file_get_contents('http://api.openweathermap.org/data/2.5/weather?lat=' . $latitude . '&lon=' . $longitude . '&units=metric&appid=487fa92fa8f5836cab2393023af65103');
    if($all_data!='')
    {
        // echo $latitude.'<br/>';
        // echo $longitude.'<br/>';
        // echo $latlong->{'timezone'}.'<br/>';
        echo $weather;
    }else
    {
        $json = json_decode($weather);
        $current_weather=$json->{'main'}->{'temp'};
        return round($current_weather);
    }
}

function getMainCategory($subcategory) {
    if ($subcategory->parent_id == 0) {
        return $subcategory;
    }

    if ($subcategory->parent) {
        return getMainCategory($subcategory->parent);
    }

    return $subcategory;
}
function getLastChildCategory($category) {
    if ($category->sub_category->isNotEmpty()) {
        // Recursively call getLastChildCategory on the first subcategory
        return getLastChildCategory($category->sub_category->first());
    }

    return $category; // No child category found
}

function convert_currency($currency_from, $currency_to, $amount)
{
    // return Session::get('delemeterval');
    // Session::put('corre',$currency_to) ;
    // if ( Session::get('corre') == $currency_to) {
        if (Session::has('delemeterval') && is_numeric(Session::get('delemeterval'))) {
            try {
                $final = $amount * Session::get('delemeterval');
                return "{$final} {$currency_to} ";
            } catch (\Exception $e) {
                return 'Error: Unable to calculate using session value.';
            }
        } else {
            // dd($currency_to);
        $fromCurrency = urlencode($currency_from);
        $toCurrency = urlencode($currency_to);
        $apiKey = 'e7b7dc7f31914d24c2e5966b';

        $apiUrl = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$fromCurrency}";
        $responseJson = @file_get_contents($apiUrl);

        if ($responseJson === false || $responseJson == '') {
            return $amount . ' USD';
        }

        // Try/catch for json_decode operation
        try {
            // Decoding
            $response = json_decode($responseJson);

            if ('success' === $response->result) {
                $final = $amount * $response->conversion_rates->{$toCurrency};
                return "{$final} {$toCurrency} ";
            } else {
                return 'Error: API request failed with result ' . $response->result;
            }
        } catch (\Exception $e) {
            return 'Error: Unable to parse JSON response.';
        }
    }

    // Make a request to the API

}




function convert_currency_without_code($currency_from,$currency_to,$amount){

        // Make a request to the API
        $fromCurrency = urlencode($currency_from);
        $toCurrency = urlencode($currency_to);
        $apiKey = '87990edcabcc9065446b22e9';//e7b7dc7f31914d24c2e5966b

        // Fetch exchange rates from the API
        $apiUrl = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$fromCurrency}";
        $responseJson = @file_get_contents($apiUrl);

        if ($responseJson === false || $responseJson == '') {
            // Handle case where exchange rates cannot be fetched
            $result = $amount . ' USD';
        } else {
            // Try/catch for json_decode operation
            try {
                // Decoding
                $response = json_decode($responseJson);

                // Check for success
                if ('success' === $response->result) {
                    $final = $amount * $response->conversion_rates->{$toCurrency};
                    $result = "{$final} ";
                }
            } catch (\Exception $e) {
                // Handle JSON parse error...
                $result = 'Error: Unable to parse JSON response.';
            }
        }


    return $result;
}
