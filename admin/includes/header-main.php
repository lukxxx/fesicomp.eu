
<div class="row d-flex" style="padding: 20px;">
                    <div class="col-md-4 col-lg-4 d-flex" style="padding-left: 40px">
                        <i style="padding-top: 3%; color: #C21800" class="fas fa-clock"></i><span style="font-size: 30px;font-weight: bold;vertical-align: middle; padding-left: 5px;" id="span"></span>
                        <i  style="padding-top: 3%; padding-left: 80px; color: #C21800" class="fas fa-calendar-alt"></i> <span style="font-size: 30px;font-weight: bold;vertical-align: middle; padding-left: 5px;"><?php echo $date ?></span>       
                    </div>
                    <div class="col-md-4 col-lg-4 d-flex">
                        <div style="border-left: 2px solid black; height: 50px; padding: 0px 50px 0px 50px"></div>
                        <h3 style="font-weight: bold;"><?php echo $nadpis ?></h3>           
                        <div style="border-left: 2px solid black; height: 50px; margin: 0px 0px 0px 100px"></div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="logout d-flex justify-content-end">
                            <a style="color: back;" href="./profile"><span style="color: black"><?php echo $_COOKIE['admin'] ?> </span></a>
                            <form method="post" action="#">
                                <button style="all: unset; cursor: pointer; padding-right: 30px" type="submit" name="logout"><i style="padding-left: 20px" class="fas fa-sign-out-alt"></i></button>
                            </form>
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