<?php
		ob_start();
		require_once('connection.php');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		session_start();
		if(isset($_SESSION['SESS_FIRST_NAME']))
		{
			$x=$_SESSION['SESS_MEMBER_ID'];
			$query="SELECT * FROM register WHERE id='$x'";
			$exec=mysql_query($query);
			if(!$exec)
			{
				doLogOut();
			}
			$row=mysql_fetch_assoc($exec);
			$ext_flag=$row['status'];
			if($ext_flag==0)
			{
				/*unset($_SESSION['SESS_STUDENT_ID']);
				unset($_SESSION['SESS_ROLL_NUMBER']);
				unset($_SESSION['NAME']);
				unset($_SESSION['PARENT_NAME']);
				unset($_SESSION['user_level']);*/
				
				unset($_SESSION['SESS_MEMBER_ID']);
			unset($_SESSION['SESS_FIRST_NAME']);
			unset($_SESSION['SESS_LAST_NAME']);
				header("location:index.php");
			}
				
		}
		if(!isset($_SESSION['SESS_FIRST_NAME']) || (trim($_SESSION['SESS_FIRST_NAME']) == '')) {
		header("location: ../../index.php");
		exit();
	}
	function doLogOut()
	{
		header("location:../../index.php");
	}
?>