<!DOCTYPE html>
<?php
  require_once 'auth.php';
?>
<html lang="eng">
  <head>
    <title>Employee List | Employee Attendance Record System</title>
    <?php include('header.php') ?>
 <link rel="stylesheet" type="text/css" href="../assets/css/qr.css">
   <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
  </head>
  <body>
    <?php include('nav_bar.php') ?>
    <div class="container-fluid admin" >
      <div class="alert alert-primary">Generate Employee QR Code</div>
      <div class="modal fade" id="edit_student" tabindex="-1" role="dialog" aria-labelledby="myModallabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content panel-warning">
            <div class="modal-header panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModallabel">Edit Employee</h4>
            </div>
            <div id="edit_query"></div>
          </div>
        </div>
      </div>
 <div class="form" style="margin-top: 50px;">
  <h1>Employee QR Code</h1>
  <form>
    <input type="text" name="name" required="" placeholder="Employee Name" />
    <input type="text" id="website" name="emp" placeholder="Employee No" required />
    <button type="button" onclick="generateQRCode()" >
      Generate QR Code
    </button>
  </form>
  <div id="qrcode-container">
  <div id="qrcode-2" class="qrcode"></div>
  </div>
</div>
 </body>
 <script type="text/javascript">
    function generateQRCode() {
      let website = document.getElementById("website").value;
      if (website) {
        /*With some styles*/
        let qrcodeContainer2 = document.getElementById("qrcode-2");
        qrcodeContainer2.innerHTML = "";
        new QRCode(qrcodeContainer2, {
          text: website,
          width: 200,
          height: 200,
          correctLevel: QRCode.CorrectLevel.H
        });
        document.getElementById("qrcode-container").style.display = "block";
      } else {
        alert("Please enter a valid Employee No");
      }
    }
  </script>
</html>