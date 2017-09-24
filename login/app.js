var app = angular.module('appLogin', []);

app.controller('controladorLogin', function($scope, $http, $timeout){

    $scope.codigo = '';
    $scope.password = '';

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

    /*$scope.enviarCorreo = function(){

        $scope.button = true;

        if($scope.correo != '' || $scope.correo != null){

            if(regex.test($scope.correo) == true){

                $http.post('forgot-password.php',{'correo':$scope.correo}).success(function(validacion){

                    if(validacion == 1 || validacion == '1'){

                        $scope.texto_alerta = "Se te ha enviado tu contraseña a tu correo, por favor revisa tu bandeja de entrada";
                        $scope.mensaje_alerta = true;
                        $timeout(function(){

                            $scope.mensaje_alerta = false;
                            $scope.login_form = false;

                        },4000);

                    } else if(validacion == 2 || validacion == '2'){

                        $scope.texto_alerta = "Este correo no pertenece a ningún usuario registrado";
                        $scope.button = false;
                        $scope.mensaje_alerta = true;
                        $timeout(function(){

                            $scope.mensaje_alerta = false;

                        },3000);

                    } else if(validacion == 3 || validacion == '3') {

                        $scope.texto_alerta = "Faltan campos por llenar";
                        $scope.button = false;
                        $scope.mensaje_alerta = true;
                        $timeout(function(){

                            $scope.mensaje_alerta = false;

                        },2000);

                    }

                });

            } else {

                $scope.texto_alerta = "Ingresa un correo válido";
                $scope.button = false;
                $scope.mensaje_alerta = true;
                $timeout(function(){

                    $scope.mensaje_alerta = false;

                },2000);

            }

        } else {

            $scope.texto_alerta = "Faltan campos por llenar";
            $scope.button = false;
            $scope.mensaje_alerta = true;
            $timeout(function(){

                $scope.mensaje_alerta = false;

            },2000);

        }

    }*/

});