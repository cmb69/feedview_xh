<?php $this->preventAccess()?>
<!-- Feedview_XH: default feed view -->
<div class="feedview_header">
    <h4>
        <a href="<?php echo $feed->get_permalink();?>" target="_blank">
            <?php echo $feed->get_title();?>
        </a>
    </h4>
    <p><?php echo $feed->get_description();?></p>
</div>
<?php foreach ($feed->get_items(0, (int) $pcf['default_items']) as $item):?>
<div class="feedview_item">
    <h5>
        <a href="<?php echo $item->get_permalink();?>" target="_blank">
            <?php echo $item->get_title();?>
        </a>
    </h5>
    <p><?php echo $item->get_description();?></p>
    <p><small><?php echo sprintf($ptx['message_posted'], $item->get_date($ptx['format_date']));?></small></p>
</div>
<?php endforeach;?>
