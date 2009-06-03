<?php

  // Don't display empty help from node_help().
  if ($vars['help'] == "<div class=\"help\"><p></p>\n</div>") {
    $vars['help'] = '';
  }

  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  $body_classes = array($vars['body_classes']);
  if (!$vars['is_front']) {
    // Add unique classes for each page and website section
    $path = drupal_get_path_alias($_GET['q']);
    list($section, ) = explode('/', $path, 2);
    $body_classes[] = k2_id_safe('page-' . $path);
    $body_classes[] = k2_id_safe('section-' . $section);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-add'; // Add 'section-node-add'
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-' . arg(2); // Add 'section-node-edit' or 'section-node-delete'
      }
    }
  }
  $vars['body_classes'] = implode(' ', $body_classes); // Concatenate with spaces

/**
 * Converts a string to a suitable html ID attribute.
 *
 * http://www.w3.org/TR/html4/struct/global.html#h-7.5.2 specifies what makes a
 * valid ID attribute in HTML. This function:
 *
 * - Ensure an ID starts with an alpha character by optionally adding an 'n'.
 * - Replaces any character except A-Z, numbers, and underscores with dashes.
 * - Converts entire string to lowercase.
 *
 * @param $string
 *   The string
 * @return
 *   The converted string
 */
function k2_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id' . $string;
  }
  return $string;
}

/**
 * Allow themable wrapping of all comments.
 */
function k2_comment_wrapper($content, $type = null) {
  static $node_type;
  if (isset($type)) $node_type = $type;

  if (!$content || $node_type == 'forum') {
    return '<span id="comments">'. $content . '</span>';
  }
  else {
	return '<h4><span id="comments"></span>'. t('Comments') .'</h4><ol id="commentlist">'. $content .'</ol>';
  }
}


/**
* Override or insert PHPTemplate variables into the templates.
*/
function phptemplate_preprocess_page(&$vars) {
$vars['tabs2'] = menu_secondary_local_tasks();

// Hook into color.module
if (module_exists('color')) {
_color_page_alter($vars);
}
}

/**
 * Override or insert PHPTemplate variables into the comment templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called ("comment" in this case.)
 */
function k2_preprocess_comment(&$vars, $hook) {
  global $user;

  // We load the node object that the current comment is attached to
  $node = node_load($vars['comment']->nid);
  // If the author of this comment is equal to the author of the node, we
  // set a variable so we can theme this comment uniquely.
  $vars['author_comment'] = $vars['comment']->uid == $node->uid ? TRUE : FALSE;

  $comment_classes = array();

  // Odd/even handling
  static $comment_odd = TRUE;
  $comment_classes[] = $comment_odd ? 'odd' : 'even';
  $comment_odd = !$comment_odd;

  if ($vars['comment']->status == COMMENT_NOT_PUBLISHED) {
    $comment_classes[] = 'comment-unpublished';
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
  if ($vars['author_comment']) {
    // Comment is by the node author
    $comment_classes[] = 'bypostauthor';
  }
  if ($vars['comment']->uid == 0) {
    // Comment is by an anonymous user
    $comment_classes[] = 'comment-by-anon';
  }
  if ($user->uid && $vars['comment']->uid == $user->uid) {
    // Comment was posted by current user
    $comment_classes[] = 'comment-mine';
  }
  $vars['comment_classes'] = implode(' ', $comment_classes);

  // If comment subjects are disabled, don't display 'em
  if (variable_get('comment_subject_field', 1) == 0) {
    $vars['title'] = '';
  }
}

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function _phptemplate_variables($hook, $vars) {
  if ($hook == 'page') {

    if ($secondary = menu_secondary_local_tasks()) {
      $output = '<span class="clear"></span>';
      $output .= "<ul class=\"tabs secondary\">\n". $secondary ."</ul>\n";
      $vars['tabs2'] = $output;
    }

    // Hook into color.module
    if (module_exists('color')) {
      _color_page_alter($vars);
    }
    return $vars;
  }
  return array();
}

/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= "<ul class=\"tabs primary\">\n". $primary ."</ul>\n";
  }

  return $output;
}
