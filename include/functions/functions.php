<?php 

	function populatelist ($lstname, $str_query, $str_firstvalue="-1", $str_firstoption = "", $str_selected = "", $bln_disabled = false, $str_event = "", $str_style = "") {
		// Function to fetch using sql and populate values in a dropdown list
		$rsRES = mysqli_query($str_query) or die (mysqli_error() . $str_query);
		$str_disable = "";
		if ($bln_disabled == true){
		    $str_disable = "disabled";
		}
		echo '<select name="' . $lstname . '"' . $str_disable . ' ' . $str_event .  ' ' . $str_style . '>';
		if ( trim($str_firstoption) != "" && is_null($str_firstoption) == false ) {
		    if ( $str_selected == $str_firstvalue ) {
		        echo '<option selected="selected" value="' . $str_firstvalue . '">';
		        echo $str_firstoption;
		        echo '</option>';
		    }
		    else {
		        echo '<option value="' . $str_firstvalue . '">' . $str_firstoption . '</option>';
		    }
		}
		while ($arrRES = mysqli_fetch_array($rsRES)) {
		    if ( $str_selected == $arrRES[0] ) {
		        echo '<option selected="selected" value="' . $arrRES[0] . '">';
		        echo $arrRES[1];
		        echo '</option>';
		    }
		    else {
		        echo '<option value="' . $arrRES[0] . '">' . $arrRES[1] . '</option>';
		    }
		}
		echo '</select>';
	}



	function populate_list_array($objname, $array_list, $value_array, $display_array, $defaultvalue=-1,$disable=false,  $default_message = true,$options='class = "select styled hasCustomSelect" ',$default_select_message_text=""){ 
		// function used to populate list from associative array  
		GLOBAL $g_obj_select_default_text;
		if(trim($default_select_message_text)==""){
		$default_select_message_text=$g_obj_select_default_text;
		}
		($disable == true)?$disabled_out = ' disabled="true" ':$disabled_out=' ';
		$list = '<select name="'.$objname.'"  id="'.$objname.'"   '.$disabled_out.' '.$options.' >';
		$list .= ($default_message == true)?'<option selected="selected" value="-1">'.$default_select_message_text.'</option>' : "";
		if($array_list == false){
			// Do Nothing
		}else{
			
			foreach ($array_list as $value) {
				($defaultvalue == $value[$value_array])?$selected='selected="selected"':$selected="";
				$list .= '<option '.$selected.' value="'.$value[$value_array].'">'.$value[$display_array].'</option>';
			}

		}
			$list .= '</select>';
			echo $list;
	
	}


	function populate_array($objname, $data_array, $defaultvalue=-1,$disable=false, $default_message = true,$options='class = "select styled hasCustomSelect" '){ 
		// function used to populate list from  array 
		GLOBAL $g_obj_select_default_text;
		($disable == true)?$disabled = 'disabled="true"':$disabled='';
		$list = '<select name="'.$objname.'" '.$disabled.'" '.$options.'>';
		$list .= ($default_message == true)?'<option selected="selected" value="-1">'.$g_obj_select_default_text.'</option>' : "";		
		if($data_array == false){
			// Do Nothing
		}else{
			foreach ($data_array as $key => $value) {
				($defaultvalue == $key)?$selected='selected="selected"':$selected="";
				$list .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
			}
		}
			$list .= '</select>';
			echo  $list;
	}


function generate_language_links(){
	GLOBAL $myconnection;
	$query = "SELECT id, name FROM languages WHERE publish='".CONTENT_PUBLISH."' ORDER BY id" ;
	$rsRES = mysqli_query($myconnection, $query) or die (mysqli_error() . $query);
	if(mysqli_num_rows($rsRES)==0){
		// $this->debug_output.="From Function generate_language_links :: No language is Published. <br/>";
	}else{
		while ($arrRES = mysqli_fetch_array($rsRES)) {
			if($arrRES['id']== $_SESSION[SESSION_TITLE.'gLANGUAGE']){
			echo '&nbsp;'.$arrRES['name'].'&nbsp;';
		}else{
			echo '&nbsp;<a href="set_language.php?h_c='.md5("CONTENT_LANG").'&lang='.$arrRES['id'].'&url='.$_SERVER['REQUEST_URI'].' " >'.$arrRES['name'].'</a>&nbsp;';
		}
	}
	echo "&nbsp;&nbsp;&nbsp;";
	}
}




