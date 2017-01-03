/**
 * @author Michel Lima
 * @type angular.module.angular-1_3_6_L1749.moduleInstance
 */

var app = angular.module('myApp', []);
app.controller('userMoviessCtrl', function ($scope, $http) {
    api_key = "b194419a3560ccbbfd27972fcad10634";
    $scope.movies = [];
    $scope.results = "";
    
    $scope.getUserMovies = function(movies){
        var list = JSON.parse("[" + movies + "]");
        list.forEach(getMovies);
        
    };
        function getMovies(movieId){
            url = "https://api.themoviedb.org/3/movie/";
            $http.get(
                    url
                    + movieId + "?"
                    + "api_key=" + api_key
                    + "&language=pt-BR"

                    ).then(function (response) {
                $scope.movies.push(response.data);
            });
            $scope.results = $scope.movies;
        }


});