	$(".js-height-full").height($(window).height());
	$(".js-height-parent").each(function() {
	    $(this).height($(this).parent().first().height());
	});


	// Fun Facts
	function count($this) {
	    var current = parseInt($this.html(), 10);
	    current = current + 1; /* Where 50 is increment */

	    $this.html(++current);
	    if (current > $this.data('count')) {
	        $this.html($this.data('count'));
	    } else {
	        setTimeout(function() {
	            count($this)
	        }, 50);
	    }
	}

	$(".stat-timer").each(function() {
	    $(this).data('count', parseInt($(this).html(), 10));
	    $(this).html('0');
	    count($(this));
	});


$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) { // Cambiar el valor 100 según sea necesario
        $('.header').addClass('fixed-header');
    } else {
        $('.header').removeClass('fixed-header');
    }
});


	$(window).load(function() {
	    $("#preloader").on(500).fadeOut();
	    $(".preloader").on(600).fadeOut("slow");
	});