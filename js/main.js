/*  ---------------------------------------------------
    Template Name: Male Fashion
    Description: Male Fashion - ecommerce teplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
		Radio Btn
	--------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on('click', function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Scroll
	--------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });

    /*------------------
		Magnific
	--------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="fa fa-angle-up dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-down inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });


    //update product qty in cart
    var proQty = $('.pro-qty-2');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var inputField = $button.parent().find('input');
        var oldValue = parseFloat(inputField.val());
        var productId = inputField.data('productid');
    
        if ($button.hasClass('inc')) {
            var newVal = oldValue + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = oldValue - 1;
            } else {
                newVal = 0;
            }
        }
    
        // Update the input field with the new value
        inputField.val(newVal);
    
        // Send AJAX request to update quantity in the database
        $.ajax({
            url: 'update_cart.php', // Update with your backend endpoint
            method: 'POST',
            data: { productId: productId, newQuantity: newVal },
            success: function(response) {
                window.location.href="shopping-cart.php";
            },
            error: function(xhr, status, error) {
                console.error(error); // Log any errors
            }
        });
    });
    

    /*------------------
        Achieve Counter
    --------------------*/
    $('.cn_num').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    //add to cart on home page

    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault(); // Prevent default link behavior
    
        // Store a reference to the clicked element
        var $this = $(this);
    
        // Get product ID and price from data attributes
        var productId = $this.data('productid');
        var price = $this.data('price');
    
        // AJAX request to add product to cart
        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: {
                p_id: productId,
                price: price,
                qty: 1
            },
            success: function(response) {
                console.log(response);
                if(response){
                    $this.removeClass('add-to-cart').addClass('added-product text-success').text('✓ Added');
                }
                else{
                    window.location.href = 'login_page.php'; 
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
    
    //add to cart at product detail page

    $('#add_cart_product_detail').click(function(e){
        e.preventDefault();
        var $this = $(this);

        var productId = $this.data('productid');
        var price = $this.data('price');
        var quantity = $('#pro-qty').find("input").val();

        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: {
                p_id: productId,
                price: price,
                qty: quantity
            },
            success: function(response) {
                if(response){
                    console.log(response);
                    if(response){
                        $this.css('background-color', 'green');
                        $this.text('✓ Added');
                    }
                    else{
                        window.location.href = 'login_page.php'; 
                    }
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    })

    //add wishlist on product detail page

    $(document).on('click', '.add_wishlist_product', function(e){
        e.preventDefault();
        var $this = $(this);

        var productId = $this.data('productid');
        $.ajax({
            url: 'add_to_wishlist.php',
            method: 'POST',
            data: {
                p_id: productId,
            },
            success: function(response) {
                if(response){
                    console.log(response);
                    if(response){
                        console.log("Product added to wishlist");
                        $this.html('<i class="fa fa-heart" style="color: red;"></i> Wishlisted');
                    }
                    else{
                        window.location.href = 'login_page.php'; 
                    }
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    }) 


    //remove product in shoping cart
    $(document).on('click', '.remove_product', function(e) {
        e.preventDefault();
        var $this = $(this);

        var productId = $this.data('productid');

        $.ajax({
            url: 'remove_product.php',
            method: 'POST',
            data: {
                p_id: productId,
            },
            success: function(response) {
                if(response){
                //   console.log(productId+" is remove from the cart");
                  window.location.href = 'shopping-cart.php';
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    })


    //remove product in wishlist
    $(document).on('click', '.remove_wishlist', function(e) {
        e.preventDefault();
        var $this = $(this);

        var wishlistId = $this.data('wishlistid');

        $.ajax({
            url: 'remove_wishlist.php',
            method: 'POST',
            data: {
                w_id: wishlistId,
            },
            success: function(response) {
                if(response){
                //   console.log(productId+" is remove from the cart");
                  window.location.href = 'wishlist.php';
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    })

})(jQuery);

