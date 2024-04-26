<?php

    $ch = curl_init();
    $url = "http://localhost:8085/facturation/api/gestion_de_devis/";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $datas = json_decode($response, true);
        // print_r($response["data"]);
    }

    curl_close($ch);

?>

<?php

    $ch = curl_init();
    $url = "http://127.0.0.1:8085/facturation/api/gestion_client/";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $dataClient = json_decode($response, true);
    }

    curl_close($ch);


    function fill_client_select_box($dataClient)
    { 
        $output = '';
        foreach ($dataClient["data"]["contents"] as $repository)
        {
        $output .= '<option value="'.$repository["id"].'">'.$repository["nom"].' '.$repository["prenom"].'</option>';
        }
        return $output;
    }

?>

<?php

    $ch = curl_init();
    $url = "http://127.0.0.1:8085/facturation/api/gestion_de_services/";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $dataService = json_decode($response, true);
    }

    curl_close($ch);


    function fill_service_select_box($dataService)
    { 
        $output = '';
        foreach ($dataService["data"]["contents"] as $repository)
        {
        $output .= '<option value="'.$repository["id"].'">'.$repository["designation"].'</option>';
        }
        return $output;
    }

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
    <link href="css/colors/gray-dark.css" id="theme" rel="stylesheet">

    <!-- Bootstrap Core CSS fichiers Exportables -->
    <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
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
                    <div class="col-lg-9 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">D2S Service Devis</h4>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-xs-12">
                        <button class="btn btn-block btn-outline btn-rounded btn-info" data-toggle="modal" data-target="#responsive-modal-ajouter">Ajouter</button>
                    </div>
                </div>

                <!--------------------Debut Contenu ------------------->

                <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Listes des Devis</h3>
                <p class="text-muted m-b-30">Cette liste est exportable </p>
                
                <div class="table-responsive">
                    <table id="example23" class="table table-striped">
                    
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Client</th>
                                <th>Services</th>
                                <th>Date</th>
                                <th>Montant Total</th>
                                <th>Etat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=0;
                                foreach ($datas["data"]["contents"] as $repository): 
                                $i++;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($repository["code"]) ?></td>
                                <td><?= $repository["client"]["nom"].' '.$repository["client"]["prenom"] ?></td>
                                <td><?= htmlspecialchars($repository["service"]["designation"]) ?></td>
                                <td><?= htmlspecialchars($repository["dateOperation"]) ?></td>
                                <td><?= $repository["montantTotalHT"] ?></td>
                                <td><?= htmlspecialchars($repository["etat"]) ?></td>
                                <td class="text-nowrap">
                                    <a href="devisDetail.php?id=<?= $repository["id"] ?>" data-toggle=""  data-original-title="Detail"> <i class="fa fa-book text-inverse m-r-10"></i> </a>
                                    <a href="devisAfficher.php?id=<?= $repository["id"] ?>" data-toggle=""  data-original-title="Voir"> <i class="fa fa-file-pdf-o text-inverse m-r-10"></i> </a>
                                    <a href="#" data-toggle="modal" data-target="#responsive-modal-modifier<?=$i?>" data-original-title="Modifier"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="#" data-toggle="modal" data-target="#responsive-modal-supprimer<?=$i?>" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a>
                                </td>

                                <!-- sample modal Ajouter -->
                                <!-- /.modal -->
                                <div id="responsive-modal-ajouter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Ajouter </h4>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Code:</label>
                                                        <input type="text" class="form-control" id="code" name="code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Date:</label>
                                                        <input type="date" class="form-control" id="dateOperation" name="dateOperation">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Client</label>
                                                        <select class="form-control" id="idClient" name="idClient">
                                                            <option></option>
                                                            <?php echo fill_client_select_box($dataClient); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Service</label>
                                                        <select class="form-control" id="id_service" name="id_service">
                                                            <option></option>
                                                            <?php echo fill_service_select_box($dataService); ?>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label class="control-label">Taux TVA</label>
                                                        <select class="form-control" id="tauxTva" name="tauxTva">
                                                            <option></option>
                                                        </select>
                                                    </div> -->
                                                    <!-- <div class="form-group">
                                                        <label class="control-label">Statut</label>
                                                        <select class="form-control" id="typeStatut" name="typeStatut">
                                                            <option></option>
                                                            <?php //echo fill_statut_select_box($dataStatut); ?>
                                                        </select>
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Commentaire:</label>
                                                        <textarea type="text" class="form-control" id="commentaire" name="commentaire"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Etat</label>
                                                        <select class="form-control" id="etat" name="etat">
                                                            <option value="Accepté">Accepté</option>
                                                            <option value="Refusé">Refusé</option>
                                                            <option value="En attente">En attente</option>
                                                            <option value="Annulée">Annulée</option>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button type="submit" name="ajouter" class="btn btn-info waves-effect waves-light">Ajouter</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <!-- sample modal modification -->
                                <!-- /.modal -->
                                <div id="responsive-modal-modifier<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Modification </h4>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="">
                                                    <input type="hidden" value="<?= $repository["id"] ?>" class="form-control" id="code" name="id">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Code:</label>
                                                        <input type="text" value="<?= $repository["code"] ?>" class="form-control" id="code" name="code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Date:</label>
                                                        <input type="datetime-local" value="<?= $repository["dateOperation"] ?>" class="form-control" id="dateOperation" name="dateOperation">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Client</label>
                                                        <select class="form-control" id="idClient" name="idClient">
                                                            <option value="<?= $repository["idClient"] ?>"><?= $repository["client"]["nom"].' - '.$repository["client"]["prenom"] ?></option>
                                                            <?php echo fill_client_select_box($dataClient); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Service</label>
                                                        <select class="form-control" id="id_service" name="id_service">
                                                            <option value="<?= $repository["id_service"] ?>"><?= $repository["service"]["designation"] ?></option>
                                                            <?php echo fill_service_select_box($dataService); ?>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label class="control-label">Taux TVA</label>
                                                        <select class="form-control" id="tauxTva" name="tauxTva">
                                                            <option value=""></option>
                                                        </select>
                                                    </div> -->
                                                    <!-- <div class="form-group">
                                                        <label class="control-label">Statut</label>
                                                        <select class="form-control" id="typeStatut" name="typeStatut">
                                                            <option></option>
                                                            <?php //echo fill_statut_select_box($dataStatut); ?>
                                                        </select>
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Commentaire:</label>
                                                        <textarea type="text" class="form-control" id="commentaire" name="commentaire"><?= $repository["commentaire"] ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Etat</label>
                                                        <select class="form-control" id="etat" name="etat">
                                                            <option value="<?= $repository["etat"] ?>"><?= htmlspecialchars($repository["etat"]) ?></option>
                                                            <option value="Accepté">Accepté</option>
                                                            <option value="Refusé">Refusé</option>
                                                            <option value="En attente">En attente</option>
                                                            <option value="Annulée">Annulée</option>
                                                        </select>
                                                    </div>                                                    

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button type="submit" name="modifier" class="btn btn-info waves-effect waves-light">Modifier</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- sample modal suppression -->
                                <!-- /.modal -->
                                <div id="responsive-modal-supprimer<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Suppression </h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Voulez-vous Supprimer la facture <b><?= $repository["code"] ?></b></label>
                                                        <input type="hidden" value="<?= $repository["id"] ?>" class="form-control"  name="id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button type="submit" name="supprimer" class="btn btn-danger waves-effect waves-light">Supprimer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tr>
                            <?php endforeach; ?>                                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
    <!-- /.row -->

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

    <!-- jQuery -->
    <!-- Custom Theme JavaScript -->
    <script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
    <!--Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>

