<h1><?php echo 'Velkommen' . ' ' . $_COOKIE["playerName"] . ',' . ' ' . 'tag et sælfie!'; ?></h1>

<form method="post" action="?page=namePage" enctype="multipart/form-data">
  <input type="file" name="selfie" accept="image/*" capture="user">
  <input type="submit" value="Upload">
</form>

<?php
if (!empty($_FILES["selfie"])) {
    SaveUserPicture ();
}
?>