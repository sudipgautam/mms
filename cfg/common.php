<?php

require_once('config.php');

// all database stuff
class db_connection{
    public $host = DB_HOST;
    public $user = DB_USER;
    public $password = DB_PASSWORD;
    public $db= DB_NAME;
    public $dbc;
    public $port = 3307;

    function __construct() {
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->db, $this->port);

        if(mysqli_errno($con)){
            echo"DB connection Error, we are counting money, we will be back soon.";

        }
        else{
           $this->dbc = $con; // assign $con to $dbc
        }
        return $this->dbc;
    }

    public function query($query) {
        $result = $this->dbc->query($query);
        if (!$result) die('Invalid query: ');
        return $result;
    }

    public function __destruct() {
        mysqli_close($this->dbc);
    }


}

// clean string and get hash activation code
class clean_and_hash{
	private $salt;
	private $securepass;
	private $finalsecuredpass;
	private $sub;
	private $activation_id;
	public function clean_all_tags($string){
		return htmlspecialchars(htmlentities(strip_tags($string)));
	}

	public function password_hash($email,$password){
		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
			$this->finalsecuredpass 	= null;
			$this->salt 				= $email."WtF M@g!!cKK";
			$this->securedpass 			= crypt($password, $this->salt);
			$this->finalsecuredpass 	= hash('sha512',$this->securedpass);
			return $this->finalsecuredpass;
		}
		else {
			echo "CRYPT_BLOWFISH is not available. Admin might be doing something tricky admin@mymoneysplit.com";
		}

	}
	public function get_activation_code($email){
		$this->sub = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 15)), 0, 15);
		$this->activation_id = $this->password_hash($email,$this->sub);
		return $this->activation_id;

	}
}
?>
