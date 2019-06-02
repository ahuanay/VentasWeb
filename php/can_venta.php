<?php

    require '../php/get.php';
    $get = new get();
    
    $IdVenta = $_POST['IdVenta'];
    $EstadoEntrega = $_POST['EstadoEntrega'];

    if($EstadoEntrega == 'Pendiente'){
        $get->getSP("up_Ventas_EstadoVenta('2', '$IdVenta')");
        $resultPVS = $get->getSP("get_IdPreciosVenta_nStockTienda('$IdVenta')");
        while($row = $resultPVS->fetch_assoc()) {
            do {
                $res = 0;
                $IdPrecioVenta = $row['IdPrecioVenta'];
                $Stock = $row['Stock'];
                $resp = $get->getSP("up_PreciosVenta_StockTienda('$IdPrecioVenta', '$Stock')");
                if($resp) {
                    $res = 1;
                }
                
            } while($res == 0);
        }
        echo 'Compra cancelada con exito';
    } else {
        echo 'Error';
    }

?>