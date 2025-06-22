(function($) {
    "use strict";

		/* ----------------------------------------------------------- */
		/*  Back to top
		/* ----------------------------------------------------------- */

		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				 $('.backto').fadeIn();
			} else {
				 $('.backto').fadeOut();
			}
		});

		jQuery('.mainmenu ul.theme-main-menu').slicknav({
            allowParentLinks: true,
			prependTo: '.minerva-responsive-menu',
			closedSymbol: "&#8594",
			openedSymbol: "&#8595",
        });


		// scroll body to 0px on click
		$('.backto').on('click', function () {
			 $('.backto').tooltip('hide');
			 $('body,html').animate({
				  scrollTop: 0
			 }, 800);
			 return false;
		});
		
		$('.lv-header-bar-1 .panel-bar-box, .lv-header-bar-2 a').on('click', function() {
			$('.overlay').addClass('visible-overlay');
			$('.minerva-custom-panel-menu-wrapper').addClass('header-sidebar-visible');
		});
		
		$('.minerva-custom-panel-box-effect .minerva-custom-panel-close, .overlay').on('click', function() {
			$('.overlay').removeClass('visible-overlay');
			$('.minerva-custom-panel-menu-wrapper').removeClass('header-sidebar-visible');
		});
	

		/*--------------------------------------------
            Search Popup
        ---------------------------------------------*/
        var bodyOvrelay =  $('#body-overlay');
        var searchPopup = $('#search-popup');

        $(document).on('click','#body-overlay',function(e){
            e.preventDefault();
        bodyOvrelay.removeClass('active');
            searchPopup.removeClass('active');
        });
        $(document).on('click','.search-box-btn',function(e){
            e.preventDefault();
            searchPopup.addClass('active');
        bodyOvrelay.addClass('active');
        });	
		 
	
})(jQuery);