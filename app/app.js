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

    $scope.listaElectivas = function(){

        $http.post('php/electivas/lista-electivas.php',{'ctrl':'electivas'}).success(function(datos){

            $scope.datosElectivas = datos;

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

        }

    }

});

app.controller('controladorUsuarios', function($scope, $http, $timeout){

    

});