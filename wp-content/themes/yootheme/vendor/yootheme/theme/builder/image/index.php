<?php

return [

    'name' => 'yootheme/builder-image',

    'builder' => 'image',

    'inject' => [

        'view' => 'app.view',

    ],

    'render' => function ($element) {

        if (empty($element['image'])) {
            $element['image'] = $this->app->url('@assets/images/element-image-placeholder.png');
        }

        return $this->view->render('@builder/image/template', compact('element'));
    },

    'config' => [

        'title' => 'Image',
        'width' => 500,
        'element' => true,
        'mixins' => ['element'],
        'tabs' => [

            [

                'title' => 'Content',
                'fields' => [

                    'image' => '{image}',

                    'image_dimension' => '{image_dimension}',

                    'image_alt' => [
                        'label' => 'Image Alt',
                        'description' => 'Enter the image\'s alt attribute.',
                    ],

                    'image_border' => [
                        'label' => 'Image Border',
                        'description' => 'Select the image\'s border style.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'None' => '',
                            'Circle' => 'circle',
                            'Rounded' => 'rounded',
                        ],
                    ],

                    'image_box_shadow' => [
                        'label' => 'Image Box Shadow',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'None' => '',
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'Large' => 'large',
                            'X-Large' => 'xlarge',
                        ],
                    ],

                    'image_box_shadow_bottom' => [
                        'description' => 'Select the image\'s box shadow size.',
                        'type' => 'checkbox',
                        'text' => 'Apply additional bottom shadow',
                    ],

                    'link' => '{link}',

                    'link_target' => '{link_target}',

                    'image_hover_box_shadow' => [
                        'label' => 'Image Hover Box Shadow',
                        'description' => 'Select the image\'s box shadow size on hover.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'None' => '',
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'Large' => 'large',
                            'X-Large' => 'xlarge',
                        ],
                        'show' => 'link',
                    ],

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
                        'description' => 'Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>, <code>.el-image</code>, <code>.el-link</code>',
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
