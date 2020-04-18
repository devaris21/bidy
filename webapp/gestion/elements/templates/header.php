      <div class="row border-bottom white-bg" style="margin-bottom: 6%;">
        <nav class="navbar navbar-wrapper navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <form role="search" class="navbar-form-custom" action="search_results.html">
                    <div class="form-group">
                        <input type="text" placeholder="Recherhcer quelque chose..." class="form-control" name="top-search" id="top-search">
                    </div>
                </form>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="border-right">
                    <span class="m-r-sm text-muted welcome-message text-uppercase" id="date_actu"></span> 
                    <span class="m-r-sm text-muted welcome-message gras" id="heure_actu"></span> 
                </li>

                <li class="border-right">
                    <a  data-toggle="modal" data-target="#modal-productionjour" onclick=" modification('productionjour', <?= $productionjour->getId(); ?>) ">
                        <i class="fa fa-file-text-o"></i> Rapport du jour
                    </a>
                </li>
                <li class="" style="height: 30px">
                    <a href="#" id="btn-deconnexion" style="display: inline-block; margin-top: -37%">
                        <i class="fa fa-sign-out fa-2x text-red" ></i>
                    </a>
                </li>
            </ul>

        </nav>
    </div>