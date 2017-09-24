var app = angular.module('appLogin', []);

app.controller('controladorLogin', function($scope, $http, $timeout){

    $scope.codigo = '';
    $scope.password = '';
    $scope.formulario = true;

    //var regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    $scope.validarLogin = function(){

        if($scope.codigo.length > 0 && $scope.password.length > 0){

            $http.post('checklogin.php',{'codigo':$scope.codigo, 'password':$scope.password}).success(function(validacion){

                if(validacion == 'Credenciales incorrectas'){

                    swal('Credenciales incorrectas', 'Por favor verifica que los datos sean correctos', 'error')

                } else if( validacion == 'Sesion iniciada'){

                    window.location = '../';

                }

            });

        } else {

            swal('Faltan campos','Por favor ingresa los datos solicitados','warning');
            
        }          

    };

    $scope.registrarUsuario = function(){

        if($scope.nombre.length > 0 && $scope.codigo_reg.length > 0 && $scope.documento.length > 0){

            $http.post('checkuser.php',{'ctrl':'validar-usuario','codigo':$scope.codigo_reg}).success(function(validacion){

                if(validacion == 'No existe'){

                    $http.post('checkuser.php',{'ctrl':'crear-usuario', 'nombre':$scope.nombre, 'codigo':$scope.codigo_reg, 'documento':$scope.documento}).success(function(){

                        swal('Registro exitoso', 'Te has registrado de forma correcta', 'success');
                        $scope.formulario = true;

                    })

                } else if( validacion == 'Existe'){

                    swal('Usuario registrado', 'Este código ya ha sido registrado', 'error');

                }

            });

        } else {

            swal('Faltan campos','Por favor ingresa los datos solicitados','warning');
            
        }          

    };

});