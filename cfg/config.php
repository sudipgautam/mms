<?php

//this file will contains all the constants value
//MYSQL SETTINGS
$server = $_SERVER['HTTP_HOST'];
if ($server == "mymoneysplit.com"){
	define('DB_NAME','my_db_shelly');// the name of the database .
	define('DB_USER','db1');
	define('DB_PASSWORD','shellybelly10');
	define('DB_HOST','localhost');

//BASE FILE NAME
	define('BASE_PATH','http://mymoneysplit.com/mymoneysplit/');
//define('BASE_PATH','.');

//FACEBOOK RELATED SETTNGS
	define('FACEBOOK_GRAPH_PATH','https://graph.facebook.com/');
	define('FACEBOOK_APP_ID','739035616145382');
	define('FACEBOOK_SECRET_ID','8dc44ef4e134066bd7463e77dd06adcf');

//DATABASE TABLE NAMES
	define('USER_VERIFICATION_TABLE','login_information');
	define('USER_SIGNUP_TABLE','signUp_Table');
	define('USER_MONEY_DISTRIBUTION_TABLE','MoneyDistribution');

}
else {
	define('DB_NAME','mms');// the name of the database .
	define('DB_USER','root');
	define('DB_PASSWORD','limewire');
	define('DB_HOST','127.0.0.1');
	define('user_profile','user_profile');
	define('user_split_expense','user_split_expense');
	define('expense_details','expense_details');

//BASE FILE NAME
	define('BASE_PATH','http://localhost/');
//define('BASE_PATH','.');

//FACEBOOK RELATED SETTNGS
	define('FACEBOOK_GRAPH_PATH','https://graph.facebook.com/');
	define('FACEBOOK_APP_ID','739035616145382');
	define('FACEBOOK_SECRET_ID','8dc44ef4e134066bd7463e77dd06adcf');

//DATABASE TABLE NAMES
	define('user_info','user_info');
	define('USER_SIGNUP_TABLE','signUp_Table');
	define('USER_MONEY_DISTRIBUTION_TABLE','MoneyDistribution');
}

//MAIL SETTINGS
define('HOST','smtp.gmail.com');
define('PORT',587);
define('SMTPSECURE','tls');
define('MAIL_USER','moneywisemailsender@gmail.com');
define('MAIL_PASSWORD','moneywise10');
define('MAIL_FROM','moneywisemailsender@gmail.com');
define('MAIL_WORD_WRAP',500);
define('MAIL_SUBJECT','Reset Password for MoneyWise');

?>
