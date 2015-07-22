<?php

require_once '../include/DbHandler.php';
require_once '../include/PassHash.php';
require '.././labs/Slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    // Verifying Authorization Header
    if (isset($headers['sng_auth']) && isset($headers['sng_uname'])) {
        $db = new DbHandler();

        // get the api key
        $api_key = $headers['sng_auth'];
		//get the user name
		$uname = $headers['sng_uname'];
        // validating api key
		$login_check = $db->isValidApiKey($api_key, $uname);
        //Start of response checking 
		/**$response["error"] = true;
        $response["message"] =  $login_check;
        echoRespnse(401, $response);
		$app->stop();*/
		//end of response checking
		//start the result checking
	    if ($login_check == 2) {
            // api key is not present in users table
            $response["error"] = true;
            $response["message"] = "Session Timed Out";
            echoRespnse(401, $response);
            $app->stop();
        } elseif ($login_check == 3) {
            $response["error"] = true;
            $response["message"] = "Authorisation Error";
            echoRespnse(401, $response);
            $app->stop();
        
		} else {
            global $user_id;
            // get user primary key id
            $user_id = $db->getUserId($api_key);
        } 
		//end of result validation
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Api key is misssing";
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * ----------- METHODS WITHOUT AUTHENTICATION ---------------------------------
 */
/**
 * User Registration
 * url - /register
 * method - POST
 * params - name, email, password
 */
$app->post('/register', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('name', 'email', 'password'));

            $response = array();

            // reading post params
            $name = $app->request->post('name');
            $email = $app->request->post('email');
            $password = $app->request->post('password');
			$verification_code = md5($email.$password."dskjnfsdlknf123sdlkfm");
			$status = 0;

            // validating email address
            validateEmail($email);

            $db = new DbHandler();
            $res = $db->createUser($name, $email, $password, $verification_code, $status);

            if ($res == USER_CREATED_SUCCESSFULLY) {
                $response["error"] = false;
                $response["message"] = "You are successfully registered";
				$response["url1"] = "http://localhost/adhandapani/16raagas/16raagas/register.php?email=".$email."&auth_code=".$verification_code;
			
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'To: arvind.mib@gmail.com' . "\r\n";
				$headers .= 'From: 16raagas <support@16raagas.com>' . "\r\n";
				$message = '
				<html>
				<head>
				  <title>16raagas.com Registration link</title>
				</head>
				<body>
				 <h1> <p>16raagas.com</p> </h1>
				 <p>
				 Thank you for registring with 16raaga.com. Please click the below link to activate your account.<br>
				 http://localhost/adhandapani/16raagas/16raagas/register.php?email='.$email.'&auth_code='.$verification_code.'
				</body>
				</html>
				';
				$to="arvind.mib@gmail.com";
				$subject="16raagas.com registration Confirmation";
				mail($to, $subject, $message, $headers);
				
            } else if ($res == USER_CREATE_FAILED) {
                $response["error"] = true;
                $response["message"] = "Sorry, Could not process your request. Internal server Error";
            } else if ($res == USER_ALREADY_EXISTED) {
                $response["error"] = true;
                $response["message"] = "Sorry, this email already exists";
            }
            // echo json response
            echoRespnse(200, $response);
        });

/**
* User Registration Verification
* url - /authorise
* method - POST
* params - email, auth_code
*/
		$app->post('/authorise', function() use ($app) {
		            // check for required params
		            verifyRequiredParams(array('email', 'auth_code'));

		            $response = array();

		            // reading post params
		           
		            $email = $app->request->post('email');
		            $auth_code = $app->request->post('auth_code');
					
					$status = 1;

		            // validating email address
		            validateEmail($email);

		            $db = new DbHandler();
		            $res = $db->authVerify($email, $auth_code);

		            if ($res == 1) {
		         	   $response["error"] = false;
					   $response["message"] = "Your Email is Successfully registered. Please login to Continue.";
				
		            } elseif ($res == 3) {
		                $response["error"] = true;
		                $response["message"] = "Sorry, Could not process your request. Auth Code/emailID is Invalid";
		            } elseif ($res == 2) {
		                $response["error"] = true;
		                $response["message"] = "User is already Registered and Verified";
		            } 
		            // echo json response
		            echoRespnse(200, $response);
		        });


