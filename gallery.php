<?php
    include("inc/functions.php");
    include("inc/head.php");
?>
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/instrScript.js"></script>
</head>
<body>
<?php 
    if (!isset($_GET['animal'])) {
        include("inc/galleryItems.php");
    }
    
    if (isset($_GET['animal'])) {
        include("inc/include/header.php");
        PrintCurrentAnimal ();
    }
?>

<?php include("inc/menuBar.php");?>
</body>
</html>