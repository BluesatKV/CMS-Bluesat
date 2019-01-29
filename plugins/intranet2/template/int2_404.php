<?php include_once $BASE_PLUGIN_URL_TEMPLATE . 'int_header.php'; ?>

  <div class="row">
    <div class="col-sm-12">
      <div class="error-page">

    <?php
    // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
    echo $Html->addTag('h2', '404', 'headline text-warning');

    // Add Html Element -> startTag (Arguments: tag, optional assoc. array)
    echo $Html->startTag('div', array('class' => 'error-content'));

    // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
    echo $Html->addTag('h3', $Html->addTag('i', '', 'fas fa-exclamation-triangle fa-lg text-warning m-r-15') . 'Oops! Stránka nenalezena.');
    echo $Html->addTag('p', str_replace("%s", BASE_URL . ENVO_PLUGIN_VAR_INTRANET2, 'Požadovaná stránka, kterou hledáte nebyla nalezena. Můžete se vrátit zpět na <a href="%s">úvodní stránku</a>'));

    // Add Html Element -> endTag (Arguments: tag)
    echo $Html->endTag('div');
    ?>

      </div>
    </div>
  </div>

<?php include_once $BASE_PLUGIN_URL_TEMPLATE . 'int_footer.php'; ?>