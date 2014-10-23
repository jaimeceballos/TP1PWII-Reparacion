<?php 
        (isset($_SESSION['listado'])) ? $listado = $_SESSION['listado'] : $listado = Array();

?>

<div class="row clearfix">
		<div class="col-md-12 column">
                    <h1>Listado de Ordenes <small> <a href="controller/controller.php?op=alta_orden" class="btn btn-xs btn-info" >Nuevo</a> </small></h1>
                    <hr>
			<table class="table">
				<thead>
					<tr>
						<th>
							Orden
						</th>
						<th>
							Tipo
						</th>
                                                <th>
							Cliente
						</th>
						<th>
							Entrada
						</th>
                                                <th>
							Falla
						</th>
                                                <th>
                                                        T. Realizado
                                                </th>
                                                <th>
                                                        Finalizado
                                                </th>
                                                <th>
                                                        Salida
                                                </th>
                                                <th>
                                                        Importe
                                                </th>
                                                <th>
                                                        Factura
                                                </th>
                                                <th>
                                                        Remito
                                                </th>
                                                <th>
                                                        Presupuestado
                                                </th>
                                                <th>
                                                    
                                                </th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($listado)>0): ?>
						<?php foreach($listado as $fila): ?>
							<tr>
								<td>
									<?php echo $fila['id']; ?>
								</td>
								<td>
									<?php echo $fila['descripcion']; ?>
								</td>
								<td>
									<?php echo $fila['ape_nom']; ?>
								</td>
								<td>
									<?php echo $fila['fecha_entrada']; ?>
								</td>
                                                                <td>
									<?php echo $fila['descripcion_falla']; ?>
								</td>
                                                                <td>
									<?php echo $fila['trabajo_realizado']; ?>
								</td>
                                                                <td>
									<?php echo $fila['fecha_finalizado']; ?>
								</td>
                                                                <td>
									<?php echo $fila['fecha_salida']; ?>
								</td>
                                                                <td>
									<?php echo $fila['importe_trabajo']; ?>
								</td>
                                                                <td>
									<?php echo $fila['nro_factura']; ?>
								</td>
                                                                <td>
									<?php echo $fila['remito_entrega']; ?>
								</td>
                                                                <td>
									<?php echo $fila['presupuestado']; ?>
								</td>
                                                                <td>
									<a href="controller/controller.php?op=edit_equipo&row=<?php echo $fila['id'] ?>"> <i class="glyphicon glyphicon-edit"></i> </a>
                                                                        <a href="controller/controller.php?op=remove_orden&row=<?php echo $fila['id'] ?>" onclick="return confirm('realmente desea eliminar este cliente?');"> <i class="glyphicon glyphicon-trash"></i> </a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<td colspan = "4" align="center" class="warning"> NO HAY DATOS </td>
					<?php endif; ?>
						
				
				</tbody>
			</table>
		</div>
	</div>