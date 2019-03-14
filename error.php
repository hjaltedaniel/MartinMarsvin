<?php
    include("inc/functions.php");
    include("inc/head.php");
?>
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/instrScript.js"></script>
</head>
<body>

<h1>Det lykkedes ikke at scanne QR koden.</h1>

<h2>Klik på kameraet nedenfor for at prøve igen, eller indsæt det korrekte quiz-id i boksen.</h2>

<form id="form" action="" method="post" enctype="multipart/form-data">
            <input type="text" id="quizID" name="qrScan">
            <button type="submit">Gå til quizzen</button></form></center>
            <?php if (!empty($_POST["qrScan"])) {
                GoToQuiz (); } ?>

<?php include("inc/menuBar.php");?>
</body>
</html>