<?php

use Feedview\View;

if (!defined("CMSIMPLE_XH_VERSION")) {header("HTTP/1.1 403 Forbidden"); exit;}

/**
 * @var View $this
 * @var SimplePie $feed
 * @var array<string,string> $pcf
 * @var array<string,string> $ptx
 */
?>
<!-- Feedview_XH: default feed view -->
<div class="feedview_header">
  <h4 class="feedview_feed_title">
    <a href="<?=$feed->get_permalink()?>" target="_blank">
      <?=$feed->get_title()?>
    </a>
  </h4>
  <div class="feedview_feed_description"><?=$feed->get_description()?></div>
</div>
<?foreach ($feed->get_items(0, (int) $pcf['default_items']) as $item):?>
<div class="feedview_item">
  <h5 class="feedview_item_title">
    <a href="<?=$item->get_permalink();?>" target="_blank">
      <?=$item->get_title()?>
    </a>
  </h5>
  <div class="feedview_item_description"><?=$item->get_description()?></div>
  <p class="feedview_item_posted"><?=sprintf($ptx['message_posted'], $item->get_date($ptx['format_date']))?></p>
</div>
<?endforeach?>
