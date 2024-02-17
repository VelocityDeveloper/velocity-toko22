<?php

/**
 * Template Name: Home Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package justg
 */
// phpinfo();
get_header();
$container         = velocitytheme_option('justg_container_type', 'container');
$sliders = velocitytheme_option('slider_repeat');
?>
<div class="wrapper mt-3 p-2" id="page-wrapper">
    <div class="" id="content">
        <div class="row m-0">
            <?php do_action('justg_before_content'); ?>
            <main class="site-main" id="main" role="main">

                <div id="carouselExampleInterval" class="carousel mx-2 m-md-0 slide border" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($sliders as $slider) : ?>
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img class="ratio ratio-21x9" src="<?php echo $slider['imgslider']; ?>" alt="...">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Produk Top section -->
                <?php $args = [
                    'posts_per_page' => 4,
                    'post_type' => 'product',
                    'tax_query' => [
                        [
                            'taxonomy' => 'category-product', // Specify the taxonomy
                            'field'    => 'term_id', // Specify the field to query by (term_id, slug, or name)
                            'terms'    => velocitytheme_option('velocity_news'),  // Specify the term ID
                        ],
                    ],
                ];
                $wp_query = new WP_Query($args);

                if ($wp_query->have_posts()) : ?>
                    <div class="produks-home">
                        <?php if (!empty(velocitytheme_option('velocity_judul_news'))) : ?>
                            <h3 class="title-single-part mt-3"><?php echo velocitytheme_option('velocity_judul_news'); ?></h3>
                        <?php endif; ?>

                        <div class="row mx-0">
                            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                                <article <?php post_class('col-md-3 col-6 p-2'); ?> id="post-<?php the_ID(); ?>">
                                    <div class="card rounded-0 p-2">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <div class="ratio ratio-1x1">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail('full', array('class' => 'w-100 mb-3')); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif;
                wp_reset_query(); ?>

                <h5 class="text-center fw-bold my-3 colortheme"><?php echo get_option('blogname') . ' - ' . get_option('blogdescription'); ?></h5>

                <?php if (!empty(velocitytheme_option('sambutan_home'))) : ?>
                    <div class="text-center px-2 p-md-0"><?php echo velocitytheme_option('sambutan_home'); ?></div>
                <?php endif; ?>

                <div class="produk-home mb-2">
                    <?php
                    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                    $argprod = array(
                        'posts_per_page' => 6,
                        'post_type' => 'product',
                        'paged' => $paged,
                    );
                    $produk_query = new WP_Query($argprod);

                    if ($produk_query->have_posts()) :
                        echo '<div class="row m-0">';
                        while ($produk_query->have_posts()) {
                            $produk_query->the_post();
                            do_action('velocitytoko_product_loop');
                        }
                        echo '</div>';

                        // Fungsi pagination
                        echo '<div class="pagination pagi-home justify-content-center">';
                        echo paginate_links([
                            'total' => $produk_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => __('&laquo; Prev'),
                            'next_text' => __('Next &raquo;'),
                        ]);
                        echo '</div>';
                        wp_reset_query();
                    endif;
                    ?>
                </div>
            </main><!-- #main -->
            <?php do_action('justg_after_content'); ?>
        </div>
    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
