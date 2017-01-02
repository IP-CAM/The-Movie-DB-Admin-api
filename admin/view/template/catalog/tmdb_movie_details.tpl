<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <link type="text/css" href="view/stylesheet/extension/dashboard/tmdb.css" rel="stylesheet" media="screen" />
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="index.php?route=catalog/tmdb_movie/add&token=<?php echo $token; ?>&movie_id=<?php echo $movieId; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-attribute-group').submit() : false;"><i class="fa fa-trash-o"></i></button>
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

        <div class="panel panel-default" ng-app="myApp" ng-controller="movieDetailsCtrl">
            <div class="panel-heading" ng-init="getMovie('<?php echo $movieId; ?>')">
                <h2>{{movie.title}}</h2>
            </div>
            <div class="panel-body">
                <a ng-if="movie.poster_path">
                    <img src="https://image.tmdb.org/t/p/w150/{{movie.poster_path}}" class="left" width="300" alt="{{latest.title}}">
                </a>
                <div class="no-image col-lg-2" ng-if="!movie.poster_path">
                    <i class="fa fa-minus-circle"></i>
                    <br>
                        Sem capa cadastrada
                </div>
                <div class="col-lg-10">
                    <span ng-if="movie.release_date">Data de lançamento {{movie.release_date}}</span>
                    <span ng-if="!movie.release_date">Sem data de lançamento cadastrada</span>
                    <span ng-if="movie.overview">{{movie.overview}}</span>
                    <span ng-if="!movie.overview">Nenhuma descrição cadastrada para esse filme</span>
                </div>
                <div class='row'>
                    <p><a href="index.php?route=catalog/tmdb_movie/add&token=<?php echo $token; ?>&movie_id=<?php echo $movieId; ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Adicionar aos meus filmes</a></p>
                </div>    
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
<script src="view/javascript/extension/module/themoviedb/detailsCtrl.js"></script>
<?php echo $footer; ?>