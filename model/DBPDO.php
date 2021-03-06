<?php

class DBPDO implements DB{

    public static function ejecutarConsulta($sentenciaSQL, $parametros = null){
        try {
            $DB203DWESLogInLogOutMulticapa = new PDO(HOST, USER, PASSWORD);//Hago la conexion con la base de datos
            $DB203DWESLogInLogOutMulticapa -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// Establezco el atributo para la aparicion de errores con ATTR_ERRMODE y le pongo que cuando haya un error se lance una excepcion con ERRMODE_EXCEPTION
            $resultadoConsulta = $DB203DWESLogInLogOutMulticapa->prepare($sentenciaSQL); // Preparo la consulta antes de ejecutarla
            $resultadoConsulta -> execute($parametros);//Ejecuto la consulta con el array de parametros
            return $resultadoConsulta; //Devuelvo el resultado de la consulta
        }catch(PDOException $excepcion){//Codigo que se ejecuta si hay algun error
            $_SESSION['paginaEnCurso'] = 'error';
            $_SESSION['error'] = new AppError($excepcion->getCode(), $excepcion->getMessage(), $excepcion->getFile(), $excepcion->getLine(), $_SESSION['paginaAnterior']);
            header('Location: index.php');
            exit;
        } finally{
            unset($DB203DWESLogInLogOutMulticapa);
        }
    }
}
?>