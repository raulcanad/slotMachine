<?php

class Game{
    private $array_premios= array(
        "trebol" => 3,
        "picas" => 5,
        "corazones" => 4,
        "diamantes" => 2,
        "joker" => 10,
        //"coche" => 8,
        //"moto" => 7,
        //"furgoneta" => 12,
        //"bicicleta" => 2,
        //"patinete" => 14,
        //"caramelo" => 20,
        //"piruleta" => 1

    );
    private $date;
    private $user;

     function __construct($user) {
        $this->user= $user;
        $this->date = date('y-m-d h:i:s');
     }
     public function getDate(){
        return $this->date;
     }


     function resultado(){
        $array_resultados = Array();

        for($a=0;$a<3;$a++){
      
            array_push($array_resultados, array_rand($this->array_premios,1));     
        //$claves_aleatorias = array_rand($entrada, 2);
        //array_push($pila, "manzana", "arándano");
        }
      return $array_resultados;

     }

     function puntuacion($array_resultados){
        
            if ($array_resultados[0]==$array_resultados[1]&& 
                $array_resultados[0]==$array_resultados[2]){

                return $this->array_premios[$array_resultados[0]];
            
        }else{return -1;}

        
     }

     

     


}

?>