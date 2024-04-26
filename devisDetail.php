<?php ob_start(); ?>

<?php

    $id = $_GET["id"];
    $ch = curl_init();
    $url = "http://localhost:8085/facturation/api/gestion_de_devis/$id";

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

<?php

    $ch = curl_init();
    $url = "http://127.0.0.1:8085/facturation/api/gestion_de_services/service_detail";

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
        foreach ($dataService["data"]["contents"]["content"] as $repository)
        {
        $output .= '<option value="'.$repository["id"].'">'.$repository["designation"].'</option>';
        }
        return $output;
    }

?>

<?php

    $ch = curl_init();
    $url = "http://127.0.0.1:8085/facturation/api/taux_tvas/";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $dataTva = json_decode($response, true);
    }

    curl_close($ch);


    function fill_tva_select_box($dataTva)
    { 
        $output = '';
        foreach ($dataTva["data"] as $repository)
        {
            $output .= '<option value="'.$repository["taux"].'">'.$repository["libelle"].' - '.$repository["taux"].'</option>';
        }
        return $output;
    }

?>

    <div class="row bg-title">
        <div class="col-lg-9 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">D2S Services</h4>
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
                <h3 class="box-title m-b-0"><?= htmlspecialchars($datas["data"]["code"].' - '.$datas["data"]["service"]["designation"]) ?></h3>
                <h3 class="box-title m-b-0"><?= htmlspecialchars($datas["data"]["client"]["nom"].' '.$datas["data"]["client"]["prenom"]) ?></h3>
                <p class="text-muted m-b-30"><?= htmlspecialchars($datas["data"]["dateOperation"]) ?> </p>

                
                
                <div class="table-responsive">
                    <table class="table color-table primary-table">
                        <thead>
                            <tr>
                                <th>Libellé</th>
                                <th>Quantité</th>
                                <th>Prix Unitaire HT</th>
                                <th>Taux TVA</th>
                                <th>Montant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i=0;
                            foreach ($datas["data"]["devisDetail"] as $repository): 
                            $i++;
                        ?>
                                <tr>
                                <tr>
                                    <td><?= htmlspecialchars($repository["serviceDetail"]["designation"]) ?></td>
                                    <td><?= $repository["quantite"] ?></td>
                                    <td><?= $repository["prixUnitHt"] ?></td>
                                    <td><?= $repository["tauxTva"] ?></td>
                                    <td><?= $repository["montantHt"] ?></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#responsive-modal-modifier<?=$i?>" data-original-title="Modifier"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                        <a href="#" data-toggle="modal" data-target="#responsive-modal1<?=$i?>" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a>
                                    </td>
                                </tr>

                                <!-- sample modal Modification -->
                                <!-- /.modal -->
                                <div id="responsive-modal-modifier<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Modifier </h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="">
                                                    <input type="hidden" value="<?= $repository["id"] ?>" class="form-control"  name="id">
                                                    <input type="hidden" value="<?= $datas["data"]["id"] ?>" class="form-control" name="idDevis">
                                                    <div class="form-group">
                                                        <label class="control-label">Detail Service</label>
                                                        <select class="form-control" id="idServiceDetail" name="idServiceDetail">
                                                        <option value="<?= $repository["idServiceDetail"] ?>"><?= htmlspecialchars($repository["serviceDetail"]["designation"]) ?></option>
                                                            <?php echo fill_service_select_box($dataService); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Quantité:</label>
                                                        <input type="text" class="form-control" value="<?= $repository["quantite"] ?>" id="quantite" name="quantite">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Prix Unitaire:</label>
                                                        <input type="text" class="form-control" value="<?= $repository["prixUnitHt"] ?>" id="prixUnitHt" name="prixUnitHt">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Taux TVA</label>
                                                        <select class="form-control" id="tauxTva" name="tauxTva">
                                                        <option value="<?= $repository["tauxTva"] ?>"><?= $repository["tauxTva"] ?></option>
                                                            <option value="0.0">0.0</option>
                                                            <?php echo fill_tva_select_box($dataTva); ?>
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
                                <div id="responsive-modal1<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Suppression </h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Voulez-vous Supprimer?</label>
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
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="pull-right m-t-30 text-right">
                        <!-- <p>Taux TVA:  % </p> -->
                        <!-- <p>Montant TVA :  Fbu </p> -->
                        <hr>
                        <h3><b> Montant Total :</b> <?= $datas["data"]["montantTotalHT"] ?> Fbu</h3>
                        
                        <!-- <h3><b>Total TTC :</b>  Fbu</h3>  -->
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-info" type="submit" name="submit"> <i class="fa fa-paper-plane"></i> </button>
                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> </span> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>





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
                        <input type="hidden" value="<?= $datas["data"]["id"] ?>" class="form-control" id="idDevis" name="idDevis">
                        <div class="form-group">
                            <label class="control-label">Détail Service</label>
                            <select class="form-control" id="idServiceDetail" name="idServiceDetail">
                                <?php echo fill_service_select_box($dataService); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Quantité:</label>
                            <input type="text" class="form-control" id="quantite" name="quantite">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Prix Unitaire:</label>
                            <input type="text" class="form-control" id="prixUnitHt" name="prixUnitHt">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Taux TVA</label>
                            <select class="form-control" id="tauxTva" name="tauxTva">
                                <option value="0.0">0.0</option>
                                <?php echo fill_tva_select_box($dataTva); ?>
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
    <!-- /.row -->
    <!--------------------Fin Contenu ------------------->

    <!--/row -->
                
    <!-- jQuery -->
    
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
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
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

            curl_setopt($ch, CURLOPT_URL, "http://localhost:8085/facturation/api/gestion_de_devis/ajout_detail");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));

            $response = curl_exec($ch);

            $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

            curl_close($ch);

            $data = json_decode($response, true);

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
            
            curl_setopt($ch, CURLOPT_URL, "http://localhost:8085/facturation/api/gestion_de_devis/modefier_detail/{$_POST['id']}");
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
        
            curl_setopt($ch, CURLOPT_URL, "http://localhost:8085/facturation/api/gestion_de_devis/delete_detail/{$_POST['id']}");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        
            $response = curl_exec($ch);
        
            $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        
            curl_close($ch);
        
            $data = json_decode($response, true);

            header('Refresh: 0');
        
        }
    ?>


<?php
    $content=ob_get_clean();
    require_once "menu.php";
?>
