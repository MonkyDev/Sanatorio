var t;
window.onload=resetTimer;
document.onkeypress=resetTimer;
document.onmousemove=resetTimer;
function logout(){
    alertify.alert("El inicio de session ha caducado...");
    window.location='logOut.php'; 
}
function resetTimer(){
    clearTimeout(t);
    t=setTimeout(logout,120000) 
}
