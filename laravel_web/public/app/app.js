var app = angular.module('my-app', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol("<%");
    $interpolateProvider.endSymbol("%>");
}).constant("MainURL", "http://localhost/laravel_web/public/");