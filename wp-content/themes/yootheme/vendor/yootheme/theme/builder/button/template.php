<?php

$id    = $element['id'];
$class = $element['class'];
$attrs = $element['attrs'];
$attrs_grid = [];

// Grid
$attrs_grid['class'][] = 'uk-flex-middle';
$attrs_grid['class'][] = $element['fullwidth'] ? 'uk-child-width-1-1' : 'uk-child-width-auto';
$attrs_grid['class'][] = $element['gutter'] ? "uk-grid-{$element['gutter']}" : '';
$attrs_grid['uk-grid'] = true;

// Flex alignment
if (!$element['fullwidth']) {
    if ($element['text_align'] && $element['text_align_breakpoint']) {
        $attrs_grid['class'][] = "uk-flex-{$element['text_align']}@{$element['text_align_breakpoint']}";
        if ($element['text_align_fallback']) {
            $attrs_grid['class'][] = "uk-flex-{$element['text_align_fallback']}";
        }
    } else if ($element['text_align']) {
        $attrs_grid['class'][] = "uk-flex-{$element['text_align']}";
    }
}

?>

<div<?= $this->attrs(compact('id', 'class'), $attrs) ?>>

    <?php if (count($element) > 1) : ?>
    <div<?= $this->attrs($attrs_grid) ?>>
    <?php endif ?>

    <?php foreach ($element as $item) :

        $attrs_button = [];
        $attrs_button['class'][] = 'el-content';

        // Fullwidth
        $attrs_button['class'][] = $element['fullwidth'] ? 'uk-width-1-1' : '';

        // Deprecated
        if ($item['button_style'] == 'muted') {
            $item['button_style'] = 'link-muted';
        }

        // Style
        switch ($item['button_style']) {
            case '':
                break;
            case 'link-muted':
            case 'link-text':
                $attrs_button['class'][] = "uk-{$item['button_style']}";
                break;
            default:
                $attrs_button['class'][] = "uk-button uk-button-{$item['button_style']}";
                $attrs_button['class'][] = $element['button_size'] ? "uk-button-{$element['button_size']}" : '';
        }

        // Link
        $attrs_button['href'] = $item['link'];
        $attrs_button['target'] = $item['link_target'] ? '_blank' : '';
        $attrs_button['title'] = $item['link_title'];
        $attrs_button['uk-scroll'] = strpos($item['link'], '#') === 0;

        ?>

        <?php if (count($element) > 1) : ?>
        <div class="el-item">
        <?php endif ?>

            <a<?= $this->attrs($attrs_button) ?>>

                <?php if ($item['icon']) : ?>

                    <?php if ($item['icon_align'] == 'left') : ?>
                    <span uk-icon="<?= $item['icon'] ?>"></span>
                    <?php endif ?>

                    <span class="uk-text-middle"><?= $item['content'] ?></span>

                    <?php if ($item['icon_align'] == 'right') : ?>
                    <span uk-icon="<?= $item['icon'] ?>"></span>
                    <?php endif ?>

                <?php else : ?>
                <?= $item['content'] ?>
                <?php endif ?>

            </a>

        <?php if (count($element) > 1) : ?>
        </div>
        <?php endif ?>

    <?php endforeach ?>

    <?php if (count($element) > 1) : ?>
    </div>
    <?php endif ?>

</div>
