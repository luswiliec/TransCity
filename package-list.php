<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TransCity</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,700,600" rel="stylesheet" type="text/css">
  <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300" rel="stylesheet" type="text/css">
  <link href="//fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script>new WOW().init();</script>

  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background: #0d1117;
      margin: 0;
      color: #c9d1d9;
    }

    .banners {
      position: relative;
      width: 100%;
      height: 400px;
      overflow: hidden;
    }

    .banner-bg {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: filter 0.3s ease;
      z-index: 1;
    }

    .banners-text {
      position: relative;
      z-index: 2;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 0 15px;
    }

    .banners-text h1 {
      font-size: 32px;
      font-weight: 700;
      background: rgba(0,0,0,0.4);
      padding: 10px 20px;
      border-radius: 5px;
      color: #fff;
    }

    .holiday {
      margin-top: 0;
      padding-top: 20px;
    }

    .holiday h3 {
      font-weight: 700;
      margin-bottom: 30px;
      color: #ffffff;
      text-align: center;
    }

    .rom-btm {
      margin-bottom: 30px;
      background: #fff;
      border-radius: 6px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      overflow: hidden;
      display: flex;
      flex-wrap: wrap;
    }

    .room-left {
      text-align: center;
      padding: 20px;
      background: rgb(13, 33, 61);
      width: 100%;
    }

    .room-left img {
      width: 100%;
      height: auto;
    }

    .room-midle {
      padding: 20px;
      background: rgb(13, 33, 61);
      width: 100%;
    }

    .room-midle h4 {
      margin-top: 0;
      font-weight: 700;
      color: #007bff;
    }

    .room-right {
      text-align: center;
      padding: 20px;
      background: rgb(11, 43, 87);
      width: 100%;
    }

    .room-right h5 {
      font-weight: 700;
      margin-bottom: 15px;
      color: rgb(18, 25, 20);
    }

    .view {
      display: inline-block;
      padding: 8px 16px;
      background: #007bff;
      color: #fff;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    .view:hover {
      background: rgb(6, 210, 142);
    }

    .routes {
      background: #161b22;
      padding: 40px 0;
      margin-top: 40px;
      border-top: 1px solid #30363d;
    }

    .routes-left {
      text-align: center;
      margin-bottom: 20px;
    }

    .rou-left a {
      display: inline-block;
      font-size: 32px;
      color: #007bff;
      margin-bottom: 10px;
    }

    .rou-rgt h3 {
      font-weight: 700;
      color: #343a40;
    }

    .rou-rgt p {
      margin: 0;
      color: #6c757d;
    }

    @media (min-width: 768px) {
      .room-left, .room-midle, .room-right {
        width: 33.333%;
      }
    }

    @media (max-width: 768px) {
      .rom-btm {
        flex-direction: column;
      }

      .room-left, .room-midle, .room-right {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <?php include('includes/header.php'); ?>

  <!-- Banner with blur image on scroll -->
  <div class="banners">
    <img src="images/Lusaka2.jpg" alt="Banner" class="banner-bg">
    <div class="banners-text">
      <h1 class="wow zoomIn animated" data-wow-delay=".5s">TransCity</h1>
    </div>
  </div>

  <!-- Rooms Section -->
  <div class="rooms">
    <div class="container holiday">
      <div class="room-bottom">
        <h3 class="site-header">Bus Services</h3>

        <?php
        $sql = "SELECT * from tbltourpackages";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
          foreach ($results as $result) {
        ?>
        <div class="rom-btm">
          <div class="room-left wow fadeInLeft animated" data-wow-delay=".5s">
            <img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
          </div>
          <div class="room-midle wow fadeInUp animated" data-wow-delay=".5s">
            <h4><?php echo htmlentities($result->PackageName);?></h4>
            <h6>Type: <?php echo htmlentities($result->PackageType);?></h6>
            <p><b>Location:</b> <?php echo htmlentities($result->PackageLocation);?></p>
            <p><b>Features:</b> <?php echo htmlentities($result->PackageFetures);?></p>
          </div>
          <div class="room-right wow fadeInRight animated" data-wow-delay=".5s">
            <a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="view">Buy Ticket</a>
          </div>
        </div>
        <?php }} ?>
      </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>
  <?php include('includes/signup.php'); ?>			
  <?php include('includes/signin.php'); ?>			
  <?php include('includes/write-us.php'); ?>			

  <!-- JS to blur image on scroll -->
  <script>
    window.addEventListener('scroll', function () {
      const bannerImage = document.querySelector('.banner-bg');
      const scrollY = window.scrollY;
      const blurAmount = Math.min(scrollY / 50, 8); // max 8px blur
      bannerImage.style.filter = `blur(${blurAmount}px)`;
    });
  </script>
</body>
</html>
