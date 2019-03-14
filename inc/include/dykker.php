<center><h2>Tillykke!<br> Du har fundet alle dyrene</h2></center>
    <br>
    <br>
    
    <center><img id="dykker" src="assets/images/dykker.JPG" alt="Dykker" width="80%" height="30%"></center>
    <br>
    <br>

    <center><h2>Find dykkeren for<br> at afslutte</h2></center>
<form id="form" action="" method="post" enctype="multipart/form-data">
<input type="file" id="qrScan1" name="qrScan" accept="image/*" capture="camera" onchange='submitSelfie()'><label for="qrScan1" onclick="playQRinstr()">Fortsæt</label></form>
<?php if (!empty($_FILES["qrScan"])) {SaveQRIntro (); } ?>