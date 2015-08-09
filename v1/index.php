<?php
include '../include/psl-config.php';
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
function authenticate(\Slim\Route $route)
{
    // Getting request headers
    $headers  = apache_request_headers();
    $response = array();
    $app      = \Slim\Slim::getInstance();
    
    // Verifying Authorization Header
    if (isset($headers['X-Sngauth']) && isset($headers['X-Snguname'])) {
        $db = new DbHandler();
        
        // get the api key
        $api_key     = $headers['X-Sngauth'];
        //get the user name
        $uname       = $headers['X-Snguname'];
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
            $response["error"]   = true;
            $response["message"] = "Session Timed Out";
            echoRespnse(200, $response);
            $app->stop();
        } elseif ($login_check == 3) {
            $response["error"]   = apache_request_headers();
            $response["message"] = "Authorisation Error";
            echoRespnse(200, $response);
            $app->stop();
            
        } else {
            global $user_id;
            // get user primary key id
            $user_id = $db->getUserId($api_key);
            return $user_id;
        }
        //end of result validation
    } else {
        // api key is missing in header
        $response["error"]   = apache_request_headers();
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
$app->post('/register', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'name',
        'email',
        'password'
    ));
    
    $response = array();
    
    // reading post params
    $name              = $app->request->post('name');
    $email             = $app->request->post('email');
    $password          = $app->request->post('password');
    $verification_code = md5($email . $password . "dskjnfsdlknf123sdlkfm");
    $status            = 0;
    
    // validating email address
    validateEmail($email);
    
    $db  = new DbHandler();
    $res = $db->createUser($name, $email, $password, $verification_code, $status);
    
    if ($res == USER_CREATED_SUCCESSFULLY) {
        $response["error"]   = false;
        $response["message"] = "You are successfully registered";
        $response["url1"]    = "http://localhost/adhandapani/16raagas/16raagas/register.php?email=" . $email . "&auth_code=" . $verification_code;
        
        $headers = 'MIME-Version: 1.0' . "\r\n";
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
                 http://localhost/adhandapani/16raagas/16raagas/register.php?email=' . $email . '&auth_code=' . $verification_code . '
                </body>
                </html>
                ';
        $to      = "arvind.mib@gmail.com";
        $subject = "16raagas.com registration Confirmation";
        mail($to, $subject, $message, $headers);
        
    } else if ($res == USER_CREATE_FAILED) {
        $response["error"]   = true;
        $response["message"] = "Sorry, Could not process your request. Internal server Error";
    } else if ($res == USER_ALREADY_EXISTED) {
        $response["error"]   = true;
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
$app->post('/authorise', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'email',
        'auth_code'
    ));
    
    $response = array();
    
    // reading post params
    
    $email     = $app->request->post('email');
    $auth_code = $app->request->post('auth_code');
    
    $status = 1;
    
    // validating email address
    validateEmail($email);
    
    $db  = new DbHandler();
    $res = $db->authVerify($email, $auth_code);
    
    if ($res == 1) {
        $response["error"]   = false;
        $response["message"] = "Your Email is Successfully registered. Please login to Continue.";
        
    } elseif ($res == 3) {
        $response["error"]   = true;
        $response["message"] = "Sorry, Could not process your request. Auth Code/emailID is Invalid";
    } elseif ($res == 2) {
        $response["error"]   = true;
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
$app->post('/login', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'email',
        'password'
    ));
    
    // reading post params
    $email    = $app->request()->post('email');
    $password = $app->request()->post('password');
    $response = array();
    
    $db = new DbHandler();
    // check for correct email and password
    if ($db->checkLogin($email, $password)) {
        // get the user by email
        $db->updateLoginByEmail($email);
        $user        = $db->getUserByEmail($email);
        $usersession = $db->getSongSession($email);
        
        if ($user != NULL) {
            $response["error"]        = false;
            $response['name']         = $user['name'];
            $response['email']        = $user['email'];
            $response['apiKey']       = $user['api_key'];
            $response['createdAt']    = $user['created_at'];
            $response['song_session'] = $usersession['song_session'];
        } else {
            // unknown error occurred
            $response['error']   = true;
            $response['message'] = "An error occurred. Please try again";
        }
    } else {
        // user credentials are wrong
        $response['error']   = true;
        $response['message'] = 'Login failed. Incorrect credentials';
    }
    
    echoRespnse(200, $response);
});

