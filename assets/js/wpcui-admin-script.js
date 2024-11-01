jQuery(document).ready(function(){

jQuery(".nav-tab").on("click",function(e){
	// e.preventDefault();
	jQuery(".nav-tab").removeClass("nav-tab-active");
	jQuery(this).addClass("nav-tab-active");
	
	//Hide all sections of settings
	jQuery(".wpcui_struct_settings_wrap").hide();
	jQuery(".wpcui_design_settings_wrap").hide();
	jQuery(".wpcui_extra_settings_wrap").hide();

	jQuery(".nav-tab").each(function(){
		if (jQuery(this).hasClass('nav-tab-active')) {
			if(jQuery(this).attr('id') == 'wpcui_content_nav_tab'){
				jQuery(".wpcui_struct_settings_wrap").show();
			}
			if(jQuery(this).attr('id') == 'wpcui_design_nav_tab'){
				jQuery(".wpcui_design_settings_wrap").show();
			}
			if (jQuery(this).attr('id') == 'wpcui_extra_nav_tab') {
				jQuery(".wpcui_extra_settings_wrap").show();
			}
		}
	});
});






// Adding select option
jQuery('select').niceSelect();




//Used by the wp_color_picker
(function( $ ) {
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.color-field').wpColorPicker();
    });
})( jQuery );








// Validation starts here

var error1 = false;
var error2 = false;

jQuery(".wpcui_title_field input[type='text']").on("change keyup",function(){
	if (jQuery(this).val().length !=0) {
		jQuery(this).parent().children("span").remove();
		error1 = false;
	}
});

jQuery(".wpcui_struct_settings_field textarea#wpcui_wp_editor_in_settings").on("change keyup",function(){
	if (jQuery(this).val().length !=0) {
		jQuery(this).parent().children("span").remove();
		error2 = false;
	}
});

jQuery("#manageForm").on("submit",function(event){
	
	var text_val = jQuery(".wpcui_title_field input[type='text']").val().trim();
	var textarea_val = jQuery(".wpcui_struct_settings_field textarea#wpcui_wp_editor_in_settings").val().trim();

	if (text_val.length == 0) {
		jQuery(".wpcui_title_field input[type='text']").parent().children("span").remove();
		jQuery(".wpcui_title_field input[type='text']").parent().append("<span style='color:red;'>This field should not be left empty</span>");
		error1 = true;
	}
	if (textarea_val.length == 0) {
		jQuery(".wpcui_struct_settings_field textarea#wpcui_wp_editor_in_settings").parent().children("span").remove();
		jQuery(".wpcui_struct_settings_field textarea#wpcui_wp_editor_in_settings").parent().append("<span style='color:red;'>This field should not be left empty</span>");
		error2 = true;
	}

	// alert(error1);
	// alert(error2);
	// alert(error1 || error2);

	if (error1 || error2) {
		event.preventDefault();
	}
	else{
		return;
	}
});




var error3 = false;

jQuery(".wpcui_custom_template_name").on("change keyup",function(){
	if (jQuery(this).val().length != 0 ) {
		jQuery(this).parent().children("span").remove();
		error3 = false;
	}
});

jQuery(".wpcui_custom_template_form").on("submit",function(event){
	var custom_name = jQuery(".wpcui_custom_template_name").val().trim();
	if (custom_name.length == 0) {
		jQuery(".wpcui_custom_template_name").parent().children("span").remove();
		jQuery(".wpcui_custom_template_name").parent().append("<span style='color:red;'>This field should not be left empty</span>");
		error3 = true;
	}
	if (error3) {
		event.preventDefault();
	}
	else{
		return;
	}
});

// Validation ends here








//Show and hide on checked and unchecked
jQuery(".wpcui-bulb-switch").on("change",function(){

	if (jQuery(this).attr('checked') == 'checked') {
		// alert('checked');
		jQuery(this).parent().parent().parent().children(".wpcui-bulb-light").show();
	}
	else{
		// alert('unchecked');
		jQuery(this).parent().parent().parent().children(".wpcui-bulb-light").hide();
	}
});
jQuery(".wpcui-bulb-switch").trigger("change");





