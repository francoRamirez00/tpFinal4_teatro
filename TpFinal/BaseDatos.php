﻿<?php
/* IMPORTANTE !!!!  Clase para (PHP 5, PHP 7)*/

class BaseDatos {
    private $HOSTNAME;
    private $BASEDATOS;
    private $USUARIO;
    private $CLAVE;
    private $CONEXION;
    private $QUERY;
    private $RESULT;
    private $ERROR;
    /**
     * Constructor de la clase que inicia ls variables instancias de la clase
     * vinculadas a la coneccion con el Servidor de BD
     */
    public function __construct(){
        $this->HOSTNAME = "127.0.0.1";
        $this->BASEDATOS = "bdteatro";
        $this->USUARIO = "root";
        $this->CLAVE="";
        $this->RESULT=0;
        $this->QUERY="";
        $this->ERROR="";
    }

    // metodos de acceso del atributo $HOSTNAME

    public function getHOSTNAME(){
        return $this->HOSTNAME;
    }

    public function setHOSTNAME($HOSTNAME){
        return $this->HOSTNAME=$HOSTNAME;
    }

    // metodos de acceso del atributo $BASEDATOS

    public function getBASEDATOS(){
        return $this->BASEDATOS;
    }

    public function setBASEDATOS($BASEDATOS){
        return $this->BASEDATOS=$BASEDATOS;
    }


    // metodos de acceso del atributo $USUARIO

    public function getUSUARIO(){
        return $this->USUARIO;
    }

    public function setUSUARIO($USUARIO){
        return $this->USUARIO=$USUARIO;
    }


    // metodos de acceso del atributo $CLAVE

    public function getCLAVE(){
        return $this->CLAVE;
    }

    public function setCLAVE($CLAVE){
        return $this->CLAVE=$CLAVE;
    }


    // metodos de acceso del atributo $CONEXION

    public function getCONEXION(){
        return $this->CONEXION;
    }

    public function setCONEXION($CONEXION){
        return $this->CONEXION=$CONEXION;
    }


    // metodos de acceso del atributo $QUERY

    public function getQUERY(){
        return $this->QUERY;
    }

    public function setQUERY($QUERY){
        return $this->QUERY=$QUERY;
    }


    // metodos de acceso del atributo $RESULT

    public function getRESULT(){
        return $this->RESULT;
    }

    public function setRESULT($RESULT){
        return $this->RESULT=$RESULT;
    }


    // metodos de acceso del atributo $ERROR
    /**
    * Funcion que retorna una cadena
    * con una peque�a descripcion del error si lo hubiera
    *
    * @return string
    */
    public function getError(){
        return "\n".$this->ERROR;
        
    }
    

    public function setERROR($ERROR){
        return $this->ERROR=$ERROR;
    }
    
    
    /**
     * Inicia la coneccion con el Servidor y la  Base Datos Mysql.
     * Retorna true si la coneccion con el servidor se pudo establecer y false en caso contrario
     *
     * @return boolean
     */
    public  function Iniciar(){
        $resp  = false;
        $conexion = mysqli_connect($this->getHOSTNAME(),$this->getUSUARIO(),$this->getCLAVE(),$this->getBASEDATOS());
        if ($conexion){
            if (mysqli_select_db($conexion,$this->getBASEDATOS())){
                $this->setCONEXION($conexion)  ;
                unset($this->QUERY);
                unset($this->ERROR);
                $resp = true;
            }  else {
                $this->ERROR = mysqli_error($conexion) . ": " .mysqli_error($conexion);
            }
        }else{
            $this->ERROR =  mysqli_error($conexion) . ": " .mysqli_error($conexion);
        }
        return $resp;
    }
    
    /**
     * Ejecuta una consulta en la Base de Datos.
     * Recibe la consulta en una cadena enviada por parametro.
     *
     * @param string $consulta
     * @return boolean
     */
    public function Ejecutar($consulta){
        $resp  = false;
        unset($this->ERROR);
        $this->setQUERY($consulta) ;
        if(  $this->RESULT = mysqli_query( $this->getCONEXION(),$consulta)){
            $resp = true;
        } else {
            $this->setERROR(mysqli_errno( $this->getCONEXION()).": ". mysqli_error( $this->getCONEXION()));
        }
        return $resp;
    }
    
    /**
     * Devuelve un registro retornado por la ejecucion de una consulta
     * el puntero se despleza al siguiente registro de la consulta
     *
     * @return boolean
     */
    public function Registro() {
        $resp = null;
        if ($this->getRESULT()){
            unset($this->ERROR);
            if($temp = mysqli_fetch_assoc($this->RESULT)){
                $resp = $temp;
            }else{
                mysqli_free_result($this->RESULT);
            }
        }else{
            $this->ERROR = mysqli_errno($this->CONEXION) . ": " . mysqli_error($this->CONEXION);
        }
        return $resp ;
    }
    
    /**
     * Devuelve el id de un campo autoincrement utilizado como clave de una tabla
     * Retorna el id numerico del registro insertado, devuelve null en caso que la ejecucion de la consulta falle
     *
     * @param string $consulta
     * @return int id de la tupla insertada
     */
    public function devuelveIDInsercion($consulta){
        $resp = null;
        unset($this->ERROR);
        $this->QUERY = $consulta;
        if ($this->RESULT = mysqli_query($this->getCONEXION(),$consulta)){
            $id = mysqli_insert_id($this->getCONEXION());
            $resp =  $id;
        } else {
            $this->ERROR =mysqli_errno( $this->CONEXION) . ": " . mysqli_error( $this->CONEXION);
           
        }
    return $resp;
    }
    
}
?>