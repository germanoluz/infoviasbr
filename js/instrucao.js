// JavaScript Document

function abrirPag(valor){
var url = valor;

xmlRequest.onreadystatechange = mudancaEstado;
xmlRequest.open("GET",url,true);
xmlRequest.send(null);

if (xmlRequest.readyState == 1) {
document.getElementById("QtdOcorrencias").innerHTML = "<img src='loader.gif'>";
}

return url;
}

function mudancaEstado(){
if (xmlRequest.readyState == 4){
document.getElementById("QtdOcorrencias").innerHTML = xmlRequest.responseText;
}
}