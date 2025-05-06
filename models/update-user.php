<?php 
    session_start();
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['btnEditUser'])){
        $id = $_POST['userId'];
        $first_name = $_POST['userFirstName'];
        $last_name = $_POST['userLastName'];
        $password = $_POST['userPassword'];
        $email = $_POST['userEmail'];
        // echo $id . "<br/>";
        // echo $first_name . "<br/>";
        // echo $last_name . "<br/>";
        // echo $email . "<br/>";
        // echo $password . "<br/>";
        $reFirstNameU = '/^[A-Z][a-z]{2,15}$/';
        $reLastNameU = '/^([A-Z][a-z]{2,14})\s?([A-Z][a-z]{2,19})?$/';
        $reEmailU = '/^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/'; 
        $rePasswordU = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/';
        $err = 0;
        if(!preg_match($reFirstNameU, $first_name)){
            $err++;
        }

        if(!preg_match($reLastNameU, $last_name)){
            $err++;
        }

        if(!preg_match($reEmailU, $email)){
            $err++;
        }
        
        if($password != ""){
            // ako korisnik upise password, radimo proveru za regularne
            if(!preg_match($rePasswordU, $password)){
                $err++;
            }
        }

        if($err == 0){
            $encryptedPass = '';
            $update = "";
            if($password != ""){
                // ako korisnik upise password, ponovo kriptujemo password
                $encryptedPass = md5($password);
                $update = update_user($first_name, $last_name, $email, $encryptedPass, $id);
            }
            else {
                $update = update_user($first_name, $last_name, $email, $password, $id);
            }
            // echo $update;
            if($update){
                    // echo $update;
                    $result = ['msg' => "You've successfully updated your data."];
                    echo json_encode($result);
            }
        }
    }
?>