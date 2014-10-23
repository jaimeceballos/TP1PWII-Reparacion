<?php 
	(isset($_SESSION['listado'])) ? $listado = $_SESSION['listado'] : $listado = Array();

?>

<div class="row clearfix">
		<div class="col-md-12 column">
                    <h1>Listado de clientes <small> <a href="controller/controller.php?op=nuevo" class="btn btn-xs btn-info" >Nuevo</a> </small></h1>
                    <hr>
			<table class="table">
				<thead>
					<tr>
						<th>
							ID
						</th>
						<th>
							Apellido Nombre
						</th>
						<th>
							DNI
						</th>
						<th>
							Domicilio
						</th>
                                                <th>
							Telefono
						</th>
                                                <th>
							Email
						</th>
                                                <th>
							Es Juridica
						</th>
                                                <th>
							Cuit
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
									<?php echo $fila['ape_nom']; ?>
								</td>
								<td>
									<?php echo $fila['dni']; ?>
								</td>
								<td>
									<?php echo $fila['domicilio']; ?>
								</td>
                                                                <td>
									<?php echo $fila['telefono']; ?>
								</td>
                                                                <td>
									<?php echo $fila['email']; ?>
								</td>
                                                                <td>
									<?php echo $fila['juridica']==1 ? 'si' : 'no'; ?>
								</td>
                                                                <td>
									<?php echo $fila['cuit']; ?>
								</td>
								<td>
									<a href="controller/controller.php?op=edit&row=<?php echo $fila['id'] ?>"> <i class="glyphicon glyphicon-edit"></i> </a>
                                                                        <a href="controller/controller.php?op=remove&row=<?php echo $fila['id'] ?>" onclick="return confirm('realmente desea eliminar este cliente?');"> <i class="glyphicon glyphicon-trash"></i> </a>
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