<?php  include("fixed/head.php"); ?>
<!-- HEADER -->
<header>
<!-- HEADER INNER -->
    <div class="header-top2">
        <?php include("fixed/header.php");?>
    </div>
    <!-- ../ END HEADER top -->
</header>
<!-- ../END HEADER -->
<?php 
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        if($user->label == "Admin"){
            if(isset($_GET['id'])){
                $idPerfume = $_GET['id'];
                // var_dump($idPerfume);

                $perfume = getPerfume($idPerfume)->fetch();
                // var_dump($perfume);
            }
           echo "
           <div id='update' class=\"contact\">
           <div class=\"container\">
               <div class=\"row d-flex align-items-center justify-content-center\">
                   <div class=\"col-xl-8 d-flex align-items-center justify-content-center\">
                       <div class=\"contact\">
                           <form enctype=\"multipart/form-data\">
                               <input type='hidden' id='idPerfume' value='$perfume->id_perfume' />
                               <div class=\"row\">
                               <div class=\"col-sm-12\">
                                   <input class=\"contactus\" placeholder=\"Perfume name...\" type=\"text\" id='perfumeName' value=\"$perfume->name\" />
                                   <span class='spanUpdate'></span>
                               </div>
                               <div class=\"col-sm-12\">
                                <div class='col-4 mb-2 mt-2'>
                                    <img src='images/$perfume->photo_src' alt='$perfume->name' class='img-fluid'/>
                                </div>
                                <span class='col-6 ml-2'>$perfume->photo_src</span>
                                   <input class=\"contactus\" type=\"file\"/>
                                   <span class='spanUpdate'></span>
                               </div>
                               <div class=\"col-sm-12\">
                                   <input class=\"contactus\" placeholder=\"Description...\" type=\"text\"  value=\"$perfume->description\" id='desc' />
                                   <span class='spanUpdate'></span>
                               </div>
                               <div class=\"col-sm-12\">
                                   <!-- BRAND -->
                                   <select class='contactus select-design' id=\"ddlBrandUpdate\">
                                       <option value=\"0\">Choose brand...</option>";
                                       
                                        foreach($brands as $b):
                                            if($b->id_brand == $perfume->id_brand){
                                                echo "<option value=\"$perfume->id_brand\" selected> $b->brand_name </option>";
                                            }
                                        else {
                                            echo "<option value=\"$b->id_brand\"> $b->brand_name </option>";
                                        }
                                        endforeach;
                                   echo "</select>
                                   <span class='spanUpdate'></span>
                               </div>
                               <div class=\"col-sm-12\">
                                   <!-- CATEGORY -->
                                   <select class='contactus select-design' id=\"ddlCategoryUpdate\">
                                       <option value=\"0\">Choose category...</option>";
                                        
                                       foreach($categories as $c):
                                       if($c->id_category == $perfume->id_category){
                                           echo "<option value=\"$perfume->id_category\" selected>$c->category_name</option>";
                                       }
                                        else {
                                            echo "<option value=\"$c->id_category\">$c->category_name</option>";
                                        }
                                        endforeach;
                                   echo "</select> <div class='my-2'>
                                            <span class='highlighted'>Highlighted</span>
                                            </div>";
                                            if($perfume->highlighted == 1){
                                                    echo "<div class=\"form-check\">
                                                        <input class=\"form-check-input\" type=\"radio\" name=\"highlighted\" value='$perfume->highlighted' checked/>
                                                        <label class=\"form-check-label\" for=\"\">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class='form-check'>
                                                        <input class=\"form-check-input\" type=\"radio\" name=\"highlighted\" value='0' />
                                                        <label class=\"form-check-label\" for=\"\">
                                                            No
                                                        </label>
                                                    </div>";
                                            }
                                            else {
                                                echo "<div class=\"form-check\">
                                                <input class=\"form-check-input\" type=\"radio\" name=\"highlighted\" value='1'/>
                                                <label class=\"form-check-label\" for=\"\">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class=\"form-check-input\" type=\"radio\" name=\"highlighted\" value='$perfume->highlighted' checked />
                                                <label class=\"form-check-label\" for=\"\">
                                                    No
                                                </label>
                                            </div>";
                                            }
                                            echo "
                                   <span class='spanUpdate'></span>
                               </div>
                               <div class=\"col-sm-12\">
                                   <input type='button' value='Edit' class='send mt-3' id='btnUpdate'/>
                               </div>
                               </div>
                               <div class='my-3'>
                                    <span id=\"responseUpdated\"></span>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
   </div>";
        }
        else {
            $result = ['message' => "This page can't be reached."];
            echo json_encode($result);
            header("Location:page404.php");
        }
    }
    else {
        $result = ['message' => "This page can't be reached."];
        echo json_encode($result);
        header("Location:page404.php");
    }
?>
<?php include("fixed/footer.php"); ?>
   </body>
</html>