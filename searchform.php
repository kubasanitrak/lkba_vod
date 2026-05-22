<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="wp-block-search__inside-wrapper">
		<label>
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'lkba_vod' ); ?></span>
			<input type="search" class="search-field wp-block-search__input" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'lkba_vod' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
		</label>
	</div>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'lkba_vod' ); ?>" />
</form>
