<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        try {
                if(isset($_POST['search'])){
                    $search = $_POST['search'];
                    // echo $search;
                    $resultSearch = search_name_perfume($search);
                
                    // var_dump($resultSearch);
                    http_response_code(200);
                    echo json_encode($resultSearch);
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