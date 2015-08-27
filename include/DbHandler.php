<?php
 
/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Arvind Dhandapani
 */
class DbHandler {
 
    private $conn;
 
    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
 
    /* ------------- `users` table method ------------------ */
 
    /**
     * Creating new user
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */
    public function createUser($name, $email, $password, $verification_code, $status) {
        require_once 'PassHash.php';
        $response = array();
 
        // First check if user already existed in db
        if (!$this->isUserExists($email)) {
            // Generating password hash
            $password_hash = PassHash::hash($password);
 
            // Generating API key
            $api_key = $this->generateApiKey();
 
            // insert query
            $stmt = $this->conn->prepare("INSERT INTO users(name, email, password_hash, api_key, verification_code, status) values(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $email, $password_hash, $api_key, $verification_code, $status);
 
            $result = $stmt->execute();
 
            $stmt->close();
 
            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                return USER_CREATED_SUCCESSFULLY;
            } else {
                // Failed to create user
                return USER_CREATE_FAILED;
            }
        } else {
            // User with same email already existed in the db
            return USER_ALREADY_EXISTED;
        }
 
        return $response;
    }
 
    /**
     * Checking user login
     * @param String $email User login email id
     * @param String $password User login password
     * @return boolean User login status success/fail
     */
    public function checkLogin($email, $password) {
        // fetching user by email
        $stmt = $this->conn->prepare("SELECT password_hash FROM users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->bind_result($password_hash);
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // Found user with the email
            // Now verify the password
 
            $stmt->fetch();
 
            $stmt->close();
 
            if (PassHash::check_password($password_hash, $password)) {
                // User password is correct
                return TRUE;
            } else {
                // user password is incorrect
                return FALSE;
		   
            }
        } else {
            $stmt->close();
 
            // user not existed with the email
            return FALSE;
        }
    }
    /**
     * Checking for duplicate user by email address
     * @param String $email email to check in db
     * @return boolean
     */
	
	public function authVerify($email, $auth_code) {
		$stmt = $this->conn->prepare("SELECT status from users WHERE email = ? AND verification_code = ?");
		$stmt->bind_param("ss", $email,$auth_code);
        $stmt->execute();
		 $stmt->bind_result($status);
        $stmt->store_result();
		 if ($stmt->num_rows > 0) {
             $stmt->fetch();
 
             $stmt->close();
			  if ($status == "0") {
          
		
		         $stmt = $this->conn->prepare("UPDATE users set status = 1 WHERE email = ? AND verification_code = ?");
		         $stmt->bind_param("ss", $email,$auth_code);
		         $stmt->execute();
		         $num_affected_rows = $stmt->affected_rows;
		         $stmt->close();
		         return 1;
			 } else {
				 return 2;
			 } 
		 } else {
			 return 3;
		 }
				
		
	}
 
 	/**
	* Get all orders of an user
	*
	*
	*/
 	
	public function getOrderfromUserID($user_id) {
		//first get the userID
		//$user_id = getuserIdfromEmail($email);
		//Now get the date Amount and Order ID from Order Table
        $stmt = $this->conn->prepare("SELECT order_id, order_amount, order_update_date from order_master WHERE order_user_id = ? GROUP BY order_id");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $orderDetails = $stmt->get_result();
        $stmt->close();
        return $orderDetails;
	}
  
 
 	/**
	* Get all details about the order
	*
	*
	*/
 	
	public function getOrderList($order_id) {
		//first get the userID
		//$user_id = getuserIdfromEmail($email);
		//Now get the date Amount and Order ID from Order Table
        $stmt = $this->conn->prepare("select s.song_name,s.price,a.album_name,o.order_amount,o.order_update_date from songs s, albums a, order_master o where s.song_id IN (SELECT c.cart_song_id from order_master o left join cart c on o.order_id = c.cart_order_id where o.order_id = ?) and a.id IN (SELECT c.album_id from order_master o left join cart c on o.order_id = c.cart_order_id where o.order_id = ?) and o.order_id = ?");
        $stmt->bind_param("sss", $order_id,$order_id,$order_id);
        $stmt->execute();
        $orderDetails = $stmt->get_result();
        $stmt->close();
        return $orderDetails;
	}
  
