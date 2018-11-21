<?php
class GenerarPass{
    
    private $cadena;
    private $longitud;
    private $pass;
    
    public function _construct(){
        $this->cadena = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this->pass = '';
    }
//    public function NewPass($long){
//        $lng_cadena = strlen($this->cadena);
//        $this->longitud = $long;
//        for ($i=1;$i<=$this->longitud;$i++){
//            $aleatorio = mt_rand(0,$lng_cadena-1);
//            $this->pass .= substr($this->cadena,$aleatorio,1);
//        }
//        return $this->pass;
//    }
    function NewPass($length) {
    $this->cadena = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($this->cadena);
    $this->pass = '';
    for ($i = 0; $i < $length; $i++) {
        $this->pass .= $this->cadena[rand(0, $charactersLength - 1)];
    }
    return $this->pass;
}
    
}
?>