<?php k2_comment_wrapper(NULL, $node->type); ?>
<div id="node-<?php print $node->nid; ?>" class="hentry node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
  <div class="entry-head">
    <?php if ($page == 0): ?>
      <h3 class="entry-title"><a href="<?php print $node_url ?>" rel="bookmark" title="Permanent Link to <?php print $title ?>"><?php print $title ?></a></h3>
    <?php endif; ?>
    <div class="entry-meta">
		<?php if ($submitted): ?><span class="meta-start">Published</span> <div class="entry-author"><span class="meta-prep">by</span> <address class="vcard author"><?php print $name; ?></address></div> <div class="entry-date"><span class="meta-prep">on</span> <abbr class="published" title="<?php print format_date($node->created)?>"><?php print format_date($node->created)?></abbr></div><?php endif; ?> <?php if (count($taxonomy)): ?><div class="entry-categories"><span class="meta-prep"><?php print t(' in')?></span><?php print $terms; ?></div><?php endif; ?>
      <?php if ($links): ?><?php print $links; ?><?php endif; ?>
	  <?php if ( node_access('update', $node) ) { ?><span class="entry-edit"><a href="<?php print url('node/'.$node->nid.'/edit') ?>" title="Edit post">Edit</a></span><?php }; ?>
    </div> <!-- .entry-meta -->
    <?php if ($picture) { print $picture; }?> 
  </div> <!-- .entry-head -->
  <div class="entry-content">
    <?php print $content ?>
  </div> <!-- .entry-content -->
</div> <!-- #post-ID -->
