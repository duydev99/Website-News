<!DOCTYPE html>
<html lang="en" ng-app="my-app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <form method="POST" name="frmLogin" action="{{route('postLogin')}}" ng-controller="LoginController">
        {{csrf_field ()}}
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4 col-sm-2"></div>
                <div class="col-md-4 col-sm-8 col-12 bg-light">
                    <div class="text-center mt-3 mb-3">
                        <h5>Đăng Nhập Người Dùng</h3>
                    </div>
                    @if (Session::has('error'))
                        <small id="emailHelp" class="form-text text-muted text-danger">Thông tin sai, vui lòng kiểm tra lại.</small>
                    @endif
                    <div class="form-group">
                        <label for="lblUsername">Tài khoản</label>
                        <input type="text" id="txtUsername" name="txtUsername"
                         class="form-control form-control-sm" ng-model="txtUsername" ng-required="true">
                         <small id="Username" class="form-text text-muted"
                         ng-show="frmLogin.txtUsername.$error.required">Hãy nhập tài khoản</small>
                    </div>
                    <div class="form-group">
                        <label for="lblPassword">Mật khẩu</label>
                        <input type="password" id="txtPassword" name="txtPassword"
                         class="form-control form-control-sm" ng-model="txtPassword" ng-required="true">
                         <small id="Username" class="form-text text-muted"
                         ng-show="frmLogin.txtPassword.$error.required">Hãy nhập mật khẩu</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnLogin" name="btnLogin" ng-disabled="frmLogin.$invalid"
                        class="btn btn-info">Đăng nhập</button>
                    </div>
                    <div class="form-group">
                        <a href="{{route('register')}}" class="badge badge-success text-wrap">Đăng ký</a>
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
        app.controller('LoginController', function($scope, $http, MainURL) {
            
        });
    </script>
</body>

</html>
