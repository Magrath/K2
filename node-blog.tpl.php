<div class="item entry<?php if ($sticky) { print " sticky"; } ?>"> 
  <?php if ($picture) {
      print $picture;
    }?> 
  <div class="entry-head"> 
    <?php if ($page == 0) { ?> 
    <h3><a href="<?php print $node_url?>" rel="bookmark" title='Permanent Link to "<?php print $title?>"'><?php print $title?></a></h3> 
    <?php }; ?>
    <div class="entry-meta"> 
		<div class="meta-start"></div>
		<div class="published">Published:</div> 
		<div class="entry-date"><?php print $date ?></div> 
		<div class="commentslink"><?php print $links ?></div><br />
	   	<?php if ($terms) { ?> 
	    	<div class="entry-tags">Tags: <?php print $terms?></div> 
	    <?php } ?> 
		<div class="meta-end">&nbsp;</div>
    </div> 
  </div> 
  <div class="entry-content"> <?php print $content?> </div> 
</div>
