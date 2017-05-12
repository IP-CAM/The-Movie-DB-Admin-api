<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <link type="text/css" href="view/stylesheet/extension/dashboard/tmdb.css" rel="stylesheet" media="screen" />
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="index.php?token=<?php echo $token; ?>" data-toggle="tooltip" title="Voltar" class="btn btn-default"><i class="fa fa-reply"></i></a>
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

    <div class="panel panel-default" ng-app="myApp" ng-controller="movieDetailsCtrl">
        <div class="panel-heading" ng-init="getMovie('<?php echo $movieId; ?>')">
            <h2>{{movie.title}}</h2>
        </div>
        <div class="panel-body">

            <a ng-if="movie.poster_path" class="pull-left">
                <img src="https://image.tmdb.org/t/p/w150/{{movie.poster_path}}" class="left" width="300" alt="{{latest.title}}">
            </a>
            <div class="no-image col-lg-2" ng-if="!movie.poster_path">
                <i class="fa fa-minus-circle"></i>
                <br>
                    Sem capa cadastrada
            </div>
            <div class="col-md-5" style="margin: 0 0 0 15px" >
                
                <h3 ng-if="movie.release_date" class="date">Data de lançamento: {{movie.release_date  | date:'dd/MM/yyyy'}}</h3>
                <h3 ng-if="!movie.release_date">Sem data de lançamento cadastrada</h3>
                <p ng-if="movie.overview">{{movie.overview}}</p>
                <h4 ng-if="!movie.overview">Nenhuma descrição cadastrada para esse filme</h4>
            </div>

        </div>
        
        <div class='panel-footer '>
            <?php if($inUserList){ ?>
            <p class=""><span disabled="disabled" title="Este filme já consta em sua lista" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Adicionar aos meus filmes</span> <a href="index.php?route=catalog/tmdb_movie/remove&token=<?php echo $token; ?>&movie_id={{movie.id}}" class="btn btn-danger" role="button">Remover filme</a></p>
            <?php }else{ ?>
                <p class=""><a href="index.php?route=catalog/tmdb_movie/add&token=<?php echo $token; ?>&movie_id=<?php echo $movieId; ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Adicionar aos meus filmes</a></p>
            <?php } ?>
            
            
        </div>  
        
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
<script src="view/javascript/extension/module/themoviedb/detailsCtrl.js"></script>
<?php echo $footer; ?>