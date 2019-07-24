<form method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform">
	<input id="s" type="text" placeholder="<?php esc_attr_e('Search..', 'ronby'); ?>" class="input-styled" name="s" maxlength="100">
	<button class="sea-icon button button-primary submit-button" type="submit"><i class="fas fa-search"></i></button>
</form>