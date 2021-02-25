<?php
if(isset($_GET['ID'])){
    $id = $_GET['ID'];
    $sql = "SELECT * FROM parametre,parametrecis WHERE parametre.p_kod_parametru = parametrecis.pc_kod AND parametre.p_kod =(SELECT p_kod_sklad FROM produkty WHERE p_id='$id') ORDER BY parametrecis.pc_poradie ASC";
}   //"SELECT * FROM parametre,prametrecis WHERE parametre.p_kod_parametru = prametre.pc_kod AND ";
      //(SELECT p_kod_sklad FROM produkty WHERE p_id='$id') SELECT * FROM parametrecis WHERE pc_kod ='$p_kod'";
if ($stmt = mysqli_prepare($link, $sql)) {

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            ?><div class="row">
                <table class="col-12">
                    <thead>
                        <tr>
                        <th scope="col">Parameter</th>
                        <th scope="col">Hodnota</th>
                        </tr>
                    </thead>
            <?php
            
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
               
                ?>    
                    <tr>
                        <td><?php echo $row['pc_nazov']?></td>
                        <td><?php echo $row['p_hodnota']?></td>
                    </tr>
                <?php
            }
            ?>
                </tbody>
            </table>
            </div>
            <?php
        } else {
            echo "<span>POHUBENE</span>";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
} ?>