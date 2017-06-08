<?php
/*
 * PLUGIN DOWNLOAD - POPIS SOUBORU pages_news.php
 * ----------------------------------------------
 *
 * Soubor slouží pro generovaní (zobrazení) rychlého seznamu článků (vybraných článků v administrativním rozhraní) v Grid systému jednotlivých frontend stránek
 *
 * Použitelné hodnoty s daty pro FRONTEND - pages_news.php
 * ------------------------------------------------------
 *
 * $JAK_DOWNLOAD = pole s daty
 * foreach ($JAK_DOWNLOAD as $d) = získání jednotlivých dat z pole
 *
 * $d["id"]             číslo		|	- id souboru
 * $d["title"]					text			- Titulek souboru
 * $d["content"]				text			- Celý popis souboru
 * $d["contentshort"]		text			- Zkrácený popis souboru
 * $d["showtitle"]			ano/ne		- Zobrazení nadpisu
 * $d["showcontact"]		ano/ne
 * $d["showdate"]				ano/ne
 * $d["created"]				datum			- Datum vytvoření
 * $v["comments"]
 * $d["hits"]						číslo			- Počet zobrazení
 * $v["countdl"]				číslo			- Počet stažení
 * $v["totalcom"]
 * $d["previmg"]
 * $d["parseurl"]       text      - Adresa URL
 *
 */
?>

<?php include_once APP_PATH . 'plugins/download/functions.php';

$showdlarray = explode(":", $row['showdownload']);

if (is_array($showdlarray) && in_array("ASC", $showdlarray) || in_array("DESC", $showdlarray)) {

  $JAK_DOWNLOAD = jak_get_download('LIMIT ' . $showdlarray[1], 't1.id ' . $showdlarray[0], '', 't1.id', $jkv["downloadurl"], $tl['global_text']['gtxt4']);

} else {

  $JAK_DOWNLOAD = jak_get_download('', 't1.id ASC', $row['showdownload'], 't1.id', $jkv["downloadurl"], $tl['global_text']['gtxt4']);
}

?>

<hr>
<div class="col-md-12" style="margin-bottom: 50px;">
  <h3 style="margin-bottom: 30px;"><?php echo $tld["downl_frontend"]["downl12"]; ?></h3>

  <div class="carousel carousel-showmanymoveone slide" id="carouselABC" data-ride="carousel" data-interval="5000">

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <?php
      $i = 0;
      if (isset($JAK_DOWNLOAD) && is_array($JAK_DOWNLOAD)) foreach ($JAK_DOWNLOAD as $d) {
      ?>

        <div class="item<?php if ($i == 0) { echo ' active'; } ?>">
          <div class="col-xs-12 col-sm-6 col-md-3">
            <a href="<?php echo $d["parseurl"]; ?>"><?php echo jak_cut_text($d["title"], 30, ""); ?></a>
            <p><?php echo $d["contentshort"]; ?></p>
            <!-- Button -->
            <div class="pull-left">
              <a href="<?php echo $d["parseurl"]; ?>" class="btn btn-default btn-xs">
                <?php echo $tld["downl_frontend"]["downl7"]; ?>
              </a>
              <br>
              <?php if (JAK_ASACCESS) { ?>

                <a href="<?php echo BASE_URL; ?>admin/index.php?p=download&amp;sp=edit&amp;id=<?php echo $d["id"]; ?>" title="<?php echo $tl["button"]["btn1"]; ?>" class="btn btn-info btn-xs jaktip">
                  <span class="visible-xs"><i class="fa fa-edit"></i></span>
                  <span class="hidden-xs"><?php echo $tl["button"]["btn1"]; ?></span>
                </a>

                <a class="btn btn-info btn-xs jaktip quickedit" href="<?php echo BASE_URL; ?>admin/index.php?p=download&amp;sp=quickedit&amp;id=<?php echo $d["id"]; ?>" title="<?php echo $tl["button"]["btn2"]; ?>">
                  <span class="visible-xs"><i class="fa fa-pencil"></i></span>
                  <span class="hidden-xs"><?php echo $tl["button"]["btn2"]; ?></span>
                </a>

              <?php } ?>
            </div>
          </div>
        </div>

      <?php
      $i++;
      }
      ?>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carouselABC" role="button" data-slide="prev">
      <i class="glyphicon glyphicon-chevron-left" aria-hidden="true"></i>
    </a>
    <a class="right carousel-control" href="#carouselABC" role="button" data-slide="next">
      <i class="glyphicon glyphicon-chevron-right" aria-hidden="true"></i>
    </a>
  </div>

</div>