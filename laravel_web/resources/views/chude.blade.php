@extends('index')
@section('title')
    Danh sách chủ đề
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="ChuDeController">
        <table class="table hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Chủ đề</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat='i in chude'>
                    <td><% i.cd_id%></td>
                    <td><% i.cd_chude%></td>
                    <td>
                        <button class="btn btn-outline-primary" ng-click="edit(i.cd_id)">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger" ng-click="del(i.cd_id)">
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
                                <input type="text" class="form-control" id="cd_id" name="cd_id" ng-model="ChuDe[0].cd_id"
                                    ng-readonly="true">
                            </div>
                            <div class="form-group">
                                <label for="chude">Chủ đề</label>
                                <input type="text" class="form-control" id="cd_chude" name="cd_chude"
                                    ng-model="ChuDe[0].cd_chude" ng-required="true">
                                <small id="hoten" class="form-text text-muted"
                                    ng-show="frmEdit.cd_chude.$error.required">Hãy nhập thông tin</small>
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
        app.controller('ChuDeController', function($scope, $http, MainURL) {
            $http.get(MainURL + 'chude/list/').then(function(response) {
                $scope.chude = response.data;
            });

            $scope.edit = function(id) {
                $scope.tile = "Cập nhật chủ đề";
                $('#edit').modal('show');
                $http.get(MainURL + 'chude/edit/' + id).then(function(response) {
                    $scope.ChuDe = response.data;
                });
            };
            $scope.save = function() {
                var url = MainURL + 'chude/edit/' + $scope.ChuDe[0].cd_id;
                var data = 
                {
                    'cd_chude':$scope.ChuDe[0].cd_chude
                };
                $http.post(url,data).then(function(response){
                    alert(response.data);
                    if(response.data == "Cập nhật thành công")location.reload();
                });
            };
            $scope.del = function(id){
                var conf = confirm("Bạn chắc chắn muốn xóa?");
                if(conf){
                    var url = MainURL + 'chude/del/' + id;
                    $http.post(url).then(function(response){
                        alert(response.data);
                        location.reload();
                    });
                }
            };
        });
    </script>
@endsection
