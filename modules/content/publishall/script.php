    <!--
    function Trim(strInput) {
    while (true) {
        if (strInput.substring(0, 1) != " ")
            break;
        strInput = strInput.substring(1, strInput.length);
    }
    while (true) {
        if (strInput.substring(strInput.length - 1, strInput.length) != " ")
            break;
        strInput = strInput.substring(0, strInput.length - 1);
    }
   return strInput;
    }

    function validate_publish(){
        error = "";
        frm = document.getElementById("frmpublishall");
        if(Trim(frm.lstlanguage.value) == -1){
           error += "<?php echo $MSG_empty_language; ?>\n";
        }
        if ( error != "" ){
            alert(error);
            return false;
        }
        else{
            return true;
        }
    }
    -->