/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
$app->post('/login', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('email', 'password'));

            // reading post params
            $email = $app->request()->post('email');
            $password = $app->request()->post('password');
            $response = array();

            $db = new DbHandler();
            // check for correct email and password
            if ($db->checkLogin($email, $password)) {
                // get the user by email
                $user = $db->getUserByEmail($email);
				
				//update the created at 
				$update_login = $db->updateLoginByEmail($email);
                //$response['error'] = true;
                //$response['message'] = "update_login". $update_login;

                if ($user != NULL && $update_login!= NULL) {
                    $response["error"] = false;
                    $response['name'] = $user['name'];
                    $response['email'] = $user['email'];
                    $response['session_id_raagas'] = $update_login['song_session'];
                    $response['createdAt'] = $user['created_at'];
                } else {
                    // unknown error occurred
                    $response['error'] = true;
                    $response['message'] = "Error Occured su";
                } 
            } else {
                // user credentials are wrong
                $response['error'] = true;
                $response['message'] = 'Login failed. Incorrect credentials';
            }

            echoRespnse(200, $response);
        });

/**
* Listing all albums 
* method GET
* url /albums
* returns id, album_year, album_img, album_desc, music_director         
*/
$app->get('/albums', function() {
		            global $user_id;
		            $response = array();
		            $db = new DbHandler();

		            // fetching all user tasks
		            $result = $db->getAllAlbums();

		            $response["error"] = false;
		            $response["tasks"] = array();

		            // looping through result and preparing tasks array
		            while ($task = $result->fetch_assoc()) {
		                $tmp = array();
		                $tmp["id"] = $task["id"];
						$tmp["album_name"] = $task["album_name"];
		                $tmp["album_year"] = $task["album_year"];
		                $tmp["album_img"] = $task["album_img"];
						$tmp["music_director"] = $task["music_director"];
		                $tmp["album_desc"] = $task["album_desc"];
						
		                array_push($response["tasks"], $tmp);
		            }

		            echoRespnse(200, $response);
		        });


/**
* Listing all albums by name
* method GET
* url /albumsLanguage
* returns id, album_year, album_img, album_desc, music_director         
*/
				
				$app->get('/albumsLanguage/:lang', function($lang) {
					global $user_id;
					$response = array();
					$db = new DbHandler();
					
					$result = $db->getAllAlbumsbyLang($lang);
				    $response["error"] = false;
				    $response["tasks"] = array();

					if ($result != NULL) {
				        // looping through result and preparing tasks array
				        while ($task = $result->fetch_assoc()) {
		   				 $tmp = array();
		   				 $tmp["id"] = $task["id"];
						 $tmp["album_name"] = $task["album_name"];
		   				 $tmp["album_year"] = $task["album_year"];
		   				 $tmp["album_img"] = $task["album_img"];
		   				 $tmp["music_director"] = $task["music_director"];
		   				 $tmp["album_desc"] = $task["album_desc"];
		   			     array_push($response["tasks"], $tmp);
				        }
						echoRespnse(200, $response);
					} else {
						$response["error"] = true;
						$response["message"] = $lang;
						echoRespnse(404, $response);
					}
				});



				/**
				* Listing all albums by name
				* method GET
				* url /albumsLanguage
				* returns id, album_year, album_img, album_desc, music_director         
				*/
				
								$app->get('/albumsLanguageSwitch/:lang/:switch', function($lang,$switch) {
									global $user_id;
									$response = array();
									$db = new DbHandler();
					
									$result = $db->getAllAlbumsbyLangswitch($lang,$switch);
								    $response["error"] = false;
								    $response["tasks"] = array();

									if ($result != NULL) {
								        // looping through result and preparing tasks array
								        while ($task = $result->fetch_assoc()) {
						   				 $tmp = array();
						   				 $tmp["id"] = $task["id"];
										 $tmp["album_name"] = $task["album_name"];
						   				 $tmp["album_year"] = $task["album_year"];
						   				 $tmp["album_img"] = $task["album_img"];
						   				 $tmp["music_director"] = $task["music_director"];
						   				 $tmp["album_desc"] = $task["album_desc"];
						   			     array_push($response["tasks"], $tmp);
								        }
										echoRespnse(200, $response);
									} else {
										$response["error"] = true;
										$response["message"] = $lang;
										echoRespnse(404, $response);
									}
								});


/**
* Listing all albums 
* method GET
* url /albums
* returns id, album_year, album_img, album_desc, music_director         
*/
    $app->get('/slider', function() {
        global $user_id;
        $response = array();
        $db = new DbHandler();
        // fetching all user tasks
        $result = $db->getAllSlider();

        $response["error"] = false;
        $response["slider1"] = array();

        // looping through result and preparing tasks array
        while ($slider1 = $result->fetch_assoc()) {
        $tmp = array();
        $tmp["image_name"] = $slider1["image_name"];
        array_push($response["slider1"], $tmp);
         }
        echoRespnse(200, $response);
 });


