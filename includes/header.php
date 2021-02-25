<?php include "config.php"; ?>
<header class="header_desktop">
        <div class="container-fluid back">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7">
                        <div class="brand">
                            <div style="height: 90px;" class="nav-brand logo-brand">
                                <a href="index.php"><img src="assets/images/brand/logo.png" width="100" height="90"></a>
                            </div>
                            <div class="award">
                                <a href="index.php" style="padding-left: 20px;height: 90px;"><img src="assets/images/brand/skusenosti.gif" width="95" height="90"></a>
                            </div>
                            <div class="header-headings">
                                <h2 style="margin-top: 0;">Výpočtová technika</h2>
                                <h4>predaj a servis</h4>
                                <div class="quick-links">
                                    <i class="fas fa-phone"></i><a href="tel:+421534411526">+421534411526</a>
                                    <i class="fas fa-envelope"></i><a href="mailto:eshop@compsnv.sk">eshop@compsnv.sk</a>    
                                </div>
                                <p></p>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="row">
                            <div class="top-links d-flex justify-content-around">
                            <?php 
                                    if(isset($_COOKIE['user'])){
                                        echo '<a href="template/myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.$_COOKIE['user'].'</span></a>';
                                    } else if(isset($_COOKIE['user-login'])){
                                        echo '<a href="template/myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.
                                        $user = substr($_COOKIE['user-login'], 0, strrpos($_COOKIE['user-login'], '@'));
                                        $user.'</span></a>';
                                    } else if(isset($_COOKIE['user-login-name'])){
                                        echo '<a href="template/myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.$_COOKIE['user-login-name'].'</span></a>';
                                    }
                                    
                                    else {
                                        echo '<a href="template/login.php" style="color: white;"><i class="fas fa-user"></i><span style="padding-left: 5px;">Účet</span></a>';
                                    }
                                ?>
                                <a href="template/contact.php" style="color: white"><i style="transform: rotate(-45deg);" class="fas fa-phone-volume"></i><span style="padding-left: 5px;">Kontakt</span></a>
                                <a href="template/about.php" style="color: white"><i class="far fa-building"></i><span style="padding-left: 5px;">O spoločnosti</span></a>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <form method="post" action="template/search-results.php">
                                    <div class="form-group has-search search-box" style="position: relative;z-index: 2;">
                                        
                                        <input style="border-radius:30px; padding-left: 10px; outline: 0 !important;" 
                                        type="text" name="search" class="form-control search" autocomplete="off"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zadajte hľadaný výraz...'" placeholder=" Zadajte hľadaný výraz..." >
                                        <div class="result" style="display: none; margin-top: -1vw; width: 100%;padding: 20px; border-left: 1px solid #E0E3E7; border-right: 1px solid #E0E3E7; 
                                        border-bottom: 1px solid #E0E3E7; border-radius: 0px 0px 20px 20px; background-color: white;"></div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2">
                            <a style="color: white;" href="template/cart.php"><i style="color: white; padding-top: 10px; " class="fas fa-shopping-cart"></i>
                                <?php if(count($cart) != 0){ echo "<sup style='margin-left: -5px;'><span class='dot' style='background-color: 
                                    #B81600; border-radius: 50%; padding-left: 4px; padding-right: 4px;'> ".count($cart)."</span></sup>";} ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
        <div class="news-bar">
            <marquee>Od 19.12.2020 do konca LOCKDOWN bude predajňa zatvorená.</marquee>        
        </div>
</header>



    <header class="header_mobile">
        <div class="container-fluid back">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7">
                        <div class="brand">
                            <div style="height: 90px;" class="nav-brand logo-brand">
                                <a href="index.php"><img src="assets/images/brand/logo.png" width="65" height="60"></a>
                            </div>
                            <div class="award">
                                <a href="index.php" style="padding-left: 20px;height: 90px;"><img src="assets/images/brand/skusenosti.gif" width="65" height="60"></a>
                            </div>
                            <div class="mobile_buttons" style="margin-top: 5%;">
                                <a data-toggle="collapse" href="#searchbar" role="button" aria-expanded="false" aria-controls="searchbar" style="padding: 4px;"><i style="font-size: 30px; color: white; text-decoration: none;" class="fas fa-search"></i></a>
                                <a data-toggle="collapse" href="#links" role="button" aria-expanded="false" aria-controls="links" style="padding: 4px;"><i style="font-size: 30px; color: white; text-decoration: none;" class="fas fa-bars"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 collapse" id="links" style="margin-bottom: 10%;">
                                <div class="header-headings">
                                    <h2 class="text-center">Výpočtová technika</h2>
                                    <hr style="border: 0; border-top: 1px solid rgba(255, 255, 255, 0.5); width: auto;">
                                    <div class="d-flex flex-row justify-content-center">
                                        <div class="d-flex flex-column">
                                            <a style="color: white; font-size: 23px; padding: 1px;" href="">Katalóg produktov </a>
                                            <a style="color: white; font-size: 23px; padding: 1px;" href="template/cart.php">Košík </a>
                                            <?php 
                                                if(isset($_COOKIE['user'])){
                                                    echo '<a href="template/myaccount.php" style="color: white; font-size: 23px; padding: 1px;"><span>'.$_COOKIE['user'].'</span></a>';
                                                } else if(isset($_COOKIE['user-login'])){
                                                    echo '<a href="template/myaccount.php" style="color: white; font-size: 23px; padding: 1px;"><span>'.
                                                    $user = substr($_COOKIE['user-login'], 0, strrpos($_COOKIE['user-login'], '@'));
                                                    $user.'</span></a>';
                                                } else if(isset($_COOKIE['user-login-name'])){
                                                    echo '<a href="template/myaccount.php" style="color: white; font-size: 23px; padding: 1px;"><span>'.$_COOKIE['user-login-name'].'</span></a>';
                                                }
                                                else {
                                                    echo '<a href="template/login.php" style="color: white; font-size: 23px; padding: 1px;"><span>Účet</span></a>';
                                                }
                                            ?>
                                            <a style="color: white; font-size: 23px; padding: 1px;" href="template/contact.php">Kontakt </a>
                                            <a style="color: white; font-size: 23px; padding: 1px;" href="template/about.php">O spoločnosti </a>
                                        </div>
                                        <div class="d-flex flex-column justify-content-around" style="margin-left: 20%;">
                                            <i style="font-size: 30px; color: white; text-decoration: none; padding: 1px;" class="fas fa-arrow-right text-right"></i>
                                            <i style="font-size: 30px; color: white; text-decoration: none; padding: 1px;" class="fas fa-shopping-cart text-right"></i>
                                            <i style="font-size: 30px; color: white; text-decoration: none; padding: 1px;" class="fas fa-user text-right"></i>
                                            <i style="font-size: 30px; color: white; text-decoration: none; transform: rotate(-45deg); padding: 5px;" class="fas fa-phone-volume text-right"></i>
                                            <i style="font-size: 30px; color: white; text-decoration: none; padding: 1px;" class="fas fa-building text-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 collapse" id="searchbar">
                        <div class="row">
                            <div class="top-links d-flex justify-content-around">
                                <?php 
                                    if(isset($_COOKIE['user'])){
                                        echo '<a href="template/myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.$_COOKIE['user'].'</span></a>';
                                    } else if(isset($_COOKIE['user-login'])){
                                        echo '<a href="template/myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.
                                        $user = substr($_COOKIE['user-login'], 0, strrpos($_COOKIE['user-login'], '@'));
                                        $user.'</span></a>';
                                    } else if(isset($_COOKIE['user-login-name'])){
                                        echo '<a href="template/myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.$_COOKIE['user-login-name'].'</span></a>';
                                    }
                                    
                                    else {
                                        echo '<a href="template/login.php" style="color: white;"><i class="fas fa-user"></i><span style="padding-left: 5px;">Účet</span></a>';
                                    }
                                ?>
                                <a href="template/contact.php" style="color: white"><i style="transform: rotate(-45deg);" class="fas fa-phone-volume"></i><span style="padding-left: 5px;">Kontakt</span></a>
                                <a href="template/about.php" style="color: white"><i class="far fa-building"></i><span style="padding-left: 5px;">O spoločnosti</span></a>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <form method="post" action="template/search-results.php">
                                    <div class="form-group has-search search-box" style="position: relative; z-index: 2;">
                                        
                                        <input style="border-radius:30px; padding-left: 10px; outline: 0 !important;" 
                                        type="text" name="search" class="form-control search" autocomplete="off"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zadajte hľadaný výraz...'" placeholder=" Zadajte hľadaný výraz..." >
                                        <div class="result" style="display: none; margin-top: -1vw; width: 90%;padding: 20px; border-left: 1px solid #E0E3E7; border-right: 1px solid #E0E3E7; 
                                        border-bottom: 1px solid #E0E3E7; border-radius: 0px 0px 20px 20px; background-color: white;"></div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2">
                            <a style="color: white;" href="template/cart.php"><i style="color: white; padding-top: 10px; " class="fas fa-shopping-cart"></i>
                                <?php if(count($cart) != 0){ echo "<sup style='margin-left: -5px;'><span class='dot' style='background-color: 
                                    #B81600; border-radius: 50%; padding-left: 4px; padding-right: 4px;'> ".count($cart)."</span></sup>";} ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
        <div class="news-bar">
            <marquee>Od 19.12.2020 do konca LOCKDOWN bude predajňa zatvorená.</marquee>        
        </div>
    </header>