	public function getOrderInfo($order_id) {
		//first get the userID
		//$user_id = getuserIdfromEmail($email);
		//Now get the date Amount and Order ID from Order Table
        $stmt = $this->conn->prepare("SELECT * from order_master where order_id = ?");
        $stmt->bind_param("s", $order_id);
        $stmt->execute();
        $orderDetails = $stmt->get_result();
        $stmt->close();
        return $orderDetails;
	}
  
 

 
    /**
     * Checking for duplicate user by email address
     * @param String $email email to check in db
     * @return boolean
     */
    private function isUserExists($email) {
        $stmt = $this->conn->prepare("SELECT id from users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
 
    /**
     * Fetching user by email
     * @param String $email User email id
     */
    public function getUserByEmail($email) {
		$stmt = $this->conn->prepare("SELECT u.name, u.email, u.api_key, u.status, u.created_at, l.song_session FROM users u,login_details l WHERE u.email = ? and u.email=l.email");
       // $stmt = $this->conn->prepare("SELECT u.name, u.email, u.api_key, u.status, u.created_at FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
	
    /**
     * Fetching artist by Album ID
     * @param String $email User email id
     */
    public function getArtist($albumId) {
		$stmt = $this->conn->prepare("SELECT music_director FROM albums WHERE id = ?");
       // $stmt = $this->conn->prepare("SELECT u.name, u.email, u.api_key, u.status, u.created_at FROM users WHERE email = ?");
        $stmt->bind_param("i", $albumId);
        if ($stmt->execute()) {
            $musicD = $stmt->get_result()->fetch_object()->music_director;
            $stmt->close();
            return $musicD;
        } else {
            return NULL;
        }
    }
	
	
    public function getSongSession($email) {
		$stmt = $this->conn->prepare("SELECT song_session FROM login_details WHERE email = ?");
       // $stmt = $this->conn->prepare("SELECT u.name, u.email, u.api_key, u.status, u.created_at FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
	
	/**
 	*update the login table
    */
	public function updateLoginByEmail($email) {
		$stmt1 = $this->conn->prepare("select id from login_details where email = ?");
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $stmt1->store_result();
        $num_rows = $stmt1->num_rows;
        $stmt1->close();
        // Generating API key
        $api_key = $this->generateApiKey();
        if ($num_rows > 0) {
			//$stmt = $this->conn->prepare("UPDATE login_details set login_at = now() and song_session = ? where email = ?");
			$stmt = $this->conn->prepare("UPDATE login_details set song_session = ? where email = ?");
			
	        $stmt->bind_param("ss", $api_key,$email);
			
	        $stmt->execute();
			
	        $num_affected_rows = $stmt->affected_rows;
	        $stmt->close();
			
			//return 	$num_rows;
			
        } else {
			$stmt = $this->conn->prepare("Insert into login_details(song_session,login_at,email) VALUES (?,now(),?)");
				        $stmt->bind_param("ss", $api_key,$email);
				        $stmt->execute();
				        $num_affected_rows = $stmt->affected_rows;
				        $stmt->close();
						//return 	$num_affected_rows;
						//return 2;
        }
        $stmt = $this->conn->prepare("SELECT email, song_session FROM login_details WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
		
	}
	
     /** Fetching user api key
     * @param String $user_id user id primary key in user table
     */
    public function getApiKeyById($user_id) {
        $stmt = $this->conn->prepare("SELECT api_key FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $api_key = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $api_key;
        } else {
            return NULL;
        }
    }
	
 
 
    /**
     * Fetching user id by api key
     * @param String $api_key user api key
     */
    public function getUserId($api_key) {

        $stmt = $this->conn->prepare("SELECT email FROM login_details WHERE song_session = ?");
                $stmt->bind_param("s", $api_key);
                if ($stmt->execute()) {
                    $email_id = $stmt->get_result()->fetch_object()->email;
                    $stmt->close();
        			//$user_id = getUserIdFromEmail($email_id);
        			 return $email_id;
                } else {
                    return NULL;
                }
        
    }
	
	/*
	*Inserting into orders table
	* 
	*
	*/
	
	public function insertIntoOrderTable($user_id, $order_id, $ResponseCode, $Message, $TxnID, $ePGTxnID, $AuthIdCode, $RRN, $CVRespCode, $raagas_amount) {
      
     //mysqli_report(MYSQLI_REPORT_ALL) ;
     /*
       $stmt = $this->conn->prepare("Insert into order_master(order_id,order_user_id) values (??)");
                       $stmt->bind_param("si", $order_id, $user_id);*/
     
     
      
		//$user_id = "hit";
      
       $stmt = $this->conn->prepare("INSERT INTO order_master(order_id,order_user_id,order_amount,order_ResponseCode,order_Message,order_TxnID,order_ePGTxnID,order_AuthIdCode,order_RRN,order_CVRespCode) VALUES (?,?,?,?,?,?,?,?,?,?)");
      	   
               $stmt->bind_param("sissssssss", $order_id,$user_id,$raagas_amount,$ResponseCode,$Message,$TxnID,$ePGTxnID,$AuthIdCode,$RRN,$CVRespCode);
      		 
      
       
        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        }
		
	}
	
	
	/*
	*   Fetch user id by email id
	*   @param String email_id
	*/
    public function getUserIdFromEmail($email_id) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email_id);
        if ($stmt->execute()) {
			//$name = $mysqli->query("SELECT name FROM contacts WHERE id = 5")->fetch_object()->name;
            $user_id = $stmt->get_result()->fetch_object()->id;
            $stmt->close();
            return $user_id;
        } else {
            return NULL;
        }
    }
	
    /**
     * Validating user api key
     * If the api key is there in db, it is a valid key
     * @param String $api_key user api key String $uname user email ID
     * @return $login_result
	 * 1 => Success login
	 * 2 => Session Timed Out
	 * 3 => Failed Login
     */
    public function isValidApiKey($api_key, $uname) {
        $stmt = $this->conn->prepare("SELECT login_at from login_details WHERE song_session = ? AND email = ?");
        $stmt->bind_param("ss", $api_key,$uname);
        $stmt->execute();
		$stmt->store_result();
        $num_rows = $stmt->num_rows;
		if ($num_rows >= 1) {
			$stmt->bind_result($created_at);
		    while ($stmt->fetch()) {
		           $logi = $created_at;
			   }	   
			$t1 = strtotime($logi);
			$currentDate = date("Y-m-d");
			$currentTime = date("H:i:s");
			$t2 = strtotime($currentDate . $currentTime);
			$t3 = $t2 - $t1;
			$t3 = $t3/60;
			//return $t3;
		//	if (($t3) < 60) {
		//		$stmt->close();
				return 1;
		//	} else {
        //		$stmt->close();
		//		return 2;
		//	} 
			
		} else {
			$stmt->close();
			return 3;
		} 
		// return $num_rows;
        //return $num_rows > 0;
    }
 
    /**
     * Generating random Unique MD5 String for user Api key
     */
    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }
 
 
    /* ------------- `cart` table method ------------------ */
 
    /**
     * Inserting into Cart
     * @param String $user_id user id to whom task belongs to
     * @param String $task task text
     */
    public function insertToCart($user_id, $song_id, $album_id) {   
		 
		$user_id = $user_id;
		$song_id = $song_id;
		$album_id = $album_id;
		//Check if Song belongs to album
        $result = $this->conn->prepare("Select * from songs s where s.song_id = ? AND s.album_id =?");
      	$result->bind_param("ii", $song_id, $album_id);
       	$result ->execute();
		$result->store_result();
		$num_of_row =  $result->num_rows;
        $result->close();
		
		
		if ($num_of_row > 0) {
        $result = $this->conn->prepare("Select * from cart c where c.cart_song_id = ? AND c.user_id =?");
      	$result->bind_param("ii", $song_id, $user_id);
       	$result ->execute();
		$result->store_result();
		$num_of_row =  $result->num_rows;
        $result->close();
		//return $num_of_row;
	  


		if ($num_of_row > 0) {
						return 3;
					} else{
				        $stmt = $this->conn->prepare("INSERT INTO cart(cart_song_id,album_id,user_id) VALUES (?,?,?)");
				        $stmt->bind_param("iii", $song_id,$album_id,$user_id);
				        $result = $stmt->execute();
				        $stmt->close();
						if ($result) {
							return 1;
						} else{
							return 2;
						}
			
	}   
	} else {
		return 4;
	
		}	   
	
       
    }
	
	
	/*
	*   Remove from Cart
	*   Removes Item From the cart
	*/
 
    public function removeItemFromCart($cart_id) {   
		 
	
		$cart_id = $cart_id;
		//Check if Song belongs to album
 
				        $stmt = $this->conn->prepare("Delete from cart where cart_id = ?");
				        $stmt->bind_param("i",$cart_id);
				        $result = $stmt->execute();
				        $stmt->close();
						if ($result) {
							return 1;
						} else {
							return 2;
						}
		
       
    }
	
	/*
	*   Remove from Cart
	*   Removes Item From the cart
	*/
 
    public function getSumUnpaid($user_id) {   
		 
		$user_id = $user_id;
	
				        $stmt = $this->conn->prepare("Select SUM(s.price) from songs s, cart c where c.user_id = ? AND c.is_paid = 0 AND c.cart_song_id=s.song_id");
				        $stmt->bind_param("i", $user_id);
				        $stmt->execute();
						$stmt->bind_result($sum);
						$stmt->fetch();
						
				        $stmt->close();
						return $sum;
			
       
    }
 
    /* ------------- `tasks` table method ------------------ */
 
    /**
     * Creating new task
     * @param String $user_id user id to whom task belongs to
     * @param String $task task text
     */
    public function createTask($user_id, $task) {        
        $stmt = $this->conn->prepare("INSERT INTO tasks(task) VALUES(?)");
        $stmt->bind_param("s", $task);
        $result = $stmt->execute();
        $stmt->close();
 
        if ($result) {
            // task row created
            // now assign the task to user
            $new_task_id = $this->conn->insert_id;
            $res = $this->createUserTask($user_id, $new_task_id);
            if ($res) {
                // task created successfully
                return $new_task_id;
            } else {
                // task failed to create
                return NULL;
            }
        } else {
            // task failed to create
            return NULL;
        }
    }
 
    /**
     * Fetching single task
     * @param String $task_id id of the task
     */
    public function getTask($task_id, $user_id) {
        $stmt = $this->conn->prepare("SELECT t.id, t.task, t.status, t.created_at from tasks t, user_tasks ut WHERE t.id = ? AND ut.task_id = t.id AND ut.user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        if ($stmt->execute()) {
            $task = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $task;
        } else {
            return NULL;
        }
    }
 
    /**
     * Fetching all song from album_id
     * @param String $task_id id of the album
     */
    public function getAlbum($task_id) {
       $stmt = $this->conn->prepare("SELECT s.*,a.* from songs s, albums a WHERE s.album_id = ? AND a.id=s.album_id");
       $stmt->bind_param("i", $task_id);
        if ($stmt->execute()) {
            $task = $stmt->get_result();
            $stmt->close();
		   return $task;
        } else {
            return NULL;
        }
    }
 
    /**
     * Fetching all user tasks
     * @param String $user_id id of the user
     */
    public function getAllAlbums() {
        $stmt = $this->conn->prepare("SELECT a.* FROM albums a");
       // $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }
	
    /**
     * Fetching all user tasks
     * @param String $user_id id of the user
     */
    public function getAllTracks() {
        $stmt = $this->conn->prepare("SELECT a.*, s.* FROM albums a, songs s WHERE s.album_id=a.id");
       // $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }
	
    /**
     * Fetching all user cart
     * @param String $user_id id of the user
     */
    public function getCartofUser($user_id) {
        $stmt = $this->conn->prepare("SELECT c.*,a.*,s.* FROM cart c, albums a, songs s where c.is_paid = 0 AND c.user_id=? AND a.id=c.album_id AND c.cart_song_id=s.song_id");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
		return $tasks;
        //return $user_id;
    }
	
	
    /**
     * Fetching all user Purchased Song
     * @param String $user_id id of the user
     */
    public function getPurchasedSongs($user_id) {
        $stmt = $this->conn->prepare("SELECT c.*,a.*,s.* FROM cart c, albums a, songs s where c.is_paid = 1 AND c.user_id=? AND a.id=c.album_id AND c.cart_song_id=s.song_id");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
		return $tasks;
        //return $user_id;
    }
	    /**
	     * Fetching all user tasks
	     * @param String $user_id id of the user
	     */
	    public function getAllAlbumsbyLang($lang) {
	        $stmt = $this->conn->prepare("SELECT a.* FROM albums a where a.language = ?");
	        $stmt->bind_param("s", $lang);
	        $stmt->execute();
	        $tasks = $stmt->get_result();
	        $stmt->close();
	        return $tasks;
	    }
		
		
		
	    public function getAllAlbumsbyLangswitch($lang,$switch) {
			if ($switch != "all") {
				$switch = $switch."%";
			} else {
				$switch = "%";
			}
			
	        $stmt = $this->conn->prepare("SELECT a.* FROM albums a where a.language = ? AND a.album_name like ?");
	        $stmt->bind_param("ss", $lang,$switch);
	        $stmt->execute();
	        $tasks = $stmt->get_result();
	        $stmt->close();
	        return $tasks;
	    }
		
	    public function searchAlbums($switch) {
			if ($switch != "all") {
				$switch = "%".$switch."%";
			} else {
				$switch = "%";
			}
			
	        $stmt = $this->conn->prepare("SELECT a.* FROM albums a where a.album_name like ? OR a.music_director like ?");
	        $stmt->bind_param("ss",$switch,$switch);
	        $stmt->execute();
	        $tasks = $stmt->get_result();
	        $stmt->close();
	        return $tasks;
	    }
		
	    public function searchSong($switch) {
			if ($switch != "all") {
				$switch = "%".$switch."%";
			} else {
				$switch = "%";
			}
			
	        $stmt = $this->conn->prepare("SELECT s.*, a.* FROM albums a, songs s where s.song_name like ? OR s.artist_details like ? AND s.album_id=a.id");
	        $stmt->bind_param("ss",$switch,$switch);
	        $stmt->execute();
	        $tasks = $stmt->get_result();
	        $stmt->close();
	        return $tasks;
	    }
		
    /**
     * Fetching all user tasks
     * @param String $user_id id of the user
     */
    public function getAllUserTasks($user_id) {
        $stmt = $this->conn->prepare("SELECT a.* FROM albums a");
       // $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }
	
	public function getSongsForInvoice($user_id) {
        $stmt = $this->conn->prepare("SELECT s.song_name, s.main_song_wmv, s.price, s.main_song_mp3 FROM songs s, cart c where c.is_paid = 0 AND c.user_id = ? AND c.cart_song_id=s.song_id");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
	}
    /**
     * Fetching all user tasks
     * @param String $user_id id of the user
     */
    public function getAllSlider() {
        $stmt = $this->conn->prepare("SELECT a.* FROM main_slider a where a.show_hide = 1");
       // $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }
 
    /**
     * Updating task
     * @param String $task_id id of the task
     * @param String $task task text
     * @param String $status task status
     */
    public function updateTask($user_id, $task_id, $task, $status) {
        $stmt = $this->conn->prepare("UPDATE tasks t, user_tasks ut set t.task = ?, t.status = ? WHERE t.id = ? AND t.id = ut.task_id AND ut.user_id = ?");
        $stmt->bind_param("siii", $task, $status, $task_id, $user_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows > 0;
    }
 public function orderTableSuccessUpdate($user_id, $orderId) {
	// $user = $user_id;
     $stmt = $this->conn->prepare("UPDATE cart c set c.is_paid = 1, c.cart_order_id = ? WHERE c.user_id = ?");
     $stmt->bind_param("si", $orderId, $user_id);
	
     $stmt->execute();
     $num_affected_rows = $stmt->affected_rows;
     $stmt->close();
	 return $orderId.$user_id;
     //return $num_affected_rows > 0;
	
 }
    /**
     * Deleting a task
     * @param String $task_id id of the task to delete
     */
    public function deleteTask($user_id, $task_id) {
        $stmt = $this->conn->prepare("DELETE t FROM tasks t, user_tasks ut WHERE t.id = ? AND ut.task_id = t.id AND ut.user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows > 0;
    }
 
    /* ------------- `user_tasks` table method ------------------ */
 
    /**
     * Function to assign a task to user
     * @param String $user_id id of the user
     * @param String $task_id id of the task
     */
    public function createUserTask($user_id, $task_id) {
        $stmt = $this->conn->prepare("INSERT INTO user_tasks(user_id, task_id) values(?, ?)");
        $stmt->bind_param("ii", $user_id, $task_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
	
	public function endsWith($haystack, $needle) {
	    // search forward starting from end minus needle length characters
	    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
 
}
 
?>