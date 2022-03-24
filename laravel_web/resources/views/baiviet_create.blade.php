@extends('index')
@section('title')
    Tạo mới bài viết
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="BaiVietController">
        <form name="frmCreate" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="chude"> Chọn chủ đề</label>
                <select name="txtChuDe" id="txtChuDe" class="form-control" ng-model="txtChuDe" ng-required="true">
                    <option ng-value="i.cd_id" ng-repeat=" i in chude_list ">
                        <% i.cd_chude %>
                    </option>
                </select>
                <small id="chude" class="form-text text-muted" ng-show="frmCreate.txtChuDe.$error.required">Hãy nhập
                    thông tin</small>
            </div>
            <div class="form-group">
                <label for="tieude">Tiêu đề</label>
                <input type="text" class="form-control" id="txtTieuDe" name="txtTieuDe" ng-model="txtTieuDe"
                    ng-required="true">
                <small id="tieude" class="form-text text-muted" ng-show="frmCreate.txtTieuDe.$error.required">Hãy nhập thông
                    tin</small>
            </div>
            <div class="form-group">
                <label for="noidung">Nội dung</label>
                <textarea name="txtNoiDung" id="txtNoiDung" class="form-control mt-1" rows="10" ng-model="txtNoiDung"
                    ng-required="true"></textarea>
                <small id="noidung" class="form-text text-muted" ng-show="frmCreate.txtNoiDung.$error.required">Hãy nhập
                    thông tin</small>
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="txtLink" name="txtLink" ng-model="txtLink">
                <small id="link" class="form-text text-muted">Có thể
                    để trống
                </small>
            </div>

            <div class="form-group">
                <label for="img">Hình ảnh</label>
                <input type="file" file-model="files" class="form-control" required ng-required="true">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-disabled="frmCreate.$invalid"
                    ng-click="save()">Tạo</button>
            </div>
        </form>
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
            $http.get(MainURL + 'chude/list/').then(function(response) {
                $scope.chude_list = response.data;
            });
            $scope.txtTacGia = {{ Session::get('info') }};
            $scope.save = function() {
                if ($scope.files != null) {
                    //Info
                    var url = MainURL + 'baiviet/create';
                    var data = {
                        'bv_tieude': $scope.txtTieuDe,
                        'bv_tacgia': $scope.txtTacGia,
                        'cd_id': $scope.txtChuDe
                    };
                    $http.post(url, data).then(function(response) {
                        //Content
                        var url2 = MainURL + 'noidung/add';
                        var data2 = {
                            'nd_noidung': $scope.txtNoiDung,
                            'bv_id': response.data
                        };
                        $http.post(url2, data2).then(function(e) {});

                        //Images

                        var fd = new FormData();
                        fd.append('img', $scope.files[0]);
                        var url3 = MainURL + 'image/add/' + response.data;
                        $http.post(url3, fd, {
                            withCredentials: true,
                            headers: {
                                'Content-Type': undefined
                            },
                            transformRequest: angular.identity
                        }).then(function(r) {
                            console.log($scope.files[0]);
                            console.log(r);
                            console.log(r.data);
                        });


                        //Link
                        if ($scope.txtLink != null) {
                            var url4 = MainURL + 'link/add';
                            var data4 = {
                                'link_url': $scope.txtLink,
                                'bv_id': response.data
                            };
                            $http.post(url4, data4).then(function(e) {});
                        }
                        alert("Tạo mới thành công");
                        location.reload();
                    });
                }
            };

            $scope.link = function() {
                if ($scope.txtOpt === true) $scope.Opt = 1;
                else $scope.Opt = 0;
            };
        });
    </script>
@endsection
