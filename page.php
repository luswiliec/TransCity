<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TransCity</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Styles & Fonts -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto+Condensed:300,400,700|Oswald" rel="stylesheet">
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script> new WOW().init(); </script>

  <style>
    body { margin:0; font-family:'Open Sans',sans-serif; background:#0d1117; color:#c9d1d9; }

    /* Sticky Header */
    .navbar { position: sticky; top: 0; z-index: 1000; background: #161b22; }

    /* Banner & Slideshow */
    .banners { position: relative; width:100%; height:400px; overflow:hidden; }
    .banner-img {
      position:absolute; top:0;left:0;width:100%;height:100%;
      object-fit:cover; opacity:0; transition: opacity 1s ease;
      z-index:1;
    }
    .banner-img.active { opacity:1; }
    .banners-text {
      position:relative; z-index:2;
      width:100%; height:100%;
      display:flex; align-items:center; justify-content:center;
      background:rgba(0,0,0,0.4);
    }
    .banners-text h1 { color:#fff; font-size:2rem; padding:15px 25px;
      border-radius:5px; text-align:center; }

    /* Blur on scroll */
    .blurred { filter: blur(8px); transition: filter 0.3s ease; }

    /* Message Section */
    .message-section {
      background: #001f4d; padding: 40px 0;
      color: #fff; text-align: center;
    }
    .message-section h2 { margin:0; font-size:1.8rem; }

    /* Services Section */
    .holiday { padding:30px 0; }
    .holiday h3 { text-align:center; color:#fff; margin-bottom:30px; }
    .rom-btm {
      background:#fff; border-radius:6px; margin-bottom:30px;
      box-shadow:0 2px 8px rgba(0,0,0,.1); overflow:hidden;
    }
    .rom-content { display:flex; flex-wrap:wrap; }
    .room-left, .room-midle, .room-right {
      padding:20px; width:100%;
    }
    @media(min-width:768px) {
      .room-left, .room-midle, .room-right { width:33.333%; }
    }
    .room-left { background:#0d213d; text-align:center; }
    .room-left img { width:100%; height:auto; }
    .room-midle { background:#0d213d; color:#fff; }
    .room-midle h4 { color:#007bff; }
    .room-right { background:#0b2b57; text-align:center; display:flex; align-items:center; justify-content:center; }
    .view {
      background:#007bff; color:#fff; padding:10px 20px;
      border-radius:4px; transition:background .3s;
    }
    .view:hover { background:#06d28e; }

    /* Footer */
    footer {
      background:#0d0f14; color:#c9d1d9; padding:40px 0;
    }
    .footer-container {
      display:flex; flex-wrap:wrap;
      justify-content:space-between; max-width:1200px; margin:0 auto;
    }
    .footer-col { flex:1; min-width:200px; margin:10px; }
    .footer-col h4 { margin-bottom:15px; }
    .footer-col ul { list-style:none; padding:0; }
    .footer-col li { margin-bottom:10px; }
    .footer-col a { color:#c9d1d9; }
    .footer-col a:hover { text-decoration:underline; }
    .footer-bottom { text-align:center; margin-top:20px; font-size:.9rem; }
  </style>
</head>
<body>

  <?php include('includes/header.php'); ?>

  <!-- Banner with Slideshow -->
  <div class="banners">
    <?php
      $slides = ['Kapiri.jpg','Copperbelt.jpg','Lusaka2.jpg'];
      foreach ($slides as $i=>$img): ?>
      <img src="images/<?= $img ?>" class="banner-img <?= $i===0? 'active':''; ?>" alt="Slide">
    <?php endforeach; ?>
    <div class="banners-text wow zoomIn" data-wow-delay=".5s">
      <h1>This page is strictly restricted by Mr. Evans for security purposes but if you are bored, feel free to watch the sliding pictures in the background.</h1>
    </div>
  </div>

  <!-- Message Section -->
  <div class="message-section">
    <div class="container">
      <h2>Welcome to TransCity – Your trusted partner for safe, secure, and seamless travel.</h2>
    </div>
  </div>

  <!-- Services Section -->
  <!--<div class="container holiday">
    <h3>Bus Services</h3>
    <?php
      $sql = "SELECT * FROM tbltourpackages ORDER BY RAND() LIMIT 4";
      $query = $dbh->prepare($sql); $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      foreach ($results as $r):
    ?>
      <div class="rom-btm wow fadeInUp">
        <div class="rom-content">
          <div class="room-left wow fadeInLeft">
            <img src="admin/pacakgeimages/<?= htmlentities($r->PackageImage) ?>" alt="<?= htmlentities($r->PackageName) ?>">
          </div>
          <div class="room-midle wow fadeInUp">
            <h4><?= htmlentities($r->PackageName) ?></h4>
            <h6>Type: <?= htmlentities($r->PackageType) ?></h6>
            <p><b>Location:</b> <?= htmlentities($r->PackageLocation) ?></p>
            <p><b>Features:</b> <?= htmlentities($r->PackageFetures) ?></p>
          </div>
          <div class="room-right wow fadeInRight">
            <a href="package-details.php?pkgid=<?= htmlentities($r->PackageId) ?>" class="view">Buy Ticket</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div> -->

  <?php include('includes/footer.php'); ?>


  <!-- Signup/Signin/Write-us modals -->
  <?php include('includes/signup.php'); ?>
  <?php include('includes/signin.php'); ?>
  <?php include('includes/write-us.php'); ?>

  <!-- JS: slideshow + blur effect -->
  <script>
    $(document).ready(function(){
      let slides = $('.banner-img'), idx = 0;
      setInterval(() => {
        slides.eq(idx).fadeOut(1000).removeClass('active');
        idx = (idx+1)%slides.length;
        slides.eq(idx).fadeIn(1000).addClass('active');
      }, 4000);

      $(window).on('scroll', function(){
        let blur = Math.min($(window).scrollTop()/50, 8);
        $('.banner-img').css('filter', 'blur('+blur+'px)');
      });
    });
  </script>
</body>
</html>
