<?php 
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


?>
  
<div class="row">
                <div class="panel-header d-flex">
                    <div class="col-md-4 col-lg-4">
                        <img src="../assets/images/logo.png" width="61" height="54">
                    </div>
                    <div class="col-md-8 col-lg-8 text-left">
                        <h4 style="color: white; font-size: 25px; padding: 0; font-weight: bold;">Administrácia</h4>
                        <span style="color: white; font-size: 10px; line-height: 10px; position: absolute; top: 30px">Verzia 1.0</span>
                    </div>
                </div>
            </div> 
            <div class="row">
                <hr style="border: 1px solid white; width: 80%;">
                <div class="col-sm-12 col-lg-12">
                    <div class="home-link">
                    <?php 
                        if (strpos($url,'/dashboard') !== false) {
                            echo '<a class="nav-link active" href="#"><i class="fas fa-home"></i><span> Domov</span></a>';
                        } else {
                            echo '<a class="nav-link non-active" href="../"<i class="fas fa-home"></i><span> Domov</span></a>';
                        }
                    ?>
                    </div>
                </div>
                <hr style="border: 1px solid white; width: 80%;">
                <div class="col-sm-12 col-lg-12">
                    <div class="home-link text-left">
                        <span class="link-category" >Správa tovaru</span>
                        <div class="links" style="margin-top: 10px; padding-left: 5%">
                        <?php 
                            if (strpos($url,'/upload') !== false) {
                                echo '<a class="nav-link active" href="./upload"><i class="fas fa-box"></i><span> Nahrávanie</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="./upload"> <i class="fas fa-box"></i><span> Nahrávanie</span></a>';
                            }
                            if (strpos($url,'/categories') !== false) {
                                echo '<a class="nav-link active" href="./categories"><i class="fas fa-list"></i><span> Kategórie</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="./categories"> <i class="fas fa-list"></i><span> Kategórie</span></a>';
                            }
                            if (strpos($url,'/manufacturers') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-users"></i><span> Výrobcovia</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"> <i class="fas fa-users"></i><span> Výrobcovia</span></a>';
                            }
                            if (strpos($url,'/manufacturers') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-euro-sign"></i><span> Ceny</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"> <i class="fas fa-euro-sign"></i><span> Ceny</span></a>';
                            }
                        ?>
                        </div>
                    
                    </div>
                    <div class="home-link text-left">
                        <span class="link-category" >Správa objednávok</span>
                        <div class="links" style="margin-top: 10px; padding-left: 5%">
                        <?php 
                            if (strpos($url,'/upload') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-clipboard-check"></i><span> Objednávky</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"> <i class="fas fa-clipboard-check"></i><span> Objednávky</span></a>';
                            }
                            if (strpos($url,'/categories') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-paste"></i><span> Faktúry</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"><i class="fas fa-paste"></i><span> Faktúry</span></a>';
                            }
                            if (strpos($url,'/manufacturers') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-recycle"></i><span> Reklamácie</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"><i class="fas fa-recycle"></i><span> Reklamácie</span></a>';
                            }
                            if (strpos($url,'/customers') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-users-cog"></i><span> Zákazníci</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"> <i class="fas fa-users-cog"></i><span> Zákazníci</span></a>';
                            }
                        ?>
                        </div>
                    
                    </div>
                    <div class="home-link text-left">
                        <span class="link-category" >Správa obsahu</span>
                        <div class="links" style="margin-top: 10px; padding-left: 5%">
                        <?php 
                            if (strpos($url,'/subpages') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-clipboard-check"></i><span> Podstránky</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"> <i class="fas fa-clipboard-check"></i><span> Podstránky</span></a>';
                            }
                            if (strpos($url,'/categories') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-paste"></i><span> Obrázky</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"><i class="fas fa-paste"></i><span> Obrázky</span></a>';
                            }
                            if (strpos($url,'/manufacturers') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-recycle"></i><span> Bannery</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"><i class="fas fa-recycle"></i><span> Bannery</span></a>';
                            }
                            if (strpos($url,'/customers') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-users-cog"></i><span> Správy</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"> <i class="fas fa-users-cog"></i><span> Správy</span></a>';
                            }
                        ?>
                        </div>
                    
                    </div>
                    
                </div>
                <hr style="border: 1px solid white; width: 80%;">
                <div class="col-sm-12 col-lg-12">
                    <div class="home-link text-left">
                    <?php 
                            if (strpos($url,'/subpages') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-cog"></i><span> Nastavenia</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"> <i class="fas fa-cog"></i><span> Nastavenia</span></a>';
                            }
                            if (strpos($url,'/categories') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-mouse-pointer"></i><span> Webstránka</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"><i class="fas fa-mouse-pointer"></i><span> Webstránka</span></a>';
                            }
                            if (strpos($url,'/manufacturers') !== false) {
                                echo '<a class="nav-link active" href="#"><i class="fas fa-comments"></i><span> Chat</span></a>';
                            } else {
                                echo '<a class="nav-link non-active" href="../"><i class="fas fa-comments"></i><span> Chat</span></a>';
                            }
                        ?>       
                    </div>
                </div>
            </div>