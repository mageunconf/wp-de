<?php
/**
* @package   Uniq
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$special_blog = $this['config']->get('article') == 'tm-article-blog';
?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <?php if ($special_blog) : // special layout: article container ?>
    <article class="uk-article tm-panel-large" data-permalink="<?php the_permalink(); ?>">
        <div class="uk-panel uk-panel-box">
    <?php else : // default layout: article container ?>
    <article class="uk-article" data-permalink="<?php the_permalink(); ?>">
    <?php endif; ?>

        <?php if (has_post_thumbnail()) : ?>
           <?php
               $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
               $height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
           ?>

           <?php if ($special_blog) : ?>
           <span class="tm-featured-image uk-panel-teaser uk-margin-large-bottom">
           <?php endif; ?>

           <?php the_post_thumbnail(array($width, $height), array('class' => '')); ?>

           <?php if ($special_blog) : ?>
           </span>
           <?php endif; ?>
        <?php endif; ?>

        <h1 class="uk-article-title <?php echo $special_blog ? 'uk-margin-bottom' : ''; ?>"><?php the_title(); ?></h1>

        <?php if (!$special_blog) : ?>
        <p class="uk-article-meta">
            <?php
                $date = '<time datetime="'.get_the_date('Y-m-d').'">'.get_the_date().'</time>';
                printf(__('Written by %s on %s. Posted in %s', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
            ?>
        </p>
        <?php endif; ?>

        <?php the_content(''); ?>

        <?php wp_link_pages(); ?>

        <?php if (!$special_blog) : ?>
            <?php the_tags('<p>'.__('Tags: ', 'warp'), ', ', '</p>'); ?>
        <?php endif; ?>


        <?php if ($special_blog) : ?>
        <hr class="uk-margin-top uk-margin-bottom">
        <div class="tm-article-meta">
            <span><a class="uk-link-reset" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a></span>
            <span><time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time></span>
            <span><?php echo get_the_category_list(', '); ?></span>
            <?php echo the_tags('<span>'.__('Tags: ', 'warp'), ', ', '</span>'); ?>
        </div>
        <?php endif; ?>


        <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

        <?php if (pings_open()) : ?>
        <p><?php printf(__('<a href="%s">Trackback</a> from your site.', 'warp'), get_trackback_url()); ?></p>
        <?php endif; ?>

        <?php if (get_the_author_meta('description')) : ?>
        <div class="uk-panel uk-panel-box">
            <div class="uk-align-medium-left">
                <?php echo get_avatar(get_the_author_meta('user_email')); ?>
            </div>
            <h2 class="uk-h3 uk-margin-top-remove"><?php the_author(); ?></h2>
            <div class="uk-margin"><?php the_author_meta('description'); ?></div>
        </div>
        <?php endif; ?>

        <?php comments_template(); ?>

        <?php
            $prev = get_previous_post();
            $next = get_next_post();
        ?>

        <?php if ($this['config']->get('post_nav', 0) && ($prev || $next)) : ?>
        <ul class="uk-pagination">
            <?php if ($next) : ?>
            <li class="uk-pagination-next">
                <a href="<?php echo get_permalink($next->ID) ?>" title="<?php echo __('Next', 'warp'); ?>">
                    <?php echo __('Next', 'warp'); ?>
                    <i class="uk-icon-arrow-right"></i>
                </a>
            </li>
            <?php endif; ?>
            <?php if ($prev) : ?>
            <li class="uk-pagination-previous">
                <a href="<?php echo get_permalink($prev->ID) ?>" title="<?php echo __('Prev', 'warp'); ?>">
                    <i class="uk-icon-arrow-left"></i>
                    <?php echo __('Prev', 'warp'); ?>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>

        <?php if ($special_blog) : // special layout: article container ?>
        </div>
        <?php endif; ?>

    </article>

    <?php endwhile; ?>
<?php endif; ?>
