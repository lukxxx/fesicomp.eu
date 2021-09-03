<header class="header_desktop">
    <div class="container-fluid back">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="brand">
                        <div style="height: 90px;" class="nav-brand logo-brand">
                            <a href="<?php echo $root_url ?>/"><img src="https://compsnv.sk/assets/images/brand/logo.png" width="100" height="90"></a>
                        </div>
                        <div class="award">
                            <a href="<?php echo $root_url ?>/" style="padding-left: 20px;height: 90px;"><img src="https://compsnv.sk/assets/images/brand/skusenosti.gif" width="95" height="90"></a>
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
                            if (isset($_COOKIE['user'])) {
                                echo '<a href="'.$root_url.'/moj-ucet" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">' . $_COOKIE['user'] . '</span></a>';
                            } else if (isset($_COOKIE['user-login'])) {
                                echo '<a href="'.$root_url.'/moj-ucet" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">' .
                                    $user = substr($_COOKIE['user-login'], 0, strrpos($_COOKIE['user-login'], '@'));
                                $user . '</span></a>';
                            } else if (isset($_COOKIE['user-login-name'])) {
                                echo '<a href="'.$root_url.'/moj-ucet" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">' . $_COOKIE['user-login-name'] . '</span></a>';
                            } else {
                                echo '<a href="'.$root_url.'/prihlasenie" style="color: white;"><i class="fas fa-user"></i><span style="padding-left: 5px;">Účet</span></a>';
                            }
                            ?>
                            <a href="<?php echo $root_url ?>/kontakt" style="color: white"><i style="transform: rotate(-45deg);" class="fas fa-phone-volume"></i><span style="padding-left: 5px;">Kontakt</span></a>
                            <a href="<?php echo $root_url ?>/o-nas" style="color: white"><i class="far fa-building"></i><span style="padding-left: 5px;">O spoločnosti</span></a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <?php
                            if (isset($_POST['search'])) {
                                $term = $_POST['search'];
                                header("Location: $root_url/vyhladavanie?search=$term");
                            }

                            ?>
                            <form method="post" id="vyhladavanie">
                                <div class="form-group has-search search-box" style="position: relative;">
                                    <p style="all: unset;" onclick="vyprazdnenie()">
                                        <i class="fas fa-times krizicek_inputik" style="display: none;"></i>
                                    </p>
                                    <input style="position: relative; z-index: 5 !important; border-radius:30px; padding-left: 10px; outline: 0 !important;" type="text" name="search" id="search" class="form-control search" autocomplete="off" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zadajte hľadaný výraz...'" placeholder=" Zadajte hľadaný výraz...">
                                    <div class="result" style="z-index: 2 !important;position: absolute; display: none; margin-top: -1.5vw; width: 100%;padding: 20px; border-left: 1px solid #E0E3E7; border-right: 1px solid #E0E3E7; 
                                        border-bottom: 1px solid #E0E3E7; border-radius: 0px 0px 20px 20px; background-color: white;"></div>
                                </div>
                            </form>
                            <script>
                                $("#vyhladavanie").submit(function(e) {
                                    if($(".search").val() === ""){
                                        e.preventDefault();
                                    } else {
                                        e.preventDefault();
                                        var term = $('.search').val();
                                        location.href = root_url+'/vyhladavanie?search=' + term;
                                    }
                                });

                                function vyprazdnenie() {
                                    document.getElementById('search').value = '';
                                    $(".krizicek_inputik").hide();
                                }
                                

                            </script>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2">
                            <a style="color: white;" href="<?php echo $root_url?>/kosik"><i style="color: white; padding-top: 10px; " class="fas fa-shopping-cart"></i>
                                <?php if (isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]") if (count($cart) != 0) {
                                    echo "<sup style='margin-left: -5px;'><span class='dot' style='background-color: 
                                    #B81600; border-radius: 50%; padding-left: 4px; padding-right: 4px;'> " . count($cart) . "</span></sup>";
                                } ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="news-bar">
        <marquee>Vitajte na našej novej stránke!!!</marquee>
    </div>
</header>


