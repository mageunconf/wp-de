<?php

$config = [

    'name' => 'yootheme/builder-wordpress-area',

    'builder' => 'wordpress_area',

    'inject' => [

        'view' => 'app.view',

    ],

    'render' => function ($element) {
        return $element['content'] && is_active_sidebar((string) $element['content'])
            ? $this->view->render('@builder/wordpress-area/template', compact('element'))
            : '';
    },

    'config' => [

        'title' => 'WP Area',
        'width' => 500,
        'element' => true,
        'mixins' => ['element'],
        'tabs' => [

            [

                'title' => 'Content',
                'fields' => [

                    'content' => [
                        'label' => 'Widget Area',
                        'description' => 'Select a WordPress widget area that will render all published widgets. It\'s recommended to use the builder-1 to -6 widget areas, which are not rendered elsewhere by the theme.',
                        'type' => 'select-position',
                        'default' => '',
                    ],

                ],

            ],

            [

                'title' => 'Settings',
                'fields' => [

                    'layout' => [
                        'label' => 'Layout',
                        'description' => 'Select whether the modules should be aligned side by side or stacked above each other.',
                        'type' => 'select',
                        'default' => 'sidebar',
                        'options' => [
                            'Stack' => 'stack',
                            'Grid' => 'grid',
                        ],
                    ],

                    'grid_gutter' => [
                        'label' => 'Grid',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'Default' => '',
                            'Large' => 'large',
                            'Collapse' => 'collapse',
                        ],
                    ],

                    'grid_divider' => [
                        'description' => 'Set the grid gutter width and display dividers between grid cells.',
                        'type' => 'checkbox',
                        'text' => 'Display dividers between grid cells',
                    ],

                    'vertical_align' => [
                        'label' => 'Vertical Alignment',
                        'description' => 'Vertically center grid cells.',
                        'type' => 'checkbox',
                        'text' => 'Center',
                    ],

                    'match' => [
                        'label' => 'Panels',
                        'description' => 'Stretch the panel to match the height of the grid cell.',
                        'type' => 'checkbox',
                        'text' => 'Match height',
                        'show' => '!vertical_align',
                    ],

                    'breakpoint' => [
                        'label' => 'Breakpoint',
                        'description' => 'Set the breakpoint from which grid cells will stack.',
                        'type' => 'select',
                        'options' => [
                            'Small (Phone Landscape)' => 's',
                            'Medium (Tablet Landscape)' => 'm',
                            'Large (Desktop)' => 'l',
                            'X-Large (Large Screens)' => 'xl',
                        ],
                    ],

                    'text_align' => '{text_align_justify}',

                    'text_align_breakpoint' => '{text_align_breakpoint}',

                    'text_align_fallback' => '{text_align_justify_fallback}',

                    'maxwidth' => '{maxwidth}',

                    'maxwidth_align' => '{maxwidth_align}',

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
                        'description' => 'Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>',
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

        'defaults' => [

            'layout' => 'stack',
            'breakpoint' => 'm',

        ],

    ],

];

return defined('WPINC') ? $config : false;
