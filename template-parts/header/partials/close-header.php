<?php
/**
 * Header closing tags and after header actions.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit; ?>
</header>
<?php do_action( 'burcon_after_header' ); ?>