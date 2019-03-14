<?php
define("SITENAME", "Martin Marsvin");
define("JSONFILE", "data/pages.json");
define("JSONQUIZ", "data/quiz.json");
define("JSONANIMALS", "data/animals.json");
define("STARTPAGE", "landing");
define("SELFIE_DIR", "uploads/sealfies/");
define("QR_DIR", "uploads/qrScans/");
include_once('decoder/lib/QrReader.php');
ini_set('memory_limit', '10000M');
ini_set('max_execution_time', 3000);
$currentPage = GetCurrentPage();

function GetJsonData() {
    $content = file_get_contents(JSONFILE);
    $json = json_decode($content);
    return $json->pages;
}

function GetJsonQuiz() {
    $content = file_get_contents(JSONQUIZ);
    $json = json_decode($content);
    return $json->quiz;
}

function GetJsonAnimals() {
    $content = file_get_contents(JSONANIMALS);
    $json = json_decode($content);
    return $json->animals;
}

function metaTitle () {
$currentPage = GetCurrentPage();
echo SITENAME . " - " . $currentPage->title;    
}

function GetCurrentPage () {
    $currentPageId = STARTPAGE;
    if(isset($_GET["page"])) {
        $currentPageId = $_GET["page"];
    }
    $pages = GetJsonData();
        foreach ($pages as $page) {
            if($page->id == $currentPageId) {
                return $page;
            }
        }
}

function PrintCurrentPage () {
$currentPage = GetCurrentPage();
        if (isset($currentPage->sound)) {
           echo "<audio autoplay id='instrSound'><source src='" . $currentPage->sound . "' type='audio/mpeg'></audio>";
           }
        if (isset($currentPage->headerInc)) {
           include("inc/include/" . $currentPage->headerInc);
           }
        if (isset($currentPage->include)) {
           include("inc/include/" . $currentPage->include);
           }
        echo "<h1>" . $currentPage->headline . "</h1><main>";
        echo $currentPage->bodyText . "</main>";
}

function SetPlayerName () {
if (isset($_POST["playerName"]) && !empty($_POST["playerName"])) {
    echo "<script type='text/javascript'>
    document.cookie ='playerName=" . $_POST["playerName"] . "';</script>";
    echo "<script type='text/javascript'>
    window.location.href = '" . "?page=begin" . "';</script>";
    }
}

function CompressQR($sourceUrl, $destinationUrl, $quality) {

		$info = getimagesize($sourceUrl);

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($sourceUrl);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($sourceUrl);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($sourceUrl);

    		imagejpeg($image, $destinationUrl, $quality);
		return $destinationUrl;
	}

