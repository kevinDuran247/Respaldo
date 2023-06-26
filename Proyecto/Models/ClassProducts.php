<?php

require_once('Connection.php');

class Products
{

    public function consultProducts()
    {

        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM productos";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = "";

        while ($row = $result->fetch_assoc()) {
            $data .= "
            <form action='/Proyecto/Controllers/CarritoControllers/InsertProductoCarritoIndex.php' method='POST'>
                <div class='col mt-4'>
                    <div style='height: 100%;'>
                        <img src='http://localhost/Proyecto/Views/Admin/$row[imagen_principal]' alt='' srcset=''>
                        <div class='card-body' style='height: 100%; display: flex; flex-direction: column; justify-content: space-between; '>
                            <div style='height:60px' class='text-center'>
                            <strong><p style='font-size: 17px' class='card-title'>$row[nombre]</p></strong>
                            </div>
                            <input type='hidden' value='$row[id]' name='idProduct'>
                            <input type='hidden' value='1' name='cantidad'>
                            <p class='card-text'>$$row[precio]</p>
                            <input type='hidden' value='$row[precio]' name='precio'>";

            if ($row['disponibilidad'] == 0) {
                $data .= "
                <h5 class='text-center'>PRODUCTO AGOTADO</h5>
                ";
            } else {
                if (isset($_SESSION['user'])) {
                    $typeButton = "submit";
                } else {
                    $typeButton = "button";
                }
                $data .= "         
            <div class='btn-group'>
                <a href='javascript:void(0)' onclick='showDetails($row[id])' class='btn btn-success'>Detalles</a>
                <button type='$typeButton' class='btn btn-warning' href='' onclick='showCuenta()'><i class='fa-solid fa-cart-shopping'></i></button>
            </div>";
            }

            $data .= "                
                        </div>
                    </div>
                </div>
        </form>
        
            ";
        }
        return $data;
    }

