

<?php include("fixed/head.php"); ?>
<header>
<!-- header inner -->
<div class="header-top2">
<?php include("fixed/header.php"); ?>
</header>
<!-- contact -->
<div class="register contact">
         <div class="container">
            <div class="row">
               <!-- title -->
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2 class='title-sign p-0'>Sign up</h2>
                  </div>
               </div>
               <!-- ../title -->
            </div>
            <div class="row d-flex align-items-center justify-content-center">
               <!-- register form -->
               <div class="col-xl-8 d-flex align-items-center justify-content-center">
                  <div class="contact">
                     <form method='POST' action="register.php" id='formregister'>
                        <div class="row">
                           <!--  FIRST NAME REGISTRATION -->
                        <div class="col-sm-12 p-0 m-0">
                              <input class="contactus" placeholder="First name" type="text" name="firstNameUser" id="firstNameRegister">
                           </div>
                           <span class="spanInfoReg"></span>
                           <!-- LAST NAME REGISTRATION -->
                           <div class="col-sm-12 p-0 m-0">
                              <input class="contactus" placeholder="Last Name" type="text" name="lastNameUser" id="lastNameRegister">
                           </div>
                           <span class="spanInfoReg"></span>
                           <div class="col-sm-12 p-0 m-0">
                              <!-- email => REGISTER -->
                              <input class="contactus" placeholder="Email" type="text" name="emailUser" id="emailRegister">
                           </div>
                           <span class="spanInfoReg"></span>
                           <div class="col-sm-12 p-0 m-0">
                              <!-- password => REGISTER -->
                              <input type="password" name="passwordUser" id="passwordRegister" placeholder='Password' class='contactus'/>
                              <span class="spanInfoReg"></span>
                              
                           </div>
                           <p class='pt-3'> Already have an account? <a class='link-sign' href="login.php">Sign in</a> now!</p>
                           
                           <div class="col-sm-12 mt-3">
                              <!-- SIGN IN -->
                              <input type='button' value='SIGN UP'id="btnSignUp" class='send' name="btnRegistered"/>
                           </div>
                           <p id="response" class='mt-3'></p>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- ../register form -->
            </div>
         </div>
      </div>
      <!-- end contact -->
<?php include("fixed/footer.php"); ?>
   </body>
</html>
