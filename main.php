<?php
if (isset($_COOKIE['seal']) && isset($_COOKIE['redspaet']) && isset($_COOKIE['crab']))  {
    
    echo "<script type='text/javascript'>
    window.location.href = 'index.php?page=dykker';</script>";
}
    include("inc/functions.php");
    include("inc/head.php");
?>
    <title>Martin Marsvin</title>
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/instrScript.js"></script>
</head>
<body>
<div class="map">
            <div class="themap">
                <img src="assets/images/map.png" width="95%">
            </div>
        </div>
<?php include("inc/menuBar.php");?>
</body>
</html>