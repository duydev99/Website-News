@extends('index')
@section('title')
    Tạo mới chủ đề
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="ChuDeController">
        <form name="frmAdd" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="chude">Chủ đề</label>
                <input type="text" class="form-control" id="txtChuDe" name="txtChuDe"
                    ng-model="txtChuDe" ng-required="true">
                <small id="hoten" class="form-text text-muted"
                    ng-show="frmAdd.txtChuDe.$error.required">Hãy nhập thông tin</small>
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
        app.controller('ChuDeController', function($scope, $http, MainURL) {
            $scope.save = function() {
                var url = MainURL + 'chude/add';
                var data = 
                {
                    'cd_chude':$scope.txtChuDe
                };
                $http.post(url,data).then(function(response){
                    alert(response.data);
                    if(response.data == "Tạo mới thành công") location.reload();
                    
                })
            };
        });
    </script>
@endsection
