<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  


          <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title border">
                            <span class="label label-success float-right">An</span>
                            <h5 class="d-inline text-uppercase">Chif. affaire</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= money(Home\OPERATION::entree(date("Y")."-01-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Progession</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="text-uppercase text-green">Entrées</h5>
                            <span class="label label-primary float-right">Mensuel</span>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins text-green"><?= money(Home\OPERATION::entree(date("Y-m")."-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                            <small>Progession</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-primary float-right">Mensuel</span>
                            <h5 class="text-uppercase text-red">Dépenses</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins text-red"><?= money(Home\OPERATION::sortie(date("Y-m")."-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                            <small>Progession</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-primary float-right">Mensuel</span>
                            <h5 class="text-uppercase">Résultats</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= money(Home\OPERATION::resultat(date("Y-m")."-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                            <small>Progession</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="m-t-sm">
                                <div class="border-right">
                                    <div>
                                        <canvas id="lineChart" height="110"></canvas>
                                    </div>
                                </div><hr>
                                <div class="row stat-list text-center">
                                    <div class="col-4">
                                        <h3 class="no-margins text-red"><?= money(Home\OPERATION::entree(dateAjoute() , dateAjoute(+1))) ?></h3>
                                        <small>Paye de salaire</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h2 class="no-margins"><?= money(Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , dateAjoute())) ?></h2>
                                        <small>En caisse actuellement</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 48%;"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h3 class="no-margins text-blue"><?= money(Home\OPERATION::entree(dateAjoute() , dateAjoute(+1))) ?> *</h3>
                                        <small>Versement en attente</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="text-uppercase">résultats 3 derniers jours</h5>
                        </div>
                        <?php $i = 0;  while ($i <= 2) {
                            $date1 = dateAjoute($i);
                            $date2 = dateAjoute($i+1);
                            $ouv = Home\OPERATION::resultat("2020-04-01" , $date1);
                            $ferm = Home\OPERATION::resultat("2020-04-01" , $date2);
                            ?>
                            <div class="ibox-content text-center">
                                <div class="row">
                                    <div class="col-4">
                                        <small class="stats-label">Ouverture <?= datecourt2($date1)  ?></small>
                                        <h4><?= money($ouv) ?></h4>
                                    </div>
                                    <div class="col-4">
                                        <small class="stats-label">Progession</small>
                                        <h4><?= ($ouv > 0) ? round(((($ferm - $ouv) / $ouv) * 100), 2):"0" ?>%</h4>
                                    </div>
                                    <div class="col-4">
                                        <small class="stats-label">Cloture <?= datecourt2($date1)  ?></small>
                                        <h4><?= money($ferm) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        } ?>

                        <div class="ibox-content">
                            <button class="btn btn-sm btn-primary dim" style="font-size: 10px"><i class="fa fa-check"></i> Nouvelle entrée</button>
                            <button class="btn btn-sm btn-danger dim pull-right" style="font-size: 10px"><i class="fa fa-check"></i> Nouvelle dépense</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="text-uppercase">Tableau des compte</h5>
                            <div class="ibox-tools">
                                <div data-toggle="buttons" class="btn-group btn-group-toggle">
                                    <label jour="-30" class="btn btn-sm btn-white"><i class="fa fa-calendar"></i> Mois </label>
                                    <label jour="-90" class="btn btn-sm btn-white"><i class="fa fa-calendar"></i> Trimestre </label>
                                    <label jour="-360" class="btn btn-sm btn-white"><i class="fa fa-calendar"></i> Année </label>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr class="text-center text-uppercase">
                                                    <th colspan="4" style="visibility: hidden;"></th>
                                                    <th>Entrée</th>
                                                    <th>Sortie</th>
                                                    <th>Résultats</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tableau">
                                                <?php foreach ($operations as $key => $operation) {
                                                    $operation->actualise(); ?>
                                                    <tr>
                                                        <td width="15"><i class="fa fa-clock-o"></i></td>
                                                        <td><?= datelong($operation->created) ?></td>
                                                        <td width="15"><i class="fa fa-file-text"></i></td>
                                                        <td><?= $operation->categorieoperation->name() ?> <span>*</span></td>
                                                        <?php if ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE) { ?>
                                                            <td class="text-center text-green"><?= money($operation->montant) ?> <?= $params->devise ?></td>
                                                            <td class="text-center"> - </td>
                                                        <?php }elseif ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::SORTIE) { ?>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center text-red"><?= money($operation->montant) ?> <?= $params->devise ?></td>
                                                        <?php } ?>
                                                        <td class="text-center gras"><?= money($operation->montant) ?> <?= $params->devise ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="4"><h4 class="text-uppercase mp0 text-right">Solde du compte au <?= datecourt(dateAjoute()) ?></h4></td>
                                                    <td><h4 class="text-center"><?= money(Home\OPERATION::entree(Home\PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
                                                    <td><h4 class="text-center"><?= money(Home\OPERATION::sortie(Home\PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
                                                    <td><h4 class="text-center"><?= money(Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-2">

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
        $(document).ready(function() {
            var lineData = {
                labels: [<?php foreach ($statistiques as $key => $data) { ?>"<?= $data->name ?>", <?php } ?>],
                datasets: [
                {
                    label: "Entrées",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [<?php foreach ($statistiques as $key => $data) { ?>"<?= $data->entree ?>", <?php } ?>]
                },
                {
                    label: "Dépenses",
                    borderColor: "rgba(220,0,0,1)",
                    pointBackgroundColor: "rgba(220,0,0,1)",
                    pointBorderColor: "#fff",
                    data: [<?php foreach ($statistiques as $key => $data) { ?>"<?= $data->sortie ?>", <?php } ?>]
                }
                ]
            };

            var lineOptions = {
                responsive: true
            };

            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
        });
    </script>


</body>

</html>
