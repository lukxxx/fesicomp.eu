<?php
include "../../includes/head-sub.php";
include "../../config.php";
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
                    <div class="form-group has-search search-boxy" style="position: relative;z-index: 2; ">

                        <input style="outline: 0 !important; padding: 20px 10px; margin: auto;" type="text" name="search" class="form-search-control prod-srch search" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Zadajte názov alebo ID produktu...'" autocomplete="off" placeholder="Zadajte názov alebo ID produktu...">
                        <i class="fas fa-search hladacik"></i><br>
                        <div class="result" style="display: none; margin-top: 10px; margin-right: 10%; flex-wrap: wrap; margin-left: 10%;"></div>

                    </div>
                </form>
                <div class="row" style="padding: 40px">
                    <?php
                    $kid = $_GET['KID'];

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $no_of_records_per_page = 24;
                    $offset = ($page - 1) * $no_of_records_per_page;
                    $total_pages_sql = "SELECT COUNT(*) FROM produkty WHERE p_kid_sklad LIKE '%$kid%'";
                    $result = mysqli_query($link, $total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);


                    $sth = $pdo->prepare("SELECT * FROM produkty WHERE p_kid_sklad LIKE '%$kid%' LIMIT $offset, $no_of_records_per_page");
                    $sth->execute();

                    $projects = array();
                    while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                        $projects[] = $row;
                    }
                    foreach ($projects as $project) {
                    ?>
                        <div class="col-sm-3 col-md-4 col-lg-3">
                            <div class="download-btn" style="padding: 20px 20px 20px 87px;">

                                <div class="edit_k" style="display: none;">
                                    <a style="all: unset;" href="product.php?PID=<?php echo $project['p_id'] ?>"><i class="far fa-edit"></i></a>
                                </div>
                                <div class="id_k">
                                    <span style="font-size: 18px; font-weight: bold; padding-top: 1%"><?php echo $project['p_id']; ?></span>
                                </div>
                                <div class="inner">
                                    <div class="ano">
                                        <div class="obrazok">
                                            <img src="../../../catalog/<?php echo $project['p_id']; ?>/<?php echo $project['p_img']; ?>">
                                        </div>
                                        <div class=" nazovik">
                                            <span style="font-size: 18px; font-weight: bold; padding-top: 1%"><?php echo $project['p_nazov']; ?></span>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row d-flex justify-content-center" style="margin: auto">
                        <ul class="pagination ">
                            <?php if ($page > 1) : ?>
                                <li class="prev"><a href="#" onclick="updateURLParameter(window.location.href, 'page', '<?php print($page - 1) ?>' )">Predchádzajúca</a></li>
                            <?php endif; ?>

                            <?php if ($page > 3) : ?>
                                <li class="start"><a href="#" onclick="updateURLParameter(window.location.href, 'page', '1');return false;">1</a></li>
                                <li class="dots">...</li>
                            <?php endif; ?>

                            <?php if ($page - 2 > 0) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page - 2) ?> )"><?php echo $page - 2 ?></a></li><?php endif; ?>
                            <?php if ($page - 1 > 0) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page - 1) ?> )"><?php echo $page - 1 ?></a></li><?php endif; ?>

                            <li class="currentpage"><a href="?KID=<?php echo $kid ?>&page=<?php echo $page ?>"><?php echo $page ?></a></li>

                            <?php if ($page + 1 < ceil($total_pages) + 1) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page + 1) ?> )"><?php echo $page + 1 ?></a></li><?php endif; ?>
                            <?php if ($page + 2 < ceil($total_pages) + 1) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page + 2) ?> )"><?php echo $page + 2 ?></a></li><?php endif; ?>

                            <?php if ($page < ceil($total_pages) - 2) : ?>
                                <li class="dots">...</li>
                                <li class="end"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($total_pages) ?> )"><?php echo ceil($total_pages) ?></a></li>
                            <?php endif; ?>

                            <?php if ($page < ceil($total_pages)) : ?>
                                <li class="next"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page + 1) ?> )">Ďalšia</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            function debounce(func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this,
                        args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            };
            let kid = $(location).attr('search')
            console.log(kid);
            $('.search-boxy input[type="text"]').on('keyup', debounce(function() {
                $("#book").slideDown("slow");
                $('.result').css({
                    display: 'flex'
                });

                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("search-products.php" + kid, {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        window.setTimeout(resultDropdown.html(data), 1000);
                    });
                } else {
                    resultDropdown.empty();
                    $('.result').css({
                        display: 'none'
                    });
                }
            }, 1000));
            
            $(document).mouseup(function(e) {
                var container = $(".result");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });
            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
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