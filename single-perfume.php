

<?php include("fixed/head.php"); ?>
<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // $size = $_GET['size'];
       // var_dump($size);
        //var_dump($id);
        $perfumeData = getPerfume($id);
        // var_dump($perfumeData);
        if($perfumeData){
            $fetchedPerfumes = $perfumeData->fetch();
            // var_dump($fetchedPerfumes);
        }
           
    }
    else {
        header("Location: page404.php");
    }
?>
<header>
<!-- header inner -->
<div class="header-top2">
<?php include("fixed/header.php"); ?>
</header>
<div class="container-fluid my-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center flex-row flex-wrap">
                    <div class="col-xl-6 d-flex align-items-center justify-content-center">
                        <img src="images/<?php 
                                if(strpos($fetchedPerfumes->photo_src, "|")){
                                    $imagesArray = explode("|", $fetchedPerfumes->photo_src);
                                    echo trim($imagesArray[0]);
                                }
                                else {
                                    echo $fetchedPerfumes->photo_src;
                                }
                        ?>" alt="<?=$fetchedPerfumes->name?>" />
                    </div>
                    <div class="col-xl-6">
                        <div class='d-flex flex-row'>
                            <div class="brand">
                                <?= $fetchedPerfumes->brand_name?>
                            </div>
                            <span class='cat cat-single add-montez mb-3 fs-bold2'>
                                <?php 
                                    if($fetchedPerfumes->category_name == "Women" ||  $fetchedPerfumes->category_name == "Men"){
                                        echo "For " . $fetchedPerfumes->category_name;
                                    }
                                    else {
                                        echo $fetchedPerfumes->category_name;
                                    }
                                ?>
                                <div class="line">
                                        <img src="images/lines.png" class='img-fluid' alt="line" />
                                </div>
                            </span>
                        </div>
                        <div class="name-perfume tt mt-1 pb-2"><?=$fetchedPerfumes->name?></div>
                        <div class="d-flex flex-row flex-wrap">
                            <form action="shop.php" class='col-12 p-0'>
                                <!-- <input type="hidden" name="idPerfumePrice" id="idPerfume" value="?>"/> -->
                                <!-- CHANGE PRICE BY MILLILITERS -->
                                <select name="size" id='sizeMl' class="custom-select col-xl-3">
                                        <?php 
                                        $id = $_GET['id'];
                                        $milliliters = executeQuery("SELECT m.value, m.id_mil FROM milliliters m 
                                                                        INNER JOIN perfume_milliliters pm ON
                                                                        m.id_mil = pm.id_mil
                                                                        WHERE pm.id_perfume = $id");?>
                                        <?php foreach($milliliters as $m):?>
                                            <option value="<?=$m->id_mil?>"><?=$m->value?> ml</option>
                                        <?php endforeach;?>
                                    </select>
                                <select name="quantity" id='size' class="custom-select col-xl-3">
                                        <?php 
                                        // max 20 
                                        for($quantity = 1; $quantity < 21; $quantity++):?>
                                            <option value="<?=$quantity?>"> <?=$quantity?> </option>
                                        <?php endfor;?>
                                </select>
                                <a class="btn btn-information" data-container="body" data-toggle="popover" data-placement="top" data-content="Limit is 20 perfumes for one order.">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                                <input type="button" class='button-add col-xl-4 mt-1 pt-1' value='Add to Basket'/>
                            </form>
                        </div>
                        <div class="row col-xl-8 d-flex align-items-center justify-content-center">
                            <div class=" col-xl-3 mt-1 mr-1">
                                <span class='sizes mt-3 lt2'>SIZE</span>
                            </div>
                            <div class="col-xl-3 mt-1">
                                <span class='sizes mt-3 lt2'>QUANTITY</span>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-left single-price">
                            <span class='add-montez fs1 mt-3 pricing' data-id='<?=$fetchedPerfumes->price?>'>
                                <?php 
                                       echo  "$" . $fetchedPerfumes->price;
                                ?>
                            </span>
                        </div>
                        <div class="mt-1 d-flex flex-column">
                            <div class="description">
                                Description
                            </div>
                            <?php 
                                 if(strpos($fetchedPerfumes->description, "|")){
                                    $descriptionArray = explode("|", $fetchedPerfumes->description);
                                    echo "<p class='py-1'>$descriptionArray[0]</p>
                                          <p class='py-3'>$descriptionArray[1]</p>";
                                }
                                else {
                                    echo $fetchedPerfumes->description; 
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("fixed/footer.php"); ?>
    </body>
</html>
