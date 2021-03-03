<?php
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (strpos($url,'/template') !== false) {
        $odkaz = '';
    } else {
        $odkaz = 'template/';
    }
?>

<div class="container-fluid" style="background-color: #2B2B2B;">
        <div class="container">
            <footer id ="footer">
                <div class = "row">
                    <div class="col-sm-12 col-md-3 col-lg-3" style="padding-top: 1vw">
                        <span class="footer-h">O nás</span><br>
                        <a href="<?php echo $odkaz?>about.php" style="color: white; text-decoration: none;">O spoločnosti</a><br>
                        <a href="contact.php" style="color: white; text-decoration: none;">Kontakt</a><br>
                        <a href="<?php echo $odkaz?>subpage.php?ID=3" style="color: white; text-decoration: none;">Obchodné podmienky</a><br>
                        <a href="<?php echo $odkaz?>subpage.php?ID=4" style="color: white; text-decoration: none;">Reklamácia a vrátenie</a><br>
                        <a href="<?php echo $odkaz?>subpage.php?ID=5" style="color: white; text-decoration: none;">Ochrana osobných údajov</a><br>
                        
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3" style="padding-top: 1vw">
                        <span class="footer-h">Sledujte nás</span><br>
                        <a href = "https://www.facebook.com/fesicomp.sk" style = "color:white;">Facebook <i class="fab fa-facebook"></i></a><br>
                        <span class="footer-h">U nás zaplatíte</span><br>
                        <i class="fab fa-cc-visa"></i><span> Visa</span>
                        <i class="fab fa-cc-mastercard"></i><span> Mastercard</span><br>
                        <i class="fas fa-exchange-alt fa-1x"></i>&nbsp;<span style="font-size:16px;">Bankovým prevodom</span>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2" style="display: flex; padding-top: 1vw">
                        <div class="location" style="display: block; padding-right: 3vw">
                            <span class="footer-h">Adresa</span><br>
                            <span>FESI comp, s.r.o.<br>
                                    Duklianska 3A<br>
                                    052 01 Spišská Nová Ves<br>
                                    053 / 44 11 526<br>
                                    fesicomp@fesicomp.sk</span><br>
                        </div>    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4" style="padding-top: 1vw">
                        <a target="_blank" href="https://goo.gl/maps/69n38NnoHfmMWA8E8" style="">
                            
                                <img src="..\assets\images\mapa.png" target="_blank" alt="mapa" style="width: 70%; margin-left: auto; margin-right: auto; display: block;">
                            
                        </a>
                    </div>
                </div>
               <hr style="background-color:white;">
                
                <div class = "row">    
                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center" style = "margin-bottom: 5px;">
                        <span style = "text-align: center">© 2005 – <?php echo date("Y"); ?> FESI comp, s.r.o.</span>
                    </div>      
                </div>


        </div>
        </footer>              
    </div>
