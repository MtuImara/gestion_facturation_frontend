<?php

    $id = $_GET["id"];
    $ch = curl_init();
    $url = "http://localhost:8085/facturation/api/gestion_client/$id";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $datas = json_decode($response, true);
    }

    curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>D2S Service</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/gray-dark.css" id="theme" rel="stylesheet">
    

    <!-- Bootstrap Core CSS SERVICES-->
    <!-- Footable CSS -->
    <link href="plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />

    <!-- Bootstrap Core CSS Client.php -->
    <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-19175540-9', 'auto');
    ga('send', 'pageview');
    </script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="dashboardAdmin.php"><b><!--This is dark logo icon--><img src="plugins/images/eliteadmin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="plugins/images/eliteadmin-logo-dark.png" alt="home" class="light-logo" /></b><span class="hidden-xs"><!--This is dark logo text--><img src="plugins/images/eliteadmin-text.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="plugins/images/eliteadmin-text-dark.png" alt="home" class="light-logo" /></span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    
                    
                    <!-- .Megamenu -->
                    <li class="mega-dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs">Mega</span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                            <li class="col-sm-3">
                                <ul>
                                    <li><a href="devis.php">Devis</a> </li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li><a href="bonDeCommande.php">Bon de Commande</a> </li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li><a href="bonDeLivraison.php">Bon de Livraison</a> </li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li> <a href="facture.php">Facture</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- /.Megamenu -->
                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div><img src="plugins/images/users/varun.jpg" alt="user-img" class="img-circle"></div>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Admin <span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <li class="nav-small-cap m-t-10">--- Tableau de Bord</li>
                    <li> <a href="dashboardAdmin.php" class="waves-effect active"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span></a></li>
                        
                    </li>
                    <li class="nav-small-cap">--- Fichiers d'Exploitation</li>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-shopping-cart fa-fw"></i> <span class="hide-menu">Facturation<span class="fa arrow"></span><span class="label label-rouded label-info pull-right">4</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="devis.php">Devis</a></li>
                            <li> <a href="bonDeCommande.php">Bon de Commande</a></li>
                            <li> <a href="bonDeLivraison.php">Bon de Livraison</a></li>
                            <li> <a href="facture.php">Facture</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="icon-docs fa-fw"></i> <span class="hide-menu">Rapports<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="rapportDevis.php">Rapport des Devis</a></li>
                            <li> <a href="rapportBonDeCommande.php">Rapport des Bons de Commande</a></li>
                            <li> <a href="rapportBonDeLivraison.php">Rapport des Bons de Livraison</a></li>
                            <li> <a href="rapportFacture.php">Rapport des Factures</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-small-cap">--- Fichiers de Base</li>
                    <li> <a href="#" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Paramétrages<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">5</span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="services.php">Services</a></li>
                            <li><a href="client.php">Clients</a></li>
                            <li><a href="tva.php">TVA</a></li>
                            <li><a href="uniteMesure.php">Unités de Mésure</a></li>
                            <li><a href="utilisateur.php">Utilisateurs</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>
        <!-------------- Left navbar-header end ----------------------->

        <!-------------- Debut Page Content --------------------------->
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <div class="row bg-title">
                    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">D2S Service -- Modification du Client</h4>
                    </div>
                </div>

                <!--------------------Debut Contenu ------------------->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">

                            <form method="post" action="clientUpdate.php">

                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $datas["data"]["id"] ?>">
                                
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Code:</label>
                                    <input type="text" class="form-control" id="code" name="code" value="<?= $datas["data"]["code"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Nom:</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $datas["data"]["nom"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Prénom:</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $datas["data"]["prenom"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Téléphone:</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" value="<?= $datas["data"]["telephone"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Fax:</label>
                                    <input type="text" class="form-control" id="fax" name="fax" value="<?= $datas["data"]["fax"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Email:</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $datas["data"]["email"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Adresse:</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse" value="<?= $datas["data"]["adresse"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Registre de Commerce:</label>
                                    <input type="text" class="form-control" id="registreCommerce" name="registreCommerce" value="<?= $datas["data"]["registreCommerce"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">NIF:</label>
                                    <input type="text" class="form-control" id="nif" name="nif" value="<?= $datas["data"]["nif"] ?>">
                                </div>                                                    
                                <div class="form-group">
                                    <label class="control-label">Assujetti à la TVA</label>
                                    <select class="form-control" id="assujettiTva" name="assujettiTva">
                                        <option value="<?= $datas["data"]["assujettiTva"] ? "true" : "false" ?>"><?= $datas["data"]["assujettiTva"] ? "Oui" : "Non" ?></option>
                                        <option value="true">Oui</option>
                                        <option value="false">Non</option>
                                    </select>
                                </div>
                                <div class="row button-box">
                                    <div class="col-lg-2 col-sm-4 col-xs-12">
                                        <button type="submit" class="btn btn-block btn-info btn-rounded">Modifier</button>                                        
                                    </div>
                                    <div class="col-lg-2 col-sm-4 col-xs-12">
                                        <button class="btn btn-block btn-default btn-rounded">Annuler</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

                <!--------------------Fin Contenu ------------------->
                
                <!--/row -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme working">9</a></li>
                                <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!------------------- /. Fin container-fluid --------------------->
            <!------------------- /. Fin container-fluid --------------------->
            <footer class="footer text-center"> 2023 &copy; D2S Service -- Email: majani.dbest@outlook.com -- Phone: +257 79552750 or 68166319 -- by Tout-Autre  </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Morris JavaScript -->
    <script src="plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- jQuery peity -->
    <script src="plugins/bower_components/peity/jquery.peity.min.js"></script>
    <script src="plugins/bower_components/peity/jquery.peity.init.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <!--Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    
</body>

</html>
