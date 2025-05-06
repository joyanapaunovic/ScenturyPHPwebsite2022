<?php include("config/connection.php"); ?>
<?php include("models/functions.php");?>
<?php 
   // dohvacene potrebne kolone 
   $brands = select_all("brand");
   $categories = select_all("category");
   $perfumes = select_all("perfume");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- ***META*** -->
      <!-- basic -->
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>
      <!-- site metas -->
      <title> 
         The Scentury 
      </title>

      <meta name="keywords" content=""/>
      <meta name="description" content=""/>
      <meta name="author" content=""/>
      <!-- ***LINK*** -->
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css"/>
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css"/>
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css"/>
      <!-- favicon -->
     <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
     <!-- font awesome icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css"/>
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"/>
      <!--[if lt IE 9]-->
      <!-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> -->
      <!--[endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">