<header class="header_mobile">
    <div class="container-fluid back">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="brand d-flex justify-content-between">
                        <div class="brand_award d-flex flex-row">
                            <div style="height: 90px;" class="nav-brand logo-brand">
                            <a href="<?php echo $root_url ?>/"><img src="https://compsnv.sk/assets/images/brand/logo.png" width="65" height="60"></a>
                            </div>
                            <div class="award">
                                <a href="<?php echo $root_url ?>" style="padding-left: 20px; height: 90px;"><img src="https://compsnv.sk/assets/images/brand/skusenosti.gif" width="65" height="60"></a>
                            </div>
                        </div>
                        <div class="mobile_buttons" style="margin-top: 5%;">
                            <a onclick="plus()" data-toggle="collapse" href="#searchbar" role="button" aria-expanded="false" class="vyhladavanie" aria-controls="searchbar" style="padding: 4px;"><i style="font-size: 30px; color: white; text-decoration: none;" class="fas fa-search"></i></a>
                            <a onclick="minus()" data-toggle="collapse" href="#links" role="button" aria-expanded="false" class="menu_odkazy_mobilne" aria-controls="links" style="padding: 4px;"><i style="font-size: 30px; color: white; text-decoration: none;" class="fas fa-bars"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 links collapse" id="links" style="margin-bottom: 8%;">
                            <div class="header-headings">
                                <h2 class="text-center">Výpočtová technika</h2>
                                <hr style="border: 0; border-top: 1px solid rgba(255, 255, 255, 0.5); width: auto;">

                                <div class="d-flex justify-content-between align-items-center">
                                    <a data-toggle="collapse" href="#categories_mobile" class="katalog" style="color: white; font-size: 23px; padding: 1px; text-decoration: none;">Katalóg produktov </a>
                                    <a data-toggle="collapse" href="#categories_mobile" role="button" aria-expanded="false" aria-controls="categories_mobile">
                                        <i style="font-size: 24px; color: white; text-decoration: none; padding: 1px;" class="katalog fas fa-arrow-right text-right"></i>
                                    </a>
                                </div>
                                <div class="categories-list collapse" id="categories_mobile" style="margin-left: 10px; margin-right: 20px;">
                                    <div class="categories d-flex flex-row">
                                        <?php
                                        $aktualni = "";
                                        $kid = "0";
                                        if ($aktualni == 0) $str = " AND (k_aktualni='1' OR k_aktualni='3') ";
                                        else $str = "";
                                        $sql = "SELECT k_id,k_kid,k_main,k_nazov,k_aktualni,k_poradie,k_medzera FROM kategorie WHERE k_kid='0' " . $str . " AND k_medzera='0' ORDER BY k_poradie";

                                        if ($stmt = mysqli_prepare($link, $sql)) {

                                            if (mysqli_stmt_execute($stmt)) {
                                                $result = mysqli_stmt_get_result($stmt);

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo "<ol style='list-style: none;padding: 10px 0px 0px 10px;'>";
                                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                        echo "<div class='d-flex' style='color: white; padding: 5px 5px 5px 10px; line-height: 20px'>";
                                                        echo "<i class='fas fa-chevron-right'></i><a href='$root_url/=" . replaceAccents($row['k_nazov']) . "'><li style='padding-left: 8px; color: white;'>" . $row['k_nazov'] . "</li></a></div>";
                                                    }
                                                    echo "</ol>";
                                                } else {
                                                    echo "<span>ERROR!</span>";
                                                }
                                            } else {
                                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a style="color: white; font-size: 23px; padding: 1px;" href="<?php echo $root_url?>/kosik">Košík </a>
                                    <a href="<?php echo $root_url?>/kosik"><i style="font-size: 20px; color: white; text-decoration: none; padding: 1px;" class="fas fa-shopping-cart text-right"></i><?php if (count($cart) != 0) {
                                                                                                                                                                                                echo "<sup style='margin-left: -15px;'><span class='dot' style='background-color: 
                                                #B81600; border-radius: 50%; padding-left: 4px; padding-right: 4px; color: white;'> " . count($cart) . "</span></sup>";
                                                                                                                                                                                            } ?>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <?php
                                    if (isset($_COOKIE['user'])) {
                                        echo '<a href="'.$root_url.'/moj-ucet" style="color: white; font-size: 23px; padding: 1px;"><span>' . $_COOKIE['user'] . '</span></a>';
                                    } else if (isset($_COOKIE['user-login'])) {
                                        echo '<a href="'.$root_url.'/moj-ucet" style="color: white; font-size: 23px; padding: 1px;"><span>' .
                                            $user = substr($_COOKIE['user-login'], 0, strrpos($_COOKIE['user-login'], '@'));
                                        $user . '</span></a>';
                                    } else if (isset($_COOKIE['user-login-name'])) {
                                        echo '<a href="'.$root_url.'/moj-ucet" style="color: white; font-size: 23px; padding: 1px;"><span>' . $_COOKIE['user-login-name'] . '</span></a>';
                                    } else {
                                        echo '<a href="'.$root_url.'/prihlasenie" style="color: white; font-size: 23px; padding: 1px;"><span>Účet</span></a>';
                                    }
                                    ?>

                                    <?php
                                    if (isset($_COOKIE['user'])) {
                                        echo '<a href="'.$root_url.'/moj-ucet"><i style="font-size: 20px; color: white; text-decoration: none; padding: 1px; color: #68B74C;" class="fas fa-user text-right"></i></a>';
                                    } else if (isset($_COOKIE['user-login'])) {
                                        echo '<a href="'.$root_url.'/moj-ucet"><i style="font-size: 20px; color: white; text-decoration: none; padding: 1px; color: #68B74C;" class="fas fa-user text-right"></i></a>';
                                    } else if (isset($_COOKIE['user-login-name'])) {
                                        echo '<a href="'.$root_url.'/moj-ucet"><i style="font-size: 20px; color: white; text-decoration: none; padding: 1px; color: #68B74C;" class="fas fa-user text-right"></i></a>';
                                    } else {
                                        echo '<a href="'.$root_url.'/prihlasenie"><i style="font-size: 20px; color: white; text-decoration: none; padding: 1px;" class="fas fa-user text-right"></i></a>';
                                    }
                                    ?>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a style="color: white; font-size: 23px; padding: 1px;" href="'.$root_url.'/kontakt">Kontakt </a>
                                    <a href="'.$root_url.'/kontakt"><i style="font-size: 20px; color: white; text-decoration: none; transform: rotate(-45deg); padding: 1px;" class="fas fa-phone-volume text-right"></i></a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a style="color: white; font-size: 23px; padding: 1px;" href="'.$root_url.'/o-nas">O spoločnosti </a>
                                    <a href="'.$root_url.'/o-nas"><i style="font-size: 20px; color: white; text-decoration: none; padding: 1px;" class="fas fa-building text-right"></i></a>
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5 searchbar collapse" id="searchbar">
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <form id="vyhladavanie-mobile" method="post">
                                <div class="form-group has-search search-box" style="position: relative; z-index: 2;">
                                    <p style="all: unset;" onclick="vyprazdnenie_mobile()">
                                        <i class="fas fa-times krizicek_inputik_mobile" style="display: none; right: 50px;"></i>
                                    </p>
                                    <input style="margin-left: 10%; width: 80%; border-radius:30px; padding-left: 10px; outline: 0 !important;" type="text" name="search-mobile" id="search-input-mobile" class="form-control search-input-mobile" autocomplete="off" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zadajte hľadaný výraz...'" placeholder=" Zadajte hľadaný výraz...">
                                    <div class="result" style="margin-left: 10%; width: 100%; display: none; margin-top: -9vw; width: 80%;padding: 20px; border-left: 1px solid #E0E3E7; border-right: 1px solid #E0E3E7; 
                                        border-bottom: 1px solid #E0E3E7; border-radius: 0px 0px 20px 20px; background-color: white;"></div>

                                </div>
                            </form>
                            <script>
                                $("#vyhladavanie-mobile").submit(function(e) {
                                    if($(".search-input-mobile").val() === ""){
                                        e.preventDefault();
                                    } else {
                                        e.preventDefault();
                                        var term = $('.search-input-mobile').val();
                                        location.href = root_url+'/vyhladavanie?search=' + term;
                                    }
                                });  
                                
                                function vyprazdnenie_mobile() {
                                    document.getElementById('search-input-mobile').value = '';
                                    $(".krizicek_inputik_mobile").hide();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="news-bar">
        <marquee>Vitajte na našej novej stránke!!!</marquee>
    </div>
</header>


<header class="header_tablet">
    <div class="container-fluid back">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                    <div class="brand">
                        <div style="height: 90px;" class="nav-brand logo-brand">
                            <a href="<?php echo $root_url ?>"><img src="https://compsnv.sk/assets/images/brand/logo.png" width="100" height="90"></a>
                        </div>
                        <div class="award">
                            <a href="<?php echo $root_url ?>" style="padding-left: 20px;height: 90px;"><img src="https://compsnv.sk/assets/images/brand/skusenosti.gif" width="95" height="90"></a>
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
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
                    <div class="row">
                        <div class="top-links d-flex justify-content-around">
                            <?php
                            if (isset($_COOKIE['user'])) {
                                echo '<a href="'.$root_url.'/moj-ucet" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">' . $_COOKIE['user'] . '</span></a>';
                            } else if (isset($_COOKIE['user-login'])) {
                                echo '<a href="'.$root_url.'/moj-ucet" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">' .
                                    $user = substr($_COOKIE['user-login'], 0, strrpos($_COOKIE['user-login'], '@'));
                                $user . '</span></a>';
                            } else if (isset($_COOKIE['user-login-name'])) {
                                echo '<a href="'.$root_url.'/moj-ucet" style="color: white;"><i style="color: #68B74C" class="fas fa-user"></i><span style="padding-left: 5px;">' . $_COOKIE['user-login-name'] . '</span></a>';
                            } else {
                                echo '<a href="'.$root_url.'/prihlasenie" style="color: white;"><i class="fas fa-user"></i><span style="padding-left: 5px;">Účet</span></a>';
                            }
                            ?>
                            <a href="'.$root_url.'/kontakt" style="color: white"><i style="transform: rotate(-45deg);" class="fas fa-phone-volume"></i><span style="padding-left: 5px;">Kontakt</span></a>
                            <a href="'.$root_url.'/o-nas" style="color: white"><i class="far fa-building"></i><span style="padding-left: 5px;">O spoločnosti</span></a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <form method="post" id="vyhladavanie-tablet">
                                <div class="form-group has-search search-box" style="position: relative;">
                                    <p style="all: unset;" onclick="vyprazdnenie_tablet()">
                                        <i class="fas fa-times krizicek_inputik_tablet" style="display: none;"></i>
                                    </p>
                                    <input style="position: relative; z-index: 5 !important; border-radius:30px; padding-left: 10px; outline: 0 !important;" type="text" name="search-mobile" id="search-input-tablet" class="form-control search-input-tablet" autocomplete="off" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zadajte hľadaný výraz...'" placeholder=" Zadajte hľadaný výraz...">
                                    <div class="result" style="z-index: 2 !important;position: absolute; display: none; margin-top: -1.5vw; width: 100%;padding: 20px; border-left: 1px solid #E0E3E7; border-right: 1px solid #E0E3E7; 
                                        border-bottom: 1px solid #E0E3E7; border-radius: 0px 0px 20px 20px; background-color: white;"></div>

                                </div>
                            </form>
                            <script>
                                $("#vyhladavanie-tablet").submit(function(e) {
                                    if($(".search-input-tablet").val() === ""){
                                        e.preventDefault();
                                    } else {
                                        e.preventDefault();
                                        var term = $('.search-input-tablet').val();
                                        location.href = root_url+'/vyhladavanie?search=' + term;
                                    }
                                });

                                function vyprazdnenie_tablet() {
                                    document.getElementById('search-input-tablet').value = '';
                                    $(".krizicek_inputik_tablet").hide();
                                }
                            </script>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2">
                            <a style="color: white;" href="<?php echo $root_url ?>/kosik"><i style="color: white; padding-top: 10px; " class="fas fa-shopping-cart"></i>
                                <?php if (isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]") if (count($cart) != 0) {
                                    echo "<sup style='margin-left: -5px;'><span class='dot' style='background-color: 
                                    #B81600; border-radius: 50%; padding-left: 4px; padding-right: 4px;'> " . count($cart) . "</span></sup>";
                                } ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="news-bar">
        <marquee>Vitajte na našej novej stránke!!!</marquee>
    </div>
</header>

<script>
    $(".katalog").click(function() {
        $(".fa-arrow-right").toggleClass("down");
    });

    $('.fa-bars').click(function() {
        $(this).toggleClass("fa-times");
    });

    $('.fa-search').click(function() {
        $(this).toggleClass("fa-times");
    });


    function plus() {
        var linksClassList = document.getElementById('links').className.split(/\s+/);
        var searchbarClassList = document.getElementById('searchbar').className.split(/\s+/); 

        var elementLinks = document.getElementById('links');
        var elementSearchbar = document.getElementById('searchbar');
        
        for (var i = 0; i < linksClassList.length; i++) {
            if (linksClassList[i] === 'show') {
                elementLinks.classList.toggle("collapsing")
                elementLinks.classList.toggle("show")
                $('.fa-bars').toggleClass("fa-times")
            }
        }
    }

    function minus() {
        var linksClassList = document.getElementById('links').className.split(/\s+/);
        var searchbarClassList = document.getElementById('searchbar').className.split(/\s+/);

        var elementLinks = document.getElementById('links');
        var elementSearchbar = document.getElementById('searchbar');

        for (var i = 0; i < searchbarClassList.length; i++) {
            if(searchbarClassList[i] === 'show') {
                elementSearchbar.classList.toggle("collapsing")
                elementSearchbar.classList.toggle("show")
                $('.fa-search').toggleClass("fa-times")
            }
        }
    }



</script>