function get_filenames($dir_name,$ext="",$file_end_with="",$from_dir="",$recur=false){

$files = array();
$i = 0;
$dirs = dir ($dir_name);
if ( $i == NULL ) {$i = 0;}
$j=0;$k=0;
while ( ( $file = $dirs->read() ) != false ){
    //For recursive calling in the case of subdirectories
    if ( is_dir($dir_name."/".$file) && $recur == true ) {
            //to avoid parent dirs
            if( $file == "." || $file == ".." ){
            }
            else{

							$subfiles = get_filenames($dir_name."/".$file,$ext,$file_end_with,$from_dir,$recur);
							$files = array_merge($files,$subfiles);
							$i = sizeof($files);

				}
    }
    //
    else{
		$ext1 = explode('.', $file);

		$curr_dir = explode('/', $dir_name);
		$curr_dir = $curr_dir[count($curr_dir)-1];
	
		if($from_dir !="" ){
			if($curr_dir==$from_dir){

				if ( $ext != "" && $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$ext1 = $ext1[count($ext1)-1];
									if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
							}
				}
				elseif ( $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$files[$i] = $dir_name."/".$file; $i++;
							}
				}
				elseif ( $ext != "" ){
								$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
				}
				else{
					$files[$i] = $file; $i++;
				}
		
				}
			}else{
	
		
				if ( $ext != "" && $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
							}
				}
				elseif ( $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$files[$i] = $dir_name."/".$file; $i++;
							}
				}
				elseif ( $ext != "" ){
								$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
				}
				else{
					$files[$i] = $file; $i++;
				}
		
	
		}




    }
}


$dirs->close();

return $files;
}



function time_array (){
$time_array = array();$i=0;
	/* -- Time Range 12:00 AM - 11:00 PM -- */
    $time_array[$i]["time"] = "12:00 AM"; 
    $i++;
	for ( $i=1; $i <= 11; $i++) {
		$time_array[$i]["time"] =  $i . ":00 AM"; 
	}
	$time_array[$i]["time"] = "12:00 PM"; 
    $i++;
	for ( $i=13; $i <= 23; $i++) {
		$time_array[$i]["time"]  = ($i%12) . ":00 PM";
	}
  return $time_array;
}
 


function weekdays_array (){
$weekdays_array = array();$i=0;
    $weekdays_array[$i]["day"] = "Sunday"; $i++;
    $weekdays_array[$i]["day"] = "Monday"; $i++;
    $weekdays_array[$i]["day"] = "Tuesday"; $i++;
    $weekdays_array[$i]["day"] = "Wednesday"; $i++;
    $weekdays_array[$i]["day"] = "Thursday"; $i++;
    $weekdays_array[$i]["day"] = "Friday"; $i++;
    $weekdays_array[$i]["day"] = "Saturday"; $i++;
return $weekdays_array;
}
 
function time_zone_array (){
$time_zone_array = array();$i=0;
    $time_zone_array[$i]["zone"] = "Pacific Standard Time (PST)"; $i++;
    $time_zone_array[$i]["zone"] = "Mountain Standard Time (MST)"; $i++;
    $time_zone_array[$i]["zone"] = "Central Standard Time (CST)"; $i++;
    $time_zone_array[$i]["zone"] = "Eastern Standard Time(EST)"; $i++;
    $time_zone_array[$i]["zone"] = "Atlantic Standard Time (AST)"; $i++;
    $time_zone_array[$i]["zone"] = "Other Time Zones"; $i++;
return $time_zone_array;
}




function loadlanguage($lstname, $firstvalue=-1, $firstoption="Select Language", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, name FROM  languages WHERE publish='".CONTENT_PUBLISH."' ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}


