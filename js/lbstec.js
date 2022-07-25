var x = document.getElementById("form1")
x.addEventListener("focus", myFocusFunction, true)
x.addEventListener("blur", myBlurFunction, true)

function numclick() {
    var valides = document.getElementById("hminutos").value
    if (valides > 59) {
        alert('O numero digitado não e valido para minutos.Favor verificar!!')
        numero = "00"
        document.getElementById("hminutos").value = numero
    }
    var validev = document.getElementById("minutos").value
    if (validev > 59) {
        alert('O numero digitado não e valido para minutos.Favor verificar!!')
        numero = "00"
        document.getElementById("minutos").value = numero
    }
    var valideh = document.getElementById("sai").value
    if (valideh > 23) {
        alert('O numero digitado não e valido para hora.Favor verificar!!')
        numero = "00"
        document.getElementById("sai").value = numero
    }
}

function myFocusFunction() {
    var valides = document.getElementById("hminutos").value
    if (valides > 59) {
        alert('O numero digitado não e valido para minutos.Favor verificar!!')
        numero = "00"
        document.getElementById("hminutos").value = numero
    }
    var validev = document.getElementById("minutos").value
    if (validev > 59) {
        alert('O numero digitado não e valido para minutos.Favor verificar!!')
        numero = "00"
        document.getElementById("minutos").value = numero
    }
    var valideh = document.getElementById("sai").value
    if (valideh > 23) {
        alert('O numero digitado não e valido para hora.Favor verificar!!')
        numero = "00"
        document.getElementById("sai").value = numero
        var tab = document.getElementById("td").value
        if (tab == 1) {
            alert('O numero digitado não e valido para hora.Favor verificar!!')
        }
    }
}

function myBlurFunction() {
    var valides = document.getElementById("hminutos").value
    if (valides > 59) {
        alert('O numero digitado não e valido para minutos.Favor verificar!!')
        numero = "0"
        document.getElementById("hminutos").value = numero
    }
    var validev = document.getElementById("minutos").value
    if (validev > 59) {
        alert('O numero digitado não e valido para minutos.Favor verificar!!')
        numero = "0"
        document.getElementById("minutos").value = numero
    }
    var valideh = document.getElementById("sai").value
    if (valideh > 23) {
        alert('O numero digitado não e valido para hora.Favor verificar!!')
        numero = "0"
        document.getElementById("sai").value = numero
    }
    var tab = document.getElementById()
    if (tab == 1) {
        alert('O numero digitado não e valido para hora.Favor verificar!!')
    }
}
var scrollTop = function() {
    window.scrollTo(0, 0);
};

function pagehome() {
    window.location.href = "cadastro.php";
}
function pagelogin() {
    window.location.href = "index.php";
}
function login() { window.location.href = "index.php" }