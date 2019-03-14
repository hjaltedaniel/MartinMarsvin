<body>
<form method="post" action="?page=QRdecoder" enctype="multipart/form-data">
  <input type="file" name="qrScan" accept="image/*" capture="camera">
  <input type="submit" value="Upload">
</form>
</body>

<?php
if (!empty($_FILES["qrScan"])) {
    SaveQRPicture ();
}
?>