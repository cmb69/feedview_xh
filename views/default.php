<?php

use Feedview\Infra\View;
use Feedview\Value\Feed;

if (!defined("CMSIMPLE_XH_VERSION")) {header("HTTP/1.1 403 Forbidden"); exit;}

/**
 * @var View $this
 * @var Feed $feed
 */
?>
<!-- Feedview_XH: default feed view -->
<div class="feedview_header">
  <h4 class="feedview_feed_title">
    <a href="<?=$feed->permalink()?>" target="_blank">
      <?=$feed->title()?>
    </a>
  </h4>
  <div class="feedview_feed_description"><?=$feed->description()?></div>
</div>
<?foreach ($feed->items() as $item):?>
<div class="feedview_item">
  <h5 class="feedview_item_title">
    <a href="<?=$item->permalink();?>" target="_blank">
      <?=$item->title()?>
    </a>
  </h5>
  <div class="feedview_item_description"><?=$item->description()?></div>
  <p class="feedview_item_posted"><?=$this->text("message_posted", $item->date())?></p>
</div>
<?endforeach?>
