<?php
/**
 * Begin content wrapper.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since Controlled Chaos 1.0.0
 */
namespace Burcon_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$content_wrapper_class = apply_filters( 'burcon_content_wrapper_class', '' );

?>
<div id="content" class="site-content global-wrapper page-wrapper <?php echo $content_wrapper_class; ?>">