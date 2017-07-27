<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php
// EN: Checking of some page was unsuccessful
// CZ: Kontrola některé stránky byla neúspěšná
if ($page3 == "ene") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php echo $tl["general_error"]["generror2"];?>'
      }, {
        // settings
        type: 'success',
        delay: 5000
      });
    }, 1000);
  </script>
<?php } ?>

  <div class="row">
    <div class="col-lg-5 col-md-12 ">
      <!-- START PANEL -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Service ID (S_ID)
          </div>
        </div>
        <div class="panel-body">
          <p style="height: 60px">Unikátní identifikátor konkrétní služby přenášené transportním tokem (televizní program, rozhlasový program, ostatní služby).</p>
          <div class="m-t-15 pull-right">

            <?php
            // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
            echo $Html->addAnchor('index.php?p=tv-tower&amp;sp=identifiers&amp;ssp=createident&amp;sssp=s_idtv', 'Nové S_ID - TV', '', 'btn btn-info button m-r-5');
            echo $Html->addAnchor('index.php?p=tv-tower&amp;sp=identifiers&amp;ssp=createident&amp;sssp=s_idr', 'Nové S_ID - R', '', 'btn btn-info button m-r-5');
            echo $Html->addAnchor('index.php?p=tv-tower&amp;sp=identifiers&amp;ssp=createident&amp;sssp=s_ids', 'Nové S_ID - Služby', '', 'btn btn-info button');
            ?>

          </div>
        </div>
      </div>
      <!-- END PANEL -->
    </div>
    <div class="col-lg-4 col-md-12 ">
      <!-- START PANEL -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Original Network ID (ON_ID)
          </div>
        </div>
        <div class="panel-body">
          <p style="height: 60px">Unikátní identifikátor společný pro všechny sítě v rámci konkrétní země.</p>
          <div class="m-t-15 pull-right">

            <?php
            // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
            echo $Html->addAnchor('index.php?p=tv-tower&amp;sp=identifiers&amp;ssp=createident&amp;sssp=on_id', 'Nové Original Network ID', '', 'btn btn-info button');
            ?>

          </div>
        </div>
      </div>
      <!-- END PANEL -->
    </div>
    <div class="col-lg-3 col-md-12 ">
      <!-- START PANEL -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Network ID (N_ID)
          </div>
        </div>
        <div class="panel-body">
          <p style="height: 60px">Unikátní identifikátor konkrétní sítě.</p>
          <div class="m-t-15 pull-right">

            <?php
            // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
            echo $Html->addAnchor('index.php?p=tv-tower&amp;sp=identifiers&amp;ssp=createident&amp;sssp=n_id', 'Nové Network ID', '', 'btn btn-info button');
            ?>

          </div>
        </div>
      </div>
      <!-- END PANEL -->
    </div>
  </div>


<?php include_once APP_PATH . 'admin/template/footer.php'; ?>