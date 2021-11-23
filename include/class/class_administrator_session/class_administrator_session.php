<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class AdministratorSession {
    var $connection;
    var $id = gINVALID;
    var $username;
    var $password;
    var $emailid;
    var $registrationdate;
    var $lastlogin;
    var $sec_que_id = gINVALID;
    var $answer = "";

    var $created = "";
    var $updated = "";
    var $record_user_id= gINVALID;

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
          $strSQL = "SELECT * FROM administrators WHERE username = '".mysqli_real_escape_string($this->username);
          $strSQL .= "' AND password='".$this->password."'";
          $rsRES = mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
          if ( mysqli_num_rows($rsRES) > 0 ){
                $this->id = mysqli_result($rsRES,0,'id');
                $this->username = mysqli_result($rsRES,0,'username');
                $this->emailid = mysqli_result($rsRES,0,'emailid');
                $this->registrationdate = mysqli_result($rsRES,0,'registrationdate');
                $this->lastlogin = mysqli_result($rsRES,0,'lastlogin');
                return true;
          }
          else{
                $this->error_description = "Login Failed";
                return false;
          }
    }

    function register_login(){
           $_SESSION[SESSION_TITLE.'admin_userid'] = $this->id;
           $_SESSION[SESSION_TITLE.'admin_username'] = $this->username;
           $_SESSION[SESSION_TITLE.'user_type'] = ADMINISTRATOR;


			$strSQL = "UPDATE administrators SET lastlogin=now() WHERE id='".$this->id."'";
			mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
            return true;
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


    function check_login(){
		if ( isset($_SESSION[SESSION_TITLE.'admin_userid']) && $_SESSION[SESSION_TITLE.'admin_userid'] > 0 && $this->user_id == $_SESSION[SESSION_TITLE.'admin_userid'] && $_SESSION[SESSION_TITLE.'user_type'] == ADMINISTRATOR ) {
			return true;
		}else{
			return false;
		}
    
	}

}
 
?>
