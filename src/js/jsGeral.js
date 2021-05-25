// DESKTOP
var btnProcurarPc = document.getElementsByClassName("btnsubmit")[0];
var inputBarraProcPc = document.getElementsByClassName("inputtext")[0];

btnProcurarPc.addEventListener("click", goToProcurarPagePc);
function goToProcurarPagePc() {
    if(inputBarraProcPc.value == ""){
        window.location.assign("procurajogo.php");
    }else{
        window.location.assign("procurajogo.php?n="+inputBarraProcPc.value);
    }
    
}

// MOBILE
var btnProcurarMobile = document.getElementsByClassName("btnsubmit")[1];
var inputBarraProcMobile = document.getElementsByClassName("inputtext")[1];

btnProcurarMobile.addEventListener("click", goToProcurarPageMobile);
function goToProcurarPageMobile() {
    if(inputBarraProcMobile.value == ""){
        window.location.assign("procurajogo.php");
    }else{
        window.location.assign("procurajogo.php?n="+inputBarraProcMobile.value);
    }
    
}

// menu lateral
var btnMenuLaterel = document.getElementById("btnmenu-mobile");
var MenuLaterel = document.getElementById("menulateral");
var MenuLaterelFechar = document.getElementById("menulateral-fechar");
var menuLateralAberto = false;

btnMenuLaterel.addEventListener("click",showMenuLateral);
function showMenuLateral(){
    MenuLaterel.style.display = "block";
}

MenuLaterelFechar.addEventListener("click",closeMenuLateral);
function closeMenuLateral(){
    MenuLaterel.style.display = "none";
}

closeMenuLateral();

// login lateral
var btnLoginLaterel = document.getElementById("btnlogin-mobile");
var LoginLaterel = document.getElementById("loginlateral");
var LoginLaterelFechar = document.getElementById("loginlateral-fechar");
var LoginLateralAberto = false;

btnLoginLaterel.addEventListener("click",showLoginLateral);
function showLoginLateral(){
    LoginLaterel.style.display = "block";
}

LoginLaterelFechar.addEventListener("click",closeLoginLateral);
function closeLoginLateral(){
    LoginLaterel.style.display = "none";
}

closeLoginLateral();