<?php

use Feedview\Infra\View;

if (!defined("CMSIMPLE_XH_VERSION")) {header("HTTP/1.1 403 Forbidden"); exit;}

/**
 * @var View $this
 * @var html $title
 * @var html $permalink
 * @var html $description
 * @var list<array{title:html,permalink:html,description:html,date:string}> $items
 */
?>
<!-- feedview -->
<div class="feedview_header">
  <h4 class="feedview_feed_title">
    <a href="<?=$this->raw($permalink)?>" target="_blank"><?=$this->raw($title)?></a>
  </h4>
  <div class="feedview_feed_description"><?=$this->raw($description)?></div>
</div>
<?foreach ($items as $item):?>
<div class="feedview_item">
  <h5 class="feedview_item_title">
    <a href="<?=$this->raw($item['permalink'])?>" target="_blank"><?=$this->raw($item['title'])?></a>
  </h5>
  <div class="feedview_item_description"><?=$this->raw($item['description'])?></div>
  <p class="feedview_item_posted"><?=$this->text("message_posted", $item['date'])?></p>
</div>
<?endforeach?>
