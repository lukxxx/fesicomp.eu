<?php
$kidik = $_GET['KID'];
include "../../config.php";
if (isset($_REQUEST["term"]) && strlen($_REQUEST['term']) >= 3) {
    $var = $_REQUEST["term"];
    $vyr = "SELECT p_nazov, p_kid_sklad, p_id, p_img FROM produkty WHERE p_nazov LIKE '%$var%' OR p_id LIKE '%$var%' AND p_kid_sklad LIKE '%$kidik%' LIMIT 20";
    if ($stmt = mysqli_prepare($link, $vyr)) {

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $projects = array();
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $projects[] = $row;
                }
                foreach ($projects as $project) {
?>
                    <div class="col-sm-3 col-md-4 col-lg-3">
                        <div class="download-btn" style="padding: 20px 20px 20px 87px;">

                            <div class="edit_k" style="display: none;">
                                <a style="all: unset;" href="product.php?PID=<?php echo $project['p_id'] ?>"><i class="far fa-edit"></i></a>
                            </div>
                            <div class="id_k" style="width: 25%;">
                                <span style="font-size: 18px; font-weight: bold; padding-top: 1%"><?php echo $project['p_id']; ?></span>
                            </div>
                            <div class="inner">
                                <div class="ano">
                                    <div class="obrazok">
                                        <?php
                                        $product_id = $project['p_id'];
                                        $product_img = $project['p_img'];

                                        if (file_exists("../../../catalog/$product_id/$product_img")) {
                                            $cesta = "../../../catalog/$product_id/$product_img";
                                        } else {
                                            $cesta = "../../../assets/images/no-image-admin.png";
                                        }
                                        ?>
                                        <img style="width: 65%;" src="<?php echo $cesta; ?>">
                                    </div>
                                    <div class=" nazovik">
                                        <span style="font-size: 18px; font-weight: bold; padding-top: 1%"><?php echo $project['p_nazov']; ?></span>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
                        $('.download-btn').hover(

                            function() {
                                $(this).children('.edit_k').fadeIn("fast");
                            },

                            function() {
                                $(this).children('.edit_k').fadeOut("fast");
                            }
                        );
                    </script>
<?php
                }
            } else {
                echo "<p>Nič sme nenašli</p>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    mysqli_stmt_close($stmt);
} else if (isset($_REQUEST["term"]) && strlen($_REQUEST['term']) <= 3) {
    echo "Píšte ďalej...";
}

mysqli_close($link);
?>