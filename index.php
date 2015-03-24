<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
header("Content-Type: text/html; charset=UTF-8");
session_start();
require_once './classes/Auth.class.php';
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Company</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.jcarousel.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/jquery.liquidcarousel.pack.js"></script>
    <script type="text/javascript">
        <!--
        $(document).ready(function() {
            $('#liquid1').liquidcarousel({height:129, duration:100, hidearrows:false});
        });
        -->
    </script>
</head>
<body>
<div class="container-fluid">
<?php include('header.php');?>

<div class="slides">
    <ul> <!-- Слайды -->
        <li><img src="../image/baner-light-final.jpg" alt="image01" />
            <div>Описание #1</div>
        </li>
        <li><img src="../image/baner-skidka-final.jpg" alt="image02" />
            <div>Описание #2</div>
        </li>
        <li><img src="../image/baner-light-final.jpg" alt="image03" />
            <div>Описание #3</div>
        </li>
        <li><img src="../image/baner-skidka-final.jpg" alt="image04" />
            <div>Описание #4</div>
        </li>
    </ul>
</div>
<div class="featured_products">
    <div class="name_text">FEATURED</div>
    <div class="ruler"></div>
    <button id="slide_featured">-</button>
    <div class="featured">

        <div class="products">
            <div class="product">
                <div class="detail">
                    <div class="background_image4 image"></div>
                    <div class="text">Mascot Kitti - White</div>
                    <button class="add_to_cart"> ADD TO CART</button>
                    <div class="price">
                        <div class="dol"></div>
                        <div class="number"><span>2</span></div>
                        <div class="number"><span>0</span></div>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="detail">
                    <div class="background_image3 image"></div>
                    <div class="text">Bite Me</div>
                    <button class="add_to_cart"> ADD TO CART</button>
                    <div class="price">
                        <div class="dol"></div>
                        <div class="number"><span>3</span></div>
                        <div class="number"><span>0</span></div>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="detail">
                    <div class="background_image2 image"></div>
                    <div class="text">Little Fella</div>
                    <button class="add_to_cart"> ADD TO CART</button>
                    <div class="price">
                        <div class="dol"></div>
                        <div class="number"><span>4</span></div>
                        <div class="number"><span>5</span></div>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="detail">
                    <div class="background_image1 image"></div>
                    <div class="text">Astral Cruise</div>
                    <button class="add_to_cart"> ADD TO CART</button>
                    <div class="price">
                        <div class="dol"></div>
                        <div class="number"><span>4</span></div>
                        <div class="number"><span>5</span></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="brands_products">
    <div class="name_text">BANDS</div>
    <div class="ruler"></div>

    <div id="wrapper">
        <div class="d-carousel">
            <ul class="carousel">
                <li><div class="images"><img src="image/apple.png" alt="" /></div> </li>
                <li><div class="images"><img src="image/boss.png" alt="" /></div> </li>
                <li><div class="images"><img src="image/palm.png" alt="" /></div> </li>
                <li><div class="images"><img src="image/adidas.png" alt="" /></div> </li>
                <li><div class="images"><img src="image/boss.png" alt="" /></div> </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="latest_products">
    <div class="name_text">LATEST</div>
    <div class="ruler"></div>
    <button id="slide_latest">-</button>
    <div class="featured">

        <div class="products">
            <div id="liquid1" class="liquid">
                <span class="previous"></span>
                <div class="wrapper">
                    <ul class="wrapper">
                        <li class="element">
                            <div class="product">
                                <div class="detail">
                                    <div class="background_image4 image">
                                        <div class="hidden">
                                            <button name="add_to_compare" class="add_to">Add to Compare</button>
                                            <button name="add_to_compare" class="add_to">Add to Whislist</button>
                                        </div>
                                    </div>
                                    <div class="text">Mascot Kitti - White</div>
                                    <button class="add_to_cart"> ADD TO CART</button>
                                    <div class="price">
                                        <div class="dol"></div>
                                        <div class="number"><span>2</span></div>
                                        <div class="number"><span>0</span></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="element">
                            <div class="product">
                                <div class="detail">
                                    <div class="background_image3 image">
                                        <div class="hidden">
                                            <button name="add_to_compare" class="add_to">Add to Compare</button>
                                            <button name="add_to_compare" class="add_to">Add to Whislist</button>
                                        </div>
                                    </div>
                                    <div class="text">Bite Me</div>
                                    <button class="add_to_cart"> ADD TO CART</button>
                                    <div class="price">
                                        <div class="dol"></div>
                                        <div class="number"><span>3</span></div>
                                        <div class="number"><span>0</span></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="element">
                            <div class="product">
                                <div class="detail">
                                    <div class="background_image2 image">
                                        <div class="hidden">
                                            <button name="add_to_compare" class="add_to">Add to Compare</button>
                                            <button name="add_to_compare" class="add_to">Add to Whislist</button>
                                        </div>
                                    </div>
                                    <div class="text">Little Fella</div>
                                    <button class="add_to_cart"> ADD TO CART</button>
                                    <div class="price">
                                        <div class="dol"></div>
                                        <div class="number"><span>4</span></div>
                                        <div class="number"><span>5</span></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="element">
                            <div class="product">
                                <div class="detail">
                                    <div class="background_image1 image">
                                        <div class="hidden">
                                            <button name="add_to_compare" class="add_to">Add to Compare</button>
                                            <button name="add_to_compare" class="add_to">Add to Whislist</button>
                                        </div>
                                    </div>
                                    <div class="text">Astral Cruise</div>
                                    <button class="add_to_cart"> ADD TO CART</button>
                                    <div class="price">
                                        <div class="dol"></div>
                                        <div class="number"><span>4</span></div>
                                        <div class="number"><span>5</span></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="element">
                            <div class="product">
                                <div class="detail">
                                    <div class="background_image2 image">
                                        <div class="hidden">
                                            <button name="add_to_compare" class="add_to">Add to Compare</button>
                                            <button name="add_to_compare" class="add_to">Add to Whislist</button>
                                        </div>
                                    </div>
                                    <div class="text">Little Fella</div>
                                    <button class="add_to_cart"> ADD TO CART</button>
                                    <div class="price">
                                        <div class="dol"></div>
                                        <div class="number"><span>4</span></div>
                                        <div class="number"><span>5</span></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <span class="next"></span>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>
</div>

</body>
</html>