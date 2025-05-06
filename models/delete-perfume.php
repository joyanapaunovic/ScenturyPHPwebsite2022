<?php
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST["btnDelete"])){
        try {
            $id = $_POST['idPerfumeToDelete'];
            //echo $id;
            $deletePriceForThisPerfume = deleteData("perfume_milliliters", "id_perfume", $id);
            $basket = deleteData("basket_perfumes", "id_perfume", $id);
            $pictures = deleteData("picture", "id_perfume", $id);
            $delete = deleteData("perfume", "id_perfume", $id);
           
            if($delete){
                // echo "uspesno obrisano";
                http_response_code(200);
                $result = ['msg' => "You've successfully deleted this perfume. "];
                echo json_encode($result);
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            http_response_code(500);
        }

    }
    else {
        header("../page404.php");
    }
?>