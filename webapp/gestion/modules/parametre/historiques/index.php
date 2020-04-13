
<?php require("../../webapp/administration/assets/includes/head.php") ?>

<body>

    <?php require("../../webapp/administration/assets/includes/preloader.php") ?>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

           <?php require("../../webapp/administration/assets/includes/header.php") ?>

           <!-- Sidebar inner chat end-->
           <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

               <?php require("../../webapp/administration/assets/includes/sidebar.php") ?>

               <div class="pcoded-content">
                <div class="pcoded-inner-content"><br>

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
        </div>
    </div>
</div>
</div>
</div>


<?php require("../../webapp/administration/assets/includes/footer.php") ?>

</body>

</html>
