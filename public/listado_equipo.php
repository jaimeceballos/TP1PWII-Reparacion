<?php 
        (isset($_SESSION['listado'])) ? $listado = $_SESSION['listado'] : $listado = Array();

?>

<div class="row clearfix">
		<div class="col-md-12 column">
                    <h1>Listado de equipos <small> <a href="controller/controller.php?op=alta_equipo" class="btn btn-xs btn-info" >Nuevo</a> </small></h1>
                    <hr>
			<table class="table">
				<thead>
					<tr>
						<th>
							ID
						</th>
						<th>
							Tipo Equipo
						</th>
						<th>
							Propietario
						</th>
						<th>
							Descripcion
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
									<?php echo $fila['tipo_equipo_id']; ?>
								</td>
								<td>
									<?php echo $fila['cliente_id']; ?>
								</td>
								<td>
									<?php echo $fila['descripcion_equipo']; ?>
								</td>
                                                                <td>
									<a href="controller/controller.php?op=edit_equipo&row=<?php echo $fila['id'] ?>"> <i class="glyphicon glyphicon-edit"></i> </a>
                                                                        <a href="controller/controller.php?op=remove_equipo&row=<?php echo $fila['id'] ?>" onclick="return confirm('realmente desea eliminar este cliente?');"> <i class="glyphicon glyphicon-trash"></i> </a>
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