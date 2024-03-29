<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserSession {
    var $connection;
    var $id = gINVALID;
    var $username	= "" ;
    var $password	= "";
	var $first_name 	= "";
    var $last_name		= "";
    var $email			= "";
    var $address		= "";
    var $occupation 	= "";
    var $user_status_id	= "";



    var $error = false;
    var $error_number=gINVALID;
    var $error_description="";


    function __construct($username,$password,$connection)
    {
			$this->username =$username;
			$this->password =$password;
			$this->connection =$connection;
    }

    function login(){
          $strSQL = "SELECT U.* FROM users U WHERE U.username = '".mysqli_real_escape_string($this->username);
          $strSQL .= "' AND U.password='".$this->password."' AND (U.user_status_id = '".USERSTATUS_ACTIVE."')";
		//echo $strSQL;exit();
          $rsRES = mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
          if ( mysqli_num_rows($rsRES) > 0 ){
                $this->id = mysqli_result($rsRES,0,'id');
                $this->username = mysqli_result($rsRES,0,'username');
                $this->email = mysqli_result($rsRES,0,'email');
                $this->first_name = mysqli_result($rsRES,0,'first_name');
                $this->last_name = mysqli_result($rsRES,0,'last_name');
				$this->user_status_id=mysqli_result($rsRES,0,'user_status_id');

				$_SESSION[SESSION_TITLE.'user_status_id'] = $this->user_status_id;
				$_SESSION[SESSION_TITLE.'userid'] = $this->id;
				$_SESSION[SESSION_TITLE.'name'] = $this->first_name." ".$this->last_name;
				$_SESSION[SESSION_TITLE.'username'] = $this->username;
				$_SESSION[SESSION_TITLE.'user_type'] = REGISTERED_USER;

		return true;
          }
          else{
                $this->error_description = "Login Failed";
                return false;
          }
    }


    function check_login(){
		if ( isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0 && $this->id == $_SESSION[SESSION_TITLE.'userid'] && $_SESSION[SESSION_TITLE.'user_type'] == REGISTERED_USER ) {
			return true;
		}else{
			return false;
		}

	}

    function logout(){
        $chk = session_destroy();
        if ($chk == true){
            return true;
        }
        else{
                return false;
        }
    }


}

?>
