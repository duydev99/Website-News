@extends('index')
@section('title')
    Lọc theo thể loại
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="SearchTypeController">
        <div class="row container-fluid">
            <div class="col-md-8">
                <h4><u>Lọc theo chủ đề</u></h4>
                <div class="card mb-3" ng-repeat="i in searchChude">
                    <a href="" ng-click="Xem(i.bv_id)" style="text-decoration: none;color:black">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img ng-src="{{ asset('img/<%i.img_source%>') }}" height="205px" class="card-img" alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><% i.bv_tieude %></h5>
                                    <p class="card-text"><i><% i.cd_chude %></i></p>
                                    <p class="card-text">Đăng bởi <u><% i.nd_hoten %></u></p>
                                    <p class="card-text">
                                        <small class="text-muted">Vào lúc <% i.bv_thoigian %> <i
                                                class="fa fa-eye"></i> <%i.bv_view%></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <h4><u>Xem nhiều</u></h4>
                <div class="card col-md-12 mb-3" ng-repeat="i in index_top" style="width: 20rem;">
                    <a href="" ng-click="Xem(i.bv_id)" style="text-decoration: none;color:black">
                        <img ng-src="{{ asset('img/<%i.img_source%>') }}" height="150px" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><% i.bv_tieude %></h5>
                            <p class="card-text">
                                <small class="text-muted">Vào lúc <% i.bv_thoigian %> <i class="fa fa-eye"></i>
                                    <%i.bv_view%></small>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('angularJS')
    @parent
    <script>
        app.controller('SearchTypeController', function($scope, $http, MainURL,$location) {
            $http.post($location.absUrl()).then(function(response) {
                $scope.searchChude = response.data;
                console.log(response.data);
            });

            $http.get(MainURL + 'baiviet/top10').then(function(response) {
                $scope.index_top = response.data;
                console.log(response.data);
            });

            $scope.Xem = function(id){
                window.location.href = MainURL+'baiviet/detail/'+id;
            }
        });
    </script>
@endsection
