<?php
session_start();
if (isset($_POST['signin'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $sql = "SELECT EmailId,Password FROM tblusers WHERE EmailId=:email and Password=:password";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  if ($query->rowCount() > 0) {
    $_SESSION['login'] = $_POST['email'];
    echo "<script>location.href = 'package-list.php';</script>";
  } else {
    echo "<script>alert('Invalid Details');</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>TransCity</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: rgb(11, 26, 43);
    }
    .site-header {
      position: sticky;
      top: 0;
      z-index: 999;
      background-color: #007bff;
      color: #fff;
      padding: 15px 0;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      font-family: 'Roboto Condensed', sans-serif;
      transition: all 0.3s ease;
    }
    .site-header.shrink { padding: 8px 0; }
    .site-header .container {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      position: relative;
    }
    .menu-toggle {
      margin-top: -17px;
      display: none;
      background: none;
      border: none;
      cursor: pointer;
      padding-left: 0px;
      transition: transform 0.3s ease-in-out;
      position: relative;
    }
    .menu-toggle span {
      display: block;
      width: 22px;
      height: 3px;
      margin: 4px 0;
      background: #fff;
      transition: all 0.3s ease;
    }
    .menu-toggle.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    }
    .menu-toggle.active span:nth-child(2) {
      opacity: 0;
    }
    .menu-toggle.active span:nth-child(3) {
      transform: rotate(-45deg) translate(5px, -5px);
    }
    .branding {
      margin-left: 15px;
      flex-shrink: 0;
    }
    .site-title {
      margin: 5px;
      font-size: 28px;
      font-weight: 700;
    }
    .site-tagline {
      margin: 5;
      font-size: 14px;
      font-weight: 400;
      opacity: 0.85;
      margin-top: 4px;
    }
    .main-nav {
      margin-left: auto;
      position: relative;
      display: flex;
      align-items: center;
      gap: 20px;
    }
    .main-nav ul {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
      gap: 20px;
    }
    .main-nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      font-size: 15px;
      padding: 6px 8px;
      border-radius: 4px;
      transition: background 0.3s ease;
    }
    .main-nav ul li a:hover,
    .main-nav ul li a:focus {
      background-color: #0056b3;
    }
    .main-nav ul li a.admin-login {
      background: #ffc107;
      color: #000;
      font-weight: 700;
    }
    .main-nav ul li a.admin-login:hover {
      background: #e0a800;
    }
    .auth-links {
      display: flex;
      gap: 10px;
    }
    .auth-links a {
      padding: 6px 12px;
      border-radius: 4px;
      font-weight: 600;
      font-size: 14px;
      text-decoration: none;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }
    .auth-links .signin {
      background-color: #fff;
      color: #007bff;
    }
    .auth-links .signin:hover {
      background-color: #e2e6ea;
    }
    .auth-links .signup {
      background-color: #28a745;
      color: #fff;
    }
    .auth-links .signup:hover {
      background-color: #218838;
    }
    @media (max-width: 1024px) {
      .menu-toggle { display: block; }
      .main-nav { flex-direction: column; align-items: flex-start; }
      .main-nav ul {
        flex-direction: column;
        background: #007bff;
        border-radius: 4px;
        padding: 10px 0;
        display: none;
        width: max-content;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        margin-top: 10px;
      }
      .main-nav.active ul { display: flex; }
      .main-nav ul li a {
        display: block;
        padding: 10px 16px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
      }
      .auth-links {
        flex-direction: column;
        margin-top: 10px;
        margin-left: 10px;
      }
    }
    .modal-backdrop.show {
      backdrop-filter: blur(20px);
      background-color: rgba(0, 0, 50, 0.5);
    }
    .modal.fade .modal-dialog {
      transform: scale(0.7);
      transition: transform 0.35s ease-out;
    }
    .modal.fade.in .modal-dialog,
    .modal.fade.show .modal-dialog {
      transform: scale(1);
    }
    .modal-content.modal-info {
      background: rgba(0, 47, 95, 0.95);
      border-radius: 8px;
      border: none;
      color: #fff;
    }
    .modal-content.modal-info input {
      background: #fff;
      color: #000;
      border-radius: 4px;
      padding: 10px;
      border: none;
      width: 100%;
      margin-bottom: 12px;
    }
    .modal-content.modal-info input[type="submit"] {
      background: #28a745;
      color: #fff;
    }
    .modal-content.modal-info .create-account-btn {
      background: #007bff;
      color: #fff;
    }
    .modal-content.modal-info .create-account-btn:hover {
      background: #0056b3;
    }
    .modal-header .close {
      color: #fff;
      opacity: 1;
    }
  </style>
  <script>
    window.addEventListener('scroll', function () {
      const header = document.querySelector('.site-header');
      header.classList.toggle('shrink', window.scrollY > 50);
    });

    $(document).ready(function () {
      $('#menuToggle').click(function () {
        $(this).toggleClass('active');
        $('.main-nav').toggleClass('active');
      });

      $('.signin').click(function () {
        $('#myModal4').modal('show');
      });

      $('.signup').click(function () {
        $('#signupModal').modal('show');
      });
    });
  </script>
</head>
<body>
<header class="site-header">
  <div class="container">
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
      <span></span><span></span><span></span>
    </button>
    <div class="branding">
      <h1 class="site-title">TransCity</h1>
      <p class="site-tagline">Gateway to ticket booking</p>
    </div>
    <nav class="main-nav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="page.php?type=aboutus">About</a></li>
        <li><a href="package-list.php">Tickets</a></li>
        <li><a href="page.php?type=privacy">Privacy Policy</a></li>
        <li><a href="page.php?type=terms">Terms of Use</a></li>
        <li><a href="page.php?type=contact">Contact Us</a></li>
        <?php if ($_SESSION['login']) { ?>
          <li><a href="#" data-toggle="modal" data-target="#myModal3">Need Help? / Write Us</a></li>
        <?php } else { ?>
          <li><a href="enquiry.php">Enquiry</a></li>
        <?php } ?>
        <li><a href="admin/index.php" class="admin-login">Login as Admin</a></li>
      </ul>
      <div class="auth-links">
        <a class="signin">Sign In</a>
        <a class="signup">Sign Up</a>
      </div>
    </nav>
  </div>
</header>

<!-- Login Modal -->
<div class="modal fade" id="myModal4" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-info">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Sign In to Your Account</h3>
        <form method="post">
          <input type="text" name="email" placeholder="Enter your Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" name="signin" value="Sign In">
        </form>
        <button class="create-account-btn" onclick="$('#myModal4').modal('hide'); $('#signupModal').modal('show');">Create an Account</button>
      </div>
    </div>
  </div>
</div>

<!-- Sign Up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-info">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Create a New Account</h3>
        <form method="post" action="register.php">
          <input type="text" name="fullname" placeholder="Full Name" required>
          <input type="email" name="email" placeholder="Email Address" required>
          <input type="text" name="mobile" placeholder="Mobile Number" required maxlength="10">
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
          <input type="submit" name="signup" value="Sign Up">
        </form>
        <p class="text-center" style="margin-top: 10px;">
          Already have an account?
          <a href="#" onclick="$('#signupModal').modal('hide'); $('#myModal4').modal('show');" style="color: #add8ff;">Sign In</a>
        </p>
      </div>
    </div>
  </div>
</div>
</body>
</html>
