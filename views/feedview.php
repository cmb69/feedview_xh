<?php

use Feedview\Infra\View;

if (!defined("CMSIMPLE_XH_VERSION")) {header("HTTP/1.1 403 Forbidden"); exit;}

/**
 * @var View $this
 * @var html|null $title
 * @var html|null $permalink
 * @var html|null $description
 * @var list<array{title:string|null,permalink:string|null,description:string|null,date:string|null}> $items
 * @var string|null $prev_url
 * @var string|null $next_url
 * @var string $h_feed
 * @var string $h_item
 */
?>
<!-- feedview -->
<div class="feedview_header">
  <<?=$h_feed?> class="feedview_feed_title">
<?if (isset($permalink)):?>
    <a href="<?=$this->raw($permalink)?>" target="_blank">
<?endif?>
<?if (isset($title)):?>
      <span><?=$this->raw($title)?></span>
<?endif?>
<?if (isset($permalink)):?>
    </a>
<?endif?>
  </<?=$h_feed?>>
<?if (isset($description)):?>
  <div class="feedview_feed_description"><?=$this->raw($description)?></div>
<?endif?>
</div>
<?foreach ($items as $item):?>
<div class="feedview_item">
  <<?=$h_item?> class="feedview_item_title">
<?if (isset($item['permalink'])):?>
    <a href="<?=$this->raw($item['permalink'])?>" target="_blank">
<?endif?>
<?if (isset($item['title'])):?>
      <span><?=$this->raw($item['title'])?></span>
<?endif?>
<?if (isset($item['permalink'])):?>
    </a>
<?endif?>
  </<?=$h_item?>>
<?if (isset($item['description'])):?>
  <div class="feedview_item_description"><?=$this->raw($item['description'])?></div>
<?endif?>
<?if (isset($item['date'])):?>
  <p class="feedview_item_posted"><?=$this->text("message_posted", $item['date'])?></p>
<?endif?>
</div>
<?endforeach?>
<div class="feedview_nav">
<?if (isset($prev_url)):?>
  <a class="feedview_prev" href="<?=$this->esc($prev_url)?>"><?=$this->text('label_prev')?></a>
<?endif?>
<?if (isset($next_url)):?>
  <a class="feedview_next" href="<?=$this->esc($next_url)?>"><?=$this->text('label_next')?></a>
<?endif?>
</div>
