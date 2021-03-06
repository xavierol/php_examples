<?php
class VehiculoModel{
    //PROPIEDADES
    public $matricula, $modelo, $color, $precio_venta, $precio_compra, $kms, $caballos;
    public  $estado, $any_matriculacion, $detalles, $imagen, $marca;
    
    //METODOS
    //guarda el vehiculo en la BDD
    public function guardar(){
        //$vehiculos_table = Config::get()->db_vehiculos_table;
        $consulta = "INSERT INTO vehiculos(matricula, modelo, color, precio_venta, precio_compra, kms, caballos, estado, any_matriculacion, detalles, imagen, marca)
			VALUES ('$this->matricula','$this->modelo','$this->color','$this->precio_venta','$this->precio_compra','$this->kms','$this->caballos','$this->estado','$this->any_matriculacion','$this->detalles','$this->imagen','$this->marca');";
        
        echo $consulta;
        
        return Database::get()->query($consulta);
    }
         
  
    //PARA EL LISTADO DE VEHICULOS
    
    //método que me recupere todas los vehiculos
    //PROTOTIPO: public static array<VehiculosModel> getVehiculos()
    public static function getVehiculos(){
        //preparar la consulta
        $consulta = "SELECT * FROM vehiculos;";
        
        //conecto a la BDD y ejecuto la consulta
        $conexion = Database::get();
        $resultados = $conexion->query($consulta);
        
        //creo la lista de VehiculosModel
        $lista = array();
        while($vehiculo = $resultados->fetch_object('VehiculoModel'))
            $lista[] = $vehiculo;
            
        //liberar memoria
        $resultados->free();
        
        //retornar la lista de RecetaModel
        return $lista;
    }
  
    
    
    //Método que me recupera un vehiculo a partir de su ID
    //PROTOTIPO: public static VehiculoModel getVehiculo(number $id=0);
    public static function getVehiculo($id=0){
        //preparar consulta
        $consulta = "SELECT * FROM vehiculos WHERE id=$id;";
        
        //ejecutar consulta
        $conexion = Database::get();
        $resultado = $conexion->query($consulta);
        
        //si no había resultados, retornamos NULL
        if(!$resultado) return null;
        
        //convertir el resultado en un objeto RecetaModel
        $vehiculo = $resultado->fetch_object('VehiculoModel');
        
        //liberar memoria
        $resultado->free();
        
        //devolver el resultado
        return $vehiculo;
    }
    
    //Método que actualiza los datos del vehículo en la BDD
    //PROTOTIPO: public boolean actualizar();
    public function actualizar(){
        $consulta = "UPDATE vehiculos
                           SET matricula='$this->matricula',
                              modelo='$this->modelo',
                              color='$this->color',
                              precio_venta='$this->precio_venta',
                              precio_compra=$this->precio_compra',
                              fecha_venta='$this->fecha_venta',
                              estado='$this->estado',
                              any_matriculacion='$this->any_matriculacion',
                              detalles=$this->detalles',
                              imagem='$this->imagen',
                              vendedor='$this->vendedor',
                              marca='$this->marca',
                                tiempo=$this->tiempo
                          WHERE id=$this->id;";
        return Database::get()->query($consulta);
    }
    
    //Método que borra una receta de la BDD (estático)
    //PROTOTIPO: public static boolean borrar(int $id)
    public static function borrar($id){
        $consulta = "DELETE FROM vehiculos
                         WHERE id=$id;";
        
        $conexion = Database::get(); //conecta
        $conexion->query($consulta); //ejecuta consulta
        return $conexion->affected_rows; //devuelve el num de filas afectadas
    }
    
}
?>