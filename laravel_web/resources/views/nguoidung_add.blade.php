@extends('index')
@section('title')
    Tạo mới người dùng
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="NguoiDungController">
        <form name="frmAdd" method="post">
            {{csrf_field()}}
            {{-- <div class="form-group">
                <label for="id">Id</label>
                <input type="text" class="form-control" id="txtId" name="txtId" ng-model="txtId" ng-required="true">
                <small id="id" class="form-text text-muted"
                ng-show="frmAdd.txtId.$error.required">Hãy nhập thông tin</small>
            </div> --}}
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" class="form-control" id="txtName" name="txtName"
                    ng-model="txtName" ng-required="true">
                <small id="hoten" class="form-text text-muted"
                    ng-show="frmAdd.txtName.$error.required">Hãy nhập thông tin</small>
            </div>
            <div class="form-group">
                <label for="username">Tài khoản</label>
                <input type="text" class="form-control" id="txtUsername" name="txtUsername"
                    ng-model="txtUsername" ng-required="true">
                <small id="taikhoan" class="form-text text-muted"
                    ng-show="frmAdd.txtUsername.$error.required">Hãy nhập thông tin</small>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="txtPassword" name="txtPassword"
                    ng-model="txtPassword" ng-required="true">
                <small id="matkhau" class="form-text text-muted"
                    ng-show="frmAdd.txtPassword.$error.required">Hãy nhập thông tin</small>
            </div>
            <div class="form-group">
                <label for="type">Loại người dùng</label>
                <select name="txtType" id="txtType" ng-model="txtType" class="form-control">
                    {{-- <option value="-1">---Chọn---</option> --}}
                    <option value="0">Quản trị</option>
                    <option value="1">Tác giả</option>
                    <option value="2">Đọc giả</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-disabled="frmAdd.$invalid" ng-click="save()">Lưu</button>
            </div>
        </form>
    </div>


@endsection
@section('angularJS')
    @parent
    <script>
        app.controller('NguoiDungController', function($scope, $http, MainURL) {
            $scope.save = function() {
                var url = MainURL + 'user/add';
                var data = 
                {
                    'nd_hoten':$scope.txtName,
                    'nd_taikhoan':$scope.txtUsername,
                    'nd_matkhau':$scope.txtPassword,
                    'nd_loai':$scope.txtType
                };
                console.log(data);
                $http.post(url,data).then(function(response){
                    alert(response.data);
                    location.reload();
                })
            };
        });
    </script>
@endsection
