<?php
require 'header.php';

 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			MÓDULO MODELO
			<small>Vista de todos los modelos</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="modelo.php"><i class="fa fa-dashboard"></i> Catalogo</a></li>
			<li class="active">Modelos</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<br>
				<h3 class="box-title"></h3>
				<a class="btn btn-app" onclick="openmodal();">
					<span class="badge bg-olive">NEW</span>
					<i class="fa fa-plus"></i> Agregar
				</a>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="col-md-12">
					<!-- Custom Tabs -->
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_modelos_act" data-toggle="tab">Modelos Activos</a></li>
							<li><a href="#tab_modelos_inact" data-toggle="tab">Modelos Inactivos</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_modelos_act">

								<!-- <div class="panel-body table-responsive" id="listadoregistros_activos"> -->
									<table id="tbllistado" class="stripe hover" style="width:100%;">
										<thead id="thead_entidad">
											<th>Opciones</th>
											<th>Abreviatura</th>
											<th>Nombre</th>
											<th>Descripcion</th>
											<th>Estado</th>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="thead_entidad">
											<th>Opciones</th>
											<th>Abreviatura</th>
											<th>Nombre</th>
											<th>Descripcion</th>
											<th>Estado</th>
										</tfoot>
									</table>
								<!-- </div> -->

							</div>
							<!-- /.tab-pane -->
							<div class="tab-pane" id="tab_modelos_inact">

                <div class="panel-body table-responsive" id="listadoregistros_inactivos">
                  <table id="tbllistadoD" class="cell-border hover" style="width:100%;">
                    <thead>
                      <th>Opciones</th>
                      <th>Abreviatura</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Estado</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot id="thead_entidad">
                      <th>Opciones</th>
                      <th>Abreviatura</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Estado</th>
                    </tfoot>
                  </table>
                </div>

							</div>

						</div>
						<!-- /.tab-content -->
					</div>
					<!-- nav-tabs-custom -->
				</div>

        <div class="modal fade" id="modal-default" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-list"></i> Registro de Modelos</h4>
              </div>
              <div class="modal-body">
                <div class="panel-body" id="formularioregistros">

                  <form id="formulario" name="formulario" class="" method="post" novalidate>

                      <div class="form-group-sm col-md-12">
                        <label class="form-label">Abreviatura<span style="color:#a94442;">*</span>:</label>
                        <input class="form-control" type="text" name="abreviatura" id="abreviatura" style="text-transform:uppercase;">
                        <div class="col-sm-12 messages"></div>
                      </div>

                      <div class="form-group-sm col-md-12">
                        <label class="form-label">Nombre<span style="color:#a94442;">*</span>:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" style="text-transform:uppercase;">
                        <div class="col-sm-12 messages"></div>
                      </div>

                    <div class="form-group-sm col-md-12">
                      <label class="control-label" for="descripcion">Descripción:</label>
                      <textarea style="overflow:auto;resize:none;" class="form-control" rows="3" cols="50" id="descripcion" name="descripcion"></textarea>
                      <div class="col-sm-12 messages"></div>
                    </div>

                    <div class="form-group-sm col-md-12">
                      <label class="control-label" for="descripcion">Estado(*):</label>
                      <br>
                      <input name="condicion" id="condicion" type="checkbox" value="1" checked data-toggle="toggle" data-width="120" data-offstyle="danger" data-onstyle="success" data-on="<i class='fa fa-check'></i> Activado" data-off="<i class='fa fa-close'></i> Desactivado">
                    </div>

                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <center>
                  <button type="button" data-dismiss="modal" class="btn btn-cancel-md roboto">Cerrar</button>
                  <button type="submit" form="formulario" class="btn btn-orange-md roboto">Guardar Cambios</button>
                </center>
              </div>
            </div>
          </div>
        </div>



			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				Notas diversas:
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

	</section>
	<!-- /.content -->
</div>

<!-- /.content-wrapper -->
<?php
  require 'footer.php';
?>
<script type="text/javascript" src="js/modelo.js"></script>