<?php

    if (isset($_POST['ajouter'])) 
    {
        $headers = [
            // Les entêtes requises
            "Access-Control-Allow-Origin: *",
            "Content-type: application/json; charset= UTF-8",
            "Access-Control-Allow-Methods: POST",
            "Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin"
        ];
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8085/facturation/api/gestion_de_devis/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));
        
        $response = curl_exec($ch);
        
        $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        
        curl_close($ch);
        
        $dataModif = json_decode($response, true);

        header('Refresh: 0');

        

    }

    if (isset($_POST['modifier'])) 
    {
        $headers = [
            // Les entêtes requises
            "Access-Control-Allow-Origin: *",
            "Content-type: application/json; charset= UTF-8",
            "Access-Control-Allow-Methods: PUT",
        ];
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8085/facturation/api/gestion_de_devis/{$_POST['id']}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));
        
        $response = curl_exec($ch);
        
        $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        
        curl_close($ch);
        
        $dataModif = json_decode($response, true);

        header('Refresh: 0');
        
    }

    if (isset($_POST['supprimer'])) 
    {
        $headers = [
            // Les entêtes requises
            "Access-Control-Allow-Origin: *",
            "Content-type: application/json; charset= UTF-8",
            "Access-Control-Allow-Methods: DELETE"
        ];
    
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8085/facturation/api/gestion_de_devis/{$_POST['id']}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    
        $response = curl_exec($ch);
    
        $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    
        curl_close($ch);
    
        $data = json_decode($response, true);

        header('Refresh: 0');
    
    }
?>


