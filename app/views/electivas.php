<?php
	session_start();
?>
<div class="page" ng-controller="controladorElectivas">
	<div class="container z-depth-5">
		<div class="row">
			<div class="col s12">
<?php
	if($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == '1'){
?>
			<div class="input-field col m12 s12">
				<i class="material-icons prefix">search</i>
	          	<input id="buscarElectiva" type="text" class="validate" ng-model="buscarElectiva">
	          	<label for="buscarElectiva">Buscar...</label>
	        </div>
	        <div style="overflow-x: auto; width: 100%;">
				<table class="bordered col m12 s12" style="margin: 30px 0px;">
					<thead>
						<tr>
							<td>Nombre</td>
							<td>Profesor</td>
							<td>Descripción</td>
							<td>Cupos disponibles</td>
							<td>Cupos totales</td>
							<td colspan="2">Acciones</td>
						</tr>
					</thead>
					<tbody dir-paginate="tablaElectivas in datosElectivas | filter:buscarElectiva | itemsPerPage:itemElectivas" pagination-id="pagElectivas">
						<tr>
							<td>{{tablaElectivas.elec_nombre}}</td>
							<td>{{tablaElectivas.elec_profesor}}</td>
							<td>{{tablaElectivas.elec_descripcion}}</td>
							<td>{{tablaElectivas.elec_dis_cupo}}</td>
							<td>{{tablaElectivas.elec_total_cupo}}</td>
							<td><a class="btn-flat" ng-click="accionElectiva('editar-modal', tablaElectivas.elec_id)"><i class="large material-icons">edit</i></a></td>
							<td><a class="btn-flat" ng-click="accionElectiva('remover-modal', tablaElectivas.elec_id)"><i class="large material-icons">delete</i></a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col m4 s10 offset-m4 offset-s1">
			    <label>Items por página</label>	
			    <select class="browser-default" ng-model="itemElectivas">
			      	<option value="5">5</option>
			      	<option value="10">10</option>
			      	<option value="20">20</option>
			    </select>
				<dir-pagination-controls pagination-id="pagElectivas" direction-links="true" boundary-links="true" class="buttons ng-isolate-scope"></dir-pagination-controls>
			</div>
			<div class="fixed-action-btn horizontal click-to-toggle">
		    	<a class="btn-floating btn-large red">
		      		<i class="material-icons">menu</i>
		    	</a>
		    	<ul>
		      		<li><a class="btn-floating red" ng-click="accionElectiva('nuevo-modal');"><i class="material-icons">add</i></a></li>
		    	</ul>
		  	</div>
		  	<div id="accion" class="modal">
		    	<div class="modal-content">
		      		<h4 class="center-align">{{tituloElectiva}}</h4>
		      		<div class="row">
						<div class="input-field col s12 m8 offset-m2">
				          	<input id="nombre" placeholder="Nombre:" name="nombre" type="text" ng-model="nombre">
				          	<label for="nombre" ng-show="nombre != ''">Nombre:</label>
				        </div>
					</div>
		      		<div class="row">
						<div class="input-field col s12 m8 offset-m2">
				          	<input id="profesor" placeholder="Profesor:" name="profesor" type="text" ng-model="profesor">
				          	<label for="profesor" ng-show="profesor != ''">Profesor:</label>
				        </div>
					</div>
		      		<div class="row">
						<div class="input-field col s12 m8 offset-m2">
				          	<textarea class="materialize-textarea" id="descripcion" placeholder="Descripción:" name="descripcion" ng-model="descripcion" data-length="250"></textarea>
				          	<label for="descripcion" ng-show="descripcion != ''">Descripción:</label>
				        </div>
					</div>
		      		<div class="row">
						<div class="input-field col s12 m8 offset-m2">
				          	<input id="cupos" placeholder="Cantidad de cupos:" name="cupos" type="number" min="0" max="70" ng-model="cupos">
				          	<label for="cupos" ng-show="cupos != ''">Cantidad de cupos:</label>
				        </div>
					</div>
	    		</div>
		    	<div class="modal-footer">
		      		<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
		      		<a class="waves-effect waves-green btn-flat" ng-click="accionElectiva('nuevo-save')" ng-show="ctrl_accion == 'crear'">Guardar</a>
		      		<a class="waves-effect waves-green btn-flat" ng-click="accionElectiva('editar-save')" ng-show="ctrl_accion == 'editar'">Guardar</a>
		   		</div>
	  		</div>
	  		<div id="confirm" class="modal">
		    	<div class="modal-content">
		      		<h4 class="center-align">¿Está seguro de eliminar esta electiva?</h4>
	    		</div>
		    	<div class="modal-footer">
		      		<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
		      		<a class="waves-effect waves-green btn-flat" ng-click="accionElectiva('remover')">Si</a>
		   		</div>
	  		</div>
<?php
	} else {
?>
			<div class="input-field col m12 s12">
				<i class="material-icons prefix">search</i>
	          	<input id="buscarElectiva" type="text" class="validate" ng-model="buscarElectiva">
	          	<label for="buscarElectiva">Buscar...</label>
	        </div>
	        <div class="col s12">
	        	<div class="col s12 m7">
	        		<label>Profesor:</label>	
				    <select class="browser-default" ng-model="profesor">
				    	<option value="all">Todos</option>
				      	<option value="{{listaProfesores.profe_nombre}}" ng-repeat="listaProfesores in datosProfesores">{{listaProfesores.profe_nombre}}</option>
				    </select>
	        	</div>
	        </div>
	        <div style="overflow-x: auto; width: 100%;">
				<table class="bordered col m12 s12" style="margin: 30px 0px;">
					<thead>
						<tr>
							<td>Nombre</td>
							<td>Profesor</td>
							<td>Descripción</td>
							<td>Cupos disponibles</td>
							<td colspan="2">Acciones</td>
						</tr>
					</thead>
					<tbody dir-paginate="tablaElectivas in datosElectivas | filter:buscarElectiva | filter:filtroProfesor | itemsPerPage:itemElectivas" pagination-id="pagElectivas">
						<tr>
							<td>{{tablaElectivas.elec_nombre}}</td>
							<td>{{tablaElectivas.elec_profesor}}</td>
							<td>{{tablaElectivas.elec_descripcion}}</td>
							<td>{{tablaElectivas.elec_dis_cupo}}</td>
							<td>
								<button ng-class="{disabled: tablaElectivas.elec_dis_cupo == 0}" class="btn waves-effect waves-light" name="action" ng-click="accionElectiva('inscribirme-modal', tablaElectivas.elec_id);">Inscribirme
							    	<i class="material-icons right">class</i>
							  	</button>
							</td>
							<td>
								<button class="btn waves-effect waves-light" name="action" ng-click="accionElectiva('ver-inscritos', tablaElectivas.elec_id);">Inscritos
							    	<i class="material-icons right">people</i>
							  	</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col m4 s10 offset-m4 offset-s1">
			    <label>Items por página</label>	
			    <select class="browser-default" ng-model="itemElectivas">
			      	<option value="5">5</option>
			      	<option value="10">10</option>
			      	<option value="20">20</option>
			    </select>
				<dir-pagination-controls pagination-id="pagElectivas" direction-links="true" boundary-links="true" class="buttons ng-isolate-scope"></dir-pagination-controls>
			</div>
			<div id="inscritos" class="modal">
		    	<div class="modal-content">
		      		<h4 class="center-align">Inscritos</h4>
		      		<div class="col m12 s12 center-align" ng-show="spinner_inscritos" style="margin-top: 80px;">
			        	<div class="preloader-wrapper big active">
					    	<div class="spinner-layer spinner-blue-only">
					      		<div class="circle-clipper left">
					        		<div class="circle"></div>
					      		</div>
					      		<div class="gap-patch">
					        		<div class="circle"></div>
					      		</div>
					      		<div class="circle-clipper right">
					        		<div class="circle"></div>
					      		</div>
					    	</div>
					  	</div>
				  	</div>
		      		<br><br>
		      		<div class="collection">
		      			<a class="collection-item center-align" ng-show="datosUsuarios == null"><h5>Ninguno...</h5></a>
					    <a class="collection-item center-align" ng-repeat="listaUsuarios in datosUsuarios"><h5>{{listaUsuarios.user_nombre}} - Cód. {{listaUsuarios.user_codigo}}</h5></a>
					</div>
	    		</div>
		    	<div class="modal-footer">
		    		<a class="modal-action modal-close waves-effect waves-green btn-flat" ng-click="accionElectiva('inscribirme')">¡Inscribete ahora!</a>
		      		<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
		   		</div>
			</div>
	  		<div id="confirm-inscripcion" class="modal">
		    	<div class="modal-content">
		      		<h4 class="center-align">¿Está seguro de inscribirte en esta electiva?</h4>
	    		</div>
		    	<div class="modal-footer">
		      		<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
		      		<a class="waves-effect waves-green btn-flat" ng-click="accionElectiva('inscribirme')">Si</a>
		   		</div>
	  		</div>
<?php
	}
?>
			</div>
		</div>
</div>
</div>

