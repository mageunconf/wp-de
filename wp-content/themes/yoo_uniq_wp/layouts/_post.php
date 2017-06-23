<?php
/**
* @package   Uniq
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$special_blog = $this['config']->get('article') == 'tm-article-blog';
?>

<?php if ($special_blog) : // special layout: article container ?>
<article id="item-<?php the_ID(); ?>" class="uk-article tm-panel-large" data-permalink="<?php the_permalink(); ?>">
	<div class="uk-panel uk-panel-box">
<?php else: ?>
<article id="item-<?php the_ID(); ?>" class="uk-article" data-permalink="<?php the_permalink(); ?>">
<?php endif; ?>

    <?php if (has_post_thumbnail()) : ?>
        <?php
        $width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
        $height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
        ?>
        <a <?php if ($special_blog) echo 'class="tm-featured-image uk-panel-teaser uk-margin-large-bottom"' ?> href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array($width, $height), array('class' => '')); ?></a>
    <?php endif; ?>

    <h1 class="uk-article-title uk-margin-bottom"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

    <?php if (!$special_blog) : ?>
    <p class="uk-article-meta">
        <?php
            $date = '<time datetime="'.get_the_date('Y-m-d').'">'.get_the_date().'</time>';
            printf(__('Written by %s on %s. Posted in %s', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
        ?>
    </p>
    <?php endif; ?>

    <?php the_content(''); ?>

    <ul class="uk-subnav">
        <li><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Continue Reading', 'warp'); ?></a></li>
        <?php if(comments_open() || get_comments_number()) : ?>
            <li><?php comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?></li>
        <?php endif; ?>
    </ul>

    <?php if ($special_blog) : ?>
    <hr class="uk-margin-top uk-margin-bottom">
    <div class="tm-article-meta">
        <span><a class="uk-link-reset" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a></span>
        <span><time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time></span>
        <span><?php echo get_the_category_list(', '); ?></span>
    </div>
    <?php endif; ?>

    <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

</article>
