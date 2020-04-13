<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="wrapper wrapper-content">
            <div class="animated fadeInRightBig">
                <div class="row" style="margin-top: -2%;">
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Kilometrage moyen du parc</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins"><?= start0(Home\VEHICULE::avgKM())  ?> Km</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Commandes / livraisons</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins">**</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Véhicules / Machines</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins">**</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Le personnel</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins"><?= start0(Home\VEHICULE::avgAge())  ?> mois</h2>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="border-bottom white-bg dashboard-header">

                    <div class="row">
                        <div class="col-md-3">
                            <h3 class="text-uppercase">Stock des produits</h3>
                            <ul class="list-group clear-list m-t">
                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                    <li class="list-group-item fist-item cursor">
                                        <a class="text-dark" href="<?= $this->url("gestion", "master", "demandevehicules")  ?>">
                                            <i class="fa fa-cab"></i>&nbsp;&nbsp;&nbsp; <?= $produit->name() ?>
                                            <span class="float-right">
                                                <span class="label label-default"><?= $produit->stock(dateAjoute()) ?></span>
                                            </span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="flot-chart dashboard-chart">
                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                            </div><hr class="mp0">
                            <div class="row text-center">
                                <div class="col">
                                    <div class=" m-l-md">
                                        <span class="h5 font-bold m-t block"><?= money(Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , dateAjoute())) ?> <?= $params->devise ?></span>
                                        <small class="text-muted m-b block">En caisse actuellement</small>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="h5 font-bold m-t block">213515 <?= $params->devise ?></span>
                                    <small class="text-muted m-b block">Coût annuel de la paperasse</small>
                                </div>
                                <div class="col">
                                    <span class="h5 font-bold m-t block">**</span>
                                    <small class="text-muted m-b block">En Versements attente</small>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3 class="text-uppercase">Stock des ressources</h3>
                            <ul class="list-group  text-left clear-list m-t">
                              <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                <li class="list-group-item fist-item cursor">
                                    <a class="text-dark" href="<?= $this->url("gestion", "master", "demandevehicules")  ?>">
                                        <i class="fa fa-cab"></i>&nbsp;&nbsp;&nbsp; <?= $ressource->name() ?>
                                        <span class="float-right">
                                            <span class="label label-default"><?= $ressource->stock(dateAjoute()) ?> <?= $ressource->abbr ?></span>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul> 
                    </div>
                </div>                    
            </div>



        </div>
    </div>
    <br>

    <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>


</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


<script>
    $(document).ready(function() {

        var id = "<?= $this->getId();  ?>";
        if (id == 1) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Content de vous revoir de nouveau!', 'Bonjour <?= $gestionnaire->name(); ?>');
                unset_session("new");
            }, 1300);
        }
        


        var data1 = [
        [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
        [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
            data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis:{
                },
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
            );



        var doughnutData = {
            labels: ["App","Software","Laptop" ],
            datasets: [{
                data: [300,50,100],
                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
            }]
        } ;


        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };

        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});




        

    });
</script>

</body>

</html>
