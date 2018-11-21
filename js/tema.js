var input = document.getElementById('otroAsunto');
var mensaje = document.getElementById('mensaje');
function carg(elemento) {
  d = elemento.value;
  
  if(d == "(Otro/s) "){
    input.disabled = false;
      input.placeholder="Ingrese el Asunto";
      input.type="text";
  }else{
    input.disabled = true;
    input.type="hidden";  
  }
    if(d==""){
       mensaje.disabled=true;
        mensaje.placeholder="Mensaje... Por favor seleccione un asunto";
       }else{
           mensaje.disabled=false;
           mensaje.placeholder="Mensaje..";
       }
}