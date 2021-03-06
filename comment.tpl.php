<li class="comment <?php print $comment_classes; ?>">
<?php print $picture ?>
	<span class="commentauthor"><?php print t('!username', array('!username' => theme('username', $comment))); ?></span>
	<div class="comment-meta">
		<?php print t('!date', array('!date' => format_date($comment->timestamp))); ?>
		<?php if ($comment->new) : ?><a id="new"></a><span class="new"><?php print drupal_ucfirst($new) ?></span><?php endif; ?>
	</div><!-- .comment-meta -->
    <div class="comment-content">
      <?php print $content ?>
    </div><!-- .comment-content -->
  <?php if ($links): ?><div class="links"><?php print $links ?></div><?php endif; ?>
</li>