function loadlanguage_admin($lstname, $firstvalue=-1, $firstoption="Select Language", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, name FROM  languages ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}


function loadcontenttypes($lstname, $firstvalue=-1, $firstoption="Select content Type", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, name FROM  contenttypes ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}



function search_assoc_key($id, $array, $id_key ="id", $name_key="name") {
   foreach ($array as $row ) {
       if ($row[$id_key] == $id) {
           return $row[$name_key];
       }
   }
   return "";
}


function is_mobile() {

	// Get the user agent

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	// Create an array of known mobile user agents
	// This list is from the 21 October 2010 WURFL File.
	// Most mobile devices send a pretty standard string that can be covered by
	// one of these.  I believe I have found all the agents (as of the date above)
	// that do not and have included them below.  If you use this function, you 
	// should periodically check your list against the WURFL file, available at:
	// http://wurfl.sourceforge.net/


	$mobile_agents = Array(


		"240x320",
		"acer",
		"acoon",
		"acs-",
		"abacho",
		"ahong",
		"airness",
		"alcatel",
		"amoi",	
		"android",
		"anywhereyougo.com",
		"applewebkit/525",
		"applewebkit/532",
		"asus",
		"audio",
		"au-mic",
		"avantogo",
		"becker",
		"benq",
		"bilbo",
		"bird",
		"blackberry",
		"blazer",
		"bleu",
		"cdm-",
		"compal",
		"coolpad",
		"danger",
		"dbtel",
		"dopod",
		"elaine",
		"eric",
		"etouch",
		"fly " ,
		"fly_",
		"fly-",
		"go.web",
		"goodaccess",
		"gradiente",
		"grundig",
		"haier",
		"hedy",
		"hitachi",
		"htc",
		"huawei",
		"hutchison",
		"inno",
		"ipad",
		"ipaq",
		"ipod",
		"jbrowser",
		"kddi",
		"kgt",
		"kwc",
		"lenovo",
		"lg ",
		"lg2",
		"lg3",
		"lg4",
		"lg5",
		"lg7",
		"lg8",
		"lg9",
		"lg-",
		"lge-",
		"lge9",
		"longcos",
		"maemo",
		"mercator",
		"meridian",
		"micromax",
		"midp",
		"mini",
		"mitsu",
		"mmm",
		"mmp",
		"mobi",
		"mot-",
		"moto",
		"nec-",
		"netfront",
		"newgen",
		"nexian",
		"nf-browser",
		"nintendo",
		"nitro",
		"nokia",
		"nook",
		"novarra",
		"obigo",
		"palm",
		"panasonic",
		"pantech",
		"philips",
		"phone",
		"pg-",
		"playstation",
		"pocket",
		"pt-",
		"qc-",
		"qtek",
		"rover",
		"sagem",
		"sama",
		"samu",
		"sanyo",
		"samsung",
		"sch-",
		"scooter",
		"sec-",
		"sendo",
		"sgh-",
		"sharp",
		"siemens",
		"sie-",
		"softbank",
		"sony",
		"spice",
		"sprint",
		"spv",
		"symbian",
		"tablet",
		"talkabout",
		"tcl-",
		"teleca",
		"telit",
		"tianyu",
		"tim-",
		"toshiba",
		"tsm",
		"up.browser",
		"utec",
		"utstar",
		"verykool",
		"virgin",
		"vk-",
		"voda",
		"voxtel",
		"vx",
		"wap",
		"wellco",
		"wig browser",
		"wii",
		"windows ce",
		"wireless",
		"xda",
		"xde",
		"zte"
	);

	// Pre-set $is_mobile to false.

	$is_mobile = false;

	// Cycle through the list in $mobile_agents to see if any of them
	// appear in $user_agent.

	foreach ($mobile_agents as $device) {

		// Check each element in $mobile_agents to see if it appears in
		// $user_agent.  If it does, set $is_mobile to true.

		if (stristr($user_agent, $device)) {

			$is_mobile = true;

			// break out of the foreach, we don't need to test
			// any more once we get a true value.

			break;
		}
	}

	return $is_mobile;
}



?>
