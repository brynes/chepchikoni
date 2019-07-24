<?php
/*-----------------------------------------------------------------------------------*/
/* Creating Shortcodes in order to use in the WPBakery Page builder plugin */
/*-----------------------------------------------------------------------------------*/

/*START FROM HERE ELEMENTS FUNCTIONS*/

/*****************************
BMI-Weight Calculator Section
******************************/
//Function for BMI-Weight Calculator Section
function ronby_bmi_weight_calculator_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'heading3' => '',
	'animated_headline' => '',
	'heading2_anim1' => '',
	'heading2_anim2' => '',
	'heading2_anim3' => '',
	'heading2_anim4' => '',
	'heading2_anim5' => '',
	'overlay_color' => '',
	'heading3_link' => '',
	'calculator_box_bg_color' => '',
	), $atts ) );			
	$gallery = shortcode_atts(
    array(
        'image'      =>  'image',
    ), $atts );	
	$image_ids = explode(',',$gallery['image']);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}
	$output = '<div class="clac-slider page-header-3 row-xtra-space" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).');background-size:cover;background-position:center top;background-attachment:fixed;"';}$output.='>
			<div class="overlay" ';if($overlay_color){$output.='style="background-color:'.esc_attr($overlay_color).';"';}$output.='>
				<!-- Page header -->
				<div class="container">
					<div class="row align-items-center">
						<div class="col-12 col-md-auto flex-grow-1 flex-shrink-1">
							<div class="page-header-3">
								<div class="overlay">
								<div class="container">
									<div class="inner-content';if($animated_headline=='yes'){ $output.=' animhead';} $output.='">
										';if($heading1){$output.='
										<h2>'.esc_attr($heading1).'</h2>
										';}$output.='
										';if($heading2){$output.='
										';if($animated_headline=='yes'){ $output.='
										<h1 class="page-header-title cd-headline clip is-full-width">
											<span>'.esc_attr($heading2).'</span>
											<span class="cd-words-wrapper">
												';if($heading2_anim1){ $output.='
												<b class="is-visible">'.esc_attr($heading2_anim1).'</b>
												';} if($heading2_anim2){$output.='
												<b>'.esc_attr($heading2_anim2).'</b>
												';} if($heading2_anim3){$output.='
												<b>'.esc_attr($heading2_anim3).'</b>
												';} if($heading2_anim4){$output.='
												<b>'.esc_attr($heading2_anim4).'</b>
												';} if($heading2_anim5){$output.='
												<b>'.esc_attr($heading2_anim5).'</b>
												';} $output.='
											</span>
										</h1>
										';} else { $output.='
										<h1 class="page-header-title">'.esc_attr($heading2).'</h1>
										';} } if($heading3){
										if($animated_headline=='yes'){ $output.='
										<a href="'.esc_url($heading3_link).'" class="button button-primary rounded-capsule">'.esc_attr($heading3).'</a>
										';} else { $output.='
										<div class="page-header-breadcrumb">
											<a href="'.esc_url($heading3_link).'" class="animate-300 hover-color-primary">'.esc_attr($heading3).'</a>
										</div>
										';} $output.='
										';} $output.='
									</div>
								</div>											
								</div>											
							</div>											
						</div>
						<div class="col-auto">
							<div class="calculator-box color-inverse" ';if($calculator_box_bg_color){$output.='style="background-color:'.esc_attr($calculator_box_bg_color).';"';}$output.='>
								<div class="icon" ';if($calculator_box_bg_color){$output.='style="background-color:'.esc_attr($calculator_box_bg_color).';"';}$output.='>
									<i class="flaticon-calculator"></i>
								</div>
								<div class="box-header">
									<div class="box-subtitle">'.esc_attr__('Advanced Calculator','ronby').'</div>
									<div class="box-title">'.esc_attr__('Calculate Your','ronby').'</div>
								</div>
								<div class="box-content">
									<div class="tabs-filter">
										<div class="tabs text-center mb-4">
											<span class="tab active" data-tab="bmi">'.esc_attr('Bmi').'</span>
											<span class="tab" data-tab="weight">'.esc_attr('Weight').'</span>
										</div>
										<div class="">
										<form class="bmi" method="POST">
											<div class="content-tab active" data-tab="bmi">
												<div class="form-group">
													<label for="feet" class="form-label">'.esc_attr('Your height').'</label>
													<div class="row gutter-5">
														<div class="col">
															<input class="input-styled" type="text" placeholder="Feet" id="feet" required>
														</div>
														<div class="col">
															<input class="input-styled" type="text" placeholder="Inch" id="inch" required>
														</div>								</div>
												</div>
												<div class="form-group">
													<label for="weight" class="form-label">'.esc_attr('Your weight').'</label>
													<input class="input-styled" type="text" placeholder="kg" id="weight" required>
												</div>
												<div class="form-group mt-3">
													<label class="custom-radio d-inline-flex mr-4">
														<input class="input-styled" type="radio" name="gender" value="female" required>
														<span class="checkmark"></span> '.esc_attr('Female').'
													</label>
													<label class="custom-radio d-inline-flex">
														<input class="input-styled" type="radio" name="gender" value="male" required>
														<span class="checkmark"></span> '.esc_attr('Male').'
													</label>
												</div>
												<div class="mt-4">
													<button class="button background-black color-white button-block rounded-capsule" type="submit">
														'.esc_attr('Compute BMI').'
													</button>
												</div>
								
												<div class="bmi_result"></div>
												
											</div>
											</form>
											<form class="weight-form" method="POST">
											<div class="content-tab" data-tab="weight">
												<div class="form-group">
													<label for="feet2" class="form-label">'.esc_attr('Your height').'</label>
													<div class="row gutter-5">
														<div class="col">
															<input class="input-styled" type="text" placeholder="Feet" id="feet2" required>
														</div>
														<div class="col">
															<input class="input-styled" type="text" placeholder="Inches" id="inch2" required>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="weight2" class="form-label">'.esc_attr('Your weight').'</label>
													<input class="input-styled" type="text" placeholder="Kg" id="weight2">
												</div>
												<div class="form-group mt-3">
													<label class="custom-radio d-inline-flex mr-4">
														<input class="input-styled gender2" type="radio" name="gender2" value="female" required>
														<span class="checkmark" ></span> '.esc_attr('Female').'
													</label>
													<label class="custom-radio d-inline-flex">
														<input class="input-styled gender2" type="radio" name="gender2" value="male" required>
														<span class="checkmark"></span> '.esc_attr('Male').'
													</label>
												</div>
												<div class="mt-4">
													<button class="button background-black color-white button-block rounded-capsule" type="submit">
														'.esc_attr('Compute Weight').'
													</button>
												</div>
																															
												<div class="weight_result"></div>
												
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Page header -->
			</div>
		
		</div>';
		
//Calculate BMI Functions starts from here	
echo"<script>
jQuery(document).ready(function(){
jQuery('form.bmi').submit(function(e){
	e.preventDefault();	
	var resultDiv = jQuery('.bmi_result');
	function calcBMI(){
	var feet= jQuery('#feet').val();
	var inch= jQuery('#inch').val();
	var feet_to_inch= feet*12;
	var total= parseInt(feet_to_inch, 10) + parseInt(inch, 10);
	var total_to_meter = total/39.3701;
	var weight= jQuery('#weight').val();
	var bmi= weight / (total_to_meter*total_to_meter);
	return bmi.toFixed(2);
	}
	function bmiState(){
		if(calcBMI() < 18.5 ){
			return 'Underweight';
		}
		if(calcBMI() > 18.5 && calcBMI() < 24.9 ){
			return 'Normal weight';
		}

		if(calcBMI() > 25 && calcBMI() < 29.9 ){
			return 'Overweight';
		}
		if(calcBMI() > 30 && calcBMI() < 34.9 ){
			return 'Overweight class 1';
		}
		if(calcBMI() > 35 && calcBMI() < 39.9 ){
			return 'Overweight class 2';
		}
		if(calcBMI() > 40){
			return 'Overweight class 3';
		}
	}
	jQuery('.bmi_result').addClass('mt-4');
		resultDiv.html('Your Body Mass Index is '+ calcBMI() + '. This is considered <b>' + bmiState() + '</b>');	
});

jQuery( '.gender2' ).on( 'click', function() {
jQuery('.gender2').removeAttr( 'checked', 'checked' );
jQuery(this).attr( 'checked', 'checked' );
});
	
jQuery('form.weight-form').submit(function(e){
	e.preventDefault();	

	var resultDiv2 = jQuery('.weight_result');
	function calcWEIGHT(){
	var feet2= jQuery('#feet2').val();
	var inch2= jQuery('#inch2').val();
	var feet_to_inch2= feet2*12;
	var total_inch2= parseInt(feet_to_inch2, 10) + parseInt(inch2, 10);
	var total_inch_to_cm2 = total_inch2*2.54;
	return total_inch_to_cm2.toFixed(0);
	}
    var selValue = jQuery('input[name=gender2]:checked').val();
	if(selValue == 'male') {
	function weightState(){
		if(calcWEIGHT() < 137 ){
			return 'This calculator for Adults Only';
		}
		if(calcWEIGHT() == 137 ){
			return 'Your weight should be 28.5 - 34.9kg';
		}		
		if(calcWEIGHT() == 140 ){
			return 'Your weight should be 30.8 - 38.1kg';
		}
		if(calcWEIGHT() == 142 ){
			return 'Your weight should be 33.5 - 40.8kg';
		}
		if(calcWEIGHT() == 145 ){
			return 'Your weight should be 35.8 - 43.9kg';
		}
		if(calcWEIGHT() == 147 ){
			return 'Your weight should be 38.5 - 46.7kg';
		}
		if(calcWEIGHT() == 150 ){
			return 'Your weight should be 40.8 - 49.9kg';
		}
		if(calcWEIGHT() == 152 ){
			return 'Your weight should be 28.5 - 34.9kg';
		}
		if(calcWEIGHT() == 155 ){
			return 'Your weight should be 45.8 - 55.8kg';
		}
		if(calcWEIGHT() == 157 ){
			return 'Your weight should be 48.1 - 58.9kg';
		}
		if(calcWEIGHT() == 160 ){
			return 'Your weight should be 50.8 - 61.6kg';
		}
		if(calcWEIGHT() == 163 ){
			return 'Your weight should be 53 - 64.8g';
		}
		if(calcWEIGHT() == 165 ){
			return 'Your weight should be 55.3 - 68kg';
		}	
		if(calcWEIGHT() == 168 ){
			return 'Your weight should be 58 - 70.7kg';
		}	
		if(calcWEIGHT() == 170 ){
			return 'Your weight should be 60.3 - 73.9kg';
		}
		if(calcWEIGHT() == 173 ){
			return 'Your weight should be 63 - 76.6kg';
		}
		if(calcWEIGHT() == 175 ){
			return 'Your weight should be 65.3 - 79.8kg';
		}	
		if(calcWEIGHT() == 178 ){
			return 'Your weight should be 67.6 - 83kg';
		}
		if(calcWEIGHT() == 180 ){
			return 'Your weight should be 70.3 - 85.7kg';
		}	
		if(calcWEIGHT() == 183 ){
			return 'Your weight should be 72.6 - 88.9kg';
		}	
		if(calcWEIGHT() == 185 ){
			return 'Your weight should be 75.3 - 91.6kg';
		}			
		if(calcWEIGHT() == 188 ){
			return 'Your weight should be 77.5 - 94.8kg';
		}		
		if(calcWEIGHT() == 191 ){
			return 'Your weight should be 79.8 - 98kg';
		}	
		if(calcWEIGHT() == 193 ){
			return 'Your weight should be 82.5 - 100.6kg';
		}
		if(calcWEIGHT() == 195 ){
			return 'Your weight should be 84.8 - 103.8kg';
		}
		if(calcWEIGHT() == 198 ){
			return 'Your weight should be 87.5 - 106.5kg';
		}	
		if(calcWEIGHT() == 201 ){
			return 'Your weight should be 89.8 - 109.7kg';
		}	
		if(calcWEIGHT() == 203 ){
			return 'Your weight should be 92 - 112.9kg';
		}	
		if(calcWEIGHT() == 205 ){
			return 'Your weight should be 94.8 - 115.6kg';
		}	
		if(calcWEIGHT() == 208 ){
			return 'Your weight should be 97 - 118.8kg';
		}	
		if(calcWEIGHT() == 210 ){
			return 'Your weight should be 99.8 - 121.5kg';
		}
		if(calcWEIGHT() == 213 ){
			return 'Your weight should be 102 - 124.7kg';
		}		
	}
	jQuery('.weight_result').addClass('mt-4');	
	resultDiv2.html(weightState());	
	}else{
	function weightState(){
		if(calcWEIGHT() < 137 ){
			return 'This calculator for Adults Only';
		}
		if(calcWEIGHT() == 137 ){
			return 'Your weight should be 28.5 - 34.9kg';
		}		
		if(calcWEIGHT() == 140 ){
			return 'Your weight should be 30.8 - 37.6kg';
		}
		if(calcWEIGHT() == 142 ){
			return 'Your weight should be 32.6 - 39.9kg';
		}
		if(calcWEIGHT() == 145 ){
			return 'Your weight should be 34.9 - 42.6kg';
		}
		if(calcWEIGHT() == 147 ){
			return 'Your weight should be 36.4 - 44.9kg';
		}
		if(calcWEIGHT() == 150 ){
			return 'Your weight should be 39 - 47.6kg';
		}
		if(calcWEIGHT() == 152 ){
			return 'Your weight should be 40.8 - 49.9kg';
		}
		if(calcWEIGHT() == 155 ){
			return 'Your weight should be 43.1 - 52.6kg';
		}
		if(calcWEIGHT() == 157 ){
			return 'Your weight should be 44.9 - 54.9kg';
		}
		if(calcWEIGHT() == 160 ){
			return 'Your weight should be 47.2 - 57.6kg';
		}
		if(calcWEIGHT() == 163 ){
			return 'Your weight should be 49 - 59.9g';
		}
		if(calcWEIGHT() == 165 ){
			return 'Your weight should be 55.3 - 68kg';
		}	
		if(calcWEIGHT() == 168 ){
			return 'Your weight should be 51.2 - 62.6kg';
		}	
		if(calcWEIGHT() == 170 ){
			return 'Your weight should be 55.3 - 67.6kg';
		}
		if(calcWEIGHT() == 173 ){
			return 'Your weight should be 57.1 - 69.8kg';
		}
		if(calcWEIGHT() == 175 ){
			return 'Your weight should be 59.4 - 72.6kg';
		}	
		if(calcWEIGHT() == 178 ){
			return 'Your weight should be 61.2 - 74.8kg';
		}
		if(calcWEIGHT() == 180 ){
			return 'Your weight should be 63.5 - 77.5kg';
		}	
		if(calcWEIGHT() == 183 ){
			return 'Your weight should be 65.3 - 79.8kg';
		}	
		if(calcWEIGHT() == 185 ){
			return 'Your weight should be 67.6 - 82.5kg';
		}			
		if(calcWEIGHT() == 188 ){
			return 'Your weight should be 69.4 - 84.8kg';
		}		
		if(calcWEIGHT() == 191 ){
			return 'Your weight should be 71.6 - 87.5kg';
		}	
		if(calcWEIGHT() == 193 ){
			return 'Your weight should be 73.5 - 89.8kg';
		}
		if(calcWEIGHT() == 195 ){
			return 'Your weight should be 75.7 - 92.5kg';
		}
		if(calcWEIGHT() == 198 ){
			return 'Your weight should be 77.5 - 94.8kg';
		}	
		if(calcWEIGHT() == 201 ){
			return 'Your weight should be 79.8 - 97.5kg';
		}	
		if(calcWEIGHT() == 203 ){
			return 'Your weight should be 81.6 - 99.8kg';
		}	
		if(calcWEIGHT() == 205 ){
			return 'Your weight should be 83.9 - 102.5kg';
		}	
		if(calcWEIGHT() == 208 ){
			return 'Your weight should be 85.7 - 104.8kg';
		}	
		if(calcWEIGHT() == 210 ){
			return 'Your weight should be 88 - 107.5kg';
		}
		if(calcWEIGHT() == 213 ){
			return 'Your weight should be 89.8 - 109.7kg';
		}		
	}
	jQuery('.weight_result').addClass('mt-4');
	resultDiv2.html(weightState());			
	}		
});
});
</script>";	

//Calculate BMI Functions end from here	

	return $output;
}
add_shortcode('ronby_shortcode_for_bmi_weight_calculator', 'ronby_bmi_weight_calculator_shortcode');


/*****************************
Fitness Program Section
******************************/
//Function for Fitness Program Section
function ronby_fitness_program_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' => '',
	'heading_dif_colored' => '',
	'desc' => '',
	'feature1_icon' => '',
	'feature1_title' => '',
	'feature2_icon' => '',
	'feature2_title' => '',
	'feature3_icon' => '',
	'feature3_title' => '',	
	'btn_label' => '',
	'btn_url' => '',
	'icon_color' => '',
	'feature_title_color' => '',
	'title_color' => '',
	'desc_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'bg_color' => '',
	'border_animation' => '',
	), $atts ) );
		
	$gallery = shortcode_atts(
    array(
        'image'      =>  'image',
    ), $atts );	
	$image_ids = explode(',',$gallery['image']);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}
	
	$allowed_html_array = array(
		'b' => array(),
		'strong' => array(),
		'p' => array(),
		'br' => array(),
		'span' => array('style' => array()),
		'i' => array('class' => array()),
		'em' => array('class' => array()),
		);	
		
		$myArray = explode(',', $heading_dif_colored);	
    $ret = $heading;	
	foreach($myArray as $patterns){
    $ret = preg_replace('/\b'.$patterns.'\b/i',"<span style='color:#FC3C2A'>$patterns</span>",$ret);   
	}
	$ret ;

	$output='<section class="section-join-us';if($border_animation=="yes"){ $output.=' bdron'; } $output.='" ';if($bg_color){$output.='style="background-color:'.esc_attr($bg_color).'"';}$output.='>
				<div class="container" id="un343">
					<div class="section-content" ';if($images[0] || $padding_top || $padding_bottom){$output.='style="';if($images[0]){$output.='background-image:url('.esc_url($images[0]).');';}if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
						<div class="section-header-style-7">
						';if($heading){$output.='
							<h2 class="section-title" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.wp_kses(__($ret),$allowed_html_array).'</h2>
						';}$output.='
						</div>						
						<div class="section-text">
						';if($desc){$output.='
							<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>'.esc_attr($desc).'</p>
						';}$output.='
						</div>
						';if($border_animation=="yes"){ $output.='
						<div class="bordered-top-uls"></div>
						';}$output.='
						<ul class="section-list-item d-flex flex-wrap align-items-center"  id="border-block">
						';if($feature1_icon && $feature1_title){$output.='
							<li>
								<div class="item-icon color-primary">
									<i class="'.esc_attr($feature1_icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></i>
								</div>
								<div class="item-title" ';if($feature_title_color){$output.='style="color:'.esc_attr($feature_title_color).'"';}$output.='>'.esc_attr($feature1_title).'</div>
							
							</li>
						';}$output.='
						';if($feature2_icon && $feature2_title){$output.='
							<li>
								<div class="item-icon color-primary">
									<i class="'.esc_attr($feature2_icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></i>
								</div>
								<div class="item-title" ';if($feature_title_color){$output.='style="color:'.esc_attr($feature_title_color).'"';}$output.='>'.esc_attr($feature2_title).'</div>
							</li>
						';}$output.='
						';if($feature3_icon && $feature3_title){$output.='
							<li>
								<div class="item-icon color-primary">
									<i class="'.esc_attr($feature3_icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></i>
								</div>
								<div class="item-title" ';if($feature_title_color){$output.='style="color:'.esc_attr($feature_title_color).'"';}$output.='>'.esc_attr($feature3_title).'</div>
							</li>
						';}$output.='	
						</ul>
						';if($border_animation=="yes"){ $output.='
						<div class="bordered-bottom-uls"></div>
						'; } if($btn_label){$output.='
						<div>
							<a href="'.esc_url($btn_url).'" class="button button-primary rounded-capsule" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
						</div>
						';}$output.='
					</div>
				</div>
			</section>';
			
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_program_section', 'ronby_fitness_program_section_shortcode');

/*****************************
Fitness Heading Section- 1
******************************/
//Function for Heading Section- 1
function ronby_fitness_heading_section_one_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading1_color' => '',
	'heading1_dif_colored' => '',
	'heading2' => '',
	'heading2_color' => '',
	'heading2_dif_colored' => '',
	'heading3' => '',
	'heading3_color' => '',	
	'desc' => '',
	'up_arrow_icon' => '',
	'desc_color' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	), $atts ) );
	
	$allowed_html_array = array(
		'b' => array(),
		'strong' => array(),
		'p' => array(),
		'br' => array(),
		'span' => array('style' => array()),
		'i' => array('class' => array()),
		'em' => array('class' => array()),
		);	
		

    $myArray = explode(',', $heading1_dif_colored);	
    $ret = $heading1;	
	foreach($myArray as $patterns){
    $ret = preg_replace('/\b'.$patterns.'\b/i',"<span style='color:#FC3C2A'>$patterns</span>",$ret);   
	}
	$ret ;	
	
    $myArray2 = explode(',', $heading2_dif_colored);	
    $ret2 = $heading2;	
	foreach($myArray2 as $patterns){
    $ret2 = preg_replace('/\b'.$patterns.'\b/i',"<span style='color:#FC3C2A'>$patterns</span>",$ret2);   
	}
	$ret2 ;
		
	$output='<section class="p-30-0-30 ';if($up_arrow_icon == 'style1'){$output.='before-arrow-1 row-xtra-space';}elseif($up_arrow_icon == 'style2'){$output.='before-arrow-2 row-xtra-space';}elseif($up_arrow_icon == 'style3'){$output.='before-arrow-3 row-xtra-space';}elseif($up_arrow_icon == 'style4'){$output.='before-arrow-4 row-xtra-space';}$output.='" ';if($padding_top || $padding_bottom){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.='"';}$output.='>		
				<div class="section-header-style-6">
				';if($heading1){$output.='
					<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.wp_kses(__($ret),$allowed_html_array).'</h2>
				';}$output.='	
				';if($heading2){$output.='
					<h2 class="section-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.wp_kses(__($ret2),$allowed_html_array).'</h2>
				';}$output.='	
				';if($heading3){$output.='
					<h4 class="section-sub-title" ';if($heading3_color){$output.='style="color:'.esc_attr($heading3_color).'"';}$output.='>'.esc_attr($heading3).'</h4>	
				';}$output.='	
				</div>
				';if($desc){$output.='
				<div class="section-description text-center mb-0" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
					'.esc_attr($desc).'
				</div>
				';}$output.='
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_heading_section_one', 'ronby_fitness_heading_section_one_shortcode');

/******************* 
Fitness Price Table - 1 
********************/
//This function is for Price Table- 1

function ronby_price_table_one_shortcode( $atts ) {
extract( shortcode_atts( array(
	'plan_name'		 => '',
	'plan_currency'  => '',
	'plan_price'     => '',
	'plan_duration'  => '',
	'plan_features'  => '',
	'plan_btn_name'  => '',
	'plan_header_overlay_color'  => '',
	'plan_currency_color'  => '',
	'plan_price_color'  => '',
	'plan_name_color'  => '',
	'plan_duration_color'  => '',
	'plan_feature_color'  => '',
	'plan_btn_text_color'  => '',
	'plan_btn_bg_color'  => '',
	'plan_btn_url'   => '',

	), $atts ) );
	if (!empty($plan_features)){
	$plan_all_features=explode("\n",$plan_features);
	}
	$gallery = shortcode_atts(
    array(
        'plan_card_image'      =>  'plan_card_image',
    ), $atts );	
	$image_ids = explode(',',$gallery['plan_card_image']);
	
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'plan_card_image' );
	}
	$gallery2 = shortcode_atts(
    array(
        'plan_header_bg_image'      =>  'plan_header_bg_image',
    ), $atts );	
	$image_ids2 = explode(',',$gallery2['plan_header_bg_image']);
	foreach( $image_ids2 as $image_id2 ){
    $images2 = wp_get_attachment_image_src( $image_id2, 'plan_header_bg_image' );
	}
	$gallery3 = shortcode_atts(
    array(
        'plan_body_bg_image'      =>  'plan_body_bg_image',
    ), $atts );	
	$image_ids3 = explode(',',$gallery3['plan_body_bg_image']);
	foreach( $image_ids3 as $image_id3 ){
    $images3 = wp_get_attachment_image_src( $image_id3, 'plan_body_bg_image' );
	}	
	$output ='<section class="section-pricing-table p-30-0-30">
							<div class="plan-item style-1">
								<div class="item-header" ';if($images2[0]){$output.='style="background-image:url('.esc_url($images2[0]).')"';}$output.='>
									<div class="overlay d-flex flex-column justify-content-center" ';if($plan_header_overlay_color){$output.='style="background-color:'.esc_attr($plan_header_overlay_color).'"';}$output.='>
										<div class="plan-price">
											';if($plan_currency){$output.='
											<span class="curency" ';if($plan_currency_color){$output.='style="color:'.esc_attr($plan_currency_color).'"';}$output.='>'.esc_attr( $plan_currency).'</span>
											';}$output.='
											';if($plan_price){$output.='
											<span class="price-number" ';if($plan_price_color){$output.='style="color:'.esc_attr($plan_price_color).'"';}$output.='>'.esc_attr( $plan_price).'</span>
											';}$output.='
											';if($plan_duration){$output.='
											<span class="plan-period" ';if($plan_duration_color){$output.='style="color:'.esc_attr($plan_duration_color).'"';}$output.='>'.esc_attr( $plan_duration).'</span>
											';}$output.='
										</div>
										';if($plan_name){$output.='
										<h3 class="plan-name" ';if($plan_name_color){$output.='style="color:'.esc_attr($plan_name_color).'"';}$output.='>'.esc_attr( $plan_name).'</h3>
										';}$output.='
										';if($images[0]){$output.='
										<div class="card-image">
											<img src="'.esc_url($images[0]).'" alt="'.esc_attr('card-image').'">
										</div>
										';}$output.='
									</div>
								</div>
								';if($plan_all_features){$output.='
								<div class="item-content" ';if($images3[0]){$output.='style="background-image:url('.esc_url($images3[0]).')"';}$output.='>
									<div class="content-overlay">
										<ul>'; 	
										$c=-1;
										foreach($plan_all_features as $feature) {
										$c++;
										$output .= '<li ';if($plan_feature_color){$output.='style="color:'.esc_attr($plan_feature_color).'"';}$output.='>'.htmlspecialchars_decode($feature).'</li>';
										} $output.='</ul>
										<a href="'.esc_url( $plan_btn_url).'" class="button button-secondary rounded-capsule button-block" ';if($plan_btn_text_color || $plan_btn_bg_color){$output.='style="';if($plan_btn_text_color){$output.='color:'.esc_attr($plan_btn_text_color).';';}if($plan_btn_bg_color){$output.='background-color:'.esc_attr($plan_btn_bg_color).'';}$output.='"';}$output.='>
											'.esc_attr('Choose plan').' <i class="fas fa-angle-right ml-5px"></i>
										</a>
									</div>
								</div>	
								';}$output.='								
							</div>
			</section>';
	
    return $output;
}
add_shortcode('ronby_shortcodes_for_price_table_one', 'ronby_price_table_one_shortcode');


/******************* 
Time Table 
********************/
//This function is for Data Tables
function ronby_data_table_shortcode( $atts ) {
extract( shortcode_atts( array(
	'column_title_1'	     => '',	
	'column_title_2'	     => '',
	'column_title_3'	     => '',
	'column_title_4'	     => '',
	'column_title_5'	     => '',
	'column_title_6'	     => '',	
	'column_title_7'	     => '',
	'column_title_8'	     => '',
	'column_title_color'	 => '',
	'column_bg_color'	 => '',
	
	), $atts ) );
	
   $a = shortcode_atts(array(
        'number_of_rows' => '',
    ),$atts);

		$allowed_html_array = array(
		'p' => array(),
		'br' => array(),
		'span' => array(),
		);
	
	$output ='<section class="section-timetable p-30-0-30 fitness-section-timetable">
    <div class="container">
          <table class="timetable">
            <thead>
              <tr>
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>';  if($column_title_1){ $output.=''.esc_attr($column_title_1).''; } $output.='</th>
			  ';  if($column_title_2){ $output.='
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>'.esc_attr($column_title_2).'</th>
			  '; } if($column_title_3){ $output.='				
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>'.esc_attr($column_title_3).'</th>
			  '; } if($column_title_4){ $output.='				
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>'.esc_attr($column_title_4).'</th>
			  '; } if($column_title_5){ $output.='				
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>'.esc_attr($column_title_5).'</th>
			  '; } if($column_title_6){ $output.='				
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>'.esc_attr($column_title_6).'</th>
			  '; } if($column_title_7){ $output.='				
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>'.esc_attr($column_title_7).'</th>				
			  '; } if($column_title_8){ $output.='				
                <th ';if($column_title_color || $column_bg_color){$output.='style="';if($column_title_color){$output.='color:'.esc_attr($column_title_color).';';}if($column_bg_color){$output.='background-color:'.esc_attr($column_bg_color).'';}$output.='"';}$output.='>'.esc_attr($column_title_8).'</th>				
      		  '; }  $output.='	
              </tr>
            </thead>
            <tbody>';
	$i=1;
	$c=0;
	while ($i<=$a['number_of_rows']){
	$c++;
	$b = shortcode_atts(array(
	'col1_text'.$c.'' => '',
	'col2_text'.$c.'' => '',
	'col3_text'.$c.'' => '',
	'col4_text'.$c.'' => '',
	'col5_text'.$c.'' => '',
	'col6_text'.$c.'' => '',
	'col7_text'.$c.'' => '',
	'col8_text'.$c.'' => '',
	
	'col1_text_color'.$c.'' => '',
	'col2_text_color'.$c.'' => '',
	'col3_text_color'.$c.'' => '',
	'col4_text_color'.$c.'' => '',
	'col5_text_color'.$c.'' => '',
	'col6_text_color'.$c.'' => '',
	'col7_text_color'.$c.'' => '',
	'col8_text_color'.$c.'' => '',
	
	'col1_bg_color'.$c.'' => '',
	'col2_bg_color'.$c.'' => '',
	'col3_bg_color'.$c.'' => '',
	'col4_bg_color'.$c.'' => '',
	'col5_bg_color'.$c.'' => '',
	'col6_bg_color'.$c.'' => '',
	'col7_bg_color'.$c.'' => '',
	'col8_bg_color'.$c.'' => '',
    ),$atts);
	
	$col1_text  =$b['col1_text'.$c.''];	
	$col2_text  =$b['col2_text'.$c.''];	
	$col3_text  =$b['col3_text'.$c.''];	
	$col4_text  =$b['col4_text'.$c.''];	
	$col5_text  =$b['col5_text'.$c.''];	
	$col6_text  =$b['col6_text'.$c.''];	
	$col7_text  =$b['col7_text'.$c.''];	
	$col8_text  =$b['col8_text'.$c.''];	
	
	$col1_text_color  =$b['col1_text_color'.$c.''];	
	$col2_text_color  =$b['col2_text_color'.$c.''];	
	$col3_text_color  =$b['col3_text_color'.$c.''];	
	$col4_text_color  =$b['col4_text_color'.$c.''];	
	$col5_text_color  =$b['col5_text_color'.$c.''];	
	$col6_text_color  =$b['col6_text_color'.$c.''];	
	$col7_text_color  =$b['col7_text_color'.$c.''];	
	$col8_text_color  =$b['col8_text_color'.$c.''];	
	
	$col1_bg_color  =$b['col1_bg_color'.$c.''];	
	$col2_bg_color  =$b['col2_bg_color'.$c.''];	
	$col3_bg_color  =$b['col3_bg_color'.$c.''];	
	$col4_bg_color  =$b['col4_bg_color'.$c.''];	
	$col5_bg_color  =$b['col5_bg_color'.$c.''];	
	$col6_bg_color  =$b['col6_bg_color'.$c.''];	
	$col7_bg_color  =$b['col7_bg_color'.$c.''];	
	$col8_bg_color  =$b['col8_bg_color'.$c.''];	
	
  $output.='<tr>  			  
                <td ';if($col1_text_color || $col1_bg_color){$output.='style="';if($col1_text_color){$output.='color:'.esc_attr($col1_text_color).';';}if($col1_bg_color){$output.='background-color:'.esc_attr($col1_bg_color).'';}$output.='"';}$output.='>';if($col1_text){ $output.=''.wp_kses($col1_text, $allowed_html_array).'';} $output.='</td>
				
                <td ';if($col2_text_color || $col2_bg_color){$output.='style="';if($col2_text_color){$output.='color:'.esc_attr($col2_text_color).';';}if($col2_bg_color){$output.='background-color:'.esc_attr($col2_bg_color).'';}$output.='"';}$output.='>';if($column_title_2){ $output.=''.wp_kses($col2_text, $allowed_html_array).'';}$output.='</td>
			
                <td ';if($col3_text_color || $col3_bg_color){$output.='style="';if($col3_text_color){$output.='color:'.esc_attr($col3_text_color).';';}if($col3_bg_color){$output.='background-color:'.esc_attr($col3_bg_color).'';}$output.='"';}$output.='>';if($column_title_3){ $output.=''.wp_kses($col3_text, $allowed_html_array).'';}$output.='</td>
			  			
                <td ';if($col4_text_color || $col4_bg_color){$output.='style="';if($col4_text_color){$output.='color:'.esc_attr($col4_text_color).';';}if($col4_bg_color){$output.='background-color:'.esc_attr($col4_bg_color).'';}$output.='"';}$output.='>'; if($column_title_4){ $output.=''.wp_kses($col4_text, $allowed_html_array).'';}$output.='</td>
				
                <td ';if($col5_text_color || $col5_bg_color){$output.='style="';if($col5_text_color){$output.='color:'.esc_attr($col5_text_color).';';}if($col5_bg_color){$output.='background-color:'.esc_attr($col5_bg_color).'';}$output.='"';}$output.='>';  if($column_title_5){ $output.=''.wp_kses($col5_text, $allowed_html_array).'';}$output.='</td>
					
                <td ';if($col6_text_color || $col6_bg_color){$output.='style="';if($col6_text_color){$output.='color:'.esc_attr($col6_text_color).';';}if($col6_bg_color){$output.='background-color:'.esc_attr($col6_bg_color).'';}$output.='"';}$output.='>';  if($column_title_6){ $output.=''.wp_kses($col6_text, $allowed_html_array).'';}$output.='</td>			
			
                <td ';if($col7_text_color || $col7_bg_color){$output.='style="';if($col7_text_color){$output.='color:'.esc_attr($col7_text_color).';';}if($col7_bg_color){$output.='background-color:'.esc_attr($col7_bg_color).'';}$output.='"';}$output.='>';  if($column_title_7){ $output.=''.wp_kses($col7_text, $allowed_html_array).'';}$output.='</td>
				'; if($column_title_8){ $output.='
                <td ';if($col8_text_color || $col8_bg_color){$output.='style="';if($col8_text_color){$output.='color:'.esc_attr($col8_text_color).';';}if($col8_bg_color){$output.='background-color:'.esc_attr($col8_bg_color).'';}$output.='"';}$output.='>'; if($column_title_8){ $output.=''.wp_kses($col8_text, $allowed_html_array).''; } $output.='</td>	
				';} $output.='
            </tr>';
$i++;
}
	$output .='				
            </tbody>
          </table>
    </div>
  </section>
  <div class="clearfix"></div>
  <!-- end section -->';

  
	return $output;
}
add_shortcode('ronby_shortcode_for_data_table', 'ronby_data_table_shortcode');

/*****************************
Fitness Featured class
******************************/
//Function for Fitness Featured class
function ronby_fitness_featured_class_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'cls_style' => '',
	'title' => '',
	'instructor_name' => '',
	'start_date' => '',
	'start_time' => '',
	'day1' => '',
	'time1' => '',
	'day2' => '',
	'time2' => '',
	'day3' => '',
	'time3' => '',
	'day4' => '',
	'time4' => '',
	'day5' => '',
	'time5' => '',
	'cls_details' => '',
	'price' => '',
	'price_duration' => '',
	'link_to_url' => '',
	'instructor_name_color' => '',
	'class_title_color' => '',
	'cls_details_color' => '',
	'start_date_color' => '',
	'start_date_info_color' => '',
	'price_bg_color' => '',
	'class_info_box_bg_color' => '',
	), $atts ) );
	$gallery = shortcode_atts(
    array(
        'image'      =>  'image',
    ), $atts );	
	$image_ids = explode(',',$gallery['image']);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}		
	$output='<section class="section-classes p-30-0-30 fitness-section-classes';if($cls_style == 'style2'){$output.=' style_two';}$output.='">					
						<!-- Fitness class item -->
							<article class="class-item mb-0">
								<div class="thumbnail animate-zoom">
									<a href="'.esc_url($link_to_url).'">
									';if($images[0]){$output.='
										<img src="'.esc_url($images[0]).'" alt="'.esc_attr('featured-image').'">
									';} $output.='	
									</a>
									';if($cls_style == 'style2'){$output.='
									<div class="class-item-overlay">
										';if($day1 || $day1){ $output.='
										<div class="class-time-wrap">
											';if($day1){ $output.='
											<div class="cls-time-data">
                                                <span class="day-name">'.esc_attr($day1).'</span>
                                                <span class="class-time">'.esc_attr($time1).'</span>
                                            </div>
											';} if($day2){ $output.='
                                            <div class="cls-time-data">
                                                <span class="day-name">'.esc_attr($day2).'</span>
                                                <span class="class-time">'.esc_attr($time2).'</span>
                                            </div>
											';} if($day3){ $output.='
                                            <div class="cls-time-data">
                                                <span class="day-name">'.esc_attr($day3).'</span>
                                                <span class="class-time">'.esc_attr($time3).'</span>
                                            </div>
											';} if($day4){ $output.='
											<div class="cls-time-data">
                                                <span class="day-name">'.esc_attr($day4).'</span>
                                                <span class="class-time">'.esc_attr($time4).'</span>
                                            </div>
											';} if($day5){ $output.='
											<div class="cls-time-data">
                                                <span class="day-name">'.esc_attr($day5).'</span>
                                                <span class="class-time">'.esc_attr($time5).'</span>
                                            </div>
											';} $output.='
                                        </div>
										';} $output.='
									</div>
									';}$output.='			
								</div>
								<div class="class-infomation" ';if($class_info_box_bg_color){$output.='style="background-color:'.esc_attr($class_info_box_bg_color).';border-color:'.esc_attr($class_info_box_bg_color).'"';}$output.='>
								';if($instructor_name){ $output.='
									<div class="class-description" ';if($instructor_name_color){$output.='style="color:'.esc_attr($instructor_name_color).'"';}$output.='>
										'.esc_attr($instructor_name).'
									</div>
								';} $output.='
									<a href="'.esc_url($link_to_url).'">
									';if($title){ $output.='
										<h3 class="class-title" ';if($class_title_color){$output.='style="color:'.esc_attr($class_title_color).'"';}$output.='>
											'.esc_attr($title).'
										</h3>
									';} $output.='	
									</a>
									';if($cls_style == 'style2'){
									if($cls_details) {$output.='
									<div class="class-schedule"';if($cls_details_color){$output.=' style="color:'.esc_attr($cls_details_color).'"';}$output.='>
										'.esc_textarea($cls_details).'
									</div>
									';} $output.='
									';} else {$output.='
									';if($start_date || $start_time){ $output.='
									<div class="class-schedule">
										<span class="mr-2"><span class="color-primary" ';if($start_date_color){$output.='style="color:'.esc_attr($start_date_color).'"';}$output.='>'.esc_attr__('Start Date:','ronby').'</span><span ';if($start_date_info_color){$output.='style="color:'.esc_attr($start_date_info_color).'"';}$output.='> '.esc_attr($start_date).'</span></span> <span ';if($start_date_info_color){$output.='style="color:'.esc_attr($start_date_info_color).'"';}$output.='>-</span> <span class="ml-2" ';if($start_date_info_color){$output.='style="color:'.esc_attr($start_date_info_color).'"';}$output.='>'.esc_attr($start_time).'</span>
									</div>
									';} }$output.='
									';if($price || $price_duration){$output.='
									<div class="class-price background-primary d-flex flex-column justify-content-center align-items-center" ';if($price_bg_color){$output.='style="background-color:'.esc_attr($price_bg_color).'"';}$output.='>
									';if($price){ $output.='
										<div class="price-number">'.esc_attr($price).'</div>
									';} $output.='	
									';if($price_duration){ $output.='
										<div class="price-text">'.esc_attr($price_duration).'</div>
									';} $output.='	
									</div>
									';} $output.='
								</div>
							</article>
						<!-- /Fitness class item -->
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_featured_class', 'ronby_fitness_featured_class_shortcode');

/*****************************
Fitness Counter Box Section
******************************/
//Function for Fitness Counter Box Section
function ronby_fitness_counter_box_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'number_of_counter_box' => '',
	'counter_box_bg_color' => '',
	'counter_box_number_color' => '',
	'counter_box_title_color' => '',
	'counter_sec_overlay_color' => '',
	'up_arrow_icon' => '',
	), $atts ) );
	$gallery = shortcode_atts(
    array(
        'counter_sec_bg_img'      =>  'counter_sec_bg_img',
    ), $atts );	
	$image_ids = explode(',',$gallery['counter_sec_bg_img']);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'counter_sec_bg_img' );
	}		
	$output='<section class="section-counter counter-style-3 fitness-section-counter  ';if($up_arrow_icon == 'style1'){$output.='before-arrow-1 row-xtra-space';}elseif($up_arrow_icon == 'style2'){$output.='before-arrow-2 row-xtra-space';}elseif($up_arrow_icon == 'style3'){$output.='before-arrow-3 row-xtra-space';}elseif($up_arrow_icon == 'style4'){$output.='before-arrow-4 row-xtra-space';}$output.='" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).');"';}$output.='>
				<div class="overlay" ';if($counter_sec_overlay_color){$output.='style="background-color:'.esc_attr($counter_sec_overlay_color).'"';}$output.='>
					<div class="container">
						<div class="row">';
	$i=1;
	$c=0;
	while ($i<=$number_of_counter_box){
	$c++;
	$b = shortcode_atts(array(
		'counter_number'.$c.'' => '',
		'counter_title'.$c.'' => '',
    ),$atts);
	$counter_number =$b['counter_number'.$c.''];
	$counter_title =$b['counter_title'.$c.''];

	$output .='<div class="col-sm-6 col-lg-3 mb-4 ';if($number_of_counter_box < 5){$output .='mb-lg-0';}$output.='">
								<div class="counter-item d-flex flex-column justify-content-center align-items-center" ';if($counter_box_bg_color){$output.='style="background-color:'.esc_attr($counter_box_bg_color).'"';}$output.='>
									<div class="item-number countUpNumber" data-to="'.esc_attr($counter_number).'" data-speed="3000" ';if($counter_box_number_color){$output.='style="color:'.esc_attr($counter_box_number_color).'"';}$output.='>'.esc_attr($counter_number).'</div>
									<div class="item-text" ';if($counter_box_title_color){$output.='style="color:'.esc_attr($counter_box_title_color).'"';}$output.='>'.esc_attr($counter_title).'</div>
								</div>
							</div>';
	$i++;
	}
	$output .='			</div>
					</div>
				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_counter_box_section', 'ronby_fitness_counter_box_section_shortcode');

/*****************************
Fitness Woocommerce Products Section
******************************/
//Function for Fitness Woocommerce Products Section
function ronby_fitness_woo_products_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'cat_id'      => '',
	'post_per_page' => '-1',
	'order'   => 'desc',
	'orderby' => 'date',
	'box_bg_color' => '',
	'border_color' => '',
	'middle_border_color' => '',
	'badge_bg' => '',
	'badge_text_color' => '',
	'dashed_border' => '',
	), $atts ) );
	$allowed_html_array = array(
	'p' => array(),
	'br' => array(),
	'span' => array(),
	'del' => array(),
	'ins' => array(),
	);	
	$args = array(
			'posts_per_page'  => $post_per_page,
			'post_type'   => 'product',
			'post_status' => 'publish',			
			'orderby' => $orderby,
			'order'   => $order,
			'tax_query'=> array(
					array(
						'taxonomy'      => 'product_cat',
						'field' => 'term_id', //This is optional, as it defaults to 'term_id'
						'terms'         => $cat_id,
						'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
					)
				)
			);
   function ronby_fitness_add_to_cart_button() {
       global $product;
       $classes = implode( ' ',  array(
           'button',
           'product_type_' . $product->get_type(),
           $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
           $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
       )  );
   
       return apply_filters( 'woocommerce_loop_add_to_cart_link',
           sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="product_type_%s  hover-background-primary"><i class="fas fa-shopping-basket"></i></a>',
               esc_url( $product->add_to_cart_url() ),
               esc_attr( $product->get_id() ),
               esc_attr( $product->get_sku() ),
               esc_attr( isset( $quantity ) ? $quantity : 1 ),
               esc_attr( isset( $classes ) ? $classes : 'button' ),
               esc_attr( $product->get_type() ),
               esc_html( $product->add_to_cart_text() )
           ),
       $product );
   }			
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);
	$output='<section class="section-feature-products p-30-0-30 fitness-section-feature-products">
	<div class="container">
				<div class="row">';
	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
			global $product;
			global $post;
			global $redux;
			$args='';
			$id = $product->get_id();
			$description = $product->get_description();
			$get_desc=get_the_excerpt($id);
			$get_price= $product->get_price_html();
			$img_url = get_the_post_thumbnail_url();
			if($img_url){
				$image_url = $img_url;	
			}else{
				$image_url = get_template_directory_uri().'/images/dummy-product-image.jpg';
			}
		    $i=0;
		    $average = round($product->get_average_rating());			
	$output.='<div class="col-sm-6 col-lg-4 col-xl-3">
			<div class="col-md-12 nopadding">
				<article class="product-item-1 text-center" ';if($border_color){$output.='style="border:1px solid '.esc_attr($border_color).'"';}$output.='>';
	if( $product->is_on_sale() ){ 
	$output.= '<div class="ribbon">
			  <div class="ribbon-wrap">
				<span class="ribbon6" ';if($badge_bg || $badge_text_color || $dashed_border){$output.='style="';if($badge_bg){$output.='background-color:'.esc_attr($badge_bg).';box-shadow: 0 0 0 3px '.esc_attr($badge_bg).', 0px 21px 5px -18px rgba(0,0,0,0.6);';}if($badge_text_color){$output.='color:'.esc_attr($badge_text_color).';';}if($dashed_border=="yes"){$output.='border:1px dashed;';}$output.='"';}$output.='>'.esc_attr('Sale').'</span>
			  </div>
			</div>';
	}
			$output.='<div class="thumbnail animate-zoom d-flex" ';if($box_bg_color || $middle_border_color){$output.='style="';if($box_bg_color){$output.='background-color:'.esc_attr($box_bg_color).';';}if($middle_border_color){$output.='border-bottom:1px solid '.esc_attr($middle_border_color).'';};$output.='"';}$output.='>
				<a href="'.esc_url(get_permalink($id)).'">';
   			if($img_url){
				$output.='<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'">';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && ($redux['ronby_single_product_placeholder']['url'])){
				$output.='<img src="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" alt="'.esc_attr__('featured-image','ronby').'">';
   				}else{
				$output.='<img src="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" alt="'.esc_attr__('featured-image','ronby').'">';				
   				}   				
   			}										
			$output.='</a>
					</div>
					<div class="shadow-brdr"><div class="item-buttons product-action-buttons-1 d-flex justify-content-center">';
   			if($img_url){
				$output.='<a href="'.esc_url($img_url).'" class="hover-background-primary cursor-point" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && ($redux['ronby_single_product_placeholder']['url'])){
				$output.='<a href="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" class="hover-background-primary cursor-point" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';
   				}else{
				$output.='<a href="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" class="hover-background-primary cursor-point" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';				
   				}   				
   			}
			//if ronby_shop_page_quick_view_switch is turned on
			if(ronby_get_option('ronby_shop_page_quick_view_switch')){
			$output.='<a href="'.esc_url('#0').'" class="hover-background-primary quick_view cursor-point" data-product-id="'.esc_attr($product->get_id()).'" >
				<i class="far fa-eye"></i></a>';
			}
				$output.=ronby_fitness_add_to_cart_button();
				$output.='</div>';

					if($average){
					$output.= '<div class="stars-rating justify-content-center" data-rate="5">';
					while($i < $average){
						$output.="<span class='fas fa-star'></span>";
						$i++;
					}
					$output.='</div>';
					}
						$output.='<a href="'.esc_url(get_permalink($id)).'">
									<h3 class="product-name animate-300 hover-color-primary">'.esc_attr(get_the_title( $id )).'</h3>
								</a>
								';if($get_price){ $output.='
								<div class="product-price-1 mb-4">
									<span class="">'.wp_kses($get_price, $allowed_html_array).'</span>
								</div>
								'; } $output.='
				</div></article>
				</div>
			</div>';
	endwhile;endif;
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();	
	$output.='	</div>
				</div>
			</section>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_woo_products_section', 'ronby_fitness_woo_products_section_shortcode');

/*****************************
Fitness Trainers Profile Section
******************************/
//Function for Fitness Trainers Profile Section
function ronby_fitness_trainers_profile_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'lead_trainer_name'      => '',
	'lead_trainer_designation'      => '',
	'lead_trainer_description'      => '',
	'lead_trainer_fb_url'      => '',
	'lead_trainer_twitter_url'      => '',
	'lead_trainer_linkedin_url'      => '',
	'lead_trainer_pinterest_url'      => '',
	'lead_overlay_background_color'      => '',
	'lead_trainer_name_color'      => '',
	'lead_trainer_designation_color'      => '',
	'lead_trainer_link'      => '',
	'number_of_members'      => '',
	'trainer_name_color'      => '',	
	'trainer_designation_color'      => '',	
	'trainer_description_color'      => '',	
	'trainer_phone_color'      => '',	
	'trainer_email_color'      => '',	
	'trainer_icon_color'      => '',	
	'up_arrow_icon'      => '',	
	'border_c'      => '',	
	'box_margin_top'      => '',	
	'box_margin_bottom'      => '',	
	'box_bg_color'      => '',	
	'icon_p_left'      => '',	
	), $atts ) );
	// Lead Trainer Image
	$lead_trainer_img = shortcode_atts(
    array(
        'lead_trainer_img'      =>  'lead_trainer_img',
    ), $atts );	
	$lead_trainer_img_ids = explode(',',$lead_trainer_img['lead_trainer_img']);
	foreach( $lead_trainer_img_ids as $lead_trainer_img_id ){
    $lead_trainer_img_url = wp_get_attachment_image_src( $lead_trainer_img_id, 'lead_trainer_img' );
	}
	
	$output='<section class="section-teams p-30-0-30 fitness-section-teams ';if($up_arrow_icon == 'style1'){$output.='before-arrow-1 row-xtra-space';}elseif($up_arrow_icon == 'style2'){$output.='before-arrow-2 row-xtra-space';}elseif($up_arrow_icon == 'style3'){$output.='before-arrow-3 row-xtra-space';}elseif($up_arrow_icon == 'style4'){$output.='before-arrow-4 row-xtra-space';}$output.='">
				<div class="container">
					<div class="row gutter-10 flex-wrap justify-content-center align-items-center align-content-center">
					';if($lead_trainer_img_url[0]){$output.='
						<article class="detailed-team-member-item-2 thumbnail animate-zoom">

							<img src="'.esc_url($lead_trainer_img_url[0]).'" alt="'.esc_attr('lead-trainer-image').'">

							<div class="overlay d-flex flex-column justify-content-end" ';if($lead_overlay_background_color){$output.='style="background-color:'.esc_attr($lead_overlay_background_color).'"';}$output.='>
							';if($lead_trainer_name || $lead_trainer_designation){$output.='
								<div class="mb-20px">
								';if($lead_trainer_name){$output.='
								<a href="'.esc_url($lead_trainer_link).'" class="d-inline">
									<span class="member-name" ';if($lead_trainer_name_color){$output.='style="color:'.esc_attr($lead_trainer_name_color).'"';}$output.='>'.esc_attr($lead_trainer_name).'</span>
								</a>	
								';}$output.='
								';if($lead_trainer_designation){$output.='
									<span class="member-role color-primary" ';if($lead_trainer_designation_color){$output.='style="color:'.esc_attr($lead_trainer_designation_color).'"';}$output.='>'.esc_attr($lead_trainer_designation).'</span>
								';}$output.='	
								</div>
							';}$output.='
							';if($lead_trainer_description){$output.='
								<div class="member-quote" ';if($trainer_description_color){$output.='style="color:'.esc_attr($trainer_description_color).'"';}$output.='>
									'.esc_attr($lead_trainer_description).' 
								</div>
							';}$output.='	
							</div>
							<div class="member-socials">
								<ul>
								';if($lead_trainer_fb_url){$output.='
									<li>
										<a href="'.esc_url($lead_trainer_fb_url).'">
											<i class="fab fa-facebook-f"></i>
										</a>
									</li>
								';}$output.='
								';if($lead_trainer_twitter_url){$output.='
									<li>
										<a href="'.esc_url($lead_trainer_twitter_url).'">
											<i class="fab fa-twitter"></i>
										</a>
									</li>
								';}$output.='
								';if($lead_trainer_linkedin_url){$output.='
									<li>
										<a href="'.esc_url($lead_trainer_linkedin_url).'">
											<i class="fab fa-linkedin-in"></i>
										</a>
									</li>
								';}$output.='
								';if($lead_trainer_pinterest_url){$output.='
									<li>
										<a href="'.esc_url($lead_trainer_pinterest_url).'">
											<i class="fab fa-pinterest-p"></i>
										</a>
									</li>
								';}$output.='	
								</ul>
							</div>
						</article>
						';}
						
	$i=1;
	$c=0;
	while ($i<=$number_of_members){
	$c++;
	$b = shortcode_atts(array(
		'trainer_name'.$c.'' => '',
		'trainer_designation'.$c.'' => '',
		'trainer_img_url'.$c.'' => '',
		'trainer_link_url'.$c.'' => '',
		'trainer_phone'.$c.'' => '',
		'trainer_email'.$c.'' => '',
		'trainer_fb_url'.$c.'' => '',
		'trainer_twitter_url'.$c.'' => '',
		'trainer_linkedin_url'.$c.'' => '',
		'trainer_pinterest_url'.$c.'' => '',
    ),$atts);
	$trainer_name =$b['trainer_name'.$c.''];
	$trainer_designation =$b['trainer_designation'.$c.''];
	$trainer_img_url =$b['trainer_img_url'.$c.''];
	$trainer_link_url =$b['trainer_link_url'.$c.''];
	$trainer_phone =$b['trainer_phone'.$c.''];
	$trainer_email =$b['trainer_email'.$c.''];
	$trainer_fb_url =$b['trainer_fb_url'.$c.''];
	$trainer_twitter_url =$b['trainer_twitter_url'.$c.''];
	$trainer_linkedin_url =$b['trainer_linkedin_url'.$c.''];
	$trainer_pinterest_url =$b['trainer_pinterest_url'.$c.''];	
						if($trainer_img_url){$output.='
						<article class="team-item-2" ';if($box_margin_top || $box_margin_bottom){$output.='style="';if($box_margin_top){$output.='margin-top:'.esc_attr($box_margin_top).';';}if($box_margin_bottom){$output.='margin-bottom:'.esc_attr($box_margin_bottom).'';} $output.='"';}$output.='>
						<div ';if($border_c || $box_bg_color){$output.='style="';if($border_c){$output.='border:1px solid '.esc_attr($border_c).';';}if($box_bg_color){$output.='background-color: '.esc_attr($box_bg_color).'';}$output.='"';}$output.='>
						';if($trainer_img_url){$output.='
							
							<div class="thumbnail animate-zoom">
								<a href="'.esc_url($trainer_link_url).'">
									<img src="'.esc_url($trainer_img_url).'" alt="'.esc_attr('trainer-profile-image').'">
								</a>
							<div class="member-socials display-none">
								<ul>
								';if($trainer_fb_url){$output.='
									<li>
										<a href="'.esc_url($trainer_fb_url).'">
											<i class="fab fa-facebook-f"></i>
										</a>
									</li>
								';}$output.='
								';if($trainer_twitter_url){$output.='
									<li>
										<a href="'.esc_url($trainer_twitter_url).'">
											<i class="fab fa-twitter"></i>
										</a>
									</li>
								';}$output.='
								';if($trainer_linkedin_url){$output.='
									<li>
										<a href="'.esc_url($trainer_linkedin_url).'">
											<i class="fab fa-linkedin-in"></i>
										</a>
									</li>
								';}$output.='
								';if($trainer_pinterest_url){$output.='
									<li>
										<a href="'.esc_url($trainer_pinterest_url).'">
											<i class="fab fa-pinterest-p"></i>
										</a>
									</li>
								';}$output.='	
								</ul>							
							</div>								
							</div>
							
						';}$output.='
						
							<div class="shadow-brdr rnd-pd">
							';if($trainer_name){$output.='
							<a href="'.esc_url($trainer_link_url).'">
								<h3 class="member-name" ';if($trainer_name_color){$output.='style="color:'.esc_attr($trainer_name_color).'"';}$output.='>
									'.esc_attr($trainer_name).'
								</h3>
							</a>
							';}$output.='
							';if($trainer_designation){$output.='
							<div class="member-role color-primary mb-2" ';if($trainer_designation_color){$output.='style="color:'.esc_attr($trainer_designation_color).'"';}$output.='>
								'.esc_attr($trainer_designation).'
							</div>
							';}$output.='
							';if($trainer_phone){$output.='
							<div class="member-role color-primary text-left mb-2 pl-4" ';if($trainer_phone_color || $icon_p_left){$output.='style="';if($trainer_phone_color){$output.='color:'.esc_attr($trainer_phone_color).';';}if($icon_p_left){$output.='padding-left:'.esc_attr($icon_p_left).' !important';}$output.='"';}$output.='>
								<i class="fas fa-phone-volume mr-2" ';if($trainer_icon_color){$output.='style="color:'.esc_attr($trainer_icon_color).'"';}$output.='></i> '.esc_attr($trainer_phone).'
							</div>
							';}$output.='	
							';if($trainer_email){$output.='
							<div class="member-role color-primary text-left mb-4 pl-4" ';if($trainer_email_color || $icon_p_left){$output.='style="';if($trainer_email_color){$output.='color:'.esc_attr($trainer_email_color).';';}if($icon_p_left){$output.='padding-left:'.esc_attr($icon_p_left).' !important';}$output.='"';}$output.='>
								<i class="far fa-envelope mr-2" ';if($trainer_icon_color){$output.='style="color:'.esc_attr($trainer_icon_color).'"';}$output.='></i> '.esc_attr($trainer_email).'
							</div>
							';}$output.='
							</div>
						</div>	
						</article>
						';}	
$i++;
}
						
			$output.='</div>
				</div>
			</section>';

$output.='<script>
jQuery(document).ready(function() {
    jQuery(".fitness-section-teams .team-item-2 .thumbnail").hover(function() {
        jQuery(this).find(".member-socials").show(500);
    }, function() {
        jQuery(this).find(".member-socials").hide(500);
    });
});

</script>';
			
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_trainers_profile', 'ronby_fitness_trainers_profile_shortcode');


/*****************************
Fitness Blog Section
******************************/
//Function for Fitness Blog Section
function ronby_fitness_blog_section_shortcode( $atts ) {
    extract(shortcode_atts(array(
    'multiple'   => '',
    'num_post'   => '-1',
    'character'  => '100',
    'order'      => 'desc',
    'orderby'    => 'post_date',
    ), $atts));

	$args = array(
			'posts_per_page'   => $num_post ,
			'cat' => $multiple,
			'order' => $order,
			'orderby' => $orderby,

			'post_status'      => 'publish',
			);
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);	

	$output ='<section class="ronby-fitness-blog-section"><div class="container">'; 
	$counter = 1;
	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id() );
	if(($counter % 3 == 1) || ($counter == 1)) { 
	$output.='<div class="row">
			  <div class="col-lg-8">';
	} 	
	if(($counter % 3 == 1) || ($counter == 1)) {
	$output.='<article class="blog-post-item-4 thumb-left-style"  id="post-'. get_the_ID().'">
                        <div class="row">';
                           if($get_image){ $output.='
						   <div class="col-md-6">
                              <div class="thumbnail animate-zoom">
                                 <a href="'.esc_url(get_the_permalink()).'">
                                    <div class="blog-p-f-img h-280" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
                                 </a>
                              </div>
                           </div>';
						   } $output.='
                           <div class="';if($get_image){ $output.='col-md-6'; } else { $output.='col-md-12'; } $output.='">
                              <div class="item-content">
                                 <div class="mb-3">';
									//check if post date meta switch in wordpress format is turned on 
									if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){
									if(function_exists('fitness_blog_section_wp_date_meta')){	
									$output.=fitness_blog_section_wp_date_meta(); 
									}
                                    // end wordpress format post date meta
									}
                                    else{  
									if(function_exists('fitness_blog_section_theme_date_meta')){
                                    $output.=fitness_blog_section_theme_date_meta();
									}									
                                     } 									 
                                    // end post date meta
                                      
                            $output.='</div>
                                 <a href="'.esc_url(get_the_permalink()).'">
                                    <h3 class="post-title animate-300 hover-color-primary">'.esc_attr(get_the_title()).'</h3>
                                 </a>
                                 <p class="post-excerpt">';
                                    if ( has_post_format( 'video' ) ) : 
                                    $output.= ronby_content($character); 
                                    else: 
                                    $output.= ronby_excerpt($character);
                                    endif;
                            $output.='</p>
                                 <div class="d-flex justify-content-between align-items-center">
                                    <div class="post-stats">';
									//post Views meta 
                                     if(function_exists('get_post_views'))$output.= get_post_views(get_the_ID()); 
									 //post comments meta
                                     if(function_exists('fitness_blog_section_comments_meta')){
									 $output.= fitness_blog_section_comments_meta($postid); 
									 }					
                                    $output.='</div>
                                    <a href="'.esc_url(get_the_permalink()).'" class="d-none d-xl-inline-block read-more button button-secondary rounded-capsule">'.esc_html__('Read more','ronby').'
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </article>';	
	}elseif(($counter % 3 == 2) || ($counter == 2)) {
		$output.='<article class="blog-post-item-4 thumb-right-style"  id="post-'. get_the_ID().'">
                        <div class="row">';
                           if($get_image){ $output.='
						   <div class="col-md-6 order-lg-last">
                              <div class="thumbnail animate-zoom">
                                 <a href="'.esc_url(get_the_permalink()).'">
                                    <div class="blog-p-f-img h-280" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
                                 </a>
                              </div>
                           </div>';
						   } $output.='
                           <div class="';if($get_image){ $output.='col-md-6 order-lg-first'; } else { $output.='col-md-12 order-lg-first'; } $output.='">
                              <div class="item-content">
                                 <div class="mb-3">';
									//check if post date meta switch in wordpress format is turned on 
									if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){
									if(function_exists('fitness_blog_section_wp_date_meta')){	
									$output.=fitness_blog_section_wp_date_meta(); 
									}
                                    // end wordpress format post date meta
									}
                                    else{  
									if(function_exists('fitness_blog_section_theme_date_meta')){
                                    $output.=fitness_blog_section_theme_date_meta();
									}									
                                     } 									 
                                    // end post date meta
                                      
                            $output.='</div>
                                 <a href="'.esc_url(get_the_permalink()).'">
                                    <h3 class="post-title animate-300 hover-color-primary">'.esc_attr(get_the_title()).'</h3>
                                 </a>
                                 <p class="post-excerpt">';
                                    if ( has_post_format( 'video' ) ) : 
                                    $output.= ronby_content($character); 
                                    else: 
                                    $output.= ronby_excerpt($character);
                                    endif;
                            $output.='</p>
                                 <div class="d-flex justify-content-between align-items-center">
                                    <div class="post-stats">';
									//post Views meta 
                                     if(function_exists('get_post_views'))$output.= get_post_views(get_the_ID()); 
									 //post comments meta
                                     if(function_exists('fitness_blog_section_comments_meta')){
									 $output.= fitness_blog_section_comments_meta($postid); 
									 }					
                                    $output.='</div>
                                    <a href="'.esc_url(get_the_permalink()).'" class="d-none d-xl-inline-block read-more button button-secondary rounded-capsule">'.esc_html__('Read more','ronby').'
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </article>';
	}
	if(($counter % 3 == 2) || ($counter == 2)) {
		$output.='</div><!--End col-lg-8-->';
	}
	if($counter % 3 == 0) {
		$output.='<div class="col-lg-4">
					<article class="blog-post-item-4 thumb-top-style text-lg-center"  id="post-'. get_the_ID().'">
									<div class="row">';
                           if($get_image){ $output.='
						   <div class="col-md-6 col-lg-12">
                              <div class="thumbnail animate-zoom">
                                 <a href="'.esc_url(get_the_permalink()).'">
                                    <div class="blog-p-f-img h-280" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
                                 </a>
                              </div>
                           </div>';
						   } $output.='
                           <div class="';if($get_image){ $output.='col-md-6 col-lg-12'; } else { $output.='col-md-6 col-lg-12'; } $output.='">
                              <div class="item-content">
                                 <div class="mb-3">';
									//check if post date meta switch in wordpress format is turned on 
									if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){
									if(function_exists('fitness_blog_section_wp_date_meta')){	
									$output.=fitness_blog_section_wp_date_meta(); 
									}
                                    // end wordpress format post date meta
									}
                                    else{  
									if(function_exists('fitness_blog_section_theme_date_meta')){
                                    $output.=fitness_blog_section_theme_date_meta();
									}									
                                     } 									 
                                    // end post date meta
                                      
                            $output.='</div>
                                 <a href="'.esc_url(get_the_permalink()).'">
                                    <h3 class="post-title animate-300 hover-color-primary">'.esc_attr(get_the_title()).'</h3>
                                 </a>
                                 <p class="post-excerpt">';
                                    if ( has_post_format( 'video' ) ) : 
                                    $output.= ronby_content($character); 
                                    else: 
                                    $output.= ronby_excerpt($character);
                                    endif;
                            $output.='</p>
                                 <div class="d-flex justify-content-between align-items-center">
                                    <div class="post-stats">';
									//post Views meta 
                                     if(function_exists('get_post_views'))$output.= get_post_views(get_the_ID()); 
									 //post comments meta
                                     if(function_exists('fitness_blog_section_comments_meta')){
									 $output.= fitness_blog_section_comments_meta($postid); 
									 }					
                                    $output.='</div>
                                    <a href="'.esc_url(get_the_permalink()).'" class="d-none d-xl-inline-block read-more button button-secondary rounded-capsule">'.esc_html__('Read more','ronby').'
                                    </a>
                                 </div>
                              </div>
                           </div>
									</div>
								</article>										
				  </div> <!--End col-lg-4-->
				</div> <!--End row-->';	
	}


    $counter++;
	endwhile;endif;	
	if($counter % 3 == 0) {
		$output.='</div><!--End row without 3rd col-->';
	}
	if(($counter % 3 == 2) || ($counter == 2)) {
		$output.='</div><!--End row without 2nd col-->
				</div><!--End col-lg-8 without 2nd col-->';
	}
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();
	$output .='</div></section>';
	
return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_blog_section', 'ronby_fitness_blog_section_shortcode');

/*****************************
Fitness Brand Slider Section
******************************/
//Function for Fitness Brand Slider Section
function ronby_fitness_brand_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'background_color'   => '',
    'up_arrow_icon'   => '',
    'padding_top'   => '',
    'padding_bottom'   => '',
	), $atts ) );
	
	$slider_images = shortcode_atts(
    array(
        'images'      =>  'images',
    ), $atts );	
	$image_ids = explode(',',$slider_images['images']);

	
	$output='<section class="section-brands-carousel-2 fitness-section-brands-carousel-2 ';if($up_arrow_icon == 'style1'){$output.='before-arrow-1 row-xtra-space';}elseif($up_arrow_icon == 'style2'){$output.='before-arrow-2 row-xtra-space';}elseif($up_arrow_icon == 'style3'){$output.='before-arrow-3 row-xtra-space';}elseif($up_arrow_icon == 'style4'){$output.='before-arrow-4 row-xtra-space';}$output.='" ';if($background_color || $padding_top || $padding_bottom){$output.='style="';if($background_color){$output.='background-color:'.esc_attr($background_color).';';}if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
			<div class="container">
				<div class="brand-carousel-slider owl-carousel">';
	$c=0;			
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'images' );
					
	$output.='<div class="item">
				<img src="'.esc_url($images[$c]).'" alt="'.esc_attr('slider-image').'">
			</div>';
	}$c++;
	$output.='</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_brand_slider', 'ronby_fitness_brand_slider_shortcode');

/*****************************
Fitness Class Details
******************************/
//Function for Fitness Class Details
function ronby_fitness_class_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'price'   => '',
    'price_duration'   => '',
    'instructor_name'   => '',
    'class_title'   => '',
	'start_date' => '',
	'start_time' => '',
	'description' => '',
	'btn_label' => '',	
	'btn_url' => '',	
	'list_heading' => '',	
	'list_items' => '',	
	'short_description' => '',	
	'instructor_name_color' => '',
	'class_title_color' => '',
	'start_date_color' => '',
	'start_date_info_color' => '',
	'price_bg_color' => '',		
	'btn_background_color' => '',	
	'btn_text_color' => '',	
	), $atts ) );
	if($list_items){
      $list_item_result = '<ul class="list-style-4">';
      $list_items = $list_items ? explode("\n", trim($list_items)) : array();

	  $c=-1;
      foreach($list_items as $list_item) {
	  $c++;
	  $list_item_result .='<li class="before-color-primary">'.htmlspecialchars_decode($list_item).'</li>';
      }
      $list_item_result .= '</ul>';
      $content = $list_item_result;
    }	
	$gallery = shortcode_atts(
    array(
        'image'      =>  'image',
    ), $atts );	
	$image_ids = explode(',',$gallery['image']);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}
	
	$output='<section class="class-detail p-30-0-30">
				<div class="container">
					<div class="mx-auto mx-width-970">
						<div class="class-detail-header">';
						if($images[0]){ $output.='
							<div class="feature-image">
								<img src="'.esc_url($images[0]).'" alt="'.esc_attr('featured-image').'">
							</div>
						';}$output.='	
							<div class="class-infomation">
								<div class="row align-items-center">
									<div class="col-md-8">
										<div class="d-flex flex-wrap align-items-center">
										';if($price || $price_duration){$output.='
											<div class="class-price d-flex flex-column justify-content-center align-items-center" ';if($price_bg_color){$output.='style="background-color:'.esc_attr($price_bg_color).'"';}$output.='>
											';if($price){$output.='
												<div class="price-number">'.esc_attr($price).'</div>
											';}$output.='	
											';if($price_duration){$output.='
												<div class="price-text">'.esc_attr($price_duration).'</div>
											';}$output.='	
											</div>
											';}$output.='
											<div>
											';if($instructor_name){$output.='
												<div class="class-description" ';if($instructor_name_color){$output.='style="color:'.esc_attr($instructor_name_color).'"';}$output.='>
													'.esc_attr($instructor_name).'
												</div>
											';}$output.='
											';if($class_title){$output.='
												<h2 class="class-title" ';if($class_title_color){$output.='style="color:'.esc_attr($class_title_color).'"';}$output.='>
													'.esc_attr($class_title).'
												</h2>
											';}$output.='	
									';if($start_date || $start_time){ $output.='
									<div class="class-schedule">
										<span class="mr-2"><span class="color-primary" ';if($start_date_color){$output.='style="color:'.esc_attr($start_date_color).'"';}$output.='>'.esc_attr__('Start Date:','ronby').'</span><span ';if($start_date_info_color){$output.='style="color:'.esc_attr($start_date_info_color).'"';}$output.='> '.esc_attr($start_date).'</span></span> <span ';if($start_date_info_color){$output.='style="color:'.esc_attr($start_date_info_color).'"';}$output.='>-</span> <span class="ml-2" ';if($start_date_info_color){$output.='style="color:'.esc_attr($start_date_info_color).'"';}$output.='>'.esc_attr($start_time).'</span>
									</div>
									';} $output.='
											</div>
										</div>
									</div>
									';if($btn_label){$output.='
									<div class="col-md-4 text-right">
										<a href="'.esc_url($btn_url).'" class="button button-secondary rounded-capsule" ';if($btn_background_color || $btn_text_color){$output.='style="';if($btn_background_color){$output.='background-color:'.esc_attr($btn_background_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
									</div>
									';} $output.='
								</div>
							</div>
						</div>
						';if($description || $list_heading || $list_items || $short_description){$output.='
						<div class="class-detail-content fitness-singular-post-content">
						'.$description.'
						';if($list_heading){$output.='
							<h3 class="my-4 font-weight-bold font-s-24">
								'.esc_attr($list_heading).'
							</h3>
						';} $output.='	
						';if($list_items){$output.='
							'.$content.'
						';} $output.='
						'.$short_description.'						
						</div>
						';}$output.='
					</div>
				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_class_details', 'ronby_fitness_class_details_shortcode');

/*****************************
Fitness Contact Info
******************************/
//Function for Fitness Contact Info
function ronby_fitness_contact_info_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'headline'   => '',
    'short_description'   => '',
    'facebook_url'   => '',
    'twitter_url'   => '',
    'linkedin_url'   => '',
    'pinterest_url'   => '',
    'email'   => '',
    'phone'   => '',
    'fax'   => '',
    'address'   => '',
    'headline_color'   => '',
    'short_description_color'   => '',
    'information_title_color'   => '',
    'information_details_color'   => '',
	'map_address' 		 => '',
	'map_height' 		 => '480px',	
	), $atts ) );

$map_address_f=str_replace(" ","+",$map_address);
	
	$output='<section class="fitness-contact-info-box p-30-0-30 ovf-hidden">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-xl-10">
					<div class="position-relative mb-5">
					';if($map_address){$output.='
						<div class="google-map">
							<iframe style="width:100%;height:'.esc_attr($map_height).';" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url('https://maps.google.it/maps?q=='.$map_address_f).'=&output=embed"></iframe>
						</div>
					';}$output.='	
						<div class="contact-infomation-box-5">
						';if($headline){$output.='
							<h2 class="box-title" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>'.esc_attr($headline).'</h2>
						';}$output.='	
							<div class="row">
								<div class="col-lg-7 mb-5 mb-lg-0">
								';if($short_description){$output.='
									<p ';if($short_description_color){$output.='style="color:'.esc_attr($short_description_color).'"';}$output.='>
										'.esc_attr($short_description).'
									</p>
								';}$output.='	
									<div class="contact-social social-10">
										<ul class="no-style items-inline-block">
										';if($facebook_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($facebook_url).'">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
										';}$output.='
										';if($twitter_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($twitter_url).'">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
										';}$output.='
										';if($linkedin_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($linkedin_url).'">
													<i class="fab fa-linkedin-in"></i>
												</a>
											</li>
										';}$output.='
										';if($pinterest_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($pinterest_url).'">
													<i class="fab fa-pinterest-p"></i>
												</a>
											</li>
										';}$output.='	
										</ul>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="contact-info-list">
									';if($email){$output.='
										<div class="mb-2">
											<span class="color-primary" ';if($information_title_color){$output.='style="color:'.esc_attr($information_title_color).'"';}$output.='>'.esc_attr('Email:').'</span> <span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($email).'</span>
										</div>
									';}$output.='
									';if($phone){$output.='
										<div class="mb-2">
											<span class="color-primary" ';if($information_title_color){$output.='style="color:'.esc_attr($information_title_color).'"';}$output.='>'.esc_attr('Phone:').' </span> <span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($phone).'</span>
										</div>
									';}$output.='	
									';if($fax){$output.='
										<div class="mb-2">
											<span class="color-primary" ';if($information_title_color){$output.='style="color:'.esc_attr($information_title_color).'"';}$output.='>'.esc_attr('Fax:').'</span> <span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($fax).'</span>
										</div>
									';}$output.='
									';if($address){$output.='
										<p class="m-30-0-0">
										 	<span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($address).'</span>
										</p>
									';}$output.='	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_contact_info', 'ronby_fitness_contact_info_shortcode');

/*****************************
Fitness Contact Form
******************************/
//Function for Fitness Contact Form
function ronby_fitness_contact_form_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'headline_one'   => '',
    'headline_two'   => '',
    'headline_one_color'   => '',
    'headline_two_color'   => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
	
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Your name *',
	'email_field_placeholder' => 'Your email *',
	'problem_field_placeholder' => 'Your problem',
	'message_field_placeholder' => 'Your Message *',
	'button_label' => 'Send Message',

	'wanttoselect' => 'no',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',
	'wanttoradio' => 'no',
	'yourradio' => 'Select Radio',
	'radioitems' => 'One, Two, Three, Four, Five',
	'wanttocheckbox' => 'no',
	'yourcheckbox' => 'Select Checkbox',
	'checkboxitems' => 'One, Two, Three, Four, Five',	
	), $atts ) );
	
	$output='<section class="fitness-contact-form p-30-0-30">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-xl-10">
				';if($headline_one || $headline_two){$output.='
					<div class="section-header-style-13 text-center">
					';if($headline_one){$output.='
						<h4 class="section-sub-title" ';if($headline_one_color){$output.='style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($headline_one).'</h4>
					';}$output.='	
					';if($headline_two){$output.='
						<h2 class="section-title" ';if($headline_two_color){$output.='style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.esc_attr($headline_two).'</h2>
					';}$output.='	
					</div>
				';}$output.='	
					<div class="contact-form pb-70">
						<form  method="POST" id="fitness_contact_form">
							<div class="row align-items-center">
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="text" name="name" id="sendername" placeholder="'.esc_attr($name_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="email" name="email" id="senderemail" placeholder="'.esc_attr($email_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="text" name="contact_issue" id="senderproblem" placeholder="'.esc_attr($problem_field_placeholder).'">
									</div>
								</div>
								'; if($wanttoselect=="yes"){
								$output .= '<div class="col-lg-12">
										<div class="form-group">                               
										<select class="input-styled" name="cf-select" id="cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}

								$output .= '</select>
											</div>
											</div>';
								} $output .='	
						'; if($wanttoradio=="yes"){
						$output .= '<div class="col-lg-12">
									<div class="form-group">
									<label class="lable-text" for="cf-radio">'.esc_attr($yourradio).'</label><br>';
									$radioitemArray = explode(',', $radioitems);
									$i=1;
									foreach($radioitemArray as $radioitem){
										$output .= '<span class="mr-10"><input class="control-radio mr-10" type="radio" name="cf-radio" value="'.$radioitem.'"  id="cf-radio'.$i.'">'.$radioitem.'</span>';
										$i++;
									}
						$output .='</div></div>';
						} $output .='
						';if($wanttocheckbox=="yes"){
						$output .=  '<div class="col-lg-12">
									<div class="form-group">
						 <label class="lable-text" for="cf-checkbox">'.esc_attr($yourcheckbox).'</label><br>';
						 $checkboxitemArray = explode(',', $checkboxitems);
						 $i=1;
							foreach($checkboxitemArray as $checkboxitem){
									$output .=  '<span class="mr-10"><input type="checkbox" class="control-checkbox mr-10" name="cf-checkbox[]" value="'.$checkboxitem.'"  id="cf-checkbox'.$i.'">'.$checkboxitem.'</span>';
									$i++;
							}

						$output .='</div></div>';
						} $output .='</div>					
							<div class="form-group">
								<textarea class="input-styled" name="message" id="sendermessage" rows="10" placeholder="'.esc_attr($message_field_placeholder).'" required></textarea>
							</div>
							<div class="form-group py-15px text-center">
								<button class="button rounded-capsule comment-submit" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>
								
							</div>
							<div class="col-lg-12">
							<div class="alert alert-success display-none" id="success-msg">
							<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
							</div>	
							<div class="alert alert-danger display-none" id="failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
							</div>
							
  					<input type="hidden" name="email_subject" id="email_subject" value="'.esc_attr($email_subject).'" />
  					<input type="hidden" name="recipient_name" id="recipient_name" value="'.esc_attr($recipient_name).'" />
					<input type="hidden" name="recipient_email" id="recipient_email" value="'.sanitize_email($recipient_email).'" />
					
						</form>
					</div>
				</div>
			</div>			
		</div>	
		</section>';
		
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#fitness_contact_form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#sendername").val();
                    var email = jQuery("#senderemail").val();
                    var problem = jQuery("#senderproblem").val();
                    var message = jQuery("#sendermessage").val();
                    var recipient_email = jQuery("#recipient_email").val();
                    var recipient_name = jQuery("#recipient_name").val();
                    var email_subject = jQuery("#email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";					
						var select = jQuery("#cf-select").val();
					'; } $output.='	
					
					'; if($wanttoradio=="yes"){ $output .= '				
						var radio = jQuery("input[name=cf-radio]:checked").val();
						var radio_title = "'.esc_attr($yourradio).'";
					'; } $output.='	
					
					';if($wanttocheckbox=="yes"){ $output .=  '				
						var checkbox_title = "'.esc_attr($yourcheckbox).'";
						var checkArray = [];					
						jQuery(".control-checkbox:checked").each(function(i,e) {
							checkArray.push(jQuery(this).val());
						});
					'; } $output.='						
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'ronby-contact-form.php",
                        data: {name: name,email:email,message:message,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; }  if($wanttoradio=="yes"){ $output .= 'radio_title:radio_title,radio:radio,'; } if($wanttocheckbox=="yes"){ $output .= 'checkbox_title:checkbox_title,"checkbox[]":checkArray.join(),'; } $output.='problem:problem},
						complete: function(){
							jQuery("#fitness_contact_form")[0].reset();
							jQuery(".contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_fitness_contact_form', 'ronby_fitness_contact_form_shortcode');

/*****************************
Page Header Section
******************************/
//Function for Page Header Section
function ronby_page_header_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'padding_top' => '',
	'padding_bottom' => '',
	'page_header_style' => '1',
	'page_breadcrumb_switch' => '1',
	'overlay_color' => '1',
	), $atts ) );
	
$ronby_global_post = ronby_get_global_post();
if( !(is_404()) && !(is_search())  && (class_exists('woocommerce')) && !(is_shop()) && !(is_product())){
$postid = $ronby_global_post->ID;	
// Retrieves the stored value from the database
$ronby_page_heading_one_meta = get_post_meta( $postid, 'ronby_page_heading_one', true );
$ronby_page_heading_two_meta = get_post_meta( $postid, 'ronby_page_heading_two', true );
}

$gallery = shortcode_atts(
array(
	'bg_image'      =>  'bg_image',
), $atts );	
$image_ids = explode(',',$gallery['bg_image']);
foreach( $image_ids as $image_id ){
$images = wp_get_attachment_image_src( $image_id, 'bg_image' );
}

$output='<section class="ronby-page-header-section">';
if($page_header_style == '1'){ 
  $output.='<div class="page-header-1 row-xtra-space" id="page-header" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).')"';}$output.='>
    <div class="overlay" ';if($overlay_color){$output.='style="background-color:'.esc_attr($overlay_color).'"';}$output.='>       
      <div class="container">
        <div class="inner-content d-flex flex-column justify-content-center" ';if($padding_top || $padding_bottom){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.='"';}$output.='>
		
		';if(is_front_page()){ $output.='
		
		    <h1 class="page-header-title 1">
			'.esc_attr(get_bloginfo('name')).'
			</h1>
			<h4 class="page-header-sub-title color-primary">
			'.esc_attr(get_bloginfo('description')).'
			</h4>
			
		'; }elseif(is_home() ){ $output.='

		'; if(!empty(ronby_get_option('blog_page_header_sec_title_one'))) { $output.='
		
          <h1 class="page-header-title 2">'.esc_attr(ronby_get_option('blog_page_header_sec_title_one')).'</h1>
		  
		'; }else{ $output.='
		
		  <h1 class="page-header-title 3">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; if(!empty(ronby_get_option('blog_page_header_sec_title_two'))) { $output.='	
		
          <h4 class="page-header-sub-title color-primary 4">
		  '.esc_attr(ronby_get_option('blog_page_header_sec_title_two')).'
		  </h4>
		  
		'; } $output.='
		
		'; }elseif(is_page() ){ $output.='
		
		'; if(!empty($ronby_page_heading_one_meta)) { $output.='
		
          <h1 class="page-header-title 5">'.esc_attr($ronby_page_heading_one_meta).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; if(!empty($ronby_page_heading_two_meta)) { $output.='	
		
          <h4 class="page-header-sub-title color-primary">
		  '.esc_attr($ronby_page_heading_two_meta).'
		  </h4>
		  
		'; } $output.='	
		
		'; }elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ $output.='
		
		<h1 class="page-header-title 7">';if(ronby_get_option('blog_post_header_sec_title_one')){$output.=esc_attr(ronby_get_option('blog_post_header_sec_title_one'));}else{$output.=esc_attr__('Blog Detail','ronby');}$output.='</h1>
		'; if(ronby_get_option('blog_post_header_sec_title_two')){ $output.='
		<h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_post_header_sec_title_two')).'
		</h4>
		'; } $output.='
		
		'; }elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(( is_post_type_archive( 'product' ) ) && !(is_product_category()) && !(is_product_taxonomy()))) { $output.='

		<h1 class="page-header-title 8">'.esc_html__('Post from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		
		
		'; }elseif(is_category() ) { $output.='
		
		<h1 class="page-header-title 9">'.esc_html__('Post from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(single_cat_title()).'
		</h4>		
		
		'; }elseif(is_search()) { $output.='	
		
		<h1 class="page-header-title 11">'.esc_attr__('Search','ronby').'</h1>		
		
		<h4 class="page-header-sub-title">
		  '.esc_html__('Search Results for: ','ronby').''.esc_attr(the_search_query()).'
		</h4>
		
		';}elseif(is_author() ) { $output.='		
		
		<h1 class="page-header-title 10">';if(!empty(get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){$output.= esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));}else{$output.= get_the_author_meta('display_name');} $output.='</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr__('Author','ronby').'
		</h4>		
		
		';}elseif(is_404() || is_page_template('404.php') && !(is_search())) {$output.='

		<h1 class="page-header-title">'.esc_html__('404 Error!','ronby').'</h1>	
		<a class="btn btn-primary btn-404" href="'.esc_url( home_url() ).'">'.esc_attr__('Take Me Home', 'ronby').'</a>	
		
		'; }elseif(class_exists('woocommerce') && is_shop()){ $output.='
		
		<h1 class="page-header-title">';if(ronby_get_option('ronby_shop_page_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));}else{ esc_html_e('Shop','ronby');} $output.='</h1>
		
		';if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')).'
		</h4>
		
		'; } $output.='		
		'; }elseif(class_exists('woocommerce') && is_product()){  $output.='
		
		<h1 class="page-header-title">'; if(ronby_get_option('ronby_single_product_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));}else{$output.= esc_html__('PRODUCT DETAIL','ronby');} $output.='</h1>
	
		'; if(ronby_get_option('ronby_single_product_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')).'
		</h4>	
		
		'; }  $output.='
		'; }elseif(class_exists('woocommerce') && is_product_category()){  $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }elseif(class_exists('woocommerce') && is_product_taxonomy()){   $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }  $output.='
		
		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='
		
        </div>          
      </div>
    </div>      
  </div>
'; }elseif($page_header_style == '2'){ $output.='
		<div class="page-header-2 row-xtra-space" id="page-header" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).')"';}$output.='>
			<div class="overlay" ';if($overlay_color){$output.='style="background-color:'.esc_attr($overlay_color).'"';}$output.='>
				<div class="container">
					<div class="page-header-inner" ';if($padding_top || $padding_bottom){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.='"';}$output.='>

		';if(is_front_page()){ $output.='
		
		    <h1 class="page-header-title">
			'.esc_attr(get_bloginfo('name')).'
			</h1>
			<h4 class="page-header-sub-title">
			'.esc_attr(get_bloginfo('description')).'
			</h4>
			
		'; }elseif(is_home()){ $output.='

		'; if(!empty(ronby_get_option('blog_page_header_sec_title_one'))) { $output.='
		
          <h1 class="page-header-title">'.esc_attr(ronby_get_option('blog_page_header_sec_title_one')).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; if(!empty(ronby_get_option('blog_page_header_sec_title_two'))) { $output.='	
		
          <h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_page_header_sec_title_two')).'
		  </h4>
		  
		'; } $output.='
		
		'; }elseif(is_page()){ $output.='
		
		'; if(!empty($ronby_page_heading_one_meta)) { $output.='
		
          <h1 class="page-header-title">'.esc_attr($ronby_page_heading_one_meta).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		';if(!empty($ronby_page_heading_two_meta)) { $output.='	
		
          <h4 class="page-header-sub-title">
		  '.esc_attr($ronby_page_heading_two_meta).'
		  </h4>
		  
		'; } $output.='	
		
		'; }elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ $output.='

		<h1 class="page-header-title">';if(ronby_get_option('blog_post_header_sec_title_one')){$output.= esc_attr(ronby_get_option('blog_post_header_sec_title_one'));}else{$output.= esc_attr__('Blog Detail','ronby');}$output.='</h1>
		';if(ronby_get_option('blog_post_header_sec_title_two')){$output.='
		<h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_post_header_sec_title_two')).'
		</h4>
		'; } $output.='
		
		'; }elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) &&!(is_product_taxonomy()) && !(is_product_category())) { $output.='

		<h1 class="page-header-title">'.esc_html__('Post from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		
		
		'; }elseif(is_category() ) { $output.='
		
		<h1 class="page-header-title">'.esc_html__('Post from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(single_cat_title()).'
		</h4>		
		
		'; }elseif(is_search()) { $output.='	
		
		<h1 class="page-header-title">'.esc_attr__('Search','ronby').'</h1>		
		
		<h4 class="page-header-sub-title">
		  '.esc_html__('Search Results for: ','ronby').''.esc_attr(the_search_query()).'
		</h4>
		
		'; }elseif(is_author()) { $output.='	
		
		<h1 class="page-header-title 10">';if(!empty(get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){$output.= esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));}else{$output.= get_the_author_meta('display_name');} $output.='</h1>

		<h4 class="page-header-sub-title">
		  '.esc_attr__('Author','ronby').'
		</h4>		
		
		'; }elseif(is_404() || is_page_template('404.php')) { $output.='

		<h1 class="page-header-title">'.esc_html__('404 Error!','ronby').'</h1>	
		<a class="btn btn-primary btn-404" href="'.esc_url( home_url() ).'">'. esc_attr__('Take Me Home', 'ronby').'</a>
		
		'; }elseif(class_exists('woocommerce') && is_shop()){ $output.='
		
		<h1 class="page-header-title'; if(ronby_get_option('ronby_shop_page_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));}else{ esc_html__('Shop','ronby');} $output.='</h1>
		
		'; if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')).'
		</h4>
		
		'; } $output.='	
		'; }elseif(class_exists('woocommerce') && is_product()){  $output.='
		
		<h1 class="page-header-title">'; if(ronby_get_option('ronby_single_product_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));}else{ $output.= esc_html__('PRODUCT DETAIL','ronby');} $output.='</h1>
	
		'; if(ronby_get_option('ronby_single_product_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')).'
		</h4>	
		
		'; }  $output.='
		'; }elseif(class_exists('woocommerce') && is_product_category()){  $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }elseif(class_exists('woocommerce') && is_product_taxonomy()){ $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }  $output.='
		
		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='						
						
					</div>
				</div>		
			</div>				
		</div>';	
}elseif($page_header_style == '3'){ $output.='
				<div class="page-header-3 pb-0 pt-0" id="page-header" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).');background-size:cover"';}$output.='>
				<div class="overlay" ';if($padding_top || $padding_bottom || $overlay_color){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.=';';if($overlay_color){$output.='background-color:'.esc_attr($overlay_color).'';}$output.='"';}$output.='>
					<div class="container">
						<div class="inner-content">						

		'; if(is_front_page()){ $output.='
		
		    <h1 class="page-header-title">
			'.esc_attr(get_bloginfo('name')).'
			</h1>
			<h4 class="page-header-sub-title">
			'.esc_attr(get_bloginfo('description')).'
			</h4>
			
		'; }elseif(is_home()){ $output.='

		'; if(!empty(ronby_get_option('blog_page_header_sec_title_one'))) { $output.='
		
          <h1 class="page-header-title">'.esc_attr(ronby_get_option('blog_page_header_sec_title_one')).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; if(!empty(ronby_get_option('blog_page_header_sec_title_two'))) { $output.='	
		
          <h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_page_header_sec_title_two')).'
		  </h4>
		  
		'; } $output.='
		
		'; }elseif(is_page()){ $output.='
		
		'; if(!empty($ronby_page_heading_one_meta)) { $output.='
		
          <h1 class="page-header-title">'.esc_attr($ronby_page_heading_one_meta).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; if(!empty($ronby_page_heading_two_meta)) { $output.='	
		
          <h4 class="page-header-sub-title">
		  '.esc_attr($ronby_page_heading_two_meta).'
		  </h4>
		  
		'; } $output.='		
		
		'; }elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ $output.='
		
		<h1 class="page-header-title 7">';if(ronby_get_option('blog_post_header_sec_title_one')){$output.= esc_attr(ronby_get_option('blog_post_header_sec_title_one'));}else{$output.= esc_attr__('Blog Detail','ronby');}$output.='</h1>
		'; if(ronby_get_option('blog_post_header_sec_title_two')){$output.='
		<h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_post_header_sec_title_two')).'
		</h4>
		'; } $output.='
		
		'; }elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy())) { $output.='

		<h1 class="page-header-title">'.esc_html__('Post from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		
		
		'; }elseif(is_category() ) { $output.='
		
		<h1 class="page-header-title">'.esc_html__('Post from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(single_cat_title()).'
		</h4>		
		
		'; }elseif(is_search()) { $output.='	
		
		<h1 class="page-header-title">'.esc_attr__('Search','ronby').'</h1>		
		
		<h4 class="page-header-sub-title">
		  '.esc_html__('Search Results for: ','ronby').''.esc_attr(the_search_query()).'
		</h4>
		
		'; }elseif(is_author()) {$output.='		
		
		<h1 class="page-header-title 10">';if(!empty(get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){$output.= esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));}else{$output.= get_the_author_meta('display_name');} $output.='</h1>

		<h4 class="page-header-sub-title">
		  '.esc_attr__('Author','ronby').'
		</h4>		
		
		'; }elseif(is_404() || is_page_template('404.php')) { $output.='

		<h1 class="page-header-title">'.esc_html__('404 Error!','ronby').'</h1>	
		<a class="btn btn-primary btn-404" href="'.esc_url( home_url() ).'">'.esc_attr__('Take Me Home', 'ronby').'</a>	
		
		'; }elseif(class_exists('woocommerce') && is_shop()){ $output.='
		
		<h1 class="page-header-title">'; if(ronby_get_option('ronby_shop_page_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));}else{ $output.=esc_html__('Shop','ronby');} $output.='</h1>
		
		'; if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')).'
		</h4>
		
		'; } $output.='		
		'; }elseif(class_exists('woocommerce') && is_product()){  $output.='
		
		<h1 class="page-header-title">'; if(ronby_get_option('ronby_single_product_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));}else{ $output.=esc_html__('PRODUCT DETAIL','ronby');} $output.='</h1>
	
		'; if(ronby_get_option('ronby_single_product_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')).'
		</h4>	
		
		'; } $output.='
		'; }elseif(class_exists('woocommerce') && is_product_category()){  $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }elseif(class_exists('woocommerce') && is_product_taxonomy()){  $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }  $output.='
		
		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='	
						</div>
					</div>
					</div>
				</div>
';} elseif($page_header_style == '4'){ $output.=' 
		<div class="page-header-4" id="page-header" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).');background-size:cover"';}$output.='>
			<div class="overlay" ';if($padding_top || $padding_bottom || $overlay_color){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.=';';if($overlay_color){$output.='background-color:'.esc_attr($overlay_color).'';}$output.='"';}$output.='>
				<div class="container">

		'; if(is_front_page()){ $output.='
		
		    <h1 class="page-header-title">
			'.esc_attr(get_bloginfo('name')).'
			</h1>
			<h4 class="page-header-sub-title">
			'.esc_attr(get_bloginfo('description')).'
			</h4>
			
		'; }elseif(is_home()){ $output.='

		'; if(!empty(ronby_get_option('blog_page_header_sec_title_one'))) { $output.='
		
          <h1 class="page-header-title">'.esc_attr(ronby_get_option('blog_page_header_sec_title_one')).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; 
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='	
		
		'; if(!empty(ronby_get_option('blog_page_header_sec_title_two'))) { $output.='
		
          <h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_page_header_sec_title_two')).'
		  </h4>
		  
		'; } $output.='
		
		'; }elseif(is_page()){ $output.='
		
		'; if(!empty($ronby_page_heading_one_meta)) { $output.='
		
          <h1 class="page-header-title">'.esc_attr($ronby_page_heading_one_meta).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='

		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='
		
		'; if(!empty($ronby_page_heading_two_meta)) { $output.='	
		
          <h4 class="page-header-sub-title">
		  '.esc_attr($ronby_page_heading_two_meta).'
		  </h4>
		  
		'; } $output.='		
		
		'; }elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ $output.='
		
		<h1 class="page-header-title">';if(ronby_get_option('blog_post_header_sec_title_one')){$output.= esc_attr(ronby_get_option('blog_post_header_sec_title_one'));}else{$output.= esc_attr__('Blog Detail','ronby');}$output.='</h1>
		';if(ronby_get_option('blog_post_header_sec_title_two')){ $output.='
		<h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_post_header_sec_title_two')).'
		</h4>
		'; } $output.='
		
		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='	
		
		<h4 class="page-header-sub-title">
		  '.esc_attr(single_cat_title()).'
		</h4>
		
		'; }elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy())) { $output.='

		<h1 class="page-header-title">'.esc_html__('Post from Archive:','ronby').'</h1>	

		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		
		
		'; }elseif(is_category()) { $output.='
		
		<h1 class="page-header-title">'.esc_html__('Post from Category:','ronby').'</h1>	

		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='

		<h4 class="page-header-sub-title">
		  '.esc_attr(single_cat_title()).'
		</h4>		
		
		'; }elseif(is_search()) { $output.='	
		
		<h1 class="page-header-title">'.esc_attr__('Search','ronby').'</h1>		

		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='
		
		<h4 class="page-header-sub-title">
		  '.esc_html__('Search Results for: ','ronby').''.esc_attr(the_search_query()).'
		</h4>
		
		'; }elseif(is_author()) { $output.='		
		
		<h1 class="page-header-title 10">'; if(!empty(get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){$output.= esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));}else{$output.= get_the_author_meta('display_name');} $output.='</h1>

		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='

		<h4 class="page-header-sub-title">
		  '.esc_attr__('Author','ronby').'
		</h4>		
		
		'; }elseif(is_404() || is_page_template('404.php')) { $output.='

		<h1 class="page-header-title">'.esc_html__('404 Error!','ronby').'</h1>	
		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='
		<a class="btn btn-primary btn-404" href="'.esc_url( home_url() ).'">'.esc_attr__('Take Me Home', 'ronby').'</a>	
		
		'; }elseif(class_exists('woocommerce') && is_shop()){ $output.='
		
		<h1 class="page-header-title">';if(ronby_get_option('ronby_shop_page_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));}else{ $output.=esc_html__('Shop','ronby');} $output.='</h1>
		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}		
		if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')).'
		</h4>
		
		'; } $output.='	
		'; }elseif(class_exists('woocommerce') && is_product()){  $output.='
		
		<h1 class="page-header-title">'; if(ronby_get_option('ronby_single_product_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));}else{ $output.=esc_html__('PRODUCT DETAIL','ronby');} $output.='</h1>
		'; 
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='	
		'; if(ronby_get_option('ronby_single_product_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')).'
		</h4>	
		
		'; }  $output.='
		'; }elseif(class_exists('woocommerce') && is_product_category()){  $output.='

		<h1 class="page-header-title ">'.esc_html__('Product from Category:','ronby').'</h1>	
		'; 
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='
		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }elseif(class_exists('woocommerce') && is_product_taxonomy()){  $output.='

		<h1 class="page-header-title ">'.esc_html__('Product from Archive:','ronby').'</h1>	
		';
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='
		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }  $output.='
	
				</div>
			</div>
		</div>	
';}elseif($page_header_style == '5'){ $output.='
	<div class="page-header-5" id="page-header" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).');background-size:cover"';}$output.='>
		<div class="overlay" ';if($padding_top || $padding_bottom || $overlay_color){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.=';';if($overlay_color){$output.='background-color:'.esc_attr($overlay_color).'';}$output.='"';}$output.='>				
			<div class="container">
				<div class="inner-content row align-items-center">
					<div class="col-md-6 col-lg-4">

		'; if(is_front_page()){ $output.='
		
		    <h1 class="page-header-title">
			'.esc_attr(get_bloginfo('name')).'
			</h1>
			<h4 class="page-header-sub-title">
			'.esc_attr(get_bloginfo('description')).'
			</h4>
			
		'; }elseif(is_home()){ $output.='

		'; if(!empty(ronby_get_option('blog_page_header_sec_title_one'))) { $output.='
		
          <h1 class="page-header-title">'.esc_attr(ronby_get_option('blog_page_header_sec_title_one')).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; if(!empty(ronby_get_option('blog_page_header_sec_title_two'))) { $output.='	
		
          <h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_page_header_sec_title_two')).'
		  </h4>
		  
		'; } $output.='
		
		'; }elseif(is_page()){ $output.='
		
		'; if(!empty($ronby_page_heading_one_meta)) { $output.='
		
          <h1 class="page-header-title">'.esc_attr($ronby_page_heading_one_meta).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
		
		'; if(!empty($ronby_page_heading_two_meta)) { $output.='	
		
          <h4 class="page-header-sub-title">
		  '.esc_attr($ronby_page_heading_two_meta).'
		  </h4>
		  
		'; } $output.='		
		
		'; }elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ $output.='
		
		<h1 class="page-header-title">'; if(ronby_get_option('blog_post_header_sec_title_one')){$output.= esc_attr(ronby_get_option('blog_post_header_sec_title_one'));}else{$output.= esc_attr__('Blog Detail','ronby');}$output.='</h1>
		'; if(ronby_get_option('blog_post_header_sec_title_two')){ $output.='
		<h4 class="page-header-sub-title">
		  '.esc_attr(ronby_get_option('blog_post_header_sec_title_two')).'
		</h4>
		';  } $output.='
		
		'; }elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy())) { $output.='

		<h1 class="page-header-title">'.esc_html__('Post from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		
		
		'; }elseif(is_category() ) { $output.='
		
		<h1 class="page-header-title">'.esc_html__('Post from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(single_cat_title()).'
		</h4>		
		
		'; }elseif(is_search()) { $output.='	
		
		<h1 class="page-header-title">'.esc_attr__('Search','ronby').'</h1>		
		
		<h4 class="page-header-sub-title">
		  '.esc_html__('Search Results for: ','ronby').''.esc_attr(the_search_query()).'
		</h4>
		
		'; }elseif(is_author()) {$output.='		
		
		<h1 class="page-header-title 10">'; if(!empty(get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){$output.= esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));}else{$output.= get_the_author_meta('display_name');}$output.='</h1>

		<h4 class="page-header-sub-title">
		  '.esc_attr__('Author','ronby').'
		</h4>		
		
		'; }elseif(is_404() || is_page_template('404.php')) {$output.='

		<h1 class="page-header-title">'.esc_html__('404 Error!','ronby').'</h1>	
		<a class="btn btn-primary btn-404" href="'.esc_url( home_url() ).'">'.esc_attr__('Take Me Home', 'ronby').'</a>	
		
		'; }elseif(class_exists('woocommerce') && is_shop()){ $output.='
		
		<h1 class="page-header-title">'; if(ronby_get_option('ronby_shop_page_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));}else{ $output.=esc_html__('Shop','ronby');} $output.='</h1>
	
		'; if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')).'
		</h4>
		
		'; } $output.='		
		'; }elseif(class_exists('woocommerce') && is_product()){  $output.='
		
		<h1 class="page-header-title">';if(ronby_get_option('ronby_single_product_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));}else{ $output.=esc_html__('PRODUCT DETAIL','ronby');} $output.='</h1>
	
		'; if(ronby_get_option('ronby_single_product_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title">
		 '.esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')).'
		</h4>	
		
		'; }  $output.='
		'; }elseif(class_exists('woocommerce') && is_product_category()){  $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Category:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }elseif(class_exists('woocommerce') && is_product_taxonomy()){  $output.='

		<h1 class="page-header-title 8">'.esc_html__('Product from Archive:','ronby').'</h1>	

		<h4 class="page-header-sub-title">
		  '.esc_attr(get_the_archive_title()).'
		</h4>		

		'; }  $output.='
										
					</div>
					<div class="col-md-6 col-lg-4">

		'; 
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='	
					</div>
				</div>				
			</div>
		</div>			
	</div>
';}elseif($page_header_style == '6'){ $output.='
	<div class="page-header-6 text-center pt-0 pb-0" id="page-header" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).');background-size:cover"';}$output.='>
	<div class="overlay" ';if($padding_top || $padding_bottom || $overlay_color){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.=';';if($overlay_color){$output.='background-color:'.esc_attr($overlay_color).'';}$output.='"';}$output.='>
		<div class="container">	

		'; if(is_front_page()){ $output.='
			<h4 class="page-header-sub-title color-white">
			'.esc_attr(get_bloginfo('description')).'
			</h4>		
		    <h1 class="page-header-title color-primary">
			'.esc_attr(get_bloginfo('name')).'
			</h1>

			
		'; }elseif(is_home()){ $output.='

		'; if(!empty(ronby_get_option('blog_page_header_sec_title_two'))) { $output.='
		
          <h4 class="page-header-sub-title  color-primary">
		  '.esc_attr(ronby_get_option('blog_page_header_sec_title_two')).'
		  </h4>
		  
		'; }  

		 if(!empty(ronby_get_option('blog_page_header_sec_title_one'))) { $output.='
		
          <h1 class="page-header-title color-white">'.esc_attr(ronby_get_option('blog_page_header_sec_title_one')).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title color-primary">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
				
		'; }elseif(is_page()){ $output.='
		
		'; if(!empty($ronby_page_heading_two_meta)) { $output.='	
		
          <h4 class="page-header-sub-title  color-primary">
		  '.esc_attr($ronby_page_heading_two_meta).'
		  </h4>
		  
		'; } $output.='		
		
		'; if(!empty($ronby_page_heading_one_meta)) { $output.='
		
          <h1 class="page-header-title color-white">'.esc_attr($ronby_page_heading_one_meta).'</h1>
		  
		'; }else{ $output.=' 
		
		  <h1 class="page-header-title color-primary">
		  '.esc_attr(get_the_title()).'
		  </h1>
		  
		'; } $output.='
				
		
		'; }elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ $output.='
		<h4 class="page-header-sub-title color-primary">
		  '.esc_attr(ronby_get_option('blog_post_header_sec_title_two')).'
		</h4>		
		<h1 class="page-header-title color-white">';if(ronby_get_option('blog_post_header_sec_title_one')){$output.= esc_attr(ronby_get_option('blog_post_header_sec_title_one'));}else{$output.= esc_attr__('Blog Detail','ronby');}$output.='</h1>
		'; if(ronby_get_option('blog_post_header_sec_title_two')){$output.='

		'; } $output.='
		
		'; }elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy())) { $output.='

		<h4 class="page-header-sub-title color-white">
		  '.esc_attr(get_the_archive_title()).'
		</h4>
		
		<h1 class="page-header-title color-primary">'.esc_html__('Post from Archive:','ronby').'</h1>	
			
		'; } elseif(is_category() ) {$output.='

		<h4 class="page-header-sub-title color-white">
		  '.esc_attr(single_cat_title()).'
		</h4>	
		
		<h1 class="page-header-title color-primary">'.esc_html__('Post from Category:','ronby').'</h1>		
		
		'; } elseif(is_search()) { $output.='	

		<h4 class="page-header-sub-title color-white">
		  '.esc_html__('Search Results for: ','ronby').''.esc_attr(the_search_query()).'
		</h4>
		
		<h1 class="page-header-title color-primary">'.esc_attr__('Search','ronby').'</h1>		
				
		'; }elseif(is_author()) { $output.='		

		<h4 class="page-header-sub-title color-white">
		  '.esc_attr__('Author','ronby').'
		</h4>
		
		<h1 class="page-header-title">'; if(!empty(get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){$output.= esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));}else{$output.= get_the_author_meta('display_name');} $output.='</h1>
		
		'; }elseif(is_404() || is_page_template('404.php')) {$output.='

		<h1 class="page-header-title color-primary">'.esc_html__('404 Error!','ronby').'</h1>	
		<a class="btn btn-primary btn-404" href="'.esc_url( home_url() ).'">'.esc_attr__('Take Me Home', 'ronby').'</a>	
		
		'; }elseif(class_exists('woocommerce') && is_shop()){$output.='
		
		'; if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { $output.='
		
		<h4 class="page-header-sub-title color-primary">
		 '.esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')).'
		</h4>
		
		'; } $output.='
		
		<h1 class="page-header-title color-white">'; if(ronby_get_option('ronby_shop_page_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));}else{ $output.=esc_html__('Shop','ronby');} $output.='</h1>
		'; }elseif(class_exists('woocommerce') && is_product()){  $output.='
		
		'; if(ronby_get_option('ronby_single_product_header_sec_title_two')) { $output.='		
		<h4 class="page-header-sub-title color-primary">
		 '.esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')).'
		</h4>			
		'; } $output.='		
		<h1 class="page-header-title color-white">'; if(ronby_get_option('ronby_single_product_header_sec_title_one')){$output.= esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));}else{ $output.=esc_html__('PRODUCT DETAIL','ronby');} $output.='</h1>
	
		'; }elseif(class_exists('woocommerce') && is_product_category()){  $output.='
		<h4 class="page-header-sub-title color-primary">
		  '.esc_attr(get_the_archive_title()).'
		</h4>
		
		<h1 class="page-header-title color-white">'.esc_html__('Product from Category:','ronby').'</h1>	
		
		'; }elseif(class_exists('woocommerce') && is_product_taxonomy()){  $output.='
		
		<h4 class="page-header-sub-title color-primary">
		  '.esc_attr(get_the_archive_title()).'
		</h4>
		
		<h1 class="page-header-title color-white">'.esc_html__('Product from Archive:','ronby').'</h1>
		'; }  
		if($page_breadcrumb_switch == '1'){
		if(function_exists('ronby_element_breadcrumb_function')){ $output.= ronby_element_breadcrumb_function($page_header_style);} 
		}
		$output.='	
		</div>		
		</div>		
	</div>
';}
$output.='</section>';				
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_page_header_section', 'ronby_page_header_section_shortcode');

/*****************************
Fitness Team Details Section
******************************/
//Function for Fitness Team Details Section
function ronby_fitness_team_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'trainer_name'      => '',
	'trainer_designation'      => '',
	'trainer_fb_url'      => '',
	'trainer_twitter_url'      => '',
	'trainer_linkedin_url'      => '',
	'trainer_pinterest_url'      => '',
	'btn_label'      => '',
	'btn_url'      => '',
	'trainer_working_day'      => '',
	'trainer_working_time'      => '',
	'trainer_phone'      => '',
	'location'      => '',
	'description'      => '',
	'opening_hours_title'      => '',
	'short_description'      => '',
	'trainer_email'      => '',
	'day1_title'      => '',
	'day1_time'      => '',
	'day2_title'      => '',
	'day2_time'      => '',
	'day3_title'      => '',
	'day3_time'      => '',	
	'day4_title'      => '',
	'day4_time'      => '',	
	'day5_title'      => '',
	'day5_time'      => '',
	'day6_title'      => '',
	'day6_time'      => '',	
	'day7_title'      => '',
	'day7_time'      => '',	
	'btn_text_color'      => '',	
	'btn_bg_color'      => '',	
	'trainer_name_color'      => '',	
	'trainer_designation_color'      => '',	
	'trainer_info_label_color'      => '',	
	'trainer_info_text_color'      => '',	
	'trainer_desc_color'      => '',	
	'trainer_timetable_bg_color'      => '',	
	'trainer_timetable_text_color'      => '',	
	), $atts ) );
	
	$profile_img = shortcode_atts(
    array(
        'profile_img'      =>  'profile_img',
    ), $atts );	
	$image_ids = explode(',',$profile_img['profile_img']);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'profile_img' );
	}
	
	$output='
		<div class="team-details-style p-30-0-30">	
			<div class="container">
				<div class="mx-auto mx-width-1000">
					<div class="team-detail-2">
						<div class="row no-gutters">
							
							<div class="col-md-4 col-xl-3 mb-5">
								<div class="left-column text-center">	
									';if($images[0]){$output.='								
									<div class="thumbnail mb-4">
										<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
									</div>
									';}$output.='
									<div class="member-socials mb-3">
										<ul>
										';if($trainer_fb_url){$output.='
											<li>
												<a href="'.esc_url($trainer_fb_url).'">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
										';}$output.='
										';if($trainer_twitter_url){$output.='
											<li>
												<a href="'.esc_url($trainer_twitter_url).'">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
										';}$output.='
										';if($trainer_linkedin_url){$output.='
											<li>
												<a href="'.esc_url($trainer_linkedin_url).'">
													<i class="fab fa-linkedin-in"></i>
												</a>
											</li>
										';}$output.='	
										';if($trainer_pinterest_url){$output.='
											<li>
												<a href="'.esc_url($trainer_pinterest_url).'">
													<i class="fab fa-pinterest-p"></i>
												</a>
											</li>
										';}$output.='	
										</ul>
									</div>
									';if($btn_label){$output.='
									<div class="py-2 ">
										<a href="'.esc_url($btn_url).'" class="button button-primary rounded-capsule" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>
											'.esc_attr($btn_label).'
										</a>
									</div>
									';}$output.='
								</div>
							</div>
							<div class="col-md-8 col-xl-9">
								<div class="right-column">
									<div class="member-infomation">
										<div class=" d-flex align-items-end mb-3">
										';if($trainer_name){$output.='
											<div class="member-name" ';if($trainer_name_color){$output.='style="color:'.esc_attr($trainer_name_color).'"';}$output.='>
												'.esc_attr($trainer_name).'
											</div>
										';} $output.='	
										';if($trainer_designation){$output.='
											<div class="member-role color-primary" ';if($trainer_designation_color){$output.='style="color:'.esc_attr($trainer_designation_color).'"';}$output.='>
												'.esc_attr($trainer_designation).'
											</div>
										';} $output.='	
										</div>
										<ul class="list-unstyled">
										';if($trainer_working_day || $trainer_working_time){$output.='
											<li>
												<span class="color-primary mr-1" ';if($trainer_info_label_color){$output.='style="color:'.esc_attr($trainer_info_label_color).'"';}$output.='>'.esc_attr($trainer_working_day).' </span><span ';if($trainer_info_text_color){$output.='style="color:'.esc_attr($trainer_info_text_color).'"';}$output.='>  '.esc_attr($trainer_working_time).'</span>
											</li>
										';} $output.='
										';if($trainer_phone){$output.='
											<li>
												<span class="color-primary mr-1" ';if($trainer_info_label_color){$output.='style="color:'.esc_attr($trainer_info_label_color).'"';}$output.='>'.esc_attr__('Help Line:','ronby').'</span> <span ';if($trainer_info_text_color){$output.='style="color:'.esc_attr($trainer_info_text_color).'"';}$output.='> '.esc_attr($trainer_phone).'</span>
											</li>
										';} $output.='	
										';if($trainer_email){$output.='
											<li>
												<span class="color-primary mr-1" ';if($trainer_info_label_color){$output.='style="color:'.esc_attr($trainer_info_label_color).'"';}$output.='>'.esc_attr__('Email Address:','ronby').'</span> <span ';if($trainer_info_text_color){$output.='style="color:'.esc_attr($trainer_info_text_color).'"';}$output.='> '.esc_attr($trainer_email).'</span>
											</li>
										';} $output.='
										';if($location){$output.='
											<li>
												<span class="color-primary mr-1" ';if($trainer_info_label_color){$output.='style="color:'.esc_attr($trainer_info_label_color).'"';}$output.='>'.esc_attr__('Location:','ronby').' </span><span ';if($trainer_info_text_color){$output.='style="color:'.esc_attr($trainer_info_text_color).'"';}$output.='> '.esc_attr($location).'</span>
											</li>
										';} $output.='	
										</ul>
									</div>
									';if($description){$output.='
									<p ';if($trainer_desc_color){$output.='style="color:'.esc_attr($trainer_desc_color).'"';}$output.='>
									'.$description.'
									</p>
									';}$output.='
									<div class="timetable-box" ';if($trainer_timetable_text_color || $trainer_timetable_bg_color){$output.='style="';if($trainer_timetable_text_color){$output.='color:'.esc_attr($trainer_timetable_text_color).'';}$output.=';';if($trainer_timetable_bg_color){$output.='background-color:'.esc_attr($trainer_timetable_bg_color).'';}$output.='"';}$output.='>
									';if($opening_hours_title){$output.='
										<h3 class="widget-title">'.esc_attr($opening_hours_title).'</h3>
									';}$output.='	
										<div class="widget-timetable">
											<ul class="list-unstyled">
									';if($day1_title || $day1_time){$output.='		
												<li class="d-flex justify-content-between">
													<span class="text-uppercase">'.esc_attr($day1_title).'</span>
													<span>'.esc_attr($day1_time).'</span>
												</li>
									';}$output.='			
									';if($day2_title || $day2_time){$output.='		
												<li class="d-flex justify-content-between">
													<span class="text-uppercase">'.esc_attr($day2_title).'</span>
													<span>'.esc_attr($day2_time).'</span>
												</li>
									';}$output.='
									';if($day3_title || $day3_time){$output.='		
												<li class="d-flex justify-content-between">
													<span class="text-uppercase">'.esc_attr($day3_title).'</span>
													<span>'.esc_attr($day3_time).'</span>
												</li>
									';}$output.='
									';if($day4_title || $day4_time){$output.='		
												<li class="d-flex justify-content-between">
													<span class="text-uppercase">'.esc_attr($day4_title).'</span>
													<span>'.esc_attr($day4_time).'</span>
												</li>
									';}$output.='
									';if($day5_title || $day5_time){$output.='		
												<li class="d-flex justify-content-between">
													<span class="text-uppercase">'.esc_attr($day5_title).'</span>
													<span>'.esc_attr($day5_time).'</span>
												</li>
									';}$output.='
									';if($day6_title || $day6_time){$output.='		
												<li class="d-flex justify-content-between">
													<span class="text-uppercase">'.esc_attr($day6_title).'</span>
													<span>'.esc_attr($day6_time).'</span>
												</li>
									';}$output.='
									';if($day7_title || $day7_time){$output.='		
												<li class="d-flex justify-content-between">
													<span class="text-uppercase">'.esc_attr($day7_title).'</span>
													<span>'.esc_attr($day7_time).'</span>
												</li>
									';}$output.='									
											</ul>
										</div>
									</div>

									';if($short_description){$output.='
									<p ';if($trainer_desc_color){$output.='style="color:'.esc_attr($trainer_desc_color).'"';}$output.='>
									'.$short_description.'
									</p>
									';}$output.='
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
		
	return $output;
}

add_shortcode('ronby_shortcode_for_fitness_team_details', 'ronby_fitness_team_details_shortcode');

/******************* 
Pricing Badge
********************/
//This function is for Pricing Badge
function ronby_pricing_badge_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' 		 => '',
	'price1' 		 => '',
	'duration1' 	 => '',
	
	'heading2' 		 => '',
	'price2' 		 => '',
	'duration2' 	 => '',	
	
	'bg1_color' 	 => '',	
	'bg2_color' 	 => '',	
	'badge1_size' 	 => '',	
	'badge2_size' 	 => '',	
	'badge_position' 	 => '',	
	), $atts ) );

	$bg_img = shortcode_atts(
    array(
        'image'      =>  'image',
    ), $atts ); 

	$image_ids = explode(',',$bg_img['image']);
	foreach( $image_ids as $image_id ){
		$images = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	
	$output ='<section class="p-30-0-30"><div class="'; if($badge_position && ($badge_position=='position-3')){ $output.='pricing-badge-item-1'; }elseif($badge_position && ($badge_position=='position-4')){ $output.='pricing-badge-item-2'; } $output.='"><div class="pricing-badge-img-holder">
	<div class="pricing-badge '; if($badge1_size){  $output.=esc_attr($badge1_size); } else{$output.='badge-large'; } $output.=' badge-red '; if($badge_position && ($badge_position=='position-1')){ $output.='position-right-1' ; } elseif($badge_position && ($badge_position=='position-2')){ $output.='position-right-3' ; } elseif($badge_position && ($badge_position=='position-3')){ $output.='position-left-1' ; } else{$output.='position-right-1'; } $output.='" '; if($bg1_color){ $output.='style="background-color:'.esc_attr($bg1_color).'"' ; } $output.='>
	';if($heading1){$output.='
	'.esc_attr($heading1).' <br/>
	';}$output.='
	';if($price1){$output.='
	<span class="price">'.esc_attr($price1).'</span><br/>
	';}$output.='
	';if($duration1){$output.='
	'.esc_attr($duration1).'
	';}$output.='
	</div>
	<!--end badge --> 
	  
	<div class="pricing-badge '; if($badge2_size){ $output.=esc_attr($badge2_size); }else{$output.='badge-medium'; }  $output.=' badge-green '; if($badge_position && ($badge_position=='position-1')){ $output.='position-right-2' ; } elseif($badge_position && ($badge_position=='position-2')){ $output.='position-right-2' ; } elseif($badge_position && ($badge_position=='position-3')){ $output.='position-left-2' ; } else{$output.='position-right-2'; } $output.='" '; if($bg1_color){ $output.='style="background-color:'.esc_attr($bg2_color).'"' ; } $output.='>
	';if($heading2){$output.='
	'.esc_attr($heading2).'<br/>
	';}$output.='
	';if($price2){$output.='
	<span class="price two">'.esc_attr($price2).'</span><br/>
	';}$output.='
	';if($duration2){$output.='
	'.esc_attr($duration2).'
	';}$output.='
	</div>
	<!--end badge -->    
	';if($images[0]){$output.='
	<img src="'.esc_url($images[0]).'" alt="'.esc_attr('featured-image').'" class="img-responsive"/> 
	';}$output.='
	</div></div></section>';

	return $output;
}
add_shortcode('ronby_shortcode_for_pricing_badge', 'ronby_pricing_badge_shortcode');


/******************* 
Restaurant Food Category
********************/
//This function is for Restaurant Food Category
function ronby_restaurant_food_category_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' 		 => '',
	'heading2' 		 => '',
	'multiple_cat' 		 => '',
	'product_type' 		 => 'Recips',
	'left_bottom_img' 		 => '',
	'right_top_img' 		 => '',
	'btn_label' 		 => '',
	'btn_url' 		 => '',
	'btn_text_color' 		 => '',
	'btn_bg_color' 		 => '',
	'heading1_color' 		 => '',
	'heading2_color' 		 => '',
	'padding_top' 		 => '',
	'padding_bottom' 		 => '',
	), $atts ) );

	$left_bottom_image_ids = explode(',',$left_bottom_img);
	$right_top_image_ids = explode(',',$right_top_img);
	foreach( $left_bottom_image_ids as $left_bottom_image_id ){
		$left_bottom_image = wp_get_attachment_image_src( $left_bottom_image_id, 'left_bottom_img' );
	}
	foreach( $right_top_image_ids as $right_top_image_id ){
		$right_top_image = wp_get_attachment_image_src( $right_top_image_id, 'right_top_img' );
	}	
	$explode_cat = explode(',',$multiple_cat);	

	$output ='<section class="section-category-of-food" ';if($left_bottom_image[0] || $right_top_image[0]){ $output.='style="background:';if($left_bottom_image[0]){$output.='url('.esc_url($left_bottom_image[0]).') no-repeat left bottom,';}if($right_top_image[0]){$output.='url('.esc_url($right_top_image[0]).') no-repeat right top;';}if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
			<div class="container">
				<div class="section-header-style-15">
				';if($heading1){$output.='
					<h4 class="section-header-sub-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).';"';}$output.='>'.esc_attr($heading1).'</h4>
				';}$output.='
				';if($heading2){$output.='
					<h2 class="section-header-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).';"';}$output.='>'.esc_attr($heading2).'</h2>
				';}$output.='	
				</div>
				<div class="masonry masonry-3-columns masonry-no-gutter mb-6">
					<div class="masonry-sizer"></div>
					<div class="masonry-gutter"></div>
					';	foreach($explode_cat as $single_cat){
						$cat_id=$single_cat;
						$product_term = get_term( $cat_id, 'product_cat' );
						$get_cat_avg_rating_point=restaurant_get_average_product_rating($cat_id);
						$count_product=$product_term->count;
						if($count_product> 0){
						$totalresult=round($get_cat_avg_rating_point/$count_product);
						}
						if($count_product> 0){
						$get_rating_star=restaurant_return_rating_star($totalresult);
						}else{
						$get_rating_star='';
						}
						$output.='
					<div class="masonry-item">
						<article class="product-item-3">
							<div class="thumbnail">
								<a href="'.esc_url(get_category_link($cat_id)).'">
									<img src="';if(get_option('ronby_taxonomy_image'.$cat_id)){ $output.= esc_url(get_option('ronby_taxonomy_image'.$cat_id));} else{$output.= esc_url(get_template_directory_uri()."/images/placeholder.png");}$output.='" alt="'.esc_attr__('featured-image','ronby').'">
								</a>
								<a class="no-color" href="'.esc_url(get_category_link($cat_id)).'">
									<div class="overlay d-flex flex-column justify-content-end">							
										<h3 class="product-name">
											'.esc_attr(get_the_category_by_ID($cat_id)).'
										</h3>
										<div class="d-flex flex-wrap">
											'.$get_rating_star.'
										
											<div class="product-item-stats">
												'.esc_attr($product_term->count).' '.esc_attr($product_type).'
											</div>
										</div>						
									</div>
								</a>
							</div>
						</article>
					</div>
					';}$output.='
				</div>
				';if($btn_label){$output.='
				<div class="text-center">
					<a href="'.esc_url($btn_url).'" class="button button-primary" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>
						'.esc_attr($btn_label).'
					</a>
				</div>
				';}$output.='
			</div>
		</section>';

	return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_food_category', 'ronby_restaurant_food_category_shortcode');

/*****************************
Restaurant Heading Section- 1
******************************/
//Function for Restaurant Heading Section
function ronby_restaurant_heading_section_shortcode_one( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading1_color' => '',
	'heading2' => '',
	'heading2_color' => '',
	), $atts ) );
		
	$output='<section class="restaurant_heading_sec p-30-0-30">
				<div class="section-header-style-15 mb-0">
				';if($heading1){$output.='
					<h4 class="section-header-sub-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h4>
				';}$output.='	
				';if($heading2){$output.='
					<h2 class="section-header-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h2>
				';}$output.='	
				</div>
	</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_heading_section_one', 'ronby_restaurant_heading_section_shortcode_one');

/*****************************
Restaurant Feature Box
******************************/
//Function for Restaurant Feature Box
function ronby_restaurant_feature_box_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' => '',
	'heading_color' => '',
	'desc' => '',
	'desc_color' => '',
	'icon' => '',
	'icon_color' => '',
	), $atts ) );
		
	$output='<section class="restaurant_feature_box p-30-0-30">
			<div class="article-with-icon-3 text-center">
				';if($icon){$output.='
				<div class="icon color-primary">
					<i class="'.esc_attr($icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></i>
				</div>
				';}$output.='
				';if($heading){$output.='
				<h3 class="item-title" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($heading).'</h3>
				';}$output.='
				';if($desc){$output.='
				<div class="item-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
					'.esc_attr($desc).'
				</div>
				';}$output.='
			</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_feature_box', 'ronby_restaurant_feature_box_shortcode');

/*****************************
Restaurant Feature Box Section
******************************/
//Function for Restaurant Feature Box
function ronby_restaurant_feature_box_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading_color' => '',
	'desc_color' => '',
	'icon_color' => '',
	'number_of_feature_box' => '',
	'bg_image' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'headingline1' => '',
	'headingline2' => '',
	'heading1_color' => '',
	'heading2_color' => '',	
	), $atts ) );
		
	$output='<section class="ft-box-sec p-30-0-30"';if( $padding_top || $padding_bottom){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
				<div class="section-header-style-15">
				';if($headingline1){$output.='
					<h4 class="section-header-sub-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).';"';}$output.='>'.esc_attr($headingline1).'</h4>
				';}$output.='
				';if($headingline2){$output.='
					<h2 class="section-header-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).';"';}$output.='>'.esc_attr($headingline2).'</h2>
				';}$output.='	
				</div>		
	<div class="row">

';  $i=1;
	$c=0;
	while ($i<=$number_of_feature_box){
	$c++;
	$b = shortcode_atts(array(
		'icon'.$c.'' => '',
		'heading'.$c.'' => '',
		'desc'.$c.'' => '',
    ),$atts);
	$icon =$b['icon'.$c.''];
	$heading =$b['heading'.$c.''];
	$desc =$b['desc'.$c.''];

	$output .='<div class="col-md-6 col-xl-3">	
			<div class="article-with-icon-3 text-center">
				';if($icon){$output.='
				<div class="icon color-primary">
					<i class="'.esc_attr($icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></i>
				</div>
				';}$output.='
				';if($heading){$output.='
				<h3 class="item-title" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($heading).'</h3>
				';}$output.='
				';if($desc){$output.='
				<div class="item-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
					'.esc_attr($desc).'
				</div>
				';}$output.='
			</div>
			</div>
	';$i++;}$output.='	
			</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_feature_box_section', 'ronby_restaurant_feature_box_section_shortcode');

/*****************************
Restaurant Team Details Section
******************************/
//Function for Restaurant Team Details Section
function ronby_restaurant_team_details_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'title1' => '',
	'title2' => '',
	'team_role' => '',
	'desc' => '',
	'info1icon' => '',
	'info1title' => '',
	'info2icon' => '',
	'info2title' => '',
	'master_chef_img' => '',
	'team_member_img' => '',
	'fb_url' => '',
	'twitter_url' => '',
	'linkedin_url' => '',
	'pinterest_url' => '',
	'title1_color' => '',
	'title2_color' => '',
	'team_role_color' => '',
	'desc_color' => '',
	'infoicon_color' => '',
	'infotitle_color' => '',
	'master_chef_img_bg_color' => '',
	'sec_bg_color' => '',
	), $atts ) );
	
$explode_chef = explode(',',$master_chef_img);
$explode_team_member = explode(',',$team_member_img);
foreach( $explode_chef as $explode_chef_id ){
$chef_img = wp_get_attachment_image_src( $explode_chef_id, 'master_chef_img' );
}
foreach( $explode_team_member as $explode_team_member_id){
$chef_team_img = wp_get_attachment_image_src( $explode_team_member_id, 'team_member_img' );
}	
	
	$output='<section class="restaurant-team-member-3 row-xtra-space" ';if($sec_bg_color){$output.='style=background-color:'.esc_attr($sec_bg_color).'';}$output.='>
			<div class="team-detail-3">
				<div class="team-detail-header">
					<div class="row no-gutters align-items-center">
					';if($chef_img[0]){$output.='
						<div class="col-lg-4 text-right" ';if($master_chef_img_bg_color){$output.='style=background-color:'.esc_attr($master_chef_img_bg_color).'';}$output.='>						
							<img class="mt-m-160" src="'.esc_url($chef_img[0]).'" alt="'.esc_attr__('master-chef-featured-image').'">
						</div>
					';}$output.='	
						<div class="col-lg-4 color-inverse">
							<div class="py-5 pl-90">
								<div class="team-detail-title">
								';if($title1){$output.='
									<div class="top-text color-primary" ';if($title1_color){$output.='style=color:'.esc_attr($title1_color).'';}$output.='>
										'.esc_attr($title1).'
									</div>
								';}$output.='	
								';if($title2){$output.='
									<h2 class="bottom-text" ';if($title2_color){$output.='style=color:'.esc_attr($title2_color).'';}$output.='>
										'.esc_attr($title2).'
									</h2>
								';}$output.='	
								</div>
								';if($team_role){$output.='
								<div class="team-role color-primary before-background-primary" ';if($team_role_color){$output.='style=color:'.esc_attr($team_role_color).'';}$output.='>
									'.esc_attr($team_role).'
								</div>
								';}$output.='
								';if($desc){$output.='
								<p class="team-description" ';if($desc_color){$output.='style=color:'.esc_attr($desc_color).'';}$output.='>
									'.esc_attr($desc).'
								</p>
								';}$output.='
								<ul class="team-stats list-unstyled items-inline-block">
									<li class="d-inline">
									';if($info1icon){$output.='
										<i class="'.esc_attr($info1icon).'" ';if($infoicon_color){$output.='style=color:'.esc_attr($infoicon_color).'';}$output.='></i>
									';}$output.='
									';if($info1title){$output.='
										<span class="color-primary" ';if($infotitle_color){$output.='style=color:'.esc_attr($infotitle_color).'';}$output.='>'.esc_attr($info1title).'</span>
									';}$output.='	
									</li>
									<li class="d-inline">
									';if($info2icon){$output.='
										<i class="'.esc_attr($info2icon).'" ';if($infoicon_color){$output.='style=color:'.esc_attr($infoicon_color).'';}$output.='></i>
									';}$output.='
									';if($info2title){$output.='
										<span class="color-primary" ';if($infotitle_color){$output.='style=color:'.esc_attr($infotitle_color).'';}$output.='>'.esc_attr($info2title).'</span>
									';}$output.='	
									</li>
								</ul>
								<div class="social-11">
									<ul class="no-style items-inline-block">
									';if($fb_url){$output.='
										<li class="bg-color-3569b4">
											<a class="no-color" href="'.esc_url($fb_url).'">
												<i class="fab fa-facebook-f"></i>
											</a>
										</li>
									';}$output.='
									';if($twitter_url){$output.='
										<li class="bg-color-29ace0">
											<a class="no-color" href="'.esc_url($twitter_url).'">
												<i class="fab fa-twitter"></i>
											</a>
										</li>
									';}$output.='
									';if($linkedin_url){$output.='
										<li class="bg-color-0066A9">
											<a class="no-color" href="'.esc_url($linkedin_url).'">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</li>
									';}$output.='
									';if($pinterest_url){$output.='
										<li class="bg-color-D3112D">
											<a class="no-color" href="'.esc_url($pinterest_url).'">
												<i class="fab fa-pinterest-p"></i>
											</a>
										</li>
									';}$output.='	
									</ul>
								</div>
							</div>
						</div>
						';if($chef_team_img[0]){$output.='
						<div class="col-lg-4">
							<div class="py-5 pl-90" >
								<img src="'.esc_url($chef_team_img[0]).'" alt="'.esc_attr__('chef-team-members','ronby').'">
							</div>							
						</div>
						';}$output.='
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_team_details_section', 'ronby_restaurant_team_details_section_shortcode');

/*****************************
Restaurant Products Tab Section
******************************/
//Function for Restaurant Products Tab Section
function ronby_restaurant_products_tab_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'showall' => '',
	'showall_icon' => '',
	'features' => '',
	'features_icon' => '',
	'number_of_items' => '',
	'bg_img' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	), $atts ) );
	
	if(!empty($features)){
      $output = '<div id="filters" class="filter-nav-3">
				  <ul class="no-style items-inline-block text-center">
				  ';if($showall){$output.='
					<li class="hover-color-primary is-checked" data-filter="*">
							'; if($showall_icon) { $output .='<i class="'.esc_attr($showall_icon).'"></i>'; } $output .=''.esc_attr($showall).'
				  </li>';
				  }
      $features = !empty($features) ? explode("\n", trim($features)) : array(); 
	  if(!empty($features_icon)){
	  $features_icon = !empty($features_icon) ? explode(",", trim($features_icon)) : array();	  
	  }
		$c=-1;
      foreach($features as $feature) {
	  $feature = strip_tags($feature);
	  $c++;
        $output .= '<li class="hover-color-primary" data-filter=".'.$feature.'">';
		
		if(!empty($features_icon)){
		$new_output ='<i class="';
		if(isset($features_icon[$c])){
		$new_output .= $features_icon[$c];
		}
		$new_output .='"></i> ';
		} else { $new_output = '';
		}
		
		$output .=''.$new_output.''.htmlspecialchars_decode($feature).'</li>';
      }
      $output .= '</ul></div>';
      $content = $output;
    }
	
	
	$output='
';

$explode_bg_img = explode(',',$bg_img);
foreach( $explode_bg_img as $explode_bg_img_id ){
$bgimage = wp_get_attachment_image_src( $explode_bg_img_id, 'bg_img' );
}
	$out = '<section class="r-product-tabs p-30-0-30" ';if($bgimage[0] || $padding_top || $padding_bottom){$out.='style="';if($bgimage[0]){$out.='background:url('.esc_url($bgimage[0]).') no-repeat;background-position: left bottom 100px;';}if($padding_top){$out.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$out.='padding-bottom:'.esc_attr($padding_bottom).';';}$out.='"';}$out.='>
    <div class="container">';
    $out .= '  '.do_shortcode($content).'';
	$out .= '<div class="grid">';
							$i=1;
							$c=0;
							$counter=0;
							while ($i <= $number_of_items){
							$c++;
					
							$b = shortcode_atts(array(
								'item_img'.$c.'' => '',
								'item_title'.$c.'' => '',
								'item_price'.$c.'' => '',
								'item_features'.$c.'' => '',
								'item_feature'.$c.'' => '',
								'text'.$c.'' => '',
								'more_url'.$c.'' => '',
								'item_date'.$c.'' => '',
								'item_rating'.$c.'' => '',
							),$atts);
								
							$item_img =$b['item_img'.$c.''];
							$item_title =$b['item_title'.$c.''];
							$item_price =$b['item_price'.$c.''];
							$item_features =$b['item_features'.$c.''];
							$text =$b['text'.$c.''];
							$more_url =$b['more_url'.$c.''];								
							$item_date =$b['item_date'.$c.''];								
							$item_rating =$b['item_rating'.$c.''];
							if($counter>1){
								$counter = 0;
							}								

	if($counter == 0){
	$out .='<div class="col-lg-6 element-item '.esc_attr( $item_features ).'" data-category="'.esc_attr( $item_features ).'">
						<article class="product-item-2 thumb-right-style">
							<div class="d-sm-flex align-items-center">
								<div class="flex-auto order-sm-last position-relative mb-4 mb-sm-0">
								';if($item_price){$out.='
									<div class="product-price-badge background-primary">
										'.esc_attr( $item_price ).'
									</div>
								';}$out.='	
								';if($item_img){$out.='
									<div class="thumbnail">
										<a href="'.esc_url( $more_url ).'">
											<img src="'.esc_url( $item_img ).'" alt="'.esc_attr__('featured-image','ronby').'">
										</a>
									</div>
								';}$out.='	
								</div>
								<div class="flex-fill item-content order-sm-first">
								';if($item_title){$out.='
									<a href="'.esc_url( $more_url ).'" class="no-color">
										<h3 class="product-name">'.esc_attr( $item_title ).'</h3>
									</a>
								';}$out.='	
									<div class="product-meta">
									';if($item_date){$out.='
										<span class="product-date mr-4">'.esc_attr($item_date).'</span>
									';}$out.='	
									';if($item_rating){$out.='
										<div class="stars-rating d-inline-block" data-rate="5">
										';if($item_rating == '1'){$out.='
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '2'){$out.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '3'){$out.='		
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '4'){$out.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '5'){$out.='
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}$out.='
										</div>
									';}$out.='	
									</div>
									';if($text){$out.='
									<div class="product-description">
										'.esc_attr($text).'
									</div>
									';}$out.='	
								</div>
								
							</div>
						</article>
					</div>';	
	 }elseif($counter == 1){
	$out .='<div class="col-lg-6 element-item '.esc_attr( $item_features ).'" data-category="'.esc_attr( $item_features ).'">
						<article class="product-item-2">
							<div class="d-sm-flex align-items-center">
								<div class="flex-auto position-relative mb-4 mb-sm-0">
								';if($item_price){$out.='
									<div class="product-price-badge background-primary">
										'.esc_attr( $item_price ).'
									</div>
								';}$out.='
								';if($item_img){$out.='
									<div class="thumbnail">
										<a href="'.esc_url( $more_url ).'">
											<img src="'.esc_url( $item_img ).'" alt="'.esc_attr__('featured-image','ronby').'">
										</a>
									</div>
								';}$out.='
								</div>
								<div class="item-content flex-fill">
								';if($item_title){$out.='
									<a href="'.esc_url( $more_url ).'" class="no-color">
										<h3 class="product-name">'.esc_attr( $item_title ).'</h3>
									</a>
								';}$out.='
									<div class="product-meta">
									';if($item_date){$out.='
										<span class="product-date mr-4">'.esc_attr($item_date).'</span>
									';}$out.='
									';if($item_rating){$out.='
										<div class="stars-rating d-inline-block" data-rate="5">
										';if($item_rating == '1'){$out.='
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '2'){$out.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '3'){$out.='		
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '4'){$out.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '5'){$out.='
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}$out.='
										</div>
									';}$out.='
									</div>
									';if($text){$out.='
									<div class="product-description">
										'.esc_attr($text).'
									</div>
									';}$out.='	
								</div>							
							</div>
						</article>
					</div>';		
	} 
	$i++;
	$counter++;	
	}
	$out .='
				
      </div>
    </div>
  </section>';
    return $out;		

}
add_shortcode('ronby_shortcode_for_ronby_restaurant_products_tab_section', 'ronby_restaurant_products_tab_section_shortcode');

/*****************************
Restaurant Video Section
******************************/
//Function for Restaurant Video Section
function ronby_restaurant_video_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'youtube_url' => '',
	'bg_img' => '',
	'heading1_color' => '',
	'heading2_color' => '',	
	), $atts ) );
	$explode_bg_img = explode(',',$bg_img);
	foreach( $explode_bg_img as $explode_bg_img_id ){
	$bgimage = wp_get_attachment_image_src( $explode_bg_img_id, 'bg_img' );
	}		
	$output='<section>
			<div class="video-container">
			';if($bgimage[0]){$output.='
				<img class="w-100-percent" src="'.esc_url($bgimage[0]).'" alt="'.esc_attr('background-image').'">
			';}$output.='	
				<div class="video-overlay d-flex align-items-center justify-content-center">
					<div class="section-header-style-15 mb-0">
					';if($heading1){$output.='
						<h4 class="section-header-sub-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h4>
					';}$output.='
					';if($heading2){$output.='
						<h2 class="section-header-title color-white" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).' !important;"';}$output.='>'.esc_attr($heading2).'</h2>
					';}$output.='	
					';if($youtube_url){$output.='
						<center><a class="popup-youtube video-play-button" href="'.esc_url($youtube_url).'">
						</a>	</center>
					';}$output.='			
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_video_section', 'ronby_restaurant_video_section_shortcode');

/*****************************
Restaurant Blog Section
******************************/
//Function for Restaurant Blog Section
function ronby_restaurant_blog_section_shortcode( $atts ) {
    extract(shortcode_atts(array(
    'multiple'   => '',
    'num_post'   => '-1',
    'word_limit'  => '50',
    'order'      => 'desc',
    'orderby'    => 'post_date',
    ), $atts));

	$args = array(
			'posts_per_page'   => $num_post ,
			'cat' => $multiple,
			'order' => $order,
			'orderby' => $orderby,
			'post_status'      => 'publish',
			);
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);	
	$counter = 1;	
	$output='<section class="p-30-0-30 restaurant-blog-section">
			<div class="container">
			<div class="row">';	
	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id() );	
	if($counter > 5)
	{
	$counter = 1;
	}	
	if($counter == 1 || $counter == 2){
	$output.='<div class="col-xl-6">
						<div class="blog-post-item-7">
							<div class="row align-items-center">
								<div class="col-sm-5 mb-4 mb-sm-0">
									<div class="thumbnail animate-zoom">
										<a href="'.esc_url(get_the_permalink()).'">
											<div class="blog-p-f-img h-215 h-385" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
										</a>
									</div>
								</div>
								<div class="col-sm-7">
									<a href="'.esc_url(get_the_permalink()).'" class="no-color">
										<h3 class="post-title animate-300 hover-color-primary">'.esc_attr(get_the_title()).'</h3>
									</a>
									<ul class="list-unstyled blog-post-6-meta">
                                ';     
                                //check if post date meta switch in wordpress format is turned on 
                                if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){    
									if(function_exists('food_blog_wp_date_meta')) $output.=element_food_blog_wp_date_meta();
								   } 
                                // end wordpress format post date meta
                                else{    
								   if(function_exists('food_blog_theme_date_meta')) $output.=element_food_blog_theme_date_meta();
								   } 
								//author meta 
								if(function_exists('element_food_blog_author_meta')) $output.=element_food_blog_author_meta();
								
								$output.='</ul>			
									<p>
									';if ( has_post_format( 'video' ) ) : 
                                    $output.= ronby_content($word_limit); 
                                    else: 
                                    $output.= ronby_excerpt($word_limit);
                                    endif;
									$output.='</p>
								</div>
							</div>
						</div>
					</div>';	
	}elseif($counter == 3 || $counter == 4){
	$output.='<div class="col-xl-6">
						<div class="blog-post-item-7">
							<div class="row align-items-center">
								<div class="col-sm-5 order-sm-last mb-4 mb-sm-0">
									<div class="thumbnail animate-zoom">
										<a href="'.esc_url(get_the_permalink()).'">
											<div class="blog-p-f-img h-215 h-385" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
										</a>
									</div>
								</div>
								<div class="col-sm-7 order-sm-first text-right">
									<a href="'.esc_url(get_the_permalink()).'" class="no-color">
										<h3 class="post-title animate-300 hover-color-primary">'.esc_attr(get_the_title()).'</h3>
									</a>
									<ul class="list-unstyled blog-post-6-meta">
                                ';     
                                //check if post date meta switch in wordpress format is turned on 
                                if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){    
									if(function_exists('food_blog_wp_date_meta')) $output.=element_food_blog_wp_date_meta();
								   } 
                                // end wordpress format post date meta
                                else{    
								   if(function_exists('food_blog_theme_date_meta')) $output.=element_food_blog_theme_date_meta();
								   } 
								//author meta 
								if(function_exists('element_food_blog_author_meta')) $output.=element_food_blog_author_meta();
								
								$output.='</ul>			
									<p>
									';if ( has_post_format( 'video' ) ) : 
                                    $output.= ronby_content($word_limit); 
                                    else: 
                                    $output.= ronby_excerpt($word_limit);
                                    endif;
									$output.='</p>
								</div>
							</div>
						</div>
					</div>';	
	}
	
    $counter++;
	endwhile;endif;	
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();
	$output.='</div>
			  </div>
			  </section>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_blog_section', 'ronby_restaurant_blog_section_shortcode');

/*****************************
Restaurant Testimonial Slider
******************************/
//Function for Restaurant Testimonial Slider
function ronby_restaurant_testimonial_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'bg_color' => '',
	'text_color' => '',
	'name_color' => '',
	'designation_color' => '',
	'number_of_testimonial' => '',
	), $atts ) );
		
	$output='<section class=" background-primary p-120-0" ';if($bg_color){$output.='style="background-color:'.esc_attr($bg_color).'"';}$output.='>
			<div class="container">
			<div class="testimonial-slider-2 owl-carousel owl-arrow-style-1 owl-nav-left-right">';
	$i=1;
	$c=0;
	while ($i<=$number_of_testimonial){
	$c++;
	$b = shortcode_atts(array(
	'name'.$c.'' => '',
	'designation'.$c.'' => '',
    'text'.$c.'' => '',
    'img_url'.$c.'' => '',
    ),$atts);
	$name =$b['name'.$c.''];
	$designation =$b['designation'.$c.''];
    $text =$b['text'.$c.''];
    $img_url =$b['img_url'.$c.''];
	$output.='<div class="item">
						<div class="row align-items-center">
							<div class="d-none d-sm-block col-sm-4 col-md-3">
							';if($img_url){$output.='
								<div class="avatar">
									<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'">
								</div>
							';}$output.='	
							</div>
							<div class="col-sm-8 col-md-9">
							';if($text){$output.='
								<div class="testimonial-quote" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
								'.esc_attr($text).'	
								</div>
							';}$output.='	
								<div class="testimonial-author">
								';if($name){$output.='
									<span class="testimonial-author-name" ';if($name_color){$output.='style="color:'.esc_attr($name_color).'"';}$output.='>'.esc_attr($name).'</span>
								';}$output.='
								';if($designation){$output.='
									<span class="testimonial-author-role" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='>'.esc_attr($designation).'</span>
								';}$output.='	
								</div>
							</div>
						</div>
					</div>';
	
	$i++;
	}
	$output.='</div>
			</div>
			</section>';				
	return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_testimonial_slider', 'ronby_restaurant_testimonial_slider_shortcode');

/*****************************
Restaurant Contact Info
******************************/
//Function for Restaurant Contact Info
function ronby_restaurant_contact_info_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'headline'   => '',
    'short_description'   => '',
    'facebook_url'   => '',
    'twitter_url'   => '',
    'linkedin_url'   => '',
    'pinterest_url'   => '',
    'email'   => '',
    'phone'   => '',
    'fax'   => '',
    'address'   => '',
    'headline_color'   => '',
    'short_description_color'   => '',
    'information_title_color'   => '',
    'information_details_color'   => '',
	'map_address' 		 => '',
	'map_height' 		 => '480px',	
	), $atts ) );

$map_address_f=str_replace(" ","+",$map_address);;
	
	$output='<section class="restaurant-contact-info-box  ovf-hidden">
					<div class="position-relative mb-5">
					';if($map_address){$output.='
						<div class="google-map">
							<iframe style="width:100%;height:'.esc_attr($map_height).';" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url('https://maps.google.it/maps?q=='.$map_address_f).'=&output=embed"></iframe>
						</div>
					';}$output.='	
					<div class="container">
						<div class="contact-infomation-box-5">
						';if($headline){$output.='
							<h2 class="box-title" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>'.esc_attr($headline).'</h2>
						';}$output.='	
							<div class="row">
								<div class="col-lg-7 mb-5 mb-lg-0">
								';if($short_description){$output.='
									<p ';if($short_description_color){$output.='style="color:'.esc_attr($short_description_color).'"';}$output.='>
										'.esc_attr($short_description).'
									</p>
								';}$output.='	
									<div class="contact-social social-10">
										<ul class="no-style items-inline-block">
										';if($facebook_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($facebook_url).'">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
										';}$output.='
										';if($twitter_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($twitter_url).'">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
										';}$output.='
										';if($linkedin_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($linkedin_url).'">
													<i class="fab fa-linkedin-in"></i>
												</a>
											</li>
										';}$output.='
										';if($pinterest_url){$output.='
											<li class="animate-400 hover-background-primary hover-color-white">
												<a class="no-color" href="'.esc_url($pinterest_url).'">
													<i class="fab fa-pinterest-p"></i>
												</a>
											</li>
										';}$output.='	
										</ul>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="contact-info-list">
									';if($email){$output.='
										<div class="mb-2">
											<span class="color-primary" ';if($information_title_color){$output.='style="color:'.esc_attr($information_title_color).'"';}$output.='>'.esc_attr('Email:').'</span> <span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($email).'</span>
										</div>
									';}$output.='
									';if($phone){$output.='
										<div class="mb-2">
											<span class="color-primary" ';if($information_title_color){$output.='style="color:'.esc_attr($information_title_color).'"';}$output.='>'.esc_attr('Phone:').' </span> <span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($phone).'</span>
										</div>
									';}$output.='	
									';if($fax){$output.='
										<div class="mb-2">
											<span class="color-primary" ';if($information_title_color){$output.='style="color:'.esc_attr($information_title_color).'"';}$output.='>'.esc_attr('Fax:').'</span> <span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($fax).'</span>
										</div>
									';}$output.='
									';if($address){$output.='
										<p class="m-30-0-0">
										 	<span ';if($information_details_color){$output.='style="color:'.esc_attr($information_details_color).'"';}$output.='>'.esc_attr($address).'</span>
										</p>
									';}$output.='	
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_contact_info', 'ronby_restaurant_contact_info_shortcode');

/*****************************
Restaurant Contact Form
******************************/
//Function for Restaurant Contact Form
function ronby_restaurant_contact_form_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'headline_one'   => '',
    'headline_two'   => '',
    'headline_one_color'   => '',
    'headline_two_color'   => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
	
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Your name *',
	'email_field_placeholder' => 'Your email *',
	'problem_field_placeholder' => 'Your problem',
	'message_field_placeholder' => 'Your Message *',
	'button_label' => 'Send Message',

	'wanttoselect' => 'no',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',
	'wanttoradio' => 'no',
	'yourradio' => 'Select Radio',
	'radioitems' => 'One, Two, Three, Four, Five',
	'wanttocheckbox' => 'no',
	'yourcheckbox' => 'Select Checkbox',
	'checkboxitems' => 'One, Two, Three, Four, Five',	
	), $atts ) );
	
	$output='<section class="restaurant-contact-form p-30-0-30">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-xl-12">
				';if($headline_one || $headline_two){$output.='
					<div class="section-header-style-15 text-center">
					';if($headline_one){$output.='
						<h4 class="section-header-sub-title color-primary" ';if($headline_one_color){$output.='style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($headline_one).'</h4>
					';}$output.='	
					';if($headline_two){$output.='
						<h2 class="section-header-title" ';if($headline_two_color){$output.='style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.esc_attr($headline_two).'</h2>
					';}$output.='	
					</div>
				';}$output.='	
					<div class="contact-form pb-70">
						<form  method="POST" id="fitness_contact_form">
							<div class="row align-items-center">
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="text" name="name" id="sendername" placeholder="'.esc_attr($name_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="email" name="email" id="senderemail" placeholder="'.esc_attr($email_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="text" name="contact_issue" id="senderproblem" placeholder="'.esc_attr($problem_field_placeholder).'">
									</div>
								</div>
								'; if($wanttoselect=="yes"){
								$output .= '<div class="col-lg-12">
										<div class="form-group">                               
										<select class="input-styled" name="cf-select" id="cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}

								$output .= '</select>
											</div>
											</div>';
								} $output .='	
						'; if($wanttoradio=="yes"){
						$output .= '<div class="col-lg-12">
									<div class="form-group">
									<label class="lable-text" for="cf-radio">'.esc_attr($yourradio).'</label><br>';
									$radioitemArray = explode(',', $radioitems);
									$i=1;
									foreach($radioitemArray as $radioitem){
										$output .= '<span class="mr-10"><input class="control-radio mr-10" type="radio" name="cf-radio" value="'.$radioitem.'"  id="cf-radio'.$i.'">'.$radioitem.'</span>';
										$i++;
									}
						$output .='</div></div>';
						} $output .='
						';if($wanttocheckbox=="yes"){
						$output .=  '<div class="col-lg-12">
									<div class="form-group">
						 <label class="lable-text" for="cf-checkbox">'.esc_attr($yourcheckbox).'</label><br>';
						 $checkboxitemArray = explode(',', $checkboxitems);
						 $i=1;
							foreach($checkboxitemArray as $checkboxitem){
									$output .=  '<span class="mr-10"><input type="checkbox" class="control-checkbox mr-10" name="cf-checkbox[]" value="'.$checkboxitem.'"  id="cf-checkbox'.$i.'">'.$checkboxitem.'</span>';
									$i++;
							}

						$output .='</div></div>';
						} $output .='</div>					
							<div class="form-group">
								<textarea class="input-styled" name="message" id="sendermessage" rows="10" placeholder="'.esc_attr($message_field_placeholder).'" required></textarea>
							</div>
							<div class="form-group py-15px text-center">
								<button class="button  comment-submit button-primary" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>
								
							</div>
							<div class="col-lg-12">
							<div class="alert alert-success display-none" id="success-msg">
							<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
							</div>	
							<div class="alert alert-danger display-none" id="failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
							</div>
							
  					<input type="hidden" name="email_subject" id="email_subject" value="'.esc_attr($email_subject).'" />
  					<input type="hidden" name="recipient_name" id="recipient_name" value="'.esc_attr($recipient_name).'" />
					<input type="hidden" name="recipient_email" id="recipient_email" value="'.sanitize_email($recipient_email).'" />
					
						</form>
					</div>
				</div>
			</div>			
		</div>	
		</section>';
		
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#fitness_contact_form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#sendername").val();
                    var email = jQuery("#senderemail").val();
                    var problem = jQuery("#senderproblem").val();
                    var message = jQuery("#sendermessage").val();
                    var recipient_email = jQuery("#recipient_email").val();
                    var recipient_name = jQuery("#recipient_name").val();
                    var email_subject = jQuery("#email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";					
						var select = jQuery("#cf-select").val();
					'; } $output.='	
					
					'; if($wanttoradio=="yes"){ $output .= '				
						var radio = jQuery("input[name=cf-radio]:checked").val();
						var radio_title = "'.esc_attr($yourradio).'";
					'; } $output.='	
					
					';if($wanttocheckbox=="yes"){ $output .=  '				
						var checkbox_title = "'.esc_attr($yourcheckbox).'";
						var checkArray = [];					
						jQuery(".control-checkbox:checked").each(function(i,e) {
							checkArray.push(jQuery(this).val());
						});
					'; } $output.='						
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'ronby-contact-form.php",
                        data: {name: name,email:email,message:message,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; }  if($wanttoradio=="yes"){ $output .= 'radio_title:radio_title,radio:radio,'; } if($wanttocheckbox=="yes"){ $output .= 'checkbox_title:checkbox_title,"checkbox[]":checkArray.join(),'; } $output.='problem:problem},
						complete: function(){
							jQuery("#fitness_contact_form")[0].reset();
							jQuery(".contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_contact_form', 'ronby_restaurant_contact_form_shortcode');

/******************************************
Restaurant Team Member Box
*******************************************/
//This function is for Restaurant Team Member Box
function ronby_restaurant_team_member_box_shortcode( $atts ) {
extract( shortcode_atts( array(
    'name'        		      => '',
    'name_color'              => '',
	'designation'             => '',
    'designation_color'       => '',
	'description'             => '',
    'description_color'       => '',
    'icon_area_bg_color'  	  => '',
    'box_highlight_status'    => '',
    'box_highlight_bg_color'  => '',
    'box_bg_color'   		  => '',
    'img_overlay_color'       => '',
    'twitter_url'         	  => '',
    'facebook_url'            => '',
    'pinterest_url'              => '',
    'linkedin_url'            => '',
    'profile_img'            => '',
    'link_to_url'            => '',
	), $atts));

	$explode_profile_img = explode(',',$profile_img);
	foreach( $explode_profile_img as $explode_profile_img_id ){
		$get_image = wp_get_attachment_image_src( $explode_profile_img_id, 'profile_img' );
	}	
	
$output ='<section class="restaurant_team_member_box p-30-0-30 sec-padding">
            <div class="hs-feature-box-3 '; if($box_highlight_status == "yes"){$output .='active';} $output .='" >
              <div class="img-box">
                <div class="text-box" '; if($box_highlight_status == "yes"){$output .='style="background-color:'.esc_attr($box_highlight_bg_color).' !important;"';} $output .='>
                  <div class="sc-icons-box">
                    <ul class="sc-icons" ';if($icon_area_bg_color){$output.='style="background-color:'.esc_attr($icon_area_bg_color).' !important;"';}$output.=' >
                      <li><a class="twitter" href="'.esc_url($twitter_url).'"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="'.esc_url($facebook_url).'"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a  href="'.esc_url($pinterest_url).'"><i class="fab fa-pinterest-p"></i></a></li>
                      <li><a href="'.esc_url($linkedin_url).'"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                  </div>
                  <h5 class="uppercase raleway less-mar-1 title" ';if($name_color){$output.='style="color:'.esc_attr($name_color).';"';}$output.=' >'.esc_attr($name).'</h5>
                  <p class="text-gyellow" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).';"';}$output.=' >'.esc_attr($designation).'</p>
                  <p class="padding-top-1" ';if($description_color){$output.='style="color:'.esc_attr($description_color).';"';}$output.=' >'.esc_attr($description).'</p>
                </div>
                <div class="overlay" ';if($img_overlay_color){$output.='style="background-color:'.esc_attr($img_overlay_color).' !important;"';}$output.='></div>
				';if($get_image[0]){$output.='
				<a href="'.esc_url($link_to_url).'">
                <img src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('featured-image','ronby').'" class="img-responsive"/>
				</a>
				';}$output.='
				</div>
            </div>    
          <!--end item--> 
	</section>
    <!-- end section -->'; 	
    return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_team_member_box', 'ronby_restaurant_team_member_box_shortcode');

/*****************************
Restaurant Team Member Section
******************************/
//Function for Restaurant Team Member Section
function ronby_restaurant_team_member_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'bg_img' => '',
	'number_of_members' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	'name_color' => '',
	'designation_color' => '',
	'desc_color' => '',
	'f_box_margin_bottom' => '',
	), $atts ) );

	
$explode_bg_img = explode(',',$bg_img);
foreach( $explode_bg_img as $explode_bg_img_id ){
	$get_bg_image = wp_get_attachment_image_src( $explode_bg_img_id, 'bg_img' );
}
	
	$output='<section class="section-side-image clearfix">
	      <div class="img-holder col-md-4 col-sm-3 pull-left">
		  ';if($get_bg_image[0]){$output.='
	        <div class="background-imgholder" style="background:url('.esc_url($get_bg_image[0]).');"><img class="nodisplay-image" src="'.esc_url($get_bg_image[0]).'" alt="'.esc_attr('background-image').'"> </div>
		  ';}$output.='
	      </div>
	      <div class="container-fluid">
	        <div class="row">
	          <div class="col-md-7 offset-md-5 col-sm-8 offset-sm-4 text-inner clearfix align-left">
	            <div class="text-box row">
	              
	            <div class="col-md-12 row-padding">
	            <div class="sec-title-container text-center">
	              <div class="section-header-style-15">
					';if($heading1){$output.='
						<h4 class="section-header-sub-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h4>
					';}$output.='	
					';if($heading2){$output.='
						<h2 class="section-header-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h2>
					';}$output.='		
					</div>
	            </div>
	          </div>
	          <div class="clearfix"></div>
	          <!--end title-->

';  $i=1;
	$c=0;
	while ($i<=$number_of_members){
	$c++;
	$b = shortcode_atts(array(
		'member_name'.$c.'' => '',
		'member_designation'.$c.'' => '',
		'member_desc'.$c.'' => '',
		'member_img_url'.$c.'' => '',
		'member_fb_url'.$c.'' => '',
		'member_twitter_url'.$c.'' => '',
		'member_linkedin_url'.$c.'' => '',
		'member_pinterest_url'.$c.'' => '',
		'member_link_to_url'.$c.'' => '',
    ),$atts);
	$member_name =$b['member_name'.$c.''];
	$member_designation =$b['member_designation'.$c.''];
	$member_desc =$b['member_desc'.$c.''];
	$member_img_url =$b['member_img_url'.$c.''];
	$member_fb_url =$b['member_fb_url'.$c.''];
	$member_twitter_url =$b['member_twitter_url'.$c.''];
	$member_linkedin_url =$b['member_linkedin_url'.$c.''];
	$member_pinterest_url =$b['member_pinterest_url'.$c.''];
	$member_link_to_url =$b['member_link_to_url'.$c.''];
	
	$output.='<div class="col-md-4 col-sm-6 col-xs-12 margin-bottom text-center" ';if($f_box_margin_bottom){$output.='style="margin-bottom:'.esc_attr($f_box_margin_bottom).'"';}$output.='>
	                <div class="bd-feature-box-2">
	                  <div class="img-box">
	                    <div class="sc-icons-box">
	                      <ul class="sc-icons">
						  ';if($member_fb_url){$output.='
						   <li><a href="'.esc_url($member_fb_url).'"><i class="fab fa-facebook-f"></i></a></li>
						  ';}$output.='
						  ';if($member_twitter_url){$output.='
	                        <li><a class="twitter" href="'.esc_url($member_twitter_url).'"><i class="fab fa-twitter"></i></a></li>
							';}$output.='
							';if($member_linkedin_url){$output.='
	                        <li><a href="'.esc_url($member_linkedin_url).'"><i class="fab fa-linkedin-in"></i></a></li> 
							';}$output.='
							';if($member_pinterest_url){$output.='
	                        <li><a href="'.esc_url($member_pinterest_url).'"><i class="fab fa-pinterest"></i></a></li>	
							';}$output.='
	                      </ul>
	                    </div>
						';if($member_img_url){$output.='
	                    <a href="'.esc_url($member_link_to_url).'"> <img src="'.esc_url($member_img_url).'" alt="'.esc_attr__('profile-image','ronby').'" class="img-responsive"> </a>
						';}$output.='
						</div>
	                  <div class="text-box padding-3">
						  ';if($member_name){$output.='
							<h5 class="less-mar-1" ';if($name_color){$output.='style="color:'.esc_attr($name_color).'"';}$output.='>'.esc_attr($member_name).'</h5>
						  ';}$output.='
						  ';if($member_designation){$output.='
							<p class="text-gyellow" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='>'.esc_attr($member_designation).'</p>
						  ';}$output.='
						  ';if($member_desc){$output.='
							<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>'.esc_attr($member_desc).'</p>
						  ';}$output.='
	                  </div>
	                </div>
	              </div>
	              <!--end item-->
';$i++;
	}	              
$output.='		</div>
	          </div>
	        </div>
	      </div>
	    </section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_team_member_section', 'ronby_restaurant_team_member_section_shortcode');

/*****************************
Restaurant Team Details Section-2
******************************/
//Function for Restaurant Team Details Section-2
function ronby_restaurant_team_details_section_shortcode_two( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'designation' => '',
	'profile_img' => '',
	'short_description' => '',
	'detail_description' => '',
	'info1icon' => '',
	'info1title' => '',
	'info2icon' => '',
	'info2title' => '',
	'fb_url' => '',
	'twitter_url' => '',
	'linkedin_url' => '',
	'pinterest_url' => '',
	'menu_heading1' => '',
	'menu_heading2' => '',
	'number_of_items' => '',
	
	'title1_color' => '',
	'title2_color' => '',
	'designation_color' => '',
	'desc_color' => '',	
	'infoicon_color' => '',
	'infotitle_color' => '',
	'menu_heading1_color' => '',
	'menu_heading2_color' => '',	
	'menu_item_txt_color' => '',	
	'team_detail_content_box_bg' => '',	
	
	'content_box_padding_top' => '',	
	'content_box_padding_bottom' => '',	
	), $atts ) );
	
$explode_profile_img = explode(',',$profile_img);
foreach( $explode_profile_img as $explode_profile_img_id ){
	$get_profile_image = wp_get_attachment_image_src( $explode_profile_img_id, 'profile_img' );
}
		
	$output='<section class="team-detail-3 restaurant-team-details-sec p-30-0-30">
			<div class="container">
				<div class="mx-auto mx-width-1030">
					<div class="team-detail-header">
						<div class="row align-items-center">
							<div class="col-md-5 mb-5 mb-md-0">
							';if($get_profile_image[0]){$output.='
								<img src="'.esc_url($get_profile_image[0]).'" alt="'.esc_attr__('profile-image','ronby').'">
							';}$output.='	
							</div>
							<div class="col-md-7 mb-5">
								<div class="team-detail-title">
								';if($heading1){$output.='
									<div class="top-text color-primary" ';if($title1_color){$output.='style="color:'.esc_attr($title1_color).'"';}$output.='>
										'.esc_attr($heading1).'
									</div>
								';}$output.='
								';if($heading2){$output.='
									<h2 class="bottom-text" ';if($title2_color){$output.='style="color:'.esc_attr($title2_color).'"';}$output.='>
										'.esc_attr($heading2).'
									</h2>
								';}$output.='	
								</div>
								';if($designation){$output.='
								<div class="team-role" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='>
									'.esc_attr($designation).'
								</div>
								';}$output.='
								';if($short_description){$output.='
								<p class="team-description" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
									'.$short_description.'
								</p>
								';}$output.='
								<ul class="team-stats list-unstyled items-inline-block">
									<li class="d-inline">
									';if($info1icon){$output.='
										<i class="'.esc_attr($info1icon).'" ';if($infoicon_color){$output.='style=color:'.esc_attr($infoicon_color).'';}$output.='></i>
									';}$output.='
									';if($info1title){$output.='
										<span class="color-primary" ';if($infotitle_color){$output.='style=color:'.esc_attr($infotitle_color).'';}$output.='>'.esc_attr($info1title).'</span>
									';}$output.='	
									</li>
									<li class="d-inline">
									';if($info2icon){$output.='
										<i class="'.esc_attr($info2icon).'" ';if($infoicon_color){$output.='style=color:'.esc_attr($infoicon_color).'';}$output.='></i>
									';}$output.='
									';if($info2title){$output.='
										<span class="color-primary" ';if($infotitle_color){$output.='style=color:'.esc_attr($infotitle_color).'';}$output.='>'.esc_attr($info2title).'</span>
									';}$output.='	
									</li>
								</ul>
								<div class="social-11">
							<ul class="no-style items-inline-block">
									';if($fb_url){$output.='
										<li class="bg-color-3569b4">
											<a class="no-color" href="'.esc_url($fb_url).'">
												<i class="fab fa-facebook-f"></i>
											</a>
										</li>
									';}$output.='
									';if($twitter_url){$output.='
										<li class="bg-color-29ace0">
											<a class="no-color" href="'.esc_url($twitter_url).'">
												<i class="fab fa-twitter"></i>
											</a>
										</li>
									';}$output.='
									';if($linkedin_url){$output.='
										<li class="bg-color-0066A9">
											<a class="no-color" href="'.esc_url($linkedin_url).'">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</li>
									';}$output.='
									';if($pinterest_url){$output.='
										<li class="bg-color-D3112D">
											<a class="no-color" href="'.esc_url($pinterest_url).'">
												<i class="fab fa-pinterest-p"></i>
											</a>
										</li>
									';}$output.='	
									</ul>
									
								</div>
							</div>
						</div>
					</div>
					<div class="team-detail-3-content-box" ';if($team_detail_content_box_bg || $content_box_padding_top || $content_box_padding_bottom){$output.='style="';if($team_detail_content_box_bg){$output.='background-color:'.esc_attr($team_detail_content_box_bg).';';}if($content_box_padding_top){$output.='padding-top:'.esc_attr($content_box_padding_top).';';}if($content_box_padding_bottom){$output.='padding-bottom:'.esc_attr($content_box_padding_bottom).';';}$output.='"';}$output.='>
					
					';if($detail_description){$output.='
						<div class="team-detail-content" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
							<p>
							'.$detail_description.'
							</p>		
						</div>
					';}$output.='
						<div class="section-header-style-15">
						';if($menu_heading1){$output.='
							<h4 class="section-header-sub-title color-primary" ';if($menu_heading1_color){$output.='style="color:'.esc_attr($menu_heading1_color).'"';}$output.='>'.esc_attr($menu_heading1).'</h4>
						';}$output.='
						';if($menu_heading2){$output.='
							<h1 class="section-header-title" ';if($menu_heading2_color){$output.='style="color:'.esc_attr($menu_heading2_color).'"';}$output.='>'.esc_attr($menu_heading2).'</h1>
						';}$output.='	
						</div>
						<div class="row justify-content-center">
							<div class="col-lg-9 col-xl-8">';
							$i=1;
							$c=0;
							$counter=0;
							while ($i <= $number_of_items){
							$c++;
					
							$b = shortcode_atts(array(
								'item_img'.$c.'' => '',
								'item_title'.$c.'' => '',
								'item_price'.$c.'' => '',
								'item_features'.$c.'' => '',
								'item_feature'.$c.'' => '',
								'text'.$c.'' => '',
								'more_url'.$c.'' => '',
								'item_date'.$c.'' => '',
								'item_rating'.$c.'' => '',
							),$atts);
								
							$item_img =$b['item_img'.$c.''];
							$item_title =$b['item_title'.$c.''];
							$item_price =$b['item_price'.$c.''];
							$item_features =$b['item_features'.$c.''];
							$text =$b['text'.$c.''];
							$more_url =$b['more_url'.$c.''];								
							$item_date =$b['item_date'.$c.''];								
							$item_rating =$b['item_rating'.$c.''];
							if($counter>1){
								$counter = 0;
							}							
	if($counter == 0){
	$output .='<article class="product-item-2 thumb-right-style">
							<div class="d-sm-flex align-items-center">
								<div class="flex-auto order-sm-last position-relative mb-4 mb-sm-0">
								';if($item_price){$output.='
									<div class="product-price-badge background-primary">
										'.esc_attr( $item_price ).'
									</div>
								';}$output.='	
								';if($item_img){$output.='
									<div class="thumbnail">
										<a href="'.esc_url( $more_url ).'">
											<img src="'.esc_url( $item_img ).'" alt="'.esc_attr__('featured-image','ronby').'">
										</a>
									</div>
								';}$output.='	
								</div>
								<div class="flex-fill item-content order-sm-first">
								';if($item_title){$output.='
									<a href="'.esc_url( $more_url ).'" class="no-color">
										<h3 class="product-name" ';if($menu_item_txt_color){$output.='style="color:'.esc_attr($menu_item_txt_color).'"';}$output.='>'.esc_attr( $item_title ).'</h3>
									</a>
								';}$output.='	
									<div class="product-meta">
									';if($item_date){$output.='
										<span class="product-date mr-4" ';if($menu_item_txt_color){$output.='style="color:'.esc_attr($menu_item_txt_color).'"';}$output.='>'.esc_attr($item_date).'</span>
									';}$output.='	
									';if($item_rating){$output.='
										<div class="stars-rating d-inline-block" data-rate="5">
										';if($item_rating == '1'){$output.='
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '2'){$output.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '3'){$output.='		
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '4'){$output.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '5'){$output.='
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}$output.='
										</div>
									';}$output.='	
									</div>
									';if($text){$output.='
									<div class="product-description" ';if($menu_item_txt_color){$output.='style="color:'.esc_attr($menu_item_txt_color).'"';}$output.='>
										'.esc_attr($text).'
									</div>
									';}$output.='	
								</div>
								
							</div>
						</article>';	
	 }elseif($counter == 1){
	$output .='<article class="product-item-2">
							<div class="d-sm-flex align-items-center">
								<div class="flex-auto position-relative mb-4 mb-sm-0">
								';if($item_price){$output.='
									<div class="product-price-badge background-primary">
										'.esc_attr( $item_price ).'
									</div>
								';}$output.='
								';if($item_img){$output.='
									<div class="thumbnail">
										<a href="'.esc_url( $more_url ).'">
											<img src="'.esc_url( $item_img ).'" alt="'.esc_attr__('featured-image','ronby').'">
										</a>
									</div>
								';}$output.='
								</div>
								<div class="item-content flex-fill">
								';if($item_title){$output.='
									<a href="'.esc_url( $more_url ).'" class="no-color">
										<h3 class="product-name" ';if($menu_item_txt_color){$output.='style="color:'.esc_attr($menu_item_txt_color).'"';}$output.='>'.esc_attr( $item_title ).'</h3>
									</a>
								';}$output.='
									<div class="product-meta">
									';if($item_date){$output.='
										<span class="product-date mr-4" ';if($menu_item_txt_color){$output.='style="color:'.esc_attr($menu_item_txt_color).'"';}$output.='>'.esc_attr($item_date).'</span>
									';}$output.='
									';if($item_rating){$output.='
										<div class="stars-rating d-inline-block" data-rate="5">
										';if($item_rating == '1'){$output.='
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '2'){$output.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '3'){$output.='		
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '4'){$output.='	
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}elseif($item_rating == '5'){$output.='
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
											<span class="fas fa-star"></span>
										';}$output.='
										</div>
									';}$output.='
									</div>
									';if($text){$output.='
									<div class="product-description" ';if($menu_item_txt_color){$output.='style="color:'.esc_attr($menu_item_txt_color).'"';}$output.='>
										'.esc_attr($text).'
									</div>
									';}$output.='	
								</div>							
							</div>
						</article>';		
		} 
	$i++;
	$counter++;	
	}
	$output .='				</div>
						</div>
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_team_details_section_two', 'ronby_restaurant_team_details_section_shortcode_two');

/*****************************
Restaurant Reservation Form
******************************/
//Function for Restaurant Reservation Form
function ronby_restaurant_reservation_form_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'headline_one'   => '',
    'headline_two'   => '',
    'headline_one_color'   => '',
    'headline_two_color'   => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
	
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Name ',
	'phone_field_placeholder' => 'Phone ',
	'guest_field_placeholder' => 'Number of Guests ',
	'date_field_placeholder' => 'Date',
	'message_field_placeholder' => 'Tell us about yourself ',
	'button_label' => 'Reserve Now',

	'wanttoselect' => 'no',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',
	'wanttoradio' => 'no',
	'yourradio' => 'Select Radio',
	'radioitems' => 'One, Two, Three, Four, Five',
	'wanttocheckbox' => 'no',
	'yourcheckbox' => 'Select Checkbox',
	'checkboxitems' => 'One, Two, Three, Four, Five',	
	), $atts ) );
	
	$output='<section class="restaurant-reservation-form p-30-0-30">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-xl-10">
				';if($headline_one || $headline_two){$output.='
					<div class="section-header-style-15 text-center">
					';if($headline_one){$output.='
						<h4 class="section-header-sub-title" ';if($headline_one_color){$output.='style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($headline_one).'</h4>
					';}$output.='	
					';if($headline_two){$output.='
						<h2 class="section-header-title" ';if($headline_two_color){$output.='style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.esc_attr($headline_two).'</h2>
					';}$output.='	
					</div>
				';}$output.='	
					<div class="contact-form">
						<form  method="POST" id="reservation_form">
							<div class="row align-items-center">
								<div class="col-lg-6">
									<div class="form-group">
										<input class="input-styled" type="text" name="name" id="sendername" placeholder="'.esc_attr($name_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input class="input-styled" type="text" name="phone" id="senderphone" placeholder="'.esc_attr($phone_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input class="input-styled" type="number" name="guest" id="sender_guest" placeholder="'.esc_attr($guest_field_placeholder).'" required>
									</div>
								</div>								
								<div class="col-lg-6">
									<div class="form-group">
										<input class="input-styled" type="text" name="date" id="senderdate" placeholder="'.esc_attr($date_field_placeholder).'" data-date-format="dd/mm/yyyy" required>	
									</div>
								</div>
								'; if($wanttoselect=="yes"){
								$output .= '<div class="col-lg-12">
										<div class="form-group">                               
										<select class="input-styled" name="cf-select" id="cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}

								$output .= '</select>
											</div>
											</div>';
								} $output .='	
						'; if($wanttoradio=="yes"){
						$output .= '<div class="col-lg-12">
									<div class="form-group">
									<label class="lable-text" for="cf-radio">'.esc_attr($yourradio).'</label><br>';
									$radioitemArray = explode(',', $radioitems);
									$i=1;
									foreach($radioitemArray as $radioitem){
										$output .= '<span class="mr-10"><input class="control-radio mr-10" type="radio" name="cf-radio" value="'.$radioitem.'"  id="cf-radio'.$i.'">'.$radioitem.'</span>';
										$i++;
									}
						$output .='</div></div>';
						} $output .='
						';if($wanttocheckbox=="yes"){
						$output .=  '<div class="col-lg-12">
									<div class="form-group">
						 <label class="lable-text" for="cf-checkbox">'.esc_attr($yourcheckbox).'</label><br>';
						 $checkboxitemArray = explode(',', $checkboxitems);
						 $i=1;
							foreach($checkboxitemArray as $checkboxitem){
									$output .=  '<span class="mr-10"><input type="checkbox" class="control-checkbox mr-10" name="cf-checkbox[]" value="'.$checkboxitem.'"  id="cf-checkbox'.$i.'">'.$checkboxitem.'</span>';
									$i++;
							}

						$output .='</div></div>';
						} $output .='</div>					
							<div class="form-group">
								<textarea class="input-styled" name="message" id="sendermessage" rows="10" placeholder="'.esc_attr($message_field_placeholder).'" required></textarea>
							</div>
							<div class="form-group py-15px text-center">
								<button class="button  comment-submit button-primary" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>
								
							</div>
							<div class="col-lg-12">
							<div class="alert alert-success display-none" id="success-msg">
							<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
							</div>	
							<div class="alert alert-danger display-none" id="failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
							</div>
							
  					<input type="hidden" name="email_subject" id="email_subject" value="'.esc_attr($email_subject).'" />
  					<input type="hidden" name="recipient_name" id="recipient_name" value="'.esc_attr($recipient_name).'" />
					<input type="hidden" name="recipient_email" id="recipient_email" value="'.sanitize_email($recipient_email).'" />
					
						</form>
					</div>
				</div>
			</div>			
		</div>	
		</section>';
		
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#reservation_form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#sendername").val();
                    var phone = jQuery("#senderphone").val();
                    var guest = jQuery("#sender_guest").val();
                    var date = jQuery("#senderdate").val();
                    var message = jQuery("#sendermessage").val();
                    var recipient_email = jQuery("#recipient_email").val();
                    var recipient_name = jQuery("#recipient_name").val();
                    var email_subject = jQuery("#email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";					
						var select = jQuery("#cf-select").val();
					'; } $output.='	
					
					'; if($wanttoradio=="yes"){ $output .= '				
						var radio = jQuery("input[name=cf-radio]:checked").val();
						var radio_title = "'.esc_attr($yourradio).'";
					'; } $output.='	
					
					';if($wanttocheckbox=="yes"){ $output .=  '				
						var checkbox_title = "'.esc_attr($yourcheckbox).'";
						var checkArray = [];					
						jQuery(".control-checkbox:checked").each(function(i,e) {
							checkArray.push(jQuery(this).val());
						});
					'; } $output.='						
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'ronby-reservation-form.php",
                        data: {name: name,phone:phone,message:message,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; }  if($wanttoradio=="yes"){ $output .= 'radio_title:radio_title,radio:radio,'; } if($wanttocheckbox=="yes"){ $output .= 'checkbox_title:checkbox_title,"checkbox[]":checkArray.join(),'; } $output.='date:date,guest:guest},
						complete: function(){
							jQuery("#reservation_form")[0].reset();
							jQuery(".contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
			jQuery("#senderdate").datepicker({
				format: "dd/mm/yyyy",
				startDate: "1d"
			});	
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_reservation_form', 'ronby_restaurant_reservation_form_shortcode');

/*****************************
Restaurant Open Table
******************************/
function ronby_restaurant_open_table_shortcode( $atts = array() ) {
	$atts = shortcode_atts( array(
		'restaurant-id' => '',
		'type'          => 'wide',
		'language'      => 'en',
		'iframe'        => 'true',
	), $atts );

	// If no restaurant ID has been specified, return an error message
	if ( ! $atts['restaurant-id'] ) {
		return sprintf( '<p>%s</p>', esc_html__( 'Error: Please specify your OpenTable restaurant ID.', 'ronby' ) );
	}

	// Build the embed URL
	$url = esc_url( add_query_arg( array(
		'rid'     => $atts['restaurant-id'],
		'domain'  => '',
		'type'    => 'standard',
		'theme'   => $atts['type'],
		'lang'    => $atts['language'],
		'overlay' => 'false',
		'iframe'  => $atts['iframe'],
	), 'https://www.opentable.com/widget/reservation/loader' ) );


	// Return the script tag
	return "<script type='text/javascript' src='$url'></script>";

}
add_shortcode( 'ronby_shortcode_for_restaurant_open_table', 'ronby_restaurant_open_table_shortcode' );

/*****************************
Restaurant Heading Section- 2
******************************/
//Function for Restaurant Heading Section-2
function ronby_restaurant_heading_section_shortcode_two( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading1_color' => '',
	'heading2' => '',
	'heading2_color' => '',
	), $atts ) );
		
	$output='<section class="restaurant_heading_sec p-30-0-30">
				<div class="section-header-style-15 mb-0">
				';if($heading1){$output.='
					<h4 class="section-header-sub-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h4>
				';}$output.='	
				';if($heading2){$output.='
					<h2 ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h2>
				';}$output.='	
				</div>
	</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_restaurant_heading_section_two', 'ronby_restaurant_heading_section_shortcode_two');

/*****************************
Restaurant Dashed Divider
******************************/
//Function for Restaurant Dashed Divider
function ronby_restaurant_dashed_divider( $atts ) {
	extract( shortcode_atts( array(
	'margin_top' => '',
	'margin_bottom' => '',
	), $atts ) );
		
	$output='<div class="divider-d-dashed" ';if($margin_top || $margin_bottom){$output.='style="';if($margin_top){$output.='margin-top:'.esc_attr($margin_top).';';}if($margin_bottom){$output.='margin-bottom:'.esc_attr($margin_bottom).'';}$output.='"';}$output.='></div>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_restaurant_dashed_divider', 'ronby_restaurant_dashed_divider');

/*****************************
Restaurant Text Box
******************************/
//Function for Restaurant Text Box
function ronby_text_box_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'desc' => '',
	), $atts ) );
		
	$output='<section class="p-30-0-30">
	<h3 class="mb-4">'.esc_attr($heading1).'</h3>
	<p>'.$desc.'</p>
	</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_text_box', 'ronby_text_box_shortcode');

/*****************************
Business Registration Form
******************************/
//Function for Business Registration Form
function ronby_business_registration_form_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'icon' => '',
	'heading1' => '',
	'heading2' => '',
    'icon_color'   => '',
    'headline_one_color'   => '',
    'headline_two_color'   => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',	
    'bg_img'   => '',	
    'up_arrow_icon'   => '',	
	
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Complete name',
	'email_field_placeholder' => 'Email address',
	'phone_field_placeholder' => 'Phone No',
	'button_label' => 'Register Now',	
	
	'wanttoselect' => 'no',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',	
	
	'wanttocheckbox' => 'no',
	'yourcheckbox' => 'Select Checkbox',
	'checkboxitems' => 'One, Two, Three, Four, Five',		
	), $atts ) );
	
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}		
	$output='<section class="row-xtra-space">
			<div class="container">
				<div class="form-request-consulation ';if($up_arrow_icon == 'style1'){$output.='before-arrow-1 row-xtra-space';}elseif($up_arrow_icon == 'style2'){$output.='before-arrow-2 row-xtra-space';}elseif($up_arrow_icon == 'style3'){$output.='before-arrow-3 row-xtra-space';}elseif($up_arrow_icon == 'style4'){$output.='before-arrow-4 row-xtra-space';}$output.='" ';if($images[0]){$output.='style="background:url('.esc_attr($images[0]).')center center no-repeat;background-size: cover;position: relative;"';}$output.='>
					<div class="overlay">
						<div class="section-header-style-4 text-center">
						';if($icon){$output.='
							<div class="icon color-primary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
								<i class="'.esc_attr($icon).'"></i>
							</div>
						';}$output.='
						';if($heading1){$output.='
							<h2 class="section-title" ';if($headline_one_color){$output.='style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
						';}$output.='
						';if($heading2){$output.='
							<h4 class="section-sub-title color-secondary" ';if($headline_two_color){$output.='style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.esc_attr($heading2).'</h4>
						';}$output.='	
						</div>

						<div class="section-content">
							<div class="form-style-1">
								<form id="business_registration_form" method="POST">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<input class="input-styled" name="sendername" type="text"  id="sendername" placeholder="'.esc_attr($name_field_placeholder).'" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input class="input-styled" name="email" type="email" id="senderemail" placeholder="'.esc_attr($email_field_placeholder).'" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<input class="input-styled" name="tel" type="tel" id="senderphone" placeholder="'.esc_attr($phone_field_placeholder).'" required>
											</div>
										</div>
								'; if($wanttoselect=="yes"){
								$output.='<div class="col-md-6">
										<div class="form-group">	
										<select class="input-styled" name="cf-select" id="cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}
								$output .= '</select>
											</div>
											</div>';
								} $output .='										
									</div>
									<div class="row mt-4 align-items-center">
									';if($wanttocheckbox=="yes"){
									$output .=  '<div class="col-md-8">
									';if($yourcheckbox){$output.='
									 <label class="text-lighten" for="cf-checkbox">'.esc_attr($yourcheckbox).'</label><br>';
									}
									 $checkboxitemArray = explode(',', $checkboxitems);
									 $i=1;
										foreach($checkboxitemArray as $checkboxitem){
												$output .=  '<span class="mr-10"><input type="checkbox" class="control-checkbox mr-10" name="cf-checkbox[]" value="'.$checkboxitem.'"  id="cf-checkbox'.$i.'">'.$checkboxitem.'</span>';
												$i++;
										}

									$output .='</div>';
									} $output .='
										<div class="col-md-4 text-right">
											<button class="button button-secondary rounded-capsule" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='><span class="button-text">'.esc_attr($button_label).'</span><img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>
										</div>
									</div>
							<div class="col-lg-12 nopadding">
							<div class="alert alert-success display-none mt-2" id="success-msg">
							<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
							</div>	
							<div class="alert alert-danger display-none mt-2" id="failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
							</div>									
  					<input type="hidden" name="email_subject" id="email_subject" value="'.esc_attr($email_subject).'" />
  					<input type="hidden" name="recipient_name" id="recipient_name" value="'.esc_attr($recipient_name).'" />
					<input type="hidden" name="recipient_email" id="recipient_email" value="'.sanitize_email($recipient_email).'" />									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>';
		
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#business_registration_form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#sendername").val();
                    var email = jQuery("#senderemail").val();
                    var phone = jQuery("#senderphone").val();

                    var recipient_email = jQuery("#recipient_email").val();
                    var recipient_name = jQuery("#recipient_name").val();
                    var email_subject = jQuery("#email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";					
						var select = jQuery("#cf-select").val();
					'; } $output.='	
					
					
					';if($wanttocheckbox=="yes"){ $output .=  '				
						var checkbox_title = "'.esc_attr($yourcheckbox).'";
						var checkArray = [];					
						jQuery(".control-checkbox:checked").each(function(i,e) {
							checkArray.push(jQuery(this).val());
						});
					'; } $output.='						
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'ronby-business-registration-form.php",
                        data: {name: name,email:email,phone:phone,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; }  if($wanttocheckbox=="yes"){ $output .= 'checkbox_title:checkbox_title,"checkbox[]":checkArray.join(),'; } $output.='},
						complete: function(){
							jQuery("#business_registration_form")[0].reset();
							jQuery(".contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_registration_form', 'ronby_business_registration_form_shortcode');

/*****************************
Business Feature Box
******************************/
//Function for Business Feature Box
function ronby_business_feature_box_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' => '',
	'desc' => '',
	'image' => '',
	'link_to_url' => '',
	'btn_name' => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
    'title_color'   => '',
    'desc_color'   => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}		
	$output='<article class="service-item-1 text-center p-30-0-30 mb-0">
							<div class="thumbnail animate-zoom">
							';if($images[0]){$output.='
								<a href="'.esc_url($link_to_url).'">
									<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
								</a>
							';}$output.='	
							</div>
							';if($heading){$output.='
							<a href="'.esc_url($link_to_url).'" class="no-color">
								<h3 class="item-title animate-300 hover-color-secondary" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>
									'.esc_attr($heading).'
								</h3>
							</a>
							';}$output.='
							';if($desc){$output.='
							<p class="item-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
								'.esc_attr($desc).'
							</p>
							';}$output.='
							';if($btn_name){$output.='
							<a href="'.esc_url($link_to_url).'" class="button button-secondary rounded-capsule" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>
								'.esc_attr($btn_name).'
							</a>
							';}$output.='
			</article>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_feature_box', 'ronby_business_feature_box_shortcode');

/*****************************
Business Heading Section- 1
******************************/
//Function for Business Heading Section- 1
function ronby_business_heading_sec_one_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	), $atts ) );
	
	$output='<!-- Section header -->
			<div class="section-header-style-3 p-30-0-30">
			';if($heading1){$output.='
				<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
			';}$output.='	
			';if($heading2){$output.='
				<h4 class="section-sub-title color-secondary" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h4>
			';}$output.='	
			</div>
			<!-- /Section header -->';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_heading_sec_one', 'ronby_business_heading_sec_one_shortcode');

/*****************************
Business Our Service Section
******************************/
//Function for Business Our Service Section
function ronby_business_our_service_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'desc' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	'desc_color' => '',
	'image' => '',
	'number_of_features' => '',
	'f_icon_color' => '',
	'f_icon_bg_color' => '',
	'f_title_color' => '',
	'f_desc_color' => '',
	'f_btn_color' => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}		
	$output='<section class="p-30-0-30">
			<div class="container">
				<div class="row">
					<div class=" ';if($images[0]){$output.='col-lg-8 col-xl-7';}else{$output.='col-lg-12 col-xl-12';}$output.='">
					<!-- Section header -->
					<div class="section-header-style-3">
					';if($heading1){$output.='
						<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
					';}$output.='	
					';if($heading2){$output.='
						<h4 class="section-sub-title color-secondary" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h4>
					';}$output.='	
					</div>
					<!-- /Section header -->
					';if($desc){$output.='
						<p class="mb-4" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
						'.esc_attr($desc).'
						</p>
					';}$output.='	
						<div class="row">';
	$i=1;
	$c=0;
	while ($i<=$number_of_features){
	$c++;
	$b = shortcode_atts(array(
		'icon'.$c.'' => '',
		'title'.$c.'' => '',
		'desc'.$c.'' => '',
		'btn_label'.$c.'' => '',
		'btn_url'.$c.'' => '',
    ),$atts);
	$icon =$b['icon'.$c.''];
	$title =$b['title'.$c.''];
	$desc =$b['desc'.$c.''];
	$btn_label =$b['btn_label'.$c.''];
	$btn_url =$b['btn_url'.$c.''];

	$output.='		<div class="col-sm-6">
								<div class="article-box-with-icon-2 d-flex align-items-center">
									<div class="flex-auto">
										<a href="'.esc_url($btn_url).'">
											<div class="coin-icon background-primary color-inverse animate-400 hover-background-secondary" ';if($f_icon_bg_color){$output.='style="background-color:'.esc_attr($f_icon_bg_color).'"';}$output.='>
												<i class="'.esc_attr($icon).'" ';if($f_icon_color){$output.='style="color:'.esc_attr($f_icon_color).'"';}$output.='></i>
											</div>
										</a>
									</div>
									<div class="flex-fill item-content">
										';if($title){$output.='
										<div class="item-title" ';if($f_title_color){$output.='style="color:'.esc_attr($f_title_color).'"';}$output.='>'.esc_attr($title).'</div>
										';}$output.='
										';if($desc){$output.='
										<div class="item-description" ';if($f_desc_color){$output.='style="color:'.esc_attr($f_desc_color).'"';}$output.='>
											'.esc_attr($desc).'
										</div>
										';}$output.='
										';if($btn_label){$output.='
										<a href="'.esc_url($btn_url).'" class="item-link color-secondary animate-300 hover-color-primary" ';if($f_btn_color){$output.='style="color:'.esc_attr($f_btn_color).'"';}$output.='>'.esc_attr($btn_label).'<i class="fas fa-chevron-right"></i></a>
										';}$output.='
									</div>									
								</div>
							</div>
	';$i++;
	}
	$output.='</div>
					</div>

					';if($images[0]){$output.='
						<div class="col-lg-4 col-xl-5">
						<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('right-side-image','ronby').'">
						</div>
					';}$output.='	
				</div>				
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_our_service_section', 'ronby_business_our_service_section_shortcode');

/*****************************
Business Event Section
******************************/
//Function for Business Event Section
function ronby_business_event_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' => '',
	'event_date' => '',
	'event_month' => '',
	'event_year' => '',
	'event_title' => '',
	'event_location' => '',
	'event_short_desc' => '',
	'btn_label' => '',
	'btn_url' => '',
	'event_countdown_date' => '',
	'section_bg_color' => '',
	'heading_color' => '',
	'heading_bg_color' => '',
	'date_box_bg' => '',
	'text_color' => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
    'btn_border_color'   => '',
	), $atts ) );
	
	$output='<section class="event-countdown-1 background-secondary color-inverse" ';if($section_bg_color){$output.='style="background-color:'.esc_attr($section_bg_color).'"';}$output.='>
			<div class="container">
				<div class="row">
				';if($heading){$output.='
					<div class="section-markup-text d-none d-lg-block col-lg-2" ';if($heading_bg_color){$output.='style="background-color:'.esc_attr($heading_bg_color).'"';}$output.='>
						<span ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($heading).'</span>
					</div>
				';}$output.='	
					<div class="col-lg-9 col-xl-8 offset-lg-1">
						<div class="section-content" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
							<div class="section-header d-sm-flex">
								<div class="flex-auto mb-4 mb-sm-0">
								';if($event_date || $event_month){$output.='
									<div class="section-markup-button text-center color-inverse" ';if($date_box_bg){$output.='style="background-color:'.esc_attr($date_box_bg).'"';}$output.='>
									';if($event_date){$output.='
										<div class="item-number">'.esc_attr($event_date).'</div>
									';}$output.='
									';if($event_month){$output.='
										<div class="item-text">'.esc_attr($event_month).'</div>
									';}$output.='	
									</div>
								';}$output.='	
								</div>
								<div class="flex-fill">
								';if($event_date || $event_month || $event_year){$output.='
									<div class="section-top-title">
										'.esc_attr__('Start Event','ronby').' - '.esc_attr($event_month).' '.esc_attr($event_date).' - '.esc_attr($event_year).'
									</div>
								';}$output.='
								';if($event_title){$output.='
									<h2 class="section-title">
										'.esc_attr($event_title).'
									</h2>
								';}$output.='
								';if($event_location){$output.='
									<div class="section-bottom-title">
										<i class="fas fa-map-marker-alt"></i>
										'.esc_attr($event_location).'
									</div>
								';}$output.='	
								</div>
							</div>
							';if($event_short_desc){$output.='
							<p class="font-italic">
								'.$event_short_desc.'
							</p>
							';}$output.='
							<div class="row">
							';if($event_countdown_date){$output.='
								<div class="col-sm-auto">
									<div class="mb-4 mb-xl-0">
										<ul class="countdown-style-1 d-flex flex-wrap justify-content-center" data-countdown-to="'.esc_attr($event_countdown_date).'">
		
										</ul>
									</div>
								</div>
							';}$output.='	
								<div class="col-sm-auto">
								';if($btn_label){$output.='
									<a href="'.esc_url($btn_url).'" class="button  button-secondary color-dark rounded-capsule" ';if($btn_bg_color || $btn_text_color || $btn_border_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';';}if($btn_border_color){$output.='border:2px solid '.esc_attr($btn_border_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).' !important;';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
								';}$output.='	
								</div>
							</div>
						</div>											
					</div>
				</div>				
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_event_section', 'ronby_business_event_section_shortcode');

/*****************************
Business Company Ranking Progress
******************************/
//Function for Business Company Ranking Progress
function ronby_business_company_ranking_progress_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'features' => '',
	'number_of_items' => '',
	'heading1' => '', 
	'heading2' => '',
	'list_items' => '',
	'description' => '',
	'btn_label' => '',
	'btn_url' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	'list_items_color' => '',
	'description_color' => '',
	'btn_text_color'   => '',
    'btn_bg_color'   => '',	
    'custom_dot_colors'   => '',	
	), $atts ) );
	
	if(!empty($features)){
      $out = '<div class="tabs-filter-header text-right mb-2">';
	  $features = !empty($features) ? explode("\n", trim($features)) : array(); 
		$c=-1;
      foreach($features as $feature) {
	  $feature = strip_tags($feature);
	  $c++;				
		$out .='<a href="#" class="tab active-background-secondary active-color-white animate-400 ';if($c == 0){$out.='active';}$out.='" data-tab="'.$feature.'">'.htmlspecialchars_decode($feature).'</a>';
      }
      $out .= '</div>';
      $content = $out;
    }	
	if(!empty($list_items)){
      $u_list = '<ul class="list-style-2">';
	  $list_items = !empty($list_items) ? explode("\n", trim($list_items)) : array(); 
	  $custom_dot_colors = !empty($custom_dot_colors) ? explode("\n", trim($custom_dot_colors)) : array(); 	  
	  $counter=-1;
	  if($custom_dot_colors){
	  foreach($custom_dot_colors as $cdc){
		  $color[]=$cdc;
	  }
	  }else{
		 $color=''; 
	  }
      foreach($list_items as $list_item) {
	  $list_item = strip_tags($list_item);
	  $counter++;				
		$u_list .='<li ';if($list_items_color){$u_list.='style="color:'.esc_attr($list_items_color).'"';}$u_list.='><span class="custom-dot" ';if($color){$u_list.='style="background:'.strip_tags($color[$counter]).'"';}$u_list.='></span>'.htmlspecialchars_decode($list_item).'</li>';
      }
      $u_list .= '</ul>';
    }	
	$output='<section class="p-30-0-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 mb-4">

						<div class="tabs-filter tabs-filter-style-1">
							'.do_shortcode($content).'
							<div class="tabs-filter-content">
							';
							$i=1;
							$c=0;
							while ($i <= $number_of_items){
							$c++;
					
							$b = shortcode_atts(array(
								'item_img'.$c.'' => '',
								'item_features'.$c.'' => '',
							),$atts);
								
							$item_img =$b['item_img'.$c.''];
							$item_features =$b['item_features'.$c.''];
							$output .='
								<div class="content-tab ';if($c == 1){$output .='active';}$output.='" data-tab="'.esc_attr( $item_features ).'">
									<img src="'.esc_url($item_img).'" alt="'.esc_attr__('progress-image','ronby').'">
								</div>
							';		
							$i++;
							}
							$output .='
							</div>
						</div>
					</div>

					<div class="col-lg-5">
						<div class="pl-lg-4">
							<div class="pl-35">
								<!-- Section header -->
								<div class="section-header-style-3">
								';if($heading1){$output.='
									<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
								';}$output.='
								';if($heading2){$output.='
									<h4 class="section-sub-title color-secondary" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h4>
								';}$output.='	
								</div>
								<!-- /Section header -->
								
								<div class="section-content">
									';if($list_items){$output.='
										'.$u_list.'
									';}$output.='	
									';if($description){$output.='
									<p ';if($description_color){$output.='style="color:'.esc_attr($description_color).'"';}$output.='>
									'.$description.'	
									</p>
									';}$output.='
									';if($btn_label){$output.='
									<a href="'.esc_url($btn_url).'" class="button button-secondary rounded-capsule" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
									';}$output.='
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_company_ranking_progress', 'ronby_business_company_ranking_progress_shortcode');

/*****************************
Business Feature Box Section
******************************/
//Function for Business Feature Box Section
function ronby_business_feature_box_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' => '',
	'desc' => '',
	'btn_label' => '',
	'btn_url' => '',
	'number_of_items' => '',
	'heading_color' => '',
	'desc_color' => '',	
	'btn_text_color'   => '',
    'btn_bg_color'   => '',		
    'f_icon_color'   => '',		
    'f_icon_bg_color'   => '',		
    'f_title_color'   => '',		
    'f_desc_color'   => '',		
	), $atts ) );
	
	$output='<section class="p-30-0-30 business-feature-box-sec">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<div class="mb-6">
						';if($heading){$output.='
							<h3 class="headline" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.$heading.'</h3>
						';}$output.='
						';if($desc){$output.='
							<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
								'.esc_attr($desc).'
							</p>
						';}$output.='	
						';if($btn_label){$output.='
							<div>
								<a href="'.esc_url($btn_url).'" class="button button-secondary rounded-capsule" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
							</div>
						';}$output.='	
						</div>
					</div>
							';
							$i=1;
							$c=0;
							while ($i <= $number_of_items){
							$c++;
					
							$b = shortcode_atts(array(
								'feature_icon'.$c.'' => '',
								'feature_title'.$c.'' => '',
								'feature_desc'.$c.'' => '',
								'feature_url'.$c.'' => '',
							),$atts);
								
							$feature_icon =$b['feature_icon'.$c.''];
							$feature_title =$b['feature_title'.$c.''];
							$feature_desc =$b['feature_desc'.$c.''];
							$feature_url =$b['feature_url'.$c.''];
							$output .='					
					<div class="col-md-4 col-lg-3">
						<div class="article-box-with-icon text-center mb-0">
						';if($feature_icon){$output.='
							<a href="'.esc_url($feature_url).'" class="no-color">
								<div class="icon coin-icon background-primary animate-400 hover-background-secondary" ';if($f_icon_bg_color){$output.='style="background-color:'.esc_attr($f_icon_bg_color).'"';}$output.='>
									<i class="'.esc_attr($feature_icon).'" ';if($f_icon_color){$output.='style="color:'.esc_attr($f_icon_color).'"';}$output.='></i>
								</div>
							</a>
						';}$output.='
						';if($feature_title){$output.='
						<a href="'.esc_url($feature_url).'" class="no-color">
							<h3 class="item-title" ';if($f_title_color){$output.='style="color:'.esc_attr($f_title_color).'"';}$output.='>'.esc_attr($feature_title).'</h3>
						</a>	
						';}$output.='	
						';if($feature_desc){$output.='
							<p ';if($f_desc_color){$output.='style="color:'.esc_attr($f_desc_color).'"';}$output.='>
								'.$feature_desc.'
							</p>
						';}$output.='	
						</div>
					</div>
							';		
							$i++;
							}
							$output .='

				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_feature_box_section', 'ronby_business_feature_box_section_shortcode');

/*****************************
Business Counter Section
******************************/
//Function for Business Counter Section
function ronby_business_counter_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'bg_img' => '',	
	'number_of_items' => '',	
	'overlay_color' => '',	
	'counter_no_color' => '',	
	'counter_title_color' => '',	
	'overlay_color' => '',	
	), $atts ) );
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}		
	$output='<section>
			<div class="container">
				<div class="counter-style-1 background-cover"  ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).');"';}$output.='>
					<div class="overlay" ';if($overlay_color){$output.='style="background-color:'.esc_attr($overlay_color).'"';}$output.='>
						<div class="row no-gutters">
							';
							$i=1;
							$c=0;
							while ($i <= $number_of_items){
							$c++;
					
							$b = shortcode_atts(array(
								'counter_no'.$c.'' => '',
								'counter_title'.$c.'' => '',
							),$atts);
								
							$counter_no =$b['counter_no'.$c.''];
							$counter_title =$b['counter_title'.$c.''];
							$output .='						
							<div class="col-sm-6 col-lg-3 counter-item">
								<div class="counter-number countUpNumber" data-to="'.esc_attr($counter_no).'" data-speed="2000" ';if($counter_no_color){$output.='style=color:'.esc_attr($counter_no_color).'';}$output.='>'.esc_attr($counter_no).'</div>
								<div class="counter-text color-primary" ';if($counter_title_color){$output.='style=color:'.esc_attr($counter_title_color).'';}$output.='>'.esc_attr($counter_title).'</div>
							</div>
							';		
							$i++;
							}
							$output .='
						</div>
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_counter_section', 'ronby_business_counter_section_shortcode');

/*****************************
Business Heading Section- 2
******************************/
//Function for Business Heading Section- 2
function ronby_business_heading_sec_two_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'icon' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	'icon_color' => '',
	), $atts ) );
	
	$output='<!-- Section header -->
			<div class="section-header-style-2 p-30-0-30 mb-0">
			';if($heading1){$output.='
				<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
			';}$output.='	
			';if($heading2){$output.='
				<h4 class="section-sub-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h4>
			';}$output.='
			';if($icon){$output.='
				<div class="separator background-primary color-primary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
						<div class="icon">
							<i class="'.esc_attr($icon).'" ></i>
						</div>
					</div>
			';}$output.='		
				</div>
				<!-- /Section header -->';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_heading_sec_two', 'ronby_business_heading_sec_two_shortcode');

/*****************************
Business Blog Section
******************************/
//Function for Business Blog Section
function ronby_business_blog_section_shortcode( $atts ) {
    extract(shortcode_atts(array(
    'multiple'   => '',
    'num_post'   => '-1',
    'word_limit'  => '50',
    'order'      => 'desc',
    'orderby'    => 'post_date',
	'btn_label' => '',
	'btn_url' => '',	
	'btn_text_color'   => '',
    'btn_bg_color'   => '',	
    ), $atts));

	$args = array(
			'posts_per_page'   => $num_post ,
			'cat' => $multiple,
			'order' => $order,
			'orderby' => $orderby,
			'post_status'      => 'publish',
			);
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);	
	$output='<section class="p-30-0-30 business-blog-section-element">
			<div class="container">
			<div class="row">';	
	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id() );	
	
	$output.='<div class="col-md-4">
						<article class="blog-post-item-1 mb-45">
							<div class="thumbnail thumbnail-rounded animate-zoom">
							';if($get_image){$output.='
							   <a href="'.esc_url(get_the_permalink()).'">
								  <div class="blog-p-f-img" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
							   </a>
							';}$output.='	
							';
							//check if post date meta switch in wordpress format is turned on 
                                if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){    
									if(function_exists('e_business_blog_section_wp_date_meta')) $output.=e_business_blog_section_wp_date_meta();
								   } 
                                // end wordpress format post date meta
                                else{    
								   if(function_exists('e_business_blog_section_theme_date_meta')) $output.=e_business_blog_section_theme_date_meta();
								   }								   
							$output.='
								
							</div>
							<div class="post-author-n-comments">
								';//author meta 
								if(function_exists('e_business_blog_author_meta')) {$output.=e_business_blog_author_meta();}
								//comment meta 
								if(function_exists('e_business_blog_section_comments_meta')) {$output.=e_business_blog_section_comments_meta($postid);}								
								$output.='
								
							</div>
							';if(get_the_title()){$output.='
							<a href="'.esc_url(get_the_permalink()).'" class="no-color">
								<h3 class="post-title hover-color-secondary animate-300">
									'.esc_attr(get_the_title()).'
								</h3>
							</a>
							';}$output.='
							<p class="post-excerpt m-0">
								';if ( has_post_format( 'video' ) ) : 
								$output.= ronby_content($word_limit); 
								else: 
								$output.= ronby_excerpt($word_limit);
								endif;
								$output.='
							</p>
						</article>

				</div>';
	

	endwhile;endif;	
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();
	if($btn_label){
	$output.='<div class="text-center w-100-percent">
			<a href="'.esc_url($btn_url).'" class="button button-secondary rounded-capsule" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>
			'.esc_attr($btn_label).'
			</a>
			</div>';	
	}		
	$output.='</div>
			</div>
			</section>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_ronby_business_blog_section', 'ronby_business_blog_section_shortcode');

/*****************************
Business Projects Grid
******************************/
//Function for Business Projects Grid
function ronby_business_projects_grid_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'number_of_items' => '',
	'title1_color' => '',
	'title2_color' => '',
	'search_bg_color' => '',
	'link_bg_color' => '',
	), $atts ) );
	
	$output='<section class="p-30-0-30">
			<div class="masonry masonry-no-gutter masonry-5-columns">
				<div class="masonry-sizer"></div>
				<div class="masonry-gutter"></div>
					';
					$i=1;
					$c=0;
					while ($i <= $number_of_items){
					$c++;
			
					$b = shortcode_atts(array(
						'img_url'.$c.'' => '',
						'headlineone'.$c.'' => '',
						'headlinetwo'.$c.'' => '',
						'link_to_url'.$c.'' => '',
					),$atts);
						
					$img_url =$b['img_url'.$c.''];
					$headlineone =$b['headlineone'.$c.''];
					$headlinetwo =$b['headlinetwo'.$c.''];
					$link_to_url =$b['link_to_url'.$c.''];
					$output .='				
				<div class="masonry-item">
					<article class="article-with-overlay-3">
					';if($img_url){$output.='
						<div class="thumbnail">
							<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'"/>
						</div>
					';}$output.='	
						<div class="overlay overlay-fill d-flex flex-column justify-content-end">
							<div class="item-text">
							';if($headlineone){$output.='
								<div class="item-sub-title color-primary" ';if($title1_color){$output.='style="color:'.esc_attr($title1_color).'"';}$output.='>'.esc_attr($headlineone).'</div>
							';}$output.='
							';if($headlinetwo){$output.='
								<div class="item-title" ';if($title2_color){$output.='style="color:'.esc_attr($title2_color).'"';}$output.='>'.esc_attr($headlinetwo).'</div>
							';}$output.='	
							</div>	
							<div class="item-buttons align-self-center">
								<a href="'.esc_url($img_url).'" class="quick-view background-primary color-inverse" data-lightbox="featured-image" ';if($search_bg_color){$output.='style="background-color:'.esc_attr($search_bg_color).'"';}$output.='>
									<i class="fas fa-search"></i>
								</a>
								';if($link_to_url){$output.='
								<a href="'.esc_url($link_to_url).'" class="link background-secondary color-inverse" ';if($link_bg_color){$output.='style="background-color:'.esc_attr($link_bg_color).'"';}$output.='>
									<i class="fas fa-link"></i>
								</a>
								';}$output.='
							</div>
						</div>
					</article>
				</div>
					';		
					$i++;
					}
					$output .='
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_projects_grid', 'ronby_business_projects_grid_shortcode');

/*****************************
Business Testimonial Slider
******************************/
//Function for Business Testimonial Slider
function ronby_business_testimonial_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'l_heading1' => '',
	'l_heading2' => '',
	'number_of_testimonial' => '',
	'r_heading1' => '',
	'r_heading2' => '',
	'l_heading1_color' => '',
	'l_heading2_color' => '',
	'text_color' => '',
	'name_color' => '',
	'designation_color' => '',	
	'r_heading1_color' => '',
	'r_heading2_color' => '',	
	'r_image' => '',	
	), $atts ) );
	$explode_image_ids = explode(',',$r_image);
	
	$output='<section class="color-inverse p-30-0-30 business-testimonial-sec">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="p-50-0">
							<div class="section-header-style-3">
							';if($l_heading1){$output.='
								<h2 class="section-title" ';if($l_heading1_color){$output.='style="color:'.esc_attr($l_heading1_color).'"';}$output.='>'.esc_attr($l_heading1).'</h2>
							';}$output.='
							';if($l_heading2){$output.='
								<h4 class="section-sub-title" ';if($l_heading2_color){$output.='style="color:'.esc_attr($l_heading2_color).'"';}$output.='>'.esc_attr($l_heading2).'</h4>
							';}$output.='	
							</div>
							<div class="tesimonial-slider-1 owl-carousel owl-arrow-style-1">
							';
							$i=1;
							$c=0;
							while ($i<=$number_of_testimonial){
							$c++;
							$b = shortcode_atts(array(
							'name'.$c.'' => '',
							'designation'.$c.'' => '',
							'text'.$c.'' => '',
							),$atts);
							$name =$b['name'.$c.''];
							$designation =$b['designation'.$c.''];
							$text =$b['text'.$c.''];
							$output.='							
							
								<div class="item">
									';if($text){$output.='
									<div class="item-text font-italic" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
										'.$text.'
									</div>
									';}$output.='	
									';if($name){$output.='
									<div class="item-title color-primary" ';if($name_color){$output.='style="color:'.esc_attr($name_color).'"';}$output.='>'.esc_attr($name).'</div>
									';}$output.='
									';if($designation){$output.='
									<div class="item-sub-title" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='>'.esc_attr($designation).'</div>
									';}$output.='
								</div>
							';	
							$i++;
							}
							$output.='
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="p-50-0">
							<div class="section-header-style-3">
							';if($r_heading1){$output.='
								<h2 class="section-title" ';if($r_heading1_color){$output.='style="color:'.esc_attr($r_heading1_color).'"';}$output.='>'.esc_attr($r_heading1).'</h2>
							';}$output.='
							';if($r_heading2){$output.='
								<h4 class="section-sub-title" ';if($r_heading2_color){$output.='style="color:'.esc_attr($r_heading2_color).'"';}$output.='>'.esc_attr($r_heading2).'</h4>
							';}$output.='
							</div>
							<div class="branches-logo d-flex flex-wrap justify-content-between align-items-center">
							';
							$c=0;
							foreach( $explode_image_ids as $image_id ){
							$images = wp_get_attachment_image_src( $image_id, 'r_image' );	
							$output.='								
							<img src="'.esc_url($images[$c]).'" alt="'.esc_attr__('brand-image','ronby').'">
							';}$c++;$output.='	
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_testimonial_slider', 'ronby_business_testimonial_slider_shortcode');

/*****************************
Business Category Section
******************************/
//Function for Business Category Section
function ronby_business_category_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'multiple' => '',	
	'txt_color' => '',	
	), $atts ) );
$explode = explode(',',$multiple);
foreach($explode as $expl){
	$cat_id[]=$expl;
}
$count=count($explode);
$i=1;
$c=0;	
$output='<section class="business-steps blog-page-business-steps">		
<div class="row no-gutters">';
while ($i <= $count){ 
$count_cat_words=str_word_count(get_cat_name($cat_id[$c]));
if($txt_color){
$color=$txt_color;
}else{
$color='#fff'; 
}
$start ='<span style="color:'.esc_attr($color).'">';
$end ='</span>';
$catname= get_cat_name($cat_id[$c]); 
if($count_cat_words > 1 ){   
$replace= preg_replace("~\W\w+\s*$~", ' ' . $start . '\\0'.$end, $catname );
}else{
$replace= $start.$catname.$end;	
}

$output.='<div class="col-md-4">
				<div class="article-with-overlay-1">
					<div class="thumbnail animate-zoom">
						<div style="background-image:url(';if(!empty(get_option('ronby_taxonomy_image'.$cat_id[$c]))){ $output.= esc_url(get_option('ronby_taxonomy_image'.$cat_id[$c]));} else{ $output.=esc_url(get_template_directory_uri()."/images/placeholder.png");}$output.=');" class="blog-cat-f-section"></div>
					</div>
					<a href="'.get_category_link($cat_id[$c]).'">
						<div class="overlay overlay-fill d-flex flex-column justify-content-center">
							<div class="overlay-content text-center">
							'.$replace.'	
							</div>
						</div>	
					</a>					
				</div>
			</div>';
$i++; $c++;}
$output.='</div>		
		</section>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_business_category_section', 'ronby_business_category_section_shortcode');

/*****************************
Construction Heading Section
******************************/
//Function for Construction Heading Section
function ronby_construction_heading_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	), $atts ) );
	
	$output='<!-- Section header -->
			<div class="section-header-style-4 p-30-0-30 mb-0">
			';if($heading1){$output.='
				<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
			';}$output.='	
			';if($heading2){$output.='
				<h4 class="section-sub-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h4>
			';}$output.='		
				</div>
			<!-- /Section header -->';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_heading_sec', 'ronby_construction_heading_sec_shortcode');

/*****************************
Construction Feature Box
******************************/
//Function for Construction Feature Box
function ronby_construction_feature_box_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'icon' => '',
	'heading1' => '',
	'heading2' => '',
	'desc' => '',
	'link_to_url' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	'icon_color' => '',
	'desc_color' => '',
	'box_bg_color' => '',
	'image' => '',
	), $atts ) );
	$expl_img_ids = explode(',',$image);
	foreach( $expl_img_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<article class="article-with-overlay-5 p-30-0-30 mb-0">
				';if($get_image[0]){$output.='
				<div class="thumbnail">
					<img src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
				</div>
				';}$output.='
				<a href="'.esc_url($link_to_url).'">
					<div class="overlay overlay-fill" ';if($box_bg_color){$output.='style="background-color:'.esc_attr($box_bg_color).';"';}$output.='>
					';if($icon){$output.='
						<div class="icon color-primary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
							<i class="'.esc_attr($icon).'"></i>
						</div>
					';}$output.='
					';if($heading1){$output.='
						<div class="item-description" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>
							'.esc_attr($heading1).'
						</div>
					';}$output.='
					';if($heading2){$output.='
						<h3 class="item-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>
							'.esc_attr($heading2).'
						</h3>
					';}$output.='	
					';if($desc){$output.='
						<div class="item-excerpt d-none d-xl-block" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
							'.$desc.'
						</div>
					';}$output.='	
					</div>
				</a>
				';if($link_to_url){$output.='
				<a href="'.esc_url($link_to_url).'" class="arrow">
					<i class="fas fa-angle-right"></i>
				</a>
				';}$output.='
			</article>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_feature_box', 'ronby_construction_feature_box_shortcode');

/*****************************
Construction Button
******************************/
//Function for Construction Button
function ronby_construction_button_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'btn_label' => '',
	'btn_url' => '',
	'btn_bg_color' => '',
	'btn_text_color' => '',
	), $atts ) );
	
	$output='<div class="text-center">
			';if($btn_label){$output.='
				<a href="'.esc_url($btn_url).'" class="button button-primary rounded" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
			';}$output.='	
			</div>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_button', 'ronby_construction_button_shortcode');

/*****************************
Construction Our Service section
******************************/
//Function for Construction Our Service section
function ronby_construction_our_service_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'desc' => '',
	'list_items' => '',
	'btn_label' => '',
	'btn_url' => '',
	'image' => '',
	'behind_img_bg' => '',
	'btn_bg_color' => '',
	'btn_text_color' => '',	
	'sec_bg_img' => '',	
	'sec_bg_color' => '',	
	'heading1_color' => '',
	'heading2_color' => '',
	'desc_color' => '',
	'list_items_color' => '',	
	), $atts ) );
$list_items = !empty($list_items) ? explode("\n", trim($list_items)) : array(); 
$item='';	
foreach($list_items as $list_item){
	
$item.='<li class="before-background-primary" ';if($list_items_color){$item.='style="color:'.esc_attr($list_items_color).'"';}$item.='>'.htmlspecialchars_decode($list_item).'</li>';
}

$expl_img_ids = explode(',',$image);
foreach( $expl_img_ids as $image_id ){
$get_image = wp_get_attachment_image_src( $image_id, 'image' );
}	
$sec_bg_img_ids = explode(',',$sec_bg_img);
foreach( $sec_bg_img_ids as $sec_bg_img_id ){
$sec_bg_img = wp_get_attachment_image_src( $sec_bg_img_id, 'sec_bg_img' );
}
	$output='<section class="section-we-provide-services p-30-0-30" ';if($sec_bg_img[0] || $sec_bg_color){$output.='style="background:';if($sec_bg_color){$output.=esc_attr($sec_bg_color);}if($sec_bg_img[0]){$output.='url('.esc_url($sec_bg_img[0]).');background-size: cover;background-repeat: no-repeat;background-position: center center;';}$output.='"';}$output.='>
						<div class="container">
							<div class="row align-items-center">
								<div class="col-lg-6">
									<div class="p-40-0">
									';if($heading1 || $heading2){$output.='
										<div class="section-header">
											<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).' <span ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</span></h2>
										</div>
									';}$output.='	
										<div class="">
										';if($desc){$output.='
											<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
											'.$desc.'
											</p>
										';}$output.='
										';if($list_items){$output.='
											<ul class="list-style-3">
												'.$item.'
											</ul>
										';}$output.='	
										</div>
										';if($btn_label){$output.='
										<div class="">
											<a href="'.esc_url($btn_url).'" class="button button-secondary rounded" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
										</div>
										';}$output.='
									</div>
								</div>
								<div class="d-none d-lg-block col-lg-6">
									<div class="image-box-1">
									';if($get_image[0]){$output.='
										<img class="w-380px" src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
									';}$output.='	
										<div class="behind-bg" ';if($behind_img_bg){$output.='style="background-color:'.esc_attr($behind_img_bg).'"';}$output.='></div>
									</div>
								</div>
							</div>
						</div>
					</section>	';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_our_service', 'ronby_construction_our_service_sec_shortcode');

/*****************************
Construction Counter Section
******************************/
//Function for Construction Counter Section
function ronby_construction_counter_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'number_of_items' => '',	
	'counter_no_color' => '',	
	'counter_title_color' => '',		
	), $atts ) );
	
	$output='<section class="counter-style-2 p-30-0-30">
				<div class="container">
					<ul class="unstyled row">';

					$i=1;
					$c=0;
					while ($i <= $number_of_items){
					$c++;
			
					$b = shortcode_atts(array(
						'counter_no'.$c.'' => '',
						'counter_title'.$c.'' => '',
					),$atts);
						
					$counter_no =$b['counter_no'.$c.''];
					$counter_title =$b['counter_title'.$c.''];
					$output .='		
					<li class="col">
						<div class="counter-number counterUp" data-to="'.esc_attr($counter_no).'" data-speed="3000" ';if($counter_no_color){$output.='style=color:'.esc_attr($counter_no_color).'';}$output.='>'.esc_attr($counter_no).'</div>
						<div class="counter-lb" ';if($counter_title_color){$output.='style=color:'.esc_attr($counter_title_color).'';}$output.='>'.esc_attr($counter_title).'</div>
					</li>					
					';		
					$i++;
					}
						
	$output.='</ul>
			</div>
		</section>';		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_counter_section', 'ronby_construction_counter_section_shortcode');

/*****************************
Construction Feature Box-2
******************************/
//Function for Construction Feature Box-2
function ronby_construction_feature_box_two_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' => '',
	'desc' => '',
	'link_to_url' => '',
	'btn_label' => '',
	'heading_color' => '',
	'desc_color' => '',
	'btn_color' => '',
	'image' => '',
	), $atts ) );
	$expl_img_ids = explode(',',$image);
	foreach( $expl_img_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<article class="blog-post-item-3 p-30-0-30 mb-0">
				<div class="thumbnail animate-zoom">
				';if($get_image[0]){$output.='
					<a href="'.esc_url($link_to_url).'">
						<img src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
					</a>
				';}$output.='	
				</div>
				';if($heading){$output.='
				<a href="'.esc_url($link_to_url).'" class="no-color">
					<h3 class="post-title hover-color-primary" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($heading).'</h3>
				</a>
				';}$output.='
				';if($desc){$output.='
				<p class="post-excerpt" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>											
					'.$desc.'											
				</p>
				';}$output.='
				';if($btn_label){$output.='
				<a href="'.esc_url($link_to_url).'" class="permalink hover-color-primary after-background-primary" ';if($btn_color){$output.='style="color:'.esc_attr($btn_color).'"';}$output.='>
					'.esc_attr($btn_label).'
				</a>
				';}$output.='
			</article>';
		
	return $output;
	
}
add_shortcode('ronby_shortcode_for_construction_feature_box_two', 'ronby_construction_feature_box_two_shortcode');

/*****************************
Construction Projects Tab Section
******************************/
//Function for Construction Projects Tab Section
function ronby_construction_projects_tab_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'showall' => '',
	'features' => '',
	'number_of_items' => '',
	), $atts ) );
	
	$i=0;
	while ($i <= $number_of_items){	
	$count=$i;	
	$i++;
	}
	if(!empty($features)){
      $output = '<div class="flex-auto">
						<div class="filter-nav-2">	  
							<div id="filters">
				  <ul class="list-unstyled">
				  ';if($showall){$output.='
					<li  class="tab active-color-primary hover-color-primary animate-300 is-checked active" data-filter="*">
						<span class="text">'.esc_attr($showall).'</span>
						<span class="count">
							<span class="number">'.esc_attr($count).'</span>
						</span>
				  </li>';
				  }
      $features = !empty($features) ? explode("\n", trim($features)) : array(); 

	  $c=-1;
      foreach($features as $feature) {
	  $feature = strip_tags($feature);
	  $c++;
      $output .= '<li class="tab active-color-primary hover-color-primary animate-300" data-filter=".'.$feature.'">';
				
	  $output .=''.htmlspecialchars_decode($feature).'</li>';
      }
      $output .= '</ul></div></div></div>';
      $content = $output;
    }
	
	$out = '<section class="construction-our-projects p-30-0-30">
    <div class="container"><div class="tabs-filter tabs-filter-default d-md-flex">';
    $out .= ''.do_shortcode($content).'';
	$out .= '<div class="flex-fill">
			<div class="grid">';
							$i=1;
							$c=0;
							while ($i <= $number_of_items){
							$c++;
			
							$b = shortcode_atts(array(
								'item_img'.$c.'' => '',
								'item_title'.$c.'' => '',
								'item_url'.$c.'' => '',
								'item_features'.$c.'' => '',
							),$atts);
								
							$item_img =$b['item_img'.$c.''];
							$item_title =$b['item_title'.$c.''];
							$item_url =$b['item_url'.$c.''];
							$item_features =$b['item_features'.$c.''];
$out .='<div class="col-sm-6 col-lg-4 element-item '.esc_attr( $item_features ).'" data-category="'.esc_attr( $item_features ).'">
		<div class="article-with-overlay-4">
		';if($item_img){$out.='
			<a href="'.esc_url($item_url).'" class="thumbnail">
				<img src="'.esc_url($item_img).'" alt="'.esc_attr__('featured-image','ronby').'">
			</a>
		';}$out.='	
			<a href="'.esc_url($item_url).'">
				<div class="overlay overlay-fill d-flex align-items-center flex-column justify-content-center">
					<div class="icon">
						<i class="fas fa-search"></i>
					</div>
					<div>
						<h3 class="post-title">
							'.esc_attr($item_title).'
						</h3>
					</div>													
				</div>
			</a>
		</div>
	</div>';	
	$i++;
	}
	$out .='				
      </div>
      </div>
      </div>
    </div>
  </section>';
  $out.='<script>
  jQuery(function() {       
  jQuery(".filter-nav-2 li").click(function() {   
		jQuery(".filter-nav-2 li").removeClass("active");      
		jQuery(this).addClass("active");      
	  });
	});
  </script>';
    return $out;		

}
add_shortcode('ronby_shortcode_for_construction_projects_tab_section', 'ronby_construction_projects_tab_sec_shortcode');

/*****************************
ResCon FAQ
******************************/
//Function for ResCon FAQs
function ronby_construction_faq_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'heading_style' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	'number_of_items' => '',
	'faq_title_color' => '',
	'faq_desc_color' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'padding_left' => '',
	'padding_right' => '',
	), $atts ) );
	
	$output='<section ';if($padding_top || $padding_bottom || $padding_left || $padding_right){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}if($padding_left){$output.='padding-left:'.esc_attr($padding_left).';';}if($padding_right){$output.='padding-right:'.esc_attr($padding_right).';';} $output.='"';}$output.=' class="construction-faq">
			<div class="flex-fill section-left d-flex">
							<div class="section-left-content">
							<!-- Section header -->
				';if($heading1 || $heading2){
				if($heading_style=="one"){
				$output.='
				<div class="team-detail-3">
				<div class="team-detail-header">
					<div class="team-detail-title">
					';if($heading1){$output.='
						<div class="top-text color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</div>
					';}$output.='	
					';if($heading2){$output.='
						<h2 class="bottom-text" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.$heading2.'</h2>
					';}$output.='	
					</div>
				</div>
				</div>
				';} else { $output.='
				<div class="section-header-style-4 p-30-0-30 mb-0">
					';if($heading1){$output.='
					<h2 class="section-title"';if($heading1_color){$output.=' style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>	
					';}$output.='	
					';if($heading2){$output.='
					<h4 class="section-sub-title"';if($heading2_color){$output.=' style="color:'.esc_attr($heading2_color).'"';}$output.='>'.$heading2.'</h4>
					';}$output.='
				</div>
				';} } $output.='
							<!-- /Section header -->
					';
					$i=1;
					$c=0;
					while ($i <= $number_of_items){
					$c++;
			
					$b = shortcode_atts(array(
						'faq_img_src'.$c.'' => '',
						'faq_title'.$c.'' => '',
						'faq_desc'.$c.'' => '',
						'faq_link_to_url'.$c.'' => '',
					),$atts);
						
					$faq_img_src =$b['faq_img_src'.$c.''];
					$faq_title =$b['faq_title'.$c.''];
					$faq_desc =$b['faq_desc'.$c.''];
					$faq_link_to_url =$b['faq_link_to_url'.$c.''];
					$output .='							
								<div class="question-item">
									<div class="row align-items-center">
									';if($faq_img_src){$output.='
										<div class="d-none d-sm-block  col-sm-3 col-md-2">
											<div class="thumbnail animate-zoom">
												<a href="'.esc_url($faq_link_to_url).'">
													<img src="'.esc_url($faq_img_src).'" alt="'.esc_attr__('featured-image','ronby').'">
												</a>
											</div>
										</div>
									';}$output.='	
										<div class="col-sm-9 col-md-10">
										';if($faq_title){$output.='
											<a class="no-color" href="'.esc_url($faq_link_to_url).'"><h3 class="item-title before-color-primary animte-300 hover-color-primary" ';if($faq_title_color){$output.='style="color:'.esc_attr($faq_title_color).'"';}$output.='>'.esc_attr($faq_title).'</h3></a>
										';}$output.='
										';if($faq_desc){$output.='
											<p class="item-text mb-0" ';if($faq_desc_color){$output.='style="color:'.esc_attr($faq_desc_color).'"';}$output.='>
											'.$faq_desc.'	
											</p>
										';}$output.='	
										</div>
									</div>
								</div>
					';		
					$i++;
					}
						
					$output.='</div>
					</div></section>';
		
	return $output;
	
}
add_shortcode('ronby_shortcode_for_construction_faq', 'ronby_construction_faq_shortcode');

/*****************************
ResCon Contact Form
******************************/
//Function for ResCon Contact Form
function ronby_construction_contact_form_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'headline_one'   => '',
    'headline_two'   => '',
    'headline_one_color'   => '',
    'headline_two_color'   => '',
	'heading_style' => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
    'sec_bg_img'   => '',
    'overlay_bg'   => '',
    'padding_left'   => '',
    'padding_right'   => '',
    'padding_top'   => '',
    'padding_bottom'   => '',
    'label_color'   => '',
	
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Your name *',
	'email_field_placeholder' => 'Your email *',
	'phone_field_placeholder' => 'Your problem',
	'message_field_placeholder' => 'Your Message *',
	'button_label' => 'Send Message',

	'wanttophone' => 'no',
	'wanttomsg' => 'no',
	'wanttoselect' => 'no',
	'yourselect_label' => '',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',
	'wanttoradio' => 'no',
	'yourradio' => 'Select Radio',
	'radioitems' => 'One, Two, Three, Four, Five',
	'wanttocheckbox' => 'no',
	'yourcheckbox' => 'Select Checkbox',
	'checkboxitems' => 'One, Two, Three, Four, Five',	
	), $atts ) );
	
	$expl_img_ids = explode(',',$sec_bg_img);
	foreach( $expl_img_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'sec_bg_img' );
	}	
	
	$output='<section class="construction-contact-form section-right section-form-box m-0" ';if($get_image[0]){$output.='style="background-image:url('.esc_url($get_image[0]).');background-size: cover;background-position: center center;"';}$output.='>
		<div class="overlay pl-0" ';if($overlay_bg){$output.='style="background-color:'.esc_attr($overlay_bg).'"';}$output.='>
				<div class="section-right-content" ';if($padding_top || $padding_bottom || $padding_left || $padding_right){$output.='style="';if($padding_left){$output.='padding-left:'.esc_attr($padding_left).';';}if($padding_right){$output.='padding-right:'.esc_attr($padding_right).';';}if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
				';if($headline_one || $headline_two){
				if($heading_style=="one"){
				$output.='
				<div class="team-detail-3">
				<div class="team-detail-header">
					<div class="team-detail-title">
					';if($headline_one){$output.='
						<div class="top-text color-primary" ';if($headline_one_color){$output.='style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($headline_one).'</div>
					';}$output.='	
					';if($headline_two){$output.='
						<h2 class="bottom-text" ';if($headline_two_color){$output.='style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.$headline_two.'</h2>
					';}$output.='	
					</div>
				</div>
				</div>
				';} else { $output.='
				<div class="section-header-style-4 p-30-0-30 mb-0">
					';if($headline_one){$output.='
					<h2 class="section-title"';if($headline_one_color){$output.=' style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($headline_one).'</h2>	
					';}$output.='	
					';if($headline_two){$output.='
					<h4 class="section-sub-title"';if($headline_two_color){$output.=' style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.$headline_two.'</h4>
					';}$output.='
				</div>
				';} } $output.='	
					<div class="form-style-4">
						<form  method="POST" id="construction_contact_form">
							<div class="row align-items-center">
								<div class="col-lg-12">
									<div class="form-group">
									<label for="sendername" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('Full Name','ronby').'</label>
										<input class="input-styled" type="text" name="name" id="sendername" placeholder="'.esc_attr($name_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
									<label for="senderemail" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('Email','ronby').'</label>
										<input class="input-styled" type="email" name="email" id="senderemail" placeholder="'.esc_attr($email_field_placeholder).'" required>
									</div>
								</div>
								'; if($wanttophone=="yes"){ $output.='
								<div class="col-lg-12">
									<div class="form-group">
									<label for="senderphone" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('Phone No.','ronby').'</label>
										<input class="input-styled" type="text" name="senderphone" id="senderphone" placeholder="'.esc_attr($phone_field_placeholder).'" required>
									</div>
								</div>
								';} $output.='
								'; if($wanttoselect=="yes"){
								$output .= '<div class="col-lg-12">
										<div class="form-group">                  <label for="cf-select" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr($yourselect_label).'</label>             
										<select class="input-styled" name="cf-select" id="cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}

								$output .= '</select>
											</div>
											</div>';
								} $output .='	
						'; if($wanttoradio=="yes"){
						$output .= '<div class="col-lg-12">
									<div class="form-group" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>
									<label class="lable-text" for="cf-radio" >'.esc_attr($yourradio).'</label><br>';
									$radioitemArray = explode(',', $radioitems);
									$i=1;
									foreach($radioitemArray as $radioitem){
										$output .= '<span class="mr-10"><input class="control-radio mr-10" type="radio" name="cf-radio" value="'.$radioitem.'"  id="cf-radio'.$i.'">'.$radioitem.'</span>';
										$i++;
									}
						$output .='</div></div>';
						} $output .='
						';if($wanttocheckbox=="yes"){
						$output .=  '<div class="col-lg-12">
									<div class="form-group" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>
						 <label class="lable-text" for="cf-checkbox">'.esc_attr($yourcheckbox).'</label><br>';
						 $checkboxitemArray = explode(',', $checkboxitems);
						 $i=1;
							foreach($checkboxitemArray as $checkboxitem){
									$output .=  '<span class="mr-10"><input type="checkbox" class="control-checkbox mr-10" name="cf-checkbox[]" value="'.$checkboxitem.'"  id="cf-checkbox'.$i.'">'.$checkboxitem.'</span>';
									$i++;
							}

						$output .='</div></div>';
						} $output .='</div>	
						'; if($wanttomsg=="yes"){ $output.='
							<div class="form-group">
							<label for="sendermessage" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('How can we help ?','ronby').'</label>
								<textarea class="input-styled" name="message" id="sendermessage" rows="3" placeholder="'.esc_attr($message_field_placeholder).'" required></textarea>
							</div>
						';}$output.='	
							<div class="pt-4">
								<button class="button button-primary rounded" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>
								
							</div>
							<div class="col-lg-12 nopadding">
							<div class="alert alert-success display-none mt-2" id="success-msg">
							<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
							</div>	
							<div class="alert alert-danger display-none mt-2" id="failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
							</div>
							
  					<input type="hidden" name="email_subject" id="email_subject" value="'.esc_attr($email_subject).'" />
  					<input type="hidden" name="recipient_name" id="recipient_name" value="'.esc_attr($recipient_name).'" />
					<input type="hidden" name="recipient_email" id="recipient_email" value="'.sanitize_email($recipient_email).'" />
					
						</form>
					</div>
				</div>
			</div>			
		</section>';
		
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#construction_contact_form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#sendername").val();
                    var email = jQuery("#senderemail").val();
                    var phone = jQuery("#senderphone").val();
                    var message = jQuery("#sendermessage").val();
                    var recipient_email = jQuery("#recipient_email").val();
                    var recipient_name = jQuery("#recipient_name").val();
                    var email_subject = jQuery("#email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";					
						var select = jQuery("#cf-select").val();
					'; } $output.='	
					
					'; if($wanttoradio=="yes"){ $output .= '				
						var radio = jQuery("input[name=cf-radio]:checked").val();
						var radio_title = "'.esc_attr($yourradio).'";
					'; } $output.='	
					
					';if($wanttocheckbox=="yes"){ $output .=  '				
						var checkbox_title = "'.esc_attr($yourcheckbox).'";
						var checkArray = [];					
						jQuery(".control-checkbox:checked").each(function(i,e) {
							checkArray.push(jQuery(this).val());
						});
					'; } $output.='						
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'ronby-construction-form.php",
                        data: {name: name,email:email,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; }  if($wanttoradio=="yes"){ $output .= 'radio_title:radio_title,radio:radio,'; } if($wanttocheckbox=="yes"){ $output .= 'checkbox_title:checkbox_title,"checkbox[]":checkArray.join(),'; } if($wanttomsg=="yes"){ $output .= 'message:message,'; }if($wanttophone=="yes"){ $output .= 'phone:phone,'; } $output.='},
						complete: function(){
							jQuery("#construction_contact_form")[0].reset();
							jQuery(".contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_contact_form', 'ronby_construction_contact_form_shortcode');

/*****************************
Construction Blog Section
******************************/
//Function for Construction Blog Section
function ronby_construction_blog_section_shortcode( $atts ) {
    extract(shortcode_atts(array(
    'multiple'   => '',
    'num_post'   => '-1',
    'word_limit'  => '50',
    'order'      => 'desc',
    'orderby'    => 'post_date',
	'btn_label' => '',
	'btn_url' => '',	
	'btn_text_color'   => '',
    'btn_bg_color'   => '',	
    ), $atts));

	$args = array(
			'posts_per_page'   => $num_post ,
			'cat' => $multiple,
			'order' => $order,
			'orderby' => $orderby,
			'post_status'      => 'publish',
			);
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);	
	$output='<section class="p-30-0-30 business-blog-section-element">
			<div class="container">
			<div class="row">';	
	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id() );	
	
	
$output.='<div class="col-lg-6"><article class="blog-post-item-2">
		<div class="row">
			<div class="col-4 col-thumbnail">
				';if($get_image){$output.='
						   <a href="'.esc_url(get_the_permalink()).'" class="thumbnail animate-zoom">
							  <div class="blog-p-f-img h-350"  style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
						   </a>
				';}$output.='
				
			</div>
			<div class="col-8 col-meta">
				<a class="no-color" href="">
					<h3 class="post-title animate-300 hover-color-primary">'.esc_attr(get_the_title()).'</h3>
				</a>
				';//author meta 
				if(function_exists('e_business_thumbnail_category_meta')) {$output.=e_business_thumbnail_category_meta();}							
				$output.='
				<p class="post-excerpt">
					';if ( has_post_format( 'video' ) ) : 
					$output.= ronby_content($word_limit); 
					else: 
					$output.= ronby_excerpt($word_limit);
					endif;
					$output.='	
				</p>
				<div class="post-author d-flex align-items-center">
				';//author meta 
				if(function_exists('e_business_thumbnail_author_avatar_meta')) {$output.=e_business_thumbnail_author_avatar_meta();}
				$output.='
					<div>
				';//author meta 
				if(function_exists('e_business_thumbnail_author_meta')) {$output.=e_business_thumbnail_author_meta();}

				//check if post date meta switch in wordpress format is turned on 
					if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){    
						if(function_exists('e_business_thumbnail_wp_date_meta')) $output.=e_business_thumbnail_wp_date_meta();
					   } 
					// end wordpress format post date meta
					else{    
					   if(function_exists('e_business_thumbnail_theme_date_meta')) $output.=e_business_thumbnail_theme_date_meta();
					   }								   
				$output.='
					</div>
				</div>
			</div>
		</div>
	</article>
	</div>';
	
	endwhile;endif;	
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();
	if($btn_label){
	$output.='<div class="text-center w-100-percent">
			<a href="'.esc_url($btn_url).'" class="button button-primary rounded" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>
			'.esc_attr($btn_label).'
			</a>
			</div>';	
	}		
	$output.='</div>
			</div>
			</section>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_blog_section', 'ronby_construction_blog_section_shortcode');

/*****************************
Construction Project Details Section
******************************/
//Function for Construction Project Details Section
function ronby_construction_project_details_section_shortcode( $atts ) {
    extract(shortcode_atts(array(
    'heading'   => '',
    'client_name'   => '',
    'surface_area'   => '',
    'value'   => '',
    'location'   => '',
    'completed_year'   => '',
    'architect_name'   => '',
    'featured_image'   => '',
    'slides_image'   => '',
    'desc'   => '',
    'list_items'   => '',
    'short_desc'   => '',
	
    'headline_one'   => '',
    'headline_two'   => '',
    'headline_one_color'   => '',
    'headline_two_color'   => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
    'sec_bg_img'   => '',
    'overlay_bg'   => '',
    'padding_left'   => '',
    'padding_right'   => '',
    'padding_top'   => '',
    'padding_bottom'   => '',
    'label_color'   => '',
    'sec_heading_color'   => '',
    'sec_title_color'   => '',
    'sec_desc_color'   => '',
	
	'social_share_switch'   => '',
	'contact_form_switch'   => '',
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Your name *',
	'email_field_placeholder' => 'Your email *',
	'phone_field_placeholder' => 'Your problem',
	'message_field_placeholder' => 'Your Message *',
	'button_label' => 'Send Message',

	'wanttomsg' => 'no',
	'wanttoselect' => 'no',
	'yourselect_label' => '',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',
	'wanttoradio' => 'no',
	'yourradio' => 'Select Radio',
	'radioitems' => 'One, Two, Three, Four, Five',
	'wanttocheckbox' => 'no',
	'yourcheckbox' => 'Select Checkbox',
	'checkboxitems' => 'One, Two, Three, Four, Five',		
    ), $atts));
	
	$expl_img_ids = explode(',',$featured_image);
	foreach( $expl_img_ids as $feature_image_id ){
    $featured_img = wp_get_attachment_image_src( $feature_image_id, 'featured_image' );
	}	
	$expl_slides_img_ids = explode(',',$slides_image);

if(!empty($list_items)){
	$out = '<ul class="list-style-3">';
	$list_items = !empty($list_items) ? explode("\n", trim($list_items)) : array(); 
	$c=-1;
	foreach($list_items as $list_item) {
	$list_item = strip_tags($list_item);
	$c++;
	$out .='<li class="before-background-primary">'.htmlspecialchars_decode($list_item).'</li>';
	}
	$out .= '</ul>';
	$content = $out;
}	
$expl_sec_img_ids = explode(',',$sec_bg_img);
foreach( $expl_sec_img_ids as $expl_sec_img_id ){
$get_image = wp_get_attachment_image_src( $expl_sec_img_id, 'sec_bg_img' );
}
	$output='<section class="construction-projec-details-sec">
						<div class="project-detail-2">
							
							<div class="project-detail-header">
								<h2 class="header-title" ';if($sec_heading_color){$output.='style="color:'.esc_attr($sec_heading_color).'"';}$output.='>'.esc_attr($heading).'</h2>
								<div class="post-fields d-flex">
									<ul class="list-unstyled">
										';if($client_name){$output.='
										<li>
											<b class="lb" ';if($sec_title_color){$output.='style="color:'.esc_attr($sec_title_color).'"';}$output.='>'.esc_html__('Client:','ronby').'</b> '.esc_attr($client_name).' 
										</li>
										';}$output.='
										';if($surface_area){$output.='
										<li>
											<b class="lb" ';if($sec_title_color){$output.='style="color:'.esc_attr($sec_title_color).'"';}$output.='>'.esc_html__('Surface Area:','ronby').'</b> '.esc_attr($surface_area).'
										</li>
										';}$output.='
										';if($value){$output.='
										<li>
											<b class="lb" ';if($sec_title_color){$output.='style="color:'.esc_attr($sec_title_color).'"';}$output.='>'.esc_html__('Value:','ronby').'</b> '.esc_attr($value).'
										</li>
										';}$output.='
									</ul>
									<ul class="list-unstyled">
										';if($location){$output.='
										<li>
											<b class="lb" ';if($sec_title_color){$output.='style="color:'.esc_attr($sec_title_color).'"';}$output.='>'.esc_html__('Location:','ronby').'</b>  '.esc_attr($location).'
										</li>
										';}$output.='
										';if($completed_year){$output.='
										<li>
											<b class="lb" ';if($sec_title_color){$output.='style="color:'.esc_attr($sec_title_color).'"';}$output.='>'.esc_html__('Year Completed:','ronby').'</b> '.esc_attr($completed_year).'
										</li>
										';}$output.='
										';if($architect_name){$output.='
										<li>
											<b class="lb" ';if($sec_title_color){$output.='style="color:'.esc_attr($sec_title_color).'"';}$output.='>'.esc_html__('Architect:','ronby').'</b> '.esc_attr($architect_name).' 
										</li>
										';}$output.='
									</ul>
								</div>
							</div>

							<div class="project-detail-gallery">
							';if($featured_img[0]){$output.='
								<div class="project-detail-thumbnail">
									<img src="'.esc_url($featured_img[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
								</div>
							';}$output.='	
								<div class="project-detail-carousel magnific-gallery">
									<div class="project-detail-carousel-slider owl-carousel owl-default">
		';
		foreach( $expl_slides_img_ids as $expl_slides_img_id ){
		$slider_img = wp_get_attachment_image_src( $expl_slides_img_id, 'slides_image' );		
		$output.='							
				<div class="item">
				<a href="'.esc_url($slider_img[0]).'" data-lightbox="slider-image">
				<div class="overlay d-flex justify-content-center align-items-center">
				<i class="fas fa-search"></i>
				</div>
				<img src="'.esc_url($slider_img[0]).'" alt="'.esc_attr__('slides-image','ronby').'">
				</a>
				</div>
		'; } $output.='										
									</div>
								</div>
							</div>

							<div class="prodject-detail-content" ';if($sec_desc_color){$output.='style="color:'.esc_attr($sec_desc_color).'"';}$output.='>
								<div class="mx-auto mx-width-730">
								';if($desc){$output.='
									<p>
								'.$desc.'
									</p>
								';}$output.='
								';if($list_items){$output.=$content;}$output.='	
								</div>
							</div>
						';if($contact_form_switch=='yes'){$output.='
							<div class="form-box-1" ';if($get_image[0]){$output.='style="background-image:url('.esc_url($get_image[0]).');background-size: cover;background-position: center center;"';}$output.='>
								<div class="overlay" ';if($overlay_bg){$output.='style="background-color:'.esc_attr($overlay_bg).'"';}$output.='>
				';if($headline_one || $headline_two){$output.='
					<div class="section-header-style-4 inverse">
	
					';if($headline_one){$output.='
						<h2 class="section-title" ';if($headline_one_color){$output.='style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($headline_one).'</h2>
					';}$output.='	
					';if($headline_two){$output.='
						<h4 class="section-sub-title" ';if($headline_two_color){$output.='style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.esc_attr($headline_two).'</h4>
					';}$output.='					
					</div>
				';}$output.='
					<div class="form-style-4">
						<form  method="POST" id="construction_contact_form">
							<div class="row align-items-center">
								<div class="col-lg-6">
									<div class="form-group">
									<label for="sendername" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('Full Name','ronby').'</label>
										<input class="input-styled" type="text" name="name" id="sendername" placeholder="'.esc_attr($name_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									<label for="senderemail" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('Email','ronby').'</label>
										<input class="input-styled" type="email" name="email" id="senderemail" placeholder="'.esc_attr($email_field_placeholder).'" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									<label for="senderphone" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('Phone No.','ronby').'</label>
										<input class="input-styled" type="text" name="senderphone" id="senderphone" placeholder="'.esc_attr($phone_field_placeholder).'" required>
									</div>
								</div>
								'; if($wanttoselect=="yes"){
								$output .= '<div class="col-lg-6">
										<div class="form-group">                  <label for="cf-select" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr($yourselect_label).'</label>             
										<select class="input-styled" name="cf-select" id="cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}

								$output .= '</select>
											</div>
											</div>';
								} $output .='	
						'; if($wanttoradio=="yes"){
						$output .= '<div class="col-lg-12">
									<div class="form-group" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>
									<label class="lable-text" for="cf-radio" >'.esc_attr($yourradio).'</label><br>';
									$radioitemArray = explode(',', $radioitems);
									$i=1;
									foreach($radioitemArray as $radioitem){
										$output .= '<span class="mr-10"><input class="control-radio mr-10" type="radio" name="cf-radio" value="'.$radioitem.'"  id="cf-radio'.$i.'">'.$radioitem.'</span>';
										$i++;
									}
						$output .='</div></div>';
						} $output .='
						';if($wanttocheckbox=="yes"){
						$output .=  '<div class="col-lg-12">
									<div class="form-group" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>
						 <label class="lable-text" for="cf-checkbox">'.esc_attr($yourcheckbox).'</label><br>';
						 $checkboxitemArray = explode(',', $checkboxitems);
						 $i=1;
							foreach($checkboxitemArray as $checkboxitem){
									$output .=  '<span class="mr-10"><input type="checkbox" class="control-checkbox mr-10" name="cf-checkbox[]" value="'.$checkboxitem.'"  id="cf-checkbox'.$i.'">'.$checkboxitem.'</span>';
									$i++;
							}

						$output .='</div></div>';
						} $output .='</div>	
						'; if($wanttomsg=="yes"){ $output.='
							<div class="form-group">
							<label for="sendermessage" ';if($label_color){$output.='style="color:'.esc_attr($label_color).'"';}$output.='>'.esc_attr__('Message','ronby').'</label>
								<textarea class="input-styled" name="message" id="sendermessage" rows="10" placeholder="'.esc_attr($message_field_placeholder).'" required></textarea>
							</div>
						';}$output.='	
							<div class="pt-4">
								<button class="button button-primary rounded" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>
								
							</div>
							<div class="col-lg-12 nopadding">
							<div class="alert alert-success display-none mt-2" id="success-msg">
							<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
							</div>	
							<div class="alert alert-danger display-none mt-2" id="failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
							</div>
							
  					<input type="hidden" name="email_subject" id="email_subject" value="'.esc_attr($email_subject).'" />
  					<input type="hidden" name="recipient_name" id="recipient_name" value="'.esc_attr($recipient_name).'" />
					<input type="hidden" name="recipient_email" id="recipient_email" value="'.sanitize_email($recipient_email).'" />
					
						</form>						
					</div>
							</div>
							</div>
						';}$output.='		
							';if($short_desc){$output.='
							<div class="mx-auto mx-width-730 mb-70">
								<div class="content-shrink-3">
								<p ';if($sec_desc_color){$output.='style="color:'.esc_attr($sec_desc_color).'"';}$output.='>
								'.$short_desc.'
								</p>								
								</div>
							</div>
							';}$output.='
						';if($social_share_switch=='yes'){$output.='	
						';if(function_exists('e_construction_social_share_meta')){
							$output.=e_construction_social_share_meta();
						}} $output.='
						</div>
						</section>';	

	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#construction_contact_form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#sendername").val();
                    var email = jQuery("#senderemail").val();
                    var phone = jQuery("#senderphone").val();
                    var message = jQuery("#sendermessage").val();
                    var recipient_email = jQuery("#recipient_email").val();
                    var recipient_name = jQuery("#recipient_name").val();
                    var email_subject = jQuery("#email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";					
						var select = jQuery("#cf-select").val();
					'; } $output.='	
					
					'; if($wanttoradio=="yes"){ $output .= '				
						var radio = jQuery("input[name=cf-radio]:checked").val();
						var radio_title = "'.esc_attr($yourradio).'";
					'; } $output.='	
					
					';if($wanttocheckbox=="yes"){ $output .=  '				
						var checkbox_title = "'.esc_attr($yourcheckbox).'";
						var checkArray = [];					
						jQuery(".control-checkbox:checked").each(function(i,e) {
							checkArray.push(jQuery(this).val());
						});
					'; } $output.='						
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'ronby-construction-form.php",
                        data: {name: name,email:email,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; }  if($wanttoradio=="yes"){ $output .= 'radio_title:radio_title,radio:radio,'; } if($wanttocheckbox=="yes"){ $output .= 'checkbox_title:checkbox_title,"checkbox[]":checkArray.join(),'; } if($wanttomsg=="yes"){ $output .= 'message:message,'; } $output.='phone:phone},
						complete: function(){
							jQuery("#construction_contact_form")[0].reset();
							jQuery(".contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';							
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_project_details_section', 'ronby_construction_project_details_section_shortcode');

/*****************************
Fashion Feature Box Section
******************************/
//Function for Fashion Feature Box
function ronby_fashion_feature_box_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading_color' => '',
	'desc_color' => '',
	'icon_color' => '',
	'number_of_feature_box' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'margin_top' => '',
	), $atts ) );
		
	$output='<section class="policies position-relative row-xtra-space" ';if( $padding_top || $padding_bottom || $margin_top){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}if($margin_top){$output.='top:'.esc_attr($margin_top).';';}$output.='"';}$output.='>
	
	<div class="row">';  
	$i=1;
	$c=0;
	while ($i<=$number_of_feature_box){
	$c++;
	$b = shortcode_atts(array(
		'icon'.$c.'' => '',
		'heading'.$c.'' => '',
		'desc'.$c.'' => '',
    ),$atts);
	$icon =$b['icon'.$c.''];
	$heading =$b['heading'.$c.''];
	$desc =$b['desc'.$c.''];

	$output .='<div class="col-md-6 col-xl-3">	
			<div class="article-with-icon-3 text-center">
				';if($icon){$output.='
				<div class="icon color-primary">
					<i class="'.esc_attr($icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></i>
				</div>
				';}$output.='
				';if($heading){$output.='
				<h3 class="item-title" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($heading).'</h3>
				';}$output.='
				';if($desc){$output.='
				<div class="item-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
					'.esc_attr($desc).'
				</div>
				';}$output.='
			</div>
			</div>
	';$i++;}$output.='	
			</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_feature_box_section', 'ronby_fashion_feature_box_section_shortcode');

/*****************************
Fashion Best Deal of the Day
******************************/
//Function for Fashion Best Deal of the Day
function ronby_fashion_best_deal_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' => '',
	'product_name' => '',
	'product_id' => '',
	'desc' => '',
	'regular_price' => '',
	'sale_price' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'countdown_date' => '',
	'btn_label' => '',
	'btn_url' => '',	
	
    'heading_color'   => '',		
    'product_name_color'   => '',		
    'product_id_color'   => '',		
    'desc_color'   => '',		
    'price_color'   => '',		
    'countdown_color'   => '',	
	'btn_text_color'   => '',
    'btn_bg_color'   => '',		
    'image'   => '',		
	), $atts ) );
	
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}		
	$output='<section class="product-deal p-30-0-30" ';if( $padding_top || $padding_bottom){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-xl-10">
						<div class="row align-items-center">
							<div class="col-md-8 mb-5 mb-md-0 text-right">
								<div class="section-header">
									';if($heading){$output.='
										<h2 class="section-title color-primary" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($heading).'</h2>
									';}$output.='	
									';if($product_name){$output.='
									<h3 class="product-name" ';if($product_name_color){$output.='style="color:'.esc_attr($product_name_color).'"';}$output.='>'.esc_attr($product_name).'</h3>
									';}$output.='
									';if($product_id){$output.='
									<div class="product-id" ';if($product_id_color){$output.='style="color:'.esc_attr($product_id_color).'"';}$output.='><span class="mr-2">'.esc_html__('Product Id:','ronby').'</span> '.esc_attr($product_id).'</div>
									';}$output.='
								</div>
								';if($desc){$output.='
								<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
									'.$desc.'
								</p>
								';}$output.='
								<div class="product-price-2" >
								';if($regular_price){$output.='
									<span class="regular-price mr-2" ';if($price_color){$output.='style="color:'.esc_attr($price_color).'"';}$output.='>
										'.esc_attr($regular_price).'
									</span>
								';}$output.='	
								';if($sale_price){$output.='
									<span class="sale-price" ';if($price_color){$output.='style="color:'.esc_attr($price_color).'"';}$output.='>
										'.esc_attr($sale_price).'
									</span>
								';}$output.='	
								</div>
								';if($countdown_date){$output.='
								<div class="deal-countdown" ';if($countdown_color){$output.='style="color:'.esc_attr($countdown_color).'"';}$output.='>
									<ul class="countdown-style-1 d-flex flex-wrap justify-content-end" data-countdown-to="'.esc_attr($countdown_date).'">
									</ul>
								</div>
								';}$output.='
								<div class="row align-items-center justify-content-end">
								';if($btn_label){$output.='
									<div class="col-auto">
										<a class="button rounded-capsule animate-400 hover-background-primary hover-color-white bg-color-DCDCDC" href="'.esc_url($btn_url).'" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>
											'.esc_attr($btn_label).'
										</a>								
									</div>
								';}$output.='	
								</div>
							</div>
							';if($images[0]){$output.='
							<div class="col-md-4 text-center">	
								<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
							</div>
							';}$output.='
						</div>
					</div>
				</div>
			</div>
		</section>
';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_best_deal_sec', 'ronby_fashion_best_deal_sec_shortcode');

/*****************************
Fashion Heading Section 
******************************/
//Function for Fashion Heading Section
function ronby_fashion_heading_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	), $atts ) );
	
	$output='<!-- Section header -->
			<div class="section-header-style-13 text-center  p-30-0-30 mb-0">
			';if($heading1){$output.='
				<h4 class="section-sub-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h4>
			';}$output.='			
			';if($heading2){$output.='
				<h2 class="section-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h2>
			';}$output.='			
				</div>
			<!-- /Section header -->';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_heading_sec', 'ronby_fashion_heading_sec_shortcode');

/*****************************
Fashion Woocommerce Products Section
******************************/
//Function for Fashion Woocommerce Products Section
function ronby_fashion_woo_products_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'cat_id'      => '',
	'post_per_page' => '-1',
	'order'   => 'desc',
	'orderby' => 'date',
	'p_cat_id_1' => '',
	'p_cat_id_2' => '',
	), $atts ) );
	$allowed_html_array = array(
	'p' => array(),
	'br' => array(),
	'span' => array(),
	'del' => array(),
	'ins' => array(),
	);	
	$args = array(
			'posts_per_page'  => $post_per_page,
			'post_type'   => 'product',
			'post_status' => 'publish',			
			'orderby' => $orderby,
			'order'   => $order,
			'tax_query'=> array(
					array(
						'taxonomy'      => 'product_cat',
						'field' => 'term_id', //This is optional, as it defaults to 'term_id'
						'terms'         => $cat_id,
						'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
					)
				)
			);
   function ronby_fashion_add_to_cart_button() {
       global $product;
       $classes = implode( ' ',  array(
           'button',
           'product_type_' . $product->get_type(),
           $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
           $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
       )  );
   
       return apply_filters( 'woocommerce_loop_add_to_cart_link',
           sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="product_type_%s  button button-default hover-background-primary rounded-capsule">'.esc_html__('Shop now','ronby').'</a>',
               esc_url( $product->add_to_cart_url() ),
               esc_attr( $product->get_id() ),
               esc_attr( $product->get_sku() ),
               esc_attr( isset( $quantity ) ? $quantity : 1 ),
               esc_attr( isset( $classes ) ? $classes : 'button' ),
               esc_attr( $product->get_type() ),
               esc_html( $product->add_to_cart_text() )
           ),
       $product );
   }			
	$counter = 1;		
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);
	$output='<section class="section-feature-products p-30-0-30 fashion-section-feature-products">
	<div class="container">
		<div class="row">';

	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
			global $product;
			global $post;
			global $redux;
			$args='';
			$id = $product->get_id();
			$description = $product->get_description();
			$get_desc=get_the_excerpt($id);
			$get_price= $product->get_price_html();
			$img_url = get_the_post_thumbnail_url();
			if($img_url){
				$image_url = $img_url;	
			}else{
				$image_url = get_template_directory_uri().'/images/dummy-product-image.jpg';
			}
			$i=0;
		    $average = round($product->get_average_rating());
			if($counter > 8){
				$counter=1;
			}
		if($counter==1 || $counter ==6){ $output.='
			<div class="col-xl-8">
			<div class="row">';
		}			
	if(($counter < 4) || ($counter == 6) || ($counter == 7) || ($counter == 8)){			
	$output.='<div class="col-sm-6 col-lg-4">
				<article class="product-item-4">';
	if( $product->is_on_sale() ){ 
	$output.= "<span class='item-badge item-badge-red'>".esc_attr('Sale')."</span>";
	}				
	$output.='				<div class="position-relative">
						<div class="thumbnail animate-zoom">
				<a href="'.esc_url(get_permalink($id)).'">';
   			if($img_url){
				$output.='<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'">';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && ($redux['ronby_single_product_placeholder']['url'])){
				$output.='<img src="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" alt="'.esc_attr__('featured-image','ronby').'">';
   				}else{
				$output.='<img src="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" alt="'.esc_attr__('featured-image','ronby').'">';				
   				}   				
   			}										
			$output.='</a>
						</div>
						<div class="price-n-rating d-flex justify-content-between align-items-center">
						';if($get_price){ $output.='
						<div class="product-price-2">
							<span class="">'.wp_kses($get_price, $allowed_html_array).'</span>
						</div>
						'; }
						if($average){
						$output.= '<div class="stars-rating justify-content-center" data-rate="5">';
						while($i < $average){
							$output.="<span class='fas fa-star'></span>";
							$i++;
						}
						$output.='</div>';
						}
						$output.='
						</div>
					</div>
					<div class="item-content text-center">
					';if($product->get_sku()){ $output.='
					<div class="product-id">
						'.esc_html__('Product id:','ronby').' '.esc_attr($product->get_sku()).'
					</div>
					';}$output.='

						<a href="'.esc_url(get_permalink($id)).'" class="no-color">
							<h3 class="product-name animate-300 hover-color-primary">'.esc_attr(get_the_title( $id )).'</h3>
						</a>';
						$output.=ronby_fashion_add_to_cart_button();
				$output.='</div>
				</article>
			</div>';
	}		

	if( $counter  == 3 || $counter == 8){	
	$output.='	</div>
				</div>';				
	}
	if(($counter == 4) && ($counter < 8)){		
	$output.='<div class="col-xl-4">
						<article class="article-with-overlay-6">
						<div class="thumbnail">
								<img src="';if(get_option('ronby_taxonomy_image'.$p_cat_id_1)){ $output.= esc_url(get_option('ronby_taxonomy_image'.$p_cat_id_1));} else{$output.= esc_url(get_template_directory_uri()."/images/placeholder.png");}$output.='" alt="'.esc_attr__('featured-image','ronby').'">
							</div>
							<a href="'.esc_url(get_category_link($p_cat_id_1)).'">
								<div class="overlay d-flex flex-column justify-content-end">
									<h2 class="item-title">
									'.esc_attr(get_the_category_by_ID($p_cat_id_1)).'
									</h2>
									<h4 class="item-sub-title">
									'.category_description($p_cat_id_1).'
									</h4>
								</div>
							</a>
						</article>
					</div>';
	}	
	if(($counter == 5) && ($counter < 8)){		
	$output.='<div class="col-xl-4">
						<article class="article-with-overlay-6">
							<div class="thumbnail">
								
									<img src="';if(get_option('ronby_taxonomy_image'.$p_cat_id_2)){ $output.= esc_url(get_option('ronby_taxonomy_image'.$p_cat_id_2));} else{$output.= esc_url(get_template_directory_uri()."/images/placeholder.png");}$output.='" alt="'.esc_attr__('featured-image','ronby').'">
							</div>
							<a href="'.esc_url(get_category_link($p_cat_id_2)).'">
								<div class="overlay d-flex flex-column justify-content-end">
									<h2 class="item-title">
									'.esc_attr(get_the_category_by_ID($p_cat_id_2)).'
									</h2>
									<h4 class="item-sub-title">
									'.category_description($p_cat_id_2).'
									</h4>
								</div>
							</a>
						</article>
					</div>';
	}	
	$counter++;		
	endwhile;endif;
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();
							
	$output.='</div>
				</div>
			</section>';   
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_woo_products_section', 'ronby_fashion_woo_products_section_shortcode');

/*****************************
Fashion Button
******************************/
//Function for Fashion Button
function ronby_fashion_button_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'btn_label' => '',
	'btn_url' => '',
	'btn_bg_color' => '',
	'btn_text_color' => '',
	), $atts ) );
	
	$output='<div class="text-center">
			';if($btn_label){$output.='
				<a href="'.esc_url($btn_url).'" class="button rounded-capsule button-primary" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
			';}$output.='	
			</div>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_button', 'ronby_fashion_button_shortcode');

/*****************************
Fashion Call to Action
******************************/
//Function for Fashion Call to Action
function ronby_fashion_cta_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'icon' => '',
	'heading1' => '',
	'heading2' => '',
	'heading3' => '',
	'btn1_label' => '',
	'btn1_url' => '',
	'btn2_label' => '',
	'btn2_url' => '',	
	'icon_color' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	'heading3_color' => '',
	'bg_image' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'overlay_bg' => '',	
	'padding_top' => '',	
	'padding_bottom' => '',	
	), $atts ) );
	$image_ids = explode(',',$bg_image);
	foreach( $image_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'bg_image' );
	}	
	$output='<section class="sale-campaign text-center background-cover" ';if($get_image[0]){$output.='style="background-image:url('.esc_url($get_image[0]).')"';}$output.='>
			<div class="overlay" ';if($overlay_bg || $padding_top || $padding_bottom){$output.='style="';if($overlay_bg){$output.='background-color:'.esc_attr($overlay_bg).';';}if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
				<div class="container">
				';if($icon){$output.='
					<div class="icon">
						<i class="'.esc_attr($icon).'"></i>
					</div>
				';}$output.='	
				';if($heading1){$output.='
					<h2 class="section-title" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
				';}$output.='
				';if($heading2){$output.='
					<div class="section-text-1 color-primary" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</div>
				';}$output.='
				';if($heading3){$output.='
					<div class="section-text-2" ';if($heading3_color){$output.='style="color:'.esc_attr($heading3_color).'"';}$output.='>'.esc_attr($heading3).'</div>
				';}$output.='	
				';if($btn1_label){$output.='
					<div class="pt-4">
				';if($btn1_label || $btn2_label){$output.='	
						<a href="'.esc_url($btn1_url).'" class="button rounded-capsule hover-background-primary" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>
							'.esc_attr($btn1_label).'
						</a>
				';}$output.='
				';if($btn2_label){$output.='				
						<a href="'.esc_url($btn2_label).'" class="button rounded-capsule hover-background-primary" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>
							'.esc_attr($btn2_label).'
						</a>
				';}$output.='		
					</div>
				';}$output.='		
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_cta_sec', 'ronby_fashion_cta_sec_shortcode');

/*****************************
Fashion Popular Brands
******************************/
//Function for Fashion Popular Brands
function ronby_fashion_popular_brands_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'desc' => '',
	'headline_color' => '',
	'desc_color' => '',
	'brand_images' => '',
	), $atts ) );
	$image_ids = explode(',',$brand_images);
	
	$output='<section class="section-poppular-brands p-30-0-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 mb-5 mb-lg-0">
					';if($headline){$output.='
						<h2 class="section-title" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>'.esc_attr($headline).'</h2>
					';}$output.='
					';if($desc){$output.='
						<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
							'.$desc.'
						</p>
					';}$output.='	
					</div>
					<div class="col-lg-7">
						<div class="brand-logos row flex-wrap justify-content-around">
							
					';	$c=0;
					foreach( $image_ids as $image_id ){
					$get_brand_images = wp_get_attachment_image_src( $image_id, 'brand_images' );	
					$output.='
					<div class="col-auto">
						<img src="'.esc_url($get_brand_images[$c]).'" alt="'.esc_attr__('brand-image','ronby').'">
					</div>
					';}$c++;$output.='							
							
						</div>
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_popular_brands', 'ronby_fashion_popular_brands_shortcode');

/*****************************
Fashion Products Showcase
******************************/
//Function for Fashion Products Showcase
function ronby_fashion_products_showcase_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'number_of_items' => '',
	'headline_color' => '',
	'product_name_color' => '',
	), $atts ) );
	
	$output='<section>
			<div class="container">
				<div class="row no-gutters">
	';$i=1;
	$c=0;
	while ($i<=$number_of_items){
	$c++;
	$b = shortcode_atts(array(
		'headlineone'.$c.'' => '',
		'headlinetwo'.$c.'' => '',
		'product_name'.$c.'' => '',
		'product_img_url'.$c.'' => '',
		'link_to_url'.$c.'' => '',
    ),$atts);
	$headline1 =$b['headlineone'.$c.''];
	$headline2 =$b['headlinetwo'.$c.''];
	$product_name =$b['product_name'.$c.''];
	$product_img_url =$b['product_img_url'.$c.''];
	$link_to_url =$b['link_to_url'.$c.''];
	$output .='				
				
					<div class="col-md-6 col-lg-4 col-xl-3">
						<article class="product-offer-item text-center">
						';if($product_img_url){$output.='
							<div class="thumbnail">
								<img src="'.esc_url($product_img_url).'" alt="'.esc_attr__('featured-image','ronby').'">
							</div>
						';}$output.='	
							<a class="no-color" href="'.esc_url($link_to_url).'">
								<div class="overlay d-flex flex-column justify-content-between">
									<div class="item-top-title" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>
										'.esc_attr($headline1).' <strong>'.esc_attr($headline2).'</strong>
									</div>
									';if($product_name){$output.='
									<h3 class="item-title" ';if($product_name_color){$output.='style="color:'.esc_attr($product_name_color).'"';}$output.='>
										'.esc_attr($product_name).'
									</h3>
									';}$output.='
								</div>
							</a>
						</article>
					</div>
	';
	$i++;
	}
	$output .='						
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_products_showcase_sec', 'ronby_fashion_products_showcase_sec_shortcode');

/*****************************
Fashion Blog Section
******************************/
//Function for Fashion Blog Section
function ronby_fashion_blog_section_shortcode( $atts ) {
    extract(shortcode_atts(array(
    'multiple'   => '',
    'num_post'   => '-1',
    'word_limit'  => '50',
    'order'      => 'desc',
    'orderby'    => 'post_date',
	'btn_label' => '',
	'btn_url' => '',	
	'btn_text_color'   => '',
    'btn_bg_color'   => '',	
    ), $atts));

	$args = array(
			'posts_per_page'   => $num_post ,
			'cat' => $multiple,
			'order' => $order,
			'orderby' => $orderby,
			'post_status'      => 'publish',
			);
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);	
	$output='<section class="business-blog-section-element p-30-0-30">
			<div class="container">
				<!-- Blog posts -->
				<div class="mx-auto blog-post-5-wrap">
					<div class="container">
						<div class="row blog-post-5-row">';	
	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id() );	
	
	$output.='<div class="col-md-6 col-lg-4">
						<article class="blog-post-item-6 text-center">
							<div class="thumbnail  animate-zoom">
							';if($get_image){$output.='
							   <a href="'.esc_url(get_the_permalink()).'">
								  <div class="blog-p-f-img" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
							   </a>
							';}$output.='	
															
							</div>
							<div class="post-description color-primary">
								';
								//check if post date meta switch in wordpress format is turned on 
                                if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){    
									if(function_exists('e_shop_blog_wp_date_meta')) $output.=e_shop_blog_wp_date_meta();
								   } 
                                // end wordpress format post date meta
                                else{    
								   if(function_exists('e_shop_blog_theme_date_meta')) $output.=e_shop_blog_theme_date_meta();
								   }
								$output.='<span> - </span>';	
								//author meta 
								if(function_exists('e_shop_blog_author_meta')) {
									$output.=e_shop_blog_author_meta();
									}												
								$output.='								
							</div>
							';if(get_the_title()){$output.='
							<a href="'.esc_url(get_the_permalink()).'" class="no-color">
								<h3 class="post-title animate-300 hover-color-primary">
									'.esc_attr(get_the_title()).'
								</h3>
							</a>
							';}$output.='
							<p class="post-excerpt">
								';if ( has_post_format( 'video' ) ) : 
								$output.= ronby_content($word_limit); 
								else: 
								$output.= ronby_excerpt($word_limit);
								endif;
								$output.='
							</p>
						</article>

				</div>';
	

	endwhile;endif;	
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();
	
	$output.='		  </div>
					</div>
				</div>
				<!-- /Blog posts -->			
			</div>
		</section>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_blog_section', 'ronby_fashion_blog_section_shortcode');

/*****************************
Newsletter Section
******************************/
//Function for Newsletter Section
function ronby_fashion_newsletter_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'desc' => '',
	'headline_color' => '',
	'desc_color' => '',
	'btn_label' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',
	'bottom' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	), $atts ) );
	
	$output='<section class="newsletter row-xtra-space p-30-0-30">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-xl-10">
						<div class="inner-box text-center" ';if($bottom || $padding_top || $padding_bottom){$output.='style="';if($bottom){$output.='bottom:'.esc_attr($bottom).';';}if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
						';if($headline){$output.='
							<h2 class="box-title" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>
								'.$headline.'
							</h2>
						';}$output.='
						';if($desc){$output.='
							<div class="mx-auto mx-width-600" >
								<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
									'.$desc.'
								</p>
							</div>
						';}$output.='	
						<form id="fashion-newsletter" method="POST">
							<div class="mx-auto form-group mx-width-375">
								<input type="email" class="input-field" placeholder="Enter your Email" id="newsletter-email" required>
							</div>
							<div class="pt-4">
								<button type="submit" class="button button-secondary rounded-capsule" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='><span style="display:inline-block">'.esc_attr($btn_label).'</span> <span style="display:inline-block"><img src="'.plugin_dir_url(__FILE__).'/images/newsletter_loader.gif" alt="newsletter-loader" style="width:30px;" class="newsletter-loader"/></span>	</button>
								<div class="newsletter-result"></div>
							</div>
						</form>	
						</div>
					</div>
				</div>
			</div>
		</section>';
	$output.='<script>
            jQuery(document).ready(function(){
				jQuery(".newsletter-loader").css("display", "none");
                jQuery("#fashion-newsletter").on("submit", function(e){
                    //Stop the form from submitting itself to the server.
                    e.preventDefault();
					var data = {};                 
                    var email = jQuery("#newsletter-email").val();
                    jQuery.ajax({
                        type: "POST",
						dataType: "json",
						  beforeSend: function(){
							jQuery(".newsletter-loader").css("display", "block");
						  },
                        url: "'.esc_url(plugin_dir_url('')).'the_ronby_extensions/modules/subscribe.php",
                        data: {email1:email},
						complete: function(){
							jQuery("#fashion-newsletter")[0].reset();
							jQuery(".newsletter-loader").css("display", "none");
						  },
                        success: function(data){
						jQuery(".newsletter-result").addClass("mt-4 alert alert-info");
						jQuery(".newsletter-result").html(data);
                        },	
						error: function(data){
						jQuery(".newsletter-result").html("Sorry, Something is wrong. Try again later.");
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_newsletter_sec', 'ronby_fashion_newsletter_sec_shortcode');

/*****************************
Business About us Section-1
******************************/
//Function for Business About us Section-1
function ronby_business_about_us_sec_one_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'image' => '',
	'title1' => '',
	'title2' => '',
	'desc' => '',
	'btn_label' => '',
	'btn_url' => '',
	'headline_color' => '',
	'title1_color' => '',
	'title2_color' => '',
	'desc_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	), $atts ) );
	$allowed=array('br'=>array());	
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<section class="p-30-0-30">
			<div class="container">
				<div class="row">
				  <div class="col-md-9 col-centered text-center">
				    <h4 class="text-dark font-weight-4 raleway" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).' !important;"';}$output.='>'.wp_kses($headline,$allowed).'</h4>
				    </div>				        
				    <div class="clearfix"></div>
					<div class="row-padding">
					<hr class="divider-line solid light"/>
					</div>
					<br/><br/>
				   				   
				    <div class="col-md-6 margin-bottom">
					';if($get_image[0]){$output.='
					<img src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('featured-image','ronby').'" class="img-responsive">
					';}$output.='
					</div>
				          <!--end item-->
				          
				          <div class="col-md-6">
						';if($title1){$output.='  
				            <h3 class="uppercase font-weight-6" ';if($title1_color){$output.='style="color:'.esc_attr($title1_color).'"';}$output.='>'.esc_attr($title1).'</h3>
						';}$output.='	
						';if($title2){$output.=' 
				            <h6 class="raleway" ';if($title2_color){$output.='style="color:'.esc_attr($title2_color).'"';}$output.='>'.esc_attr($title2).'</h6>
						';}$output.='
						';if($desc){$output.=' 
				            <br>
							<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
				            <p>'.$desc.'</p>
							</div>
				        ';}$output.='
						';if($btn_label){$output.=' 
				            <a class="btn btn-gyellow  uppercase" href="'.esc_url($btn_url).'" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
						';}$output.='
							</div>
				          <!--end item--> 
				  </div>
			</div>
		</section>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_about_us_sec_one', 'ronby_business_about_us_sec_one_shortcode');

/*****************************
Business About us Section-2
******************************/
//Function for Business About us Section-2
function ronby_business_about_us_sec_two_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'image' => '',
	'desc' => '',
	'list_items' => '',
	'btn_label' => '',
	'btn_url' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'headline_color' => '',	
	'desc_color' => '',	
	'list_items_color' => '',	
	'sec_bg_color' => '',	
	), $atts ) );
	if($list_items){
      $list_item_result = '';
      $list_items = $list_items ? explode("\n", trim($list_items)) : array();

	  $c=-1;
      foreach($list_items as $list_item) {
	  $c++;
	  $list_item_result.='<div class="iconlist-2" ';if($list_items_color){$list_item_result.='style="color:'.esc_attr($list_items_color).'"';}$list_item_result.='>
			  <div class="icon dark"><i class="fas fa-long-arrow-alt-right text-white"></i></div>
			  <div class="text" >'.htmlspecialchars_decode($list_item).'</div>
			</div>';
      }
      $list_item_result .= '';
      $content = $list_item_result;
    }	
  
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<section class="section-side-image section-dark clearfix" ';if($sec_bg_color){$output.='style="background-color:'.esc_attr($sec_bg_color).'"';}$output.='>
	';if($get_image[0]){$output.='
		      <div class="img-holder col-md-6 col-sm-3 pull-left">
		        <div class="background-imgholder" style="background:url('.esc_url($get_image[0]).');">
				<img class="nodisplay-image" src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('featured-image','ronby').'"> </div>
		      </div>
	';}$output.='		  
		      <div class="container-fluid">
		        <div class="row">
		          <div class="col-md-6 offset-md-6 col-sm-8 offset-sm-4 text-inner-2 clearfix align-left">
		            <div class="text-box p-100-80">
		              <div class="ce3-feature-box-7">
		                <div class="col-xs-12 nopadding">
		                  <div class="sec-title-container less-padding-3 text-left">
		                    <div class="ce4-title-line-1 align-left"></div>
							';if($headline){$output.='
		                    <h4 class="uppercase font-weight-7 less-mar-1 text-white" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).' !important;"';}$output.='>'.esc_attr($headline).'</h4>
							';}$output.='
		                    <div class="clearfix"></div>
							';if($desc){$output.='
		                    <div class="by-sub-title" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>'.$desc.'</div>
							';}$output.='
		                  </div>
		                </div>
		                <div class="clearfix"></div>
		                <!--end title-->
						'.$content.'    
		                <div class="clearfix"></div>
		                <br>
		                <br>
						';if($btn_label){$output.='
		                <a class="button button-secondary" href="'.esc_url($btn_url).'" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
						';}$output.='
						</div>
		            </div>
		          </div>
		        </div>
		      </div>
		   </section>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_about_us_sec_two', 'ronby_business_about_us_sec_two_shortcode');

/*****************************
Business About us Section-3
******************************/
//Function for Business About us Section-3
function ronby_business_about_us_sec_three_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'image' => '',
	'title1' => '',
	'title2' => '',
	'desc' => '',
	'btn_label' => '',
	'btn_url' => '',
	'title1_color' => '',
	'title2_color' => '',
	'desc_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	), $atts ) );
	$allowed=array('br'=>array());	
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<section class="p-30-0-30">
			<div class="container">
				<div class="row">		   				          
				          <div class="col-md-6">
						';if($title1){$output.='  
				            <h3 class="uppercase font-weight-6" ';if($title1_color){$output.='style="color:'.esc_attr($title1_color).'"';}$output.='>'.esc_attr($title1).'</h3>
						';}$output.='	
						';if($title2){$output.=' 
				            <h6 class="raleway" ';if($title2_color){$output.='style="color:'.esc_attr($title2_color).'"';}$output.='>'.esc_attr($title2).'</h6>
						';}$output.='
						';if($desc){$output.=' 
				            <br>
							<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
				            <p>'.$desc.'</p>
							</div>
				        ';}$output.='
						';if($btn_label){$output.=' 
				            <a class="btn btn-gyellow  uppercase" href="'.esc_url($btn_url).'" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
						';}$output.='
							</div>
				          <!--end item--> 
				 
				    <div class="col-md-6 margin-bottom">
					';if($get_image[0]){$output.='
					<img src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('featured-image','ronby').'" class="img-responsive">
					';}$output.='
					</div>
				    <!--end item-->	
				</div>					
			</div>
		</section>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_about_us_sec_three', 'ronby_business_about_us_sec_three_shortcode');

/*****************************
Medical Heading Section 
******************************/
//Function for Medical Heading Section 
function ronby_medical_heading_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'heading1_color' => '',
	'heading2_color' => '',
	), $atts ) );
	
	$output='<!-- Section header -->
			<div class="section-header-style-9 text-center  p-30-0-30 mb-0">
			';if($heading1){$output.='
				<h4 class="section-sub-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h4>
			';}$output.='			
			';if($heading2){$output.='
				<h2 class="section-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h2>
			';}$output.='			
				</div>
			<!-- /Section header -->';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_heading_sec', 'ronby_medical_heading_sec_shortcode');

/*****************************
Medical Service Box Section 
******************************/
//Function for Medical Service Box Section 
function ronby_medical_service_box_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'number_of_items' => '',
	'title_color' => '',
	'desc_color' => '',
	), $atts ) );
	
	$output='<section class="p-30-0-30">
				<div class="container">
					<div class="row">';
							$i=1;
							$c=0;
							$counter=1;
							while ($i <= $number_of_items){
							$c++;
					
							$b = shortcode_atts(array(
								'img_url'.$c.'' => '',
								'title'.$c.'' => '',
								'desc'.$c.'' => '',
								'link_to_url'.$c.'' => '',
							),$atts);
								
							$img_url =$b['img_url'.$c.''];
							$title =$b['title'.$c.''];
							$desc =$b['desc'.$c.''];
							$link_to_url =$b['link_to_url'.$c.''];
							if($counter > 4){
								$counter=1;
							}
if(($counter == 1) || ($counter == 2)){								
	$output.='<div class="col-lg-6">
							<div class="service-item-2 thumb-left-style">
								<div class="row no-gutters align-items-center">
								
									<div class="col-sm-5 thumbnail-col mb-4 mb-sm-0">
										<div class="position-relative">
										';if($img_url){$output.='
											<div class="thumbnail animate-zoom">
												<a href="'.esc_url($link_to_url).'">
													<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'">
												</a>
											</div>
										';}$output.='
											<a href="'.esc_url($link_to_url).'" class="icon background-secondary">
												<i class="fas fa-plus"></i>
											</a>
										</div>
									</div>
									
									<div class="col-sm-7 content-col py-20px py-sm-0">
									';if($title){$output.='
										<a href="'.esc_url($link_to_url).'" class="no-color">
											<h3 class="item-title hover-color-primary animate-300" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr($title).'</h3>
										</a>
									';}$output.='	
									';if($desc){$output.='
										<div class="item-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
											'.$desc.'
										</div>
									';}$output.='	
									</div>
								</div>
							</div>
						</div>';
}elseif(($counter == 3) || ($counter == 4)){
	$output.='<div class="col-lg-6">
							<div class="service-item-2 thumb-right-style">
								<div class="row no-gutters align-items-center">
								
									<div class="col-sm-5 order-sm-last thumbnail-col mb-4 mb-sm-0">
										<div class="position-relative">
										';if($img_url){$output.='
											<div class="thumbnail animate-zoom">
												<a href="'.esc_url($link_to_url).'">
													<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'">
												</a>
											</div>
										';}$output.='
											<a href="'.esc_url($link_to_url).'" class="icon background-secondary">
												<i class="fas fa-plus"></i>
											</a>
										</div>
									</div>
									
									<div class="col-sm-7 order-sm-first content-col py-20px py-sm-0">
									';if($title){$output.='
										<a href="'.esc_url($link_to_url).'" class="no-color">
											<h3 class="item-title hover-color-primary animate-300" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr($title).'</h3>
										</a>
									';}$output.='	
									';if($desc){$output.='
										<div class="item-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
											'.$desc.'
										</div>
									';}$output.='	
									</div>
								</div>
							</div>
						</div>';	
}						
							$i++;$counter++;
							}	
	$output.='	 </div>
				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_service_box_sec', 'ronby_medical_service_box_sec_shortcode');

/*****************************
Medical Tri-Fold Flyer Section
******************************/
//Function for Fashion Popular Brands
function ronby_medical_trifold_flyer_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'fold1_title' => '',
	'number_of_items' => '',
	'fold2_title' => '',
	'fold2_desc' => '',
	'fold2_appoint' => '',
	'fold2_phone' => '',
	'fold2_btn_label' => '',
	'fold2_btn_url' => '',
	'fold3_title' => '',
	'fold3_desc' => '',	
	'fold3_btn_label' => '',
	'fold3_btn_url' => '',	
	'fold1_bg_color' => '',	
	'fold2_bg_color' => '',	
	'fold3_bg_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	), $atts ) );
	$output='<section class="medical_trifold_flyer">
				<div class="row no-gutters">
					<div class="col-lg-6 col-xl-4 bg-color-0098f1" ';if($fold1_bg_color){$output.='style="background-color:'.esc_attr($fold1_bg_color).';"';}$output.='>
						<div class="content-box-2 color-inverse">
						';if($fold1_title){$output.='
							<h2 class="box-title">'.esc_attr($fold1_title).'</h2>
						';}$output.='	
							<ul class="list-style-5 pl-0">';
							$i=1;
							$c=0;
							while ($i <= $number_of_items){
							$c++;					
							$b = shortcode_atts(array(
								'title'.$c.'' => '',
								'price'.$c.'' => '',
							),$atts);								
							$title =$b['title'.$c.''];
							$price =$b['price'.$c.''];							
							$output.='
								<li>
									<span>'.esc_attr($title).'</span> <span>'.esc_attr($price).'</span>
								</li>';
							$i++;
							}		
							$output.='	
							</ul>
						</div>						
					</div>
					<div class="col-lg-6 col-xl-4 bg-color-0085d3" ';if($fold2_bg_color){$output.='style="background-color:'.esc_attr($fold2_bg_color).';"';}$output.='>
						<div class="content-box-2 color-inverse">
						';if($fold2_title){$output.='
							<h2 class="box-title">'.esc_attr($fold2_title).'</h2>
						';}$output.='
						';if($fold2_desc){$output.='
							<p>
								'.$fold2_desc.'
							</p>
						';}$output.='
						';if($fold2_appoint || $fold2_phone){$output.='
							<div class="appointment">
								<span class="mr-3">'.esc_attr($fold2_appoint).'</span> '.esc_attr($fold2_phone).'
							</div>
						';}$output.='	
						';if($fold2_btn_label){$output.='
							<a href="'.esc_url($fold2_btn_url).'" class="button button-white rounded" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($fold2_btn_label).'</a>
						';}$output.='	
						</div>
					</div>
					<div class="col-lg-6 col-xl-4 bg-color-0074b8" ';if($fold3_bg_color){$output.='style="background-color:'.esc_attr($fold3_bg_color).';"';}$output.='>
						<div class="content-box-2 color-inverse">
						';if($fold3_title){$output.='
							<h2 class="box-title">'.esc_attr($fold3_title).'</h2>
						';}$output.='
						';if($fold3_desc){$output.='
							<p>
								'.$fold3_desc.'
							</p>
						';}$output.='							
							<div class="mt-5">
						';if($fold3_btn_label){$output.='
							<a href="'.esc_url($fold3_btn_url).'" class="button button-white rounded" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($fold3_btn_label).'</a>
						';}$output.='	
							</div>
						</div>
					</div>
				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_trifold_flyer_sec', 'ronby_medical_trifold_flyer_sec_shortcode');

/*****************************
Construction Team Member Box
******************************/
//Function for Construction Team Member Box
function ronby_construction_team_member_box_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'image' => '',
	'name' => '',
	'designation' => '',
	'link_to_url' => '',
	'fb_url' => '',
	'twitter_url' => '',
	'linkedin_url' => '',
	'box_bg_color' => '',
	'name_color' => '',
	'designation_color' => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<div class="team-item-1">
						';if($get_image[0]){$output.='
							<div class="thumbnail animate-zoom">
								<a href="'.esc_url($link_to_url).'">
									<img src="'.esc_url($get_image[0]).'" alt="'.esc_attr__('profile-image','ronby').'">
								</a>								
							</div>
						';}$output.='	
							<div class="item-content" ';if($box_bg_color){$output.='style="background-color:'.esc_attr($box_bg_color).'"';}$output.='>
								<a href="'.esc_url($link_to_url).'" class="no-color">
									<h3 class="name hover-color-primary" ';if($name_color){$output.='style="color:'.esc_attr($name_color).'"';}$output.='>'.esc_attr($name).'</h3>
								</a>
								<div class="role" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='>'.esc_attr($designation).'</div>
								<div class="social-5 text-center mt-4">
									<ul class="no-style items-inline-block">
									';if($fb_url){$output.='
										<li class="hover-color-primary animate-300">
											<a href="'.esc_url($fb_url).'" class="no-color">
												<i class="fab fa-facebook-f"></i>
											</a>
										</li>
									';}$output.='
									';if($twitter_url){$output.='
										<li class="hover-color-primary animate-300">
											<a href="'.esc_url($twitter_url).'" class="no-color">
												<i class="fab fa-twitter"></i>
											</a>
										</li>
									';}$output.='
									';if($linkedin_url){$output.='
										<li class="hover-color-primary animate-300">
											<a href="'.esc_url($linkedin_url).'" class="no-color">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</li>
									';}$output.='
									</ul>
								</div>
							</div>
						</div>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_team_member_box', 'ronby_construction_team_member_box_shortcode');


/*****************************
Construction Testimonial Slider
******************************/
//Function for Construction Testimonial Slider
function ronby_construction_testimonial_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'overlay_color' => '',
	'bg_img' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'number_of_testimonial' => '',
	'headline1' => '',
	'headline1_padding_left' => '',
	'headline2' => '',
	'headline1_color' => '',
	'headline2_color' => '',
	'text_color' => '',
	'name_color' => '',
	'designation_color' => '',	
	), $atts ) );
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}			
	$output='<section class="construction-slider" ';if($get_image[0]){$output.='style="background:url('.esc_url($get_image[0]).');background-size:cover;"';}$output.='>
	<div class="overlay p-30-0-30" ';if($padding_top || $padding_bottom || $overlay_color){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.=';';if($overlay_color){$output.='background-color:'.esc_attr($overlay_color).'';}$output.='"';}$output.='>
			<div class="container">
			';if($headline1 || $headline2){$output.='
			<div class="section-header-style-4 p-30-0-30 mb-0 text-center">
			';if($headline1){$output.='
			<h2 class="section-title" ';if($headline1_color || $headline1_padding_left){$output.='style="';if($headline1_color){$output.='color:'.esc_attr($headline1_color).';';}if($headline1_padding_left){$output.='padding-left:'.esc_attr($headline1_padding_left).'';}$output.='"';}$output.='>'.esc_attr($headline1).'</h2>
			';}$output.='
			';if($headline2){$output.='
			<h3 class="section-sub-title after-disable" ';if($headline2_color){$output.='style="color:'.esc_attr($headline2_color).'"';}$output.='>'.esc_attr($headline2).'</h3>
			';}$output.='
			</div>
			';}$output.='
			<div class="testimonial-slider-4 owl-carousel  owl-theme owl-loaded">';
	$i=1;
	$c=0;
	while ($i<=$number_of_testimonial){
	$c++;
	$b = shortcode_atts(array(
	'name'.$c.'' => '',
	'designation'.$c.'' => '',
    'text'.$c.'' => '',
    'img_url'.$c.'' => '',
    ),$atts);
	$name =$b['name'.$c.''];
	$designation =$b['designation'.$c.''];
    $text =$b['text'.$c.''];
    $img_url =$b['img_url'.$c.''];
	$output.='<div class="item">
	<div class="col-md-10 sec-auto-margin">
	';if($text){$output.='
	<p ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>'.$text.'</p>
	';}$output.='
	<div class="testimonial-footer  row">
	<div class="testimonial-footer-inner">
	';if($img_url){$output.='
	<div class="author-image"> 
	<img src="'.esc_url($img_url).'" alt="'.esc_attr__('profile-image','ronby').'" class="img-fluid testimonial-img mr-4">
	</div>
	';}$output.='
	';if($name){$output.='
	<div class="author-info">
	<h3 class="author-name" ';if($name_color){$output.='style="color:'.esc_attr($name_color).'"';}$output.='> '.esc_attr($name).'</h3> <span class="author-designation" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='> '.esc_attr($designation).' </span>
	</div>
	';}$output.='
	</div>
	</div>
	</div>				
	</div>';	
	$i++;
	}
	$output.='</div>
			</div>
			</div>
			</section>';				
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_testimonial_slider', 'ronby_construction_testimonial_slider_shortcode');

/*****************************
Medical Call To Action
******************************/
//Function for Medical Call To Action
function ronby_medical_cta_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'desc' => '',
	'btn_label' => '',
	'btn_url' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'heading_color' => '',	
	'desc_color' => '',	
	'overlay_color' => '',	
	'padding_top' => '',
	'padding_bottom' => '',	
	), $atts ) );
	
	$output='<section class="medical-cta section-emergency-care">
				<div class="overlay p-30-0-30" ';if($padding_top || $padding_bottom || $overlay_color){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.=';';if($overlay_color){$output.='background-color:'.esc_attr($overlay_color).'';}$output.='"';}$output.='>
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-lg-8 ">
						';if($headline){$output.='
							<h2 class="section-title" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>
								'.esc_attr($headline).'
							</h2>
						';}$output.='
						';if($desc){$output.='
							<p class="section-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
								'.$desc.'
							</p>
						';}$output.='	
						</div>
						';if($btn_label){$output.='
						<div class="col-lg-3  offset-lg-1 text-right">
							<a href="'.esc_url($btn_url).'" class="button button-primary rounded" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
						</div>
						';}$output.='
					</div>
				</div>
				</div>	
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_cta_sec', 'ronby_medical_cta_sec_shortcode');

/*****************************
Medical Service Slider 
******************************/
//Function for Medical Service Slider
function ronby_medical_service_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'number_of_services' => '',
	'headline' => '',
	'sub_headline' => '',
	'desc' => '',
	'btn_label' => '',
	'btn_url' => '',
	'slider_headline' => '',
	'headline_c' => '',
	'sub_headline_c' => '',
	'desc_c' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'slider_headline_c' => '',	
	'sec_bg_color' => '',	
	'margin_bottom' => '',	
	'padding_top' => '',	
	'padding_bottom' => '',	
	'slider_box_bg' => '',	
	), $atts ) );
	
	$output='<section class="m-s-slider row-xtra-space p-30-0-30" ';if($sec_bg_color || $margin_bottom || $padding_top || $padding_bottom){$output.='style="';if($sec_bg_color){$output.='background-color:'.esc_attr($sec_bg_color).';';}if($margin_bottom){$output.='margin-bottom:'.esc_attr($margin_bottom).';';}if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}$output.='"';}$output.='>
				<div class="container">
					<div class="text-center mx-auto mx-width-750 mb-90">
						<div class="section-header-style-10">
						';if($headline){$output.='
							<h4 class="section-sub-title color-primary" ';if($headline_c){$output.='style="color:'.esc_attr($headline_c).'"';}$output.='>'.esc_attr($headline).'</h4>
						';}$output.='
						';if($sub_headline){$output.='
							<h2 class="section-title" ';if($sub_headline_c){$output.='style="color:'.esc_attr($sub_headline_c).'"';}$output.='>'.esc_attr($sub_headline).'</h2>
						';}$output.='	
						</div>
						';if($desc){$output.='
						<p ';if($desc_c){$output.='style="color:'.esc_attr($desc_c).'"';}$output.='>
						'.$desc.'
						</p>
						';}$output.='
						<div class="mt-30">
						';if($btn_label){$output.='
							<a href="'.esc_url($btn_url).'" class="button button-inverse rounded" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>
								'.esc_attr($btn_label).'
							</a>
						';}$output.='	
						</div>
					</div>
					<div class="post-carousel-3 mb-m-23">
					';if($slider_headline){$output.='
						<h2 class="slider-title" ';if($slider_headline_c){$output.='style="color:'.esc_attr($slider_headline_c).'"';}$output.='>
							'.esc_attr($slider_headline).'
						</h2>
					';}$output.='	
						<div class="owl-carousel">';
	$i=1;
	$c=0;
	while ($i<=$number_of_services){
	$c++;
	$b = shortcode_atts(array(
	'title'.$c.'' => '',
	'icon'.$c.'' => '',
	'img_url'.$c.'' => '',
    'link_to_url'.$c.'' => '',
    ),$atts);
	$title =$b['title'.$c.''];
	$icon =$b['icon'.$c.''];
    $img_url =$b['img_url'.$c.''];
    $link_to_url =$b['link_to_url'.$c.''];
	$output.='						
						
							<div class="item">
								<article class="department-item">
								';if($img_url){$output.='
									<div class="thumbnail animate-zoom">
										<a href="'.esc_url($link_to_url).'">
											<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'">
										</a>
									</div>
								';}$output.='	
									<div class="item-content">
									';if($icon){$output.='
										<div class="icon background-secondary" ';if($slider_box_bg){$output.='style="background-color:'.esc_attr($slider_box_bg).'"';}$output.='>
											<i class="'.esc_attr($icon).'"></i>
										</div>
									';}$output.='	
									';if($title){$output.='
										<a href="'.esc_url($link_to_url).'" class="no-color">
											<h3 class="item-title background-secondary" ';if($slider_box_bg){$output.='style="background-color:'.esc_attr($slider_box_bg).'"';}$output.='>
												'.esc_attr($title).'
											</h3>
										</a>
									';}$output.='	
									</div>
								</article>
							</div>
	';	
	$i++;
	}
	$output.='
							
						</div>
					</div>
				</div>
			</section>			
			';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_service_slider', 'ronby_medical_service_slider_shortcode');

/*****************************
Medical Doctors Slider
******************************/
//Function for Medical Doctors Slider
function ronby_medical_doctors_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'number_of_items' => '',
	'headline1' => '',
	'headline2' => '',
	), $atts ) );
	
	$output='<section class="row-xtra-space">
				<div class="container">
				';if($headline1 || $headline2){$output.='
					<div class="section-header-style-9">
					';if($headline1){$output.='
						<h4 class="section-sub-title color-primary">'.esc_attr($headline1).'</h4>
					';}$output.='
					';if($headline2){$output.='
						<h2 class="section-title">'.esc_attr($headline2).'</h2>
					';}$output.='	
					</div>
				';}$output.='	
					<div class="post-carousel-2">
						<div class=" owl-carousel">';
	$i=1;
	$c=0;
	while ($i<=$number_of_items){
	$c++;
	$b = shortcode_atts(array(
	'img_url'.$c.'' => '',
	'link_to_url'.$c.'' => '',
	'fb_url'.$c.'' => '',
	'twitter_url'.$c.'' => '',
	'pinterest_url'.$c.'' => '',
	'linkedin_url'.$c.'' => '',
	'title'.$c.'' => '',
	'name'.$c.'' => '',
	'designation'.$c.'' => '',
	'phone'.$c.'' => '',
    ),$atts);
	$img_url =$b['img_url'.$c.''];
	$link_to_url =$b['link_to_url'.$c.''];
	$fb_url =$b['fb_url'.$c.''];
	$twitter_url =$b['twitter_url'.$c.''];
	$pinterest_url =$b['pinterest_url'.$c.''];
	$linkedin_url =$b['linkedin_url'.$c.''];
	$title =$b['title'.$c.''];
	$name =$b['name'.$c.''];
	$designation =$b['designation'.$c.''];
	$phone =$b['phone'.$c.''];
	$output.='						
							<div class="item">
								<div class="team-item-3">
									<div class="thumbnail animate-zoom">
										<a href="'.esc_url($link_to_url).'">
											<img src="'.esc_url($img_url).'" alt="'.esc_attr__('featured-image','ronby').'">
										</a>
										<div class="item-social social-9 d-flex flex-column">
											<a class="hover-background-primary cursor-point">
												<i class="fas fa-share-alt"></i>
											</a>
											';if($fb_url){$output.='
											<a href="'.esc_url($fb_url).'" class="hover-background-primary">
												<i class="fab fa-facebook-f"></i>
											</a>
											';}$output.='
											';if($twitter_url){$output.='
											<a href="'.esc_url($twitter_url).'" class="hover-background-primary">
												<i class="fab fa-twitter"></i>
											</a>
											';}$output.='
											';if($pinterest_url){$output.='
											<a href="'.esc_url($pinterest_url).'" class="hover-background-primary">
												<i class="fab fa-pinterest-p"></i>
											</a>
											';}$output.='
											';if($linkedin_url){$output.='
											<a href="'.esc_url($linkedin_url).'" class="hover-background-primary">
												<i class="fab fa-linkedin-in"></i>
											</a>
											';}$output.='
										</div>
									</div>
									';if($name){$output.='
									<a href="'.esc_url($link_to_url).'" class="no-color">
										<h3 class="item-title hover-color-primary animate-300"><span class="color-secondary">'.esc_attr($title).'</span> '.esc_attr($name).'</h3>
									</a>
									';}$output.='
									';if($designation){$output.='
									<h4 class="item-sub-title">'.esc_attr($designation).'</h4>
									';}$output.='
									';if($phone){$output.='
									<div class="item-phone-number">
										<span class="color-secondary">
											<i class="fas fa-phone-volume"></i> '.esc_attr__('Phone No :','ronby').' 
										</span>
										'.esc_attr($phone).'
									</div>
									';}$output.='
								</div>
							</div>
	';	
	$i++;
	}
	$output.='														
						</div>
					</div>					
				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_doctors_slider', 'ronby_medical_doctors_slider_shortcode');

/*****************************
Fitness Contact Info- 2
******************************/
//Function for Fitness Contact Info- 2
function ronby_fitness_contact_info_two_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'phone' => '',
	'opening_time' => '',
	'address' => '',
	'map_address' 		 => '',
	'map_height' 		 => '480px',	
	'headline_color' 		 => '',	
	'phone_color' 		 => '',	
	'opening_time_color' 		 => '',	
	'address_color' 		 => '',	
	'icon_color' 		 => '',	
	'sec_bg_color' 		 => '',	
	), $atts ) );
	$map_address_f=str_replace(" ","+",$map_address);
	
	$output='<section class="fitness-how-to-find-us" ';if($sec_bg_color){$output.='style="background-color:'.esc_attr($sec_bg_color).'"';}$output.='>
    <div class="row nopadding">
        <div class="find-us-info col-md-4 pl-90 p-40-0-40">
		';if($headline){$output.='
            <h2 ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>'.esc_attr($headline).'</h2>
		';}$output.='	
            <ul class="pl-0">
			';if($phone){$output.='
				<li class="find-us-phone" ';if($phone_color){$output.='style="color:'.esc_attr($phone_color).'"';}$output.='>
					<span class="fas fa-phone" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></span> '.esc_attr($phone).'
				</li>
			';}$output.='
			';if($opening_time){$output.='
				<li class="find-us-hours" ';if($opening_time_color){$output.='style="color:'.esc_attr($opening_time_color).'"';}$output.='>
					<span class="fas fa-clock" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></span> '.esc_attr($opening_time).'
				</li>
            ';}$output.=' 
			';if($address){$output.='
                <li class="find-us-address" ';if($address_color){$output.='style="color:'.esc_attr($address_color).'"';}$output.='>
				<table>
				<tr>
				<td class="v-align-top"><span class="fas fa-map-marker-alt" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></span></td>
				<td class="pl-05">'.$address.'</td>
				</tr>
				</table>
                     
                </li>
			';}$output.='	
            </ul>
        </div>


		';if($map_address){$output.='
		<div class="find-us-map col-md-8 nopadding">
			<iframe style="width:100%;height:'.esc_attr($map_height).';margin-bottom:-6px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url('https://maps.google.it/maps?q=='.$map_address_f).'=&output=embed"></iframe>
		</div>
		';}$output.='		

    </div>
</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fitness_contact_info_two', 'ronby_fitness_contact_info_two_shortcode');

/*****************************
Fitness Nearby Gyms
******************************/
//Function for Fitness Nearby Gyms
function ronby_fitness_nearby_gyms_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'number_of_items' => '',
	'bg_color' => '',
	'heading_color' => '',
	'title_color' => '',
	'distance_color' => '',
	'working_days_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',
	'box_bg_color' => '',
	'toggle_btn_bg' => '',
	), $atts ) );
	for($i=0;$i<=50;$i++){
	$str = 'abcdefghi';
	$shuffled = str_shuffle($str);
	}	
	$unique_css_class=$shuffled;
	$output='<section class="component nearby-gyms p-30-0-30 '.esc_attr($unique_css_class).'">
    <div class="wrapper">
        <div class="gyms">

            <div class="gym-btn" ';if($bg_color){$output.='style="background-color:'.esc_attr($bg_color).'"';}$output.='>
			';if($headline){$output.='
                <h3 ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($headline).'</h3>
			'; } $output.='	
            </div>	
            <div class="gym-panel" ';if($bg_color){$output.='style="background-color:'.esc_attr($bg_color).'"';}$output.='>
                <div class="gym-container row">
';
	$i=1;
	$c=0;
	while ($i<=$number_of_items){
	$c++;
	$b = shortcode_atts(array(
	'title'.$c.'' => '',
	'distance'.$c.'' => '',
	'opening_time'.$c.'' => '',
	'btn_label'.$c.'' => '',
	'btn_url'.$c.'' => '',
    ),$atts);
	$title =$b['title'.$c.''];
	$distance =$b['distance'.$c.''];
	$opening_time =$b['opening_time'.$c.''];
	$btn_label =$b['btn_label'.$c.''];
	$btn_url =$b['btn_url'.$c.''];
	$output.='				
                        <div class="col-md-4">
                        <div class="inside-wrapper" ';if($box_bg_color){$output.='style="background-color:'.esc_attr($box_bg_color).'"';}$output.='>
						';if($title){$output.='
                            <h3 ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr($title).'<span ';if($distance_color){$output.='style="color:'.esc_attr($distance_color).'"';}$output.='>'.esc_attr($distance).'</span></h3>
						';}$output.='	
                            <ul class="pl-0">    
							';if($opening_time){$output.='    
							<li class="find-us-hours" ';if($working_days_color){$output.='style="color:'.esc_attr($working_days_color).'"';}$output.='>
								<span class="fas fa-clock"></span>
								'.esc_attr($opening_time).'
							</li>
							';}$output.='	
                            </ul>
							';if($btn_label){$output.='
                            <a href="'.esc_url($btn_url).'" class="button rounded-capsule button-primary" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
							';}$output.='
                        </div>
                        </div>
	';	
	$i++;
	}
	$output.='
                </div>
            </div>
        </div>
    </div>
</section>';
if($toggle_btn_bg){ $output.='
<style>
.nearby-gyms.'.wp_trim_words($unique_css_class).'  .gym-btn h3::before{
	background-color:'.esc_attr($toggle_btn_bg).';
}
</style>	 
';}		
	return $output;
}
add_shortcode('ronby_shortcode_for_fitness_nearby_gyms', 'ronby_fitness_nearby_gyms_shortcode');

/*****************************
Fitness Call To Action
******************************/
//Function for Fitness Call To Action
function ronby_fitness_call_to_action_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'description' => '',
	'button_label' => '',
	'button_url' => '',
	'headline1_color' => '',
	'headline2_color' => '',
	'description_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'bg_img' => '',	
	'p_top' => '',	
	'p_bottom' => '',	
	), $atts ) );
	
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
		$images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}	
	
	$output='<section class="p-30-0-30 fitness-cta" ';if($images[0] || $p_top || $p_bottom){$output.='style="';if($images[0]){$output.='background-image:url('.esc_url($images[0]).');background-position: top;';}if($p_top){$output.='padding-top:'.esc_attr($p_top).';';}if($p_bottom){$output.='padding-bottom:'.esc_attr($p_bottom).';';} $output.='"';}$output.='>
			<div class="col-md-6 offset-md-6">
			';if($heading1){$output.='
			<h2 class="fitness-cta-heading1" ';if($headline1_color){$output.='style="color:'.esc_attr($headline1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>	
			';}$output.='
			';if($heading2){$output.='
			<h2 class="fitness-cta-heading2" ';if($headline2_color){$output.='style="color:'.esc_attr($headline2_color).'"';}$output.='>'.$heading2.'</h2>
			';}$output.='
			';if($description){$output.='
			<div class="fitness-cta-p" ';if($description_color){$output.='style="color:'.esc_attr($description_color).'"';}$output.='>'.$description.'</div>
			';}$output.='
			';if($button_label){$output.='
			<a class="fitness-cta-button button rounded-capsule button-primary mt-4" href="'.esc_url($button_url).'" target="_self" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'</a>
			';}$output.='
			</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fitness_call_to_action', 'ronby_fitness_call_to_action_shortcode');

/*****************************
Fitness Call To Action- 2
******************************/
//Function for Fitness Call To Action- 2
function ronby_fitness_call_to_action_two_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading2' => '',
	'description' => '',
	'button_label' => '',
	'button_url' => '',
	'headline1_color' => '',
	'headline2_color' => '',
	'description_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'bg_img' => '',	
	'p_top' => '',	
	'p_bottom' => '',	
	'overlay' => '',	
	), $atts ) );
	
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
		$images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}	
	
	$output='<section class="fitness-cta-two" ';if($images[0]){$output.='style="';if($images[0]){$output.='background-image:url('.esc_url($images[0]).');background-size:cover;';} $output.='"';}$output.='>
			<div class="overlay p-30-0-30" ';if($overlay || $p_top || $p_bottom){$output.='style="';if($overlay){$output.='background-color:'.esc_attr($overlay).';';}if($p_top){$output.='padding-top:'.esc_attr($p_top).';';}if($p_bottom){$output.='padding-bottom:'.esc_attr($p_bottom).';';} $output.='"';}$output.='>
			<div class="col-md-12 text-center">
			';if($heading1){$output.='
			<h2 class="fitness-cta-heading1 text-center" ';if($headline1_color){$output.='style="color:'.esc_attr($headline1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>	
			';}$output.='
			';if($heading2){$output.='
			<h2 class="fitness-cta-heading2 text-center" ';if($headline2_color){$output.='style="color:'.esc_attr($headline2_color).'"';}$output.='>'.$heading2.'</h2>
			';}$output.='
			';if($description){$output.='
			<div class="fitness-cta-p text-center" ';if($description_color){$output.='style="color:'.esc_attr($description_color).'"';}$output.='>'.$description.'</div>
			';}$output.='
			';if($button_label){$output.='
			<a class="fitness-cta-button button rounded-capsule button-primary mt-4" href="'.esc_url($button_url).'" target="_self" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'</a>
			';}$output.='
			</div>
			</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fitness_call_to_action_two', 'ronby_fitness_call_to_action_two_shortcode');

/*****************************
Business Feature Box Section- 2
******************************/
//Function for Business Feature Box Section- 2
function ronby_business_feature_box_sec_two_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline1' => '',
	'headline2' => '',
	'bg_img' => '',
	'number_of_items' => '',
	'headline1_color' => '',
	'headline2_color' => '',
	'icon_color' => '',
	'title_color' => '',
	'desc_color' => '',
	'feature_box_bg' => '',
	'replace_word' => '',
	'replace_word_color' => '',
	), $atts ) );
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
		$images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}

	if($replace_word && $replace_word_color){  	
	$replace= preg_replace('/\b'.$replace_word.'\b/i',"<span style='color:".esc_attr($replace_word_color)."'>$replace_word</span>",$headline1);  
	}else{	
	$replace= $headline1;	
	}	
	$output='<section class="fitness-feature-box-sec-two  p-30-0-30" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).')"';}$output.='>
	<div class="container">
	<div class="row">
	<div class="headline-box">
	';if($headline1){$output.='
	<h1 ';if($headline1_color){$output.='style="color:'.esc_attr($headline1_color).'"';}$output.='>'.$replace.'</h1>
	';}$output.='
	';if($headline2){$output.='
	<p ';if($headline2_color){$output.='style="color:'.esc_attr($headline2_color).'"';}$output.='>'.esc_attr($headline2).'</p>
	';}$output.='	
	</div>	
	</div>
	<div class="row">
';
	$i=1;
	$c=0;
	while ($i<=$number_of_items){
	$c++;
	$b = shortcode_atts(array(
	'icon'.$c.'' => '',
	'title'.$c.'' => '',
	'desc'.$c.'' => '',
    ),$atts);
	$icon =$b['icon'.$c.''];
	$title =$b['title'.$c.''];
	$desc =$b['desc'.$c.''];
	$output.='	
	<div class="col-md-4 text-center mb-2">
	<div class="feature-box" ';if($feature_box_bg){$output.='style="background-color:'.esc_attr($feature_box_bg).'"';}$output.='>
	<div class="icon-box">
	<span class="'.esc_attr($icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></span>
	</div>
	<div class="title-box">
	<h2 ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr($title).'</h2>
	</div>
	<div class="desc-box">
	<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>'.$desc.'</p>
	</div>	
	</div>
	</div>
	';	
	$i++;
	}
	$output.='	
	</div>	
	</div>	
	</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_feature_box_sec_two', 'ronby_business_feature_box_sec_two_shortcode');

/*****************************
Fitness Testimonial Slider
******************************/
//Function for Fitness Testimonial Slider
function ronby_fitness_testimonial_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'overlay_color' => '',
	'bg_img' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'number_of_testimonial' => '',
	'headline1' => '',
	'headline1_padding_left' => '',
	'headline2' => '',
	'headline3' => '',
	'headline1_color' => '',
	'headline2_color' => '',
	'headline3_color' => '',
	'text_color' => '',
	'name_color' => '',
	'designation_color' => '',	
	), $atts ) );
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
    $get_image = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}			
	$output='<section class="fitness-testimonial-slider" ';if($get_image[0]){$output.='style="background:url('.esc_url($get_image[0]).');background-size:cover;"';}$output.='>
	<div class="overlay p-30-0-30" ';if($padding_top || $padding_bottom || $overlay_color){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).'';}$output.=';';if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).'';}$output.=';';if($overlay_color){$output.='background-color:'.esc_attr($overlay_color).'';}$output.='"';}$output.='>
			<div class="container">
			';if($headline1 || $headline2){$output.='
			<div class="section-header-style-6 p-30-0-30  text-center">
			';if($headline1){$output.='
			<h2 class="section-title" ';if($headline1_color || $headline1_padding_left){$output.='style="';if($headline1_color){$output.='color:'.esc_attr($headline1_color).';';}if($headline1_padding_left){$output.='padding-left:'.esc_attr($headline1_padding_left).'';}$output.='"';}$output.='>'.esc_attr($headline1).'</h2>
			';}$output.='
			';if($headline2){$output.='
			<h3 class="section-sub-title" ';if($headline2_color){$output.='style="color:'.esc_attr($headline2_color).'"';}$output.='>'.esc_attr($headline2).'</h3>
			';}$output.='
			</div>
			';if($headline3){$output.='
			<div class="section-description text-center" ';if($headline3_color){$output.='style="color:'.esc_attr($headline3_color).'"';}$output.='>
			'.$headline3.'	
			</div>	
			';}$output.='			
			';}$output.='
			<div class="testimonial-slider-4 owl-carousel  owl-theme owl-loaded">';
	$i=1;
	$c=0;
	while ($i<=$number_of_testimonial){
	$c++;
	$b = shortcode_atts(array(
	'name'.$c.'' => '',
	'designation'.$c.'' => '',
    'text'.$c.'' => '',
    'img_url'.$c.'' => '',
    ),$atts);
	$name =$b['name'.$c.''];
	$designation =$b['designation'.$c.''];
    $text =$b['text'.$c.''];
    $img_url =$b['img_url'.$c.''];
	$output.='<div class="item">
	<div class="col-md-10 sec-auto-margin">
	';if($text){$output.='
	<p ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>'.$text.'</p>
	';}$output.='
	<div class="testimonial-footer  row">
	<div class="testimonial-footer-inner">
	';if($img_url){$output.='
	<div class="author-image"> 
	<img src="'.esc_url($img_url).'" alt="'.esc_attr__('profile-image','ronby').'" class="img-fluid testimonial-img mr-4">
	</div>
	';}$output.='
	';if($name){$output.='
	<div class="author-info">
	<h3 class="author-name" ';if($name_color){$output.='style="color:'.esc_attr($name_color).'"';}$output.='> '.esc_attr($name).'</h3> <span class="author-designation" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='> '.esc_attr($designation).' </span>
	</div>
	';}$output.='
	</div>
	</div>
	</div>				
	</div>';	
	$i++;
	}
	$output.='</div>
			</div>
			</div>
			</section>';				
	return $output;
}
add_shortcode('ronby_shortcode_for_fitness_testimonial_slider', 'ronby_fitness_testimonial_slider_shortcode');

/*****************************
Medical Appointment Section
******************************/
//Function for Medical Appointment Section
function ronby_medical_appointment_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'desc' => '',
	'btn_label' => '',
	'headline_color' => '',
	'desc_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',
	'bg_img' => '',
	'p_top' => '',
	'p_bottom' => '',
	'email_subject' => '',
	'recipient_name' => '',
	'recipient_email' => '',
	'name_field_placeholder' => 'Your Name',
	'phone_field_placeholder' => 'Phone Number',
	), $atts ) );
 	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
		$images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}	
	$output='<section class="p-30-0-30" ';if($images[0] || $p_top || $p_bottom){$output.='style="';if($images[0]){$output.='background-image:url('.esc_url($images[0]).');background-size: cover;';}if($p_top){$output.='padding-top:'.esc_attr($p_top).';';}if($p_bottom){$output.='padding-bottom:'.esc_attr($p_bottom).';';} $output.=';
	"';}$output.='>
	<div class="row">
	<div class="col-md-4 offset-md-7">
	<div class="medical_appointment_form_wrapper m-2">
	
	<div class="section-header-style-9 text-center">
	';if($headline){$output.='
	<h3 ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>'.esc_attr($headline).'</h3>
	';}$output.='
	';if($desc){$output.='
	<p ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>'.$desc.'</p>
	';}$output.='
	</div>
	
	<form id="medical_appointment_form" method="POST">
	<div class="form-group">
	<input type="text" class="input-styled" name="name" id="name" placeholder="'.esc_attr($name_field_placeholder).'" required/>
	</div>
	<div class="form-group">
	<input type="number" class="input-styled" name="phone" id="phone" placeholder="'.esc_attr($phone_field_placeholder).'" required/>
	</div>
	<div class="form-group text-center mb-0">
	<button type="submit" class="button rounded-capsule button-primary" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="ap-contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>
	</div>	
	<div class="col-lg-12">
	<div class="alert alert-success display-none" id="ap-success-msg">
	<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
	</div>	
	<div class="alert alert-danger display-none" id="ap-failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
	</div>	
	<input type="hidden" name="email_subject" id="ap-email_subject" value="'.esc_attr($email_subject).'" />
	<input type="hidden" name="recipient_name" id="ap-recipient_name" value="'.esc_attr($recipient_name).'" />
	<input type="hidden" name="recipient_email" id="ap-recipient_email" value="'.sanitize_email($recipient_email).'" />							
	</form>
	</div>	
	</div>
	</div>
	</section>';
	
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#medical_appointment_form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#name").val();
                    var phone = jQuery("#phone").val();
                    var recipient_email = jQuery("#ap-recipient_email").val();
                    var recipient_name = jQuery("#ap-recipient_name").val();
                    var email_subject = jQuery("#ap-email_subject").val();					
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".ap-contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'medical-appointment-form.php",
                        data: {name: name,phone:phone,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,},
						complete: function(){
							jQuery("#medical_appointment_form")[0].reset();
							jQuery(".ap-contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#ap-success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#ap-success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#ap-failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#ap-failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_appointment', 'ronby_medical_appointment_sec_shortcode');

/*****************************
Medical Appointment Form
******************************/
//Function for Medical Appointment Form
function ronby_medical_appoint_form_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'headline_one'   => '',
    'headline_two'   => '',
    'headline_one_color'   => '',
    'headline_two_color'   => '',
    'btn_text_color'   => '',
    'btn_bg_color'   => '',
	
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Name ',
	'email_field_placeholder' => 'Email ',
	'phone_field_placeholder' => 'Phone ',
	'date_field_placeholder' => 'Appointment Date',
	'message_field_placeholder' => 'Message ',
	'button_label' => 'Book Appointment',

	'wanttoselect' => 'no',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',
	), $atts ) );
	
	$output='<section class="p-30-0-30 medical-appointment-form-two">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-12 color-inverse">
							<div class="section-header-style-10">
							';if($headline_one){$output.='
								<h4 class="section-sub-title" ';if($headline_one_color){$output.='style="color:'.esc_attr($headline_one_color).'"';}$output.='>'.esc_attr($headline_one).'</h4>
							';}$output.='
							';if($headline_two){$output.='							
								<h2 class="section-title" ';if($headline_two_color){$output.='style="color:'.esc_attr($headline_two_color).'"';}$output.='>'.esc_attr($headline_two).'</h2>
							';}$output.='	
							</div>
							<div class="form-style-6">
								<form id="m-apf-form" method="POST">
									<div class="form-group">
										<input type="text" class="input-styled" placeholder="'.esc_attr($name_field_placeholder).'" id="m-apf-name" required>
									</div>
									<div class="row gutter-5">
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="input-styled" placeholder="'.esc_attr($email_field_placeholder).'" id="m-apf-email" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="input-styled" placeholder="'.esc_attr($phone_field_placeholder).'" id="m-apf-phone" required>
											</div>
										</div>
									</div>
									<div class="row gutter-5">
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="input-styled" placeholder="'.esc_attr($date_field_placeholder).'" id="m-apf-date" required>
											</div>
										</div>
			
								'; if($wanttoselect=="yes"){
								$output .= '<div class="col-md-6">
										<div class="form-group">
										<select class="input-styled" name="cf-select" id="m-apf-cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}
								$output .= '</select>
											</div>
											</div>';
									} $output .='
								</div>			
									<div class="form-group">
										<textarea class="input-styled" name="message" id="m-apf-sendermessage" rows="10" placeholder="'.esc_attr($message_field_placeholder).'" required></textarea>
									</div>
									<div class="form-group mt-4">

									<button class="button button-secondary rounded" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="m-apf-contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>										
									</div>
	<input type="hidden" name="email_subject" id="m-apf-email_subject" value="'.esc_attr($email_subject).'" />
	<input type="hidden" name="recipient_name" id="m-apf-recipient_name" value="'.esc_attr($recipient_name).'" />
	<input type="hidden" name="recipient_email" id="m-apf-recipient_email" value="'.sanitize_email($recipient_email).'" />		
	<div class="col-lg-12 nopadding">
	<div class="alert alert-success display-none" id="m-apf-success-msg">
	<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
	</div>	
	<div class="alert alert-danger display-none" id="m-apf-failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
	</div>		
								</form>
							</div>
						</div>
					
					</div>
				</div>
			</section>';
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#m-apf-form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#m-apf-name").val();
                    var email = jQuery("#m-apf-email").val();
                    var phone = jQuery("#m-apf-phone").val();
                    var date = jQuery("#m-apf-date").val();
                    var message = jQuery("#m-apf-sendermessage").val();
                    var recipient_email = jQuery("#m-apf-recipient_email").val();
                    var recipient_name = jQuery("#m-apf-recipient_name").val();
                    var email_subject = jQuery("#m-apf-email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";
						var select = jQuery("#m-apf-cf-select").val();
					'; } $output.='	
														
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".m-apf-contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'medical-appointment-form-two.php",
                        data: {name: name,email:email,phone:phone,date:date,message:message,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; } $output.='},
						complete: function(){
							jQuery("#m-apf-form")[0].reset();
							jQuery(".m-apf-contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#m-apf-success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#m-apf-success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#m-apf-failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#m-apf-failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
			jQuery("#m-apf-date").datepicker({
				format: "dd/mm/yyyy",
				startDate: "1d"
			});	
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_appoint_form', 'ronby_medical_appoint_form_shortcode');

/*****************************
Medical Image Gallery
******************************/
//Function for Medical Image Gallery
function ronby_medical_image_gallery_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'title' => '',
	'btn_label' => '',
	'btn_url' => '',
	'images' => '',
	'images2' => '',
	'images3' => '',
	'p_top' => '',
	'p_bottom' => '',
	'title_color' => '',
	'box_bg' => '',
	'btn_text_color' => '',
	), $atts ) );
	$image_ids = explode(',',$images);
	$image_ids2 = explode(',',$images2);
	$image_ids3 = explode(',',$images3);
	
	$output='<section class="p-30-0-30" ';if($p_top || $p_bottom){$output.='style="';if($p_top){$output.='padding-top:'.esc_attr($p_top).';';}if($p_bottom){$output.='padding-bottom:'.esc_attr($p_bottom).';';} $output.='"';}$output.='>
								<div class="d-flex justify-content-lg-end ">
								<div class="gallery-grid-box">
									<div class="inner-box d-flex flex-column justify-content-center" ';if($box_bg){$output.='style="background-color:'.esc_attr($box_bg).'"';}$output.='>
									';if($title){$output.='
										<div class="box-text" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>
											'.$title.'
										</div>
									';}$output.='
									';if($btn_label){$output.='
										<a href="'.esc_url($btn_url).'" class="color-primary" ';if($btn_text_color){$output.='style="color:'.esc_attr($btn_text_color).'"';}$output.='>
											'.esc_attr($btn_label).' <i class="fas fa-caret-right"></i>
										</a>
									';}$output.='	
									</div>
									<div class="flex flex-column justify-content-between popup-gallery no-gutter">
										<div class="d-sm-flex justify-content-between">';
										foreach( $image_ids as $image_id ){
										$c=0;	
										$images = wp_get_attachment_image_src( $image_id, 'images' );
										$output.='	
											<div class="box-item thumbnail animate-zoom">
												<a href="'.esc_url($images[$c]).'" data-lightbox="gallery-image">
													<img src="'.esc_url($images[$c]).'" alt="'.esc_attr__('gallery-image','ronby').'">
												</a>
											</div>
										';} $c++;
										$output.='</div>';	
										$output.='<div class="d-sm-flex justify-content-between">';	
										foreach( $image_ids2 as $image_id2 ){
										$c=0;	
										$images2 = wp_get_attachment_image_src( $image_id2, 'images2' );
										$output.='	
											<div class="box-item thumbnail animate-zoom">
												<a href="'.esc_url($images2[$c]).'" data-lightbox="gallery-image">
													<img src="'.esc_url($images2[$c]).'" alt="'.esc_attr__('gallery-image','ronby').'">
												</a>
											</div>
										';} $c++;
										$output.='</div>';
										$output.='<div class="d-sm-flex justify-content-between">';
										foreach( $image_ids3 as $image_id3 ){
										$c=0;	
										$images3 = wp_get_attachment_image_src( $image_id3, 'images3' );
										$output.='	
											<div class="box-item thumbnail animate-zoom">
												<a href="'.esc_url($images3[$c]).'" data-lightbox="gallery-image">
													<img src="'.esc_url($images3[$c]).'" alt="'.esc_attr__('gallery-image','ronby').'">
												</a>
											</div>
										';} $c++;
										$output.='</div>';
										$output.='

										
									</div>
									
								</div>
							</div>
	</section>';
	
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_image_gallery', 'ronby_medical_image_gallery_shortcode');

/*****************************
Medical Blog Section
******************************/
//Function for Medical Blog Section
function ronby_medical_blog_section_shortcode( $atts ) {
    extract(shortcode_atts(array(
    'multiple'   => '',
    'num_post'   => '-1',
    'word_limit'  => '50',
    'order'      => 'desc',
    'orderby'    => 'post_date',
	'btn_label' => '',
	'btn_url' => '',	
	'btn_text_color'   => '',
    'btn_bg_color'   => '',	
    ), $atts));

	$args = array(
			'posts_per_page'   => $num_post ,
			'cat' => $multiple,
			'order' => $order,
			'orderby' => $orderby,
			'post_status'      => 'publish',
			);
	global $wp_query;		
	$temp_query = $wp_query;
	$wp_query= null;			
	$wp_query = new WP_Query($args);	
	$output='<section class="p-30-0-30 business-blog-section-element">
			<div class="container">
			<div class="row">';	
	if ($wp_query->have_posts()) :  while ($wp_query->have_posts()) : $wp_query->the_post();
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id() );	
	
	$output.='<div class="col-md-4">
						<article class="blog-post-item-1 mb-45">
							<div class="thumbnail thumbnail-rounded animate-zoom">
							';if($get_image){$output.='
							   <a href="'.esc_url(get_the_permalink()).'">
								  <div class="blog-p-f-img h-246" style="background-image: url('.esc_url($get_image).'); background-position: center;background-size:cover"></div>
							   </a>
							';}$output.='	
							';
							//check if post date meta switch in wordpress format is turned on 
                                if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){    
									if(function_exists('e_medical_blog_section_wp_date_meta')) $output.=e_medical_blog_section_wp_date_meta();
								   } 
                                // end wordpress format post date meta
                                else{    
								   if(function_exists('e_medical_blog_section_theme_date_meta')) $output.=e_medical_blog_section_theme_date_meta();
								   }								   
							$output.='
								
							</div>
							<div class="post-author-n-comments">
								';//author meta 
								if(function_exists('e_medical_blog_author_meta')) {$output.=e_medical_blog_author_meta();}
								//comment meta 
								if(function_exists('e_medical_blog_section_comments_meta')) {$output.=e_medical_blog_section_comments_meta($postid);}								
								$output.='
								
							</div>
							';if(get_the_title()){$output.='
							<a href="'.esc_url(get_the_permalink()).'" class="no-color">
								<h3 class="post-title hover-color-secondary animate-300">
									'.esc_attr(get_the_title()).'
								</h3>
							</a>
							';}$output.='
							<p class="post-excerpt m-0">
								';if ( has_post_format( 'video' ) ) : 
								$output.= ronby_content($word_limit); 
								else: 
								$output.= ronby_excerpt($word_limit);
								endif;
								$output.='
							</p>
						</article>

				</div>';
	

	endwhile;endif;	
	$wp_query = null;
	$wp_query = $temp_query;
	wp_reset_query();
	if($btn_label){
	$output.='<div class="text-center w-100-percent">
			<a href="'.esc_url($btn_url).'" class="button button-default rounded hover-color-white hover-background-primary animate-400" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>
			'.esc_attr($btn_label).'
			</a>
			</div>';	
	}		
	$output.='</div>
			</div>
			</section>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_blog_section', 'ronby_medical_blog_section_shortcode');


/*****************************
Medical Google Map
******************************/
//Function for Medical Google Map
function ronby_medical_google_map_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'map_address' 		 => '',
	'map_height' 		 => '480px',	
	), $atts ) );

	$map_address_f=str_replace(" ","+",$map_address);
	
	$output='<section>
					';if($map_address){$output.='
						<div class="google-map">
							<iframe style="width:100%;height:'.esc_attr($map_height).';margin-bottom:-6px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url('https://maps.google.it/maps?q=='.$map_address_f).'=&output=embed"></iframe>
						</div>
					';}$output.='	
	</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_google_map', 'ronby_medical_google_map_shortcode');

/*****************************
Medical Team Details
******************************/
//Function for Medical Team Details
function ronby_medical_team_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'profile_img' 		 => '',
	'fb_url' => '',
	'twitter_url' => '',
	'pinterest_url' => '',
	'linkedin_url' => '',	
	'title' => '',	
	'name' => '',	
	'designation' => '',	
	'short_desc' => '',	
	'phone' => '',	
	'email' => '',	
	'location' => '',	
	'btn_label' => '',	
	'btn_url' => '',	
	'paragraph1' => '',	
	'paragraph2' => '',	
	'paragraph3' => '',	
	'paragraph4' => '',	
	'information_title' => '',	
	'number_of_items1' => '',	
	'number_of_items2' => '',	
	'number_of_testimonials' => '',	
	'working_hour_title' => '',	
	
	'title_color' => '',	
	'name_color' => '',	
	'designation_color' => '',	
	'short_desc_color' => '',	
	'icon_color' => '',	
	'btn_text_color' => '',	
	'btn_bg_color' => '',	
	'paragraph_color' => '',	
	'info_box_bg_color' => '',	
	'info_box_txt_color' => '',	
	'working_hours_bg' => '',	
	'working_hours_txt_color' => '',	
	'testimonial_bg' => '',	
	'testimonial_txt_color' => '',	
	'testimonial_designation_color' => '',	
	), $atts ) );
	$image_ids = explode(',',$profile_img);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'profile_img' );
	}	
	$output='<section class="p-30-0-30">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-10">
						<div class="team-bio-header">
							<div class="row">
								<div class="col-md-5">
									<div class="thumbnail">
									';if($images[0]){$output.='
										<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
									';}$output.='	
										<div class="item-social item-social social-9 d-flex flex-column">
											<a class="hover-background-primary cursor-point">
												<i class="fas fa-share-alt"></i>
											</a>
											';if($fb_url){$output.='
											<a href="'.esc_url($fb_url).'" class="hover-background-primary">
												<i class="fab fa-facebook-f"></i>
											</a>
											';}$output.='
											';if($twitter_url){$output.='
											<a href="'.esc_url($twitter_url).'" class="hover-background-primary">
												<i class="fab fa-twitter"></i>
											</a>
											';}$output.='
											';if($pinterest_url){$output.='
											<a href="'.esc_url($pinterest_url).'" class="hover-background-primary">
												<i class="fab fa-pinterest-p"></i>
											</a>
											';}$output.='
											';if($linkedin_url){$output.='
											<a href="'.esc_url($linkedin_url).'" class="hover-background-primary">
												<i class="fab fa-linkedin-in"></i>
											</a>
											';}$output.='
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="teambio-doc">
										<h2 class="team-title" ';if($name_color){$output.='style="
											color:'.esc_attr($name_color).'"';}$output.='>
											<span class="color-secondary" ';if($title_color){$output.='style="
											color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr($title).'</span> '.esc_attr($name).'
										</h2>
										<div class="team-role" ';if($designation_color){$output.='style="
											color:'.esc_attr($designation_color).'"';}$output.='>'.esc_attr($designation).'</div>
										<p ';if($short_desc_color){$output.='style="
											color:'.esc_attr($short_desc_color).'"';}$output.='>
											'.$short_desc.'
										</p>
										<ul class="list-unstyled pl-0">
											';if($phone){$output.='
											<li>
												<span class="color-secondary mr-2" ';if($icon_color){$output.='style="
											color:'.esc_attr($icon_color).'"';}$output.='><i class="fas fa-phone-volume"></i> '.esc_html__('Phone No :','ronby').' </span> '.esc_attr($phone).'
											</li>
											';}$output.='
											';if($email){$output.='
											<li>
												<span class="color-secondary mr-2" ';if($icon_color){$output.='style="
											color:'.esc_attr($icon_color).'"';}$output.='><i class="fas fa-envelope"></i> '.esc_html__('Email Address :','ronby').' </span> '.esc_attr($email).'
											</li>
											';}$output.='
											';if($location){$output.='
											<li>
												<span class="color-secondary mr-2" ';if($icon_color){$output.='style="
											color:'.esc_attr($icon_color).'"';}$output.='><i class="fas fa-map-marker-alt"></i> '.esc_html__('Location :','ronby').' </span> '.esc_attr($location).'
											</li>
											';}$output.='
										</ul>
										';if($btn_label){$output.='
										<a href="'.esc_url($btn_url).'" class="button background-secondary color-white rounded" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
										';}$output.='
									</div>
								</div>
							</div>
						</div>
						<div class="team-bio-content">
						';if($paragraph1){$output.='
							<p class="mb-5" ';if($paragraph_color){$output.='style="color:'.esc_attr($paragraph_color).'"';}$output.='>
								'.$paragraph1.' 
							</p>
						';}$output.='	
							<div class="row align-items-center my-5">
								<div class="col-md-6">
									<div class="content-box-1 my-3 color-inverse bg-color-0a0a0a" ';if($info_box_bg_color){$output.='style="background-color:'.esc_attr($info_box_bg_color).'"';}$output.='>
								';if($information_title){$output.='
									<h2 class="box-title" ';if($info_box_txt_color){$output.='style="color:'.esc_attr($info_box_txt_color).'"';}$output.='>'.esc_attr($information_title).'</h2>
								';}$output.='	
									<ul class="list-style-5 pl-0">';
									$i=1;
									$c=0;
									while ($i <= $number_of_items1){
									$c++;					
									$b = shortcode_atts(array(
										'info_title'.$c.'' => '',
										'info_desc'.$c.'' => '',
									),$atts);								
									$info_title =$b['info_title'.$c.''];
									$info_desc =$b['info_desc'.$c.''];							
									$output.='
										<li ';if($info_box_txt_color){$output.='style="color:'.esc_attr($info_box_txt_color).'"';}$output.='>
											<span>'.esc_attr($info_title).'</span> <span>'.esc_attr($info_desc).'</span>
										</li>';
									$i++;
									}		
									$output.='	
									</ul>
									</div>
								</div>
								<div class="col-md-6">
									<div class="my3">
								';if($paragraph2){$output.='
									<p class="mb-5" ';if($paragraph_color){$output.='style="color:'.esc_attr($paragraph_color).'"';}$output.='>
										'.$paragraph2.' 
									</p>
								';}$output.='

									</div>
								</div>
							</div>
								';if($paragraph3){$output.='
									<p class="mb-5" ';if($paragraph_color){$output.='style="color:'.esc_attr($paragraph_color).'"';}$output.='>
										'.$paragraph3.' 
									</p>
								';}$output.='
							<div class="row no-gutters align-items-center bg-color-fafafa mb-5" ';if($testimonial_bg){$output.='style="background-color:'.esc_attr($testimonial_bg).'"';}$output.='>
								<div class="col-lg-5">
									<div class="content-box-1 bg-color-0098f1" ';if($working_hours_bg){$output.='style="background-color:'.esc_attr($working_hours_bg).'"';}$output.='>
								';if($working_hour_title){$output.='
									<h2 class="box-title" ';if($working_hours_txt_color){$output.='style="color:'.esc_attr($working_hours_txt_color).'"';}$output.='>'.esc_attr($working_hour_title).'</h2>
								';}$output.='	
									<ul class="list-style-5 pl-0">';
									$i=1;
									$c=0;
									while ($i <= $number_of_items2){
									$c++;					
									$b = shortcode_atts(array(
										'day'.$c.'' => '',
										'time'.$c.'' => '',
									),$atts);								
									$day =$b['day'.$c.''];
									$time =$b['time'.$c.''];							
									$output.='
										<li ';if($working_hours_txt_color){$output.='style="color:'.esc_attr($working_hours_txt_color).'"';}$output.='>
											<span>'.esc_attr($day).'</span> <span>'.esc_attr($time).'</span>
										</li>';
									$i++;
									}		
									$output.='	
									</ul>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="testimonial-slider-3 owl-carousel">
									';
									$i=1;
									$c=0;
									while ($i <= $number_of_testimonials){
									$c++;					
									$b = shortcode_atts(array(
										'img_url'.$c.'' => '',
										'link_to_url'.$c.'' => '',
										'review'.$c.'' => '',
										'reviewer'.$c.'' => '',
										'reviewer_desg'.$c.'' => '',
									),$atts);								
									$img_url =$b['img_url'.$c.''];
									$link_to_url =$b['link_to_url'.$c.''];
									$review =$b['review'.$c.''];
									$reviewer =$b['reviewer'.$c.''];
									$reviewer_desg =$b['reviewer_desg'.$c.''];
									$output.='									
										<div class="item">
											<div class="avatar">
												<a href="'.esc_url($link_to_url).'"><img src="'.esc_url($img_url).'" alt="'.esc_attr__('profile-picture','ronby').'"></a>
											</div>
											';if($review){$output.='
											<div class="item-text" ';if($testimonial_txt_color){$output.='style="color:'.esc_attr($testimonial_txt_color).'"';}$output.='>
												'.$review.' 
											</div>
											';}$output.='
											';if($reviewer){$output.='
											<div class="item-author">
												<span class="author-name" ';if($testimonial_txt_color){$output.='style="color:'.esc_attr($testimonial_txt_color).'"';}$output.='>'.esc_attr($reviewer).'</span> <span class="author-description color-primary" ';if($testimonial_designation_color){$output.='style="color:'.esc_attr($testimonial_designation_color).'"';}$output.='>'.esc_attr($reviewer_desg).'</span>
											</div>
											';}$output.='
										</div>
									';
									$i++;
									}		
									$output.='
									</div>
								</div>
							</div>
								';if($paragraph4){$output.='
									<p ';if($paragraph_color){$output.='style="color:'.esc_attr($paragraph_color).'"';}$output.='>
										'.$paragraph4.' 
									</p>
								';}$output.='
						</div>
					</div>
				</div>
			</div>
</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_team_details', 'ronby_medical_team_details_shortcode');


/*****************************
Medical Service Details
******************************/
//Function for Medical Service Details
function ronby_medical_service_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'link_to_url' => '',
	'image' => '',
	'headline' => '',
	'description' => '',

	'number_of_items2' => '',	
	'number_of_testimonials' => '',	
	'working_hour_title' => '',		
	'feature_box_title' => '',		
	'feature_box_price' => '',		
	'feature_box_desc' => '',		
	'feature_items' => '',		
	'feature_btn_label' => '',		
	'feature_btn_url' => '',
	
	'headline_color' => '',	
	'desc_color' => '',	
	'working_hours_bg' => '',	
	'working_hours_txt_color' => '',	
	'testimonial_bg' => '',	
	'testimonial_txt_color' => '',	
	'testimonial_designation_color' => '',	
	'btn_text_color' => '',
	'btn_bg_color' => '',
	'feature_box_title_color' => '',		
	'feature_box_price_color' => '',		
	'feature_box_desc_color' => '',		
	'feature_items_color' => '',		
	'feature_box_bg' => '',		
	
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}
	if ($feature_items){
	$plan_all_features=explode("\n",$feature_items);
	}	
	$output='<section class="service-detail-2 p-30-0-30">
					<div class="mx-auto mx-width-970">
						<div class="feature-image mb-5">
						';if($images[0]){$output.='
							<a href="'.esc_url($link_to_url).'">
								<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
							</a>
						';}$output.='	
						</div>
						<div class="medical-text-content">
						';if($headline){$output.='
							<h2 ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>'.esc_attr($headline).'</h2>
						';}$output.='
						';if($description){$output.='
							<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
								'.$description.'
							</div>
						';}$output.='	
						</div>
						<div class="row no-gutters align-items-center bg-color-fafafa mb-5" ';if($testimonial_bg){$output.='style="background-color:'.esc_attr($testimonial_bg).'"';}$output.='>
								<div class="col-lg-5">
									<div class="content-box-1 bg-color-0098f1" ';if($working_hours_bg){$output.='style="background-color:'.esc_attr($working_hours_bg).'"';}$output.='>
								';if($working_hour_title){$output.='
									<h2 class="box-title" ';if($working_hours_txt_color){$output.='style="color:'.esc_attr($working_hours_txt_color).'"';}$output.='>'.esc_attr($working_hour_title).'</h2>
								';}$output.='	
									<ul class="list-style-5 pl-0">';
									$i=1;
									$c=0;
									while ($i <= $number_of_items2){
									$c++;					
									$b = shortcode_atts(array(
										'day'.$c.'' => '',
										'time'.$c.'' => '',
									),$atts);								
									$day =$b['day'.$c.''];
									$time =$b['time'.$c.''];							
									$output.='
										<li ';if($working_hours_txt_color){$output.='style="color:'.esc_attr($working_hours_txt_color).'"';}$output.='>
											<span>'.esc_attr($day).'</span> <span>'.esc_attr($time).'</span>
										</li>';
									$i++;
									}		
									$output.='	
									</ul>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="testimonial-slider-3 owl-carousel">
									';
									$i=1;
									$c=0;
									while ($i <= $number_of_testimonials){
									$c++;					
									$b = shortcode_atts(array(
										'img_url'.$c.'' => '',
										'link_to_url'.$c.'' => '',
										'review'.$c.'' => '',
										'reviewer'.$c.'' => '',
										'reviewer_desg'.$c.'' => '',
									),$atts);								
									$img_url =$b['img_url'.$c.''];
									$link_to_url =$b['link_to_url'.$c.''];
									$review =$b['review'.$c.''];
									$reviewer =$b['reviewer'.$c.''];
									$reviewer_desg =$b['reviewer_desg'.$c.''];
									$output.='									
										<div class="item">
											<div class="avatar">
												<a href="'.esc_url($link_to_url).'"><img src="'.esc_url($img_url).'" alt="'.esc_attr__('profile-picture','ronby').'"></a>
											</div>
											';if($review){$output.='
											<div class="item-text" ';if($testimonial_txt_color){$output.='style="color:'.esc_attr($testimonial_txt_color).'"';}$output.='>
												'.$review.' 
											</div>
											';}$output.='
											';if($reviewer){$output.='
											<div class="item-author">
												<span class="author-name" ';if($testimonial_txt_color){$output.='style="color:'.esc_attr($testimonial_txt_color).'"';}$output.='>'.esc_attr($reviewer).'</span> <span class="author-description color-primary" ';if($testimonial_designation_color){$output.='style="color:'.esc_attr($testimonial_designation_color).'"';}$output.='>'.esc_attr($reviewer_desg).'</span>
											</div>
											';}$output.='
										</div>
									';
									$i++;
									}		
									$output.='
									</div>
								</div>
							</div>

						<div class="featrue-and-plans-box" ';if($feature_box_bg){$output.='style="background-color:'.esc_attr($feature_box_bg).'"';}$output.='>
						';if($feature_box_title){$output.='
							<h2 class="title" ';if($feature_box_title_color){$output.='style="color:'.esc_attr($feature_box_title_color).'"';}$output.='>'.esc_attr($feature_box_title).'</h2>
						';}$output.='	
						';if($feature_box_price){$output.='
							<div class="price color-primary" ';if($feature_box_price_color){$output.='style="color:'.esc_attr($feature_box_price_color).'"';}$output.='>
								'.esc_html__('Price:','ronby').' '.esc_attr($feature_box_price).'
							</div>
						';}$output.='	
						';if($feature_box_desc){$output.='
							<p ';if($feature_box_desc_color){$output.='style="color:'.esc_attr($feature_box_desc_color).'"';}$output.='>
								'.$feature_box_desc.'
							</p>
						';}$output.='	
							<div class="row">
								<div class="col-lg-9">
									<ul class="row pl-0">
									';if($feature_items){
										$c=-1;
										foreach($plan_all_features as $feature) {
										$c++;	
										$output.='
										<li class="col-sm-6 col-md-4" ';if($feature_items_color){$output.='style="color:'.esc_attr($feature_items_color).'"';}$output.='>
											<i class="fas fa-check-square color-primary"></i> '.htmlspecialchars_decode($feature).'
										</li>	
										';}}$output.='	
									</ul>
								</div>
								<div class="col-lg-3">
								';if($feature_btn_label){$output.='
									<a href="'.esc_url($feature_btn_url).'" class="button button-primary" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($feature_btn_label).'</a>
									';}$output.='
								</div>
							</div>
						</div>

					</div>
				</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_service_details', 'ronby_medical_service_details_shortcode');

/*****************************
Medical Department Box
******************************/
//Function for Medical Department Box
function ronby_medical_department_box_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'image' => '',
	'icon' => '',
	'title' => '',
	'link_to_url' => '',
	'box_bg_color' => '',
	'box_text_color' => '',
	'box_icon_color' => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<section class="medical-blog-posts">
						<article class="department-item">
						';if($images[0]){$output.='
							<div class="thumbnail animate-zoom">
								<a href="'.esc_url($link_to_url).'">
									<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
								</a>
							</div>
						';}$output.='	
							<div class="item-content">
							';if($icon){$output.='
								<div class="icon background-secondary" ';if($box_bg_color || $box_icon_color){$output.='style="';if($box_bg_color){$output.='background-color:'.esc_attr($box_bg_color).';';}if($box_icon_color){$output.='color:'.esc_attr($box_icon_color).'';}$output.='"';}$output.='>
									<i class="'.esc_attr($icon).'"></i>
								</div>
							';}$output.='
							';if($title){$output.='
								<a href="'.esc_url($link_to_url).'" class="no-color">
									<h3 class="item-title background-secondary" ';if($box_bg_color || $box_text_color){$output.='style="';if($box_bg_color){$output.='background-color:'.esc_attr($box_bg_color).';';}if($box_text_color){$output.='color:'.esc_attr($box_text_color).'';}$output.='"';}$output.='>
										'.esc_attr($title).'
									</h3>
								</a>
							';}$output.='	
							</div>
						</article>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_department_box', 'ronby_medical_department_box_shortcode');

/*****************************
Medical Department Details
******************************/
//Function for Medical Department Details
function ronby_medical_department_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'image' => '',
	'link_to_url' => '',
	'icon' => '',
	'title' => '',
	'desc' => '',
	'desc2' => '',
	'number_of_items' => '',
	'number_of_items2' => '',
	'fold1_title' => '',
	'fold2_title' => '',
	'fold_txt_color' => '',
	'fold1_bg_color' => '',
	'fold2_bg_color' => '',
	'fold1_title_color' => '',
	'fold2_title_color' => '',
	'title_color' => '',
	'desc_color' => '',
	'icon_bg' => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<section class="department-detail mx-auto mx-width-970 p-30-0-30">
					<div class="detail-header">
					';if($images[0]){$output.='
						<div class="feature-image">
							<a href="'.esc_url($link_to_url).'">
								<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
							</a>
						</div>
					';}$output.='	
						<div class="icon d-flex align-items-center justify-content-center background-primary" ';if($icon_bg){$output.='style="background-color:'.esc_attr($icon_bg).'"';}$output.='>
						';if($icon){$output.='
							<i class="'.esc_attr($icon).'"></i>
						';}$output.='	
						</div>
					</div>
					<div class="detail-content medical-text-content">
					';if($title){$output.='
						<h2 ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr($title).'</h2>
					';}$output.='
					';if($desc){$output.='
						<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
							'.$desc.'
						</div>
					';}$output.='	
						<div class="department-pricing">
							<div class="row no-gutters">
								<div class="col-lg-6">
									<div class="content-box-1 background-primary" ';if($fold1_bg_color){$output.='style="background-color:'.esc_attr($fold1_bg_color).'"';}$output.='>
									';if($fold1_title){$output.='
										<h2 class="box-title" ';if($fold1_title_color){$output.='style="color:'.esc_attr($fold1_title_color).'"';}$output.='>'.esc_attr($fold1_title).'</h2>
									';}$output.='	
										<ul class="pl-0">';
									$i=1;
									$c=0;
									while ($i <= $number_of_items){
									$c++;					
									$b = shortcode_atts(array(
										'title'.$c.'' => '',
										'price'.$c.'' => '',
									),$atts);								
									$title =$b['title'.$c.''];
									$price =$b['price'.$c.''];							
									$output.='
										<li ';if($fold_txt_color){$output.='style="color:'.esc_attr($fold_txt_color).'"';}$output.='>
											<span>'.esc_attr($title).'</span> <span>'.esc_attr($price).'</span>
										</li>';
									$i++;
									}		
									$output.='
										</ul>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="content-box-1 background-secondary" ';if($fold2_bg_color){$output.='style="background-color:'.esc_attr($fold2_bg_color).'"';}$output.='>
									';if($fold2_title){$output.='
										<h2 class="box-title" ';if($fold2_title_color){$output.='style="color:'.esc_attr($fold2_title_color).'"';}$output.='>'.esc_attr($fold2_title).'</h2>
									';}$output.='	
										<ul class="pl-0">';
									$i=1;
									$c=0;
									while ($i <= $number_of_items2){
									$c++;					
									$b = shortcode_atts(array(
										'f2_title'.$c.'' => '',
										'f2_price'.$c.'' => '',
									),$atts);								
									$title =$b['f2_title'.$c.''];
									$price =$b['f2_price'.$c.''];							
									$output.='
										<li ';if($fold_txt_color){$output.='style="color:'.esc_attr($fold_txt_color).'"';}$output.='>
											<span>'.esc_attr($title).'</span> <span>'.esc_attr($price).'</span>
										</li>';
									$i++;
									}		
									$output.='
										</ul>
									</div>
								</div>
							</div>
						</div>
						';if($desc2){$output.='
						<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
							'.$desc2.'
						</div>
						';}$output.='
					</div>
				</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_department_details', 'ronby_medical_department_details_shortcode');

/*****************************
Medical Doctor Profile
******************************/
//Function for Medical Doctor Profile
function ronby_medical_doctor_profile_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'image' => '',
	'link_to_url' => '',
	'fb_url' => '',
	'twitter_url' => '',
	'pinterest_url' => '',
	'linkedin_url' => '',
	'doctor_title' => '',
	'doctor_name' => '',
	'doctor_desgination' => '',
	'doctor_phone' => '',
	'doctor_title_color' => '',
	'doctor_name_color' => '',
	'doctor_designation_color' => '',
	'doctor_phone_color' => '',
	'doctor_phone_icon_color' => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<section>
				<div class="team-item-3">
					<div class="thumbnail animate-zoom">
					';if($images[0]){$output.='
						<a href="'.esc_url($link_to_url).'">
							<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
						</a>
					';}$output.='	
						<div class="item-social social-9 d-flex flex-column">
							<a class="hover-background-primary cursor-point">
								<i class="fas fa-share-alt"></i>
							</a>
							';if($fb_url){$output.='
							<a href="'.esc_url($fb_url).'" class="hover-background-primary">
								<i class="fab fa-facebook-f"></i>
							</a>
							';}$output.='
							';if($twitter_url){$output.='
							<a href="'.esc_url($twitter_url).'" class="hover-background-primary">
								<i class="fab fa-twitter"></i>
							</a>
							';}$output.='
							';if($pinterest_url){$output.='
							<a href="'.esc_url($pinterest_url).'" class="hover-background-primary">
								<i class="fab fa-pinterest-p"></i>
							</a>
							';}$output.='
							';if($linkedin_url){$output.='
							<a href="'.esc_url($linkedin_url).'" class="hover-background-primary">
								<i class="fab fa-linkedin-in"></i>
							</a>
							';}$output.='
						</div>
					</div>
					';if($doctor_name){$output.='
					<a href="'.esc_url($link_to_url).'" class="no-color">
						<h3 class="item-title hover-color-primary animate-300" ';if($doctor_name_color){$output.='style="color:'.esc_attr($doctor_name_color).'"';}$output.='><span class="text-highlighted" ';if($doctor_title_color){$output.='style="color:'.esc_attr($doctor_title_color).'"';}$output.='>'.esc_attr($doctor_title).'</span> '.esc_attr($doctor_name).'</h3>
					</a>
					';}$output.='
					';if($doctor_desgination){$output.='
					<h4 class="item-sub-title" ';if($doctor_designation_color){$output.='style="color:'.esc_attr($doctor_designation_color).'"';}$output.='>'.esc_attr($doctor_desgination).'</h4>
					';}$output.='
					';if($doctor_phone){$output.='
					<div class="item-phone-number" ';if($doctor_phone_color){$output.='style="color:'.esc_attr($doctor_phone_color).'"';}$output.='>
						<span class="text-highlighted" ';if($doctor_phone_icon_color){$output.='style="color:'.esc_attr($doctor_phone_icon_color).'"';}$output.='>
							<i class="fas fa-phone-volume"></i> '.esc_html__(' Phone No :','ronby').'  
						</span>
						'.esc_attr($doctor_phone).'
					</div>
					';}$output.='
				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_doctor_profile', 'ronby_medical_doctor_profile_shortcode');

/*****************************
Medical Contact Info Box
******************************/
//Function for Medical Contact Info Box
function ronby_medical_contact_info_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'bg_img' => '',
	'phone' => '',
	'email' => '',
	'location' => '',
	'icon_color' => '',
	'text_color' => '',
	'title_color' => '',
	), $atts ) );
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
		$images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}		
	$output='<section ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).')"';}$output.='>
			<div class="infomation-box-1 background-cover">
			<div class="inner-content">
				<div class="row">
				';if($phone){$output.='
					<div class="col-md-6 col-xl-4">
						<div class="item d-flex">
							<div class="icon color-secondary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
								<i class="flaticon-phone-call"></i>				
							</div>
							<div class="flex-fill" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
								<div class="lb" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr__('Phone','ronby').'</div>
								'.esc_attr($phone).'
							</div>
						</div>
					</div>
				';}$output.='
				';if($email){$output.='				
					<div class="col-md-6 col-xl-4">
						<div class="item d-flex">
							<div class="icon color-secondary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
								<i class="flaticon-clock"></i>
							</div>
							<div class="flex-fill" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
								<div class="lb" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr__('Email','ronby').'</div>
								'.esc_attr($email).'
							</div>
						</div>
					</div>
				';}$output.='
				';if($location){$output.='
					<div class="col-md-6 col-xl-4">
						<div class="item d-flex">
							<div class="icon color-secondary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
								<i class="flaticon-map-pin-silhouette"></i>										
							</div>
							<div class="flex-fill" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
								<div class="lb" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr__('Location','ronby').'</div>
								'.esc_attr($location).'
							</div>
						</div>
					</div>
				';}$output.='	
					
				</div>
				
			</div>
		</div>
	</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_contact_info', 'ronby_medical_contact_info_shortcode');

/*****************************
Medical Heading Section- 2
******************************/
//Function for Medical Heading Section- 2
function ronby_medical_heading_section_two_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading1' => '',
	'heading1_color' => '',
	'heading2' => '',
	'heading2_color' => '',
	), $atts ) );
		
	$output='<section class="p-30-0-30 medical-heading-section-2">
				<div class="section-header-style-2 mb-0">
				';if($heading1){$output.='
					<h2 class="section-title color-primary" ';if($heading1_color){$output.='style="color:'.esc_attr($heading1_color).'"';}$output.='>'.esc_attr($heading1).'</h2>
				';}$output.='	
				';if($heading2){$output.='
					<h4 class="section-sub-title" ';if($heading2_color){$output.='style="color:'.esc_attr($heading2_color).'"';}$output.='>'.esc_attr($heading2).'</h4>
				';}$output.='	
				<div class="separator">
					<div class="icon">
						<i class="flaticon-drawing"></i>
					</div>
				</div>
				</div>
	</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_heading_section_two', 'ronby_medical_heading_section_two_shortcode');

/*****************************
Medical Contact Form
******************************/
//Function for Medical Contact Form
function ronby_medical_contact_form_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'recipient_name'   => '',
	'recipient_email'  => '',
	'email_subject'    => '',
	'name_field_placeholder' => 'Your name *',
	'email_field_placeholder' => 'Your email *',
	'subject_field_placeholder' => 'Your subject *',
	'message_field_placeholder' => 'Your Message *',
	'button_label' => 'Send Message',

	'wanttoselect' => 'no',
	'yourselect' => 'Select One',
	'selectitems' => 'One, Two, Three, Four, Five',
	'wanttoradio' => 'no',
	'yourradio' => 'Select Radio',
	'radioitems' => 'One, Two, Three, Four, Five',
	'wanttocheckbox' => 'no',
	'yourcheckbox' => 'Select Checkbox',
	'checkboxitems' => 'One, Two, Three, Four, Five',

	'btn_text_color' => '',
	'btn_bg_color' => '',	
	), $atts ) );
		
	$output='<section class="p-30-0-30">
			<div class="form-style-2">
						<form class="contact-form"  method="POST" id="medical-contact-form">

							<div class="form-group">
								<textarea class="input-styled" id="mdf-sendermessage"  rows="10" placeholder="'.esc_attr($message_field_placeholder).'" required></textarea>
							</div>
							<div class="row m-bottom-40">
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="text" placeholder="'.esc_attr($name_field_placeholder).'" id="mdf-sendername" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="email" placeholder="'.esc_attr($email_field_placeholder).'" id="mdf-senderemail" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<input class="input-styled" type="text" placeholder="'.esc_attr($subject_field_placeholder).'" id="mdf-sendersubject" required>
									</div>
								</div>
						'; if($wanttoselect=="yes"){
						$output .= '<div class="col-lg-12">
										<div class="form-group">       
										<select class="input-styled" name="cf-select" id="mdf-cf-select" required>
										<option value="">'.esc_attr($yourselect).'</option>';
										$selectitemArray = explode(',', $selectitems);
										foreach($selectitemArray as $selectitem){
											$output .= '<option value="'.$selectitem.'">'.$selectitem.'</option>';
										}

								$output .= '</select>
											</div>
											</div>';
								} $output .='	
						'; if($wanttoradio=="yes"){
						$output .= '<div class="col-lg-12">
									<div class="form-group">
									<label class="lable-text" for="cf-radio">'.esc_attr($yourradio).'</label><br>';
									$radioitemArray = explode(',', $radioitems);
									$i=1;
									foreach($radioitemArray as $radioitem){
										$output .= '<span class="mr-10"><input class="control-radio mr-10" type="radio" name="mdf-cf-radio" value="'.$radioitem.'"  id="mdf-cf-radio'.$i.'">'.$radioitem.'</span>';
										$i++;
									}
						$output .='</div></div>';
						} $output .='
						';if($wanttocheckbox=="yes"){
						$output .=  '<div class="col-lg-12">
									<div class="form-group">
						 <label class="lable-text" for="cf-checkbox">'.esc_attr($yourcheckbox).'</label><br>';
						 $checkboxitemArray = explode(',', $checkboxitems);
						 $i=1;
							foreach($checkboxitemArray as $checkboxitem){
									$output .=  '<span class="mr-10"><input type="checkbox" class="mdf-control-checkbox mr-10" name="cf-checkbox[]" value="'.$checkboxitem.'"  id="mdf-cf-checkbox'.$i.'">'.$checkboxitem.'</span>';
									$i++;
							}

						$output .='</div></div>';
						} $output .='								
							</div>
							<div class="text-center mt-5">
							<button class="button button-primary rounded" type="submit" ';if($btn_bg_color || $btn_text_color){$output.='style="';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).';border-color: '.esc_attr($btn_bg_color).';';}if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.='"';}$output.='>'.esc_attr($button_label).'<img src="'.esc_url(plugin_dir_url( __FILE__ ) .'images/msg_loader.gif').'" class="mdf-contact-form-loader display-none" style="width:20px;height:20px;" alt="'.esc_attr('loader').'"/></button>								
							</div>
							<div class="col-lg-12 nopadding">
							<div class="alert alert-success display-none mt-4" id="mdf-success-msg">
							<strong>'.esc_html__('Congratulation!','ronby').'</strong> '.esc_html__('Your message sent. Expect a response soon.','ronby').'
							</div>	
							<div class="alert alert-danger display-none mt-4" id="mdf-failed-msg"><strong>'.esc_html__('Sorry!','ronby').'</strong> '.esc_html__('Message not sent! Try again later.','ronby').'</strong></div>	
							</div>	
					<input type="hidden" name="email_subject" id="mdf-email_subject" value="'.esc_attr($email_subject).'" />
  					<input type="hidden" name="recipient_name" id="mdf-recipient_name" value="'.esc_attr($recipient_name).'" />
					<input type="hidden" name="recipient_email" id="mdf-recipient_email" value="'.sanitize_email($recipient_email).'" />							
						</form>
					</div>
					</section>';
	$output.='<script>
            jQuery(document).ready(function(){
                jQuery("#medical-contact-form").on("submit", function(e){
                    e.preventDefault();
                    var name = jQuery("#mdf-sendername").val();
                    var email = jQuery("#mdf-senderemail").val();
                    var subject = jQuery("#mdf-sendersubject").val();
                    var message = jQuery("#mdf-sendermessage").val();
                    var recipient_email = jQuery("#mdf-recipient_email").val();
                    var recipient_name = jQuery("#mdf-recipient_name").val();
                    var email_subject = jQuery("#mdf-email_subject").val();
					'; if($wanttoselect=="yes"){$output .= ' 	
						var select_title = "'.esc_attr($yourselect).'";					
						var select = jQuery("#mdf-cf-select").val();
					'; } $output.='	
					
					'; if($wanttoradio=="yes"){ $output .= '				
						var radio = jQuery("input[name=mdf-cf-radio]:checked").val();
						var radio_title = "'.esc_attr($yourradio).'";
					'; } $output.='	
					
					';if($wanttocheckbox=="yes"){ $output .=  '				
						var checkbox_title = "'.esc_attr($yourcheckbox).'";
						var checkArray = [];					
						jQuery(".mdf-control-checkbox:checked").each(function(i,e) {
							checkArray.push(jQuery(this).val());
						});
					'; } $output.='						
                    jQuery.ajax({
                        type: "POST",
						
						beforeSend: function(){
							jQuery(".mdf-contact-form-loader").css("display", "inline-block");
						  },
                        url: "'.plugin_dir_url( __FILE__ ).'medical-contact-form.php",
                        data: {name: name,email:email,message:message,recipient_email:recipient_email,recipient_name:recipient_name,email_subject:email_subject,'; if($wanttoselect=="yes"){$output .= ' select_title:select_title,select:select,'; }  if($wanttoradio=="yes"){ $output .= 'radio_title:radio_title,radio:radio,'; } if($wanttocheckbox=="yes"){ $output .= 'checkbox_title:checkbox_title,"checkbox[]":checkArray.join(),'; } $output.='subject:subject},
						complete: function(){
							jQuery("#medical-contact-form")[0].reset();
							jQuery(".mdf-contact-form-loader").css("visibility", "hidden");
						  },
                        success: function(data){
                          jQuery("#mdf-success-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#mdf-success-msg").offset().top - 100 }, 2000);
                        },	
						error: function(data){
                          jQuery("#mdf-failed-msg").show();
						  jQuery("html, body").animate({
						scrollTop: jQuery("#mdf-failed-msg").offset().top - 100 }, 2000);
						  },
					  
                    });
                });
            });
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}			
        </script>';		
	return $output;
}
add_shortcode('ronby_shortcode_for_medical_contact_form', 'ronby_medical_contact_form_shortcode'); 

/*****************************
Business Contact Info Box
******************************/
//Function for Business Contact Info Box
function ronby_business_contact_info_box_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading' 		 => '',
	'desc' 		 => '',
	'map_address' 		 => '',
	'map_height' 		 => '480px',	
	'bg_img' => '',
	'phone' => '',
	'email' => '',
	'location' => '',
	'icon_color' => '',
	'text_color' => '',
	'title_color' => '',	
	'heading_color' => '',	
	'desc_color' => '',	
	), $atts ) );

$map_address_f=str_replace(" ","+",$map_address);
$image_ids = explode(',',$bg_img);
foreach( $image_ids as $image_id ){
	$images = wp_get_attachment_image_src( $image_id, 'bg_img' );
}	

	$output='<section class="contact-us p-30-0-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<div class="contact-page-detail">
							<div class="section-header-style-1">
							';if($heading){$output.='
							<h2 class="section-title" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>
							'.esc_attr($heading).'
							</h2>
							';}$output.='
							</div>
							';if($desc){$output.='
							<div class="mb-4" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
							'.$desc.'
							</div>
							';}$output.='
						<div class="infomation-box-1 background-cover" ';if($images[0]){$output.='style="background-image:url('.esc_url($images[0]).')"';}$output.='>
						<div class="inner-content">
							<div class="row">
							';if($phone){$output.='
								<div class="col-md-6">
									<div class="item d-flex">
										<div class="icon color-secondary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
											<i class="flaticon-phone-call"></i>				
										</div>
										<div class="flex-fill" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
											<div class="lb" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr__('Phone','ronby').'</div>
											'.esc_attr($phone).'
										</div>
									</div>
								</div>
							';}$output.='
							';if($email){$output.='				
								<div class="col-md-6">
									<div class="item d-flex">
										<div class="icon color-secondary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
											<i class="flaticon-clock"></i>
										</div>
										<div class="flex-fill" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
											<div class="lb" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr__('Email','ronby').'</div>
											'.esc_attr($email).'
										</div>
									</div>
								</div>
							';}$output.='
							';if($location){$output.='
								<div class="col-md-6">
									<div class="item d-flex">
										<div class="icon color-secondary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
											<i class="flaticon-map-pin-silhouette"></i>										
										</div>
										<div class="flex-fill" ';if($text_color){$output.='style="color:'.esc_attr($text_color).'"';}$output.='>
											<div class="lb" ';if($title_color){$output.='style="color:'.esc_attr($title_color).'"';}$output.='>'.esc_attr__('Location','ronby').'</div>
											'.esc_attr($location).'
										</div>
									</div>
								</div>
							';}$output.='	
								
							</div>
							
						</div>
					</div>
						</div>
					</div>
					<div class="col-lg-5">
					';if($map_address){$output.='
						<div class="google-map">
							<iframe style="width:100%;height:'.esc_attr($map_height).';margin-bottom:-6px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url('https://maps.google.it/maps?q=='.$map_address_f).'=&output=embed"></iframe>
						</div>
					';}$output.='						
					</div>
				</div>
			</div>
		</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_contact_info_box', 'ronby_business_contact_info_box_shortcode');

/*****************************
Business Project Details
******************************/
//Function for Business Project Details
function ronby_business_project_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'desc' => '',
	'desc2' => '',
	'desc3' => '',
	'project_on' => '',
	'project_by' => '',
	'project_date' => '',
	'project_tags' => '',
	'image' => '',
	'features1' => '',
	'features2' => '',
	'profile_image' => '',
	'profile_name' => '',
	'profile_designation' => '',
	'profile_short_desc' => '',
	'profile_fb_url' => '',
	'profile_twitter_url' => '',
	'profile_pinterest_url' => '',
	'profile_linkedin_url' => '',
	'headline_color' => '',
	'description_color' => '',
	'p_titles_color' => '',
	'p_text_color' => '',
	'features_color' => '',
	'p_box_bg' => '',
	'p_box_name_c' => '',
	'p_box_designation_c' => '',
	'p_box_desc_c' => '',
	'p_box_social_c' => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}
	$p_image_ids = explode(',',$profile_image);
	foreach( $p_image_ids as $p_image_id ){
    $get_p_img = wp_get_attachment_image_src( $p_image_id, 'profile_image' );
	}	
      $features1 = !empty($features1) ? explode("\n", trim($features1)) : array(); 
      $features2 = !empty($features2) ? explode("\n", trim($features2)) : array(); 

	  $c1=-1;
	  $output_feature1='<ul class="list-style-1 pl-0">'; 
      foreach($features1 as $feature1) {
	  $feature1 = strip_tags($feature1);
	  $c1++;				
	  $output_feature1 .='<li ';if($features_color){$output_feature1.='style="color:'.esc_attr($features_color).'"';}$output_feature1.='>'.htmlspecialchars_decode($feature1).'</li>';
      }
      $output_feature1 .= '</ul>';
      $content1 = $output_feature1;	
	  
	  $c2=-1;
	  $output_feature2='<ul class="list-style-1 pl-0">'; 
      foreach($features2 as $feature2) {
	  $feature2 = strip_tags($feature2);
	  $c2++;				
	  $output_feature2 .='<li ';if($features_color){$output_feature2.='style="color:'.esc_attr($features_color).'"';}$output_feature2.='>'.htmlspecialchars_decode($feature2).'</li>';
      }
      $output_feature2 .= '</ul>';
      $content2 = $output_feature2;	
	  
	$output='<section class="project-detail-1 p-30-0-30">
				<div class="container">

					<div class="mx-auto mx-width-830">
						<div class="section-header">
							<div class="row">
								<div class="col-lg-8 mb-4">
								';if($headline){$output.='
									<h2 class="post-title mx-width-500" ';if($headline_color){$output.='style="color:'.esc_attr($headline_color).'"';}$output.='>
									'.$headline.'
									</h2>
								';}$output.='
								';if($desc){$output.='
									<p ';if($description_color){$output.='style="color:'.esc_attr($description_color).'"';}$output.='>
									'.$desc.'
									</p>
								';}$output.='	
								</div>
								<div class="col-lg-4 mb-4">
									<ul class="no-style">
									';if($project_on){$output.='
										<li ';if($p_text_color){$output.='style="color:'.esc_attr($p_text_color).'"';}$output.='><b class="lb" ';if($p_titles_color){$output.='style="color:'.esc_attr($p_titles_color).'"';}$output.='>'.esc_html__('Project on:','ronby').'</b> '.esc_attr($project_on).'</li>
									';}$output.='
									';if($project_by){$output.='
										<li ';if($p_text_color){$output.='style="color:'.esc_attr($p_text_color).'"';}$output.='><b class="lb" ';if($p_titles_color){$output.='style="color:'.esc_attr($p_titles_color).'"';}$output.='>'.esc_html__('Project By:','ronby').'</b> '.esc_attr($project_by).'</li>
									';}$output.='
									';if($project_date){$output.='
										<li ';if($p_text_color){$output.='style="color:'.esc_attr($p_text_color).'"';}$output.='><b class="lb" ';if($p_titles_color){$output.='style="color:'.esc_attr($p_titles_color).'"';}$output.='>'.esc_html__('Date:','ronby').'</b> '.esc_attr($project_date).'</li>
									';}$output.='
									';if($project_tags){$output.='
										<li ';if($p_text_color){$output.='style="color:'.esc_attr($p_text_color).'"';}$output.='><b class="lb" ';if($p_titles_color){$output.='style="color:'.esc_attr($p_titles_color).'"';}$output.='>'.esc_html__('Tags:','ronby').'</b> '.esc_attr($project_tags).'</li>
									';}$output.='	
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="mx-auto mx-width-970">
					';if(function_exists('e_business_projects_social_share_meta')){$output.=e_business_projects_social_share_meta();}$output.='
						';if($images[0]){$output.='						
						<div class="article-image mb-5">
							<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
						</div>
						';}$output.='
					</div>

					<div class="mx-auto mx-width-830">
						<div class="text-content-area">
							';if($desc2){$output.='
									<p ';if($description_color){$output.='style="color:'.esc_attr($description_color).'"';}$output.='>
									'.$desc2.'
									</p>
							';}$output.='
							<div class="row">
							';if($content1){$output.='
								<div class="col-md-4">
									'.$content1.'
								</div>
							';}$output.='	
							';if($content2){$output.='
								<div class="col-md-4">
									'.$content2.'
								</div>
							';}$output.='	
							</div>
							';if($desc3){$output.='
									<p ';if($description_color){$output.='style="color:'.esc_attr($description_color).'"';}$output.='>
									'.$desc3.'
									</p>
							';}$output.='
						</div>
					</div>

					<div class="mx-auto mx-width-970">
						<div class="user-quote-1 d-sm-flex" ';if($p_box_bg){$output.='style="background-color:'.esc_attr($p_box_bg).'"';}$output.='>
						';if($get_p_img[0]){$output.='
							<div class="quote-thumb">
								<img src="'.esc_url($get_p_img[0]).'" alt="'.esc_attr__('Profile Image','ronby').'">
							</div>
						';}$output.='	
							<div class="quote-content flex-fill">
								<div class="item-header">
								';if($profile_name){$output.='
									<span class="name" ';if($p_box_name_c){$output.='style="color:'.esc_attr($p_box_name_c).'"';}$output.='>'.esc_attr($profile_name).'</span>
								';}$output.='	
								';if($profile_designation){$output.='
									<span class="description" ';if($p_box_designation_c){$output.='style="color:'.esc_attr($p_box_designation_c).'"';}$output.='>'.esc_attr($profile_designation).'</span>
								';}$output.='	
								</div>
								';if($profile_short_desc){$output.='
								<p class="quote-text" ';if($p_box_desc_c){$output.='style="color:'.esc_attr($p_box_desc_c).'"';}$output.='>
									'.$profile_short_desc.' 
								</p>
								';}$output.='
								<div class="item-social" ';if($p_box_social_c){$output.='style="color:'.esc_attr($p_box_social_c).'"';}$output.='>
									<span>'.esc_html__('Follow us:','ronby').'</span>
									<span class="sharing-icons">
									';if($profile_fb_url){$output.='
										<a class="no-color" href="'.esc_url($profile_fb_url).'"><i class="fab fa-facebook"></i></a>
									';}$output.='
									';if($profile_twitter_url){$output.='
										<a class="no-color" href="'.esc_url($profile_twitter_url).'"><i class="fab fa-twitter"></i></a>
									';}$output.='
									';if($profile_pinterest_url){$output.='
										<a class="no-color" href="'.esc_url($profile_pinterest_url).'"><i class="fab fa-pinterest-p"></i></a>
									';}$output.='	
									';if($profile_linkedin_url){$output.='
										<a class="no-color" href="'.esc_url($profile_linkedin_url).'"><i class="fab fa-linkedin-in"></i></a>
									';}$output.='	
									</span>
								</div>
							</div>
						</div>
					</div>

				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_project_details', 'ronby_business_project_details_shortcode');

/*****************************
Business Projects Tab Section
******************************/
//Function for Business Projects Tab Section
function ronby_business_projects_tab_sec_shortcode( $atts ) {
	extract( shortcode_atts( array(
    'heading' => '',
    'showall' => '',
	'features' => '',
	'number_of_items' => '',
	'heading_c' => '',
	'categories_sec_bg' => '',
	'categories_c' => '',
	'title_c' => '',
	'desc_c' => '',
	), $atts ) );
	
	if(!empty($features)){
      $output = '<div id="filters" class="filter-nav-1" ';if($categories_sec_bg){$output.='style="background-color:'.esc_attr($categories_sec_bg).'"';}$output.='>	  
					<div class="row">					
					<div class="col-lg-3">
					';if($heading){$output.='
						<div class="lb" ';if($heading_c){$output.='style="color:'.esc_attr($heading_c).'"';}$output.='>'.esc_attr($heading).'</div>
					';}$output.='	
					</div>					
				<div class="col-lg-9">	
				  <ul class="no-style text-right">
				  ';if($showall){$output.='
					<li  class="hover-color-primary active-color-primary after-background-primary animate-300 is-checked active" data-filter="*" ';if($categories_c){$output.='style="color:'.esc_attr($categories_c).'"';}$output.='>
						<span class="text">'.esc_attr($showall).'</span>
				  </li>';
				  }
      $features = !empty($features) ? explode("\n", trim($features)) : array(); 

	  $c=-1;
      foreach($features as $feature) {
	  $feature = strip_tags($feature);
	  $c++;
      $output .= '<li class="hover-color-primary active-color-primary after-background-primary animate-300" data-filter=".'.$feature.'" ';if($categories_c){$output.='style="color:'.esc_attr($categories_c).'"';}$output.='>';
				
	  $output .=''.htmlspecialchars_decode($feature).'</li>';
      }
      $output .= '</ul>
				  </div>
				  </div>
				  </div>';
      $content = $output;
    }
	
	$out = '<section class="p-30-0-30 business-projects-tab">
    <div class="container">';
    $out .= ''.do_shortcode($content).'';
	$out .= '<div class="grid">';
							$i=1;
							$c=0;
							$counter=1;
							while ($i <= $number_of_items){
							$c++;
							if($counter > 7){
								$counter=1;
							}
							$b = shortcode_atts(array(
								'item_img'.$c.'' => '',
								'item_title'.$c.'' => '',
								'item_desc'.$c.'' => '',
								'item_url'.$c.'' => '',
								'item_features'.$c.'' => '',
							),$atts);
								
							$item_img =$b['item_img'.$c.''];
							$item_title =$b['item_title'.$c.''];
							$item_desc =$b['item_desc'.$c.''];
							$item_url =$b['item_url'.$c.''];
							$item_features =$b['item_features'.$c.''];
$out .='<div class="';if($counter== 1 || $counter== 7){$out.='col-md-8';}else{$out.='col-md-4';}$out.=' element-item '.esc_attr( $item_features ).'" data-category="'.esc_attr( $item_features ).'">
		<div class="article-with-overlay-2">
		';if($item_img){$out.='
		<div class="thumbnail animate-zoom">
			<a href="'.esc_url($item_url).'" class="thumbnail animate-zoom">
				<img src="'.esc_url($item_img).'" alt="'.esc_attr__('featured-image','ronby').'">
			</a>
		</div>	
		';}$out.='	
			<a href="'.esc_url($item_url).'">
				<div class="overlay overlay-fill">
					<div class="article-description color-primary d-none d-sm-block" ';if($desc_c){$out.='style="color:'.esc_attr($desc_c).'"';}$out.='>'.$item_desc.'</div>
					<h3 class="article-title" ';if($title_c){$out.='style="color:'.esc_attr($title_c).'"';}$out.='>'.esc_attr($item_title).'</h3>												
				</div>
			</a>
		</div>
	</div>';	
	$i++;
	$counter++;
	}
	$out .='				
      </div>
    </div>
  </section>';
  $out.='<script>
  jQuery(function() {       
  jQuery(".filter-nav-1 li").click(function() {   
		jQuery(".filter-nav-1 li").removeClass("active");      
		jQuery(this).addClass("active");      
	  });
	});
  </script>';
    return $out;		

}
add_shortcode('ronby_shortcode_for_business_projects_tab_section', 'ronby_business_projects_tab_sec_shortcode');

/*****************************
Business Service Details
******************************/
//Function for Business Service Details
function ronby_business_service_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'info_box_bg_img' => '',
	'info_box_icon' => '',
	'info_box_title' => '',
	'info_box_desc' => '',
	'info_box_teacher_name' => '',
	'info_box_time' => '',
	'info_box_tags' => '',
	'desc1' => '',
	'desc2' => '',
	'features1' => '',
	'features2' => '',
	'features3' => '',
	'profile_image' => '',
	'profile_name' => '',
	'profile_designation' => '',
	'profile_short_desc' => '',
	'profile_fb_url' => '',
	'profile_twitter_url' => '',
	'profile_pinterest_url' => '',	
	'profile_linkedin_url' => '',	
	'info_box_icon_color' => '',	
	'info_box_icon_bg_color' => '',	
	'info_box_title_color' => '',	
	'info_box_desc_color' => '',
	'info_box_label_color' => '',
	'info_box_text_color' => '',	
	'features_color' => '',
	'desc_color' => '',
	'p_box_bg' => '',
	'p_box_name_c' => '',
	'p_box_designation_c' => '',
	'p_box_desc_c' => '',
	'p_box_social_c' => '',	
	), $atts ) );
	$image_ids = explode(',',$info_box_bg_img);
	foreach( $image_ids as $image_id ){
    $bgimage = wp_get_attachment_image_src( $image_id, 'info_box_bg_img' );
	}
	$p_image_ids = explode(',',$profile_image);
	foreach( $p_image_ids as $p_image_id ){
	$get_p_img = wp_get_attachment_image_src( $p_image_id, 'profile_image' );
	}	
      $features1 = !empty($features1) ? explode("\n", trim($features1)) : array(); 
      $features2 = !empty($features2) ? explode("\n", trim($features2)) : array(); 
      $features3 = !empty($features3) ? explode("\n", trim($features3)) : array(); 

	  $c1=-1;
	  $output_feature1='<ul class="list-style-1 pl-0">'; 
      foreach($features1 as $feature1) {
	  $feature1 = strip_tags($feature1);
	  $c1++;				
	  $output_feature1 .='<li ';if($features_color){$output_feature1.='style="color:'.esc_attr($features_color).'"';}$output_feature1.='>'.htmlspecialchars_decode($feature1).'</li>';
      }
      $output_feature1 .= '</ul>';
      $content1 = $output_feature1;	
	  
	  $c2=-1;
	  $output_feature2='<ul class="list-style-1 pl-0">'; 
      foreach($features2 as $feature2) {
	  $feature2 = strip_tags($feature2);
	  $c2++;				
	  $output_feature2 .='<li ';if($features_color){$output_feature2.='style="color:'.esc_attr($features_color).'"';}$output_feature2.='>'.htmlspecialchars_decode($feature2).'</li>';
      }
      $output_feature2 .= '</ul>';
      $content2 = $output_feature2;		

	  $c3=-1;
	  $output_feature3='<ul class="list-style-1 pl-0">'; 
      foreach($features3 as $feature3) {
	  $feature3 = strip_tags($feature3);
	  $c3++;				
	  $output_feature3 .='<li ';if($features_color){$output_feature3.='style="color:'.esc_attr($features_color).'"';}$output_feature3.='>'.htmlspecialchars_decode($feature3).'</li>';
      }
      $output_feature3 .= '</ul>';
      $content3 = $output_feature3;			  
	$output='<div class="container">			
			<div class="mx-auto mx-width-970">
				<div class="infomation-box-2 background-cover" ';if($bgimage[0]){$output.='style="background-image:url('.esc_url($bgimage[0]).')"';}$output.='>
					<div class="overlay">
						<div class="d-sm-flex">
						';if($info_box_icon){$output.='
							<div class="flex-auto">
								<div class="icon coin-icon background-primary" ';if($info_box_icon_bg_color){$output.='style="background-color:'.esc_attr($info_box_icon_bg_color).'"';}$output.='>
									<i class="'.esc_attr($info_box_icon).'" ';if($info_box_icon_color){$output.='style="color:'.esc_attr($info_box_icon_color).'"';}$output.='></i>
								</div>
							</div>
						';}$output.='
							<div class="flex-fill box-content">
							';if($info_box_title){ $output.='
								<h2 class="title-text" ';if($info_box_title_color){$output.='style="color:'.esc_attr($info_box_title_color).'"';}$output.='>'.esc_attr($info_box_title).'</h2>
							'; } $output.='
							';if($info_box_desc){$output.='	
								<p ';if($info_box_desc_color){$output.='style="color:'.esc_attr($info_box_desc_color).'"';}$output.='>
									'.$info_box_desc.'
								</p>
							';}$output.='	
								<ul class="no-style pl-0">
							';if($info_box_teacher_name){$output.='
									<li ';if($info_box_text_color){$output.='style="color:'.esc_attr($info_box_text_color).'"';}$output.='><span class="mr-2" ';if($info_box_label_color){$output.='style="color:'.esc_attr($info_box_label_color).'"';}$output.='>'.esc_html__('Teacher:','ronby').'</span> '.esc_attr($info_box_teacher_name).'</li>
							';}$output.='
							';if($info_box_time){$output.='	
									<li ';if($info_box_text_color){$output.='style="color:'.esc_attr($info_box_text_color).'"';}$output.='><span class="mr-2" ';if($info_box_label_color){$output.='style="color:'.esc_attr($info_box_label_color).'"';}$output.='>'.esc_html__('Timing:','ronby').'</span> '.esc_attr($info_box_time).'</li>
							';}$output.='	
							';if($info_box_tags){$output.='	
									<li ';if($info_box_text_color){$output.='style="color:'.esc_attr($info_box_text_color).'"';}$output.='><span class="mr-2" ';if($info_box_label_color){$output.='style="color:'.esc_attr($info_box_label_color).'"';}$output.='>'.esc_html__('Tags:','ronby').'</span> '.esc_attr($info_box_tags).'</li>
							';}$output.='		
								</ul>
							</div>
						</div>
					</div>				
				</div>
			</div>

			<div class="mx-auto mx-width-830">
				<div class="text-content-area mb-6">
				';if($desc1){$output.='	
					<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
						'.$desc1.'
					</div>
				';}$output.='	
				
					<div class="row">
						';if($content1){$output.='
							<div class="col-md-4">
								'.$content1.'
							</div>
						';}$output.='
						';if($content2){$output.='
							<div class="col-md-4">
								'.$content2.'
							</div>
						';}$output.='
						
						';if($content3){$output.='
							<div class="col-md-4">
								'.$content3.'
							</div>
						';}$output.='

					</div>
					';if($desc2){$output.='	
						<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
							'.$desc2.'
						</div>
					';}$output.='
				</div>
			</div>

			<div class="mx-auto mx-width-970">
			';if(function_exists('e_business_projects_social_share_meta')){$output.=e_business_projects_social_share_meta();}$output.='
		
			<div class="user-quote-1 d-sm-flex" ';if($p_box_bg){$output.='style="background-color:'.esc_attr($p_box_bg).'"';}$output.='>
						';if($get_p_img[0]){$output.='
							<div class="quote-thumb">
								<img src="'.esc_url($get_p_img[0]).'" alt="'.esc_attr__('Profile Image','ronby').'">
							</div>
						';}$output.='	
							<div class="quote-content flex-fill">
								<div class="item-header">
								';if($profile_name){$output.='
									<span class="name" ';if($p_box_name_c){$output.='style="color:'.esc_attr($p_box_name_c).'"';}$output.='>'.esc_attr($profile_name).'</span>
								';}$output.='	
								';if($profile_designation){$output.='
									<span class="description" ';if($p_box_designation_c){$output.='style="color:'.esc_attr($p_box_designation_c).'"';}$output.='>'.esc_attr($profile_designation).'</span>
								';}$output.='	
								</div>
								';if($profile_short_desc){$output.='
								<p class="quote-text" ';if($p_box_desc_c){$output.='style="color:'.esc_attr($p_box_desc_c).'"';}$output.='>
									'.$profile_short_desc.' 
								</p>
								';}$output.='
								<div class="item-social" ';if($p_box_social_c){$output.='style="color:'.esc_attr($p_box_social_c).'"';}$output.='>
									<span>'.esc_html__('Follow us:','ronby').'</span>
									<span class="sharing-icons">
									';if($profile_fb_url){$output.='
										<a class="no-color" href="'.esc_url($profile_fb_url).'"><i class="fab fa-facebook"></i></a>
									';}$output.='
									';if($profile_twitter_url){$output.='
										<a class="no-color" href="'.esc_url($profile_twitter_url).'"><i class="fab fa-twitter"></i></a>
									';}$output.='
									';if($profile_pinterest_url){$output.='
										<a class="no-color" href="'.esc_url($profile_pinterest_url).'"><i class="fab fa-pinterest-p"></i></a>
									';}$output.='	
									';if($profile_linkedin_url){$output.='
										<a class="no-color" href="'.esc_url($profile_linkedin_url).'"><i class="fab fa-linkedin-in"></i></a>
									';}$output.='	
									</span>
								</div>
							</div>
						</div>
			</div>			
		</div>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_business_service_details', 'ronby_business_service_details_shortcode');

/*****************************
Construction Single Image
******************************/
//Function for Construction Single Image
function ronby_construction_single_image_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'image' => '',
	'behind_img_bg' => '',
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<section class="p-30-0-30">
				<div class="image-box-1">
				';if($images[0]){$output.='
					<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'" >
				';}$output.='	
					<div class="behind-bg" ';if($behind_img_bg){$output.='style="background-color:'.esc_attr($behind_img_bg).'"';}$output.='></div>
				</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_single_image', 'ronby_construction_single_image_shortcode');

/*****************************
Construction Service Details
******************************/
//Function for Construction Service Details
function ronby_construction_service_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'headline' => '',
	'categories' => '',
	'icon_name' => '',
	'bg_image' => '',
	'desc1' => '',
	'heading1' => '',
	'heading2' => '',
	'heading3' => '',
	'features1' => '',
	'desc2' => '',
	'features_color' => '',
	'desc_color' => '',
	'heading_color' => '',
	'icon_color' => '',
	'categories_color' => '',
	'title_box_bg' => '',
	'title1_color' => '',
	'title2_color' => '',
	'title3_color' => '',
	'social_share_switch' => '',
	'social_share_bg' => '',
	'social_share_text_color' => '',
	), $atts ) );
	$image_ids = explode(',',$bg_image);
	foreach( $image_ids as $image_id ){
	$images = wp_get_attachment_image_src( $image_id, 'bg_image' );
	}	
	$features1 = !empty($features1) ? explode("\n", trim($features1)) : array(); 
  $c1=-1;
  $output_feature1='<ul class="list-style-3 pl-0">'; 
  foreach($features1 as $feature1) {
  $feature1 = strip_tags($feature1);
  $c1++;				
  $output_feature1 .='<li ';if($features_color){$output_feature1.='style="color:'.esc_attr($features_color).'"';}$output_feature1.='>'.htmlspecialchars_decode($feature1).'</li>';
  }
  $output_feature1 .= '</ul>';
  $content1 = $output_feature1;		
	$output='<section class="service-detail-1">
				<div class="service-detail-header">
				';if($images[0]){$output.='
					<div class="thumbnail">
						<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
					</div>
				';}$output.='	
					<div class="title-box" ';if($title_box_bg){$output.='style="background-color:'.esc_attr($title_box_bg).'"';}$output.='>
					';if($icon_name){$output.='
						<div class="icon color-primary" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='>
							<i class="'.esc_attr($icon_name).'"></i>
						</div>
					';}$output.='	
					';if($categories){$output.='
						<h4 class="post-taxonomies" ';if($categories_color){$output.='style="color:'.esc_attr($categories_color).'"';}$output.='>'.esc_attr($categories).'</h4>
					';}$output.='	
					';if($headline){$output.='
						<h2 class="post-title" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($headline).'</h2>
					';}$output.='	
					</div>
				</div>
			</section>
			<section class="mx-auto mx-width-730 construction-service-detail-2">
			';if($desc1){$output.='
				<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
					'.$desc1.'
				</div>
			';}$output.='
			';if($heading1 || $heading2){$output.='			
				<h2 ';if($title1_color){$output.='style="color:'.esc_attr($title1_color).'"';}$output.='>
					'.$heading1.' ';if($heading2){$output.='<span ';if($title2_color){$output.='style="color:'.esc_attr($title2_color).'"';}$output.='> '.$heading2.'</span>';}$output.='
				</h2>
			';}$output.='
			';if($heading3){$output.='
				<h4 ';if($title3_color){$output.='style="color:'.esc_attr($title3_color).'"';}$output.='>
					'.esc_attr($heading3).'
				</h4>
			';}$output.='	
			'.$content1.'
			';if($desc2){$output.='
				<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
					'.$desc2.' 
				</div>
			';}$output.='	
			</section>';
			$output.='<div class="construction-service-social-share-wrapper" ';if($social_share_bg || $social_share_text_color){$output.='style="';if($social_share_bg){$output.='background-color:'.esc_attr($social_share_bg).';';}if($social_share_text_color){$output.='color:'.esc_attr($social_share_text_color).'';}$output.='"';}$output.='>';
			if($social_share_switch=='yes'){$output.='	
			';if(function_exists('e_construction_social_share_meta')){
				$output.=e_construction_social_share_meta();
			}}	
			$output.='</div>';	
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_service_details', 'ronby_construction_service_details_shortcode');

/*****************************
Construction Team Details
******************************/
//Function for Construction Team Details
function ronby_construction_team_details_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'image' => '',
	'btn_label' => '',
	'btn_url' => '',
	'designation' => '',
	'name' => '',
	'experience' => '',
	'fb_url' => '',
	'twitter_url' => '',
	'linkedin_url' => '',
	'desc' => '',
	'progress_heading' => '',
	'number_of_progress_bar' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'designation_color' => '',	
	'name_color' => '',	
	'experience_color' => '',	
	'desc_color' => '',	
	'progress_heading_color' => '',	
	'progress_title_color' => '',	
	'content_bg' => '',	
	), $atts ) );
	$image_ids = explode(',',$image);
	foreach( $image_ids as $image_id ){
	$images = wp_get_attachment_image_src( $image_id, 'image' );
	}	
	$output='<div class="team-detail-1">
							<div class="row no-gutters">
								<div class="col-md-5 col-thumbnail">
								';if($images[0]){$output.='
									<div class="thumbnail">
										<img src="'.esc_url($images[0]).'" alt="'.esc_attr__('featured-image','ronby').'">
									</div>
								';}$output.='	
									<div class="text-center">
									';if($btn_label){$output.='
										<a href="'.esc_url($btn_url).'" class="button button-primary" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>
											'.esc_attr($btn_label).'
										</a>
									';}$output.='	
									</div>
								</div>
<div class="col-md-7 col-content">
	<div class="detail-content" ';if($content_bg){$output.='style="background-color:'.esc_attr($content_bg).'"';}$output.='>
	<div class="box-header">
		<div class="row align-items-center">
			<div class="col-sm-7">
			';if($designation){$output.='
				<div class="role color-primary" ';if($designation_color){$output.='style="color:'.esc_attr($designation_color).'"';}$output.='>'.esc_attr($designation).'</div>
			';}$output.='
			';if($name){$output.='			
				<h2 class="name" ';if($name_color){$output.='style="color:'.esc_attr($name_color).'"';}$output.='>'.esc_attr($name).'</h2>
			';}$output.='
			';if($experience){$output.='	
				<div class="description color-primary" ';if($experience_color){$output.='style="color:'.esc_attr($experience_color).'"';}$output.='>'.esc_attr($experience).'</div>
			';}$output.='	
			</div>
			<div class="col-sm-5">
				<div class="py-3">
					<div class="social-5 text-center">
						<ul class="no-style items-inline-block">
						';if($fb_url){$output.='
							<li class="hover-color-primary animate-300">
								<a href="'.esc_url($fb_url).'" class="no-color">
									<i class="fab fa-facebook"></i>
								</a>
							</li>
						';}$output.='	
						';if($twitter_url){$output.='
							<li class="hover-color-primary animate-300">
								<a href="'.esc_url($twitter_url).'" class="no-color">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
						';}$output.='	
						';if($linkedin_url){$output.='
							<li class="hover-color-primary animate-300">
								<a href="'.esc_url($linkedin_url).'" class="no-color">
									<i class="fab fa-linkedin-in"></i>
								</a>
							</li>
						';}$output.='	
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
										<div class="box-content">
										';if($desc){$output.='
											<div ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
												'.$desc.'
											</div>
										';}$output.='	
										</div>
										<div class="box-progress">
										';if($progress_heading){$output.='
											<h3 class="box-title" ';if($progress_heading_color){$output.='style="color:'.esc_attr($progress_heading_color).'"';}$output.='>'.esc_attr($progress_heading).'</h3>
										';}$output.='
						';
						$i=1;
						$c=0;
						while ($i<=$number_of_progress_bar){
						$c++;
						$b = shortcode_atts(array(
							'p_percent'.$c.'' => '',
							'p_title'.$c.'' => '',
							'p_bg_color'.$c.'' => '',
						),$atts);
						$p_percent =$b['p_percent'.$c.''];
						$p_title =$b['p_title'.$c.''];
						$p_bg_color =$b['p_bg_color'.$c.''];

						$output .='										
											<div class="ronby-progress progress-danger mb-4" >
												<div class="ronby-progress-text">
												';if($p_title){$output.='
													<div class="ronby-progress-lb" ';if($progress_title_color){$output.='style="color:'.esc_attr($progress_title_color).'"';}$output.='>'.esc_attr($p_title).'</div>
												';}$output.='
												';if($p_percent){$output.='
													<div class="ronby-progress-value" >'.esc_attr($p_percent).'</div>
												';}$output.='	
												</div>
												<div class="ronby-progress-bar">
													<div class="ronby-progress-current"  ';if($p_percent || $p_bg_color){$output.='style="';if($p_percent){$output.='width: '.esc_attr($p_percent).';';}if($p_bg_color){$output.='background-color: '.esc_attr($p_bg_color).';';}$output.='"';}$output.='></div>
												</div>
											</div>
						';
						$i++;
						}
						$output .='

										</div>
									</div>
								</div>
							</div>
						</div>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_construction_team_details', 'ronby_construction_team_details_shortcode');

/*****************************
Fashion Header Section
******************************/
//Function for Fashion Header Section
function ronby_fashion_header_section_shortcode( $atts ) {
	extract( shortcode_atts( array(
	'heading_color' => '',
	'desc_color' => '',
	'icon_color' => '',
	'number_of_feature_box' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'margin_top' => '',
	'bg_img' => '',
	'f_heading1' => '',
	'f_heading2' => '',
	'f_heading3' => '',
	'btn_label' => '',
	'btn_url' => '',
	'f_heading1_color' => '',
	'f_heading2_color' => '',
	'f_heading3_color' => '',
	'btn_text_color' => '',
	'btn_bg_color' => '',	
	'part_1_bg_start' => '',	
	'part_1_bg_end' => '',	
	'part_2_bg' => '',	
	'part1_height' => '',	
	), $atts ) );
	$image_ids = explode(',',$bg_img);
	foreach( $image_ids as $image_id ){
	$images = wp_get_attachment_image_src( $image_id, 'bg_img' );
	}		
	$output='<section class="policies fashion-header-section">

	<div class="bg_img" ';if($images[0] || $part1_height){$output.='style="';if($images[0]){$output.='background-image:url('.esc_url($images[0]).');';}if($part1_height){$output.='height:'.esc_attr($part1_height).';';}$output.='"';}$output.='>
	<div class="overlay" ';if($part_1_bg_start && $part_1_bg_end){$output.='style="background-image: linear-gradient(to top, '.esc_attr($part_1_bg_start).' 5%,'.esc_attr($part_1_bg_start).' 5%, '.esc_attr($part_1_bg_end).');"';}$output.='>	
	<div class="container">
	<div class="row">
	<div class="col-md-6 offset-md-3 color-white pt-224">
	';if($f_heading1){$output.='
	<h6 class="mb-4" ';if($f_heading1_color){$output.='style="color:'.esc_attr($f_heading1_color).'"';}$output.='>'.esc_attr($f_heading1).'</h6>
	';}$output.='
	';if($f_heading2){$output.='
	<h1 class="mb-4" ';if($f_heading2_color){$output.='style="color:'.esc_attr($f_heading2_color).'"';}$output.='>'.$f_heading2.'</h1>
	';}$output.='
	';if($f_heading3){$output.='
	<h5 class="mb-4" ';if($f_heading3_color){$output.='style="color:'.esc_attr($f_heading3_color).'"';}$output.='>'.esc_attr($f_heading3).'</h5>
	';}$output.='
	';if($btn_label){$output.='
	<a class="button rounded-capsule button-primary" href="'.esc_url($btn_url).'" ';if($btn_text_color || $btn_bg_color){$output.='style="';if($btn_text_color){$output.='color:'.esc_attr($btn_text_color).'';}$output.=';';if($btn_bg_color){$output.='background-color:'.esc_attr($btn_bg_color).'';}$output.='"';}$output.='>'.esc_attr($btn_label).'</a>
	';}$output.='
	</div>
	</div>
	</div>
	</div>
	</div>
	<!-- Part-2 -->
	<div ';if($part_2_bg){$output.='style="background-color:'.esc_attr($part_2_bg).'"';}$output.='>
	<div class="container" ';if( $padding_top || $padding_bottom || $margin_top){$output.='style="';if($padding_top){$output.='padding-top:'.esc_attr($padding_top).';';}if($padding_bottom){$output.='padding-bottom:'.esc_attr($padding_bottom).';';}if($margin_top){$output.='top:'.esc_attr($margin_top).';';}$output.='"';}$output.='>
	<div class="row">';  
	$i=1;
	$c=0;
	while ($i<=$number_of_feature_box){
	$c++;
	$b = shortcode_atts(array(
		'icon'.$c.'' => '',
		'heading'.$c.'' => '',
		'desc'.$c.'' => '',
    ),$atts);
	$icon =$b['icon'.$c.''];
	$heading =$b['heading'.$c.''];
	$desc =$b['desc'.$c.''];

	$output .='<div class="col-md-6 col-xl-3">	
			<div class="article-with-icon-3 text-center">
				';if($icon){$output.='
				<div class="icon color-primary">
					<i class="'.esc_attr($icon).'" ';if($icon_color){$output.='style="color:'.esc_attr($icon_color).'"';}$output.='></i>
				</div>
				';}$output.='
				';if($heading){$output.='
				<h3 class="item-title" ';if($heading_color){$output.='style="color:'.esc_attr($heading_color).'"';}$output.='>'.esc_attr($heading).'</h3>
				';}$output.='
				';if($desc){$output.='
				<div class="item-text" ';if($desc_color){$output.='style="color:'.esc_attr($desc_color).'"';}$output.='>
					'.esc_attr($desc).'
				</div>
				';}$output.='
			</div>
			</div>
	';$i++;}$output.='	
			</div>
			</div>
			</div>
			</section>';
		
	return $output;
}
add_shortcode('ronby_shortcode_for_fashion_header_section', 'ronby_fashion_header_section_shortcode');

/*END FROM HERE ELEMENTS FUNCTIONS*/
if(class_exists('WPBakeryVisualComposerAbstract')) {
	include_once('vc_shortcodes.php');
}