<?php

// EN: Count of all download file in DB
// CZ: Celkový počet souborů v DB
$resdlh   = $jakdb->query('SELECT COUNT(*) as totalM FROM ' . DB_PREFIX . 'download');
$rwresdlh = $resdlh->fetch_assoc();

// EN: Count of download file for last 1 week
// CZ: Počet souborů za poslední týden
$resdlh1   = $jakdb->query('SELECT COUNT(*) as totalMW FROM ' . DB_PREFIX . 'download WHERE time > DATE_SUB(CURDATE(), INTERVAL 1 WEEK)');
$rwresdlh1 = $resdlh1->fetch_assoc();

// EN: Count of download file for last 1 month
// CZ: Počet souborů za poslední měsíc
$resdlh2   = $jakdb->query('SELECT COUNT(*) as totalMM FROM ' . DB_PREFIX . 'download WHERE time > DATE_SUB(CURDATE(), INTERVAL 4 WEEK)');
$rwresdlh2 = $resdlh2->fetch_assoc();

// EN: Get data from 'downloadhistory'
// CZ: Získání dat z 'downloadhistory'
$resdlh3 = $jakdb->query('SELECT fileid, email, filename, time FROM ' . DB_PREFIX . 'downloadhistory WHERE time > DATE_SUB(CURDATE(), INTERVAL 1 WEEK)');
while ($rwresdlh3 = $resdlh3->fetch_assoc()) {
  // EN: Insert each record into array
  // CZ: Vložení získaných dat do pole
  $envodata[] = array('fileid' => $rwresdlh3['fileid'], 'email' => $rwresdlh3['email'], 'filename' => $rwresdlh3['filename'], 'time' => $rwresdlh3['time']);
}

?>

<div class="box box-success">
  <div class="box-header">

    <?php
    // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
    echo $Html->addTag('i', '', 'pg-download m-r-5');
    echo $Html->addTag('h3', $tld["downl_box_title"]["downlbt14"], 'box-title');
    ?>

  </div>
  <div class="box-body no-padding">
    <table class="table table-striped table-hover">
      <tr>
        <td><?php echo $tld["downl_box_content"]["downlbc53"]; ?></td>
        <td><?php echo $rwresdlh['totalM']; ?></td>
      </tr>
      <tr>
        <td><?php echo $tld["downl_box_content"]["downlbc54"]; ?></td>
        <td><?php echo $rwresdlh1['totalMW']; ?></td>
      </tr>
      <tr>
        <td><?php echo $tld["downl_box_content"]["downlbc55"]; ?></td>
        <td><?php echo $rwresdlh2['totalMM']; ?></td>
      </tr>
    </table>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-statis-200">
        <thead>
        <tr>
          <th><?php echo $tld["downl_box_table"]["downltb10"]; ?></th>
          <th><?php echo $tld["downl_box_table"]["downltb11"]; ?></th>
          <th><?php echo $tld["downl_box_table"]["downltb12"]; ?></th>
          <th><?php echo $tld["downl_box_table"]["downltb13"]; ?></th>
          <th><?php echo $tld["downl_box_table"]["downltb14"]; ?></th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($envodata as $e) {
          $resdl   = $jakdb->query('SELECT title FROM ' . DB_PREFIX . 'download WHERE id=' . $e["fileid"]);
          $rwresdl = $resdl->fetch_assoc();
        ?>

          <tr>
            <td><?php echo $e["fileid"]; ?></td>
            <td><?php echo $rwresdl["title"]; ?></td>
            <td><?php echo $e["email"]; ?></td>
            <td><?php echo $e["filename"]; ?></td>
            <td><?php echo $e["time"]; ?></td>
          </tr>
        <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</div>