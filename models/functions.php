<?php 
/*------------
    SELECT
--------------*/ 

/*================================
    => SELECT *
==================================*/
    function select_all($table_name){
        global $conn;
        $query = "SELECT * FROM $table_name";
        $content = $conn->query($query)->fetchAll();
        return $content;
    }
/*================================
    => SELECT ID
==================================*/
    function select_id($table_name, $id_dbName, $id){
        // echo "u funkciji sam";
        global $conn;
        $query = "SELECT * FROM $table_name WHERE $id_dbName = $id";
        $content = $conn->query($query)->fetchAll();
        // var_dump($content);
        return $content;
    }
/*================================
    => PARAMETAR JE UPIT
==================================*/
    function executeQuery($query){
        global $conn;
        return $conn->query($query)->fetchAll();
    }
/*================================
    => GET ID PERFUME
==================================*/
    function getPerfume($id){
        global $conn;
        $query = 
            "SELECT * FROM perfume p
            INNER JOIN brand b ON p.id_brand = b.id_brand
            INNER JOIN category c ON c.id_category = p.id_category
            INNER JOIN perfume_milliliters pm ON p.id_perfume = pm.id_perfume
            INNER JOIN milliliters m ON m.id_mil = pm.id_mil
            WHERE p.id_perfume = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id", $id);

        $prepare->execute();

        return $prepare;
    }
/*================================
    => GET USER ID
==================================*/
    function getUser($idUser){
        global $conn;
        $query = "SELECT * FROM users u WHERE id_user = :idUser";
    
        $user = $conn->prepare($query);
        $user->bindParam(":idUser", $idUser);
        $user->execute();
        $result = $user->fetch();
    
        return $result;
    }
/*================================
    => SELECT PRICE
==================================*/
    function select_price($id, $idMil){
        global $conn;
        $query = 
            "SELECT price FROM perfume_milliliters 
            WHERE id_mil = :idMil AND id_perfume = :id";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":idMil", $idMil);
        $prepare->bindParam(":id", $id);

        $result = $prepare->execute();
        // $result->fetch();
        return $result;
    }
/*================================
    => GET CATEGORIES, GET BRANDS, SENDING AN ARRAY
==================================*/
     function select_where_in($column, $selected){
        global $conn;

        $imploded_arr = implode(', ', $selected);
        //var_dump($imploded_arr);
        $query = "SELECT * FROM perfume p
        INNER JOIN brand b ON p.id_brand = b.id_brand
        INNER JOIN category c ON c.id_category = p.id_category
        INNER JOIN perfume_milliliters pm ON p.id_perfume = pm.id_perfume
        INNER JOIN milliliters m ON m.id_mil = pm.id_mil
        WHERE pm.id_mil = 1 AND p.$column IN($imploded_arr)";
        $content = $conn->query($query)->fetchAll();
        //var_dump($content);
        return $content;
    }
/*================================
    => CHANGE PRICE BY MIL.
==================================*/
    function get_price($sizeMil, $id){
        global $conn;

        $query = "SELECT pm.price FROM perfume p
        INNER JOIN perfume_milliliters pm ON p.id_perfume = pm.id_perfume
        WHERE pm.id_mil = :sizeMil AND pm.id_perfume = :id";
        $price = $conn->prepare($query);
        $price->bindParam(":sizeMil", $sizeMil, PDO::PARAM_INT);
        $price->bindParam(":id", $id, PDO::PARAM_INT);

        $result = $price->execute();
        $result = $price->fetch();

        return $result;
    }

/*================================
    => SEARCH, SELECT
==================================*/
    function search_name_perfume($searchValue){
        global $conn;
        $query = "SELECT p.*, b.brand_name, c.category_name, pm.price
        FROM perfume p
        INNER JOIN brand b ON p.id_brand = b.id_brand
        INNER JOIN category c ON c.id_category = p.id_category
        INNER JOIN perfume_milliliters pm ON p.id_perfume = pm.id_perfume
        INNER JOIN milliliters m ON m.id_mil = pm.id_mil
        WHERE (p.name LIKE CONCAT('%', :text, '%') OR 
            b.brand_name LIKE CONCAT('%', :text, '%') OR 
            c.category_name LIKE CONCAT('%', :text, '%')) 
        AND pm.id_mil = 1";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":text", $searchValue);
        $result =$prepare->execute();
        $results = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $results ? $results : [];
    }
/*-------------
    INSERT
---------------*/ 

/*================================
    => CONTACT FORM - SEND MESSAGES
==================================*/
function insert_contact($first_name_msg, $last_name_msg, $email_msg, $msg){
    global $conn;
    $query = "INSERT INTO messages(first_name_messager, last_name_messager, email_messager, message_content)
              VALUES (:firstName, :lastName, :email, :msg)
             ";
    $prepare = $conn->prepare($query);
    $prepare->bindParam(":firstName", $first_name_msg);
    $prepare->bindParam(":lastName", $last_name_msg);
    $prepare->bindParam(":email", $email_msg);
    $prepare->bindParam(":msg", $msg);

    $result = $prepare->execute();

    return $result;
}

