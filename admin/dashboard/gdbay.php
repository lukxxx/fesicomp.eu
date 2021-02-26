<?php 
if(isset($_COOKIE['admin'])){
    unset($_COOKIE['admin']);
    setcookie('admin', '', time() - 3600, '/');
    sleep(2);
    header("Location: ../");
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
.center {
  line-height: 200px;
  height: 200px;
  border: 3px solid green;
  text-align: center;
}

.center p {
  line-height: 1.5;
  display: inline-block;
  vertical-align: middle;
}
</style>
<script>

setTimeout(function () {
    window.location.href('../', '_blank');
}, 5000);
</script>
</head>
<body onload="setTimeout()">

<h2>Centering</h2>
<p>In this example, we use the line-height property with a value that is equal to the height property to center the div element:</p>

<div class="center">
  <p>Goodbay</p>
</div>

</body>
</html>