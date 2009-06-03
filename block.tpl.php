<div id="block-<?php print $block->module . '-' . $block->delta; ?>" class="block-<?php print $block_classes; ?>">
  <?php if ($block->subject): ?>
    <h4><?php print $block->subject ?></h4>
  <?php endif;?>
  <div class="content">
    <?php print $block->content; ?>
  </div>
  <?php print $edit_links; ?>
</div>