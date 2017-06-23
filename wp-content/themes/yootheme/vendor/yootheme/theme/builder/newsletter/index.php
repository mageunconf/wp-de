<?php

use YOOtheme\Encryption;

return [

    'name' => 'yootheme/builder-newsletter',

    'builder' => 'newsletter',

    'inject' => [

        'view' => 'app.view',
        'scripts' => 'app.scripts',

    ],

    'main' => function () {

        $this['encryption'] = function () {
            return new Encryption($this->app['secret'], $this->app['csrf']->generate());
        };

    },

    'render' => function ($element) {

        $this->scripts->add('newsletter', '@builder/newsletter/app/newsletter.js', [], ['defer' => true]);

        $settings = array_merge($element['provider'], $element[$element['provider']['name']]);
        $settings = $this->encryption->encrypt($settings);

        $attrs_form = [
            'action' => $this->app->route('theme/newsletter/subscribe'),
        ];

        return $this->view->render('@builder/newsletter/template', compact('element', 'attrs_form', 'settings'));
    },

    'autoload' => [
        'YOOtheme\\Builder\\Newsletter\\' => 'src',
    ],

    'events' => [

        'theme.admin' => function () {
            $this->scripts->add('newsletter-lists', '@builder/newsletter/app/newsletter-lists.min.js', 'customizer-builder');
        }

    ],

    'routes' => function ($route) {

        $providers = [
            'mailchimp' => '\\YOOtheme\\Builder\\Newsletter\\MailChimpProvider',
            'cmonitor' => '\\YOOtheme\\Builder\\Newsletter\\CampaignMonitorProvider',
        ];

        $route->post('theme/newsletter/list', function ($settings, $response) use ($providers) {

            if (!isset($settings['name']) or !$provider = $providers[$settings['name']]) {
                return $response->withJson('Invalid provider', 400);
            }

            $apiKey = $this->theme->config[$settings['name'] . '_api'];

            try {
                $return = (new $provider($apiKey))->lists($settings);
            } catch (Exception $e) {
                return $response->withJson($e->getMessage(), 400);
            }

            return $response->withJson($return);
        });

        $route->post('theme/newsletter/subscribe', function ($email, $first_name = '', $last_name = '', $settings, $response) use ($providers) {

            $settings = $this->encryption->decrypt($settings);

            if (!isset($settings['name']) or !$provider = $providers[$settings['name']]) {
                return $response->withJson('Invalid provider', 400);
            }

            $apiKey = $this->theme->config[$settings['name'] . '_api'];

            try {
                (new $provider($apiKey))->subscribe($email, compact('first_name', 'last_name'), $settings);
            } catch (Exception $e) {
                return $response->withJson($e->getMessage(), 400);
            }

            $return = [
                'successful' => true,
            ];

            if ($settings['after_submit'] === 'redirect') {
                $return['redirect'] = $settings['redirect'];
            } else {
                $return['message'] = $settings['message'];
            }

            return $response->withJson($return);

        }, [
            'csrf' => false,
            'allowed' => true,
        ]);

    },

    'config' => [

        'title' => 'Newsletter',
        'width' => 600,
        'element' => true,
        'mixins' => ['element'],
        'tabs' => [

            [

                'title' => 'Content',
                'fields' => [

                    'layout' => [
                        'label' => 'Layout',
                        'type' => 'select',
                        'options' => [
                            'Grid' => 'grid',
                            'Stacked' => 'stacked',
                            'Stacked (Name fields as grid)' => 'stacked-name',
                        ],
                    ],

                    'show_name' => [
                        'description' => 'Define the layout of the form.',
                        'type' => 'checkbox',
                        'text' => 'Show the name fields',
                    ],

                    'gutter' => [
                        'label' => 'Gutter',
                        'description' => 'Set the gutter for the form fields.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'Default' => '',
                        ],
                    ],

                    'label_description' => [
                        'label' => 'Labels',
                        'type' => 'description',
                    ],

                    'label_first_name' => [
                        'attrs' => [
                            'placeholder' => 'First name'
                        ],
                        'show' => 'show_name',
                    ],

                    'label_last_name' => [
                        'attrs' => [
                            'placeholder' => 'Last name'
                        ],
                        'show' => 'show_name',
                    ],

                    'label_email' => [
                        'attrs' => [
                            'placeholder' => 'Email address'
                        ],
                    ],

                    'label_button' => [
                        'attrs' => [
                            'placeholder' => 'Submit'
                        ],
                    ],

                    'provider.name' => [
                        'label' => 'Provider',
                        'type' => 'select',
                        'options' => [
                            'Mailchimp' => 'mailchimp',
                            'Campaign Monitor' => 'cmonitor',
                        ],
                    ],

                    'mailchimp' => [
                        'label' => 'Mailchimp',
                        'type' => 'newsletter-lists',
                        'provider' => 'mailchimp',
                        'show' => 'provider.name == "mailchimp"',
                    ],

                    'cmonitor' => [
                        'label' => 'Campaign Monitor',
                        'type' => 'newsletter-lists',
                        'provider' => 'cmonitor',
                        'show' => 'provider.name == "cmonitor"',
                    ],

                    'provider.after_submit' => [
                        'label' => 'After Submit',
                        'description' => 'Select whether a message will be shown or the site will be redirected after clicking the subscribe button.',
                        'type' => 'select',
                        'options' => [
                            'Show message' => 'message',
                            'Redirect' => 'redirect',
                        ],
                    ],

                    'provider.message' => [
                        'label' => 'Message',
                        'type' => 'textarea',
                        'description' => 'Message shown to the user after submit.',
                        'attrs' => [
                            'rows' => 4,
                            'lazy' => true,
                        ],
                        'show' => 'provider.after_submit == "message"',
                    ],

                    'provider.redirect' => [
                        'label' => 'Link',
                        'description' => 'Link to redirect to after submit.',
                        'show' => 'provider.after_submit == "redirect"',
                    ],

                ],

            ],

            [

                'title' => 'Settings',
                'fields' => [

                    'form_size' => [
                        'label' => 'Size',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'Small' => 'small',
                            'Default' => '',
                            'Large' => 'large',
                        ],
                    ],

                    'button_mode' => [
                        'label' => 'Button Mode',
                        'description' => 'Select whether a button or a clickable icon inside the email input is shown.',
                        'type' => 'select',
                        'options' => [
                            'Button' => 'button',
                            'Icon' => 'icon',
                        ],
                    ],

                    'button_style' => [
                        'label' => 'Button Style',
                        'description' => 'Set the button style.',
                        'type' => 'select',
                        'options' => [
                            'Default' => 'default',
                            'Primary' => 'primary',
                            'Secondary' => 'secondary',
                            'Danger' => 'danger',
                            'Text' => 'text',
                        ],
                        'show' => 'button_mode == "button"',
                    ],

                    'button_fullwidth' => [
                        'type' => 'checkbox',
                        'text' => 'Full width button',
                        'show' => 'button_mode == "button" && layout != "grid"',
                    ],

                    'button_margin' => [
                        'label' => 'Button Extra Margin',
                        'description' => 'Add extra margin to the button.',
                        'type' => 'select',
                        'default' => '',
                        'options' => [
                            'None' => '',
                            'Small' => 'small',
                            'Medium' => 'default',

                        ],
                        'show' => 'button_mode == "button" && show_name',
                    ],

                    'button_icon' => [
                        'label' => 'Button Icon',
                        'description' => 'Click on the pencil to pick an icon from the SVG gallery.',
                        'type' => 'icon',
                        'show' => 'button_mode == "icon"',
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
                        'description' => 'Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>, <code>.el-input</code>, <code>.el-button</code>',
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

            'layout' => 'grid',
            'show_name' => true,
            'label_first_name' => 'First name',
            'label_last_name' => 'Last name',
            'label_email' => 'Email address',
            'label_button' => 'Subscribe',
            'provider' => [
                'name' => 'mailchimp',
                'after_submit' => 'message',
                'message' => 'You\'ve been subscribed successfully.',
                'redirect' => '',
            ],
            'mailchimp' => [
                'client_id' => '',
                'list_id' => '',
            ],
            'cmonitor' => [
                'client_id' => '',
                'list_id' => '',
            ],

            'button_mode' => 'button',
            'button_style' => 'default',
            'button_icon' => 'mail',
        ],

    ],

];
