<?php

const REGEX_VIMEO = '#(?:player\.)?vimeo\.com(?:/video)?/(\d+)#i';
const REGEX_YOUTUBE = '#(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})#i';

return [

    'name' => 'yootheme/builder-video',

    'builder' => 'video',

    'inject' => [

        'view' => 'app.view',

    ],

    'render' => function ($element) {

        if (empty($element['video'])) {
            $element['video_poster'] = $this->app->url('@assets/images/element-video-placeholder.png');
        }

        $element['video_params'] = [
            'loop' => $element->get('video_loop', false),
            'autoplay' => $element->get('video_autoplay', false),
            'controls' => 1
        ];

        return $this->view->render('@builder/video/template', compact('element'));
    },

    'config' => [

        'title' => 'Video',
        'width' => 500,
        'element' => true,
        'mixins' => ['element'],
        'tabs' => [

            [

                'title' => 'Content',
                'fields' => [

                    'video' => [
                        'label' => 'Video',
                        'description' => 'Select a video file or enter a link from <a href="https://www.youtube.com" target="_blank">YouTube</a> or <a href="https://vimeo.com" target="_blank">Vimeo</a>.',
                        'type' => 'video',
                    ],

                    'video_loop' => [
                        'type' => 'checkbox',
                        'text' => 'Loop video',
                    ],

                    'video_autoplay' => [
                        'type' => 'checkbox',
                        'text' => 'Enable autoplay',
                    ],

                    'video_dimension' => [

                        'type' => 'grid',
                        'description' => 'Set the video dimensions.',
                        'fields' => [

                            'video_width' => [
                                'label' => 'Width',
                                'default' => '',
                                'width' => '1-2',
                             ],

                            'video_height' => [
                                'label' => 'Height',
                                'default' => '',
                                'width' => '1-2',
                            ],

                        ],

                    ],

                    'video_poster' => [
                        'label' => 'Poster Frame',
                        'description' => 'Select an optional image which shows up until the video plays. If not selected the first video frame is shown as the poster frame.',
                        'type' => 'image',
                        'show' => 'video && !$match(video, "(youtube\.com|vimeo\.com)", "i")'
                    ],

                    'video_box_shadow' => [
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

                    'video_box_shadow_bottom' => [
                        'description' => 'Select the video\'s box shadow size.',
                        'type' => 'checkbox',
                        'text' => 'Apply additional bottom shadow',
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
