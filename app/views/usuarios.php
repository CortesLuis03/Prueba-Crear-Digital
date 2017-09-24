<div class="page" ng-controller="controladorUsuarios">
	<div class="container z-depth-5">
		<div class="row">
			<div class="col s12">
				<div class="input-field col m12 s12">
					<i class="material-icons prefix">search</i>
		          	<input id="buscarElectiva" type="text" class="validate" ng-model="busquedaUsuario" ng-change="buscarUsuario($event);">
		          	<label for="buscarElectiva">Buscar usuario por nombre o código...</label>
		        </div>
		        <div style="overflow-x: scroll; width: 100%;" ng-show="busquedaUsuario != '' && busquedaUsuario != null">
					<table class="bordered col m12 s12" style="margin: 30px 0px;">
						<thead>
							<tr>
								<td>Nombre</td>
								<td>Código</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr ng-show="datosUsuarios == null">
								<td colspan="3"><h4>No hay resultados...</h4></td>
							</tr>
							<tr ng-repeat="tablaUsuarios in datosUsuarios | filter:buscarElectiva">
								<td>{{tablaUsuarios.user_nombre}}</td>
								<td>{{tablaUsuarios.user_codigo}}</td>
								<td><a class="btn-flat" ng-click="verElectivas(tablaUsuarios.user_id)"><i class="large material-icons">search</i></a></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col m12 s12 center-align" ng-show="spinner_usuarios" style="margin-top: 80px;">
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
			  	<div id="electivas" class="modal">
			    	<div class="modal-content">
			      		<h4 class="center-align">Electivas elegidas</h4>
			      		<br><br>
			      		<div class="collection">
			      			<a class="collection-item center-align" ng-show="datosElectivas == null"><h5>Sin elegir...</h5></a>
						    <a class="collection-item center-align" ng-repeat="listaElectivas in datosElectivas"><h5>{{listaElectivas.elec_nombre}}</h5></a>
						</div>
		    		</div>
			    	<div class="modal-footer">
			      		<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
			   		</div>
	  			</div>
			</div>
		</div>
	</div>
</div>

