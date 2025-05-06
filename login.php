
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
                     <h2 class='title-sign p-0'>Sign in</h2>
                  </div>
               </div>
               <!-- ../title -->
            </div>
            <div class="row d-flex align-items-center justify-content-center">
               <!-- LOGIN FORM -->
               <div class="col-xl-8 d-flex align-items-center justify-content-center">
                  <div class="contact">
                     <form name='loginForm' action='models/login-form.php' method='POST'>
                        <div class="row">
                           <div class="col-sm-12">
                              <!-- email => REGISTER -->
                              <input class="contactus" placeholder="Email" type="text" name="emailLogged" id="emailLogin" />
                              <span class="spanLog"></span>
                           </div>
                           <div class="col-sm-12">
                              <!-- password => REGISTER -->
                              <input type="password" name="passwordLogged" id="passwordLogin" placeholder='Password' class='contactus' />
                              <span class="spanLog"></span>
                              <p class=''> Don't have an account yet? <a class='link-sign' href="register.php">Sign up</a> now!</p>
                           </div>
                           <div class="col-sm-12 mt-3">
                              <!-- SIGN IN -->
                              <input type='button' value='SIGN IN' class='send' name="btnSignIn" id='btnLogin'/>
                           </div>
                           <p id='responseLog'></p>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- ../login form -->
            </div>
         </div>
      </div>
      <!-- end contact -->
<?php include("fixed/footer.php"); ?>
   </body>
</html>

