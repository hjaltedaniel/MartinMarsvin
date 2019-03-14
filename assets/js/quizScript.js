function startQuiz() {
    document.getElementById("quizIntro").style.display = "none";
    document.getElementById("question1").style.display = "block";
    var sp1Sound = document.getElementById("sp1Sound");
    sp1Sound.play();
}

function repeat1() {
    var sp1Sound = document.getElementById("sp1Sound");
    sp1Sound.play();
}

function repeat2() {
    var sp2Sound = document.getElementById("sp2Sound");
    sp2Sound.play();
}

function repeat3() {
    var sp3Sound = document.getElementById("sp3Sound");
    sp3Sound.play();
}

function repeatIntro() {
    var introSound = document.getElementById("introSnd");
    introSound.play();
}

function repeatRight1() {
    var rightSound1 = document.getElementById("rightSound1");
    rightSound1.play();
}

function repeatRight2() {
    var rightSound2 = document.getElementById("rightSound2");
    rightSound2.play();
}

function repeatRight3() {
    var rightSound3 = document.getElementById("rightSound3");
    rightSound3.play();
}

function repeatFinal() {
    var finalSound = document.getElementById("finalSound");
    finalSound.play();
}

function rightAnswer1() {
    sp1Sound.pause();
    document.getElementById("question1").style.display = "none";
    document.getElementById("rightAnswer1Page").style.display = "block";
    var rightSound1 = document.getElementById("rightSound1");
    rightSound1.play();
}

function nextQuestion1() {
    rightSound1.pause();
    document.getElementById("rightAnswer1Page").style.display = "none";
    document.getElementById("question2").style.display = "block";
    var sp2Sound = document.getElementById("sp2Sound");
    sp2Sound.play();
}

function rightAnswer2() {
    sp2Sound.pause();
    document.getElementById("question2").style.display = "none";
    document.getElementById("rightAnswer2Page").style.display = "block";
    var rightSound2 = document.getElementById("rightSound2");
    rightSound2.play();
}

function nextQuestion2() {
    rightSound2.pause();
    document.getElementById("rightAnswer2Page").style.display = "none";
    document.getElementById("question3").style.display = "block";
    var sp3Sound = document.getElementById("sp3Sound");
    sp3Sound.play();
}

function rightAnswer3() {
    sp3Sound.pause();
    document.getElementById("question3").style.display = "none";
    document.getElementById("rightAnswer3Page").style.display = "block";
    var rightSound3 = document.getElementById("rightSound3");
    rightSound3.play();
}

function nextQuestion3() {
    rightSound3.pause();
    document.getElementById("rightAnswer3Page").style.display = "none";
    document.getElementById("finishAnswerPage").style.display = "block";
    var finalSound = document.getElementById("finalSound");
    finalSound.play();
}

function wrongAnswer() {
    var wrongSound = document.getElementById("wrongAudio");
    wrongSound.play();
}