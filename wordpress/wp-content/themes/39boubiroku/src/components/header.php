<?php if (is_home()) : ?>
<header class="fixed inset-x-0 top-1/2 -translate-y-1/2">
    <?php get_template_part('src/components/navigation'); ?>
</header>
<?php else : ?>
<header>
    <?php get_template_part('src/components/navigation'); ?>
</header>
<?php endif; ?>
