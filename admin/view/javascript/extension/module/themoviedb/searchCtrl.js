var app = angular.module('myApp', []);
app.controller('movieSearchCtrl', function($scope, $http) {
  api_key = "b194419a3560ccbbfd27972fcad10634";
  $scope.searchString = "";
  $scope.msg = "";
        
  $scope.search = function(){
    if($scope.searchString.length > 2){
        $http.get(
                "https://api.themoviedb.org/3/search/movie?api_key="+api_key+"&query=" + $scope.searchString
        ).then(function (response) {
            $scope.results = response.data.results;
            $scope.msg =  $scope.searchString;
        });
    }else{
        $scope.msg = "Insira um valor maior que 2";
        $scope.results = "";
    }
  }
  
});