<?php
require 'dbaccess.php';
require 'sessionaccess.php';
$uid = $_SESSION['uid'];
$movieresult = $conn->query("select * from movie");
$sql = "SELECT DISTINCT m.movie_id,m.title, m.image_link FROM movie m INNER JOIN orders o ON o.movie_id = m.movie_id WHERE o.customer_id ='$uid' and o.due_date>= NOW() ORDER BY o.date_ordered DESC";
$orderresult = $conn->query($sql);
?>
<html>
<head>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="style.css" />
    
    <link rel="stylesheet" href="owl/owl.carousel.css" type="text/css" />
 
    <!-- Default Theme -->
    <link rel="stylesheet" href="owl/owl.theme.css" type="text/css" />

    <!-- Include js plugin -->
    <script type="text/javascript" src="owl/owl.carousel.js"></script>
    
    <script type="text/javascript">
	$(document).ready(function() {		
            
        $(".form-div").click(function(){
            var $form = $(this).find('form');
            $form.submit();
        });
        
        $('#cartcount').click(function(){
                window.location = "payment_page.php";
            });
        
        $("#owl-example").owlCarousel(
            { items : 9, 
              itemsDesktop : [1400,7], 
              itemsDesktopSmall : [1100,5], 
              itemsTablet: [700,3], 
              itemsMobile : [400,1],
              navigation : true,
             scrollPerPage : true
            }
        );
         $("#owl-example1").owlCarousel(
            { items : 9, 
              itemsDesktop : [1400,7],
              itemsDesktopSmall : [1100,5],
              itemsTablet: [700,3], 
              itemsMobile : [400,1],
              navigation : true,
             scrollPerPage : true
            }
        );    
    });
	</script>

    
</head>
<body>

    <?php include 'header.php' ?>
    <h1 id="movies_main_h1">WATCH THESE MOVIES</h1>
    <div id="owl-example" class="owl-carousel" style="margin-left:20px;">
        <?php
            if ($movieresult->num_rows > 0) {
                // output data of each row
                while($row = $movieresult->fetch_assoc()) {
        ?>
        <div class="form-div">
            <form class="proform" action="movie_details.php" method="get">
                <input type="hidden" name="movieid" value="<?php echo $row['movie_id'] ?>" />                    
            </form>
            <img style="height:200px;width:auto;" src="<?php echo $row['image_link']; ?>" /> 
        </div>
        <?php
                }
            } else {
                echo "";
            }
        ?>
</div>

    <hr/>
    <h1 id="movies_main_h1">YOUR ACTIVE ORDERS</h1>
<div id="owl-example1" class="owl-carousel" style="margin-left:20px;">
        <?php
            if ($orderresult->num_rows > 0) {
                // output data of each row
                while($row = $orderresult->fetch_assoc()) {
        ?>
        <div class="form-div">
            <form class="proform" action="movie_details.php" method="get">
                <input type="hidden" name="movieid" value="<?php echo $row['movie_id'] ?>" />                    
            </form>
            <img style="height:200px;width:auto;" src="<?php echo $row['image_link']; ?>" /> 
        </div>
        <?php
                }
            } else {
                echo "";
            }
        ?>
</div>
    
    

</body>
</html>