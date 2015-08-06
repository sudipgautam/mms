<?php
	session_start();
	require_once('../cfg/common.php');
	require_once('../cfg/config.php');
	$ch         	= new clean_and_hash();
    $bill_title     = $ch->clean_all_tags($_POST['bill_title']);
    $bill_desc  	= $ch->clean_all_tags($_POST['bill_description']);
    $bill_amount 	= $ch->clean_all_tags($_POST['bill_amount']);
    $start_bill_day = $ch->clean_all_tags($_POST['start_bill_day']);
    $date 			= new DateTime();
	$unix_date 		= $date->getTimestamp();
	$bill_id 		= sha1($_SESSION['mms_logged_uid'].$unix_date); 
    $dbconn 		= new db_connection();
    $success_addbill= -1;
    $logged_user 	= $_SESSION['mms_logged_uid'];
    $sum_of_all_shares = 0 ;
    $insert_statement = "INSERT into ".expense_details." (exp_id,expense_title,expense_desc, expense_total,exp_owner,exp_date) values ('".$bill_id."','".$bill_title."','".$bill_desc."',".$bill_amount.",'".$logged_user."','".$start_bill_day."')";
    $insert_cmd = $dbconn->query($insert_statement);
    if ($insert_cmd) {
        	$success_addbill = 1; 
   	    }
        else {
    	    $success_addbill = 0;
        }
    if( isset($_POST['split_frens_check'])){
    	$num_of_frens = 1; 
    	$success_fren_add_share = 0 ; 
    	$failure_fren_add_share = 0 ;
    	while ( isset($_POST["name$num_of_frens"])) {
    		$fren_name  = $ch->clean_all_tags($_POST["name$num_of_frens"]);
    		$fren_share = $ch->clean_all_tags($_POST["share$num_of_frens"]);
    		$sum_of_all_shares += $fren_share;
    		$insert_statement_fren = "INSERT into ".user_split_expense." (email,exp_id,exp_share) values ('".$fren_name."','".$bill_id."',".$fren_share.")";
    		$insert_fren_share = $dbconn->query($insert_statement_fren);
    		if ($insert_cmd) {
        		$success_fren_add_share++; 
   	    	}
        	else {
    	    	$failure_fren_add_share++;
        	}

    		$num_of_frens++;
    	}
	}
	$my_share = $bill_amount - $sum_of_all_shares;
    $insert_statement_fren = "INSERT into ".user_split_expense." (email,exp_id,exp_share) values ('".$logged_user."','".$bill_id."',".$my_share.")";
    echo $insert_statement_fren;
    $insert_fren_share = $dbconn->query($insert_statement_fren);
    if ($insert_cmd) {
        $success_fren_add_share++; 
   	}
    else {
    	$failure_fren_add_share++;
   	}

    //echo $num_of_frens;

?>