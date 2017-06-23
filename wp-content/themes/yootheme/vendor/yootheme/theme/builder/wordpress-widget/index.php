<?php

$config = [

    'name' => 'yootheme/builder-wordpress-widget',

    'builder' => 'wordpress_widget',

    'inject' => [

        'view' => 'app.view',
        'module' => 'yootheme/wordpress-widgets',

    ],

    'render' => function ($element) {

        global $wp_registered_widgets;

        if (isset($wp_registered_widgets[$element['widget']])) {

            if (!array_filter(wp_get_sidebars_widgets(), function ($position) use ($element) {
                return in_array($element['widget'], $position);
            })) {
                return '';
            }

            $instance = $wp_registered_widgets[$element['widget']];

            $defaults = [
                'name' => '',
                'id' => '',
                'description' => '',
                'class' => '',
                'before_widget' => '<content>',
                'after_widget' => '</content>',
                'before_title' => '<title>',
                'after_title' => '</title>',
                'widget_id' => $instance['id'],
                'widget_name' => $instance['name'],
                'yoo_element' => $element
            ];

            if (isset($instance['callback']) && is_callable($instance['callback'])) {

                call_user_func($instance['callback'], wp_parse_args($instance, $defaults), $instance['params'][0]);

                if ($widget = array_pop($this->module->widgets[$this->module->sidebar])) {
                    $element->title = $widget->title;
                    $element->content = $widget->content;
                    $element->widget = $widget;
                    $element->props = $widget->config->merge($element->props, true);
                }
            }
        }

        return $element->content ? $this->view->render('@builder/wordpress-widget/template', compact('element')) : '';
    },

    'config' => [

        'title' => 'WP Widget',
        'width' => 500,
        'element' => true,
        'mixins' => ['element'],
        'tabs' => [

            [

                'title' => 'Content',
                'fields' => [

                    'widget' => [
                        'label' => 'Widget',
                        'description' => 'Any WordPress widget can be displayed in your custom layout.',
                        'type' => 'select-widget',
                        'default' => '',
                    ],

                ],

            ],

            [

                'title' => 'Settings',
                'fields' => [

                    'style' => [
                        'label' => 'Style',
                        'description' => 'Select one of the boxed card styles or a blank module.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Blank' => '',
                            'Card Default' => 'card-default',
                            'Card Primary' => 'card-primary',
                            'Card Secondary' => 'card-secondary',
                            'Card Hover' => 'card-hover',
                        ],
                    ],

                    'title_style' => [
                        'label' => 'Title Style',
                        'description' => 'Title styles differ in font-size but may also come with a predefined color, size and font.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Primary' => 'heading-primary',
                            'H1' => 'h1',
                            'H2' => 'h2',
                            'H3' => 'h3',
                            'H4' => 'h4',
                            'H5' => 'h5',
                            'H6' => 'h6',
                        ],
                    ],

                    'title_decoration' => [
                        'label' => 'Title Decoration',
                        'description' => 'Decorate the title with a divider, bullet or a line that is vertically centered to the heading.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'None' => '',
                            'Divider' => 'divider',
                            'Bullet' => 'bullet',
                            'Line' => 'line',
                        ],
                    ],

                    'title_color' => [
                        'label' => 'Text Color',
                        'description' => 'Select the text color. If the background option is selected, styles that don\'t apply a background image use the primary color instead.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Muted' => 'muted',
                            'Primary' => 'primary',
                            'Success' => 'success',
                            'Warning' => 'warning',
                            'Danger' => 'danger',
                            'Background' => 'background',
                        ]
                    ],

                    'text_align' => '{text_align_justify}',

                    'text_align_breakpoint' => '{text_align_breakpoint}',

                    'text_align_fallback' => '{text_align_justify_fallback}',

                    'maxwidth' => '{maxwidth}',

                    'maxwidth_align' => '{maxwidth_align}',

                    'list_style' => [
                        'label' => 'List Style',
                        'description' => 'Select the list style.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Divider' => 'divider',
                        ],
                        'show' => '{list_match}',
                    ],

                    'link_style' => [
                        'label' => 'Link Style',
                        'description' => 'Select the link style.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Muted' => 'muted',
                        ],
                        'show' => '{list_match}',
                    ],

                    'menu_style' => [
                        'label' => 'Menu Style',
                        'description' => 'Select the menu style',
                        'type' => 'select',
                        'default' => 'nav',
                        'options' => [
                            'Nav' => 'nav',
                            'Subnav' => 'subnav',
                        ],
                        'show' => '$match(type, "menu")',
                    ],

                    'margin' => '{margin}',

                    'margin_remove_top' => '{margin_remove_top}',

                    'margin_remove_bottom' => '{margin_remove_bottom}',

                    'animation' => '{animation}',

                    'parallax_button' => '{parallax_button}',

                    'visibility' => '{visibility}',

                    'id' => '{id}',

                    'class' => '{class}',

                    'name' => '{name}',

                    'css' => [
                        'label' => 'CSS',
                        'description' => 'Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>, <code>.el-title</code>',
                        'type' => 'editor',
                        'editor' => 'code',
                        'mode' => 'css',
                        'attrs' => [
                            'debounce' => 500
                        ],
                    ],

                ],

            ],

        ],

    ],

];

return defined('WPINC') ? $config : false;
