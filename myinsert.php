
<?php

 include("DB.php");

	  $q1="INSERT INTO `admin` (`Admin_name`, `Admin_username`, `Admin_password`, `Admin_email`, `Admin_telephone`) VALUES ('Ali','Ali','123','a@yahoo.com','213213')";

  	$db->myExec($q1);


?>
