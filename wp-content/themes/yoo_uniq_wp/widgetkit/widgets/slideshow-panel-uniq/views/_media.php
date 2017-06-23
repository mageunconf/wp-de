<?php
/**
* @package   Uniq
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// JS Options
$options = array();
$options[] = ($settings['animation'] != 'fade') ? 'animation: \'' . $settings['animation'] . '\'' : '';
$options[] = ($settings['duration'] != '500') ? 'duration: ' . $settings['duration'] : '';
$options[] = ($settings['slices'] != '15') ? 'slices: ' . $settings['slices'] : '';
$options[] = ($settings['autoplay']) ? 'autoplay: true ' : '';
$options[] = ($settings['interval'] != '3000') ? 'autoplayInterval: ' . $settings['interval'] : '';
$options[] = ($settings['autoplay_pause']) ? '' : 'pauseOnHover: false';
if ($settings['kenburns'] && $settings['kenburns_duration']) {
    $kenburns_animation = ($settings['kenburns_animation']) ? ', kenburnsanimations: \'' . $settings['kenburns_animation'] . '\'' : '';
    $options[] = 'kenburns: \'' . $settings['kenburns_duration'] . 's\'' . $kenburns_animation;
}

$options = '{'.implode(',', array_filter($options)).'}';

// Nav
$nav = 'uk-position-bottom uk-margin-bottom';

switch ($settings['nav_align']) {
    case 'left':
        $nav .= ' uk-margin-left';
        break;
    case 'right':
        $nav .= ' uk-margin-right';
        break;
    case 'center':
    case 'justify':
        $nav .= ' uk-margin-left uk-margin-right';
        break;
}

?>

<div class="uk-position-relative" data-uk-slideshow="<?php echo $options; ?>">

    <ul class="uk-slideshow<?php if ($settings['fullscreen']) echo ' uk-slideshow-fullscreen'; ?>">
        <?php foreach ($items as $item) :

                // Media Type
                $attrs  = array('class' => '');
                $width  = $item['media.width'];
                $height = $item['media.height'];

                if ($item->type('media') == 'image') {
                    $attrs['alt'] = strip_tags($item['title']);
                    $width  = ($settings['image_width'] != 'auto') ? $settings['image_width'] : $width;
                    $height = ($settings['image_height'] != 'auto') ? $settings['image_height'] : $height;
                }

                if ($item->type('media') == 'video') {
                    $attrs['class'] = 'uk-responsive-width';
                    $attrs['controls'] = true;
                }

                if ($item->type('media') == 'iframe') {
                    $attrs['class'] = 'uk-responsive-width';
                }

                $attrs['width']  = ($width) ? $width : '';
                $attrs['height'] = ($height) ? $height : '';

                if (($item->type('media') == 'image') && ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto')) {
                    $media = $item->thumbnail('media', $width, $height, $attrs);
                } else {
                    $media = $item->media('media', $attrs);
                }

                $smoothscroll = '';
                if (strpos($item['link'], '#') === 0) $smoothscroll = 'data-uk-smooth-scroll="{offset: 70}"';

        ?>

            <li style="min-height: <?php echo $settings['min_height']; ?>px;">

                <?php if ($item['link'] && $settings['link'] && $settings['link_style'] == 'button-uniq') : ?>
                <a<?php if($link_style) echo ' class="' . $link_style . '"'; ?> href="<?php echo $item->escape('link'); ?>" <?php echo $link_target; ?> <?php echo $smoothscroll; ?>><i class="tm-icon tm-icon-arrow <?php echo $smoothscroll ? 'tm-icon-arrow-down' : ''; ?>"></i></a>
                <?php endif; ?>

                <?php echo $media; ?>

            </li>

        <?php endforeach; ?>
    </ul>

    <?php if (in_array($settings['slidenav'], array('top', 'bottom'))) : ?>
    <div class="uk-position-<?php echo $settings['slidenav'].'-'.$settings['media_align']; ?> uk-margin uk-margin-left uk-margin-right">
        <div class="uk-grid uk-grid-small">
            <div><a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-previous" data-uk-slideshow-item="previous"></a></div>
            <div><a href="#" class="uk-slidenav <?php if ($settings['nav_contrast']) echo 'uk-slidenav-contrast'; ?> uk-slidenav-next" data-uk-slideshow-item="next"></a></div>
        </div>
    </div>
    <?php endif ?>

    <?php if ($settings['nav_overlay'] && ($settings['nav'] != 'none')) : ?>
    <div class="<?php echo $nav; ?>">
        <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_nav.php', compact('items', 'settings')); ?>
    </div>
    <?php endif ?>

</div>
