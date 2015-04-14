<?php 
$page_name = "thankyou";

//////////////////////

$tmp_content_caption = "Title";

$tmp_content = "KOLAPILLY AYURVEDA :: THANK YOU";
$this->content->set_content(CONTENT_TYPE_TEXT,$tmp_content_caption,$page_name,$tmp_content, "",CONTENT_LANG_ENGLISH, CONTENT_PUBLISH);

$tmp_content = "കോളാപ്പിള്ളി  ആയുര്‍വേദ :: സന്ദേശം സ്വീകരിച്ചിരിക്കുന്നു ";
$this->content->set_content(CONTENT_TYPE_TEXT,$tmp_content_caption,$page_name,$tmp_content, "",CONTENT_LANG_MALAYALAM, CONTENT_PUBLISH);


/////////////////////////////
$tmp_content_caption = "Message OK";

$tmp_content = "Thank you for contacting us. ";
$this->content->set_content(CONTENT_TYPE_HTML,$tmp_content_caption,$page_name,$tmp_content, "",CONTENT_LANG_ENGLISH, CONTENT_PUBLISH);

$tmp_content = "നിങ്ങളുടെ സന്ദേശം സ്വീകരിച്ചിരിക്കുന്നു, നന്ദി. ";
$this->content->set_content(CONTENT_TYPE_HTML,$tmp_content_caption,$page_name,$tmp_content, "",CONTENT_LANG_MALAYALAM, CONTENT_PUBLISH);


/////////////////////////////
$tmp_content_caption = "Message Not OK";

$tmp_content = "Unable to accept message. ";
$this->content->set_content(CONTENT_TYPE_HTML,$tmp_content_caption,$page_name,$tmp_content, "",CONTENT_LANG_ENGLISH, CONTENT_PUBLISH);

$tmp_content = "നിങ്ങളുടെ സന്ദേശം  തിരസ്കരിച്ചിരിക്കുന്നു.";
$this->content->set_content(CONTENT_TYPE_HTML,$tmp_content_caption,$page_name,$tmp_content, "",CONTENT_LANG_MALAYALAM, CONTENT_PUBLISH);


/////////////////////////////
?>