function SaveQRPicture () {
if (!empty($_FILES["qrScan"])) {
    $myFile = $_FILES["qrScan"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>Der skete en fejl.</p>";
        exit;
    }

    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(QR_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    $success = 
        CompressQR($myFile["tmp_name"],QR_DIR . $name,0);
//        move_uploaded_file($myFile["tmp_name"],QR_DIR . $name);
    if (!$success) { 
        echo "<p>Det lykkedes ikke at gemme filen.</p>";
        exit;
    }
if ($success) { 
    $qrcode = new QrReader(QR_DIR . $name);
    $text = $qrcode->text();
    if ($text==null) {
        echo "<script type='text/javascript'>
        window.location.href = 'error.php';</script>";
    }
    
    else {
        echo "<script type='text/javascript'>
        window.location.href = 'quiz.php?quiz=" . $text . "';</script>";
    }
    }
    chmod(QR_DIR . $name, 0644);
}
}

function SaveQRIntro () {
if (!empty($_FILES["qrScan"])) {
    $myFile = $_FILES["qrScan"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>Der skete en fejl.</p>";
        exit;
    }

    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(QR_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    $success = 
        CompressQR($myFile["tmp_name"],QR_DIR . $name,0);
//        move_uploaded_file($myFile["tmp_name"],QR_DIR . $name);
    if (!$success) { 
        echo "<p>Det lykkedes ikke at gemme filen.</p>";
        exit;
    }
if ($success) { 
    $qrcode = new QrReader(QR_DIR . $name);
    $text = $qrcode->text();
    
    if ($text==null) {
        echo "<script type='text/javascript'>
        window.location.href = 'index.php?page=error';</script>";
    }
    
    else {
        echo "<script type='text/javascript'>
        window.location.href = 'index.php?page=" . $text . "';</script>";
    }
    chmod(QR_DIR . $name, 0644);
}
}
}

function GetCurrentQuiz () {
    if(isset($_GET["quiz"])) {
        $currentQuizId = $_GET["quiz"];
    }
    $quiz = GetJsonQuiz();
        foreach ($quiz as $singleQuiz) {
            if($singleQuiz->id == $currentQuizId) {
                return $singleQuiz;
            }
        }
}

function PrintCurrentQuiz () {
$currentQuiz = GetCurrentQuiz();
    if (!isset($_COOKIE[$currentQuiz->id])) { 
//Intro
        echo "<div class='quiz'><audio autoplay id='introSnd'><source src='" . $currentQuiz->introSound . "' type='audio/mpeg'></audio>";
        echo "<div id='staticIntro'><div id='repeatButton'></div><h1>" . $currentQuiz->headline . "</h1>";
        echo "<img id='charPic' src='" . $currentQuiz->charPic . "'>";
        echo "</div><div id='quizIntro'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeatIntro()'>";
        echo $currentQuiz->bodyText;
        echo "<button onclick='startQuiz()'>Kom i gang!</button></div>";
//Spørgsmål 1
        echo "<audio id='sp1Sound'><source src='" . $currentQuiz->sp1Sound . "' type='audio/mpeg'></audio>";
        echo "<div id='question1'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeat1()'><p>" . $currentQuiz->question1 . "</p><br>";
        foreach ($currentQuiz->wrongAnswers1 as $wrongAnswer1) {
            echo "<button onclick='wrongAnswer()'>" . $wrongAnswer1 . "</button><br>";
            }
        echo "<button onclick='rightAnswer1()'>" . $currentQuiz->rightAnswer1 . "</button></div>";
    //Page for answer 1
        echo "<audio id='rightSound1'><source src='" . $currentQuiz->rightSound1 . "' type='audio/mpeg'></audio>";
        echo "<div id='rightAnswer1Page'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeatRight1()'><h2>" . $currentQuiz->rightAnswer1PageHeading . "</h2><p>" . $currentQuiz->rightAnswer1PageText . "</p><button onclick='nextQuestion1()'>Videre</button></div>";
    //Spørgsmål 2
        echo "<audio id='sp2Sound'><source src='" . $currentQuiz->sp2Sound . "' type='audio/mpeg'></audio>";
        echo "<div id='question2'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeat2()'><p>" . $currentQuiz->question2 . "</p><br>";
        foreach ($currentQuiz->wrongAnswers2 as $wrongAnswer2) {
            echo "<button onclick='wrongAnswer()'>" . $wrongAnswer2 . "</button><br>";
            }
        echo "<button onclick='rightAnswer2()'>" . $currentQuiz->rightAnswer2 . "</button></div>";
//Page for answer 2
        echo "<audio id='rightSound2'><source src='" . $currentQuiz->rightSound2 . "' type='audio/mpeg'></audio>";
        echo "<div id='rightAnswer2Page'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeatRight2()'><h2>" . $currentQuiz->rightAnswer2PageHeading . "</h2><p>" . $currentQuiz->rightAnswer2PageText . "</p><button onclick='nextQuestion2()'>Videre</button></div>";
// Spørgsmål 3
        echo "<audio id='sp3Sound'><source src='" . $currentQuiz->sp3Sound . "' type='audio/mpeg'></audio>";
        echo "<div id='question3'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeat3()'><p>" . $currentQuiz->question3 . "</p><br>";
        foreach ($currentQuiz->wrongAnswers3 as $wrongAnswer3) {
            echo "<button onclick='wrongAnswer()'>" . $wrongAnswer3 . "</button><br>";
            }
        echo "<button onclick='rightAnswer3()'>" . $currentQuiz->rightAnswer3 . "</button></div>";
// Page for answer 3
        echo "<audio id='rightSound3'><source src='" . $currentQuiz->rightSound3 . "' type='audio/mpeg'></audio>";
        echo "<div id='rightAnswer3Page'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeatRight3()'><h2>" . $currentQuiz->rightAnswer3PageHeading . "</h2><p>" . $currentQuiz->rightAnswer3PageText . "</p><button onclick='nextQuestion3()'>Videre</button></div>";
//Final page
        echo "<audio id='finalSound'><source src='" . $currentQuiz->finishSound . "' type='audio/mpeg'></audio>";
        echo "<div id='finishAnswerPage'><img src='assets/images/repeat2.png' id='repeatBtn' onclick='repeatFinal()'><h2>" . $currentQuiz->finishPageHeading . "</h2><p>" . $currentQuiz->finishPageText . "</p>
        <form id='form' action='' method='post' enctype='multipart/form-data'><input id='selfieCam' class='quizCam' type='file' capture='user' accept='image/*' name='" . $currentQuiz->id . "' onchange='submitSelfie()'><label for='selfieCam'>Til kameraet</label></form></div></div>";
        if (!empty($_FILES[$currentQuiz->id])) {
            SaveSelfieCam ();
            }
        }
    else {
        echo "<h1>Du har allerede svaret på spørgsmålene om" . " " . $currentQuiz->title . "</h1>";
        echo "<button onclick='goBack()'>Tilbage</button>";
    }
}

function metaQuizTitle () {
$currentQuiz = GetCurrentQuiz();;
echo SITENAME . " - " . $currentQuiz->title;    
}

function SaveSelfieCam () {
    $currentQuiz = GetCurrentQuiz();
    $myFile = $_FILES[$currentQuiz->id];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>Der skete en fejl.</p>";
        exit;
    }

    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(SELFIE_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    $success =
    move_uploaded_file($myFile["tmp_name"],SELFIE_DIR . $name);
    if (!$success) {
        echo "<p>Det lykkedes ikke at gemme filen.</p>";
        exit;
    }
if ($success) {
    echo "<script type='text/javascript'>
    document.cookie ='" . $currentQuiz->id . "=" . SELFIE_DIR . $name . "';</script>";
    echo "<script type='text/javascript'>
    window.location.href = '" . "main.php" . "';</script>";
    chmod(QR_DIR . $name, 0644);
    }
}

function SaveUserPicture () {
    if (!empty($_FILES["selfie"])) {
    $myFile = $_FILES["selfie"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>Der skete en fejl.</p>";
        exit;
    }

    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(QR_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    $success = 
    move_uploaded_file($myFile["tmp_name"],QR_DIR . $name);
    if (!$success) { 
        echo "<p>Det lykkedes ikke at gemme filen.</p>";
        exit;
    }
if ($success) { 
    setcookie("userPic", QR_DIR . $name);
    header('Location: ?page=profilePage');
    chmod(QR_DIR . $name, 0644);
    }
    }
    }

function GetCurrentAnimal () {
    if(isset($_GET["animal"])) {
        $currentAnimalId = $_GET["animal"];
    }
    $animals = GetJsonAnimals();
        foreach ($animals as $animal) {
            if($animal->id == $currentAnimalId) {
                return $animal;
            }
        }
}

function PrintCurrentAnimal () {
$currentAnimal = GetCurrentAnimal();
        echo "<h1>" . $currentAnimal->headline . "</h1>";
        echo "<div class='animalview'><img src='" . $_COOKIE[$currentAnimal->id] . "'height='150px'>";
        echo "<div class='info'>" . $currentAnimal->bodyText . "</div></div>";
}

function GoToQuiz () {
    echo "<script type='text/javascript'>
    window.location.href = 'quiz.php?quiz=" . $_POST["qrScan"] . "';</script>";
    
}

function GoFurther () {
    echo "<script type='text/javascript'>
    window.location.href = 'index.php?page=" . $_POST["qrScan"] . "';</script>";
    
}

?>