<?php
/**
* @package   Uniq
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

use \Yootheme\Widgetkit\Content\Content;

// Id
$settings['id'] = substr(uniqid(), -3);

// Grid
$grid  = 'uk-grid-width-1-'.$settings['columns'];
$grid .= $settings['columns_small'] ? ' uk-grid-width-small-1-'.$settings['columns_small'] : '';
$grid .= $settings['columns_medium'] ? ' uk-grid-width-medium-1-'.$settings['columns_medium'] : '';
$grid .= $settings['columns_large'] ? ' uk-grid-width-large-1-'.$settings['columns_large'] : '';
$grid .= $settings['columns_xlarge'] ? ' uk-grid-width-xlarge-1-'.$settings['columns_xlarge'] : '';

if ($settings['grid'] == 'dynamic') {

    // Filter Tags
    $tags = array();

    if (isset($settings['tag-list']) && is_array($settings['tag-list'])) {
        $tags = $settings['tag-list'];
    }

    if(!count($tags)){
        foreach ($items as $i => $item) {
            if ($item['tags']) {
                $tags = array_merge($tags, $item['tags']);
            }
        }
        $tags = array_unique($tags);

        natsort($tags);
        $tags = array_values($tags);
    }

    // Filter Nav
    $tabs_center = '';
    if ($settings['filter'] == 'tabs') {

        $filter  = 'uk-tab';
        $filter .= ($settings['filter_align'] == 'right') ? ' uk-tab-flip' : '';
        $filter .= ($settings['filter_align'] != 'center') ? ' uk-margin' : '';
        $tabs_center  = ($settings['filter_align'] == 'center') ? 'uk-tab-center uk-margin' : '';

    } elseif ($settings['filter'] != 'none') {

        switch ($settings['filter']) {
            case 'text':
                $filter = 'uk-subnav';
                break;
            case 'lines':
                $filter = 'uk-subnav uk-subnav-line';
                break;
            case 'nav':
                $filter = 'uk-subnav uk-subnav-pill';
                break;
        }

        $filter .= ' uk-flex-' . $settings['filter_align'];
    }

    // JS Options
    $options   = array();
    $options[] = ($settings['gutter_dynamic']) ? 'gutter: \'' . $settings['gutter_v_dynamic'] . ' ' . $settings['gutter_dynamic'] . '\'' : '';
    $options[] = ($settings['filter'] != 'none') ? 'controls: \'#wk-' . $settings['id'] . '\'' : '';
    $options[] = (count($tags) && $settings['filter'] != 'none' && !$settings['filter_all']) ? 'filter: \'' . $tags[0] . '\'': '';
    $options   = implode(',', array_filter($options));

    $grid_js   = $options ? 'data-uk-grid="{' . $options . '}"' : 'data-uk-grid';

} else {
    $grid .= ' uk-grid uk-grid-match';
    $grid .= ($settings['gutter'] == 'collapse') ? ' uk-grid-collapse' : '' ;
    $grid .= ($settings['gutter'] == 'small') ? ' uk-grid-small' : '' ;
    $grid .= ($settings['gutter'] == 'medium') ? ' uk-grid-medium' : '' ;
    $grid_js = 'data-uk-grid-match="{target:\'> div > .uk-panel\', row:true}" data-uk-grid-margin';
}

// Title Size
$title_classes = array(
    'panel' => 'uk-panel-title',
    'large' => 'uk-heading-large',
);

$title_size = array_key_exists($settings['title_size'], $title_classes) ? $title_classes[$settings['title_size']] : 'uk-'.$settings['title_size'];
$title_size_lightbox = array_key_exists($settings['lightbox_title_size'], $title_classes) ? $title_classes[$settings['lightbox_title_size']] : 'uk-'.$settings['lightbox_title_size'];

// Content Size in Lightbox
$text_size_lightbox = isset($settings['lightbox_content_size']) ? $settings['lightbox_content_size'] : '';

// Button: Link
switch ($settings['link_style']) {
    case 'icon-small':
        $button_link = 'uk-icon-small';
        break;
    case 'icon-medium':
        $button_link = 'uk-icon-medium';
        break;
    case 'icon-large':
        $button_link = 'uk-icon-large';
        break;
    case 'icon-button':
        $button_link = 'uk-icon-button';
        break;
    case 'button':
        $button_link = 'uk-button';
        break;
    case 'primary':
        $button_link = 'uk-button uk-button-primary';
        break;
    case 'button-large':
        $button_link = 'uk-button uk-button-large';
        break;
    case 'primary-large':
        $button_link = 'uk-button uk-button-large uk-button-primary';
        break;
    case 'button-link':
        $link_style = 'uk-button uk-button-link';
        break;
    default:
        $button_link = '';
}

switch ($settings['link_style']) {
    case 'icon':
    case 'icon-small':
    case 'icon-medium':
    case 'icon-large':
    case 'icon-button':
        $button_link .= ' uk-icon-' . $settings['link_icon'];
        $settings['link_text'] = '';
        break;
}

// Media Border
$border = ($settings['media_border'] != 'none') ? 'uk-border-' . $settings['media_border'] : '';

// Animation
$animation = ($settings['animation'] != 'none') ? ' data-uk-scrollspy="{cls:\'uk-animation-' . $settings['animation'] . ' uk-invisible\', target:\'> div > .uk-panel\', delay:300}"' : '';

// Badge style
$badge_style = isset($settings['badge_style']) ? $settings['badge_style'] : '';

?>

<?php if (isset($tags) && $tags && $settings['filter'] != 'none') : ?>

    <?php if ($tabs_center) : ?>
    <div class="<?php echo $tabs_center; ?>">
    <?php endif ?>

    <ul id="wk-<?php echo $settings['id']; ?>" class="<?php echo $filter; ?>"<?php if ($settings['filter'] == 'tabs') echo ' data-uk-tab'?>>

        <?php if ($settings['filter_all']) : ?>
        <li class="uk-active" data-uk-filter=""><a href="#"><?php echo $app['translator']->trans('All'); ?></a></li>
        <?php endif ?>

        <?php foreach ($tags as $i => $tag) : ?>
        <li data-uk-filter="<?php echo $tag; ?>"><a href="#"><?php echo ucwords($tag); ?></a></li>
        <?php endforeach; ?>

    </ul>

    <?php if ($tabs_center) : ?>
    </div>
    <?php endif ?>

<?php endif; ?>

<div id="wk-grid<?php echo $settings['id']; ?>" class="<?php echo $grid; ?> <?php echo $settings['class']; ?>" <?php echo $grid_js; ?> <?php echo $animation; ?>>

<?php foreach ($items as $index => $item) : ?>
    <?php if ($item['media']) :

        // Link Target
        $link_target = ($settings['link_target']) ? ' target="_blank"' : '';

        // Thumbnails
        $thumbnail = '';
        if (($item->type('media') == 'image' || $item['media.poster'])) {

            $attrs           = array('class' => '');
            $width           = ($settings['image_width'] != 'auto') ? $settings['image_width'] : $item['media.width'];
            $height          = ($settings['image_height'] != 'auto') ? $settings['image_height'] : $item['media.height'];

            $attrs['alt']    = strip_tags($item['title']);
            $attrs['width']  = $width;
            $attrs['height'] = $height;

            $attrs['class'] .= ($settings['image_animation'] != 'none') ? 'uk-overlay-' . $settings['image_animation'] : '';

            if ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto') {
                $thumbnail = $item->thumbnail($item->type('media') == 'image' ? 'media' : 'media.poster', $width, $height, $attrs);
            } else {
                if(($item->type('media') == 'image') && $settings['gutter_dynamic']){

                    if ($img  = $app['image']->create($item->get('media'))) {
                        $size = getimagesize($img->getPathName());
                        $width  = $size[0];
                        $height = $size[1];
                        $attrs['width'] = $width;
                        $attrs['height'] = $height;
                    }
                }
                $thumbnail = $item->media($item->type('media') == 'image' ? 'media' : 'media.poster', $attrs);
            }
        }

        // Lightbox
        $lightbox = '';

        if ($settings['lightbox']) {
            if ($item->type('media') == 'image') {
                if ($settings['lightbox_width'] != 'auto' || $settings['lightbox_height'] != 'auto') {

                    $width  = ($settings['lightbox_width'] != 'auto') ? $settings['lightbox_width'] : $item[$field . '.width'];
                    $height = ($settings['lightbox_height'] != 'auto') ? $settings['lightbox_height'] : $item[$field . '.width'];

                    $lightbox = 'href="' . htmlspecialchars($item->thumbnail($field, $width, $height, $attrs, true), null, null, false) . '" data-lightbox-type="image"';
                } else {
                    $lightbox = 'href="' . $item['media'] . '" data-lightbox-type="image"';
                }
            } else {
                $lightbox = 'href="' . $item['media'] . '"';
            }
        }

        // Lightbox Caption
        $lightbox_caption = '';
        if ($settings['lightbox_caption'] != 'none') {
            $lightbox_caption = $item[$settings['lightbox_caption']] ? 'title="' . htmlspecialchars($item[$settings['lightbox_caption']]) .'"' : '';
        }

        // Overlay Excerpt
        $excerpt = $item['content'];
        if (strlen($excerpt) > $settings['excerpt_length']) {
            $excerpt = Content::truncate($excerpt, $settings['excerpt_length']);
        }

        // Filter
        $filter = '';
        if ($item['tags'] && $settings['grid'] == 'dynamic' && $settings['filter'] != 'none') {
            $filter = ' data-uk-filter="' . implode(',', $item['tags']) . '"';
        }

    ?>

    <div<?php echo $filter; ?>>
        <div class="uk-panel uk-overlay-hover uk-text-center<?php if ($settings['animation'] != 'none') echo ' uk-invisible'; ?>">

            <?php if ($item['badge']) : ?>
            <div class="uk-panel-badge uk-badge <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></div>
            <?php endif; ?>

            <figure class="uk-overlay tm-overlay-uniq <?php echo $border; ?>">

                <?php echo $thumbnail; ?>

                <div class="uk-overlay-panel uk-overlay-bottom">
                    <div>

                    <?php if ($item['title']) : ?>
                    <h3 class="<?php echo $title_size; ?> uk-margin-bottom-remove tm-overlay-panel-title"><?php echo $item['title']; ?></h3>
                    <?php endif; ?>

                    <?php if ($item['content'] && $settings['content']) : ?>
                    <div class="tm-panel-caption"><?php echo $excerpt; ?></div>
                    <?php endif; ?>

                    </div>
                </div>

                <?php if ($settings['lightbox']) : ?>
                    <?php if ($settings['lightbox'] == 'slideshow') : ?>
                        <a class="uk-position-cover tm-panel-link" href="#wk-3<?php echo $settings['id']; ?>" data-index="<?php echo $index; ?>" data-uk-modal><i class="tm-icon tm-icon-plus"></i></a>
                    <?php else : ?>
                        <a class="uk-position-cover tm-panel-link" <?php echo $lightbox; ?> data-uk-lightbox="{group:'.wk-1<?php echo $settings['id']; ?>'}" <?php echo $lightbox_caption; ?>><i class="tm-icon tm-icon-plus"></i></a>
                    <?php endif; ?>
                <?php elseif ($item['link']) : ?>
                    <a class="uk-position-cover tm-panel-link" href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><i class="tm-icon tm-icon-plus"></i></a>
                <?php endif; ?>

            </figure>

        </div>
    </div>

    <?php endif; ?>
<?php endforeach; ?>

</div>

<?php if ($settings['lightbox'] == 'slideshow') : ?>
<div id="wk-3<?php echo $settings['id']; ?>" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-blank">

        <button class="uk-modal-close tm-close" type="button"></button>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2 uk-text-center">

                <div class="uk-slidenav-position" data-uk-slideshow data-uk-check-display>
                    <ul class="uk-slideshow uk-slideshow-fullscreen">
                        <?php foreach ($items as $item) :

                            // Alternative Media Field
                            $field = 'media';
                            if ($settings['lightbox_alt']) {
                                foreach ($item as $media_field) {
                                    if (($item[$media_field] != $item['media']) && ($item->type($media_field) == 'image')) {
                                        $field = $media_field;
                                        break;
                                    }
                                }
                            }

                            // Media Type
                            $attrs  = array('class' => '');
                            $width  = $item[$field . '.width'];
                            $height = $item[$field . '.height'];

                            if ($item->type($field) == 'image') {
                                $attrs['alt'] = strip_tags($item['title']);
                                $width  = ($settings['image_width'] != 'auto') ? $settings['image_width'] : $width;
                                $height = ($settings['image_height'] != 'auto') ? $settings['image_height'] : $height;
                            }

                            if ($item->type($field) == 'video') {
                                $attrs['class'] = 'uk-responsive-width';
                                $attrs['controls'] = true;
                            }

                            if ($item->type($field) == 'iframe') {
                                $attrs['class'] = 'uk-responsive-width';
                            }

                            $attrs['width']  = ($width) ? $width : '';
                            $attrs['height'] = ($height) ? $height : '';

                            if (($item->type($field) == 'image') && ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto')) {
                                $media = $item->thumbnail($field, $width, $height, $attrs);
                            } else {
                                $media = $item->media($field, $attrs);
                            }

                        ?>

                            <li>
                                <?php echo $media; ?>
                            </li>

                        <?php endforeach; ?>
                    </ul>

                    <a href="#" class="uk-slidenav <?php if ($settings['lightbox_nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-previous uk-hidden-touch" data-uk-slideshow-item="previous"></a>
                    <a href="#" class="uk-slidenav <?php if ($settings['lightbox_nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-next uk-hidden-touch" data-uk-slideshow-item="next"></a>

                </div>
            </div>
            <div class="uk-width-medium-1-2 uk-flex uk-flex-column uk-flex-center">

                <div class="uk-panel-body" data-uk-slideshow data-uk-check-display>
                    <ul class="uk-slideshow">
                        <?php foreach ($items as $item) : ?>
                        <li>

                            <?php if ($settings['lightbox_content_container'] != 'default') : ?>
                            <div class="<?php echo $settings['lightbox_content_container'] ?>">
                            <?php endif; ?>

                            <?php if ($item['title']) : ?>
                            <h3 class="<?php echo $title_size_lightbox; ?>"><?php echo $item['title']; ?></h3>
                            <?php endif; ?>

                            <?php if ($item['content'] && $settings['content']) : ?>
                            <div class="uk-margin-top <?php echo $text_size_lightbox; ?>"><?php echo $item['content']; ?></div>
                            <?php endif; ?>

                            <?php if ($item['lightbox_content']) : ?>
                            <div class="uk-margin-top <?php echo $text_size_lightbox; ?>"><?php echo $item['lightbox_content']; ?></div>
                            <?php endif; ?>

                            <?php if ($item['link'] && $settings['link']) : ?>
                            <p class="uk-margin-bottom-remove uk-margin-large-top"><a <?php echo ($button_link != '') ? 'class="'.$button_link.'"' : ''; ?> href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
                            <?php endif; ?>

                            <?php if ($settings['lightbox_content_container'] != 'default') : ?>
                            </div>
                            <?php endif; ?>

                        </li>
                    <?php endforeach; ?>
                    </ul>

                    <div class="uk-margin-top">
                        <ul class="uk-thumbnav uk-margin-bottom-remove">
                        <?php foreach ($items as $i => $item) :

                                // Thumbnails
                                $thumbnail = '';
                                if (($item->type('media') == 'image' || $item['media.poster'])) {

                                    $attrs           = array();
                                    $width           = ($settings['lightbox_nav_width'] != 'auto') ? $settings['lightbox_nav_width'] : $item['media.width'];
                                    $height          = ($settings['lightbox_nav_height'] != 'auto') ? $settings['lightbox_nav_height'] : $item['media.height'];

                                    $attrs['alt']    = strip_tags($item['title']);
                                    $attrs['width']  = $width;
                                    $attrs['height'] = $height;

                                    if ($settings['lightbox_nav_width'] != 'auto' || $settings['lightbox_nav_height'] != 'auto') {
                                        $thumbnail = $item->thumbnail($item->type('media') == 'image' ? 'media' : 'media.poster', $width, $height, $attrs);
                                    } else {
                                        $thumbnail = $item->media($item->type('media') == 'image' ? 'media' : 'media.poster', $attrs);
                                    }
                                }

                            ?>
                            <li data-uk-slideshow-item="<?php echo $i; ?>"><a href="#"><?php echo ($thumbnail) ? $thumbnail : $item['title']; ?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    (function($){

        var modal      = $('#wk-3<?php echo $settings['id']; ?>'),
            container  = modal.prev(),
            slideshows = modal.find('[data-uk-slideshow]');;

        container.on('click', '[href^="#wk-"][data-uk-modal]', function(e) {
            slideshows.each(function(){
                $(this).data('slideshow').show(parseInt($(e.target).closest('a').attr('data-index'), 10));
            });
        });

        modal.on('beforeshow.uk.slideshow', function(e, next) {
            slideshows.not(next.closest('[data-uk-slideshow]')[0]).data('slideshow').show(next.index());
        });

    })(jQuery);
</script>
<?php endif; ?>
<script>
    (function($){

        $('.uk-overlay > img:first', $('#wk-grid<?php echo $settings['id']; ?>')).each(function() {

            var $img = $(this),
                $canvas = $('<canvas class="uk-responsive-width"></canvas>').attr({width:$img.attr('width'), height:$img.attr('height')}),
                img = new Image;

            $img.css('display', 'none').after($canvas);

            img.onload = function(){
                $canvas.remove();
                $img.css('display', '');
            };

            img.src = this.src;
        });

    })(jQuery);
</script>
