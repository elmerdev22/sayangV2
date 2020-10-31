// Set the date we're counting down to
var count_down_timer = function count_down_timer(date_time, element_container_id){
    // "Oct 24, 2020 01:30:00" (format)
    var countDownDate = new Date(date_time).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Output the result in an element with id="{id}"
        if(days > 0){
            document.getElementById(element_container_id).innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";
        }else{
            document.getElementById(element_container_id).innerHTML = hours + "h "
            + minutes + "m " + seconds + "s ";
        }
        
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById(element_container_id).innerHTML = "EXPIRED";
        }
    }, 1000);
}

var quantityField = function quantityField(dom_field, dom_minus, dom_plus, interval=1){
	$(document).on('click', dom_plus, function (){
		qtyPlus(dom_field, interval);
	});
	$(document).on('click', dom_minus, function (){
		qtyMinus(dom_field, interval);
	});
}

var qtyMinus = function qtyMinus(dom_field, interval=1){
    var value = $(dom_field).val();
        value = value.replace(',', '');

    if(value == ''){
		value = 0;
	}else{
        value = parseInt(value);
    }

	if(Number.isInteger(value)){
		if(value > 0){
            value = value - interval;

            if(typeof($(dom_field).attr('min')) != 'undefined' ) {
                var min = $(dom_field).attr('min');
                if(value >= min){
                    $(dom_field).val(value);
                }else{
                    $(dom_field).val(min);
                }
            }else{
                $(dom_field).val(value);
            }
		}
	}
}
var qtyPlus = function qtyPlus(dom_field, interval=1){
	var value = $(dom_field).val();
	    value = value.replace(',', '');
	
	if(value == ''){
		value = 0;
	}else{
        value = parseInt(value);
	}

	if(Number.isInteger(value)){
		if(value >= 0){
            value = value + interval;
            
            if(typeof($(dom_field).attr('max')) != 'undefined' ) {
                var max = $(dom_field).attr('max');
                if(value <= max){
                    $(dom_field).val(value);
                }else{
                    $(dom_field).val(max);
                }
            }else{
                $(dom_field).val(value);
            }
		}
	}
}

$('.img-preloader').each(function () {
    $(this).on('load', function () {
        $(this).next('.img-loader-span').hide();
    });    
});

$('input[type=number]').each(function () {
    $(this).on('keydown', function () {
        return event.keyCode == 69 ? false : true;
    });
});