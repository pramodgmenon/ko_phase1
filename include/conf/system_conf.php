<?php
// for Page class
define('SESSION_TITLE','GFW_MVC_');
define('TEST_ALERT','Got Error!');

// $_SESSION[SESSION_TITLE.'gDEBUG'] = true;

if(isset($_SESSION[SESSION_TITLE.'gDEBUG']) && $_SESSION[SESSION_TITLE.'gDEBUG'] == true){
    define('gDEBUG',true);
}else{
    define('gDEBUG',false);
}

// $_SESSION[SESSION_TITLE.'gEDIT_MODE'] = true;

if(isset($_SESSION[SESSION_TITLE.'gEDIT_MODE']) && $_SESSION[SESSION_TITLE.'gEDIT_MODE'] == true){
    define('gEDIT_MODE',true);
}else{
    define('gEDIT_MODE',false);
}

define('gINVALID',-1);

define('CONTENT_LANG_ENGLISH',1);
define('CONTENT_LANG_MALAYALAM',2);
if(!isset($_SESSION[SESSION_TITLE.'gLANGUAGE'])){
	$_SESSION[SESSION_TITLE.'gLANGUAGE'] = CONTENT_LANG_ENGLISH;
}


// content publish or not
 define('CONTENT_NOT_PUBLISH',0);
 define('CONTENT_PUBLISH',1);

// for contenttypes
 define('CONTENT_TYPE_HTML',1);
 define('CONTENT_TYPE_TEXT',2);

//falsh
 define('DEFAULT_REDIRECT_PAGE',"index.php");


?>
