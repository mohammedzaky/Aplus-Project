<?php
include("DB.php");
$eid=$_GET['eid'];
$qq="select Question_name,Question_a,Question_b,Question_c,Question_d,Question_answer from question where Exam_ID='$eid';";
$rows=$db->getRows($qq,array());
$columnHeader = '';
//$columnHeader = "Sr NO" . "\t" . "User Name" . "\t" . "Password" . "\t";
$setData = '';
foreach($rows as $rec) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"' . $value . '"' . "\n";
        $rowData .= $value;
    }
    $setData .= trim($rowData) . "\n";
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=User_Detail_Reoprt.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?>
