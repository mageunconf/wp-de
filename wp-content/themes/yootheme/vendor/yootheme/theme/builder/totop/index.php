<?php

return [

    'name' => 'yootheme/builder-totop',

    'builder' => 'totop',

    'inject' => [

        'view' => 'app.view',

    ],

    'render' => function ($element) {
        return $this->view->render('@builder/totop/template', compact('element'));
    },

    'config' => [

        'title' => 'To Top',
        'width' => 500,
        'element' => true,
        'mixins' => ['element'],
        'tabs' => [

            [

                'title' => 'Content',
                'fields' => [

                    'link_title' => '{link_title}',

                ],

            ],

            [

                'title' => 'Settings',
                'fields' => [

                    'text_align' => '{text_align}',

                    'text_align_breakpoint' => '{text_align_breakpoint}',

                    'text_align_fallback' => '{text_align_fallback}',

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

            'margin' => 'default',

        ],

    ],

];
