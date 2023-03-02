<?php

use Feedview\Infra\View;

if (!defined("CMSIMPLE_XH_VERSION")) {header("HTTP/1.1 403 Forbidden"); exit;}

/**
 * @var View $this
 * @var string $title
 * @var string $permalink
 * @var string $description
 * @var list<array{title:string,permalink:string,description:string,date:string}> $items
 */
?>
<!-- Feedview_XH: default feed view -->
<div class="feedview_header">
  <h4 class="feedview_feed_title">
    <a href="<?=$permalink?>" target="_blank">
      <?=$title?>
    </a>
  </h4>
  <div class="feedview_feed_description"><?=$description?></div>
</div>
<?foreach ($items as $item):?>
<div class="feedview_item">
  <h5 class="feedview_item_title">
    <a href="<?=$item['permalink'];?>" target="_blank">
      <?=$item['title']?>
    </a>
  </h5>
  <div class="feedview_item_description"><?=$item['description']?></div>
  <p class="feedview_item_posted"><?=$this->text("message_posted", $item['date'])?></p>
</div>
<?endforeach?>
