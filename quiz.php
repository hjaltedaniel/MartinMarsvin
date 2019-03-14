<?php
    include("inc/functions.php");
    include("inc/head.php");
?>
    <title><?php metaQuizTitle(); ?></title>
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/quizScript.js"></script>
</head>
<body>
<audio id="wrongAudio">
    <source src="assets/sound/commands/Fejl/svaerfisk.mp3" type="audio/mpeg">
    <source src="assets/sound/commands/Fejl/fisk.mp3" type="audio/mpeg">
    <source src= "assets/sound/commands/Fejl/makrel.mp3" type="audio/mpeg">
    <source src= "assets/sound/commands/Fejl/fuglelfisk.mp3" type="audio/mpeg">
    <source src= "assets/sound/commands/Fejl/torsk.mp3" type="audio/mpeg">
</audio>
<?php 
PrintCurrentQuiz ();
?>
</body>
</html>