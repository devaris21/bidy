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
                <h2>Etat récapitulatif de la clientèle</h2>
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
                                <div class="col-sm-4">
                                    <img style="width: 25%" src="<?= $this->stockage("images", "societe", $params->image) ?>">
                                </div>
                                <div class="col-sm-8 text-right">
                                    <h2 class="title text-uppercase gras">Etat récapitulatif de la clientèle</h2>
                                    <h3>Du <?= datecourt($date1) ?> au <?= datecourt($date2) ?></h3>
                                </div>
                            </div><br><br>

                            <div class="row" style="margin-top: -2%;">
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span> Nombre de clients </span>
                                        <h2 class="font-bold"><?= start0(count(Home\CLIENT::getAll())) ?></h2>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span> Commandes </span>
                                        <h2 class="font-bold"><?= start0(count(Home\COMMANDE::findBy(["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]))) ?></h2>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span>Livraisons effectuées </span>
                                        <h2 class="font-bold"><?= start0(count(Home\LIVRAISON::findBy(["DATE(created) >= " => $date1, "DATE(created) <= " => $date2]))) ?></h2>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span>Annulation </span>
                                        <h2 class="font-bold">26'C</h2> 
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="widget style2 navy-bg">
                                        <span>Fréquence  </span>
                                        <h4 class="font-bold mp0">2 <small>commande/Jour</small></h4>
                                        <h4 class="font-bold mp0">5 <small>Livraison/Jour</small></h4>
                                    </div>
                                </div>
                            </div><br>

                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Les clients</th>
                                        <th class="text-center">Commandes</th>
                                        <th class="text-center">Livraisons</th>
                                        <th class="text-center">Total Versements</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clients as $key => $client) { ?>
                                        <tr>
                                            <td><h6 class="mp0 text-uppercase gras"><?= $client->name() ?></h6> <small><?= $client->typeclient->name() ?></small></td>
                                            <td class="text-center"><?= start0($client->commandes) ?> commandes</td>
                                            <td class="text-center"><?= start0($client->livraisons) ?> livraisons</td>
                                            <td class="text-center gras"><?= money($client->versement) ?> <?= $params->devise ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="height: 12px;"></tr>
                                    <tr>
                                        <td><h3 class="text-right gras">TOTAL = </h3></td>
                                        <td class="text-center"><h4><?= start0(comptage($clients, "commandes", "somme")) ?> commandes</h4></td>
                                        <td class="text-center"><h4><?= start0(comptage($clients, "livraisons", "somme")) ?> livraisons</h4></td>
                                        <td class="text-center gras"><h4><?= money(comptage($clients, "versement", "somme")) ?> <?= $params->devise ?></h4></td>
                                    </tr>
                                </tbody>
                            </table><hr><br>

                            <div class="">
                                <h4>Courbe d'évoluton du compte</h4>
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>  <br>

                                <h4>Observations</h4>
                                <ul style="font-style: italic;">
                                    <li>"Entretiens de machine" réprésente à lui seul 60% de vos dépenses</li>
                                    <li>88% de vos dépenses concernent les factures d'eau et facture d'élec</li>
                                </ul>                              
                            </div>

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

        var data1 = [<?php foreach ($stats as $key => $data) { ?>[gd(<?= $data->year ?>, <?= $data->month ?>, <?= $data->day ?>), <?= $data->commandes ?>], <?php } ?> ];

        var data2 = [<?php foreach ($stats as $key => $data) { ?>[gd(<?= $data->year ?>, <?= $data->month ?>, <?= $data->day ?>), <?= $data->livraisons ?>], <?php } ?> ];

        var data3 = [<?php foreach ($stats as $key => $data) { ?>[gd(<?= $data->year ?>, <?= $data->month ?>, <?= $data->day ?>), <?= $data->versement ?>], <?php } ?> ];


        var dataset = [
        {
            label: "Nombre de commandes",
            data: data1,
            color: "#1ab394",
            bars: {
                show: true,
                align: "right",
                barWidth: 12 * 60 * 60 * 600,
                lineWidth:0
            }

        }, 
        {
            label: "Nombre de livraison",
            data: data2,
            color: "#dfec21",
            bars: {
                show: true,
                align: "left",
                barWidth: 12 * 60 * 60 * 600,
                lineWidth:0
            }

        },
        {
            label: "Versemnts",
            data: data3,
            yaxis: 2,
            color: "#1C84C6",
            lines: {
                lineWidth:1,
                show: true,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.2
                    }, {
                        opacity: 0.4
                    }]
                }
            },
            splines: {
                show: false,
                tension: 0.6,
                lineWidth: 1,
                fill: 0.1
            },
        }
        ];


        var options = {
            xaxis: {
                mode: "time",
                tickSize: [<?= $data->nb  ?>, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                clolor: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 0
            }
        };

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var previousPoint = null, previousLabel = null;

        $.plot($("#flot-dashboard-chart"), dataset, options);
    })
</script>

</body>

</html>
