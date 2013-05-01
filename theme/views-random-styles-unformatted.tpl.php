<?php

$items = array();
foreach ($rows as $id => $row) {
  $items[] = '<div class="views-row views-row-'. $id .'">' . $row . '</div>';
}

/*
 * We use json_encode() for items when possible, because drupal_to_js
 * converts even < and > into \uXXXX, so we got rather big growth of source code
 * with it.
 */
$js_items = function_exists('json_encode') ? json_encode($items) : drupal_json_encode($items);
?>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
  if (typeof(Drupal.ViewsRandomStyle) == 'function') {
    Drupal.ViewsRandomStyle(<?php print $js_items ?>, <?php print drupal_json_encode($options) ?>);
  }
//--><!]]>
</script>