    public function consultar_productos($idProd) //Mostrar Modal
    {

        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM productos WHERE id =?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idProd);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);
        $fila = $resultado->fetch_assoc();

        $sqlImagenes = "SELECT ruta FROM imagenes_producto WHERE producto_id = ?";
        $stmt = mysqli_prepare($connect, $sqlImagenes);
        mysqli_stmt_bind_param($stmt, "i", $idProd);
        mysqli_stmt_execute($stmt);

        $resultadoImagenes = mysqli_stmt_get_result($stmt);

        $sqlTallas = "SELECT talla FROM tallas_producto WHERE producto_id = ?;";
        $stmt = mysqli_prepare($connect, $sqlTallas);
        mysqli_stmt_bind_param($stmt, "i", $idProd);
        mysqli_stmt_execute($stmt);
        $resultadoTallas = mysqli_stmt_get_result($stmt);

        $info = "";
        $info .= "
        <form id='FormCarrito'>
            <div class='col'>
                <div class='card shadow-sm' style='padding-top:50px'>
                        <img src='http://localhost/Proyecto/Views/Admin/$fila[imagen_principal]' class='img-thumbnail' style='width:350px; height:350px;border:none; margin:auto; border-radius:25px'>
                        <p class='text-center' style='margin:25px'>GALERIA DE IMAGENES</p>
                     <div class='row row-cols-1 row-cols-sm-2 row-cols-md-3'> ";

        if ($resultadoImagenes->num_rows > 1) {

            while ($filaImagenes = $resultadoImagenes->fetch_assoc()) {

                $info .= "
                        <div class='col'>
                            <img src='http://localhost/Proyecto/Views/Admin/$filaImagenes[ruta]' class='img-thumbnail' style='width:200px; height:200px; object-fit: cover; border:none; boder-radius:10px'>
                        </div>
                        ";
            }
        } else if ($resultadoImagenes->num_rows > 0) {
            $info .= "
               
            
            ";
        }
        $info .= "
                    </div> <!-- Aqui termina la fila de las imagenes -->

                        <div class='card-body text-center'>
                            <h4 class='card-text' style='margin:20px'><b>$fila[nombre]</b></h4>
                            <input type='hidden' name ='idProduct' value='$fila[id]'>
                        
                      <div class='row'>
                        <div class='col-sm-4'>  
                            ";

        while ($filaTallas = $resultadoTallas->fetch_assoc()) {
            $info .= "   
                    <div class='form-check form-check-inline'>
                            <input class='form-check-input' type='radio' name='radiobutton' id='radiobutton1' value='option1'>
                            <label class='form-check-label' for='radiobutton1'>$filaTallas[talla]</label>
                    </div>     
                    ";
        }

        $info .= "          </div>

                        <div class='col-sm-4'>
                            <p>Cantidad disponible:</p>
                            <p class='text-center'>$fila[disponibilidad]</p>
                        </div>

                        <div class='col-sm-4'>
                            <div class='input-group mb-3'>
                                        <button class='btn btn-outline-secondary' type='button' id='decrementBtn'><i class='fa-solid fa-minus'></i></button>
                                        <input type='number' class='form-control text-center' name ='cantidad' value='1' min='1' max='$fila[disponibilidad]' id='quantityInput'>
                                        <button class='btn btn-outline-secondary' type='button' id='incrementBtn'><i class='fa-solid fa-plus'></i></button>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-sm-6'>
                                 <p class='card-text'>Precio: $$fila[precio]</p>
                                 <input type='hidden' value='$fila[precio]' name='precio'>
                            </div>

                            <div class='col-sm-6'>
                                <p class='card-text'>Color: $fila[color]</p>
                            </div>
                        </div>

                        <div class='row'>
                            <button type='submit'  class='btn' style='font-size:40px'><i class='fa-solid fa-cart-shopping' href='javascript:void(0)' onclick='showCuenta()'></i></button>
                        </div>
                  </div>
              </div>
            </form>

            ";

        return $info;
    }


    public function searchProductName($search)
    {
        $connection = new Connection();
        $conn = $connection->connect();

        $sql = "SELECT imagen_principal, disponibilidad,p.nombre as NombreProducto, p.descripcion AS descripProduct, p.id AS idProduct, p.precio as precio FROM productos p JOIN categorias c ON p.`categoria_id` = c.`id` WHERE c.`nombre`= ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $search);
        mysqli_stmt_execute($stmt);
        // Obtener los resultados de la consulta
        $result = $stmt->get_result();
        $data = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $data .= "
            <form action='/Proyecto/Controllers/CarritoControllers/InsertProductoCarritoIndex.php' method='POST'>
           
                <div class='col mt-4'>
                    <div style='height: 100%;'>
                        <img src='http://localhost/Proyecto/Views/Admin/$row[imagen_principal]' alt='' srcset=''>
                        <div class='card-body' style='height: 100%; display: flex; flex-direction: column; justify-content: space-between; '>
                            <div style='height:60px' class='text-center'>
                            <strong><p style='font-size: 17px' class='card-title'>$row[NombreProducto]</p></strong>
                            </div>
                            <input type='hidden' value='$row[idProduct]' name='idProduct'>
                            <input type='hidden' value='1' name='cantidad'>
                            <p class='card-text'>$$row[precio]</p>
                            <input type='hidden' value='$row[precio]' name='precio'>";

                if ($row['disponibilidad'] == 0) {
                    $data .= "
                <h5 class='text-center'>PRODUCTO AGOTADO</h5>
                ";
                } else {
                    $data .= "         
            <div class='btn-group'>
                <a href='javascript:void(0)' onclick='showDetails($row[idProduct])' class='btn btn-success'>Detalles</a>
                <button type='submit' class='btn btn-warning' href='' onclick='showCuenta()'><i class='fa-solid fa-cart-shopping'></i></button>
            </div>";
                }
                $data .= "                
                        </div>
                    </div>
                </div>
        </form>
        
            ";
            }
            return $data;
        } else {
            $data .= "PRODUCTO NO ENCONTRADO";
            return $data;
        }
    }
}