/**
 * Listing all albums 
 * method GET
 * url /albums
 * returns id, album_name, album_year, album_img, album_desc, music_director        
 */
$app->get('/albums', function()
{
    global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    // fetching all user tasks
    $result = $db->getAllAlbums();
    
    $response["error"] = false;
    $response["tasks"] = array();
    
    // looping through result and preparing tasks array
    while ($task = $result->fetch_assoc()) {
        $tmp                   = array();
        $tmp["id"]             = $task["id"];
        $tmp["album_name"]     = $task["album_name"];
        $tmp["album_year"]     = $task["album_year"];
        $tmp["album_img"]      = $task["album_img"];
        $tmp["music_director"] = $task["music_director"];
        $tmp["album_desc"]     = $task["album_desc"];
        
        array_push($response["tasks"], $tmp);
    }
    
    echoRespnse(200, $response);
});
/**
 * Listing all Tracks with Album info also 
 * method GET
 * url /albums
 * returns id, album_name, album_year, album_img, album_desc, music_director        
 */
$app->get('/tracklist', function()
{
    global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    // fetching all user tasks
    $result = $db->getAllTracks();
    
    $response["error"] = false;
    $response["tasks"] = array();
    
    // looping through result and preparing tasks array
    while ($task = $result->fetch_assoc()) {
        $tmp                   = array();
        $tmp["id"]             = $task["id"];
        $tmp["album_name"]     = $task["album_name"];
        $tmp["album_year"]     = $task["album_year"];
        $tmp["album_img"]      = $task["album_img"];
        $tmp["music_director"] = $task["music_director"];
        $tmp["album_desc"]     = $task["album_desc"];
        $tmp["song_name"]      = $task["song_name"];
        $tmp["song_id"]        = $task["song_id"];
        $tmp["no_Downloads"]   = $task["no_Downloads"];
        
        array_push($response["tasks"], $tmp);
    }
    
    echoRespnse(200, $response);
});
/**
 * Checking for the correctness of the data 
 * method GET
 * url /checkCorrectAmount
 * returns 
 * if success = 1
 * if not success = 0       
 */
$app->get('/checkCorrectAmount/:amount/:email', function($amount, $email)
{
    global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    // FetchEmail Address
    $userIDbyEmail  = $db->getUserIdFromEmail($email);
    //Fetch Total unpaid amount in Cart
    $amountToBePaid = $db->getSumUnpaid($userIDbyEmail);
    
    if ($amountToBePaid == $amount) {
        $response["error"] = false;
        $response["tasks"] = 1;
        echoRespnse(200, $response);
    } else {
        $response["error"] = true;
        $response["tasks"] = 0;
        echoRespnse(1000, $response);
    }
});


/**
 * Listing all albums by Language
 * method GET
 * url /albumsLanguage
 * returns id, , album_name, album_year, album_img, album_desc, music_director         
 */

$app->get('/albumsLanguage/:lang', function($lang)
{
    global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    $result            = $db->getAllAlbumsbyLang($lang);
    $response["error"] = false;
    $response["tasks"] = array();
    
    if ($result != NULL) {
        // looping through result and preparing tasks array
        while ($task = $result->fetch_assoc()) {
            $tmp                   = array();
            $tmp["id"]             = $task["id"];
            $tmp["album_name"]     = $task["album_name"];
            $tmp["album_year"]     = $task["album_year"];
            $tmp["album_img"]      = $task["album_img"];
            $tmp["music_director"] = $task["music_director"];
            $tmp["album_desc"]     = $task["album_desc"];
            array_push($response["tasks"], $tmp);
        }
        echoRespnse(200, $response);
    } else {
        $response["error"]   = true;
        $response["message"] = $lang;
        echoRespnse(404, $response);
    }
});

