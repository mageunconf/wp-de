<?php

use YOOtheme\Util\File;

return [

    'name' => 'yootheme/styler',

    'inject' => [

        'view' => 'app.view',
        'styles' => 'app.styles',
        'scripts' => 'app.scripts',
        'locator' => 'app.locator',

    ],

    'routes' => function ($routes) {

        $routes->get('/theme/styles', 'YOOtheme\Theme\StyleController:index');
        $routes->post('/theme/styles', 'YOOtheme\Theme\StyleController:save');

    },

    'events' => [

        'theme.init' => function ($theme) {

            // set defaults
            $theme->merge($this->options['config']['defaults'], true);
        },

        'theme.site' => [function ($theme) {

            // set fonts, deprecated in v1.5
            if ($fonts = $theme->config->get('fonts', [])) {
                $this->styles->add('google-fonts', $this->app->url('//fonts.googleapis.com/css', [
                    'family' => implode('|', array_map(function ($font) {
                        return trim($font['name'], "'").($font['variants'] ? ':'.$font['variants'] : '');
                    }, $fonts)),
                    'subset' => rtrim(implode(',', array_unique(array_map('trim', explode(',', implode(',', array_map(function ($font) {
                        return $font['subsets'];
                    }, $fonts)))))), ',') ?: null
                ]));
            }

            // uikit dev
            if ($theme->customizer->isActive() && $test = $theme->get('uikit_dev')) {

                $this->styles->add('uikit-dev-css', "{$this->path}/tests/tests.css");

                $bodyClass = $theme->get('body_class');
                $theme->set('body_class', $bodyClass->merge(['yo-style-devmode']));

                $this->view['sections']->set('builder', function () use ($test) {
                    return $this->view->render("{$this->path}/tests/index.php", ['test' => is_string($test) && file_exists("{$this->path}/tests/{$test}.html") ? $test : 'index']);
                });
            }

        }, -5],

        'theme.admin' => function ($theme) {

            $this->config->merge([
                'section' => [
                    'route' => $this->app->route('theme/styles'),
                    'worker' => $this->app->url("{$this->path}/app/worker.min.js", ['ver' => $theme->options['version']]),
                    'styles' => array_map(function ($file) {
                        return substr(basename($file, '.less'), 6);
                    }, $this->locator->findAll('@theme/less/theme.*.less')),
                    'update' => filemtime(__FILE__) >= @filemtime("{$theme->path}/css/theme.css"),
                ]
            ], true);

            $this->scripts->add('customizer-styler', "{$this->path}/app/styler.min.js", 'customizer');
        }

    ],

    'config' => [

        'section' => [
            'title' => 'Style',
            'width' => 350,
            'priority' => 11
        ],

        'fields' => [],

        'defaults' => [

            'less' => []

        ]

    ]

];
