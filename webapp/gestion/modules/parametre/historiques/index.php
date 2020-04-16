<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>This is main title</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">This is</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Breadcrumb</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="" class="btn btn-primary">This is action area</a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="animated fadeInRightBig">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <label>Début de la période</label>
                                    <input type="date" name="date1" class="form-control" value="2019-09-01">
                                </div><br>
                                <div>
                                    <label>Début de la période</label>
                                    <input type="date" name="date2" class="form-control" value="<?= date("Y-m-d") ?>">
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="col-md-9 affichage">
                        <!-- remplit en ajax -->
                    </div>
                </div>
            </div>
        </div>


        <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>


    </div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
