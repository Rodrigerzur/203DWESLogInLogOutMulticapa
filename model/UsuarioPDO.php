<?php

class UsuarioPDO implements UsuarioDB{

    public static function validarUsuario($codUsuario, $password){
        $oUsuario = null; // inicializo la variable a null, que tendrá el objeto de clase usuario si existe el usuario
        
        //Consulta SQL para comprobar si existe el usuario
        $consulta = <<<CONSULTA
            SELECT * FROM T02_Usuario 
            WHERE T01_CodUsuario='{$codUsuario}' 
            AND T01_Password=SHA2("{$codUsuario}{$password}", 256); 
        CONSULTA;
        
        $resultado = DBPDO::ejecutarConsulta($consulta); //Ejecuto la consulta
        
        if($resultado->rowCount()>0){ // si la consulta me devuleve algun resultado es que existe el usuario
            $oUsuario = $resultado->fetchObject(); // Guardo en la variable el resultado de la consulta en forma de objeto
            
            if($oUsuario){ //Instancio un nuevo objeto usuario con todos sus datos
                $oUsuario = new Usuario($oUsuario->T01_CodUsuario, $oUsuario->T01_Password, $oUsuario->T01_DescUsuario, $oUsuario->T01_NumConexiones, $oUsuario->T01_FechaHoraUltimaConexion, $oUsuario->T01_FechaHoraUltimaConexionAnterior, $oUsuario->T01_ImagenUsuario, $oUsuario->T01_Perfil);
            }
        }
        return $oUsuario;
    }

    public static function registrarUltimaConexion($oUsuario) {
        $oUsuario->setNumConexiones($oUsuario->getNumConexiones()+1);
        $oUsuario->setFechaHoraUltimaConexionAnterior($oUsuario->getFechaHoraUltimaConexion());
        
        //Consulta SQL para actualizar la ultima conexion del usuario y las conexiones
        $consultaActualizacionFechaUltimaConexion = <<<CONSULTA
            UPDATE T02_Usuario 
            SET T01_NumConexiones=T01_NumConexiones+1, T01_FechaHoraUltimaConexion=unix_timestamp() 
            WHERE T01_CodUsuario='{$oUsuario->getCodUsuario()}';
        CONSULTA;
            
        DBPDO::ejecutarConsulta($consultaActualizacionFechaUltimaConexion);
        
        return $oUsuario;
    }

    public static function altaUsuario($codUsuario, $password, $descUsuario){
        //Consulta SQL para dar de alta un nuevo usuario
        $consultaCrearUsuario = <<<CONSULTA
            INSERT INTO T02_Usuario(T01_CodUsuario, T01_Password, T01_DescUsuario, T01_NumConexiones, T01_FechaHoraUltimaConexion) VALUES ("{$codUsuario}", SHA2("{$codUsuario}{$password}", 256), "{$descUsuario}", 1, UNIX_TIMESTAMP());
        CONSULTA;
        
        if(DBPDO::ejecutarConsulta($consultaCrearUsuario)){
            return new Usuario($codUsuario, $password, $descUsuario, 1, time(), null, null, 'usuario');
        }else{
            return false;
        }
    }

    public static function validarCodNoExiste($codUsuario){
        //Consulta SQL para validar si el codigo de usuario existe
        $consultaExisteUsuario = <<<CONSULTA
            SELECT T01_CodUsuario FROM T02_Usuario WHERE T01_CodUsuario='{$codUsuario}';
        CONSULTA;
        return DBPDO::ejecutarConsulta($consultaExisteUsuario)->fetchObject();
    }

    public static function modificarUsuario($oUsuario, $descUsuario){
        //Consulta SQL para modificar la descripcion de un usuario
        $consultaModificarUsuario = <<<CONSULTA
            UPDATE T02_Usuario SET T01_DescUsuario="{$descUsuario}" WHERE T01_CodUsuario="{$oUsuario->getCodUsuario()}";
        CONSULTA;
            
        $oUsuario->setDescUsuario($descUsuario);
        
        if(DBPDO::ejecutarConsulta($consultaModificarUsuario)){
            return $oUsuario;
        }else{
            return false;
        }
    }

    public static function cambiarPassword($oUsuario, $password){
        //Consulta SQL para modificar la password de un usuario
        $consultaModificarPassword = <<<CONSULTA
            UPDATE T02_Usuario SET T01_Password=SHA2("{$oUsuario->getCodUsuario()}{$password}", 256) WHERE T01_CodUsuario="{$oUsuario->getCodUsuario()}";
        CONSULTA;
            
        $oUsuario->setPassword($password);
        
        if(DBPDO::ejecutarConsulta($consultaModificarPassword)){
            return $oUsuario;
        }else{
            return false;
        }
    }
}
?>