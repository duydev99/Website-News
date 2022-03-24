@extends('index')
@section('title')
    Danh sách người dùng
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="NguoiDungController">
        <table class="table hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Họ tên</th>
                    <th>Tài khoản</th>
                    <th>Mật khẩu</th>
                    <th>Phân loại</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='i in Users'>
                    <td><% i.nd_id%></td>
                    <td><% i.nd_hoten%></td>
                    <td><% i.nd_taikhoan%></td>
                    <td><% i.nd_matkhau%></td>
                    <td>
                        <span ng-if='i.nd_loai == 0'>Quản trị</span>
                        <span ng-if='i.nd_loai == 1'>Tác giả</span>
                        <span ng-if='i.nd_loai == 2'>Đọc giả</span>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary" ng-click="edit(i.nd_id)">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger" ng-click="del(i.nd_id)">
                            <i class="fa fa-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Modal -->

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><%tile%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="frmEdit" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id">Id</label>
                                <input type="text" class="form-control" id="nd_id" name="nd_id" ng-model="User[0].nd_id"
                                    ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label for="name">Họ tên</label>
                                <input type="text" class="form-control" id="nd_hoten" name="nd_hoten"
                                    ng-model="User[0].nd_hoten" ng-required="true">
                                <small id="hoten" class="form-text text-muted"
                                    ng-show="frmEdit.nd_hoten.$error.required">Hãy nhập thông tin</small>
                            </div>
                            <div class="form-group">
                                <label for="username">Tài khoản</label>
                                <input type="text" class="form-control" id="nd_taikhoan" name="nd_taikhoan"
                                    ng-model="User[0].nd_taikhoan" ng-required="true">
                                <small id="taikhoan" class="form-text text-muted"
                                    ng-show="frmEdit.nd_taikhoan.$error.required">Hãy nhập thông tin</small>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="nd_matkhau" name="nd_matkhau"
                                    ng-model="User[0].nd_matkhau" ng-required="true">
                                <small id="matkhau" class="form-text text-muted"
                                    ng-show="frmEdit.nd_matkhau.$error.required">Hãy nhập thông tin</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" ng-disabled="frmEdit.$invalid" ng-click="save()">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
@section('angularJS')
    @parent
    <script>
        app.controller('NguoiDungController', function($scope, $http, MainURL) {
            $http.get(MainURL + 'user/list/').then(function(response) {
                $scope.Users = response.data;
            });

            $scope.edit = function(id) {
                $scope.tile = "Cập nhật người dùng";
                $('#edit').modal('show');
                $http.get(MainURL + 'user/edit/' + id).then(function(response) {
                    $scope.User = response.data;
                    $scope.User[0].nd_matkhau = "";
                });
            };
            $scope.save = function() {
                var url = MainURL + 'user/edit/' + $scope.User[0].nd_id;
                var data = 
                {
                    'nd_hoten':$scope.User[0].nd_hoten,
                    'nd_taikhoan':$scope.User[0].nd_taikhoan,
                    'nd_matkhau':$scope.User[0].nd_matkhau
                };
                $http.post(url,data).then(function(response){
                    alert(response.data);
                    if(response.data == "Cập nhật thành công") location.reload();
                });
            };
            $scope.del = function(id){
                var conf = confirm("Bạn chắc chắn muốn xóa?");
                if(conf){
                    var url = MainURL + 'user/del/' + id;
                    $http.post(url).then(function(response){
                        alert(response.data);
                        location.reload();
                    });
                }
            };
        });
    </script>
@endsection
