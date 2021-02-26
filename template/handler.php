<?php 
if(isset($_POST['search'])){
    $term = $_POST['search'];
    header("Location: search-results.php?search=$term");
}

?>