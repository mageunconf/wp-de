<div class="tm-headerbar-background">
    <div class="tm-headerbar tm-headerbar-default <?php if (!$this['config']->get('fullscreen_container')) echo 'tm-headerbar-container'; ?>">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">

            <?php if ($this['widgets']->count('logo')) : ?>
            <a class="tm-logo uk-hidden-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
            <?php endif; ?>

            <?php if ($this['widgets']->count('logo-small')) : ?>
            <a class="tm-logo-small uk-visible-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
            <?php endif; ?>

            <?php if ($this['widgets']->count('headerbar + search + offcanvas')) : ?>
            <div class="uk-flex uk-flex-middle">

                <?php if ($this['widgets']->count('search')) : ?>
                <div class="uk-hidden-small">
                    <?php echo $this['widgets']->render('search'); ?>
                </div>
                <?php endif; ?>

                <?php if ($this['widgets']->count('headerbar')) : ?>
                    <?php echo $this['widgets']->render('headerbar'); ?>
                <?php endif; ?>

                <?php if ($this['widgets']->count('offcanvas')) : ?>
                    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
                <?php endif; ?>

            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php if ($this['widgets']->count('menu')) : ?>
    <div class="uk-hidden-small">
        <nav class="uk-navbar tm-navbar"
        <?php if ($this['config']->get('fixed_navigation')) echo 'data-uk-sticky'; ?>
        <?php if ($this['config']->get('dropdown_overlay')) echo ' data-uk-dropdown-overlay="{cls: \'tm-dropdown-overlay\'}"'; ?>>
            <div class="uk-flex <?php if (!$this['config']->get('fullscreen_container')) echo 'tm-headerbar-container'; ?>">
            <?php echo $this['widgets']->render('menu'); ?>
            </div>
        </nav>
    </div>
<?php endif; ?>
