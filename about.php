<?php
require('header.php');
?>

<head>
    
    <style>
        /* Custom CSS for About Us page */
            .about {
                padding: 60px 0;
            }
            .title{
                padding: 13px 0;
            }
            
            .about__item {
                background-color: #f9f9f9;
                padding:60px 50px;
                margin-bottom: 30px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            
            .about__item h4 {
                font-size: 24px;
                color: #333;
                margin-bottom: 15px;
            }
            
            .about__item p {
                font-size: 16px;
                color: #666;
                line-height: 1.6;
            }
            
            .icons-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }
            
            .icons {
                text-align: center;
            }
            
            .icons i {
                font-size: 36px;
                color: #007bff;
            }
            
            .icons h3 {
                font-size: 18px;
                color: #333;
                margin-top: 10px;
            }
            
           @media (max-width: 767px) {
                .col-md-6.my-5 {
                    display: flex;
                    justify-content: center;
                }
    
                .col-md-6.my-5 img {
                    max-width: 100%;
                    height: auto;
                }
            }
    </style>
</head>
<!-- Breadcrumb Section Begin -->
<section class="about" id="about">

    <div class="container">

        <div class="row align-items-center">
            <div class="col-md-6 mb-5">
                <img src="img\shop-details\1_img_65cf91cfb4d5a.jpg" alt="">
            </div>
           <div class="col-md-6">
               <div class="about__item">
                <h4>why choose us?</h4>
                <h3 class="title">The best mobile seller in the town.!</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat!</p>

                <div class="icons-container">
                    <div class="icons">
                        <i class="fa-sharp fa-solid fa-mobile-screen-button"></i>
                        <h3>Best Mobile</h3>
                    </div>
                    <div class="icons">
                        <i class="fas fa-shipping-fast"></i>
                        <h3>Fast Delivery</h3>
                    </div>
                    <div class="icons">
                        <i class="fas fa-headset"></i>
                        <h3>24/7 service</h3>
                    </div>
                </div>
               </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Who We Are ?</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Who We Do ?</h4>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item">
                    <h4>Why Choose Us</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>

    </div>


</section>

<!-- Client Section End -->

<?php
require('footer.php');
?>