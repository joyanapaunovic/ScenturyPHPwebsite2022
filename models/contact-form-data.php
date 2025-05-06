<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['btnSend'])){
      try {
            $first_name = $_POST['firstName'];
            //echo $first_name . ",<br/>";
            $last_name = $_POST['lastName'];
            //echo $last_name . ",<br/>";
            $email = $_POST['email'];
            //echo $email . ",<br/>";
            $message = $_POST['messageContent'];
            //echo $message . "<br/>";
            $errors = 0;
            // REGEX
            $reFirstName = "/^[A-Z][a-z]{2,15}$/";
            $reLastName = "/^([A-Z][a-z]{2,14})\s?([A-Z][a-z]{2,19})?$/";
            $reEmail = "/^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/";

            // TEST REGEX
            if(!preg_match($reFirstName, $first_name)){
                $errors++;
            }
            if(!preg_match($reLastName, $last_name)){
                $errors++;
            }
            if(!preg_match($reEmail, $email)){
                $errors++;
            }
            if($message == ''){
                $errors++;
            }
            if($errors == 0){
                $inserted = insert_contact($first_name, $last_name, $email, $message);
                if($inserted){
                    $result = ['msg' => "Your message has been successfully sent."];
                    $code = 201;
                }
            }
            else {
                $result = ['msg' => "Error while processing data. "];
                $code = 422;
            }
        }
      catch(PDOException $exception){
            $result = ['msg' => "An error occurred while entering data into the database."];
            $code = 500;
            echo $exception->getMessage();
      }
    }
    else {
            header("Location:../page404.php");
    }
  

    echo json_encode($result);
    http_response_code($code);
?>