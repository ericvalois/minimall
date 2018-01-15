<header class="entry-header col-12 center negative-header max-width-5 ml-auto mr-auto bg-white px2 py2 lg-mb2 lg-px4">

    <h1 class="entry-title mb0">
        <?php 
            if( is_404() ){
                _e('Oops! That page can’t be found.','minimall');
            }
            the_title(); 
        ?>
    </h1>
    
</header><!-- .entry-header -->