<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    // obrati paznju na sve var_dump-ove, ne smeju ostati i ispisivati se kada se salje JSON.
    // JSON se ponekad ne ispisuje pravilno zbog dodatnih ispisivanja.
    if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        try {
            if(isset( $_POST['arrayCategories'])){
            $categories = $_POST['arrayCategories'];
            //var_dump($categories);
            // echo "<br/>";
            //var_dump($categories[0]);
            $selectCategories = select_where_in('id_category', $categories);
                    if($selectCategories){
                        // echo "uspeh";
                        // var_dump($selectCategories);
                        echo json_encode($selectCategories);
                        http_response_code(200);
                    }
                }
            else {
                    $selectDefault = executeQuery("SELECT * FROM perfume p
                    INNER JOIN brand b ON p.id_brand = b.id_brand
                    INNER JOIN category c ON c.id_category = p.id_category
                    INNER JOIN perfume_milliliters pm ON p.id_perfume = pm.id_perfume
                    INNER JOIN milliliters m ON m.id_mil = pm.id_mil
                    WHERE pm.id_mil = 1");
                    echo json_encode($selectDefault);
                    http_response_code(200);
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