<?php
session_start();
error_reporting(0);

// Updated config and DB connection handling
try {
    include('includes/config.php'); // make sure this file sets $dbh
    $db_connected = isset($dbh) && $dbh !== null;
} catch (Exception $e) {
    $db_connected = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TransCity</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto+Condensed:300,400,700|Oswald" rel="stylesheet">

  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script> new WOW().init(); </script>

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

    .banners-slideshow {
      position: relative;
      width: 100%;
      height: 100%;
    }

    .slide-group {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 1.5s ease-in-out;
    }

    .slide-group.active {
      opacity: 1;
      z-index: 2;
    }

    .slide {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .slide-caption {
      position: absolute;
      bottom: 15%;
      left: 50%;
      transform: translateX(-50%);
      color: #fff;
      background: rgba(0, 0, 0, 0.4);
      padding: 15px 25px;
      font-size: 24px;
      font-weight: 600;
      border-radius: 6px;
      opacity: 0;
      transition: opacity 1.2s ease-in-out;
    }

    .slide-group.active .slide-caption {
      opacity: 1;
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

    .room-left, .room-midle, .room-right {
      padding: 20px;
      width: 100%;
    }

    .room-left {
      text-align: center;
      background: rgb(13, 33, 61);
    }

    .room-left img {
      width: 100%;
      height: auto;
    }

    .room-midle {
      background: rgb(13, 33, 61);
    }

    .room-midle h4 {
      margin-top: 0;
      font-weight: 700;
      color: #007bff;
    }

    .room-right {
      text-align: center;
      background: rgb(11, 43, 87);
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

    .rou-left a, .rou-left i {
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
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const slideGroups = document.querySelectorAll('.slide-group');
      let currentSlide = 0;

      function cycleSlides() {
        slideGroups[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slideGroups.length;
        slideGroups[currentSlide].classList.add('active');
      }

      slideGroups[currentSlide].classList.add('active');
      setInterval(cycleSlides, 4000);
    });
  </script>
</head>

<body>
<?php include('includes/header.php'); ?>

<div class="banners">
  <div class="banners-slideshow">
    <div class="slide-group">
      <img src="images/Mpulungu.jpg" alt="North" class="slide">
      <div class="slide-caption">Discover Northern Province’s Chishimba waterfalls</div>
    </div>
    <div class="slide-group">
      <img src="images/Kitwe.jpg" alt="Copperbelt" class="slide">
      <div class="slide-caption">Explore the thriving Copperbelt region</div>
    </div>
    <div class="slide-group">
      <img src="images/Lusaka2.jpg" alt="Lusaka" class="slide">
      <div class="slide-caption">Experience the heart of Lusaka</div>
    </div>
  </div>
</div>

<div class="container">
  <section class="holiday">
    <h3 class="site-header">Bus Service Providers</h3>

    <?php if ($db_connected && isset($dbh)): ?>
      <?php
      try {
          $sql = "SELECT * from tbltourpackages order by rand() limit 4";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount() > 0):
              foreach($results as $r):
      ?>
      <div class="rom-btm wow fadeInUp" data-wow-delay=".3s">
        <div class="room-left">
          <img src="admin/pacakgeimages/<?php echo htmlentities($r->PackageImage);?>" alt="">
        </div>
        <div class="room-midle">
          <h4><?php echo htmlentities($r->PackageName);?></h4>
          <h6>Type: <?php echo htmlentities($r->PackageType);?></h6>
          <p><b>Location:</b> <?php echo htmlentities($r->PackageLocation);?></p>
          <p><b>Features:</b> <?php echo htmlentities($r->PackageFetures);?></p>
        </div>
        <div class="room-right">
          <a href="package-details.php?pkgid=<?php echo htmlentities($r->PackageId);?>" class="view">Buy Ticket</a>
        </div>
      </div>
      <?php
              endforeach;
          else:
              echo "<p style='text-align:center;color:#ccc;'>No packages found at the moment.</p>";
          endif;
      } catch (PDOException $e) {
          echo "<p style='text-align:center;color:red;'>Database query failed: ".htmlentities($e->getMessage())."</p>";
      }
      ?>
    <?php else: ?>
      <p style="text-align:center;color:red;">Database is offline. Please start MySQL in XAMPP and reload the page.</p>
    <?php endif; ?>

    <div style="text-align:center; margin-top:20px;">
      <a href="package-list.php" class="view">View More</a>
    </div>
  </section>
</div>

<div class="routes">
  <div class="container">
    <div class="col-md-4 routes-left wow fadeInRight" data-wow-delay=".5s">
      <div class="rou-left"><i class="glyphicon glyphicon-list-alt"></i></div>
      <div class="rou-rgt"><h3>80,000</h3><p>Enquiries</p></div>
    </div>
    <div class="col-md-4 routes-left">
      <div class="rou-left"><i class="fa fa-user"></i></div>
      <div class="rou-rgt"><h3>1,900</h3><p>Registered Users</p></div>
    </div>
    <div class="col-md-4 routes-left wow fadeInRight" data-wow-delay=".5s">
      <div class="rou-left"><i class="fa fa-ticket"></i></div>
      <div class="rou-rgt"><h3>70,000,000+</h3><p>Bookings</p></div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
<?php include('includes/signup.php'); ?>
<?php include('includes/signin.php'); ?>
<?php include('includes/write-us.php'); ?>
</body>
</html>
