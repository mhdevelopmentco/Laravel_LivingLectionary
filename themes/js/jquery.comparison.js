(function ($) {
    $.fn.compare = function (options) {

		// setup the default options
        var defaults = {
            compareButton: '.compareButton'
        };
        
        var options = $.extend(defaults, options);
        var itemsarray = []; // array for storing selected items

       // if the compare button is clicked add the items to the
       // modal window - opening the modal is triggered by the modal
       // plugin seperately
       $(options.compareButton).click(function(){

		   // if the button has the class active we have items to compare
	       	if($(this).hasClass('active')){

	       		$('.modal-products').empty(); // clear the modal
	       		$('.no-products').hide(); // hide the no products selected message

	       		var arrayLength = itemsarray.length;
	       		// loop through the array if products
				for (var i = 0; i < arrayLength; i++) {

					product = $('.product[data-id="'+itemsarray[i]+'"]');

					$('.modal-products').append('<div class="product"><img src="'+$(product).find('img').attr('src')+'"/><ul><li><span>'+$(product).data('title')+'</span></li><li><span>'+$(product).data('price')+'</span></li></ul></div>');

				}

			// else we haven't selected any products to compare yet
	       	}else{
	       		$('.modal-products').empty(); // clear the modal
	       		$('.no-products').show(); // show the no products selected message       	
	       	}

       });


	   // If an item is click for comparison run this code
	   //
	   $(this).find('button').click(function(){
		    // toggle the class selected on the product wrapper
	   		$(this).parent().toggleClass('selected');
	   		// get the product id
	   		productId = $(this).parent().data('id');
	   		// check if this product is already in the array
	   	    var inArray = $.inArray(productId, itemsarray);

	   	    if(inArray < 0){
		   		// add this product to the array
		   		itemsarray.push(productId);
		   	}else{
		   		// remove if from the array
		   		itemsarray.splice( $.inArray(productId,itemsarray) ,1 );
		   	}		   

		   	if(itemsarray.length > 1){
			   	// if there are items in the array (selected) add the class 'active'
			   	// to the 'compare' button
		   		$(options.compareButton).addClass('active');

		   	}else{
			   	// if there are no items in the array (selected)
			   	// remove the active class
		   		$(options.compareButton).removeClass('active');

		   	}
		   
	   });
	   
    };
})(jQuery);