<?php
/**
 * Blog pages standard navigation.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( is_search() ) {
    $prev = __( 'Previous Results', 'burcon-theme' );
    $next = __( 'More Results', 'burcon-theme' );
} else {
    $prev = __( 'Previous Page', 'burcon-theme' );
    $next = __( 'Next Page', 'burcon-theme' );
}

$prev_posts = apply_filters( 'burcon_prev_posts_label', sprintf( '<span>%1s</span>', $prev ) );
$next_posts = apply_filters( 'burcon_next_posts_label', sprintf( '<span>%1s</span>', $next ) );
?>
<nav class="posts-nav">
	<span class="prev-page" rel="prev"><?php previous_posts_link( $prev_posts ); ?></span>
	<span class="next-page" rel="next"><?php next_posts_link( $next_posts ); ?></span>
</nav>