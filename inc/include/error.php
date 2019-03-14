<h1>Det lykkedes ikke at scanne QR koden.</h1>

<h2>Klik på kameraet nedenfor for at prøve igen, eller indsæt det korrekte id i boksen.</h2>

<form id="form" action="" method="post" enctype="multipart/form-data">
            <input type="text" id="quizID" name="qrScan">
            <button type="submit">Fortsæt</button></form>
            <?php if (!empty($_POST["qrScan"])) {
                GoFurther (); } ?>