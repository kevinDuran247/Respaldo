<?php
class contenido{

    public function ver(){

        if(!(isset($_GET["url"]))){
            return "vistas/menu_lateral.php";
        }
        $datos=explode("/",$_GET["url"]);

        if($datos[0]."_view.php"=="admin_productos_view.php"){
            return "vistas/productos_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."_view.php"=="form_productos_view.php"){
            return "vistas/productos_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."_view.php"=="admin_categorias_view.php"){
            return "vistas/categorias_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."_view.php"=="modificar_categorias_view.php"){
            return "vistas/categorias_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."tegoria.php"=="modificar_categoria.php"){
            return "controladores/acciones_categorias/".$datos[0]."tegoria.php";
        }elseif($datos[0]."_view.php"=="modificar_productos_view.php"){
            return "vistas/productos_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."ducto.php"=="modificar_producto.php"){
            return "controladores/acciones_productos/".$datos[0]."ducto.php";
        }elseif($datos[0]."_view.php"=="admin_estadisticas_view.php"){
            return "vistas/estadisticas_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."_view.php"=="admin_noticias_view.php"){
            return "vistas/noticias_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."_view.php"=="admin_usuarios_view.php"){
            return "vistas/usuarios_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."_view.php"=="modificar_noticias_view.php"){
            return "vistas/noticias_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."ticia.php"=="modificar_noticia.php"){
            return "controladores/acciones_noticias/".$datos[0]."ticia.php";
        }elseif($datos[0]."_view.php"=="admin_compras_view.php"){
            return "vistas/compras_admin/".$datos[0]."_view.php";
        }elseif($datos[0]."_view.php"=="detalles_compras_view.php"){
            return "vistas/compras_admin/".$datos[0]."_view.php";
        }
    }
}
?>