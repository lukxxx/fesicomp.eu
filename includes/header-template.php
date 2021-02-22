<header>
        <div class="container-fluid back">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7">
                        <div class="brand">
                            <div style="height: 90px;" class="nav-brand logo-brand">
                                <a href="../index.php" "><img src="../assets/images/brand/logo.png" width="100" height="90"></a>
                            </div>
                            <div class="award">
                                <a href="../index.php" style="padding-left: 20px;height: 90px;"><img src="../assets/images/brand/skusenosti.gif" width="95" height="90"></a>
                            </div>
                            <div class="header-headings">
                                <h2>Výpočtová technika</h2>
                                <h4>predaj a servis</h4>
                                <div class="quick-links">
                                    <i class="fas fa-phone"></i><a href="tel:+421534411526">+421534411526</a>
                                    <i class="fas fa-envelope"></i><a href="mailto:eshop@compsnv.sk">eshop@compsnv.sk</a>    
                                </div>
                                <p></p>
                            </div>
                            <div class="responsive-collapsed-bar" style="color: white; display: none;">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>

                       
                    </div>



                    <div class="col-sm-12 col-md-5 col-lg-5 toplinks_and_search">
                        <div class="row">
                            <div class="top-links d-flex justify-content-around">
                                <?php 
                                    if(isset($_COOKIE['user'])){
                                        echo '<a href="myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.$_COOKIE['user'].'</span></a>';
                                    } else if(isset($_COOKIE['user-login'])){
                                        echo '<a href="myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.
                                        $user = substr($_COOKIE['user-login'], 0, strrpos($_COOKIE['user-login'], '@'));
                                        $user.'</span></a>';
                                    } else if(isset($_COOKIE['user-login-name'])){
                                        echo '<a href="myaccount.php" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">'.$_COOKIE['user-login-name'].'</span></a>';
                                    }
                                    
                                    else {
                                        echo '<a href="login.php" style="color: white;"><i class="fas fa-user"></i><span style="padding-left: 5px;">Účet</span></a>';
                                    }
                                ?>
                                <a href="contact.php" style="color: white"><i style="transform: rotate(-45deg);" class="fas fa-phone-volume"></i><span style="padding-left: 5px;">Kontakt</span></a>
                                <a href="about.php" style="color: white"><i class="far fa-building"></i><span style="padding-left: 5px;">O spoločnosti</span></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <form method="post" action="../template/search-results.php">
                                    <div class="form-group has-search search-box" style="position: relative;z-index: 1;">
                                        <button class="btn" type="submit" style="position: absolute; margin-left: 18.5vw;"><i class="fa fa-search"></i></button>
                                        <input style="border-radius:30px; padding-left: 10px; outline: 0 !important; width: 90%;" 
                                        type="text" class="form-control search" autocomplete="off" placeholder="  Zadajte hľadaný výraz..." >
                                        <div class="result" style="display: none; margin-top: -1vw; width: 90%;padding: 20px; border-left: 1px solid #E0E3E7; border-right: 1px solid #E0E3E7; 
                                        border-bottom: 1px solid #E0E3E7; border-radius: 0px 0px 20px 20px; background-color: white;"></div>
                                        <a href="cart.php"><button class="btn" type="button" style="position: absolute; margin-left: 21.5vw; top: 0"><i style="color: white" 
                                        class="fas fa-shopping-cart"></i></button></a>
                                    </div>
                                </form>
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