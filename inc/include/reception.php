<audio src="assets/sound/intro/instr2.mp3" id="QRinstr"></audio>
<center><img id="reception" src="assets/images/reception.JPG" alt="reception" width="80%"></center>
<center><h1>Gå til receptionen!</h1></center>

<form id="form" action="" method="post" enctype="multipart/form-data">
<input type="file" id="qrScan1" name="qrScan" accept="image/*" capture="camera" onchange='submitSelfie()'><label for="qrScan1" onclick="playQRinstr()">Fortsæt</label></form>
<?php if (!empty($_FILES["qrScan"])) {SaveQRIntro (); } ?>