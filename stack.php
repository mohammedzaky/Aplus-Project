



<?php
  
 include("DB.php");




//Connect to database
//include_once('database.php');
//get Table contents
$rows=$db->getRows("SELECT Student_name , Student_studentID , Student_username , Student_password FROM student",array());

//save the data as text delimited as excel reuired
//Delimited text files (.xls), in which the TAB (\t)character typically separates each field of text.
//each row is delimted by new line \n
$columnHeader = '';
$columnHeader = "Student name" . "\t" . "Student ID " . "\t" . "Username" . "\t" . "Password" . "\t";
$setData = '';

  foreach($rows as $rec) {
      $rowData = '';
      foreach ($rec as $value) {
          $s1 = '"' . $value . '"' . "\t";
          $rowData .= $s1;
      }
      $setData .= trim($rowData) . "\n";
  }

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=A+_Student_Register_Detail_Reoprt.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";

?>