/**
 * Listing all songs and albums by Search String
 * method GET
 * url /search
 * returns id, , album_name, album_year, album_img, album_desc, music_director         
 */

$app->get('/search/:search1', function($search1)
{
    
    $response = array();
    $db       = new DbHandler();
    
    $result            = $db->searchAlbums($search1);
    $response["error"] = false;
    $response["tasks"] = array();
    
    if ($result != NULL) {
        // looping through result and preparing tasks array
        while ($task = $result->fetch_assoc()) {
            $tmp                   = array();
            $tmp["id"]             = $task["id"];
            $tmp["album_name"]     = $task["album_name"];
            $tmp["album_year"]     = $task["album_year"];
            $tmp["album_img"]      = $task["album_img"];
            $tmp["music_director"] = $task["music_director"];
            $tmp["album_desc"]     = $task["album_desc"];
            array_push($response["tasks"], $tmp);
        }
        echoRespnse(200, $response);
    }
});

/**
 * Listing all songs and albums by Search String
 * method GET
 * url /search
 * returns id, , album_name, album_year, album_img, album_desc, music_director         
 */

$app->get('/searchSong/:search1', function($search1)
{
    
    $response = array();
    $db       = new DbHandler();
    
    $result            = $db->searchSong($search1);
    $response["error"] = false;
    $response["tasks"] = array();
    
    if ($result != NULL) {
        // looping through result and preparing tasks array
        while ($task = $result->fetch_assoc()) {
            $tmp                   = array();
            $tmp["id"]             = $task["id"];
            $tmp["song_name"]      = $task["song_name"];
            $tmp["artist_details"] = $task["artist_details"];
            $tmp["album_name"]     = $task["album_name"];
            $tmp["album_year"]     = $task["album_year"];
            $tmp["album_img"]      = $task["album_img"];
            $tmp["music_director"] = $task["music_director"];
            $tmp["album_desc"]     = $task["album_desc"];
            array_push($response["tasks"], $tmp);
        }
        echoRespnse(200, $response);
    }
});

/**
 * Filter List Abumns with Alphabets
 * method GET
 * url /albumsLanguageSwitch
 * returns id, album_year, album_img, album_desc, music_director         
 */

