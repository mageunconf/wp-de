<?php

return [

    'name' => 'yootheme/builder-table',

    'builder' => 'table',

    'inject' => [

        'view' => 'app.view',

    ],

    'render' => function ($element) {
        return $this->view->render('@builder/table/template', compact('element'));
    },

    'config' => [

        'title' => 'Table',
        'width' => 500,
        'element' => true,
        'mixins' => ['element', 'container'],
        'tabs' => [

            [

                'title' => 'Content',
                'fields' => [

                    'content' => [
                        'label' => 'Items',
                        'type' => 'content-items',
                        'item' => 'table_item',
                    ],

                    'show_title' => [
                        'label' => 'Display',
                        'type' => 'checkbox',
                        'text' => 'Show the title',
                    ],

                    'show_meta' => [
                        'type' => 'checkbox',
                        'text' => 'Show the meta text',
                    ],

                    'show_content' => [
                        'type' => 'checkbox',
                        'text' => 'Show the content',
                    ],

                    'show_image' => [
                        'type' => 'checkbox',
                        'text' => 'Show the image',
                    ],

                    'show_link' => [
                        'description' => 'Show or hide content fields without the need to delete the content itself.',
                        'type' => 'checkbox',
                        'text' => 'Show the link',
                    ],

                ],

            ],

            [

                'title' => 'Basic',
                'fields' => [

                    'table_style' => [
                        'label' => 'Style',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Divider' => 'divider',
                            'Striped' => 'striped',
                        ],
                    ],

                    'table_hover' => [
                        'type' => 'checkbox',
                        'text' => 'Highlight the hovered row',
                    ],

                    'table_justify' => [
                        'description' => 'Select the table style.',
                        'type' => 'checkbox',
                        'text' => 'Remove the outer padding of the first and last column',
                    ],

                    'table_size' => [
                        'label' => 'Size',
                        'description' => 'Define the padding between table rows.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Small' => 'small',
                        ],
                    ],

                    'table_order' => [
                        'label' => 'Order',
                        'description' => 'Define the order of the table cells.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Meta, Image, Title, Content, Link' => '1',
                            'Title, Image, Meta, Content, Link' => '2',
                            'Image, Title, Content, Meta, Link' => '3',
                            'Image, Title, Meta, Content, Link' => '4',
                            'Title, Meta, Content, Link, Image' => '5',
                            'Meta, Title, Content, Link, Image' => '6',
                        ],
                    ],

                    'table_vertical_align' => [
                        'label' => 'Vertical Alignment',
                        'description' => 'Vertically center table cells.',
                        'type' => 'checkbox',
                        'text' => 'Center',
                    ],

                    'table_responsive' => [
                        'label' => 'Responsive',
                        'description' => 'Stack columns on small devices or enable overflow scroll for the container.',
                        'type' => 'select',
                        'options' => [
                            'Scroll overflow' => 'overflow',
                            'Stacked' => 'responsive',
                        ],
                    ],

                    'table_last_align' => [
                        'label' => 'Last Column Alignment',
                        'description' => 'Define the alignment of the last table column.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Inherit' => '',
                            'Left' => 'left',
                            'Center' => 'center',
                            'Right' => 'right',
                        ],
                    ],

                    'table_width_title' => [
                        'label' => 'Title Width',
                        'description' => 'Define the width of the title cell.',
                        'type' => 'select',
                        'options' => [
                            'Expand' => '',
                            'Shrink' => 'shrink',
                            'Small' => 'small',
                            'Medium' => 'medium',
                        ],
                        'show' => 'show_title',
                    ],

                    'table_width_meta' => [
                        'label' => 'Meta Width',
                        'description' => 'Define the width of the meta cell.',
                        'type' => 'select',
                        'options' => [
                            'Expand' => '',
                            'Shrink' => 'shrink',
                            'Small' => 'small',
                            'Medium' => 'medium',
                        ],
                        'show' => 'show_meta',
                    ],

                    'table_width_content' => [
                        'label' => 'Content Width',
                        'description' => 'Define the width of the content cell.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Expand' => '',
                            'Shrink' => 'shrink',
                            'Small' => 'small',
                            'Medium' => 'medium',
                        ],
                        'show' => 'show_content',
                    ],

                    'table_head_label' => [
                        'label' => 'Table Head',
                        'type' => 'description',
                    ],

                    'table_head_title' => [
                        'attrs' => [
                            'placeholder' => 'Title',
                        ],
                        'show' => 'show_title',
                    ],

                    'table_head_meta' => [
                        'attrs' => [
                            'placeholder' => 'Meta',
                        ],
                        'show' => 'show_meta',
                    ],

                    'table_head_content' => [
                        'attrs' => [
                            'placeholder' => 'Content',
                        ],
                        'show' => 'show_content',
                    ],

                    'table_head_image' => [
                        'attrs' => [
                            'placeholder' => 'Image',
                        ],
                        'show' => 'show_image',
                    ],

                    'table_head_link' => [
                        'attrs' => [
                            'placeholder' => 'Link',
                        ],
                        'show' => 'show_link',
                    ],

                    'table_head_description' => [
                        'description' => 'Enter a table header text for each column.',
                        'type' => 'description',
                    ],

                ],

            ],

            [

                'title' => 'Advanced',
                'fields' => [

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
                        'show' => 'show_title',
                    ],

                    'title_color' => [
                        'label' => 'Title Color',
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
                        ],
                        'show' => 'show_title',
                    ],

                    'meta_style' => [
                        'label' => 'Meta Style',
                        'description' => 'Select a predefined meta text style, including color, size and font-family.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Meta' => 'meta',
                            'Muted' => 'muted',
                            'Primary' => 'primary',
                            'H4' => 'h4',
                            'H5' => 'h5',
                            'H6' => 'h6',
                        ],
                        'show' => 'show_meta',
                    ],

                    'content_style' => [
                        'label' => 'Content Style',
                        'description' => 'Select a predefined text style, including color, size and font-family.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Default' => '',
                            'Lead' => 'lead',
                            'Meta' => 'meta',
                        ],
                        'show' => 'show_content',
                    ],

                    'image_dimension' => [

                        'type' => 'grid',
                        'description' => 'Setting just one value preserves the original proportions. The image will be resized and cropped automatically and where possible, high resolution images will be auto-generated.',
                        'fields' => [

                            'image_width' => [
                                'label' => 'Image Width',
                                'width' => '1-2',
                                'attrs' => [
                                    'placeholder' => 'auto',
                                    'lazy' => true,
                                ],
                            ],

                            'image_height' => [
                                'label' => 'Image Height',
                                'width' => '1-2',
                                'attrs' => [
                                    'placeholder' => 'auto',
                                    'lazy' => true,
                                ],
                            ],

                        ],
                        'show' => 'show_image',

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
                        'show' => 'show_image',
                    ],

                    'image_box_shadow' => [
                        'label' => 'Image Box Shadow',
                        'description' => 'Select the image\'s box shadow size.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'None' => '',
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'Large' => 'large',
                            'X-Large' => 'xlarge',
                        ],
                        'show' => 'show_image',
                    ],

                    'link_text' => [
                        'label' => 'Link Text',
                        'description' => 'Enter the text for the link.',
                        'show' => 'show_link',
                    ],

                    'link_target' => [
                        'type' => 'checkbox',
                        'text' => 'Open the link in a new window',
                        'show' => 'show_link',
                    ],

                    'link_style' => [
                        'label' => 'Link Style',
                        'description' => 'Set the link style.',
                        'type' => 'select',
                        'options' => [
                            'Link' => '',
                            'Link Muted' => 'link-muted',
                            'Link Text' => 'link-text',
                            'Button Default' => 'default',
                            'Button Primary' => 'primary',
                            'Button Secondary' => 'secondary',
                            'Button Danger' => 'danger',
                            'Button Text' => 'text',
                        ],
                        'show' => 'show_link',
                    ],

                    'link_size' => [
                        'label' => 'Button Size',
                        'description' => 'Set the button size.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Small' => 'small',
                            'Default' => '',
                            'Large' => 'large',
                        ],
                        'show' => 'show_link && link_style && link_style != "link-muted" && link_style != "link-text"',
                    ],

                ],

            ],

            [

                'title' => 'General',
                'fields' => [

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
                        'description' => 'Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>, <code>.el-item</code>, <code>.el-title</code>, <code>.el-meta</code>, <code>.el-content</code>, <code>.el-image</code>, <code>.el-link</code>',
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

            'show_title' => true,
            'show_meta' => true,
            'show_content' => true,
            'show_image' => true,
            'show_link' => true,

            'table_order' => '1',
            'table_responsive' => 'overflow',
            'table_width_title' => 'shrink',
            'table_width_meta' => 'shrink',

            'meta_style' => 'meta',
            'link_text' => 'Read more',
            'link_style' => 'default',

        ],

    ],

    'default' => [

        'children' => array_fill(0, 3, [
            'type' => 'table_item',
        ]),

    ],

    'include' => [

        'yootheme/builder-table-item' => [

            'builder' => 'table_item',

            'config' => [

                'title' => 'Item',
                'width' => 600,
                'mixins' => ['element', 'item'],
                'fields' => [

                    'title' => [
                        'label' => 'Title',
                    ],

                    'meta' => [
                        'label' => 'Meta',
                    ],

                    'content' => [
                        'label' => 'Content',
                        'type' => 'editor',
                    ],

                    'image' => '{image}',

                    'image_alt' => [
                        'label' => 'Image Alt',
                        'show' => 'image',
                    ],

                    'link' => '{link}',

                    'link_text' => [
                        'label' => 'Alternative Link Text',
                        'show' => 'link',
                    ],

                ],

            ],

            'default' => [

                'props' => [
                    'content' => 'Lorem ipsum dolor sit amet.',
                    'title' => 'Item',
                ],

            ],

        ],

    ],

];
