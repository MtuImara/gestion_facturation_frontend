<?php ob_start(); ?>

<?php

    $id = $_GET["id"];
    $ch = curl_init();
    $url = "https://spectacular-reprieve-production.up.railway.app/facturation/api/gestion_de_services/$id";

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
    $url = "https://spectacular-reprieve-production.up.railway.app/facturation/api/unites_de_mesure/";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $dataMesure = json_decode($response, true);
    }

    curl_close($ch);


    function fill_unit_select_box($dataMesure)
    { 
        $output = '';
        foreach ($dataMesure["data"]["contents"] as $repository)
        {
        $output .= '<option value="'.$repository["designation"].'">'.$repository["designation"].'</option>';
        }
        return $output;
    }

?>

    <div class="row bg-title">
        <div class="col-lg-9 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">D2S Service</h4>
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
                <h3 class="box-title m-b-0"><?= htmlspecialchars($datas["data"]["code"]) ?></h3>
                <p class="text-muted m-b-30"><?= htmlspecialchars($datas["data"]["designation"]) ?> </p>

                
                
                <div class="table-responsive">
                    <table class="table color-table primary-table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Unité de Mesure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i=0;
                            foreach ($datas["data"]["serviceDetail"] as $repository): 
                            $i++;
                        ?>
                                <tr>
                                    <td><?= htmlspecialchars($repository["code"]) ?></td>
                                    <td><?= htmlspecialchars($repository["designation"]) ?></td>
                                    <td><?= htmlspecialchars($repository["uniteMesure"]) ?></td>
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
                                                    <input type="hidden" value="<?= $datas["data"]["id"] ?>" class="form-control" name="idService">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Code:</label>
                                                        <input type="text" value="<?= htmlspecialchars($repository["code"]) ?>" class="form-control" id="code" name="code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Désignation:</label>
                                                        <input type="text" value="<?= htmlspecialchars($repository["designation"]) ?>" class="form-control" id="designation" name="designation">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Unité de Mesure</label>
                                                        <select class="form-control" id="uniteMesure" name="uniteMesure">
                                                            <option value="<?= htmlspecialchars($repository["uniteMesure"]) ?>"><?= htmlspecialchars($repository["uniteMesure"]) ?></option>
                                                            <?php echo fill_unit_select_box($dataMesure); ?>
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
                        <input type="hidden" value="<?= $datas["data"]["id"] ?>" class="form-control" id="code" name="idService">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Code:</label>
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Désignation:</label>
                            <input type="text" class="form-control" id="designation" name="designation">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Unité de Mesure</label>
                            <select class="form-control" id="uniteMesure" name="uniteMesure">
                                <option value="true"></option>
                                <?php echo fill_unit_select_box($dataMesure); ?>
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

            curl_setopt($ch, CURLOPT_URL, "https://spectacular-reprieve-production.up.railway.app/facturation/api/gestion_de_services/ajout_detail");
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
            
            curl_setopt($ch, CURLOPT_URL, "https://spectacular-reprieve-production.up.railway.app/facturation/api/gestion_de_services/modefier_detail/{$_POST['id']}");
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
        
            curl_setopt($ch, CURLOPT_URL, "https://spectacular-reprieve-production.up.railway.app/facturation/api/gestion_de_services/delete_detail/{$_POST['id']}");
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
