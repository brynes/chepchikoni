<?php
// **********************************************************************// 
// ! One Click Demo Content Import
// **********************************************************************// 
function ronby_oneclick_import_files() {
  return array(
    array(
      'import_file_name'             => 'Fitness Demo',
      'categories'                   => array( 'Fitness' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo1/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo1/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo1/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/fitness.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo1.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/fitness-demo/',
    ),
	array(
      'import_file_name'             => 'Restaurant Demo',
      'categories'                   => array( 'Restaurant' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo2/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo2/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo2/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/restaurant.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo2.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/restaurant-demo/',
    ),
	array(
      'import_file_name'             => 'Business Demo',
      'categories'                   => array( 'Business', 'Agency' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo3/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo3/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo3/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/business.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo3.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/business-demo/',
    ),
	array(
      'import_file_name'             => 'Construction Demo',
      'categories'                   => array( 'Construction' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo4/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo4/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo4/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/constructions.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo4.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/construction-demo/',
    ),
	array(
      'import_file_name'             => 'Fashion Demo',
      'categories'                   => array( 'Fashion', 'Shop' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo5/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo5/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo5/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/shop.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo5.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/fashion-demo/',
    ),
	array(
      'import_file_name'             => 'Medical Demo',
      'categories'                   => array( 'Medical' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo6/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo6/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo6/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/medical.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo6.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/medical-demo/',
    ),
	array(
      'import_file_name'             => 'Yoga Demo',
      'categories'                   => array( 'Fitness' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo7/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo7/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo7/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/yoga.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo7.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/yoga-demo/',
    ),
	array(
      'import_file_name'             => 'Restaurant V2',
      'categories'                   => array( 'Restaurant' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo8/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo8/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo8/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/restaurantv2.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo8.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/restaurant-demo-v2/',
    ),
	array(
      'import_file_name'             => 'Restaurant V3',
      'categories'                   => array( 'Restaurant' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo9/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo9/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo9/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/restaurantv3.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo9.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/restaurant-demo-v3/',
    ),
	array(
      'import_file_name'             => 'Medical V2',
      'categories'                   => array( 'Medical' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo10/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo10/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo10/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/medicalv2.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo10.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/medical-demo-v2/',
    ),
	array(
      'import_file_name'             => 'Construction V2',
      'categories'                   => array( 'Construction' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo11/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo11/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo11/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/constructionv2.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo11.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/construction-demo-v2/',
    ),
	array(
      'import_file_name'             => 'Fashion V2',
      'categories'                   => array( 'Fashion' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo12/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo12/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo12/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/fashionv2.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo12.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/fashion-demo-v2/',
    ),
	array(
      'import_file_name'             => 'RTL V1',
      'categories'                   => array( 'Fitness', 'RTL' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo13/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo13/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo13/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/rtl.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo13.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/rtl-demo/',
    ),
	array(
      'import_file_name'             => 'RTL V2',
      'categories'                   => array( 'Restaurant', 'RTL' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo14/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo14/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo14/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/rtlv2.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo14.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/rtl-demo-v2/',
    ),
	array(
      'import_file_name'             => 'Fitness V3',
      'categories'                   => array( 'Fitness' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo15/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo15/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo15/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/fitnessv3.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo15.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/',
    ),
	array(
      'import_file_name'             => 'Agency Demo',
      'categories'                   => array( 'Business', 'Agency' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo16/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo16/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo16/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/businessv2.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo16.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/business-demo-v2/',
    ),
	array(
      'import_file_name'             => 'Technology Demo',
      'categories'                   => array( 'Business', 'Technology', 'Shop' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo17/demo-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo17/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demo-content/demo17/customizer.dat',
      'import_preview_image_url'     => esc_url( get_template_directory_uri() ).'/images/preview/businessv3.jpg',
      'import_notice'                => esc_html__( 'After you import this demo, you will have to import theme-options data separately. Get the Theme-Options Data ', 'ronby'). '<a style="font-weight:bold;" target="_blank" href="https://flbaisha.com/wp/ronby-demo-content/theme-options/theme-options-demo17.html">'.esc_html__('From Here', 'ronby').'</a>' . esc_html__( '. Then Copay and Save the data in your PC and you will be able to use that saved data later to import theme-options separately.', 'ronby'),
      'preview_url'                  => 'https://flbaisha.com/wp/ronby/business-demo-v3/',
    ),
  );
}
add_filter( 'pt-ocdc/import_files', 'ronby_oneclick_import_files' );

function ronby_oneclick_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Header Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'ronby_primary_menu' => $main_menu->term_id
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdc/after_import', 'ronby_oneclick_after_import_setup' );