$app->get('/albumsLanguageSwitch/:lang/:switch', function($lang, $switch)
{
    global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    $result            = $db->getAllAlbumsbyLangswitch($lang, $switch);
    $response["error"] = false;
    $response["tasks"] = array();
    
    if ($result != NULL) {
        // looping through result and preparing tasks array
        while ($task = $result->fetch_assoc()) {
            $tmp                   = array();
            $tmp["id"]             = $task["id"];
            $tmp["album_name"]     = $task["album_name"];
            $tmp["album_year"]     = $task["album_year"];
            $tmp["album_img"]      = $task["album_img"];
            $tmp["music_director"] = $task["music_director"];
            $tmp["album_desc"]     = $task["album_desc"];
            array_push($response["tasks"], $tmp);
        }
        echoRespnse(200, $response);
    } else {
        $response["error"]   = true;
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
$app->get('/slider', function()
{
    global $user_id;
    $response = array();
    $db       = new DbHandler();
    // fetching all user tasks
    $result   = $db->getAllSlider();
    
    $response["error"]   = false;
    $response["slider1"] = array();
    
    // looping through result and preparing tasks array
    while ($slider1 = $result->fetch_assoc()) {
        $tmp               = array();
        $tmp["image_name"] = $slider1["image_name"];
        array_push($response["slider1"], $tmp);
    }
    echoRespnse(200, $response);
});


/**
 * Listing all songs in the Album
 * method GET
 * url /album/:id
 * Will return 404 if the task doesn't belongs to user
 * returns song_id, album_id, song_name, price, artist_details, album_name, album_img, album_desc, music_director, language, demo_song, demo_song_duration, main_song_duration
 */
$app->get('/album/:id', function($task_id)
{
    global $user_id;
    $response          = array();
    $db                = new DbHandler();
    $result            = $db->getAlbum($task_id);
    $response["error"] = false;
    $response["tasks"] = array();
    
    if ($result != NULL) {
        // looping through result and preparing tasks array
        while ($task = $result->fetch_assoc()) {
            $tmp                       = array();
            $tmp["song_id"]            = $task["song_id"];
            $tmp["album_id"]           = $task["album_id"];
            $tmp["song_name"]          = $task["song_name"];
            $tmp["price"]              = $task["price"];
            $tmp["artist_details"]     = $task["artist_details"];
            $tmp["album_name"]         = $task["album_name"];
            $tmp["album_img"]          = $task["album_img"];
            $tmp["album_desc"]         = $task["album_desc"];
            $tmp["music_director"]     = $task["music_director"];
            $tmp["language"]           = $task["language"];
            $tmp["demo_song"]          = $task["demo_song"];
            $tmp["main_song_duration"] = $task["main_song_duration"];
            $tmp["demo_song_duration"] = $task["demo_song_duration"];
            
            
            
            array_push($response["tasks"], $tmp);
        }
        echoRespnse(200, $response);
    } else {
        $response["error"]   = true;
        $response["message"] = "The requested resource doesn't exists";
        echoRespnse(404, $response);
    }
});


/*
 * ------------------------ METHODS WITH AUTHENTICATION ------------------------
 */

/**
 * Listing all products in the cart
 * method GET
 * url /cart          
 */
$app->post('/cart', 'authenticate', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'user_id'
    ));
    
    //   global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    $email_id = $app->request->post('user_id');
    $user_id  = $db->getUserIdFromEmail($email_id);
    
    $result = $db->getCartofUser($user_id);
    
    $response["error"] = false;
    $response["tasks"] = array();
    
    // looping through result and preparing tasks array
    while ($task = $result->fetch_assoc()) {
        
        $tmp = array();
        
        $tmp["cart_id"]      = $task["cart_id"];
        $tmp["cart_song_id"] = $task["cart_song_id"];
        $tmp["album_name"]   = $task["album_name"];
        $tmp["song_name"]    = $task["song_name"];
        $tmp["price"]        = $task["price"];
        $tmp["album_img"]    = $task["album_img"];
        
        array_push($response["tasks"], $tmp);
    }
    
    echoRespnse(200, $response);
});

/**
 * Listing all Purchased product for the user
 * method GET
 * url /cart          
 */
$app->post('/myOrder', 'authenticate', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'user_id'
    ));
    
    //global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    $email_id = $app->request->post('user_id');
    $user_id  = $db->getUserIdFromEmail($email_id);
    
    $result = $db->getPurchasedSongs($user_id);
    
    $response["error"] = false;
    $response["tasks"] = array();
    
    // looping through result and preparing tasks array
    while ($task = $result->fetch_assoc()) {
        
        $tmp = array();
        
        //$tmp["cart_id"] = $task["cart_id"];
        $tmp["cart_song_id"] = $task["cart_song_id"];
        $tmp["album_name"]   = $task["album_name"];
        $tmp["song_name"]    = $task["song_name"];
        //$tmp["price"] = $task["price"];
        $tmp["album_img"]    = $task["album_img"];
        $tmp["main_song"]    = $task["main_song_mp3"];
		$tmp["main_song_wmv"]    = $task["main_song_wmv"];
        $tmp["song_sub"]     = $user_id;
        
        
        array_push($response["tasks"], $tmp);
    }
    
    
    echoRespnse(200, $response);
});

/**
 * Remove Item From Cart
 * method POST
 * url /removeFromCart
 * Will return 404 if the task doesn't belongs to user
 */
$app->post('/removeFromCart', 'authenticate', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'song_id',
        'album_id'
    ));
    global $user_id;
    $db       = new DbHandler();
    $album_id = $app->request->post('album_id');
    $song_id  = $app->request->post('song_id');
    $user_id  = $db->getUserIdFromEmail($user_id);
    $task_id  = $db->removeItemFromCart($user_id, $song_id, $album_id);
    
    if ($task_id == 1) {
        $response["error"]   = false;
        $response["message"] = "Item Has been removed from Cart";
        //$response["task_id"] = $task_id;
        echoRespnse(201, $response);
    } elseif ($task_id == 2) {
        $response["error"]   = true;
        $response["message"] = "Item Not present in the cart";
        echoRespnse(200, $response);
    }
    
});



