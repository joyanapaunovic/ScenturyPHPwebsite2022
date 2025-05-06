<?php include("fixed/head.php"); ?>
<!-- HEADER -->
<header>
<!-- HEADER INNER -->
    <div class="header-top2">
        <?php include("fixed/header.php");?>
    
    </div>
    <!-- ../ END HEADER top -->
</header>
<!-- ../END HEADER -->




<!-- PERFUMES -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mt-5 pt-5">
                <div class='filterSortTitles pl-1 mb-1'>ORDER BY</div>
                <!-- SORT BY PRICE -->
                <select class="custom-select" id="ddlSort">
                    <option value="default">Default</option>
                    <option value="asc">Price Low to High</option>
                    <option value="desc"> Price High to Low</option>
                </select>
                <!-- ../END SORT BY -->
                <!-- SEARCH -->
                <div class="mt-3">
                    <input type="search" class='form-control' id='searchPerfumes' name="search" placeholder="Search..."/>
                </div>
                <!-- ../END SEARCH -->
		        <!-- CATEGORIES -->
                <div class='filterSortTitles mt-3 mb-1 pl-1'>CATEGORIES</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php 
                            // var_dump($categories);
                            foreach($categories as $c):
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='arrayCategories[]' value="<?= $c->id_category ?>" id="<?= strtolower($c->category_name) . "Category" ?>">
                                <label class="form-check-label" for="<?= strtolower($c->category_name) . "Category" ?>">
                                    <?=$c->category_name?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                    </li>
                </ul>
                <!-- ../END CATEGORIES -->
                <!-- BRANDS -->
                <div class='filterSortTitles mt-3 mb-1 pl-1'>BRANDS</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php 
                            // var_dump($brands);
                            foreach($brands as $b):
                        ?>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" name='arrayBrands[]' value="<?= $b->id_brand ?>" id="<?=strtolower($b->brand_name) . "Brand"?>">
                            <label class="form-check-label" for="<?=strtolower($b->brand_name) . "Brand"?>">
                                <?=$b->brand_name?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </li>
                </ul>
                <!-- ../END BRANDS -->
        </div>
        <div class="col-lg-9">
        <div class="row">
        <div class="col-xl-12 d-flex align-items-center">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center flex-wrap">
                <div class="row d-flex align-items-center col-xl-12" id="perfumes">
                    <?php 
                        //var_dump($perfumes);
                        $perfume = "SELECT * FROM perfume p
                                    INNER JOIN brand b ON p.id_brand = b.id_brand
                                    INNER JOIN category c ON c.id_category = p.id_category
                                    INNER JOIN perfume_milliliters pm ON p.id_perfume = pm.id_perfume
                                    INNER JOIN milliliters m ON m.id_mil = pm.id_mil
                                    WHERE pm.id_mil = 1";
                        $result = executeQuery($perfume);
                    // var_dump($result);
                    foreach($result as $p):     
                    ?>
                    <!-- PERFUMES -->
                    <div class="col-xl-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-nbtween flex-column flex-wrap mt-5 mb-5 perfume">
                           <!-- picture -->
                            <div class="perfume-picture">
                            <img src="images/<?php 
                                if(strpos($p->photo_src, "|") !== false) { $images = explode("|", $p->photo_src); echo trim($images[0]); 
                                } else {
                                    echo $p->photo_src; 
                                }?>" class='img-fluid img-perfume' alt="<?=$p->name?>" />
                            </div>
                            <!-- name -->
                            <span class="name-perfume mt-3">
                                <?= $p->name ?>
                            </span>
                            <!-- brand -->
                            <div class="d-flex flex-row justify-content-between align-items-center">
                            <span class='brand'>
                                <?= $p->brand_name ?>
                            </span>
                            <span class='cat mb-1 add-montez fs-bold'>
                                <?php 
                                    if($p->category_name == "Men" || $p->category_name == "Women"){
                                        echo  "For " . $p->category_name;
                                    }
                                    elseif($p->category_name == "Unisex"){
                                        echo $p->category_name;
                                    }
                                ?>
                               <div class="line">
                                    <img src="images/lines.png" class='img-fluid' alt="line" />
                               </div>
                            </span>
                            </div>
                            <!-- price -->
                            <span class='price mt-1'>
                                <?php 
                                    echo "$" .$p->price;
                                ?>
                            </span>
                            <!-- single-product page => more about the perfume -->
                            <div class="best_text">
                                <a href="single-perfume.php?id=<?=$p->id_perfume?>" data-id='<?=$p->id_perfume?>' class='view-more-link'>View Details</a>
                            </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
        
</div>
</div>         
</div>
</div>
</div>

<!-- END PERFUMES -->
<!-- FOOTER -->
<?php include("fixed/footer.php");?>
<!-- ../ END FOOTER -->
    </body>
</html>