<?php 
     session_start();
     header("Content-type: application/json");
     include("../config/connection.php");
     include("functions.php");
     if(!isset($_POST['btnRegistered'])){
        //$responseCode = 404;
        header("Location:../page404.php");
        //$result = ['msg' => "Page Not Found."];
        // echo json_encode($result);
        //http_response_code(404);
     }
     elseif(isset($_POST['btnRegistered'])){
         try {
            
            $userFirstName = $_POST['firstNameUser'];
            $userLastName = $_POST['lastNameUser'];
            $userEmail = $_POST['emailUser'];
            $userPassword = $_POST['passwordUser'];
            $encryptedPassword = md5($userPassword);
            // echo $userFirstName . "<br/>";
            // echo $userLastName . "<br/>";
            // echo $userEmail . "<br/>";
            // echo $encryptedPassword . "<br/>";
    
            
            // echo $encryptedPassword;
            // TEST REGEX
            $regexUserFirstName = "/^[A-Z][a-z]{2,15}$/";
            $regexUserLastName = "/^([A-Z][a-z]{2,14})\s?([A-Z][a-z]{2,19})?$/";
            $regexUserEmail = "/^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/";
            $regexUserPassword = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/";

            $errors = 0;

            // check first name
            if(!preg_match($regexUserFirstName, $userFirstName)){
                $errors++;
            }
            // check last name
            if(!preg_match($regexUserLastName, $userLastName)){
                $errors++;
            }
            // check email
            if(!preg_match($regexUserEmail, $userEmail)){
                $errors++;
            }
            
            
            // check password
            if(!preg_match($regexUserPassword, $userPassword)){
                $errors++;
            }

            // errors
            if($errors == 0){
                // hardkodovana vrednost (2 => User)
                $newUser = insert_user($userFirstName, $userLastName, $userEmail, $encryptedPassword, 2); // !! encrypted pass
                //var_dump($newUser);
                if($newUser){
                    $responseCode = 201;
                    // $result = ['msg' => "You've successfully registered!"];
                    echo json_encode(['msg' => "You've successfully registered!"]);
                    http_response_code($responseCode);
                    //header("Location: login.php");
                    //exit;
                }
            }
            else {
                $responseCode = 422;
                $result = ['msg' => "Error while processing data. "];
                echo json_encode($result);
                http_response_code($responseCode);
                exit;
            }
         } /* kraj try bloka */
         catch(PDOException $exception){
            $responseCode = 500;
            $result = ['msg' => "An error occurred while entering data into the database."];
            echo json_encode($result);
            http_response_code($responseCode);
            echo $exception->getMessage();
            exit;
         }   
     }

     
     
?>