//Show or hide on specific value in select option
jQuery(".wpcui-show-after-selector").on("change",function(){
	if (jQuery(".wpcui-show-after-selector option:selected").val() == 'show After') {
		jQuery(this).parent().parent().children(".wpcui-show-after-options").show();
	}
	else{
		jQuery(this).parent().parent().children(".wpcui-show-after-options").hide();
	}
});
jQuery(".wpcui-show-after-selector").trigger("change");





// Image preview of built in templates
jQuery(".wpcui-template-bar-image-selector").on("change",function(){
	// var filename = jQuery(this).val().toLowerCase().replace(/\s/g,'');
	var img_link = jQuery(this).find('option:selected').data('img');
	jQuery("img.wpcui-template-bar-image-container").attr('src',img_link);
});
jQuery(".wpcui-template-bar-image-selector").trigger("change");





// Default and custom template option in layout options
jQuery("#wpcui_select_template_type").on("change",function(){
	var template_select = jQuery(this).val();
	if (template_select == 'default') {
		jQuery('.wpcui_select_custom_template_section').hide();
	}
	else if(template_select == 'custom'){
		jQuery('.wpcui_select_custom_template_section').show();
	}
});
jQuery("#wpcui_select_template_type").trigger("change");





/*Start of Live preview*/

// color picker live preview for text color
    var myOptions = {
        palettes: true,
        change: function (event, ui) {
            jQuery('#wpcui_custom_template_font').css('color', ui.color.toString());
        },
    };

    var myOptions1 = {
        palettes: true,
        change: function (event, ui) {
            jQuery('#wpcui_custom_template_preview_wrap').css('background', ui.color.toString());
        },
    };
      
// Backend custom template preview
jQuery(".wpcui_custom_template_preview_selector").on("change",function(){
	var wpcui_font_size = jQuery("#wpcui_preview_font_size option:selected").text();
	var font_value = jQuery("#wpcui_preview_font_family").val();
	var wpcui_font_color = jQuery("#wpcui_preview_font_color").val();
	var wpcui_bg_color = jQuery("#wpcui_preview_bg_color").val();


	   

	jQuery("#wpcui_custom_template_font").css({
		'font-size' : wpcui_font_size + 'px',
        'font-family': font_value,
        'color':wpcui_font_color,
    });

    jQuery("#wpcui_custom_template_preview_wrap").css({
    	'background': wpcui_bg_color
    });
    
    if (font_value != "default" && font_value != '') {
                WebFont.load({
                    google: {
                        families: [font_value]
                    }
                });
            }
    
});
jQuery(".wpcui_custom_template_preview_selector").trigger("change");

// Implementing Font Color
	jQuery('#wpcui_preview_font_color').wpColorPicker(myOptions);
	jQuery("#wpcui_preview_bg_color").wpColorPicker(myOptions1);

/*End of Live preview*/






// Color tabs in the Custom Template
jQuery(".wpcui_color_tab_selector").on("click",function(){
	jQuery(".wpcui_color_tab_selector").removeClass("wpcui_active_color_tab");
	jQuery(this).addClass("wpcui_active_color_tab");

	var selectedTab = jQuery(this).attr('id');
	// alert("#" + selectedTab + "_tab");
	jQuery(".wpcui_color_customizations").hide();
	jQuery("#" + selectedTab + "_tab").show();
});




// // Enable and Disable labels
// jQuery(".wpcui_check_status").on("change",function(){
// 	var selector = jQuery(this).attr('id');
// 	var status;
// 	var target;
// 	if (jQuery(this).attr('checked') == 'checked') {
// 		status = "_enable";
// 	}
// 	else{
// 		status = "_disable";
// 	}
// 	target = "#"+selector+status;
// 	jQuery("#"+selector+"_enable").hide();
// 	jQuery("#"+selector+"_disable").hide();
// 	jQuery(target).show();
// });
// jQuery(".wpcui_check_status").trigger("change");



});