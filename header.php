<header>
    <hgroup>
        <div class="nav_bg_with_shine">
            <div class="logo company"></div>
            <div class="account ">
                <div class="my_account"><a href="#">WISH LIST (<span id="count">0</span>)</a></div>
                <div class="my_account"><a href="#">MY ACCOUNT</a></div>
                <div class="my_account"><a href="#">SHOPPING CART</a></div>
                <div class="my_account"><a href="#">CHECKOUT</a></div>
            </div>
            <a href="#" class="cart_button"></a>
        </div>
        <nav class="middle_bg">
            <menu class="hr">
                <li><a href="index.php" title="Desktops"><img src="../image/home.png"  class="home" width="30px" height="30px"> <span>Desktops</span></a> </li>
                <li>
                    <a href="#" id="laptops&Notebooks" title="Laptops&Notebooks">Laptops&Notebooks</a>
                    <ul>
                        <li><a href="#" title="Sub Nav Link 1">Sub Nav Link 1</a></li>
                        <li><a href="#" title="Sub Nav Link 2">Sub Nav Link 2</a></li>
                        <li><a href="#" title="Sub Nav Link 3">Sub Nav Link 3</a></li>
                        <li><a href="#" title="Sub Nav Link 4">Sub Nav Link 4</a></li>
                    </ul>
                </li>
                <li><a href="#" title="Components">Components</a></li>
                <li><a href="#" title="Tablets1">Tablets</a></li>
                <li><a href="#" title="Software">Software</a></li>
                <li><a href="#" title="Phones&PDAs">Phones&PDAs</a></li>
                <li><a href="#" title="Cameras">Cameras</a></li>
                <li class="last"><a href="#" title="Contact">Contact</a></li>
            </menu>
        </nav>
        <div class="bottom_bg">
            <div class="login">
                <?php if (!Auth\User::isAuthorized()):?>
                    <div class="visitor">Welcome visitor you can login or <a href="register.php">create</a> an account.</div>
                    <div class="login_form" style="float: right;">
                        <form   action="./ajax.php" method="post">
                            <span class="sign_in">Sign in:</span>
                            <input type="text" size="20" name="login" id="login_input">
                            <input type="password" size="20" name="password" id="login_input">
                            <input type="hidden" name="act" value="login">
                            <input type="submit" value=">" id="button_login">
                        </form>
                    </div>
                <?else:?>
                    <div class="visitor">Welcome username!!!</div>
                    <div class="login_form" style="float: right;">
                        <form class="ajax" method="post" action="./classes/logout.php">
                            <input type="hidden" name="act" value="logout">
                            <div class="form-actions">
                                <button class="btn btn-large btn-primary" type="submit">Logout</button>
                            </div>
                        </form>
                    </div>
                <?endif;?>


                <div class="social_block">
                    <div class="img social"></div>
                    <div class="facebook social"></div>
                    <div class="twitter social"></div>
                    <div class="skype social"></div>
                </div>
            </div>

        </div>
    </hgroup>

</header>
<div class="clear"></div>