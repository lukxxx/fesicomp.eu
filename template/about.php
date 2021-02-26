<?php 
    include_once "../includes/head-template.php";
    include (ROOT ."includes/header-template.php");?>
    <div class="container" style="padding: 20px 13px 0 10px">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-8">
                <h2>O nás</h2>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6" >
                        <img src="../assets/images/firma2_v.jpg" alt="firma" class="container-fluid" style="border-radius: 10px;" width="450px" height="auto" >
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                    <p>Firma FESI comp, s.r.o. ma dlhodobé skúsenosti v pôsobení zaoberajúcim sa servisom a predajom výpočtovej  techniky a registračných pokladní . Preto jedným z hlavných cieľov  firmy je dodať kvalitný a odborný servis a poradenstvo v oblasti výpočtovej techniky a samozrejmosžou je aj dodanie  počítačových zostav  a príslušenstva. Zabezpečujeme záruční servis na kompletnú paletu tovarov ktorú zabezpečuju vyškolení technici a pozáruční servis na tlačiarne , počítačové zostavy atd. V súčasnosti sa firma začala zaoberať plnením atramentových kaziet do tlačiarni a aj predaj plniacich atramentov a prípravkov. Ďalším cieľom firmy  je zabezpečiť čo najnižšiu cenu vzhľadom na stále rastúci trh. Naše krédo “výpočtová technika za rozumne ceny”.</p>
                    </div>
                </div>
                <div style="margin: 50px auto 100px auto;">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p>Dňom 8.9.2008 firma sa presťahovala do vlastných priestorov na Duklianskej ul. 3A v Spišskej Novej Vsi.</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <img src="../assets/images/10rokov1.gif" alt="10rokov" width="400px" height="auto">
                    </div>
                </div>
                <div class="row">
                    <div>
                        <h2>Certifikáty</h2>
                        <?php
                            $lin = mysqli_connect('127.0.0.1', 'root', '', 'compsnv');
                            if($lin === false){
                                die("ERROR: Could not connect. " . mysqli_connect_error());
                            }

                            $sql = "SELECT * FROM foto WHERE f_kat=3 AND f_velkost=1";
                            $result = mysqli_query($lin, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo '<img src="../assets/images/galeria/'.$row['nazov'].'" alt="">';
                                }
                            } else {
                                echo "0 results";
                            }
                        ?>
                    </div>
                
                </div>
                <div>
                    <h2>Fotogaléria</h2>
                    <?php
                        $lin = mysqli_connect('127.0.0.1', 'root', '', 'compsnv');
                        if($lin === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM foto WHERE f_kat=1 AND f_velkost=1 OR f_velkost=3";
                        $result = mysqli_query($lin, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<img src="../assets/images/galeria/'.$row['nazov'].'" alt="" width=120 height=auto>';
                            }
                        } else {
                            echo "0 results";
                        }
                    ?>
                </div>                
            </div>
        </div>
    </div>
    <?php include (ROOT. "includes/footer.php") ?>

</body>
</html>