<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['btnUpdate'])){
      try {
            $namePerfume = $_POST['namePerfume'];
            if(isset($_POST['photo'])){
                $photo = $_POST['photo'];
                // echo $photo . "<br/>";
            }
            // $photo = $_POST['photo'];
            $description = $_POST['descriptionPerfume'];
            $brand = $_POST['brandPerfume'];
            $category = $_POST['categoryPerfume'];
            $idPerfume = $_POST['id_perfume']; // hidden
            $highlighted = $_POST['highlighted'];
            // echo $namePerfume . "<br/>";
            // echo $description . "<br/>";
            // echo $brand . "<br/>";
            // echo $category . "<br/>";

            $errors = 0;

            if($namePerfume == ""){
                $errors++;
            }
            if($description == ""){
                $errors++;
            }
            if($brand == "0"){
                $errors++;
            }
            if($category == "0"){
                $errors++;
            }
            // ako je slika prazan string, onda je admin nije promenio
            // ako je razlicita od praznog stringa i ako je prosla klijentsku proveru, dohvatamo vrednost i prosledjujemo dalje u upitu
            if($errors == 0){
                $updatePerfume = update_perfume($idPerfume, $namePerfume, $photo, $description, $brand, $category, $highlighted);
                // echo $updatePerfume;
                if($updatePerfume){
                    // echo "odradjen update";
                    $response = ['msg' => "You've successfully updated this perfume."];
                    http_response_code(200);
                    echo json_encode($response);
                }
            }
      }
      catch(PDOEception $ex){
          echo $ex->getMessage();
          http_response_code(500);
      }
    }
    else {
        header("Location:../page404.php");
    }
?>