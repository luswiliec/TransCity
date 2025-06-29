<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Handle enquiry submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit1'])) {
    // Sanitize input
    $fname = trim($_POST['fname']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobileno']);
    $subject = trim($_POST['subject']);
    $description = trim($_POST['description']);

    try {
        $sql = "INSERT INTO tblenquiry (FullName, EmailId, MobileNumber, Subject, Description)
                VALUES (:fname, :email, :mobile, :subject, :description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $dbh->lastInsertId();
        $msg = $lastInsertId ? "Your enquiry has been submitted successfully." : null;
        $error = !$lastInsertId ? "Something went wrong. Please try again later." : null;
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TransCity Enquiry</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto+Condensed:400,700" rel="stylesheet">

  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script> new WOW().init(); </script>

  <style>
    body {
      background: #0d1117;
      font-family: 'Open Sans', sans-serif;
      color: #c9d1d9;
    }

    .privacy {
      background: #161b22;
      padding: 40px 0;
    }

    .enquiry {
      max-width: 600px;
      margin: 0 auto;
      background: rgba(22, 27, 34, 0.9);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    }

    .enquiry h3 {
      text-align: center;
      color: #58a6ff;
      margin-bottom: 25px;
    }

    .form-group label {
      font-weight: 600;
      color: #d9d9d9;
    }

    .form-control {
      background: #0d1117;
      border: 1px solid #30363d;
      color: #c9d1d9;
    }

    .form-control:focus {
      border-color: #58a6ff;
      box-shadow: none;
    }

    .btn-submit {
      background: #238636;
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 10px 20px;
      width: 100%;
      transition: background .3s ease;
    }

    .btn-submit:hover {
      background: #2ea043;
    }

    .alert {
      margin-top: 15px;
      border-radius: 4px;
    }
  </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="privacy">
  <div class="container">
    <form name="enquiry" method="post" class="enquiry">
      <h3 class="wow fadeInDown">Enquiry Form</h3>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><strong>Error:</strong> <?= htmlentities($error) ?></div>
      <?php elseif (!empty($msg)): ?>
        <div class="alert alert-success"><strong>Success:</strong> <?= htmlentities($msg) ?></div>
      <?php endif; ?>

      <div class="form-group">
        <label for="fname">Full Name</label>
        <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter your full name" required>
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter a valid email" required>
      </div>

      <div class="form-group">
        <label for="mobileno">Mobile Number</label>
        <input type="text" name="mobileno" class="form-control" id="mobileno" placeholder="10-digit number" maxlength="10" required>
      </div>

      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject of your enquiry" required>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="6" class="form-control" placeholder="Detailed description..." required></textarea>
      </div>

      <button type="submit" name="submit1" class="btn btn-submit">Submit Enquiry</button>
    </form>
  </div>
</div>

<?php include('includes/footer.php'); ?>
<?php include('includes/signup.php'); ?>
<?php include('includes/signin.php'); ?>
<?php include('includes/write-us.php'); ?>

</body>
</html>