/**
 * Payment is success
 * method POST
 * url /paymentsuccess
 * Will return 201 if the task doesn't belongs to user
 */
$app->post('/paymentsuccess', 'authenticate', function() use ($app)
{
    // check for required params
    //verifyRequiredParams(array('ResponseCode','raagas_amount'));
    global $user_id;
    $email_id = $app->request->post('email');
    
    
    $db      = new DbHandler();
    $user_id = $db->getUserIdFromEmail($email_id);
    
    $ResponseCode = $app->request->post('ResponseCode');
    if (empty($ResponseCode)) {
        $ResponseCode = "test";
    }
    $Message = $app->request->post('Message');
    if (empty($Message)) {
        $Message = "test";
    }
    $TxnID = $app->request->post('TxnID');
    if (empty($TxnID)) {
        $TxnID = "test";
    }
    
    $ePGTxnID = $app->request->post('ePGTxnID');
    if (empty($ePGTxnID)) {
        $ePGTxnID = "test";
    }
    $AuthIdCode = $app->request->post('AuthIdCode');
    if (empty($AuthIdCode)) {
        $AuthIdCode = "test";
    }
    $RRN = $app->request->post('RRN');
    if (empty($RRN)) {
        $RRN = "test";
    }
    $CVRespCode = $app->request->post('CVRespCode');
    if (empty($CVRespCode)) {
        $CVRespCode = "test";
    }
    $session_name = $app->request->post('email');
    
    $raagas_amount = $app->request->post('raagas_amount');
    
    
    //first create an orderID
    $order_id = "ORD" . time();
    
    
    //insert the values to the order table 
    
    $orderReturn = $db->insertIntoOrderTable($user_id, $order_id, $ResponseCode, $Message, $TxnID, $ePGTxnID, $AuthIdCode, $RRN, $CVRespCode, $raagas_amount);
    
    
    if ($orderReturn == 1) {
        //get the List of songs for Invoice Preparation
        $invoice_detail = $db->getSongsForInvoice($user_id);
        
        
        // prepare the songs also
        //check if the user has a folder
        $song_name     = $song123["main_song_mp3"];
        $song_name_wmv = $song123["main_song_wmv"];
        if (file_exists(wmv_songs . $song_name_wmv)) {
            if (!file_exists('../user_songs/' . $user_id)) {
                
                mkdir('../user_songs/' . $user_id . '/wmv', 0777, true);
            }
            
            while ($song123 = $invoice_detail->fetch_assoc()) {
                $tmp = array();
                
                copy(wmv_songs . $song_name, '../user_songs/' . $user_id . '/wmv/' . $song_name);
                $file_add    = '../user_songs/' . $user_id . '/wmv/' . $song_name;
                // Open the file to get existing content
                $add_content = file_get_contents($file_add);
                $string1     = strtolower($order_id);
                $search      = array(
                    '1',
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7',
                    '8',
                    '9',
                    '0',
                    'a',
                    'b',
                    'c',
                    'd',
                    'e',
                    'f',
                    'g',
                    'h',
                    'i',
                    'j',
                    'k',
                    'l',
                    'm',
                    'n',
                    'o',
                    'p',
                    'q',
                    'r',
                    's',
                    't',
                    'u',
                    'v',
                    'w',
                    'x',
                    'y',
                    'z'
                );
                $replace     = array(
                    '!',
                    '@',
                    '#',
                    '$',
                    '%',
                    '^',
                    '&',
                    '*',
                    '(',
                    ')',
                    '`',
                    '~',
                    '-',
                    '_',
                    '=',
                    '+',
                    '{',
                    '}',
                    '[',
                    ']',
                    ';',
                    '|',
                    ':',
                    '"',
                    ',',
                    '.',
                    '<',
                    '>',
                    '/',
                    "'",
                    '?',
                    '1',
                    '2',
                    '3',
                    '4',
                    '5'
                );
                $string_new  = str_replace($search, $replace, $string1);
                // Append a new person to the file
                $add_content .= " ???><?;? " . $string_new . "\n";
                // Write the contents back to the file
                file_put_contents($file_add, $add_content);
                
            }
		}
        if (file_exists(mp3_Songs . $song_name)) {
            if (!file_exists('../user_songs/' . $user_id)) {
                
                mkdir('../user_songs/' . $user_id . '/mp3', 0777, true);
            }
            
            while ($song123 = $invoice_detail->fetch_assoc()) {
                $tmp = array();
                
                copy(mp3_Songs . $song_name, '../user_songs/' . $user_id . '/mp3/' . $song_name);
                $file_add    = '../user_songs/' . $user_id . '/mp3/' . $song_name;
                // Open the file to get existing content
                $add_content = file_get_contents($file_add);
                $string1     = strtolower($order_id);
                $search      = array(
                    '1',
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7',
                    '8',
                    '9',
                    '0',
                    'a',
                    'b',
                    'c',
                    'd',
                    'e',
                    'f',
                    'g',
                    'h',
                    'i',
                    'j',
                    'k',
                    'l',
                    'm',
                    'n',
                    'o',
                    'p',
                    'q',
                    'r',
                    's',
                    't',
                    'u',
                    'v',
                    'w',
                    'x',
                    'y',
                    'z'
                );
                $replace     = array(
                    '!',
                    '@',
                    '#',
                    '$',
                    '%',
                    '^',
                    '&',
                    '*',
                    '(',
                    ')',
                    '`',
                    '~',
                    '-',
                    '_',
                    '=',
                    '+',
                    '{',
                    '}',
                    '[',
                    ']',
                    ';',
                    '|',
                    ':',
                    '"',
                    ',',
                    '.',
                    '<',
                    '>',
                    '/',
                    "'",
                    '?',
                    '1',
                    '2',
                    '3',
                    '4',
                    '5'
                );
                $string_new  = str_replace($search, $replace, $string1);
                // Append a new person to the file
                $add_content .= " ???><?;? " . $string_new . "\n";
                // Write the contents back to the file
                file_put_contents($file_add, $add_content);
                
            }
        }
        
        
        // Now update the cart table to is_paid to 1 and Order Id for this Paid user
        
        $orderTableUpdate = $db->orderTableSuccessUpdate($user_id, $order_id);
        
        $response["error"]   = false;
        $response["message"] = $orderTableUpdate;
        //$response["task_id"] = $task_id;
        echoRespnse(200, $response);
        
        /*
        if ($orderTableUpdate > 0) {
        $response["error"] = false;
        $response["message"] = "Payment Success and Song Ready to Download";
        //$response["task_id"] = $task_id;
        echoRespnse(200, $response);
        } else {
        $response["error"] = true;
        $response["message"] = "Order Table update Failed";
        }*/
        
    }
    
    
    
});





