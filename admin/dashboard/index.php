<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/includes/head.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/config.php";

$date = date('d.m.y');

$date_day = date('d.m');
$date_mon = date('m');
$date_month = "." . $date_mon . ".";
$date_year = date('y');

$like_day = "%" . $date_day . "%";
$sth = $pdo->prepare("SELECT * FROM visitors WHERE visit_date LIKE ?");
$sth->execute(array($like_day));
$rowcount_day = $sth->rowCount();

$like_month = "%" . $date_month . "%";
$sth = $pdo->prepare("SELECT * FROM visitors WHERE visit_date LIKE ?");
$sth->execute(array($like_month));
$rowcount_month = $sth->rowCount();


$like_year = "%" . $date_year . "%";
$sth = $pdo->prepare("SELECT * FROM visitors WHERE visit_date LIKE ?");
$sth->execute(array($like_year));
$rowcount_year = $sth->rowCount();


$nadpis = "FESICOMP.EU";
if (isset($_COOKIE['admin'])) {
    if (isset($_POST['logout'])) {
        header("Location: /admin");
    }
}
if (!isset($_COOKIE['admin'])) {
    header("Location: /admin");
}
if (isset($_COOKIE['admin'])) { ?>
    <div class="container-fluid">
        <div class="row">
            <div style="background-color: #303030; width: 100%; height: 1080px" class="col-sm-2 col-md-2 col-lg-2">
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/includes/side-panel.php"; ?>
            </div>

            <div style="background-color: #F3F3F3; width: 100%; height: 1080px; padding: 0 !important" class="col-sm-10 col-md-10 col-lg-10 scroll">
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/includes/header-main.php"; ?>
                <hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
                <div class="row" style="padding: 40px">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="stats" style="border: 1px solid #E7E7E7; padding-left: 3%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                            <div class="row">
                                <h4 style="font-size: 30px; font-weight: bold; padding-top: 1%">Štatistiky</h4>
                            </div>
                            <div class="row d-flex" style="padding: 30px">
                                <div class="col-md-4 col-lg-4 d-flex">
                                    <span>Počet zobrazení za deň: <span class="stat-number"><?php echo $rowcount_day; ?></span></span>
                                </div>
                                <div class="col-md-4 col-lg-4 d-flex">
                                    <span>Počet zobrazení za mesiac: <span class="stat-number"><?php echo $rowcount_month; ?></span></span>
                                </div>
                                <div class="col-md-4 col-lg-4 d-flex">
                                    <span>Počet zobrazení za rok: <span class="stat-number"><?php echo $rowcount_year; ?></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px 40px 10px 40px">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="stats" style=" height: 350px;border: 1px solid #E7E7E7; padding-left: 5%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                            <div class="row">
                                <?php
                                $sth = $pdo->prepare("SELECT * FROM faktury LIMIT 7");
                                $sth->execute();
                                $rowcount_z = $sth->rowCount();
                                ?>
                                <h4 style="font-size: 30px; font-weight: bold; padding-top: 1%">Nové objednávky (<?php echo $rowcount_z; ?>)</h4>
                            </div>
                            <div class="row d-flex" style="padding-right: 30px">
                                <table class="table table-striped table-sm">
                                    <thead align="left">
                                        <tr align="left">
                                            <th scope="col">Email</th>
                                            <th scope="col">Meno</th>
                                            <th scope="col">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr align="left">
                                                <td scope="row"><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['meno'] . " " . $row['priezvisko']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <?php
                        $sth = $pdo->prepare("SELECT email, meno, priezvisko, mesto FROM users UNION SELECT email, meno, priezvisko, mesto FROM g_users LIMIT 7");
                        $sth->execute();
                        $rowcount_z = $sth->rowCount();
                        ?>
                        <div class="stats" style="height: 100%;border: 1px solid #E7E7E7; padding-left: 5%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                            <div class="row">
                                <h4 style="font-size: 30px; font-weight: bold; padding-top: 1%">Registrovaní zákazníci (<?php echo $rowcount_z; ?>)</h4>
                            </div>
                            <div class="row d-flex" style="padding-right: 30px">
                                <table class="table table-striped table-sm">
                                    <thead align="left">
                                        <tr align="left">
                                            <th scope="col">Email</th>
                                            <th scope="col">Meno</th>
                                            <th scope="col">Mesto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr align="left">
                                                <td scope="row"><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['meno']; ?></td>
                                                <td><?php echo $row['mesto']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 40px">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="stats" style="border: 1px solid #E7E7E7; padding-left: 3%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                            <div class="row d-flex">
                                <h4 style="font-size: 30px; font-weight: bold; padding-top: 1%">Zárobky</h4><span style="font-weight: 700;color: red;font-size: 12px;margin-top: 19px;margin-left: 5px;">
                                BETA</span><span style=" padding: 10px 0px 0px 20px"> (údaje sú približné a nemusia zodpovedať realite)</span>
                            </div>
                            <div class="row d-flex" style="padding: 30px">
                                <div class="col-md-4 col-lg-4 d-flex">
                                    <span>Výnosy za deň: <span class="stat-number">780€</span></span>
                                </div>
                                <div class="col-md-4 col-lg-4 d-flex">
                                    <span>Výnosy za mesiac: <span class="stat-number">4560.43€</span></span>
                                </div>
                                <div class="col-md-4 col-lg-4 d-flex">
                                    <span>Výnosy za rok: <span class="stat-number">552 452 000€</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
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
<?php } ?>