/**
* Listing single task of particual user
* method GET
* url /album/:id
* Will return 404 if the task doesn't belongs to user
*/
$app->get('/album/:id', function($task_id) {
	global $user_id;
	$response = array();
	$db = new DbHandler();
	$result = $db->getAlbum($task_id);
    $response["error"] = false;
    $response["tasks"] = array();

	if ($result != NULL) {
        // looping through result and preparing tasks array
        while ($task = $result->fetch_assoc()) {
            $tmp = array();
            $tmp["song_id"] = $task["song_id"];
            $tmp["album_id"] = $task["album_id"];
            $tmp["song_name"] = $task["song_name"];
			$tmp["price"] = $task["price"];
            $tmp["artist_details"] = $task["artist_details"];
			$tmp["album_name"] = $task["album_name"];
			$tmp["album_img"] = $task["album_img"];
			$tmp["album_desc"] = $task["album_desc"];
			$tmp["music_director"] = $task["music_director"];
			$tmp["language"] = $task["language"];
			$tmp["demo_song"] = $task["demo_song"];
			$tmp["main_song_duration"] = $task["main_song_duration"];
			$tmp["demo_song_duration"] = $task["demo_song_duration"];
				
			
			
            array_push($response["tasks"], $tmp);
        }
		echoRespnse(200, $response);
	} else {
		$response["error"] = true;
		$response["message"] = "The requested resource doesn't exists";
		echoRespnse(404, $response);
	}
});


/*
 * ------------------------ METHODS WITH AUTHENTICATION ------------------------
 */

/**
 * Listing all tasks of particual user
 * method GET
 * url /tasks          
 */
$app->get('/tasks', 'authenticate', function() {
            global $user_id;
            $response = array();
            $db = new DbHandler();

            // fetching all user tasks
            $result = $db->getAllUserTasks($user_id);

            $response["error"] = false;
            $response["tasks"] = array();

            // looping through result and preparing tasks array
            while ($task = $result->fetch_assoc()) {
                $tmp = array();
                $tmp["id"] = $task["id"];
                $tmp["task"] = $task["task"];
                $tmp["status"] = $task["status"];
                $tmp["createdAt"] = $task["created_at"];
                array_push($response["tasks"], $tmp);
            }

            echoRespnse(200, $response);
        });

/**
 * Listing single task of particual user
 * method GET
 * url /tasks/:id
 * Will return 404 if the task doesn't belongs to user
 */
$app->get('/tasks/:id', 'authenticate', function($task_id) {
            global $user_id;
            $response = array();
            $db = new DbHandler();

            // fetch task
            $result = $db->getTask($task_id, $user_id);

            if ($result != NULL) {
                $response["error"] = false;
                $response["id"] = $result["id"];
                $response["task"] = $result["task"];
                $response["status"] = $result["status"];
                $response["createdAt"] = $result["created_at"];
                echoRespnse(200, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });

/**
 * Creating new task in db
 * method POST
 * params - name
 * url - /tasks/
 */
$app->post('/tasks', 'authenticate', function() use ($app) {
            // check for required params
            verifyRequiredParams(array('task'));

            $response = array();
            $task = $app->request->post('task');

            global $user_id;
            $db = new DbHandler();

            // creating new task
            $task_id = $db->createTask($user_id, $task);

            if ($task_id != NULL) {
                $response["error"] = false;
                $response["message"] = "Task created successfully";
                $response["task_id"] = $task_id;
                echoRespnse(201, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "Failed to create task. Please try again";
                echoRespnse(200, $response);
            }            
        });

/**
 * Updating existing task
 * method PUT
 * params task, status
 * url - /tasks/:id
 */
$app->put('/tasks/:id', 'authenticate', function($task_id) use($app) {
            // check for required params
            verifyRequiredParams(array('task', 'status'));

            global $user_id;            
            $task = $app->request->put('task');
            $status = $app->request->put('status');

            $db = new DbHandler();
            $response = array();

            // updating task
            $result = $db->updateTask($user_id, $task_id, $task, $status);
            if ($result) {
                // task updated successfully
                $response["error"] = false;
                $response["message"] = "Task updated successfully";
            } else {
                // task failed to update
                $response["error"] = true;
                $response["message"] = "Task failed to update. Please try again!";
            }
            echoRespnse(200, $response);
        });

/**
 * Deleting task. Users can delete only their tasks
 * method DELETE
 * url /tasks
 */
$app->delete('/tasks/:id', 'authenticate', function($task_id) use($app) {
            global $user_id;

            $db = new DbHandler();
            $response = array();
            $result = $db->deleteTask($user_id, $task_id);
            if ($result) {
                // task deleted successfully
                $response["error"] = false;
                $response["message"] = "Task deleted succesfully";
            } else {
                // task failed to delete
                $response["error"] = true;
                $response["message"] = "Task failed to delete. Please try again!";
            }
            echoRespnse(200, $response);
        });

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}




 /* Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();
?>