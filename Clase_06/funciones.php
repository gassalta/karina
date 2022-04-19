<?php
//Subtotal
function Subtotal($Cant_Pedida, $Precio_Unitario)
{
	$ResuSubtotal = $Cant_Pedida * $Precio_Unitario;
	return $ResuSubtotal;
}

//descuento por cantidad y monto de descuento
function DesCantidad($SubTotal,$Cant_Pedida, $CantidadMinima, $DescuentoPorcentaje)
{
	
	$Color1 = 'text-success';
	$Color2 = 'text-info';
	$Color3 = 'text-warning';

	$descuento = 0;
	if ($Cant_Pedida >= $CantidadMinima){
		if($DescuentoPorcentaje == 0){
			$color = $Color3;
			$resultado = 'No tiene descuento';
		}else{
			$color = $Color1;
			$resultado = "{$CantidadMinima} insumos o mas, {$DescuentoPorcentaje} % de descuento";
			$descuento = ($SubTotal * $DescuentoPorcentaje) / 100;
		}
	}else if ($Cant_Pedida < $CantidadMinima){
		if($DescuentoPorcentaje == 0){
			$color = $Color3;
			$resultado = 'No tiene descuento';
		}else{
			$color = $Color2;
			$resultado = "{$CantidadMinima} insumos o mas, {$DescuentoPorcentaje} % de descuento";
		}
	}


	$resultado = [
		'clase' => $color,
		'resultado' => $resultado,
		'descuento' => $descuento
	];
	return $resultado;
}

// Por cada fila
function Total($ResuSubtotal, $MontoDescuento)
{
	$ResuSubtotal1 = $ResuSubtotal - $MontoDescuento;
	return $ResuSubtotal1;
}


//total de productos solicitados
function TotalProductosSolicitados($Desempeñio)
{
	$acumulado1 = 0;
	foreach ($Desempeñio as $datos) {
		$acumulado1 = $acumulado1 + $datos['Cant_Pedida'];
	}
	return $acumulado1;
}