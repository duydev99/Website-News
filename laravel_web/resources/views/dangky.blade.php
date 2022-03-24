<!DOCTYPE html>
<html lang="en" ng-app="my-app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <form method="POST" name="frmRegister" action="{{route('postRegister')}}" ng-controller="RegisterController">
        {{csrf_field ()}}
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4 col-sm-2"></div>
                <div class="col-md-4 col-sm-8 col-12 bg-light">
                    <div class="text-center mt-3 mb-3">
                        <h5>Đăng Ký Người Dùng</h3>
                    </div>
                    @if (Session::has('exist'))
                        <small id="emailHelp" class="form-text text-muted text-danger">Tài khoản đã tồn tại.</small>
                    @endif
                    <div class="form-group">
                        <label for="lblName">Họ tên</label>
                        <input type="text" id="txtRegisterName" name="txtRegisterName"
                         class="form-control form-control-sm" ng-model="txtRegisterName" ng-required="true">
                         <small id="Username" class="form-text text-muted"
                         ng-show="frmRegister.txtRegisterName.$error.required">Hãy nhập họ tên</small>
                    </div>
                    <div class="form-group">
                        <label for="lblUsername">Tài khoản</label>
                        <input type="text" id="txtRegisterUsername" name="txtRegisterUsername"
                         class="form-control form-control-sm" ng-model="txtRegisterUsername" ng-required="true">
                         <small id="Username" class="form-text text-muted"
                         ng-show="frmRegister.txtRegisterUsername.$error.required">Hãy nhập tài khoản</small>
                    </div>
                    <div class="form-group">
                        <label for="lblPassword">Mật khẩu</label>
                        <input type="password" id="txtRegisterPassword" name="txtRegisterPassword"
                         class="form-control form-control-sm" ng-model="txtRegisterPassword" ng-required="true">
                         <small id="password" class="form-text text-muted"
                         ng-show="frmRegister.txtRegisterPassword.$error.required">Hãy nhập mật khẩu</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnLogin" name="btnLogin" ng-disabled="frmRegister.$invalid"
                        class="btn btn-info">Đăng ký</button>
                    </div>
                    <div class="form-group">
                        <a href="{{route('getLogin')}}" class="badge badge-success text-wrap">Đăng nhập</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-2"></div>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app/angular/angular.min.js') }}"></script>
    <script src="{{ asset('app/app.js') }}"></script>
    <script>
        app.controller('RegisterController', function($scope, $http, MainURL) {
            
        });
    </script>
</body>

</html>
