<?php
// VC_row customization

vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "heading" => esc_html__("Want to have top padding?",'ronby'),
   "param_name" => "top_padding",
   "value" => "",
   "description" => esc_html__("Input top padding in pixel (i.e 50px).", "ronby"),
));

vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "heading" => esc_html__("Want to have bottom padding?",'ronby'),
   "param_name" => "bottom_padding",
   "value" => "",
   "description" => esc_html__("Input bottom padding in pixel (i.e 50px).", "ronby"),
));

vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "heading" => esc_html__("Want to have left padding?",'ronby'),
   "param_name" => "zleft_padding",
   "value" => "",
   "description" => esc_html__("Input left padding in pixel (i.e 50px).", "ronby"),
));

vc_add_param("vc_row", array(
   "type" => "textfield",
   "class" => "",
   "heading" => esc_html__("Want to have right padding?",'ronby'),
   "param_name" => "zright_padding",
   "value" => "",
   "description" => esc_html__("Input right padding in pixel (i.e 50px).", "ronby"),
));

// VC_column_text customization

vc_add_param("vc_column_text", array(
   "type" => "colorpicker",
   "class" => "",
   "heading" => esc_html__("Play text color", "ronby"),
   "param_name" => "txt_color",
   "value" => "",
   "description" => '',
));



