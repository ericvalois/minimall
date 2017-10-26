<?php
/**
 * Template part for displaying creativity content in templates/template-home.php
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php dynamic_sidebar( 'home-template' ); ?>

</article><!-- #post-## -->
