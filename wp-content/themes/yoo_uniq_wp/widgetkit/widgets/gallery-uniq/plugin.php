<?php
/**
* @package   Uniq
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/gallery-uniq',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'gallery-uniq',
        'label' => 'Gallery Uniq',
        'core'  => false,
        'icon'  => 'plugins/widgets/gallery-uniq/widget.svg',
        'view'  => 'plugins/widgets/gallery-uniq/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'fields'=> array(
            array( 'name' => 'badge' ),
            array(
                'type'  => 'text',
                'name'  => 'lightbox_content',
                'label' => 'Lightbox Content'
            )
        ),
        'settings' => array(
            'grid'                  => 'default',
            'gutter'                => 'default',
            'gutter_dynamic'        => '20',
            'gutter_v_dynamic'      => '',
            'tag-list'              => array(),
            'filter'                => 'none',
            'filter_align'          => 'left',
            'filter_all'            => true,
            'columns'               => '1',
            'columns_small'         => 0,
            'columns_medium'        => 0,
            'columns_large'         => 0,
            'columns_xlarge'        => 0,
            'animation'             => 'none',

            'image_width'           => 'auto',
            'image_height'          => 'auto',
            'media_border'          => 'none',
            'image_animation'       => 'scale',
            'excerpt_length'        => 100,

            'content'               => true,
            'title_size'            => 'panel',
            'link'                  => false,
            'link_style'            => 'button',
            'link_icon'             => 'share',
            'link_text'             => 'View',

            'lightbox'              => 'slideshow',
            'lightbox_caption'      => 'content',
            'lightbox_nav_width'    => '70',
            'lightbox_nav_height'   => '70',
            'lightbox_width'        => 'auto',
            'lightbox_height'       => 'auto',
            'lightbox_alt'          => false,
            'lightbox_content'      => '',
            'lightbox_title_size'   => 'panel',
            'lightbox_content_size' => '',
            'lightbox_content_container' => 'default',
            'badge'                 => true,
            'badge_style'           => '',

            'link_target'           => false,
            'class'                 => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {

        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('gallery-uniq.edit', 'plugins/widgets/gallery-uniq/views/edit.php', true);
        }

    )

);
