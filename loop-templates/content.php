<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit; ?>

<article <?php post_class('col-md-6 mx-0 p-2 mb-3'); ?> id="post-<?php the_ID(); ?>">
    <div class="card rounded-1 p-2">
        <?php if (has_post_thumbnail()) { ?>
            <div class="ratio ratio-4x3">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('full', array('class' => 'w-100 mb-3')); ?>
                </a>
            </div>
        <?php } ?>

        <div class="judul-posts my-2">
            <h6 class="m-0">
                <a class="colortheme text-uppercase" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a>
            </h6>
        </div>
        <div class="entry-content text-justify">
            <?php $content = get_the_content();
            $trimmed_content = wp_trim_words($content, 20);
            echo $trimmed_content; ?>
        </div>
    </div>
</article>