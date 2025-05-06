<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");

    if(isset($_POST['btnPriceSize'])){
        try {
            $perfume = $_POST['idPerfume'];
            $size = $_POST['idSize'];
            $price = $_POST['price'];
            // echo $perfume . "<br/>";
            // echo $size . "<br/>";
            // echo $price . "<br/>";
            $err = 0;
            if($price == ""){
                $err++;
            }
            if($err == 0){
                $insertPrice = insert_with_price_and_size($perfume, $size, $price);
                if($insertPrice){
                    // echo "uspesno";
                    http_response_code(200);
                    $result = ['msg' => "You've successfully added a price. "];
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
        header("../page404.php");
    }

?>