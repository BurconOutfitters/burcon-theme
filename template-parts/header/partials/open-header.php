<?php
/**
 * Header opening tags and before header actions.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

do_action( 'burcon_before_header' ); ?>
<header class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">