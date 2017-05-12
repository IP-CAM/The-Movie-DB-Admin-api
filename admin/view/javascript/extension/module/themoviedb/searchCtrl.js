/**
 * @author Michel Lima
 * @type angular.module.angular-1_3_6_L1749.moduleInstance
 */

var app = angular.module('myApp', []);
app.controller('movieSearchCtrl', function ($scope, $http) {
    api_key = "b194419a3560ccbbfd27972fcad10634";
    $scope.searchString = "";
    $scope.msg = "";
    
    
    $scope.upcomming = function(){
        url = "https://api.themoviedb.org/3/movie/upcoming?api_key=";
        $http.get(
                url
                + api_key
                + "&language=pt-BR"
                + "&sort_by=primary_release_date.desc"
                ).then(function (response) {
            $scope.results = response.data.results;
        });    
    }
    
    $scope.latest = function(){
        url = "https://api.themoviedb.org/3/movie/latest?api_key=";
        $http.get(
                url
                + api_key
                + "&language=pt-BR"

                ).then(function (response) {
            console.log(response.data);
            $scope.latest = response.data;
        });
    }

    

    $scope.search = function () {
        if ($scope.searchString.length > 2) {
            url = "https://api.themoviedb.org/3/search/movie?api_key=";
            $http.get(
                    url
                    + api_key
                    + "&language=pt-BR"
                    + "&query=" + $scope.searchString
                    ).then(function (response) {
                $scope.results = response.data.results;
                $scope.msg = $scope.searchString;
            });
        } else {
            $scope.msg = "Digite um nome válido";
            $scope.results = "";
            $scope.upcomming();
        }
    }

});