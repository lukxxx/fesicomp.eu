<div class="category-list kats_desktop">
    <div class="category-h d-flex align-items-center" style="border-radius: 15px 15px 0px 0px; ">
        <i style="padding: 8px 8px 8px 15px; font-size: 25px;" class="far fa-folder"></i><span style="padding:2px; font-size: 22px; ">Kategórie</span>
    </div>
    <div class="categories" style="border-radius: 0px 0px 15px 15px;padding: 0 0 10px;">
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
                    echo "<ol style='list-style: none;padding: 0'>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<div class='d-flex category-listing'>";
                        echo "<i class='fas fa-caret-right'></i><a class='category-listing-a' href='/kategoria/" . replaceAccents($row['k_nazov']) . "'><li style='padding-left: 8px; color: white;'>" . $row['k_nazov'] . "</li></a></div>";
                    }
                    echo "</ol>";
                } else {
                    echo "<span>POHUBENE</span>";
                } 
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
        
        ?>
    </div>
</div>


<div class="category-list kats_tablet ">
    <div class="category-h d-flex justify-content-between" style="border-radius: 15px 15px 0px 0px; ">
        <a data-toggle="collapse" href="#kats" role="button" aria-expanded="false" aria-controls="kats" style="color: white; font-size: 23px; padding: 1px; text-decoration: none;">
            <i style="padding: 8px 8px 8px 15px; font-size: 25px;" class="far fa-folder"></i><span style="padding:2px; font-size: 18px; ">Kategórie</span>
        </a>

        <a data-toggle="collapse" href="#kats" role="button" aria-expanded="false" aria-controls="kats">
            <i style="padding: 8px 15px 8px 8px; font-size: 24px; color: white; text-decoration: none;" class="catcollapse fas fa-arrow-right text-right"></i>
        </a>
    </div>
    <div class="categories collapse" style="border-radius: 0px 0px 15px 15px;padding: 0 0 10px;" id="kats">
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
                    echo "<ol style='list-style: none;padding: 0'>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<div class='d-flex category-listing'>";
                        echo "<i class='fas fa-caret-right'></i><a class='category-listing-a' href='/kategoria/" . replaceAccents($row['k_nazov']) . "'><li style='padding-left: 8px; color: white;'>" . $row['k_nazov'] . "</li></a></div>";
                    }
                    echo "</ol>";
                } else {
                    echo "<span>POHUBENE</span>";
                } 
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
        
        ?>
    </div>
</div>

<script>
    $(".catcollapse").click(function() {
        $(".fa-arrow-right").toggleClass("down");
    });
</script>

