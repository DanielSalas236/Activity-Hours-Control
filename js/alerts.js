

function alerta(){
    var typeId = document.getElementsByName('typeId');
var sexo =document.getElementsByName('sexo');
var fechaN = document.getElementsByName('nacimiento');
    if(typeId=='none'){
       swal({
  type: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href>Why do I have this issue?</a>'
})
       }else{
           swal({
  type: 'hahsahahdshadsd',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href>Why do I have this issue?</a>'
})
       }
}