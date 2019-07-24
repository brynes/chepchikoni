<div class="wrap about-wrap">
    <h1><?php printf( esc_attr__( 'Welcome to Redux Framework %s', 'ronby' ), $this->display_version ); ?></h1>

    <div
        class="about-text"><?php printf( esc_attr__( 'Thank you for updating to the latest version! Redux Framework %s is a huge step forward in Redux Development. Look at all that\'s new.', 'ronby' ), $this->display_version ); ?>
	</div>
    <div class="redux-badge"><i
            class="el el-redux"></i><span><?php printf( esc_attr__( 'Version %s', 'ronby' ), ReduxFramework::$_version ); ?></span>
    </div>

    <?php $this->actions(); ?>
    <?php $this->tabs(); ?>

</div>
