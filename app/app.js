$('.modal').modal();

var app = angular.module('app', ['angularUtils.directives.dirPagination','ngRoute']);

app.config(function($routeProvider){

    $routeProvider
    .when("/", {
        templateUrl: "app/views/inicio.php"
    })
    .when("/electivas", {
        templateUrl: "app/views/electivas.php"
    })
    .when("/usuarios", {
        templateUrl: "app/views/usuarios.php"
    });

});

app.controller('controladorElectivas', function($scope, $http, $timeout){

    $scope.itemElectivas = '5';
    $('textarea#descripcion').characterCounter();
    $('select').material_select();
    $scope.profesor = 'all';

    $scope.listaElectivas = function(){

        $http.post('php/electivas/lista-electivas.php',{'ctrl':'electivas'}).success(function(datos){

            $scope.datosElectivas = datos;

        });

        $http.post('php/electivas/lista-electivas.php',{'ctrl':'profesores'}).success(function(datos){

            $scope.datosProfesores = datos;

        });

    }

    $scope.listaElectivas();

    $scope.accionElectiva = function(ctrl, id){

        switch(ctrl){

            case 'nuevo-modal':

                $scope.tituloElectiva = 'Insertar electiva';
                $('#accion').modal().modal('open');
                $scope.ctrl_accion = 'crear';
                $scope.nombre = '';
                $scope.profesor = '';
                $scope.descripcion = '';
                $scope.cupos = '';

            break;
            case 'nuevo-save':

                if($scope.nombre != '' && $scope.profesor != '' && $scope.descripcion != '' && $scope.cupos != ''){

                    $http.post('php/electivas/crear&updateElectivas.php',{'ctrl':'validar-electiva', 'nombre':$scope.nombre}).success(function(validacion){

                        if(validacion == 'No existe'){

                            $http.post('php/electivas/crear&updateElectivas.php',{'ctrl':'crear-electiva', 'nombre':$scope.nombre, 'profesor':$scope.profesor, 'descripcion':$scope.descripcion, 'cupos':$scope.cupos}).success(function(){

                                Materialize.toast('Electiva creada', 3000, 'rounded');
                                $('#accion').modal().modal('close');
                                $scope.listaElectivas();

                            });

                        } else if(validacion == 'Existe'){

                            swal('Electiva ya existe', 'Esta electiva ya se encuentra en la base de datos', 'info');

                        }

                    });                            

                } else {

                    swal('Faltan campos', 'Por favor ingresa los datos solicitados', 'warning');

                }

            break;
            case 'editar-modal':

                $scope.ctrl_accion = 'editar';
                $scope.tituloElectiva = 'Editar electiva';

                $http.post('php/electivas/lista-electivas.php',{'ctrl':'electiva', 'id':id}).success(function(datos){

                    $scope.id = datos[0].elec_id;
                    $scope.nombre = datos[0].elec_nombre;
                    $scope.nombre_old = datos[0].elec_nombre;
                    $scope.profesor = datos[0].elec_profesor;
                    $scope.descripcion = datos[0].elec_descripcion;
                    $scope.cupos = parseInt(datos[0].elec_total_cupo);
                    $('#accion').modal().modal('open');

                });

            break;
            case 'editar-save':

                if($scope.nombre != '' && $scope.profesor != '' && $scope.descripcion != '' && $scope.cupos != ''){

                    if($scope.nombre != $scope.nombre_old){

                        $http.post('php/electivas/crear&updateElectivas.php',{'ctrl':'validar-electiva', 'nombre':$scope.nombre}).success(function(validacion){

                            if(validacion == 'No existe'){

                                $http.post('php/electivas/crear&updateElectivas.php',{'ctrl':'editar-electiva', 'id':$scope.id, 'nombre':$scope.nombre, 'profesor':$scope.profesor, 'descripcion':$scope.descripcion, 'cupos':$scope.cupos}).success(function(){

                                    Materialize.toast('Electiva actualizada', 3000, 'rounded');
                                    $('#accion').modal().modal('close');
                                    $scope.listaElectivas();

                                });

                            } else if(validacion == 'Existe'){

                                swal('Electiva ya existe', 'Esta electiva ya se encuentra en la base de datos', 'info');

                            }

                        });

                    } else {

                        $http.post('php/electivas/crear&updateElectivas.php',{'ctrl':'editar-electiva', 'id':$scope.id, 'nombre':$scope.nombre, 'profesor':$scope.profesor, 'descripcion':$scope.descripcion, 'cupos':$scope.cupos}).success(function(){

                            Materialize.toast('Electiva actualizada', 3000, 'rounded');
                            $('#accion').modal().modal('close');
                            $scope.listaElectivas();

                        });

                    }                                             

                } else {

                    swal('Faltan campos', 'Por favor ingresa los datos solicitados', 'warning');

                }

            break;
            case 'remover-modal':

                $('#confirm').modal().modal('open');
                $scope.id = id;

            break;
            case 'remover':

                $http.post('php/electivas/crear&updateElectivas.php',{'ctrl':'remover', 'id': $scope.id}).success(function(){

                    Materialize.toast('Electiva removida', 3000, 'rounded');
                    $('#confirm').modal().modal('close');
                    $scope.listaElectivas();

                });

            break;
            case 'ver-inscritos':

                $scope.spinner_inscritos = true;
                $('#inscritos').modal().modal('open');

                $scope.id = id;

                $http.post('php/electivas/lista-electivas.php', {'ctrl':'ver-inscritos', 'id':id}).success(function(datos){

                    if(datos.length > 0){
                        $scope.datosUsuarios = datos;
                    } else {
                        $scope.datosUsuarios = null;
                    }
                    $scope.spinner_inscritos = false;

                });

            break;
            case 'inscribirme-modal':

                $scope.id = id;
                $('#confirm-inscripcion').modal().modal('open');                

            break;
            case 'inscribirme':

                $http.post('php/electivas/crear&updateElectivas.php', {'ctrl':'inscribirme', 'id':$scope.id}).success(function(respuesta){

                    switch(respuesta){
                        case 'Inscrito':

                            swal('Incrito', 'Has sido incrito en esta electiva', 'success');

                        break;
                        case 'Ya estas inscrito':

                            swal('Ya estas inscrito', 'Ya has elegido esta electiva', 'info');

                        break;
                        case 'Cupo lleno':

                            swal('Cupo lleno','Lo sentimos pero ya no quedan cupos disponibles','info');

                        break;
                    }
                    $('#confirm-inscripcion').modal().modal('close'); 
                    $scope.listaElectivas();

                });

            break;

        }

    }

    $scope.filtroProfesor = function(value){

        if($scope.profesor == 'all'){
            return true;
        } else if (value.elec_profesor === $scope.profesor){
            return true;
        } else {
            return false;
        }

    }

});

app.controller('controladorUsuarios', function($scope, $http, $timeout){

    $scope.consultarUsuarios = function(criterio){

        $http.post('php/usuarios/lista-usuarios.php', {'ctrl':'usuarios', 'criterio':criterio}).success(function(datos){

            if(datos.length > 0){
                $scope.datosUsuarios = datos;
            } else {
                $scope.datosUsuarios = null;
            }            
            $scope.spinner_usuarios = false;

        });

    }

    $scope.buscarUsuario = function(event){

        $scope.spinner_usuarios = true;
        $scope.datosUsuarios = [];

        $timeout.cancel($scope.time);

        $scope.time = $timeout(function(){

            $scope.consultarUsuarios($scope.busquedaUsuario);

        },1200);

    }

    $scope.verElectivas = function(id){

        $http.post('php/usuarios/lista-usuarios.php',{'ctrl':'electivas', 'id':id}).success(function(datos){

            if(datos.length > 0){
                $scope.datosElectivas = datos;
            } else {
                $scope.datosElectivas = null;
            }
            $('#electivas').modal().modal('open');

        });

    }

});