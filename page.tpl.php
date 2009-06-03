<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

<head profile="http://gmpg.org/xfn/11">
	<title><?php print $head_title ?></title>
	<?php print $head ?>
    <?php print $styles ?>
    <?php print $scripts ?>
</head>

<body class="<?php print $body_classes; ?>">
<a class="skiplink" href="#startcontent" accesskey="2">Skip to content</a>
<div id="page">
  <div id="header">
  	<?php if ($site_name): ?>
		<h1 class="blog-title"><a href="<?php print $base_path; ?>" accesskey="1"><?php print $site_name; ?></a></h1>
	<?php endif; ?>
	<?php if ($site_slogan): ?>
		<p class="description"><?php print $site_slogan; ?></p>
	<?php endif; ?>
    <?php if ($primary_links): ?>
      <?php print theme('links', $primary_links, array('class' => 'k2menu')) ?>
    <?php endif; ?>
  </div> <!-- #header -->	
  <hr />
  <div class="content">
  <div id="primary-wrapper">
    <div id="primary">
        <?php if ($breadcrumb or $tabs or $help or $messages): ?>
          <div id="notices">
            <?php print $breadcrumb; ?>
            <?php if ($title): ?>
              <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php if ($tabs): ?>
              <div class="tabs"><?php print $tabs; ?></div>
			  <?php if ($tabs2): print $tabs2; endif; ?>
            <?php endif; ?>
			<?php print $messages; ?>
            <?php print $help; ?>
          </div> <!-- /#content-header -->
        <?php endif; ?>
		<a name="startcontent" id="startcontent"></a>
        <div id="rollingcontent" class="hfeed">
          <?php print $content ?>	
        </div><!-- #rollingcontent .hfeed -->
    </div> <!-- #primary -->
  </div> <!-- #primary-wrapper -->
	
	
      <?php if ($right): ?>
        <div id="sidebar-1" class="secondary">
          <?php print $right; ?>
        </div> <!-- #sidebar-1 -->
      <?php endif; ?>
	  
      <?php if ($left): ?>
        <div id="sidebar-2" class="secondary">
          <?php print $left; ?>
        </div> <!-- #sidebar-2 -->
      <?php endif; ?>	  
	  
	  
	  
    <div class="clear"></div>	
  </div> <!-- .content -->
  <div class="clear"></div>
</div> <!-- Close Page -->
<hr />
<div id="footer">
	
	<p class="footerpoweredby">
		Powered by <a href="http://drupal.org/" title="Community Plumbling">Drupal</a> and <a href="http://getk2.com/" title="Loves you like a kitten.">K2<span class="k2-version">1.0-RC6</span></a>	</p>
</div>

<?php print $closure ?>
</body>
</html>
