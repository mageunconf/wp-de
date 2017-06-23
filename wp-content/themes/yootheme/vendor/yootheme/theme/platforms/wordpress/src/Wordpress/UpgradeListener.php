<?php

namespace YOOtheme\Theme\Wordpress;

use YOOtheme\EventSubscriber;

class UpgradeListener extends EventSubscriber
{
    public $inject = [
        'admin' => 'app.admin',
        'update' => 'app.update',
    ];

    public function onInit($theme)
    {
        if (!$this->admin) {
            return;
        }

        $this->update->register(basename($this->theme->path), 'theme', $this->theme->options['update'], ['key' => $this->theme->get('yootheme_apikey')]);

        add_filter('upgrader_pre_install', function ($return, $package) {

            if (!is_wp_error($return)) {
                $this->move($package);
            }

            return $return;

        }, 10, 2);

        add_filter('upgrader_post_install', function ($return, $package) {

            if (!is_wp_error($return)) {
                $this->move($package, true);
            }

            return $return;

        }, 10, 2);
    }

    public function move($package, $reverse = false)
    {
        global $wp_filesystem;

        $name = isset($package['theme']) ? $package['theme'] : '';
        $content = $wp_filesystem->wp_content_dir();

        if ($name != basename($this->theme->path)) {
            return;
        }

        foreach (['theme.css', 'theme.rtl.css'] as $file) {

            $paths = [
                "{$this->theme->path}/css/{$file}",
                "{$content}/upgrade/{$name}_{$file}",
            ];

            if ($reverse) {
                $paths = array_reverse($paths);
            }

            if ($wp_filesystem->exists($paths[0])) {
                $wp_filesystem->move($paths[0], $paths[1], true);
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'theme.init' => ['onInit', -10]
        ];
    }
}
