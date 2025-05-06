<?php 
    //  header("Content-type: application/json");
     include("../config/connection.php");
     include("functions.php");

    if(isset($_POST['btnInsert'])){
        try{
            $namePerfume = $_POST['namePerfumeInsert'];
            $photoPerfume = $_POST['photoInsert'];
            $descriptionPerfume = $_POST['descriptionInsert'];
            $brandPerfume = $_POST['brandInsert'];
            $categoryPerfume = $_POST['categoryInsert'];
            // echo $namePerfume . "<br/>";
            // echo $photoPerfume . "<br/>";
            // echo $descriptionPerfume . "<br/>";
            // echo $brandPerfume . "<br/>";
            // echo $categoryPerfume . "<br/>";
            $err = 0;
            $highlighted = 0;
            if($namePerfume == ''){
                $err++;
            }
            if($descriptionPerfume == ''){
                $err++;
            }
            if($brandPerfume == 0){
                $err++;
            }
            if($categoryPerfume == 0){
                $err++;
            }
            if($photoPerfume == ''){
                $err++;
            }
            if($err == 0){
                $insertNewPerfume = insert_perfume($namePerfume, $photoPerfume, $descriptionPerfume, $brandPerfume, $categoryPerfume, $highlighted);
                if($insertNewPerfume){
                    // echo "odradjen upit";
                    http_response_code(200);
                    $result = ['msg' => "<p class='infoInsert'>You've successfully added a new perfume.</p> "];
                    echo json_encode($result);
                }
            }

        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            http_response_code(500);
        }
    }
    else {
        header("Location: ../page404.php");
    }

?>