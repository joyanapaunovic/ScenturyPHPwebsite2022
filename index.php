<?php include("fixed/head.php"); ?>
<!-- LOADER  -->
   <?php include("fixed/loader.php"); ?>
<!-- ../ END-LOADER -->
      <!-- header -->
      <header>
      <!-- header inner -->
      <div class="header-top">
         <?php 
               include("fixed/header.php");
               include("fixed/baner.php")
         ;?>
      </div>
      </header>     
      <!-- a guide for finding yout signature scent  -->
      <div id="jewellery" class="Best">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2 class='add-montez mb-3 title-index'>a guide to finding your signature scent</h2>
                     <p class='mb-4'> Picking a new perfume is not easy but finding ‘the one’ can be even more overwhelming. Maybe you are one of the few that discovered your signature scent right when you first started exploring the world of perfumery, but maybe you are one of many still searching the fragrance halls of every department store growing ever increasingly confused about what you actually like.</p>
                     <h4>So, what is a signature scent?</h4>
                     <p class='my-3'>
                        A signature scent is a fragrance that truly defines you – it says exactly what you want it to say about you. You cannot get enough of the scent and whilst you may dabble in a new fragrance as you move through the seasons or your style changes over time, you find yourself going back to this specific scent time and time again - it never gets old.
                     </p>
                     <h4>How do you find your signature scent?</h4>
                     <p class='my-3'>
                        No matter what point in your perfume story you are at, it is never too late to find the star of your show. 
                        It may seem simple, but to ensure you never fall victim to purchasing yet another bottle of perfume that becomes more of a dust-collecting ornament than a staple in your beauty or grooming routine, be sure to test the fragrance before you purchase it. All too often we find ourselves giving a new fragrance a quick spritz onto a blotter and making a snap decision then and there as to whether we like it or not. Giving yourself time to really understand if you are going to enjoy the fragrance is the key to finding your signature scent.
                     </p>
                     <p>
                        Allow yourself time to really experience the whole fragrance, from the top notes that you immediately smell, right through to the deeper, longer lasting base notes. This takes time, so if you are testing fragrances in store, go get a coffee and let the scent develop over the next few hours before making a decision, paying attention to the different layers of scent that you are experiencing – often a perfume can smell very different after a few hours, so it would be unfair to judge it on the opening fragrance notes alone. 
                     </p>
                  </div>
               </div>
            </div>
            <!-- end => a guide for finding yout signature scent -->
            <!-- burberry her -->
            <div class="row">
               <div class="col-md-12">
                  <div class="best_main">
                     <div class="row d_flex">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                           <div class="best_text">
                              <?php 
                              $burberry_parfume_home = select_id("perfume", "id_perfume", 9);
                              
                              foreach($burberry_parfume_home as $burberry):
                              ?>

                              <h4 class='add-montez add-size'><?=$burberry->name?></h4>
                              <?php 
                                 $burberry_desc = explode("|", $burberry->description);
                                 //echo "<br/>";
                                 //var_dump($array_desc);
                              ?>
                              <p>
                                 <?=$burberry_desc[0]?>
                              </p>
                              <p>
                                 <?=$burberry_desc[1]?>
                              </p>
                              <ul class='about-perfume'>
                                 <li><?=$burberry_desc[2]?></li>
                                 <li><?=$burberry_desc[3]?></li>
                                 <li><?=$burberry_desc[4]?></li>
                              </ul>
                              <div class="col-lg-12 p-4">
                                 <a href="single-perfume.php?id=<?=$burberry->id_perfume?>" class='see-more-link'>See More</a>
                              </div>
                              
                           </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                         
                              <?php 
                                 $img_burberry = explode("|", $burberry->photo_src);
                                 //var_dump($img_home);
                              ?>
                              <figure><img src="images/<?= trim($img_burberry[1]) ?>" class='img-fluid'/></figure>
                              
                             
                              
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
                  </div>
                  </div>
                  <!-- end => burberry her -->
                  <!-- armani -->
                  <div class="best_main">
                     <div class="row d_flex">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                        
                           <?php 
                              $armani_acqua_home = select_id("perfume", "id_perfume", 3);
                              foreach($armani_acqua_home as $acqua):
                           ?>
                           
                                 <?php 
                                       $img_acqua = explode("|", $acqua->photo_src); 
                                       //var_dump($img_acqua);
                                 ?>
                              <figure><img src="images/<?= trim($img_acqua[1]); ?>" class='img-fluid'/></figure>
                          
                              
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                           <div class="best_text flot_left">
                              <h4 class='add-montez add-size mt-5'><?=$acqua->name?></h4>
                              <p>
                                 <?=$acqua->description?>
                              </p>
                              <a href="single-perfume.php?id=<?=$acqua->id_perfume?>" class='see-more-link'>See More</a>
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
                  <!-- /..armani -->
                  <!-- chanel -->
                  <div class="best_main pa_bot">
                     <div class="row d_flex">
                        <div class="col-xl-6">
                           <?php 
                              $coco_chanel_home = select_id("perfume", "id_perfume", 1);
                              foreach($coco_chanel_home as $chanel):
                           ?>
                           <div class="best_text">
                              <h4 class='add-size add-montez mt-5'><?=$chanel->name?></h4>
                              <p><?=$chanel->description?></p>
                              <a href="single-perfume.php?id=<?=$chanel->id_perfume?>" class='see-more-link'>See More</a>
                           </div>
                        </div>
                        <div class="col-xl-5 mt-5">
                           <div class="best_img d_none">
                              <?php 
                                 $img_chanel = explode("|", $chanel->photo_src);
                              ?>
                              <figure><img src="images/<?=trim($img_chanel[1])?>" class='img-fluid'/></figure>
                           </div>
                        </div>
                        <?php endforeach;?>
                     </div>
                  </div>
                  <!-- ../chanel -->
               </div>
            </div>
         </div>
      </div>
      <!-- dior -->
      <div class="best_main mt-5 pt-5">
         <div class="row d_flex">
            <div class="row d_flex">
               <?php 
                     $dior_home = select_id("perfume", "id_perfume", 4);
                     foreach($dior_home as $dior):
                  ?>
               <div class="col-xl-7  about_perfume">
                  
                  <div class="best_text">
                     <h4 class='add-size add-montez mt-5 mx-4'><?=$dior->name?></h4>
                     <p class=' mt-3 mx-4'>
                        <?php
                           $desc_dior = explode("|", $dior->description);
                           // var_dump($desc_dior);
                           $img_dior = explode("|", $dior->photo_src);
                        ?>
                        <?= $desc_dior[0] ?>
                     </p>
                     <p class='mt-3 mx-4'>
                        <?= $desc_dior[1] ?>
                     </p>
                     
                     <a href="single-perfume.php?id=<?=$dior->id_perfume?>" class='see-more-link mr-4 mt-3'>See More</a>
                  </div>
               </div>
               <div class="col-sm-5 mt-5">
                     <figure><img src="images/<?=trim($img_dior[1])?>" class='img-fluid'></figure>
               </div>
            </div>
            <?php endforeach; ?>
            
         </div>
      </div>
      <!-- ../dior -->
      <!-- end Best -->
      <!-- end -->
      <!-- CONTACT FORM -->
      <div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2 class='title-contact'>Leave us a Message</h2>
                  </div>
               </div>
            </div>
            <div class="row d-flex align-items-center justify-content-center">
               <div class="col-xl-8 d-flex align-items-center justify-content-center">
                  <div class="contact">
                     <form>
                        <div class="row">
                           <div class="col-sm-12">
                              <input class="contactus" placeholder="First name" type="text" name="firstName" id='first-name' />
                              <span class='spanInfo'></span>
                           </div>
                           <div class="col-sm-12">
                              <input class="contactus" placeholder="Last Name" type="text" name="lastName" id='last-name' />
                              <span class='spanInfo'></span>
                           </div>
                           <div class="col-sm-12">
                              <input class="contactus" placeholder="Email" type="text" name="email" id='email' />
                              <span class='spanInfo'></span>
                           </div>
                           <div class="col-sm-12">
                              <textarea class="textarea" placeholder="Message" type="text" name="messageContent" id='messageTextarea'></textarea>
                              <span class='spanInfo'></span>
                           </div>
                           <div class="col-sm-12">
                              <input type='submit' value='Send' class='send' id='btnSendMessage' name='btnSend' />
                           </div>
                           <p id="responseText"></p>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
   <!-- BRANDS -->
  <div class="container-fluid" id="brands">
    <div class="row">
    <div class="col-12 d-flex flex-row flex-wrap justify-content-center align-items-center">
         <?php 
               $brand_logos = select_all("brand");
               // var_dump($brand_logos);
               foreach($brand_logos as $brand):
            ?>
            <div class="brand brand-opacity col-xl-3 col-md-6 col-8 d-flex justify-content-center align-items-center">
              <img src="images/brand_logos/<?= $brand->brand_logo_src ?>" class='img-fluid' alt="<?= $brand->brand_name ?> logo" />
            </div>
          <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php include("fixed/footer.php"); ?>
   </body>
</html>