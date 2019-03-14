function stopIntro() {
    var introStart = document.getElementById("instrSound");
    introStart.stop();
}

function repeat() {
    var repeatSound = document.getElementById("instrSound");
    repeatSound.play();
}

function playQRinstr() {
    var qrSound = document.getElementById("QRinstr");
    qrSound.play();
    var stopSound = document.getElementById("instrSound");
    stopSound.stop();
}

function toMap() {
    window.location.href = 'main.php';
}

function toReception() {
    window.location.href = 'index.php?page=reception';
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
    window.location.href = 'index.php';
}
