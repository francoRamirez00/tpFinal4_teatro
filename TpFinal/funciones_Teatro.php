<?php
include_once 'BaseDatos.php';
// include_once 'teatro.php';
class funciones_Teatro{

	private $idFuncion;
    private $nombre ;
    private $hora_inicio ;
    private $duracion ;
    private $precio ;
    private $objTeatro;
    

    public function __construct()
    {
        $this-> idFuncion="";
        $this-> nombre =  "";
        $this-> hora_inicio=""  ;
        $this-> duracionObra ="" ;
        $this-> precio = "" ;
        $this-> objTeatro= null;// new Teatro();
        
    }


    public function cargar($array){	
        $this->setIdFuncion($array['idFuncion'])	;
		$this->setNombre($array['nombreFuncion']);
        $this->setHora_inicio($array['horaInicio']);
		$this->setDuracion($array ['duracion']);
		$this->setPrecio($array ['precioPublico']);
        $this->setObjTeatro($array ['objTeatro']);
    }



    // metodos de aaceso del atributo $IdFuncion
    public function getIdFuncion(){

        return $this->idFuncion;
    }
    public function setIdFuncion($idFuncion){
        return $this->idFuncion=$idFuncion;
    }


     // metodos de aaceso del atributo $nombre
    public function getNombre(){

        return $this->nombre ;
    }
    public function setNombre($nombre){

        return $this->nombre=$nombre ;
    }


     // metodos de aaceso del atributo $hora_inicio
    public function getHora_inicio(){

        return $this->hora_inicio ;
    }
    public function setHora_inicio($hora_inicio){

        return$this-> hora_inicio = $hora_inicio ;
    }

    // metodos de aaceso del atributo $duracion 
    public function getDuracion(){

        return $this->duracion ;
    }
    public function setDuracion($duracion){

        return$this->duracion = $duracion ;
    }


    // metodos de aaceso del atributo  $precio
    public function getPrecio(){

        return $this->precio ;
    }
    public function setPrecio($precio){

        return$this->precio = $precio ;
    }


    // metodos de aaceso del atributo $objTeatro
    public function getObjTeatro(){

        return $this->objTeatro;
    }
    public function setObjTeatro($objTeatro){
        
        return $this->objTeatro=$objTeatro; 
    }



    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
    public function setmensajeoperacion($mensajeoperacion){
		return $this->mensajeoperacion=$mensajeoperacion;
	}
    
  



    public function Buscar($id){
		$base= new BaseDatos();
		$consultaPersona="SELECT * FROM funciones_Teatro WHERE idFuncion=".$id;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){	

				     $this->setIdFuncion($id);
					// $this->setIdFuncion($row2['idFuncion']);
					$this->setNombre($row2['nombreFuncion']);
					$this->setHora_inicio($row2['horaInicio']);
					$this->setDuracion($row2['duracion']);
                    $this->setPrecio($row2['precioPublico']);
					
                    $idTeatro= ($row2['idTeatro']);
                    $objTeatro= new Teatro();
                    $objTeatro->Buscar($idTeatro);
                    $this->setObjTeatro($objTeatro);
					$resp= true;

				}				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	


    public function listar($condicion=""){
	    $arregloFunciones =null;
		$base=new BaseDatos();
		$consultaPersonas="SELECT * FROM funciones_teatro ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' WHERE '.$condicion;
		}
		$consultaPersonas.=" order by idFuncion ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloFunciones= array();
				while($row2=$base->Registro()){

					
				
				
					$idTeatro=$row2['idTeatro'];
				
				
					
				
					$func= new funciones_Teatro();
					$func->Buscar($idTeatro);
					// $func->cargar($row2);
					array_push($arregloFunciones,$func);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloFunciones;
	}	



    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
        $objTeatro = $this->getObjTeatro();
		$idTeatro= $objTeatro-> getidTeatro();
		$consultaInsertar="INSERT INTO funciones_teatro(nombreFuncion,idFuncion, idTeatro, horaInicio, duracion, precioPublico) 
				VALUES ('".$this->getNombre()."',".$this->getIdFuncion().",".$idTeatro.",'".$this->getHora_inicio()."',".$this->getDuracion().",". $this->getPrecio().")";
		// echo $consultaInsertar;
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){
				//  $id=$base->devuelveIDInsercion($consultaInsertar)
				// $this->setIdFuncion($id);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}



    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
        $objTeatro=$this->getObjTeatro();
		$consultaModifica="UPDATE funciones_teatro SET nombreFuncion='".$this->getNombre().",idTeatro='".$objTeatro->getidTeatro()."',horaInicio=".$this->getHora_inicio().",duracion='".$this->getDuracion()."',precioPublico='".$this->getPrecio()."' WHERE idFuncion=". $this->getIdFuncion();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				
			}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}
	
	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM funciones_teatro WHERE idFuncion=".$this->getIdFuncion();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

	


	public function darCostos_funciones(){

        $costo= $this->getPrecio();

        return $costo;
    }

    
    

    


    public function __toString()
    {	
        return "\nid Funcion: ".$this->getIdFuncion(). "\n nombre : " . $this->getNombre(). "\n". "hora de inicio(h.m) : ". $this->getHora_inicio(). "hs \n". "duracion(h.m) : ". $this->getDuracion(). "hs \n". "precio : ". $this->getPrecio() ;
            
    }


}

/*$datos =new funciones_Teatro("nombre_F0",19,1,150) ;
echo $datos ;*/