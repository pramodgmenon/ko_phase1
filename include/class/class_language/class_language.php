<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Language {
    var $connection;
    var $id = gINVALID;
    var $publish = CONTENT_NOT_PUBLISH;
    var $publish_status = "No";
    var $language = "";

    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";


function get_id(){
    $strSQL = "SELECT id AS id,name,publish ";
    $strSQL .= "FROM languages  WHERE name = '".$this->language."'";
    $rsRES = mysqli_query($strSQL,$this->connection) or die ( mysqli_error() . $strSQL );
    if ( mysqli_num_rows($rsRES) > 0 ){
        $this->id = mysqli_result($rsRES,0,'id');
        $this->language = mysqli_result($rsRES,0,'name');
        $this->publish = mysqli_result($rsRES,0,'publish');
        if ( $this->publish == CONTENT_NOT_PUBLISH ) $this->publish_status = "No";
        else $this->publish_status = "Yes";
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This Language doesn't exist";
        return false;
    }
}

function get_detail(){
    $strSQL = "SELECT id AS id,name,publish ";
    $strSQL .= "FROM languages  WHERE id = '".$this->id."'";
    $rsRES = mysqli_query($strSQL,$this->connection) or die ( mysqli_error() . $strSQL );
    if ( mysqli_num_rows($rsRES) > 0 ){
        $this->id = mysqli_result($rsRES,0,'id');
        $this->language = mysqli_result($rsRES,0,'name');
        $this->publish = mysqli_result($rsRES,0,'publish');
        if ( $this->publish == 0 ) $this->publish_status = "No";
        else $this->publish_status = "Yes";

        $languages = array();$i=0;
        $languages[$i]["id"] =  $this->id;
        $languages[$i]["language"] = $this->language;
        $languages[$i]["publish"] = $this->publish;

        return $languages ;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO languages (name,publish) VALUES ('";
    $strSQL .= addslashes(trim($this->language)) ."','";
    $strSQL .= addslashes(trim($this->publish)) . "')";
	
    $rsRES = mysqli_query($strSQL,$this->connection) or die ( mysqli_error() . $strSQL );
          if ( mysqli_affected_rows($this->connection) > 0 ) {
              $this->id = mysqli_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this Language";
              return false;
          }
    } elseif($this->id > 0 ) {
    $strSQL = "UPDATE languages SET name = '".addslashes(trim($this->language))."',";
    $strSQL .= "publish = ".addslashes(trim($this->publish))."";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
            if ( mysqli_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Language";
                return false;
            }
    }
}
function delete(){
        $strSQL = "DELETE FROM languages WHERE id =".$this->id;
        $rsRES = mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
            if ( mysqli_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Can't Delete This Language";
                return false;
            }
    }
function get_list_array(){
        $cities = array();$i=0;

        $strSQL = "SELECT id,name,publish FROM languages";
        $rsRES = mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
        if ( mysqli_num_rows($rsRES) > 0 ){
            while ( list ($id,$name,$publish) = mysqli_fetch_row($rsRES) ){
                $languages[$i]["id"] =  $id;
                $languages[$i]["name"] = $name;
                $languages[$i]["publish"] = $publish;
                if ( $languages[$i]["publish"] == CONTENT_NOT_PUBLISH )
                    $languages[$i]["publish_status"] = "No";
                else
                    $languages[$i]["publish_status"] = "Yes";
                $i++;
            }
            return $languages;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list languages";
        return false;
        }
}

function get_list_array_bylimit($language="",$publish=-1,$start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";
        $strSQL = "SELECT id AS id,name,publish FROM languages ";
        if ($language != "" ) {
            if (trim($str_condition) =="") {
                $str_condition = " name  LIKE '%" . $language . "%'" ;
            }else{
                $str_condition .= " AND name  LIKE '%" . $language . "%'" ;
            } 
        }
        if ( $publish != "" && $publish != -1 ) {
            if (trim($str_condition) =="") {
                $str_condition = "  publish  = '" . $publish . "'" ;
            }else{
                $str_condition .= " AND publish  = '" . $publish . "'" ;
            } 
        }
        if (trim($str_condition) !="") {
            $strSQL .= " WHERE  " . $str_condition . "  ";
        }
        $strSQL .= "ORDER BY name";
        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysqli_query($strSQL_limit, $this->connection) or die(mysqli_error(). $strSQL_limit);

        if ( mysqli_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
                
            } else {
                $all_rs = mysqli_query($this->connection, $strSQL) or die(mysqli_error(). $strSQL_limit); 
                $this->total_records = mysqli_num_rows($all_rs);
            }
    
            while ( $row = mysqli_fetch_assoc($rsRES) ){
                $limited_data[$i]["id"] = $row["id"];
                $limited_data[$i]["language"] = $row["name"];
                $limited_data[$i]["publish"] = $row["publish"];
                if ( $limited_data[$i]["publish"] == CONTENT_NOT_PUBLISH )
                    $limited_data[$i]["publish_status"] = "No";
                else
                    $limited_data[$i]["publish_status"] = "Yes";
                $i++;
            }
            return $limited_data;
        }else{
            $this->error_number = 5;
            $this->error_description="Can't get limited data";
            return false;
        }
}
function get_array()
    {
        $languages = array();
		
        $strSQL = "SELECT  id,name FROM languages";
        $rsRES = mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
        if ( mysqli_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysqli_fetch_row($rsRES) ){
				$languages[$id] = $id;
               	$languages[$id] = $name;
            }
            return $languages;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}

function get_array_lang()
    {
        $languages = array();
		
        $strSQL = "SELECT  id,name FROM languages";
        $rsRES = mysqli_query($strSQL,$this->connection) or die(mysqli_error(). $strSQL );
        if ( mysqli_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysqli_fetch_row($rsRES) ){
				$languages[$id] = $name;
               
            }
            return $languages;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}

}
?>
