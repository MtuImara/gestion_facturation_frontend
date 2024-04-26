<?php ob_start(); ?>

<?php

    $ch = curl_init();
    $url = "http://localhost:8085/facturation/api/taux_tvas/";

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


    <div class="row bg-title">
        <div class="col-lg-9 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">D2S Service TVA</h4>
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
                <h3 class="box-title m-b-0">Listes des Taux sur la Valeur Ajoutée</h3>
                <p class="text-muted m-b-30">Cette liste est exportable </p>
                
                <div class="table-responsive">
                    <table id="example23" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Designation</th>
                                <th>Taux TVA</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $i=0; 
                                foreach ($datas["data"] as $repository): 
                                $i++;                        
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($repository["code"]) ?></td>
                                <td><?= htmlspecialchars($repository["libelle"]) ?></td>
                                <td><?= $repository["taux"] ?></td>
                                <td class="text-nowrap">
                                    <a href="tvaModification.php?id=<?= $repository["id"] ?>" data-toggle=""  data-original-title="Modifier"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="#" data-toggle="modal" data-target="#responsive-modal1<?=$i?>" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a>
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
                                                <form method="post" action="tvaAjout.php">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Code:</label>
                                                        <input type="text" class="form-control" id="code" name="code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Désignation:</label>
                                                        <input type="text" class="form-control" id="libelle" name="libelle">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Taux TVA:</label>
                                                        <input type="text" class="form-control" id="taux" name="taux">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Ajouter</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <!-- sample modal modification -->
                                <!-- /.modal -->                                
                                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Modification </h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Code:</label>
                                                        <input type="text" class="form-control" id="code" name="code" value="<?= $datas["data"]["code"] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Désignation:</label>
                                                        <input type="text" class="form-control" id="libelle" name="libelle" value="<?= $datas["data"]["libelle"] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Taux TVA:</label>
                                                        <input type="text" class="form-control" id="taux" name="taux" value="<?= $datas["data"]["taux"] ?>">
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
                                                <form method="post" action="tvaDelete.php">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Voulez-vous Supprimer?</label>
                                                        <input type="hidden" value="<?= $repository["id"] ?>" class="form-control" id="id" name="id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light">Supprimer</button>
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
    $content=ob_get_clean();
    require_once "menu.php";
?>
