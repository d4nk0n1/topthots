jQuery(document).ready(function() {
    jQuery('input[name="target_mode"]').click(function () {       
        var target_mode = jQuery(this).val();
        
        if (target_mode == 'selected_target') {            
            jQuery('select[name="target_id"]').show();
        }
        else {            
            jQuery('select[name="target_id"]').hide();
        }
    });

    if (0 < jQuery('a#link-to-target').length)
    {
        var target_name = '';
        jQuery('select#selected_target option').each(function() {
        	var val = decodeURIComponent(jQuery(this).val());
        	if (jQuery('a#link-to-target').text() == val)
        	{
        		target_name = jQuery(this).text();

        	}
        });
        if ('' != target_name)
        {
        	jQuery('a#link-to-target').text(target_name);
        }
    }
    
    jQuery('#affil4you-form').on('submit', function() {
        var bReturn =true;
        jQuery('#affil4you-key').parent().parent().removeClass('form-required form-invalid');
        jQuery('#affil4you-tracker').parent().parent().removeClass('form-required form-invalid');
        
        var zAffil4youTracker = jQuery('.affil4you-tracker').val() ;
        oRegExp = new RegExp("^[a-zA-Z0-9\-\_\.\,]+$");
        var isValid = oRegExp.test(zAffil4youTracker);
        if(!isValid && zAffil4youTracker!='') {                
            jQuery('#affil4you-tracker').parent().parent().addClass('form-required form-invalid');
            var zDescription = "Vous pouvez indiquer ici un tracker pour différencier vos différentes sources de trafic amenant vers une même cible. <span style=\" color:red;\">Format : A-Z-a-z-0-9« _ » « - »« . » « , ». Pas de caractères spéciaux.<span>.";
            jQuery('#affil4you-tracker').parent().parent().find('p').html(zDescription);
            jQuery('#affil4you-tracker').val('');
            bReturn =false;         
        }
        return  bReturn;
    }); 
	
	jQuery('#affil4you-form-advanced').on('submit', function() {
        var bReturn =true;
        jQuery('.affil4you-tracker-advanced').each(
			function(){
			var zAffil4youTracker = jQuery(this).val() ;
				oRegExp = new RegExp("^[a-zA-Z0-9\-\_\.\,]+$");
				var isValid = oRegExp.test(zAffil4youTracker);
				if(!isValid && zAffil4youTracker!='') {           
					jQuery(this).parent().parent().addClass('form-required form-invalid');
					jQuery(this).val('');
					bReturn =false;         
				}
			
			}
		);
        
        return  bReturn;
    });

	jQuery('input[name="traffic_redirect"]').click(function(){
		var traffic_redirect = jQuery(this).val();
		if(traffic_redirect == "all_traffic_banner") {
			jQuery('#traffic-adult').show();
			jQuery('#banner-notice').css('visibility', 'visible');
		} else { 
			jQuery('#traffic-adult').hide();
			jQuery('#banner-notice').css('visibility', 'hidden');
			jQuery('input[name="traffic_accept_adult"]').val('yes');
		}
	});
	//afficher&cacher les reglages avancés
	jQuery('#button_advanced_settings').click(function(){
		var div_to_hide_show = jQuery('#advanced_settings');
		if ( div_to_hide_show.css('display') == 'none') {
			div_to_hide_show.show();
			jQuery('#advanced_collapse').text('-');
		} else { 
			div_to_hide_show.hide();
			jQuery('#advanced_collapse').text('+');
		}
		return false;
	});	
	//ajax pour le niche
	jQuery('.affil4you_categories_target_id').change(function(){
		var cat = this.name.replace('affil4you_categories_target_id[','').replace(']','');
		var target_id = this.value;
		jQuery('select[name="affil4you_categories_target_domain['+cat+']"] option:selected, select[name="affil4you_categories_target_display_name['+cat+']"] option:selected').removeAttr('selected');
		jQuery('select[name="affil4you_categories_target_domain['+cat+']"] option:contains("'+target_id+'"), select[name="affil4you_categories_target_display_name['+cat+']"] option:contains("'+target_id+'")').attr('selected', 'selected');
		var data = {
			action: 'check_niche',
			target_id: target_id
		};
		jQuery('#load-niche-'+cat).show();
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		var current_niches = jQuery('select[name="affil4you_categories_niche['+cat+']"]');
		if( target_id == '')
		{
			current_niches.attr('disabled','disabled');
			jQuery('#load-niche-'+cat).hide();
		}
		else
		{
		jQuery.post(ajaxurl, data, function(response) {		
				if (!response) {
					current_niches.attr('disabled','disabled');
					jQuery('#load-niche-'+cat).hide();
				} else {
					current_niches.removeAttr('disabled');
					jQuery.post( ajaxurl,
							{ action: "get_niches_list", target_id: response.target_id},
							function(data) {
								current_niches.html(data);
							});
					jQuery('#load-niche-'+cat).hide();
				}
			},'json');
		}
	});
});