/*================================
    => REGISTER
==================================*/
function insert_user($firstName, $lastName, $email, $password, $idRole){
    global $conn;
    $query = "INSERT INTO users(first_name, last_name, email, password_user, id_role)
              VALUES (:firstNameR, :lastNameR, :emailR, :passwordR, :idRole)
             ";
    $user = $conn->prepare($query);
    $user->bindParam(":firstNameR", $firstName);
    $user->bindParam(":lastNameR", $lastName);
    $user->bindParam(":passwordR", $password);
    $user->bindParam(":emailR", $email);
    $user->bindParam(":idRole", $idRole);

    $result2 = $user->execute();

    return $result2;
}   

/*================================
    => ADMIN PANEL - ADD NEW PERFUME
==================================*/
function insert_perfume($namePerfume, $photoPerfume, $descriptionPerfume, $brandPerfume, $categoryPerfume, $highlighted){
    global $conn;

    $query = "INSERT INTO 
    perfume(name, photo_src, description, id_brand, id_category, highlighted) 
    VALUES (:namePerfume, :photoPerfume, :desc, :brand, :category, :highlight)
    ";
    $insert = $conn->prepare($query);

    $insert->bindParam(":namePerfume", $namePerfume);
    $insert->bindParam(":photoPerfume", $photoPerfume);
    $insert->bindParam(":desc", $descriptionPerfume);
    $insert->bindParam(":brand", $brandPerfume);
    $insert->bindParam(":category", $categoryPerfume);
    $insert->bindParam(":highlight", $highlighted);

    $inserted = $insert->execute();

    return $inserted;

}
/*================================
    => INSERT W PRICE N SIZE
==================================*/
function insert_with_price_and_size($perfume, $size, $price){
    global $conn;
    $query = "INSERT INTO perfume_milliliters(id_perfume, id_mil, price) 
              VALUES (:perfume, :milliliters, :price)
    ";
    $prepare = $conn->prepare($query);
    $prepare->bindParam(":perfume", $perfume);
    $prepare->bindParam(":milliliters", $size);
    $prepare->bindParam(":price", $price);

    $result = $prepare->execute();

    return $result;
}

/*================================
    => LOGIN, SELECT CHECK, IF EXISTS = LOGGED
==================================*/

function check_login($email, $encryptedPassword){
    global $conn;
    $query = "SELECT * FROM users u INNER JOIN role r ON u.id_role = r.id_role
    WHERE u.email = :email AND u.password_user = :passwordUser";

    $login = $conn->prepare($query);
    $login->bindParam(":email", $email);
    $login->bindParam(":passwordUser", $encryptedPassword);
    $login->execute();
    $result = $login->fetch();

    return $result;

}




/*------------
    UPDATE
--------------*/ 
/*================================
    => USER PROFILE - UPDATE USER 
==================================*/
function update_user($first_name, $last_name, $email, $password, $id){
    global $conn;
    $query = '';
    // ako lozinka nije prazan string, onda je korisnik editovao
    if($password != ""){
        $query = "UPDATE users SET 
        first_name = :firstNameUser,
        last_name = :lastNameUser,
        email = :emailUser, 
        password_user = :passwordUser
        WHERE id_user = :idUser";
    }
    // ako je lozinka prazan string, korisnik je nije promenio pri editu
    elseif($password == ""){
        $query = "UPDATE users SET 
        first_name = :firstNameUser,
        last_name = :lastNameUser,
        email = :emailUser
        WHERE id_user = :idUser";
    }
    $prepare = $conn->prepare($query);

    $prepare->bindParam(":firstNameUser", $first_name);
    $prepare->bindParam(":lastNameUser", $last_name);
    $prepare->bindParam(":emailUser", $email);
    if($password != ""){
        $prepare->bindParam(":passwordUser", $password);
    }
    $prepare->bindParam(":idUser", $id);


    $result = $prepare->execute();

    // $result = $prepare->fetch();
    // var_dump($result);
    return $result;
}

/*================================
    => ADMIN PANEL - UPDATE PERFUME
==================================*/
function update_perfume($id, $name, $photo, $description, $idBrand, $idCategory, $highlighted){
    global $conn;
    $query = "";
    if($photo != ""){
    $query = "UPDATE perfume SET
              name = :name,
              photo_src = :photo,
              description = :desc,
              id_brand = :idBrand,
              id_category = :idCategory,
              highlighted = :highlighted
              WHERE id_perfume = :id
              ";
    } 
    elseif($photo == "") {
        $query = "UPDATE perfume SET
              name = :name,
              description = :desc,
              id_brand = :idBrand,
              id_category = :idCategory,
              highlighted = :highlighted
              WHERE id_perfume = :id
              ";
    }
    $prepare = $conn->prepare($query);
    $prepare->bindParam(":name", $name);
    if($photo != ""){
        $prepare->bindParam(":photo", $photo);
    }
    $prepare->bindParam(":desc", $description);
    $prepare->bindParam(":idBrand", $idBrand);
    $prepare->bindParam(":idCategory", $idCategory);
    $prepare->bindParam(":highlighted", $highlighted);
    $prepare->bindParam(":id", $id);

    $updated = $prepare->execute();
    
    return $updated;

}

/*------------
    DELETE
--------------*/ 

/*================================
    => ADMIN PANEL - UNIVERSAL FUNCTION FOR DELETING
==================================*/
function deleteData($tableName, $column, $id){
    global $conn;

    $query = "DELETE FROM $tableName WHERE $column = :id";
    $delete = $conn->prepare($query);
    $delete->bindParam(":id", $id);
    $result = $delete->execute();

    return $result;
}


?>