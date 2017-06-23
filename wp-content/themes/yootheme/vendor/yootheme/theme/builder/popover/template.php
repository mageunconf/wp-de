<?php

$id    = $element['id'];
$class = $element['class'];
$attrs = $element['attrs'];
$attrs_container = [];
$attrs_image = [];
$attrs_fallback = [];

// Container
$attrs_container['class'][] = 'uk-inline uk-position-z-index';

// Fix stacking context for drops if parallax is enabled
$class[] = $element['animation'] == 'parallax' ? 'uk-position-relative uk-position-z-index' : '';

// Image
if ($element['background_image']) {

    $src = $element['background_image'];

    $attrs_image['alt'] = $element['background_image_alt'];

    if (pathinfo($element['background_image'], PATHINFO_EXTENSION) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }

    if (pathinfo($element['background_image'], PATHINFO_EXTENSION) == 'svg') {
        $element['background_image'] = $this->image($src, array_merge($attrs_image, ['width' => $element['background_image_width'], 'height' => $element['background_image_height']]));
    } elseif ($element['background_image_width'] || $element['background_image_height']) {
        $element['background_image'] = $this->image([$src, 'thumbnail' => [$element['background_image_width'], $element['background_image_height']], 'sizes' => '80%,200%'], $attrs_image);
    } else {
        $element['background_image'] = $this->image($src, $attrs_image);
    }

}

// Fallback
$attrs_fallback['class'][] = 'uk-margin uk-hidden@s';

?>

<div<?= $this->attrs(compact('id', 'class'), $attrs) ?>>
    <div<?= $this->attrs($attrs_container) ?>>

        <?php if ($element['background_image']) : ?>
        <?= $element['background_image'] ?>
        <?php endif ?>

        <div class="uk-visible@s">
        <?php foreach ($element as $item) : ?>
        <?= $this->render('@builder/popover/template-marker', compact('item')) ?>
        <?php endforeach ?>
        </div>

    </div>
    <div<?= $this->attrs($attrs_fallback) ?>>

        <?= $this->render('@builder/popover/template-fallback') ?>

    </div>
</div>
