<?php
session_start();
header("Content-Type:application/json");
require_once('../cfg/common.php');
$dbconn     = new db_connection();
$logged_user= $_SESSION['mms_logged_uid'];
$start = $_GET['start'];
$end 	= $_GET['end'];
$prepare_statement = "SELECT * from ".expense_details." a,  ".user_split_expense." b where a.exp_id = b.exp_id and b.email='".$logged_user."'";
//echo $prepare_statement;
$result     = $dbconn->query($prepare_statement);
$expense 	= array();
$num_rows 	= 0 ;
//start=2014-11-30&end=2015-01-11&timezone=UTC&_=1420015222023"
if (($result->num_rows) > 0 ){
	while ($row = mysqli_fetch_assoc($result)){
    	$expenseArray['id'] =  $row['exp_id'];
    	$expenseArray['title'] = $row['expense_title'];
    	$expenseArray['description'] = $row['expense_desc'];
    	$expenseArray['amount']	= $row['expense_total'];
    	$expenseArray['start'] = $row['exp_date'];
    	$expenseArray['allDay'] = "1";
    	$expense[$num_rows] = $expenseArray;
    	$num_rows++;
	}
}
echo json_encode($expense);
//exp_id,expense_title,expense_desc, expense_total,exp_owner,exp_date
?>