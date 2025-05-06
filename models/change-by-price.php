<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        try {
            if(isset($_POST['size'])){
                    $size = $_POST['size'];
                    $id = $_POST['idPerfumePrice'];
                    // echo $id . "<br/>";
                    // echo $size;
                
                // $getPrice = get_price($size, $id);
                $getPrice = get_price($size, $id);
                // var_dump($getPrice);
                if($getPrice){
                    // echo "moze";
                    // var_dump($getPrice);
                    echo json_encode($getPrice);
                    http_response_code(200);
                }
                
                //echo $size;
                // $getPrice = get_price($size);
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