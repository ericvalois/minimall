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
    <?php get_template_part( 'template-parts/footer/hero' ); ?>
    
    <?php get_template_part( 'template-parts/footer/widgets' ); ?>

    <?php get_template_part( 'template-parts/footer/copyright' ); ?>

    <script src="https://unpkg.com/smartphoto@1.0.1/js/smartphoto.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/smartphoto@1.0.1/css/smartphoto.min.css">

    <script>
        window.addEventListener('DOMContentLoaded',function(){
            new SmartPhoto(".js-smartPhoto",{
                resizeStyle: 'fill'
            });
        });
    </script>   

<?php wp_footer(); ?>

</body>
</html>
