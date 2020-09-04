<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <h1 class="logo-name text-center" style="font-size: 50px; letter-spacing: 5px; margin: 0% auto !important; padding: 0% !important;">BRIXS</h1>
            <li class="nav-header" style="padding: 15px 10px !important">
                <div class="dropdown profile-element">                        
                    <div class="row">
                        <div class="col-3">
                            <img alt="image" class="rounded-circle" style="width: 35px" src="<?= $this->stockage("images", "gestionnaires", $employe->image) ?>"/>
                        </div>
                        <div class="col-9">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?= $employe->name(); ?></span>
                                <span class="text-muted text-xs block"><b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="<?= $this->url("gestion", "access", "locked") ?>">Vérouiller la session</a></li>
                                <li><a class="dropdown-item" href="#" id="btn-deconnexion" >Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="logo-element">
                    BRIXS
                </div>
            </li>

            <?php 
            $groupes__ = Home\GROUPECOMMANDE::encours();
            $livraisons__ = Home\LIVRAISON::encours();
            $approvisionnements__ = Home\APPROVISIONNEMENT::encours();
            $achatstock__ = Home\ACHATSTOCK::encours();
            $datas1__ = array_merge(Home\PANNE::encours(), Home\DEMANDEENTRETIEN::encours(), Home\ENTRETIENVEHICULE::encours(), Home\ENTRETIENMACHINE::encours());

            ?>
            <ul class="nav metismenu" id="side-menu">
                <li class="" id="dashboard">
                    <a href="<?= $this->url("gestion", "master", "dashboard") ?>"><i class="fa fa-tachometer"></i> <span class="nav-label">Tableau de bord</span></a>
                </li>
                <li class="" id="clients">
                    <a href="<?= $this->url("gestion", "master", "clients") ?>"><i class="fa fa-users"></i> <span class="nav-label">Liste des clients</span></a>
                </li>
                <li class="dropdown-divider"></li>

                <li class="" id="productions">
                    <a href="<?= $this->url("gestion", "production", "productions") ?>"><i class="fa fa-building-o"></i> <span class="nav-label">Les productions </span></a>
                </li>
                <li class="" id="achatstock">
                    <a href="<?= $this->url("gestion", "production", "achatstock") ?>"><i class="fa fa-handshake-o"></i> <span class="nav-label">Achat de stocks </span> <?php if (count($achatstock__) > 0) { ?> <span class="label label-warning float-right"><?= count($achatstock__) ?></span> <?php } ?></a>
                </li>
                <li class="" id="production">
                    <a href="<?= $this->url("gestion", "production", "production") ?>"><i class="fa fa-cubes"></i> <span class="nav-label">Stock de production</span></a>
                </li>
                <li class="dropdown-divider"></li>


                <?php if ($employe->isAutoriser("production")) { ?>
                    <li class="" id="commandes">
                        <a href="<?= $this->url("gestion", "production", "commandes") ?>"><i class="fa fa-archive"></i> <span class="nav-label">Les Commandes</span> <?php if (count($groupes__) > 0) { ?> <span class="label label-warning float-right"><?= count($groupes__) ?></span> <?php } ?></a>
                    </li>
                    <li class="" id="livraisons">
                        <a href="<?= $this->url("gestion", "production", "livraisons") ?>"><i class="fa fa-truck"></i> <span class="nav-label">Les livraisons</span> <?php if (count($livraisons__) > 0) { ?> <span class="label label-warning float-right"><?= count($livraisons__) ?></span> <?php } ?></a>
                    </li>

                    <li class="" id="proggrammes">
                        <a href="<?= $this->url("gestion", "production", "programmes") ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Programme livraisons</span> </a>
                    </li>


                    <li class="dropdown-divider"></li>

                    
                    <li class="" id="fournisseurs">
                        <a href="<?= $this->url("gestion", "production", "fournisseurs") ?>"><i class="fa fa-address-book-o"></i> <span class="nav-label">Liste des Fournisseurs</span></a>
                    </li>
                    <li class="" id="approvisionnements">
                        <a href="<?= $this->url("gestion", "production", "approvisionnements") ?>"><i class="fa fa-bus"></i> <span class="nav-label">Approvisionnements </span> <?php if (count($approvisionnements__) > 0) { ?> <span class="label label-warning float-right"><?= count($approvisionnements__) ?></span> <?php } ?></a>
                    </li>
                    <li class="" id="ressources">
                        <a href="<?= $this->url("gestion", "production", "ressources") ?>"><i class="fa fa-cubes"></i> <span class="nav-label">Stock de ressources </span></a>
                    </li>
                    <li class="dropdown-divider"></li>
                <?php } ?>


                <?php if ($employe->isAutoriser("caisse")) { ?>
                    <li class="" id="comptedujour">
                        <a href="<?= $this->url("gestion", "caisse", "comptedujour") ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Rapport du Jour</span></a>
                    </li>
                    <li class="" id="caisse">
                        <a href="<?= $this->url("gestion", "caisse", "caisse") ?>"><i class="fa fa-money"></i> <span class="nav-label">La caisse</span></a>
                    </li>
                    <li class="" id="tricycle">
                        <a href="<?= $this->url("gestion", "production", "tricycle") ?>"><i class="fa fa-bicycle"></i> <span class="nav-label">Payements tricycles</span> </a>
                    </li>
                    <li class="dropdown-divider"></li>

                <?php } ?>

                
                <?php if ($employe->isAutoriser("parametres")) { ?>
                    <li class="" id="configuration">
                        <a href="<?= $this->url("gestion", "parametres", "configuration") ?>"><i class="fa fa-gears"></i> <span class="nav-label">Configuration</span></a>
                    </li>
              <!--   <li class="" id="historiques">
                    <a href="<?= $this->url("gestion", "parametres", "historiques") ?>"><i class="fa fa-clock-o"></i> <span class="nav-label">Historiques</span></a>
                </li>
                <li class="" id="abonnement">
                    <a href="<?= $this->url("gestion", "parametres", "abonnement") ?>"><i class="fa fa-star"></i> <span class="nav-label">Abonnement</span> <span class="label label-danger float-right"></span></a>
                </li> -->
            <?php } ?>

        </ul>

    </ul>

</div>
</nav>