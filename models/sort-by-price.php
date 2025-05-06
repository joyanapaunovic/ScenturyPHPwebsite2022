<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_GET['sort'])){
        $sortValue = $_GET['sort'];
        try {
            if($sortValue == "asc"){
                $sortedAsc = executeQuery("SELECT * FROM perfume p 
                INNER JOIN perfume_milliliters pm 
                ON p.id_perfume = pm.id_perfume
                INNER JOIN category c ON c.id_category = p.id_category
                INNER JOIN brand b ON b.id_brand = p.id_brand
                WHERE pm.id_mil = 1
                ORDER BY pm.price ASC");
                // var_dump($sortedAsc);
                echo json_encode($sortedAsc);
            }
            if($sortValue == "desc"){
                $sortedDesc = executeQuery("SELECT * FROM perfume p 
                INNER JOIN perfume_milliliters pm 
                ON p.id_perfume = pm.id_perfume
                INNER JOIN category c ON c.id_category = p.id_category
                INNER JOIN brand b ON b.id_brand = p.id_brand
                WHERE pm.id_mil = 1
                ORDER BY pm.price DESC");
                // var_dump($sortedDesc);
                echo json_encode($sortedDesc);
            }
            // default
            if($sortValue == 'default') {
                $perfumes = executeQuery("SELECT * FROM perfume p
                INNER JOIN brand b ON p.id_brand = b.id_brand
                INNER JOIN category c ON c.id_category = p.id_category
                INNER JOIN perfume_milliliters pm ON p.id_perfume = pm.id_perfume
                INNER JOIN milliliters m ON m.id_mil = pm.id_mil
                WHERE pm.id_mil = 1
                ");
                echo json_encode($perfumes);
            }
        }
        catch(PDOException $ex){
            http_response_code(500);
            echo $ex->getMessage();
        }

    }
    else {
        http_response_code(404);
    }
?>