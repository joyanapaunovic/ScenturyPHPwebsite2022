
<?php //session_start();
include("fixed/head.php"); ?>
<?php 
    
    $perfumes = select_all("perfume");
    $users = select_all("users");
    $messages = select_all("messages");
    $categories = select_all("category");
    $brands = select_all("brand");
    // var_dump($users);
    // var_dump($perfumes);
?>
<header>
<!-- header inner -->
<div class="header-top2">
<?php include("fixed/header.php"); ?>
</header>
<?php 
    if(isset($_SESSION['user'])){
     $user = $_SESSION['user'];
    //  var_dump($user);
     if($user->id_role == 1){
         
     
?>
    <div class="container-fluid color-bc ">
        <div class="row">
        <!-- <div class="container"> -->
            <div class="col-xl-12">
                <ul class="nav nav-pills mt-5 d-flex align-items-center justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item mb-3" role="presentation">
                        <button class="nav-link active mx-1" id="pills-home-tab" data-toggle="pill" data-target="#pills-perfumes" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Perfumes</button>
                    </li>
                    <li class="nav-item mb-3" role="presentation">
                        <button class="nav-link mx-1" id="pills-profile-tab" data-toggle="pill" data-target="#pills-categories" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Categories</button>
                    </li>
                    <li class="nav-item mb-3" role="presentation">
                        <button class="nav-link mx-1" id="pills-contact-tab" data-toggle="pill" data-target="#pills-users" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Users</button>
                    </li>
                    <li class="nav-item mb-3" role="presentation">
                        <button class="nav-link mx-1" id="pills-contact-tab" data-toggle="pill" data-target="#pills-messages" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Messages</button>
                    </li>
                    <li class="nav-item mb-3" role="presentation">
                        <button class="nav-link mx-1" id="pills-contact-tab" data-toggle="pill" data-target="#pills-insert" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Add a new perfume</button>
                    </li>
                    <li class="nav-item mb-3" role="presentation">
                        <button class="nav-link mx-1" id="pills-contact-tab" data-toggle="pill" data-target="#pills-insert-size-price" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Add price for available sizes</button>
                    </li>
                </ul>
                    <!-- => PERFUMES -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-perfumes" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="container-fluid mb-5">
                            <div class="col-xl-12">
                            <div>
                                <h3 class=" table-name text-center mt-4 mb-3">
                                    Perfumes
                                </h3>
                            </div>
                            <?php 
                                if(count($perfumes) == 0){
                                    echo "<p class='my-5'>Currently there is no perfumes to show.</p>";
                                }
                            else {
                            ?>
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Photo(s)</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php 
                                        $number = 0;
                                        foreach($perfumes as $p):?>
                                        <tr>
                                        <?php $name = explode(".", $p->photo_src);?>
                                            <th scope="row"><?=++$number;?></th>
                                                <td><?=$p->name?></td>
                                                <td><?=$p->photo_src?></td>
                                                <td><?=$p->description?></td>
                                                <td><?=$p->id_brand?></td>
                                                <td><?=$p->id_category?></td>
                                                <td><a class='link-modify'  href="update-perfume.php?id=<?=$p->id_perfume?>">Edit</a></td>
                                                <td>
                                                <a class='link-modify' href='#' data-toggle="popover" data-html="true" data-trigger="focus" 
                                                title="Are you sure you want to delete this perfume?" data-content="<input type='button'  
                                                data-idperfume='<?= $p->id_perfume ?>' class='see-more-link-yes'  id='deletePerfume' 
                                                value='Yes' /> 
                                                <button type='button' class='see-more-link-yes' onclick='self.close()'>No</button>">
                                                    Delete
                                                </a>
                                            </td>
                                            </tr>
                                      
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                               
                    </div></div> <!--end perfumes show-->


                    <div class="tab-pane fade" id="pills-categories" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <!-- => CATEGORIES -->
                    <div class="container mt-2 mb-5">
                            <div class="col-xl-12">
                                <div>
                                    <h3 class="table-name text-center mt-4 mb-3">
                                        Categories
                                    </h3>
                                </div>
                                <?php 
                                if(count($categories) == 0){
                                    echo "<p class='my-5'>Currently there is no categories to show.</p>";
                                }
                            else {
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php 
                                        $number = 0;
                                        foreach($categories as $c):?>
                                        <tr>
                                            <th scope="row"><?=++$number;?></th>
                                                <td><?=$c->category_name?></td>
                                                
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                    </div>  
                    <!-- ../END CATEGORIES -->

                    </div> <!--end categories show-->



                    <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-contact-tab">

                    <!-- => USERS -->
                    <div class="container-fluid mt-2 mb-5">
                            <div class="col-xl-12">
                                <div>
                                    <h3 class="table-name text-center mt-4 mb-3">
                                        Users
                                    </h3>
                                </div>
                                <?php 
                                if(count($users) == 0){
                                    echo "<p class='my-5'>Currently there is no users to show.</p>";
                                }
                            else {
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First name</th>
                                        <th scope="col">Last name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Date registered</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php 
                                        $number = 0;
                                        foreach($users as $u):?>
                                        <tr>
                                            <th scope="row"><?=++$number;?></th>
                                                <td><?=$u->first_name?></td>
                                                <td><?=$u->last_name?></td>
                                                <td><?=$u->email?></td>
                                                <td class='td-wrap'><?=$u->password_user?></td>
                                                <td><?= date("d/m/Y ➤ H:i:s", strtotime($u->date_reg)); ?></td>
                                                <td><?= $u->id_role ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                    </div>             
                    <!-- ../END USERS -->

                    </div> <!-- users show...-->


                    <div class="tab-pane fade" id="pills-messages" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <!-- => MESSAGES -->
                        <div class="container-fluid mt-2 mb-5">
                                <div class="col-xl-12">
                                    <div>
                                        <h3 class="table-name text-center mt-4 mb-3">
                                            messages
                                        </h3>
                                    </div>
                                    <?php 
                                if(count($messages) == 0){
                                    echo "<p class='my-5'>Currently there is no messages to show.</p>";
                                }
                            else {
                            ?>
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First name</th>
                                            <th scope="col">Last name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Message content</th>
                                            <th scope="col">Date sent</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php 
                                            $number = 0;
                                            foreach($messages as $m):?>
                                            <tr>
                                                <th scope="row"><?=++$number;?></th>
                                                    <td><?= $m->first_name_messager ?></td>
                                                    <td><?= $m->last_name_messager ?></td>
                                                    <td><?= $m->email_messager ?></td>
                                                    <td><?= $m->message_content?></td>
                                                    <td><?= date("d/m/Y ➤ H:i:s", strtotime($m->message_date)) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php } ?>
                                </div>
                        </div>    
                    <!--../END MESSAGES  -->

                    </div>
                    <!--  => INSERT A NEW PERFUME -->
                    <div class="tab-pane fade " id="pills-insert" role="tabpanel" aria-labelledby="pills-contact-tab">
                         <!-- form insert perfume -->
                            <!--  FORM -->
                            <div id="insert" class="contact">
                                <div class="container">
                                    <div class="row d-flex align-items-center justify-content-center">
                                        <div class="col-xl-8 mb-5 d-flex align-items-center justify-content-center">
                                            <div class="contact">
                                                <form enctype="multipart/form-data">
                                                    <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="contactus" placeholder="Perfume name..." type="text" id='namePerfume' />
                                                        <span class='spanInsert'></span>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input class="contactus" type="file" class='form-control-file' id='uploadPhoto' />
                                                        <span class='spanInsert'></span>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input class="contactus" placeholder="Description..." type="text" id='description' />
                                                        <span class='spanInsert'></span>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <!-- BRAND -->
                                                        <select class='contactus select-design' id="ddlBrandInsert">
                                                            <option value="0">Choose brand...</option>
                                                            <?php 
                                                                foreach($brands as $b):
                                                            ?>
                                                            <option value="<?= $b->id_brand ?>"><?= $b->brand_name ?></option>
                                                            <?php endforeach; ?> 
                                                        </select>
                                                        <span class='spanInsert'></span>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <!-- CATEGORY -->
                                                        <select class='contactus select-design' id="ddlCategoryInsert">
                                                            <option value="0">Choose category...</option>
                                                            <?php 
                                                                foreach($categories as $c):
                                                            ?>
                                                            <option value="<?= $c->id_category ?>"><?= $c->category_name ?></option>
                                                            <?php endforeach; ?> 
                                                        </select>  <span class='spanInsert'></span>
                                                        
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input type='button' value='Add' class='send mt-3' id='btnInsert'/>
                                                    </div>
                                                    </div>
                                                    <div class='my-3'>
                                                        <span id="responseInserted"></span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- end contact -->
                         <!-- form insert perfume -->
                                
                    </div>
                    <!-- ../INSERT A NEW PERFUME -->


                    <!--  => INSERT PRICE -->
                    <div class="tab-pane fade" id="pills-insert-size-price" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div id="insertSizesPrices" class="contact">
                                <div class="container">
                                    <div class="row d-flex align-items-center justify-content-center">
                                        <div class="col-xl-8 mb-5 d-flex align-items-center justify-content-center">
                                            <div class="contact">
                                                <form>
                                                    <div class="row d-flex flex-column align-items-center justify-content-center">
                                                    <div class="col-sm-10">
                                                        <!-- BRAND -->
                                                        <!-- ID PERFUME -->
                            
                                                        <select  id='perfume' class="contactus select-design">
                                                            <?php $perfumes = select_all("perfume");?>
                                                            <?php foreach($perfumes as $p):?>
                                                                <option value="<?=$p->id_perfume?>"><?=$p->id_perfume?> - <?=$p->name?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <!-- MILLILITERS -->
                                                        
                                                        <select  id='size' class="contactus select-design">
                                                            <?php $milliliters = select_all("milliliters");?>
                                                            <?php foreach($milliliters as $m):?>
                                                                <option value="<?=$m->id_mil?>"><?=$m->value?> ml</option>
                                                            <?php endforeach;?>
                                                        </select>
                                                        
                                                    </div>
                                                    <!--  PRICE -->
                                                    <div class="col-sm-10">
                                                            <input class="contactus" placeholder="Price..." type="text" id='price' />
                                                            <span id='spanSize'></span>
                                                        </div>

                                                    <div class="col-sm-12">
                                                        <input type='button' value='Add' class='send mt-3' id='btnSizePrice'/>
                                                    </div>
                                                    </div>
                                                    <div class='my-3'>
                                                        <span id="responseSizePrice"></span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                         <!-- form insert perfume -->
                                
                    </div>
                    <!-- ../INSERT PRICE -->
                </div>
            </div>
        </div>
    </div>
    <?php } 
    }
    else {
        header("Location: page404.php");
    } ?>
   <?php include("fixed/footer.php"); ?>
   </body>
</html>

