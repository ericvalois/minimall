<?php $item_prop = edd_add_schema_microdata() ? ' itemprop="name"' : ''; ?>
<h3<?php echo $item_prop; ?> class="edd_download_title mt2 mb1 h5">
	<a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h3>
