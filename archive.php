<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
$pagebg = velocitytheme_option('velocity_page_image');
?>

<div class="wrapper" id="archive-wrapper">
    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main" id="main">

                <div class="mx-2">
                    <?php justg_breadcrumb(); ?>
                    <?php velocity_title(); ?>
                </div>
                <?php
                if (have_posts()) :
                    // Start the loop.
                    echo '<div class="row m-0">';
                    while (have_posts()) :
                        the_post();
                        get_template_part('loop-templates/content', get_post_format());
                    endwhile;
                    echo '</div>';
                else :
                    get_template_part('loop-templates/content', 'none');
                endif;
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination();
                ?>
            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->
<?php
get_footer();
