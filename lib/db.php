<?
class DB_mysql
{
    //identificador de conexión y consulta

    var $Conexion_ID = 0;
    var $Consulta_ID = 0;
    var $UsuarioLOG="";
    var $log=false;
    var $logSELECT=false;
	 // aqui se pondrán los valores en la instalacion
	var $BaseDatos=  "xxxx1xxxx";
	var $Servidor =  "xxxx2xxxx";
    var $Usuario =   "xxxx3xxxx";
    var $Clave =     "xxxx4xxxx";
    var $Prefijo =   "xxxx5xxxx";
	//fin de valores de bbdd

    //número de error y texto error

    var $Errno = 0;
    var $Error = "";
    var $tipo="utf8";

    // Método Constructor: Cada vez que creemos una variable
    // de esta clase, se ejecutará esta función
    public function __construct($usuario="") {
        $this->DB_mysql($usuario);
    }
    function DB_mysql($usuario="")
    {
        $this->UsuarioLOG=$usuario;
       
       
    
    }
    function logear($texto,$accion,$detalle=""){
         $sentenciaLOG="insert into ".$this->Prefijo."log (usuario,fecha,texto,accion,detalle) values (
		 '".$this->UsuarioLOG."',now(),'".$texto."',
		 '".mysqli_real_escape_string($this->Conexion_ID,$accion)."',
		 '".mysqli_real_escape_string($this->Conexion_ID,$detalle)."');";
         mysqli_query($this->Conexion_ID,$sentenciaLOG);
    }
    //funcion que comienza una transaccion
    function begin()
    {
        mysqli_query($this->Conexion_ID,"begin");
    }

    function rollback()
    {
        mysqli_query($this->Conexion_ID,"ROLLBACK");
    }

    function commit()
    {
        mysqli_query($this->Conexion_ID,"commit");
    }
    // Ejecuta un consulta
    function last_id(){
        return mysqli_insert_id($this->Conexion_ID);
	}
    function charset($tipo){
        $this->tipo=$tipo;
        
    }
    function arr_asocia()
    {
        $salida=null;
        $inicio = microtime();
        $i = 0;

        @mysqli_set_charset($this->Conexion_ID,$this->tipo);
        if ($this->logSELECT){
            $sentenciaLOG="insert into ".$this->Prefijo."log (usuario,fecha,accion) values ('".$this->UsuarioLOG."',now(),'".mysqli_real_escape_string($this->Conexion_ID,$this->Query)."');";
            mysqli_query( $this->Conexion_ID,$sentenciaLOG);
        }
        $this->Consulta_ID = @mysqli_query($this->Conexion_ID,$this->Query );
        if (!$this->Consulta_ID)
            return null;
        while ($resultado = mysqli_fetch_array($this->Consulta_ID))
        {
            $salida[$i] = $resultado;
            $i++;
        }
        $this->Errno = mysqli_errno($this->Conexion_ID);
        $this->Error = mysqli_error($this->Conexion_ID);
        $fin = microtime();
        return $salida;
    }
	function total()
    {
        $salida=$this->arr_asocia();
		if ($salida[0]){
			return $salida[0]['total'];
		}else{
			return null;
		}
    }

    function consulta()
    {
        $inicio = microtime();
        if (!$this->Clave)
        {
            $this->Error = "No ha especificado una consulta SQL";
            return 0;
        }

        //ejecutamos la consulta
        @mysqli_set_charset($this->Conexion_ID,$this->tipo);
        $this->Consulta_ID = mysqli_query($this->Conexion_ID,$this->Query);
        if (!$this->Consulta_ID)
        {
            $this->Errno = mysqli_errno($this->Conexion_ID);
            $this->Error = mysqli_error($this->Conexion_ID);
        }

        // Si hemos tenido éxito en la consulta devuelve
        // el identificador de la conexión, sino devuelve 0
        //mysqli_free_result($this->Consulta_ID);
        $fin = microtime();
        $sal=$this->Consulta_ID;
         if ($this->log){
            $sentenciaLOG="insert into ".$this->Prefijo."log (usuario,fecha,accion) values ('".$this->UsuarioLOG."',now(),'".mysqli_real_escape_string($this->Conexion_ID,$this->Query)."');";
            mysqli_query( $this->Conexion_ID,$sentenciaLOG);
        }
       
        return $sal;
    }
    function insert()
    {
        $idsalida=null;
        $inicio = microtime();
        if (!$this->Clave)
        {
            $this->Error = "No ha especificado una consulta SQL";
            return null;
        }

        //ejecutamos la consulta
        @mysqli_set_charset($this->Conexion_ID,$this->tipo);
        $this->Consulta_ID = mysqli_query($this->Conexion_ID,$this->Query);
        if (!$this->Consulta_ID)
        {
            $this->Errno = mysqli_errno($this->Conexion_ID);
            $this->Error = mysqli_error($this->Conexion_ID);
        }

        // Si hemos tenido éxito en la consulta devuelve
        // el identificador de la conexión, sino devuelve 0
        //mysqli_free_result($this->Consulta_ID);
        $fin = microtime();
        $sal=$this->Consulta_ID;
        if ($sal){
            $idsalida=$this->last_id();
        }
        if ($this->log){
            $sentenciaLOG="insert into ".$this->Prefijo."log (usuario,fecha,accion) values ('".$this->UsuarioLOG."',now(),'".mysqli_real_escape_string($this->Conexion_ID,$this->Query)."');";
            mysqli_query( $this->Conexion_ID,$sentenciaLOG);
        }
        return $idsalida;
    }


    //Conexión a la base de datos
    //tambien selecciona una base de datos

    function desconectar()
    {
        if ($this->Conexion_ID)
            ;
        @mysqli_close($this->Conexion_ID);
    }

    function conectarSinBD()
    {
		$this->Conexion_ID = @mysqli_connect($this->Servidor, $this->Usuario, $this->Clave);
		if (!$this->Conexion_ID)
        {
            $this->Error = "Ha fallado la conexión a mysql.";
            return 0;
        }

      

        //Si hemos tenido éxito conectando devuelve
        //el identificador de la conexión, sino devuelve 0
        return $this->Conexion_ID;
	}
	function conectar($basedatos)
    {

        // Conectamos al servidor con la base de datos que nos venga de parámetro
        if ($basedatos!=""){
            $this->BaseDatos = $basedatos;
            }
		if ($this->BaseDatos!=""){
			$this->Conexion_ID = @mysqli_connect($this->Servidor, $this->Usuario, $this->Clave,$this->BaseDatos);
		}else{
			$this->Conexion_ID = @mysqli_connect($this->Servidor, $this->Usuario, $this->Clave);
		}

        if (!$this->Conexion_ID)
        {
            $this->Error = "Ha fallado la conexión a mysql.";
            return 0;
        }

      

        //Si hemos tenido éxito conectando devuelve
        //el identificador de la conexión, sino devuelve 0
        return $this->Conexion_ID;
    }
	function elegirbd($database){
		return mysqli_select_db($this->Conexion_ID,$database);
	}
    function liberaconsulta()
    {
        return mysqli_free_result($this->Conexion_ID);
    }

    //Devuelve el número de campos de una consulta
    function numcampos()
    {
        return mysqli_num_fields($this->Consulta_ID);
    }

    //Devuelve el número de registros de una consulta
    function numregistros()
    {
        return mysqli_num_rows($this->Consulta_ID);
    }

    function numregistrosafectados()
    {
        return mysqli_num_rows($this->Consulta_ID);
    }

    //Devuelve el nombre de un campo de una consulta
    function nombrecampo($numcampo)
    {
        return mysqli_field_name($this->Consulta_ID, $numcampo);
    }

    //Muestra los datos de una consulta
   
} //fin de la Clse DB_mysql
?>