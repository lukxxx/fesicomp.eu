<?php
require_once "../../includes/head-sub.php";
include "../../config.php";
//include "main.php";
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$date = date('d.m.y');
$nadpis = "Správa produktov";

if (isset($_COOKIE['admin'])) {
    if (isset($_POST['logout'])) {
        header("Location: gdbay.php");
    }
}
if (!isset($_COOKIE['admin'])) {
    header("Location: ../");
}


if (isset($_COOKIE['admin'])) { ?>
    <div class="container-fluid">
        <div class="row">
            <div style="background-color: #303030; width: 100%; height: 1080px" class="col-sm-2 col-md-2 col-lg-2">
                <?php include "../../includes/side-panel.php"; ?>
            </div>

            <div style="background-color: #F3F3F3; width: 100%; height: 1080px; padding: 0 !important" class="col-sm-10 col-md-10 col-lg-10 scroll">
                <?php include "../../includes/header-main.php"; ?>
                
                <hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
                <h3>Vyberte si zo zoznamu kategóriu, ktorej produkty si prajete upraviť</h3>
                <br>
                <h5>Alebo si kategórie vyhľadajte</h5><br>
                <!-- <form method="post" action="">
                        <div class="form-group has-search search-box" style="position: relative;z-index: 2;">
                                        
                            <input style="border-radius:30px;  outline: 0 !important; padding: 20px;" 
                                type="text" name="search" class="form-control search" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Hľadať výrobcov...'" autocomplete="off" placeholder="  Hľadať výrobcov..." >
                            <div class="result" style="display: none; margin-top: 10px"></div>
                                        
                        </div>
                    </form> -->
                <form method="post" action="">
                        <div class="form-group has-search search-boxi" style="position: relative;z-index: 2; ">
                                        
                            <input style="outline: 0 !important; padding: 20px 10px; margin: auto;" 
                                type="text" name="search" class="form-search-control prod-srch search" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Hľadať...'" autocomplete="off" placeholder="  Hľadať..." >
                                <i class="fas fa-search hladacik"></i><br>
                                <div class="result" style="display: none; margin-top: 10px; margin-right: 10%; flex-wrap: wrap; margin-left: 10%;"></div>
                                        
                        </div>
                    </form>
                <div class="row" style="padding: 40px">
                
                    <?php
                    $sth = $pdo->prepare("SELECT * FROM kategorie");
                    $sth->execute();;

                    $projects = array();
                    while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                        $projects[] = $row;
                    }
                    foreach ($projects as $project) {
                    ?>
                        <div class="col-sm-3 col-md-4 col-lg-3">
                            <div class="download-btn">

                                <div class="edit_k" style="display: none;">
                                    <a style="all: unset;" href="products.php?KID=<?php echo $project['k_kategoria'] ?>"><i class="far fa-edit"></i></a>
                                </div>
                                <div class="id_k">
                                    <span style="font-size: 24px; font-weight: bold; padding-top: 1%"><?php echo $project['k_id']; ?></span>
                                </div>
                                <div class="inner" >
                                    <div class="ano">
                                <div class=" nazovik">
                                        <span style="font-size: 24px; font-weight: bold; padding-top: 1%"><?php echo $project['k_nazov']; ?></span>
                                    </div>


                                </div>
                            </div>
                        </div>
                </div>
            <?php
                    }
            ?>
            </div>



        </div>
    </div>
    </div>
    <script>
        var span = document.getElementById('span');

        function time() {
            var d = new Date();
            var s = d.getSeconds();
            var m = d.getMinutes();
            var h = d.getHours();
            span.textContent =
                ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
        }

        setInterval(time, 1000);
    </script>
    <script>
        const url = 'atc-produkty.php';
        $('.download-btn-produkty').click(function() {
            $.get(url, function(data, status) {
                console.log('${data}')
            })
        })
    </script>
<?php } ?>