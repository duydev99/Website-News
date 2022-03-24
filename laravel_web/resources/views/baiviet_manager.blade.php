@extends('index')
@section('title')
    Quản lý bài viết
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="BaiVietManageController">
        <table class="table hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>View</th>
                    <th>Status</th>
                    <th>Detail</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='i in baivietManage'>
                    <td><% i.bv_id%></td>
                    <td><% i.bv_tieude%></td>
                    <td><% i.nd_hoten%></td>
                    <td><% i.bv_view%></td>
                    <td>
                        <a href="" style="text-decoration: none">
                            <span class="badge badge-danger text-wrap" ng-if="i.bv_status == 0" style="width: 6rem;"
                                ng-click="status(i.bv_id)">Chưa duyệt</span>
                        </a>
                        <a href="" style="text-decoration: none">
                            <span class="badge badge-success text-wrap" ng-if="i.bv_status == 1" style="width: 6rem;"
                                ng-click="status(i.bv_id)">Đã duyệt</span>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary" ng-click="detail(i.bv_id)">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger" ng-click="del(i.bv_id)">
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

    </div>


@endsection
@section('angularJS')
    @parent
    <script>
        app.controller('BaiVietManageController', function($scope, $http, MainURL) {
            $http.post(MainURL + 'baiviet/manage').then(function(response) {
                $scope.baivietManage = response.data;
            });

            $scope.status = function(id) {
                $http.post(MainURL + 'baiviet/status/' + id).then(function(response) {
                    location.reload();
                });
            };

            $scope.detail = function(id) {
                $('#detail').modal('show');
                $scope.tile = "Chi tiết bài viết";
                $http.post(MainURL + 'baiviet/see/' + id).then(function(response) {
                    $scope.baivietSee = response.data;
                });
            };

            $scope.del = function(id) {
                var conf = confirm("Bạn chắc chắn muốn xóa?");
                if (conf) {
                    var url = MainURL + 'baiviet/del/' + id;
                    $http.post(url).then(function(response) {
                        alert(response.data);
                        location.reload();
                    });
                }
            };
        });
    </script>
@endsection
