<div class="panel panel-default">
    <div class="panel-heading">
        <div class="media-left">
            <img class="media-object" src="https://www.themoviedb.org/assets/41bdcf10bbf6f84c0fc73f27b2180b95/images/v4/logos/91x81.png" alt="The Movie Database">
        </div>
        <div class="media-body">
            <h3 class="media-heading" style="margin: 28px 0 24px 24px">Módulo de integração com o The Movie Database</h3>
        </div>
    </div>
    <div class="panel-body">



        <div ng-app="myApp" ng-controller="movieSearchCtrl"> 
            <fieldset >

                <div class="well">
                    <h3>Buscar filme</h3>
                    <div class="input-group col-lg-12">
                        <input ng-change="search()" ng-model="searchString" placeholder="Digite o nome do filme para buscar" class="form-control col-lg-6"/>
                    </div>
                    <p>{{msg}}</p>
                </div>
            </fieldset>

            
            <div class="row">
                <div class="col-sm-2" ng-repeat="movie in results">
                    <div class="thumbnail">
                        <a ng-if="movie.poster_path">
                            <img src="https://image.tmdb.org/t/p/w150/{{movie.poster_path}}" class="left" width="300" alt="{{movie.title}}">
                        </a>
                        <div class="caption">
                            <h3>{{ movie.title}}</h3>
                            <p>{{movie.overview}}</p>
                            <p><a href="#" class="btn btn-primary" role="button">Detalhes</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
                
            <h3>Últimos lançamentos</h3>
            <div class="row">
                <div class="col-sm-2">
                    <div class="thumbnail">
                        <a ng-if="latest.poster_path">
                            <img src="https://image.tmdb.org/t/p/w150/{{latest.poster_path}}" class="left" width="300" alt="{{latest.title}}">
                        </a>
                        <div class="caption">
                            <h3>{{ latest.title}}</h3>
                            <h4>{{latest.release_date}}</h4>
                            <p>{{latest.overview}}</p>
                            <p><a href="#" class="btn btn-primary" role="button">Ver Detalhes</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
<script src="view/javascript/extension/module/themoviedb/searchCtrl.js"></script>