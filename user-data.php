

<?php //session_start(); 
include("fixed/head.php"); ?>
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
        if($_SESSION['user']->id_role == 2){
         //var_dump($_SESSION['user']);
         $loggedUser = $_SESSION['user'];
        // $size = $_GET['size'];
       // var_dump($size);
        //var_dump($id);
        $userData = getUser($loggedUser->id_user);
        //var_dump($userData); 
        }
    }
    else {
        header("Location: page404.php");
    }
?>


<!-- USER DATA -->
<div class="register contact">
         <div class="container">
            <div class="row">
               <!-- title -->
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2 class='title-sign p-0'>Your information</h2>
                  </div>
               </div>
               <!-- ../title -->
            </div>
            <div class="row d-flex align-items-center justify-content-center">
               <!-- user data form disabled -->
               <div class="col-xl-8 d-flex align-items-center justify-content-center">
                  <div class="contact">
                     <form>
                        <?php 
                           if(isset($_SESSION['user'])){
                              $user = $_SESSION['user']->id_user;
                              // echo $user;
                           }
                        ?>
                        <input type='hidden' value='<?=$user?>' id='userId' />
                        <div class="row">
                        
                           <div class="col-sm-12">
                           <!-- first name => USER DATA -->
                           <label for="" class='m-0 p-0'>First name</label>
                              <input class="contactus" id='firstNameUserData' value='<?=$userData->first_name?>' type="text" />
                              <span class="userData"></span>
                           </div>
                           <div class="col-sm-12">
                           <!-- last name => USER DATA -->
                           <label for="" class='mt-2 mb-0'>Last name</label>
                              <input class="contactus"  id='lastNameUserData' value='<?=$userData->last_name?>' type="text" />
                              <span class="userData"></span>
                           </div>
                           <div class="col-sm-12">
                           <!-- email => USER DATA -->
                           <label for="" class='mt-2 mb-0'>Email</label>
                              <input class="contactus" id='emailUserData' value='<?=$userData->email?>' type="email" />
                              <span class="userData"></span>
                           </div>
                           <div class="col-sm-12">
                           <label for="" class='mt-2 mb-0'>Password</label>
                              <input type="password" id="passwordUserData" placeholder='Password...' class='contactus'/>
                              <span class="userData"></span>
                           </div>
                           <input type="button" class='send' value="Edit" id='btnEditUser' />
                        </div>
                     </form>
                     <div class="mt-2">
                        <span id="infoUser"></span>
                     </div>
                  </div>
               </div>
               <!-- ../user data form disabled -->
            </div>
         </div>
      </div>
      <!-- END USER DATA -->
      <?php include("fixed/footer.php"); ?>
   </body>
</html>