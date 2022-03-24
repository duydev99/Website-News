@extends('index')
@section('title')
    Danh sách chủ đề
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="BaiVietController">
        <table class="table hover table-responsive">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Thời gian tạo</th>
                    {{-- <th>Tác giả</th> --}}
                    <th>Chủ đề</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Link</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='i in baiviet'>
                    <td><% i.bv_id%></td>
                    <td><% i.bv_tieude%></td>
                    <td><% i.bv_thoigian%></td>
                    <td><%i.cd_chude%></td>
                    <td>
                        <span class="badge badge-danger text-wrap" ng-if="i.bv_status == 0">Chưa duyệt</span>
                        <span class="badge badge-success text-wrap" ng-if="i.bv_status == 1">Đã duyệt</span>
                    </td>
                    <td>
                        <button class="badge badge-primary text-wrap" ng-click="edit(i.bv_id)">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button class="badge badge-danger text-wrap" ng-click="del(i.bv_id)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    <td>
                        <button class="badge badge-primary text-wrap" ng-click="link(i.bv_id)">
                            <i class="fa fa-link"></i>
                        </button>
                    </td>
                    <td>
                        <button class="badge badge-primary text-wrap" ng-click="image(i.bv_id)">
                            <i class="fa fa-image"></i>
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
                        <h5 class="modal-title" id="exampleModalLabel"><%Edit%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="frmEdit" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="chude"> Chọn chủ đề</label>
                                <select name="txtChuDe" id="txtChuDe" class="form-control" ng-model="txtChuDe"
                                    ng-required="true">
                                    <option ng-value="i.cd_id" ng-repeat=" i in chude_list ">
                                        <% i.cd_chude %>
                                    </option>
                                </select>
                                <small id="chude" class="form-text text-muted"
                                    ng-show="frmEdit.txtChuDe.$error.required">Hãy nhập
                                    thông tin</small>
                            </div>
                            <div class="form-group">
                                <label for="tieude">Tiêu đề</label>
                                <input type="text" class="form-control" id="bv_tieude" name="bv_tieude"
                                    ng-model="baiviet_edit.bv_tieude" ng-required="true">
                                <small id="tieude" class="form-text text-muted"
                                    ng-show="frmEdit.bv_tieude.$error.required">Hãy nhập thông
                                    tin</small>
                            </div>
                            <div class="form-group">
                                <label for="noidung">Nội dung</label>
                                <textarea name="nd_noidung" id="nd_noidung" class="form-control mt-1" rows="10"
                                    ng-model="baiviet_edit.nd_noidung" ng-required="true"></textarea>
                                <small id="noidung" class="form-text text-muted"
                                    ng-show="frmEdit.nd_noidung.$error.required">Hãy nhập
                                    thông tin</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" ng-disabled="frmEdit.$invalid"
                                ng-click="update(baiviet_edit.bv_id)">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="link" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><%Link%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="frmLink" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="link">Url</label>
                                <input type="text" class="form-control" id="baiviet_link" name="baiviet_link"
                                    ng-model="baiviet_link.link_url" ng-required="true">
                                <small id="link" class="form-text text-muted" ng-show="frmLink.link_url.$error.required">Hãy
                                    nhập thông
                                    tin</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" ng-disabled="frmLink.$invalid"
                                ng-click="updateLink(baiviet_link.link_id,baiviet_link_id)">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><%Image%></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="frmImage" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body text-center">
                            <div class="card" style="width:18rem;">
                                <img ng-src="{{ asset('img/<%baiviet_image.img_source%>') }}" 
                                width="300px" height= "150px" class="card-img-center"
                                    alt="...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img">Hình ảnh</label>
                            <input type="file" file-model="files" class="form-control" required ng-required="true">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" ng-disabled="frmImage.$invalid"
                                ng-click="updateImage(baiviet_image.img_id,baiviet_image.bv_id)">Lưu</button>
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
        app.directive('fileModel', ['$parse', function($parse) {
            return {
                restrict: 'A',
                link: function(scope, element, attrs) {
                    element.bind('change', function() {
                        $parse(attrs.fileModel).assign(scope, element[0].files)
                        scope.$apply();
                    });
                }
            };
        }]);
        app.controller('BaiVietController', function($scope, $http, MainURL) {

            $scope.tacgiaID = {{ Session::get('info') }};

            $http.get(MainURL + 'baiviet/list/' + $scope.tacgiaID).then(function(response) {
                $scope.baiviet = response.data.listBaiViet;
            });

            $http.get(MainURL + 'chude/list/').then(function(response) {
                $scope.chude_list = response.data;
            });

            $scope.edit = function(id) {
                $scope.Edit = "Cập nhật bài viết";
                $('#edit').modal('show');
                $http.get(MainURL + 'baiviet/edit/' + id).then(function(response) {
                    $scope.baiviet_edit = response.data.editBaiViet[0];
                    console.log(id);
                    console.log(response.data.editBaiViet[0]);
                });
            };
            $scope.update = function(id) {
                var url = MainURL + 'baiviet/edit/' + id;
                var data = {
                    'bv_tieude': $scope.baiviet_edit.bv_tieude,
                    'cd_id': $scope.txtChuDe,
                    'nd_noidung': $scope.baiviet_edit.nd_noidung
                };
                $http.post(url, data).then(function(response) {
                    alert(response.data);
                    location.reload();
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

            //Link
            $scope.link = function(id) {
                $scope.Link = "Cập nhật link share";
                $('#link').modal('show');
                $http.get(MainURL + 'link/edit/' + id).then(function(response) {
                    $scope.baiviet_link = response.data.edit[0];
                    $scope.baiviet_link_id = response.data.idbv;
                    console.log(response.data);
                    console.log($scope.baiviet_link_id);
                });
            };
            $scope.updateLink = function(id) {
                var url = MainURL + 'link/edit/' + id;
                var data = {
                    'link_url': $scope.baiviet_link.link_url,
                    'bv_id':$scope.baiviet_link_id
                };
                $http.post(url, data).then(function(response) {
                    alert(response.data);
                    location.reload();
                });
            };

            //Image
            $scope.image = function(id) {
                $scope.Image = "Cập nhật hình ảnh";
                $('#image').modal('show');
                $http.get(MainURL + 'image/edit/' + id).then(function(response) {
                    $scope.baiviet_image = response.data[0];
                    console.log(response.data)
                });
            };
            $scope.updateImage = function(id,idbv) {
                if ($scope.files != null) {
                    var fd = new FormData();
                    fd.append('img', $scope.files[0]);
                    var url = MainURL + 'image/edit/' + id+'/baiviet/'+idbv;
                    $http.post(url, fd, {
                        withCredentials: true,
                        headers: {
                            'Content-Type': undefined
                        },
                        transformRequest: angular.identity
                    }).then(function(response) {
                        alert(response.data);
                        location.reload();
                    });
                }
                console.log($scope.files);
            };
        });
    </script>
@endsection
