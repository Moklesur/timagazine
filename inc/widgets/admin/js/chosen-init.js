( function( $ ) {
	$(document).on('panelsopen', function(e) {
		$(".featured-posts-dropdown").chosen({
			disable_search_threshold: 5,
			max_selected_options: 5
		});
		$(".chosen-dropdown-3").chosen({
			disable_search_threshold: 10,
			max_selected_options: 3
		});
		$(".category-posts-dropdown-a,.author-dropdown").chosen({
			disable_search_threshold: 10,
			max_selected_options: 1
		});

		$(".trending-posts-dropdown").chosen({
			disable_search_threshold: 10
		});

		$('.trending-posts-Sortable').chosenSortable();

		//accordion
		$('.accordion-fix .panel-title').click(function() {

			if( $(this).hasClass('active') ) {
				// close panel if active and clicked
				$(this).removeClass('active')
					.next().slideUp(200);
			}
			else {
				// close all active panels
				$('.active').removeClass('active')
					.next().slideUp(200);
				// open this clicked panel
				$(this).addClass('active')
					.next().slideDown(200);
			}
		});
	});
})( jQuery );