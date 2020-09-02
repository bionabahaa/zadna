/////login page hide and show password fnction/////
function show() {
var a=document.getElementById("pwd");
var b=document.getElementById("EYE");
if (a.type=="password")  {
a.type="text";
b.src="https://i.stack.imgur.com/waw4z.png";
}
else {
a.type="password";
b.src="https://i.stack.imgur.com/Oyk1g.png";
}
}
////////////////////////////