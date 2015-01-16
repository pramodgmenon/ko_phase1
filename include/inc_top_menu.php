<?php 
	$url_profile ="#";
	

	if(isset($_SESSION[SESSION_TITLE.'userid'])){ 
		
			$url_profile = "/profile.php";
		
?>
<a href="<?php echo $url_profile ?>" class="no-border" >Welcome <?php echo $_SESSION[SESSION_TITLE.'name']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php }
?>
<?php if(isset($_SESSION[SESSION_TITLE.'userid'])){ ?>

	<a href="<?php echo $organization_prefix; ?>/change_password.php" <?php if($this->page_name == "change_password"){?> class="active no-border"<?php  }?> >Change Password</a>
	<a href="<?php echo $organization_prefix; ?>/logout.php" class="no-border">Logout</a>

<?php }else{ ?>
	<a href="<?php echo WEB_URL ; ?>/login.php" <?php if($this->page_name == "login"){?> class="active no-border"<?php  }?>>Login</a>
	<a href="<?php echo WEB_URL ; ?>/sign_up.php"  <?php if($this->page_name == "sign_up"){?> class="active no-border"  <?php  }else{ ?> class="no-border"  <?php } ?> >Sign Up</a>
	
<?php } ?>






