<?php 

$tmp_heading = "Demo Application";

$heading = $this->content->get_content(CONTENT_TYPE_TEXT,"Index Heading","index.php",$tmp_heading);

$tmp_content = "<p>1) Login to Demo Application 	</p>							
		<p>2) Username : tester@gfw.legreensolutions.com</p>		
		<p>3) Password : 123456</p>
		<p>4) Please check Demo on Dashboard  .</p>";

$index_content = $this->content->get_content(CONTENT_TYPE_HTML,"Index Content","index.php",$tmp_content);


?>
