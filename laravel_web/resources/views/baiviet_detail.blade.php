@extends('index')
@section('title')
    Bài viết
@endsection

@section('body')
    <div class="col-md-12 mt-5" ng-controller="DetailController">
        <div class="row container-fluid">
            <div class="col-md-9" ng-repeat="i in infoDetail">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <a href="#" style="text-decoration: none;" ng-click="chudeClick(i.cd_id)"><%i.cd_chude%></a>
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
                <div class="text-right">
                    <h5><%i.nd_hoten%></h5>
                </div>
            </div>
            <div class="col-md-3">
                <h4><u>Tin tức liên quan</u></h4>
                <div class="card col-md-12 mb-3" ng-repeat="i in baiviet_lienquan" style="width: 20rem;">
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
            <div class="col-md-9">
                <hr>
                <h5>Ý kiến</h5>
                <form name="frmComment" method="post">
                    {{ csrf_field() }}
                    @if (Session::has('info'))
                        <div>
                            <input class="form-control form-control-lg" type="text" id="txtCmt" name="txtCmt"
                                placeholder="Ý kiến của bạn" ng-model="txtCmt" ng-required="true">
                            <small id="comment" class="form-text text-muted" ng-show="frmComment.txtCmt.$error.required">Hãy
                                nhập ý kiến của bạn</small>
                        </div>
                        <div class="text-right mt-2">
                            <button class="btn btn-outline-primary" type="submit" ng-disabled="frmComment.$invalid"
                                ng-click="comment(infoDetail[0].bv_id,{{ Session::get('info') }})"><i
                                    class="fa fa-comments"></i></button>
                        </div>
                    @else
                        <div class="mt-2 mb-2">
                            <small id="comment" class="form-text text-muted">Hãy
                                đăng nhập để bình luận</small>
                        </div>
                    @endif

                </form>
                <hr>
                <div ng-repeat="cmt in comments">
                    <p class="font-weight-normal">
                        <b><%cmt.nd_hoten%></b> <%cmt.bl_noidung%> <br>
                        <small class="text-muted">Vào lúc <% cmt.bl_thoigian %></small>
                    </p>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection
@section('angularJS')
    @parent
    <script>
        app.controller('DetailController', function($scope, $http, MainURL, $location) {
            $http.post($location.absUrl()).then(function(response) {
                $scope.infoDetail = response.data.infoBaiViet;
                $scope.comments = response.data.comments;
                console.log(response.data.infoBaiViet[0]);
                console.log(response.data.comments);
                console.log($scope.infoDetail[0].link_url);
                $http.post(MainURL + 'baiviet/lienquan/' + $scope.infoDetail[0].cd_id).then(function(e) {
                    $scope.baiviet_lienquan = e.data;
                    console.log(e.data);
                });
            });
            

            $scope.comment = function(id, user) {
                console.log(id);
                console.log(user);
                console.log($scope.txtCmt);
                var url = MainURL + 'comment/' + id;
                var data = {
                    'bl_noidung': $scope.txtCmt,
                    'nd_id': user
                };
                $http.post(url, data).then(function(response) {
                    location.reload();
                });
            };
            $scope.Xem = function(id){
                window.location.href = MainURL+'baiviet/detail/'+id;
            }

            $scope.chudeClick = function(id){
                console.log(id);
                window.location.href = MainURL+'search/chude/'+id;
            };
        });
    </script>
@endsection
