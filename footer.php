<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package minimal
 */
?>
    <?php get_template_part( 'template-parts/footer', 'hero' ); ?>
    
    <?php get_template_part( 'template-parts/footer', 'widgets' ); ?>

    <?php get_template_part( 'template-parts/footer', 'copyright' ); ?>

</div><?php //#page  ?>

<?php wp_footer(); ?>

</body>
</html>
