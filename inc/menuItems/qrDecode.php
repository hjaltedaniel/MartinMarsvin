<form id="form" action="" method="post" enctype="multipart/form-data">
<input type="file" id="qrScan" name="qrScan" accept="image/*" capture="camera" onchange='submitSelfie()'><label for='qrScan'><img src="assets/images/kamera.png"></label></form>
<?php
if (!empty($_FILES["qrScan"])) {
    SaveQRPicture ();
}
?>