/**
 * CheckOut
 * method POST
 * url /removeFromCart
 * Will return 404 if the task doesn't belongs to user
 */
$app->post('/checkout', 'authenticate', function() use ($app)
{
    global $user_id;
    $db                  = new DbHandler();
    $album_id            = $app->request->post('album_id');
    $song_id             = $app->request->post('song_id');
    $user_id             = $db->getUserIdFromEmail($user_id);
    //First get the Amount which is unpurchased from the cart table
    $amountToBeCredited  = $db->getSumUnpaid($user_id);
    $response["error"]   = false;
    $response["message"] = $amountToBeCredited;
    echoRespnse(201, $response);
    
    
});



/**
 * Add to Cart
 * method POST
 * url /tasks/:id
 * Will return 404 if the task doesn't belongs to user
 */
$app->post('/addToCart', 'authenticate', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'song_id',
        'album_id'
    ));
    global $user_id;
    $db       = new DbHandler();
    $album_id = $app->request->post('album_id');
    $song_id  = $app->request->post('song_id');
    $user_id  = $db->getUserIdFromEmail($user_id);
    $task_id  = $db->insertToCart($user_id, $song_id, $album_id);
    
    //$user_id = $app->request->post('user_id');
    $song_id  = $app->request->post('song_id');
    $album_id = $app->request->post('album_id');
    
    $task_id = $db->insertToCart($user_id, $song_id, $album_id);
    if ($task_id == 1) {
        $response["error"]   = false;
        $response["message"] = "Item Has been addded to the Cart";
        //$response["task_id"] = $task_id;
        echoRespnse(201, $response);
    } elseif ($task_id == 2) {
        $response["error"]   = true;
        $response["message"] = "Item not added to the cart. Please Try Again";
        echoRespnse(200, $response);
    } elseif ($task_id == 3) {
        $response["error"]   = true;
        $response["message"] = "Selected Item is already present in your cart.";
        //$response["message"] = "Selected Item is already present in your cart.";
        echoRespnse(200, $response);
        
    } else {
        $response["error"]   = true;
        $response["message"] = "Internal Server Error.";
        echoRespnse(200, $response);
    }
    
});

