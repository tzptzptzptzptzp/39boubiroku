<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/styles/tailwind.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="wrapper">
        <?php get_template_part('src/components/header'); ?>
