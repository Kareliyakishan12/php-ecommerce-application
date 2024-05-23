$.noConflict();

jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	});

	jQuery('.selectpicker').selectpicker;


	

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	$('.equal-height').matchHeight({
		property: 'max-height'
	});

	// var chartsheight = $('.flotRealtime2').height();
	// $('.traffic-chart').css('height', chartsheight-122);


	// Counter Number
	$('.count').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 3000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});


	 
	 
	// Menu Trigger
	$('#menuToggle').on('click', function(event) {
		var windowWidth = $(window).width();   		 
		if (windowWidth<1010) { 
			$('body').removeClass('open'); 
			if (windowWidth<760){ 
				$('#left-panel').slideToggle(); 
			} else {
				$('#left-panel').toggleClass('open-menu');  
			} 
		} else {
			$('body').toggleClass('open');
			$('#left-panel').removeClass('open-menu');  
		} 
			 
	}); 

	 
	$(".menu-item-has-children.dropdown").each(function() {
		$(this).on('click', function() {
			var $temp_text = $(this).children('.dropdown-toggle').html();
			$(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>'); 
		});
	});


	// Load Resize 
	$(window).on("load resize", function(event) { 
		var windowWidth = $(window).width();  		 
		if (windowWidth<1010) {
			$('body').addClass('small-device'); 
		} else {
			$('body').removeClass('small-device');  
		} 
		
	});

	// dynamic add table in category_features.php 
	$("#category_table").change(function(e){
		var categoryId = $(this).val();
		$.ajax({
			url: "fetch_category_features.php",
			type: "GET",
			data: {category_id: categoryId},
			success:function(data){
				$("#category_features_table").html(data);
			}
		});
	})

	//dynamic change category_name in add_category_features.php
	$("#category_table").change(function(e){
		var categoryId = $(this).val();
		$.ajax({
			url: "fetch_category_features.php",
			type: "POST",
			data: {category_id: categoryId},
			success:function(data){
				$("#dynamic_category_name").html(data);
			}
		});
	})

	$(".delivery-select").change(function(e){
		var delivery_person_id = $(this).val();
		var order_id = $(this).find('option:selected').data('order-id');

		$.ajax({
			url: "assign_delivery_person.php",
			type: "POST",
			data: {
				delivery_person_id: delivery_person_id,
				order_id: order_id
			},
			success:function(data){
				// $("#dynamic_category_name").html(data);
				if(data){
					$(".delivery_person_msg").html("Delivery person assign successfully");
				}
			}
		});
	})



});
