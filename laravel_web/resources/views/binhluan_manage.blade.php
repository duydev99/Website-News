@extends('index')
@section('title')
    Quản lý bình luận
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="BinhLuanController">
        <table class="table hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Người dùng</th>
                    <th>Bài viết</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='i in binhluan'>
                    <td><% i.bl_id%></td>
                    <td>
                        <a ng-click="user(i.nd_id)" href="" style="text-decoration: none"><% i.nd_hoten%></a>
                    </td>
                    <td>
                        <a ng-click="see(i.bv_id)" href="" style="text-decoration: none"><% i.bv_tieude%></a>
                    </td>
                    <td><% i.bl_noidung%></td>
                    <td><% i.bl_thoigian%></td>
                    <td>
                        <button class="badge badge-danger text-wrap" ng-click="del(i.bl_id)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><%tile%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" ng-repeat="i in baivietSee">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="#" style="text-decoration: none;"><%i.cd_chude%></a>
                            </div>
                            <div class="col-md-6 text-right">
                                <small class="text-muted">Vào lúc <% i.bv_thoigian %> <i class="fa fa-eye"></i>
                                    <%i.bv_view%></small>
                            </div>
                        </div>
                        <div>
                            <h1><%i.bv_tieude%></h1>
                        </div>
                        <div><a href="<%i.link_url%>" style="text-decoration: none;"><%i.link_url%></a></div>
                        <div class="mt-3 text-center">
                            <img ng-src="{{ asset('img/<%i.img_source%>') }}" style="height: 300px; width:100%"
                                class="img-fluid mb-2" alt="Responsive image">
                            <br>
                            <span class="text-muted">Hình ảnh liên quan.</span>
                        </div>
                        <div>
                            <p class="font-weight-normal"><%i.nd_noidung%></p>
                        </div>
                        <hr>
                        <div class="text-right">
                            <h5><%i.nd_hoten%></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><%tileUser%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-monospace"><b>ID:</b> <%User[0].nd_id%></p>
                        <p class="text-monospace"><b>Họ và tên:</b> <%User[0].nd_hoten%></p>
                        <p class="text-monospace"><b>Tài khoản:</b> <%User[0].nd_taikhoan%></p>
                        <p class="text-monospace">
                            <b>Loại người dùng:</b> 
                            <span ng-if="User[0].nd_loai == 0"><u>Quản trị</u></span>
                            <span ng-if="User[0].nd_loai == 1"><u>Tác giả</u></span>
                            <span ng-if="User[0].nd_loai == 2"><u>Đọc giả</u></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('angularJS')
    @parent
    <script>
        app.controller('BinhLuanController', function($scope, $http, MainURL) {
            $http.get(MainURL + 'binhluan/manage/list').then(function(response) {
                $scope.binhluan = response.data;
            });

            $scope.see = function(id) {
                $('#detail').modal('show');
                $scope.tile = "Chi tiết bài viết";
                $http.post(MainURL + 'baiviet/see/' + id).then(function(response) {
                    $scope.baivietSee = response.data;
                });
            };

            $scope.user = function(id) {
                $('#user').modal('show');
                $scope.tileUser = 'Thông tin người dùng';
                $http.get(MainURL + 'user/edit/' + id).then(function(response) {
                    $scope.User = response.data;
                });
            };

            $scope.del = function(id) {
                var conf = confirm("Bạn chắc chắn muốn xóa?");
                if (conf) {
                    var url = MainURL + 'binhluan/delete/' + id;
                    $http.post(url).then(function(response) {
                        alert(response.data);
                        location.reload();
                    });
                }
            };
        });
    </script>
@endsection
