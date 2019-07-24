var ronbyForms, ronbySetupForms;
jQuery(document).ready(function($){
    ronbyForms = function(){
        $('body').on('change', '.ronby-post-types', function(){
            var $parent = $(this).closest('.ronby-form'),
                $postTypesWrap = $parent.find('.post-types-wrap'),
                $taxonomiesWrap = $parent.find('.taxonomies-wrap'),
                $termsWrap = $parent.find('.terms-wrap'),
                $loading = $postTypesWrap.find('.loading'),
                postType = $(this).val(),
                data = {
                    action: 'ronby_post_type_selected',
                    postType: postType,
                    ronbyNonce: ronbyAjax.ronbyNonce
                };
            if (postType) {

                $loading.css('display', 'block');
                $.post(ajaxurl, data, function(response) {
                    $taxonomiesWrap.find('.ronby-taxonomies').empty().html(response);
                    $taxonomiesWrap.show();
                    $termsWrap.hide();
                    $loading.css('display', 'none');
                });        
            } else {
                $taxonomiesWrap.hide();
                $termsWrap.hide();
            }
        });
        $('body').on('change', '.ronby-taxonomies', function(){
            var $parent = $(this).closest('.ronby-form'),
                $termsWrap = $parent.find('.terms-wrap'),
                $taxonomiesWrap = $parent.find('.taxonomies-wrap'),
                taxonomy = $(this).val(),
                $loading = $taxonomiesWrap.find('.loading'),
                data = {
                    action: 'ronby_taxonomy_selected',
                    taxonomy: taxonomy,
                    ronbyNonce: ronbyAjax.ronbyNonce
                };
            if (taxonomy) {
                $loading.css('display', 'block');
                console.log($loading.html());
                $termsWrap.hide();
                $.post(ajaxurl, data, function(response) {
                    $parent.find('.terms').empty().html(response);
                    $termsWrap.show();
                    $loading.css('display', 'none');
                    $termsWrap.show();
                });   
            } else {
                $termsWrap.hide();
            }

        });
    };
    ronbySetupForms = function(){
        $('.ronby-form').each(function(){
            var $postTypesWrap = $(this).find('.post-types-wrap'),
                $taxonomiesWrap = $(this).find('.taxonomies-wrap'),
                $termsWrap = $(this).find('.terms-wrap'),
                $postTypes = $postTypesWrap.find('.ronby-post-types'),
                $taxonomies = $taxonomiesWrap.find('.ronby-taxonomies'),
                $terms = $termsWrap.find('.terms');
            if ($postTypes.val()){
                $taxonomiesWrap.show();
            } else {
                $taxonomiesWrap.hide();
            }
            if ($taxonomies.val()){
                $termsWrap.show();
            } else {
                $termsWrap.hide();
            }            
        });
    };
    ronbyForms();
    ronbySetupForms();
});