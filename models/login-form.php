<?php 
    session_start();
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jsonData = $_POST['data'];
        if($jsonData){
            $decodedData = json_decode($jsonData, true);
            $encoded = json_encode($decodedData);
            if(!isset($decodedData['btnSignIn'])){
                header("Location: ../page404.php");
                http_response_code(404);
            }
            elseif(isset($decodedData['btnSignIn'])){
                try {
                    $email = $decodedData['emailLogged'];
                    $password = $decodedData['passwordLogged'];
                    $encryptedPassword = md5($password);
                    $errors = 0;
                    // prevent SQL injection
                    // $email = $conn->real_escape_string($email);
                    // $password = $conn->real_escape_string($password);
                    // regex 
                    $regexEmail = "/^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/";
                    $regexPassword = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/";
        
                    // check email
                     if(!preg_match($regexEmail, $email)){
                        $errors++;
                    }
                    // check password
                    if(!preg_match($regexPassword, $password)){
                        $errors++;
                    }
                    if($errors == 0){
                        
                        $userObj = check_login($email, $encryptedPassword); // if exists => TRUE
                        // var_dump($resultLogin);
                        if($userObj){
                            $_SESSION['user'] = $userObj; // ceo objekat
                            //var_dump($_SESSION['user']);
                            $_SESSION['id_role'] = $userObj->id_role;
                            $response = ['msg' => "You've successfully logged in."];
                            echo json_encode($response);
                            if ($userObj->id_role === 1) {
                                header("Location: administrator-access.php");
                            } else {
                                header("Location: user-data.php");
                            }
                            http_response_code(200);
                            exit;
                        }
                        else {
                            $response = ['msg' => "Incorrect email address or password. Please try again."];
                            echo json_encode($response);
                            exit;
                        }
                    }
                }
                catch(PDOException $exception){
                    http_response_code(500);
                    echo $exception->getMessage();
                    exit;
                }
            }
        }
        
    }
 
    /*
       object(stdClass)#4 (7) {
            ["id_user"]=>
            int(1)
            ["first_name"]=>
            string(6) "Jovana"
            ["last_name"]=>
            string(8) "Paunovic"
            ["email"]=>
            string(15) "admin@gmail.com"
            ["password_user"]=>
            string(32) "df62b48c0305bdc4d1109175664c8690"
            ["id_role"]=>
            int(1)
            ["label"]=>
            string(5) "Admin"
            }
            {"msg":"You've successfully logged in."}
    */
    
?>