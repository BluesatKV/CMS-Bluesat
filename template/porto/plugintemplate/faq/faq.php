<?php
/*
 * ALL VALUE for FRONTEND - faq.php
 *
 * $id 							číslo		|	- id souboru
 * $title						text			- Titulek souboru
 * $content					text			- Celý popis souboru
 * $contentshort		text			- Zkrácený popis souboru
 * $showtitle				ano/ne		- Zobrazení nadpisu
 * $showcontact			ano/ne
 * $showdate				ano/ne
 * $created					datum			- Datum vytvoření
 * $comments
 * $hits						číslo			- Počet zobrazení
 * $totalcom
 * $previmg
 * $parseurl
 *
 */
?>

<?php include_once APP_PATH . 'template/' . ENVO_TEMPLATE . '/header.php'; ?>

<?php if (JAK_ASACCESS) $apedit = BASE_URL . 'admin/index.php?p=faq&amp;sp=setting'; ?>

  <!-- =========================
    START FAQ SECTION
  ============================== -->
  <section class="faq-content-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="help-accordion">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

              <?php if (isset($JAK_FAQ_ALL) && is_array($JAK_FAQ_ALL)) foreach ($JAK_FAQ_ALL as $v) { ?>

                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="heading<?php echo $v["id"]; ?>">
                    <h3 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $v["id"]; ?>"  aria-expanded="true" aria-controls="collapse<?php echo $v["id"]; ?>">
                        <?php echo $v["title"]; ?>
                      </a>
                    </h3>
                  </div>
                  <div id="collapse<?php echo $v["id"]; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $v["id"]; ?>">
                    <div class="panel-body">
                      <h4><?php echo $tlf["faq_frontend"]["faq"]; ?></h4>
                      <div>
                        <p>
                          <?php echo $v["contentshort"]; ?>
                        </p>
                      </div>

                      <div class="clearfix"></div>
                      <div class="pull-right">

                        <a href="<?php echo $v["parseurl"]; ?>" class="btn btn-default btn-sm"><?php echo $tlf["faq_frontend"]["faq1"]; ?></a>

                        <!-- Post System Button - Admin -->
                        <?php if (JAK_ASACCESS) { ?>

                          <a href="<?php echo BASE_URL; ?>admin/index.php?p=faq&amp;sp=edit&amp;id=<?php echo $v["id"]; ?>" title="<?php echo $tl["button"]["btn1"]; ?>" class="btn btn-primary btn-sm">
                            <span class="visible-xs"><i class="fa fa-edit"></i></span>
                            <span class="hidden-xs"><?php echo $tl["button"]["btn1"]; ?></span>
                          </a>
                          <a class="btn btn-primary btn-sm quickedit" href="<?php echo BASE_URL; ?>admin/index.php?p=faq&amp;sp=quickedit&amp;id=<?php echo $v["id"]; ?>" title="<?php echo $tl["button"]["btn2"]; ?>">
                            <span class="visible-xs"><i class="fa fa-pencil"></i></span>
                            <span class="hidden-xs"><?php echo $tl["button"]["btn2"]; ?></span>
                          </a>

                        <?php } ?>

                      </div>

                    </div>
                  </div>
                </div>

              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- =========================
    END FAQ SECTION
  ============================== -->

<?php if ($JAK_PAGINATE) echo $JAK_PAGINATE; ?>

<?php include_once APP_PATH . 'template/' . ENVO_TEMPLATE . '/footer.php'; ?>