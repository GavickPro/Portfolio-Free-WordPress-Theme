(function($) {
	$(window).load(function() {
	    $('.gk-portfolio-category-selection-checkbox').each(function(i, checkbox) {
	        checkbox = $(checkbox);
	 
	        checkbox.on('change', function(e) {
	            e.stopPropagation();
	            var id = $(this).attr('data-id');
	            var category_id = $(this).attr('data-category-id');
	 
	            if(checkbox.prop('checked') == true ) {
	                add_checked_category(category_id, id);
	            } else {
	                remove_checked_category(category_id, id);
	            }
	        });
	    });
	});
	
	function add_checked_category(category, control) {
	    var value = wp.customize.instance(control).get().split(',');
	    value = value.filter(Number);
	 
	    if(value.indexOf(category) === -1) {
	        value.push(category);
	        wp.customize.instance(control).set(value.join());
	    }
	}
	
	function remove_checked_category(category, control) {
	    var value = wp.customize.instance(control).get();
	    value = value.split(',');
	    var category_index = value.indexOf(category);
	 
	    if(category_index >= 0) {
	        value.splice(category_index, 1);
	        value = value.join();
	        wp.customize.instance(control).set( value);
	    }
	}
})(jQuery);