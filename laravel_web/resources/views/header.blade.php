<nav class="navbar navbar-expand-lg navbar-light bg-light" ng-controller="HeaderController">
    <a class="navbar-brand" href="{{ route('home') }}">Trang chủ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0" name="frmSearch" method="post">
            {{ csrf_field() }}
            <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm" 
            ng-model="txtSearch" ng-required="true">
            <button class="btn btn-light my-2 my-sm-0" ng-click="search()" ng-disabled="frmSearch.$invalid" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Thể loại
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" ng-repeat="i in listCD" 
                    ng-click="searchTheLoai(i.cd_id)"><% i.cd_chude%></a>
                </div>
            </li>
        </ul>
        @if (Session::has('info'))
            <!-- Example single danger button -->
            <div class="btn-group m-2 text-center">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-user-circle"></i>{{Session::get('name')}}
                </button>
                <div class="dropdown-menu">
                    @if (Session::get('type')==0)
                        <a class="dropdown-item" href="{{ route('listUS') }}">Quản lý người dùng</a>
                        <a class="dropdown-item" href="{{ route('addUS') }}">Thêm người dùng</a>
                        <a class="dropdown-item" href="{{ route('dsChuDe') }}">Quản lý chủ đề</a>
                        <a class="dropdown-item" href="{{ route('addChude') }}">Thêm chủ đề</a>
                        <a class="dropdown-item" href="{{ route('baivietManage') }}">Quản lý bài viết</a>
                        <a class="dropdown-item" href="{{ route('binhluanManage') }}">Quản lý bình luận</a>
                    @elseif(Session::get('type')==1)
                        <a class="dropdown-item" href="{{ route('createBaiViet') }}">Tạo bài viết</a>
                        <a class="dropdown-item" href="{{ route('listBaiViet') }}">Quản lý bài viết</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('LogOut') }}" class="dropdown-item">
                        <button class="btn btn-outline-danger">Đăng xuất</button>
                    </a>
                </div>
            </div>
        @else
            <a href="{{ route('getLogin') }}">
                <button class="btn btn-light">Đăng nhập</button>
            </a>
        @endif
    </div>
</nav>

@section('angularJS')
    @parent
    <script>
        app.controller('HeaderController', function($scope, $http, MainURL) {
            $http.get(MainURL + 'chude/list/').then(function(response) {
                $scope.listCD = response.data;
            });

            $scope.searchTheLoai = function(id){
                console.log(id);
                window.location.href = MainURL+'search/chude/'+id;
            };

            $scope.search = function(){
                window.location.href = MainURL+'search/'+$scope.txtSearch;
                console.log($scope.txtSearch);
            };
        });
    </script>
@endsection
