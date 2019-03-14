    <div class="menucontainer">
        <div class="menubaricons">
            <center><a href="gallery.php" ><img src="assets/icons/fotoakvarium_btn.png" alt="fotoalbum" height="40px" width="40px"></a></center>
            
            <center><form id="form" action="" method="post" enctype="multipart/form-data">
            <input type="file" id="qrScan" name="qrScan" accept="image/*" capture="camera" onchange='submitSelfie()'><label for='qrScan'><img src="assets/icons/qr_btn.png" alt="QRscanner" height="40px" width="40px"></label></form></center>
            <?php if (!empty($_FILES["qrScan"])) {
                SaveQRPicture (); } ?>
            <center><a href="main.php" ><img src="assets/icons/map_btn.png" alt="map" height="40px" width="40px"></a></center>
        </div>
    </div> 