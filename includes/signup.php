<?php
session_start();
if(isset($_POST['signin'])) {
  // existing PHP login logic
}
?>

<style>
  .modal-backdrop.show {
    backdrop-filter: blur(5px);
    background-color: rgba(0, 0, 50, 0.5);
  }
  .modal.fade .modal-dialog {
    transform: scale(0.7);
    transition: transform 0.35s ease-out;
  }
  .modal.fade.show .modal-dialog {
    transform: scale(1);
  }
  .modal-content.modal-info {
    background: rgba(0, 47, 95, 0.95);
    border-radius: 8px;
    border: none;
    color: #fff;
  }
  .modal-content.modal-info input[type="text"],
  .modal-content.modal-info input[type="password"] {
    background: #fff;
    color: #000;
    border-radius: 4px;
    padding: 10px;
    border: none;
    width: 100%;
    margin-bottom: 12px;
  }
  .modal-content.modal-info input[type="submit"],
  .modal-content.modal-info .create-account-btn {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
  }
  .modal-content.modal-info input[type="submit"] {
    background: #28a745;
    color: #fff;
    margin-bottom: 10px;
  }
  .modal-content.modal-info input[type="submit"]:hover {
    background: #218838;
  }
  .modal-content.modal-info .create-account-btn {
    background: #007bff;
    color: #fff;
    text-align: center;
  }
  .modal-content.modal-info .create-account-btn:hover {
    background: #0056b3;
  }
  .modal-header .close {
    color: #fff;
    opacity: 1;
  }
</style>

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
        <button class="create-account-btn" onclick="window.location.href='signup.php'">Create an Account</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#myModal4').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
  });
</script>