/**
 * Listing single task of particual user
 * method GET
 * url /tasks/:id
 * Will return 404 if the task doesn't belongs to user
 */
$app->get('/tasks/:id', 'authenticate', function($task_id)
{
    global $user_id;
    $response = array();
    $db       = new DbHandler();
    
    // fetch task
    $result = $db->getTask($task_id, $user_id);
    
    if ($result != NULL) {
        $response["error"]     = false;
        $response["id"]        = $result["id"];
        $response["task"]      = $result["task"];
        $response["status"]    = $result["status"];
        $response["createdAt"] = $result["created_at"];
        echoRespnse(200, $response);
    } else {
        $response["error"]   = true;
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
$app->post('/tasks', 'authenticate', function() use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'task'
    ));
    
    $response = array();
    $task     = $app->request->post('task');
    
    global $user_id;
    $db = new DbHandler();
    
    // creating new task
    $task_id = $db->createTask($user_id, $task);
    
    if ($task_id != NULL) {
        $response["error"]   = false;
        $response["message"] = "Task created successfully";
        $response["task_id"] = $task_id;
        echoRespnse(201, $response);
    } else {
        $response["error"]   = true;
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
$app->put('/tasks/:id', 'authenticate', function($task_id) use ($app)
{
    // check for required params
    verifyRequiredParams(array(
        'task',
        'status'
    ));
    
    global $user_id;
    $task   = $app->request->put('task');
    $status = $app->request->put('status');
    
    $db       = new DbHandler();
    $response = array();
    
    // updating task
    $result = $db->updateTask($user_id, $task_id, $task, $status);
    if ($result) {
        // task updated successfully
        $response["error"]   = false;
        $response["message"] = "Task updated successfully";
    } else {
        // task failed to update
        $response["error"]   = true;
        $response["message"] = "Task failed to update. Please try again!";
    }
    echoRespnse(200, $response);
});

/**
 * Deleting task. Users can delete only their tasks
 * method DELETE
 * url /tasks
 */
$app->delete('/tasks/:id', 'authenticate', function($task_id) use ($app)
{
    global $user_id;
    
    $db       = new DbHandler();
    $response = array();
    $result   = $db->deleteTask($user_id, $task_id);
    if ($result) {
        // task deleted successfully
        $response["error"]   = false;
        $response["message"] = "Task deleted succesfully";
    } else {
        // task failed to delete
        $response["error"]   = true;
        $response["message"] = "Task failed to delete. Please try again!";
    }
    echoRespnse(200, $response);
});

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields)
{
    $error          = false;
    $error_fields   = "";
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
        $response            = array();
        $app                 = \Slim\Slim::getInstance();
        $response["error"]   = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Validating email address
 */
function validateEmail($email)
{
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"]   = true;
        $response["message"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}




/* Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response)
{
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
    
    // setting response content type to json
    $app->contentType('application/json');
    
    echo json_encode($response);
}

$app->run();
?>