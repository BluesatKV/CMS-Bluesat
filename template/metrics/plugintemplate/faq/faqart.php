<?php
/**
 * ALL VALUE for FRONTEND - faqart.php
 *
 * $PAGE_ID              číslo    |  - id článku
 * $PAGE_TITLE           text        - Titulek článku
 * $PAGE_CONTENT         text        - Celý popis článku
 * $SHOWTITLE            ano/ne      - Zobrazení nadpisu
 * $SHOWDATE             ano/ne      - Zobrazení datumu
 * $JAK_COMMENT_FORM     ano/ne      - Zobrazení komentářů
 * $SHOWSOCIALBUTTON     ano/ne      - Zobrazení sociálních tlačítek
 * $FAQ_HITS             číslo       - Počet Zobrazení
 * $PAGE_TIME            date        - Datum vytvoření článku
 * $PAGE_TIME_HTML5
 * $JAK_TAGLIST          text        - Seznam tagů
 * $FAQ_CATLIST          text        - Seznam kategorií
 *
 */
?>

<?php include_once APP_PATH . 'template/' . ENVO_TEMPLATE . '/header.php'; ?>

<?php if (JAK_ASACCESS) $apedit = BASE_URL . 'admin/index.php?p=faq&amp;sp=edit&amp;id=' . $PAGE_ID;
$qapedit = BASE_URL . 'admin/index.php?p=faq&amp;sp=quickedit&amp;id=' . $PAGE_ID;
if ($jkv["printme"]) $printme = 1; ?>

  <div id="printdiv">
    <div class="row">
      <div class="col-md-12">
        <h3><?php echo $PAGE_TITLE; ?></h3>
        <div>
          <p style="font-size: 0.9em">

            <?php
            if ($SHOWDATE) {
              echo '<span style="margin-right: 20px;"><strong>' . $tlf["faq_frontend"]["faq20"] . '</strong> : ' . $PAGE_TIME . '</span>';
            }
            echo '<span style="margin-right: 20px;"><strong>' . $tlf["faq_frontend"]["faq21"] . '</strong> : ' . $FAQ_HITS . '</span>';
            echo '<span style="margin-right: 20px;"><strong>' . $tlf["faq_frontend"]["faq22"] . '</strong> : ' . $FAQ_CATLIST . '</span>';

            if ($JAK_TAGLIST) {

              echo '<span style="margin-right: 20px;">' . $JAK_TAGLIST . '</span>';

            } ?>

          </p>
        </div>
      </div>
    </div>
    <hr>
    <?php echo $PAGE_CONTENT; ?>
  </div>

<?php if ($JAK_SHOW_C_FORM) {
  include_once APP_PATH . 'template/' . ENVO_TEMPLATE . '/contact.php';
} ?>

<?php if (JAK_FAQPOST && $JAK_COMMENT_FORM) { ?>
  <!-- Comments -->
  <div class="post-coments">
    <h4><?php echo $tlf["faq"]["d10"]; ?> (<span id="cComT"><?php echo $JAK_COMMENTS_TOTAL; ?></span>)</h4>
    <ul class="post-comments">
      <?php if (isset($JAK_COMMENTS) && is_array($JAK_COMMENTS)) foreach ($JAK_COMMENTS as $v) { ?>
        <li>
          <div class="comment-wrapper">
            <div class="comment-author"><img src="<?php if ($v["userid"] != 0) {
                echo BASE_URL . JAK_FILES_DIRECTORY . '/userfiles' . $v["picture"];
              } else {
                echo BASE_URL . JAK_FILES_DIRECTORY . '/userfiles' . '/standard.png';
              } ?>" alt="avatar"/> <?php echo $v["username"]; ?></div>
            <?php if ($CHECK_USR_SESSION == $v["session"]) { ?>
              <div class="alert bg-info"><?php echo $tl["general"]["g103"]; ?></div>
            <?php } ?>
            <div class="com">
              <?php echo $v["message"]; ?>
            </div>

            <!-- Comment Controls -->
            <div class="comment-actions">
              <span class="comment-date"><?php echo $v["created"]; ?></span>
              <?php if (JAK_FAQMODERATE) { ?>
                <a href="<?php echo $v["parseurl1"]; ?>" class="btn btn-default btn-xs"><i
                    class="fa fa-trash-o"></i></a>
              <?php }
              if (JAK_USERID && JAK_FAQPOSTDELETE && $v["userid"] == JAK_USERID || JAK_FAQMODERATE) { ?>
                <a href="<?php echo $v["parseurl2"]; ?>" class="btn btn-default btn-xs commedit"><i
                    class="fa fa-pencil"></i></a>
              <?php }
              if (JAK_USERID && JAK_FAQPOSTDELETE && $v["userid"] == JAK_USERID || JAK_FAQMODERATE) { ?>
                <a href="<?php echo $v["parseurl3"]; ?>" class="btn btn-default btn-xs"><i class="fa fa-ban"></i></a>
              <?php } ?>
            </div>
          </div>
        </li>
      <?php } ?>
      <li id="insertPost"></li>
    </ul>

    <!-- Show Comment Editor if set so -->
    <?php if (JAK_FAQPOST && $JAK_COMMENT_FORM) {
      include_once APP_PATH . 'template/' . ENVO_TEMPLATE . '/userform.php';
    } ?>

  </div>
  <!-- End Comments -->

<?php } ?>

  <!-- Show Social Buttons -->
<?php if ($SHOWSOCIALBUTTON) { ?>
  <div class="col-md-12">
    <div class=" pull-right" style="display: table;">
      <div style="display: table-cell;vertical-align: middle;/*! margin-right: 20px; */padding-right: 20px;">
        <strong><?php echo $tl["share"]["share"] . ' '; ?></strong>
      </div>
      <div id="sollist-sharing"></div>
    </div>
  </div>
<?php } ?>

  <div class="col-md-12">
    <ul class="pager">
      <?php if ($JAK_NAV_PREV) { ?>
        <li class="previous">
          <a href="<?php echo $JAK_NAV_PREV; ?>">
            <i class="fa fa-caret-left"></i>
            <span class="nav_text_left"><?php echo $JAK_NAV_PREV_TITLE; ?></span>
          </a>
        </li>
      <?php }
      if ($JAK_NAV_NEXT) { ?>
        <li class="next">
          <a href="<?php echo $JAK_NAV_NEXT; ?>">
            <span class="nav_text_right"><?php echo $JAK_NAV_NEXT_TITLE; ?></span>
            <i class="fa fa-caret-right"></i>
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>

<?php include_once APP_PATH . 'template/' . ENVO_TEMPLATE . '/footer.php'; ?>