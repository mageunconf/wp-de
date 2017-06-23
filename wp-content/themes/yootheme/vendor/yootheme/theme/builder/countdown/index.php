<?php

return [

    'name' => 'yootheme/builder-countdown',

    'builder' => 'countdown',

    'inject' => [

        'view' => 'app.view',

    ],

    'render' => function ($element) {
        return $this->view->render('@builder/countdown/template', compact('element'));
    },

    'config' => [

        'title' => 'Countdown',
        'width' => 500,
        'element' => true,
        'mixins' => ['element'],
        'tabs' => [

            [

                'title' => 'Settings',
                'fields' => [

                    'date' => [
                        'label' => 'Date',
                        'type' => 'text',
                        'description' => 'Enter a date for the countdown to expire. Use the <a href="https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/Date/parse#ECMAScript_5_ISO-8601_format_support" target="_blank">ISO 8601 format</a>: <code>YYYY-MM-DDThh:mm:ssTZD</code>, e.g. <code>2017-05-01T22:00:00+00:00</code> (UTC time).',
                        'attrs' => [
                            'lazy' => true,
                        ],
                    ],

                    'gutter' => [
                        'label' => 'Gutter',
                        'type' => 'select',
                        'options' => [
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'Default' => '',
                            'Large' => 'large',
                            'Collapse' => 'collapse',
                        ],
                    ],

                    'show_separator' => [
                        'description' => 'Set a gutter between the numbers and add optional separators.',
                        'type' => 'checkbox',
                        'text' => 'Show Separators',
                    ],

                    'label_days' => [
                        'label' => 'Labels',
                        'attrs' => [
                            'placeholder' => 'Days',
                        ],
                    ],

                    'label_hours' => [
                        'attrs' => [
                            'placeholder' => 'Hours',
                        ],
                    ],

                    'label_minutes' => [
                        'attrs' => [
                            'placeholder' => 'Minutes',
                        ],
                    ],

                    'label_seconds' => [
                        'attrs' => [
                            'placeholder' => 'Seconds',
                        ],
                    ],

                    'show_label' => [
                        'description' => 'Enter labels for the countdown time.',
                        'type' => 'checkbox',
                        'text' => 'Show Labels',
                    ],

                    'label_margin' => [
                        'label' => 'Label Margin',
                        'description' => 'Set the margin between the countdown and the label text.',
                        'type' => 'select',
                        'options' => [
                            'Default' => '',
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'None' => 'remove',
                        ],
                        'show' => 'show_label',
                    ],

                ],

            ],

            [

                'title' => 'General',
                'fields' => [

                    'text_align' => '{text_align}',

                    'text_align_breakpoint' => '{text_align_breakpoint}',

                    'text_align_fallback' => '{text_align_fallback}',

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

            'show_separator' => true,
            'show_label' => true,
            'gutter' => 'small',
            'label_margin' => 'small',

            'margin' => 'default',

        ],

    ],

    'default' => [

        'props' => [
            'date' => null,
        ],

    ],

];
