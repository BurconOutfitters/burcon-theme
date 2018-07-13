<?php
/**
 * Singular HTML output.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

    do_action( 'burcon_before_main' ); ?>
    
	<main class="main" role="main" itemscope itemprop="mainContentOfPage">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'burcon_before_article' ); ?>
        <article class="hentry" id="post-<?php the_ID(); ?>" role="article">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>
            <div class="entry-content" itemprop="articleBody">
            <?php
            if ( '' !== get_the_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <?php
                    $size = apply_filters( 'burcon_singular_thumbnail_size', 'banner' );
                    $args = apply_filters( 'burcon_singular_thumbnail_args', [
                        'class' => 'alignnone'
                    ] );
                    echo get_the_post_thumbnail( $post->ID, $size, $args ); ?>
                </div><!-- post-thumbnail -->
            <?php endif; ?>
            <?php do_action( 'burcon_before_content' ); ?>
            <?php the_content(); ?>
            <?php do_action( 'burcon_after_content' ); ?>
            </div><!-- entry-content -->
        </article>
        <?php do_action( 'burcon_after_article' ); ?>
        <?php if ( comments_open() || get_comments_number() ) {
            comments_template();
        } ?>
    <?php endwhile; endif; ?>
	</main>
	<?php do_action( 'burcon_after_main' ); ?>