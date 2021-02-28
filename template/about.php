<?php 
    include_once "../includes/head-template.php";
    include (ROOT ."includes/header-template.php");
    $lin = mysqli_connect('127.0.0.1', 'root', '', 'compsnv');
    if($lin === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>
    <div class="container" style="padding: 20px 13px 0 10px">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-8">
                <h2>O nás</h2>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6" >
                        <img src="../assets/images/firma2_v.jpg" alt="firma" class="container-fluid" style="border-radius: 10px;" width="450px" height="auto" >
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: justify;">
                    <p>Firma FESI comp, s.r.o. ma dlhodobé skúsenosti v pôsobení zaoberajúcim sa servisom a predajom výpočtovej  techniky a registračných pokladní . Preto jedným z hlavných cieľov  firmy je dodať kvalitný a odborný servis a poradenstvo v oblasti výpočtovej techniky a samozrejmosžou je aj dodanie  počítačových zostav  a príslušenstva. Zabezpečujeme záruční servis na kompletnú paletu tovarov ktorú zabezpečuju vyškolení technici a pozáruční servis na tlačiarne , počítačové zostavy atd. V súčasnosti sa firma začala zaoberať plnením atramentových kaziet do tlačiarni a aj predaj plniacich atramentov a prípravkov. Ďalším cieľom firmy  je zabezpečiť čo najnižšiu cenu vzhľadom na stále rastúci trh. Naše krédo “výpočtová technika za rozumne ceny”. Dňom 8.9.2008 firma sa presťahovala do vlastných priestorov na Duklianskej ul. 3A v Spišskej Novej Vsi.</p>
                    </div>
                </div>
                <div style="margin-top: 50px;">
                    <h2>Certifikáty</h2>
                    <div class="row d-flex flex-wrap" style="padding-bottom: 40px;">           
                        <?php
                            $sql = "SELECT * FROM foto WHERE f_kat=3";
                            $result = mysqli_query($lin, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <div class="col-sm-6 col-md-3 col-lg-2" style="margin:10px;">
                                        <a  href="../assets/images/galeria/<?php echo $row['velke']?>" data-lightbox="example-set-1" ><img src="../assets/images/galeria/<?php echo $row['male']?>" alt="" style="padding:5px;"/></a>
                                    </div>
                                <?php }
                            } else {
                                echo "0 results";
                            }
                        ?> 
                    </div>

                    <h2>Fotogaléria</h2>
                    <div class="row d-flex flex-wrap">
                            <?php
                                $sql = "SELECT * FROM foto WHERE f_kat=1";
                                $result = mysqli_query($lin, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    
                                    while($row = mysqli_fetch_assoc($result)) {?> 
                                        <div class="col-sm-6 col-md-3 col-lg-2" style="margin:10px;">
                                            <a  href="../assets/images/galeria/<?php echo $row['velke']?>" data-lightbox="example-set-2" ><img src="../assets/images/galeria/<?php echo $row['male']?>" alt="" width=180 height=138 style="padding:5px;"/></a>
                                        </div>
                                    <?php }
                                
                                } else {
                                    echo "0 results";
                                }
                            ?>
                    </div>

                    <h2>Naša práca</h2>
                    <div class="row d-flex flex-wrap">
                            <?php
                                $sql = "SELECT * FROM foto WHERE f_kat=2";
                                $result = mysqli_query($lin, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) {?> 
                                        <div class="col-sm-6 col-md-3 col-lg-2" style="margin:15px;">
                                            <a  href="../assets/images/galeria/<?php echo $row['velke']?>" data-lightbox="example-set-3" ><img src="../assets/images/galeria/<?php echo $row['male']?>" alt="praca" width=180 height=138 style="padding:5px;"/></a>
                                        </div>
                                    <?php }
                                } else {
                                    echo "0 results";
                                }
                            ?>
                    </div>            

                    <h2>Team</h2>
                    <div class="row d-flex flex-wrap">
                            <?php
                                $sql = "SELECT * FROM foto WHERE f_kat=4";
                                $result = mysqli_query($lin, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) {?> 
                                        <div class="col-sm-6 col-md-3 col-lg-2" style="margin:15px;">
                                        <a  href="../assets/images/galeria/<?php echo $row['velke']?>" data-lightbox="example-set-4"><img src="../assets/images/galeria/<?php echo $row['male']?>" alt="team" width=180 height=138 style="padding:5px;"/></a>
                                        </div>
                                    <?php }
                                } else {
                                    echo "0 results";
                                }
                            ?>
                    </div> 
                </div>
                                                  
            </div>
        </div>
    </div>
    <?php include (ROOT. "includes/footer.php") ?>

</body>
</html>