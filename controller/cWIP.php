<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if(isset($_REQUEST['volverwip'])){ 
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior']; 
    header('Location: index.php'); 
    exit;
}

require_once $vistas['layout']; 
?>