<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <link type="text/css" href="view/stylesheet/extension/dashboard/tmdb.css" rel="stylesheet" media="screen" />
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
    </div>
    <div class="panel panel-default" ng-app="myApp" ng-controller="userMoviessCtrl">
        <?php if($movies != ""){ ?>
        <div class="panel-heading">
            <h3 ng-init="getUserMovies('<?php echo $movies; ?>')">Filmes do usuário</h3>
        </div>
        <div class="panel-body">

            <div class="col-sm-2" ng-repeat="movie in results">
                <div class="thumbnail">
                    <a ng-if="movie.poster_path">
                        <img src="https://image.tmdb.org/t/p/w150/{{movie.poster_path}}" class="left" width="300" alt="{{movie.title}}">
                    </a>
                    <div class="no-image" ng-if="!movie.poster_path">
                        <i class="fa fa-minus-circle"></i>
                        <br>
                            Sem capa cadastrada
                    </div>
                    <div class="caption">
                        <h4>{{ movie.title}}</h4>
                        <p><a href="index.php?route=catalog/tmdb_movie/moviedetails&token=<?php echo $token; ?>&movie_id={{movie.id}}" class="btn btn-primary" role="button">Ver Detalhes</a></p>
                        <p><a href="index.php?route=catalog/tmdb_movie/remove&token=<?php echo $token; ?>&movie_id={{movie.id}}" class="btn btn-danger" role="button">Remover filme</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ ?>
            <div class="panel-heading">
                <h3>Nenhum filme cadastrado para este usuário</h3>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
<script src="view/javascript/extension/module/themoviedb/userMoviesCtrl.js"></script>
<?php echo $footer; ?>