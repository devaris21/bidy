<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-16">
                <h2>Etat récapitulatif de la production et des ressources</h2>
                <form id="formFiltrer" class="row" method="POST">
                    <div class="col-4">
                        <input type="date" value="<?= $date1  ?>" name="date1" class="form-control">
                    </div>
                    <div class="col-4">
                        <input type="date" value="<?= $date2 ?>" name="date2" class="form-control">
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-sm btn-primary dim" onclick="filtrer()"><i class="fa fa-search"></i> Filtrer</button>
                    </div>
                </form>  
            </div>
            <div class="col-lg-6">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight article">
            <div class="row justify-content-md-center">
                <div class="col-lg-10">
                    <div class="ibox"  >
                        <div class="ibox-content" style="background-image: url(<?= $this->stockage("images", "societe", "filigrane.png")  ?>) ; background-size: 50%; background-position: center center; background-repeat: no-repeat;">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img style="width: 25%" src="<?= $this->stockage("images", "societe", "logo.png") ?>">
                                </div>
                                <div class="col-sm-9 text-right">
                                    <h2 class="title text-uppercase gras">Etat récapitulatif de la production<br>et des ressources</h2>
                                    <h3>Du <?= datecourt($date1) ?> au <?= datecourt($date2) ?></h3>
                                </div>
                            </div><br><br>

                            <div class="row" style="margin-top: -2%;">
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span> Autres entrées </span>
                                        <h2 class="font-bold">26'C</h2>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span> Livraisons </span>
                                        <h2 class="font-bold">26'C</h2>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span>Approvisionnement </span>
                                        <h2 class="font-bold">26'C</h2>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span> Résultats </span>
                                        <h2 class="font-bold">26'C</h2>
                                    </div>
                                </div>
                            </div><br>


                            <h4>Tableau du stock sur la période</h4>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-uppercase text-center" style="font-size: 11px;">
                                        <th></th>
                                        <th>Stock Avant <?= datecourt2(dateAjoute1($date1, -1)) ?></th>
                                        <th>Production</th>
                                        <th colspan="2" width="10">Perte</th>
                                        <th>Livraison</th>
                                        <th>Stock en fin <?= datecourt2($date2) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produits as $key => $produit) { ?>
                                        <tr>
                                            <td><span class="gras text-uppercase"><?= $produit->name() ?></span> <br> <small><?= $produit->description ?></small></td>
                                            <td class="text-center"><h3 class="gras text-muted"><?= money($produit->stock(dateAjoute1($date1, -1))) ?></h3></td>
                                            <td class="text-center"><h4 class="text-green"><?= money($produit->production) ?></h4></td>
                                            <td class="text-center"><h4 class="text-red"><?= money($produit->perte) ?></h4></td>
                                            <td class="text-center" ><?= round( ($produit->perte($date1, $date2) / ($produit->production + $produit->perte) * 100 ), 2) ?> %</td>
                                            <td class="text-center"><h4><?= money($produit->livraison) ?></h4></td>
                                            <td class="text-center" ><h2 class="gras"><?= money($produit->stock(dateAjoute1($date2, 1))) ?></h2></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table><hr>


                            <div class="row">
                                <div class="col-6">
                                    <h4>Rapport de production, de livraison et de perte</h4>
                                    <div>
                                        <canvas id="radarChart" height="230"></canvas>
                                    </div><br>
                                    <h4>Observations</h4>
                                    <ul style="font-style: italic;">
                                        <li>25% des pertes ont eu lieu lors du rangement</li>
                                        <li>25% des pertes ont eu lieu lors du chargement/dechargement</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-right">Rapport de Consommation des ressources</h4>
                                    <div>
                                        <canvas id="radarChart2" height="230"></canvas>
                                    </div><br>
                                    <h4>Observations</h4>
                                    <ul style="font-style: italic;">
                                        <li>25% des pertes ont eu lieu lors du rangement</li>
                                        <li>25% des pertes ont eu lieu lors du chargement/dechargement</li>
                                    </ul>
                                </div>
                            </div><br>



                            <h4>Tableau du stock sur la période</h4>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-center text-uppercase" style="font-size: 11px;">
                                        <th colspan="2">Production</th>
                                        <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                            <th><?= $ressource->name() ?></th>
                                        <?php }  ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produits as $key => $produit) { ?>
                                        <tr>
                                            <td><span class="gras text-uppercase"><?= $produit->name() ?></span> <br> <small><?= $produit->description ?></small></td>
                                            <td class="text-center"><h3 class="gras"><?= money($produit->production+$produit->perte) ?></h3></td>
                                            <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { 
                                                $name = trim($ressource->name()); ?>
                                                <td class="text-center"><?= money($produit->$name); ?> <?= $ressource->abbr  ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php }  ?>

                                    <tr style="height: 12px;"></tr>
                                    <tr>
                                        <td colspan="2"><h4 class="gras text-uppercase">Consommation totale dûe</h4></td>
                                        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { 
                                            $name = trim($ressource->name()); ?>
                                            <td class="text-center text-green gras"><?= comptage($produits, $name, "somme"); ?> <?= $ressource->abbr  ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><h4 class="gras text-uppercase">Consommation totale effective</h4></td>
                                        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                            <td class="text-center text-red gras"><?= money($ressource->consommee($date1, $date2)); ?> <?= $ressource->abbr  ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr style="height: 12px;"></tr>
                                    <tr>
                                        <td colspan="2"><h5 class="gras text-uppercase">Marge de Consommation</h5></td>
                                        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { 
                                            $name = trim($ressource->name()); 
                                            $a = comptage($produits, $name, "somme") - $ressource->consommee($date1, $date2); ?>
                                            <td class="text-center text-<?= ($a > 0)?"green":"red" ?>"> Conso de <?= $a ?> <?= $ressource->abbr  ?> en <?= ($a > 0)?"moins":"plus" ?></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table><hr>
                        </div>
                    </div>

                </div>
            </div>


        </div>


        <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>


    </div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript">
    $(function(){

       var radarOptions = {
        responsive: true
    };

    var radarData = {
        labels: [<?php foreach ($produits as $key => $data){ ?> "<?= $data->name() ?>", <?php } ?>],
        datasets: [
        {
            label: "Production",
            backgroundColor: "rgba(26,179,148,0.2)",
            borderColor: "rgba(26,179,148,1)",
            data: [<?php foreach ($produits as $key => $data){ ?> "<?= $data->production ?>", <?php } ?>]
        },
        {
            label: "Livraison",
            backgroundColor: "rgba(220,220,220,0.2)",
            borderColor: "rgba(220,220,220,1)",
            data: [<?php foreach ($produits as $key => $data){ ?> "<?= $data->livraison ?>", <?php } ?>]
        },
        {
            label: "Perte",
            backgroundColor: "rgba(220,10,10,0.2)",
            borderColor: "rgba(220,10,10,1)",
            data: [<?php foreach ($produits as $key => $data){ ?> "<?= $data->perte ?>", <?php } ?>]
        }
        ]
    };

    var ctx5 = document.getElementById("radarChart").getContext("2d");
    new Chart(ctx5, {type: 'radar', data: radarData, options:radarOptions});



    var radarData2 = {
        labels: [<?php foreach ($ressources as $key => $ressource){ ?> "<?= $ressource->name() ?>", <?php } ?>],
        datasets: [
        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource){ 
            $name = trim($ressource->name());
            $a = mt_rand(0, 255); ?>
            {
                label: "<?= $ressource->name()  ?>",
                backgroundColor: "rgba(<?= $a ?>,<?= $a ?>,105,0.2)",
                borderColor: "rgba(<?= $a ?>,<?= $a ?>,105,1)",
                data: [<?php foreach ($produits as $key => $produit){ ?> <?= $produit->$name ?>, <?php } ?>]
            },
        <?php } ?>
        ]
    };
    var ctx6 = document.getElementById("radarChart2").getContext("2d");
    new Chart(ctx6, {type: 'radar', data: radarData2, options:radarOptions});
})
</script>

</body>

</html>
