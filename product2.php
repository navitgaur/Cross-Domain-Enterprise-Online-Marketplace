<?php
session_save_path('/tmp');
session_start();
if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
  header( 'Location: login.php' );
}
$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];
// = get_product($product_id);
$dsn = 'mysql:host=mysql;dbname=onlinemarket';
$username = 'root';
$password = 'password';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO($dsn, $username, $password, $options);

$query = "SELECT * FROM Products WHERE id = '$product_id'";
$product = $db->query($query)->fetch();
$query_counter = "UPDATE Products SET visit_count = visit_count + 1 WHERE id = '$product_id'";
$db->query($query_counter);
$query_comment = "SELECT * FROM Comments WHERE product_id = '$product_id' ORDER BY id DESC";
$reviews = $db->query($query_comment)->fetchAll();

$username = $_SESSION['user'];
$productTitle = $product['title'];
$productCompany = $product['company'];

$last_viewed_query = "insert into last_viewed (username,product_id,product_title,company) values ('$username','$product_id','$productTitle','$productCompany');";
$db->query($last_viewed_query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("view/header.php"); ?>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "cb89e0c0-7a3d-4ba0-80d6-3779c265d27d", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
</head>
<body>
<?php include("view/navigation.php"); ?>
<div class="container hidden" id="product_details" data-id="<?php echo $product_id; ?>" data-company="<?php echo $product['company']; ?>"
data-username="<?php echo $_SESSION['user_name']; ?>" data-userid="<?php echo $_SESSION['user_id']; ?>">
    <h1 style="text-align:center"><?php echo $product['title']; ?></h1>
    <h2 style="text-align:center">Company: <?php echo $product['company']; ?></h2>
     <?php
        $query = "SELECT AVG( rating_quality ) AS quality_avg
        FROM Comments
        WHERE product_id = '$product_id'
        AND rating_quality > 0";
        $quality_avg = $db->query($query)->fetch();

        $query = "SELECT AVG( rating_service ) AS service_avg
        FROM Comments
        WHERE product_id = '$product_id'
        AND rating_service > 0";
        $service_avg = $db->query($query)->fetch();
        ?>      
 
    <p style="text-align:center;"><img align="middle" style="max-height:400px;" src="<?php echo $product['image_link']; ?>" ></p>
       <p style="text-align:center;"><b>Quality: </b><input id="input-5b" value = "<?php echo $quality_avg['quality_avg'];?>" class="rating" data-disabled="true" data-size="xs" data-symbol="&#xe005;" data-show-clear="false" data-show-caption="false" data-default-caption="{rating} hearts" data-star-captions="{}">
    <b>Customer Service: </b><input id="input-5b" value = "<?php echo $service_avg['service_avg'];?>" class="rating" data-disabled="true" data-size="xs" data-symbol="&#xe005;" data-show-clear="false" data-show-caption="false" data-default-caption="{rating} hearts" data-star-captions="{}"></p>
 
    <p style="text-align:center;"><?php echo $product['body']; ?></p>
    <div style="text-align:center;">
    <span class='st_facebook_large' displayText='Facebook'></span>
    <span class='st_twitter_large' displayText='Tweet'></span>
    <span class='st_email_large' displayText='Email'></span>
</div>
</div>

<div class="container hidden">


<form class="form-horizontal center" id="savecomment" >
    <fieldset style="text-align:center">
        <h3>Add a Review</h3>
<!--        <input type="hidden" name="artwork_id" value="--><?php //echo $artwork_id; ?><!--">-->
<!--<div>-->
<!--        <label class="radio-inline">-->
<!--            <input type="radio" checked name="rating" id="inlineRadio1" value="1"> 1-->
<!--        </label>-->
<!--        <label class="radio-inline">-->
<!--            <input type="radio" name="rating" id="inlineRadio2" value="2"> 2-->
<!--        </label>-->
<!--        <label class="radio-inline">-->
<!--            <input type="radio" name="rating" id="inlineRadio3" value="3"> 3-->
<!--        </label>-->
<!--        <label class="radio-inline">-->
<!--            <input type="radio" name="rating" id="inlineRadio3" value="4"> 4-->
<!--        </label>-->
<!--        <label class="radio-inline">-->
<!--            <input type="radio" name="rating" id="inlineRadio3" value="5"> 5-->
<!--        </label>-->
<!---->
<!--</div>-->
        <div class="col-md-offset-3 col-md-6">
            <label style="margin-bottom: 0">Rate Quality</label>
            <input id="input-quality" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="sm" data-symbol="&#xe005;" data-default-caption="{rating} hearts" data-star-captions="{}" >
            <label style="margin-bottom: 0">Rate Customer Service</label>

            <input id="input-service" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="sm" data-symbol="&#xe005;" data-default-caption="{rating} hearts" data-star-captions="{}">

            <div class="control-group">
            <label for="comment">Comment</label>

            <textarea class="form-control review_text" cols="2" rows="5" name="comment" id="comment"></textarea>
        </div>

        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
<!--                --><?php //if(!isset($_SESSION)) :?>
<!--                    <button type="button" name="submit" value ="Save" class="btn btn-success btn-sm save-comment" >Save Comment</button>-->
<!---->
<!--                --><?php //else :?>
                    <button type="submit" name="submit" value ="Save" class="btn btn-success btn-sm save-comment" >Add Review</button>
<!--                <button class="btn btn-success btn-sm save-comment" >Save Comment</button>-->

                <!--                --><?php //endif;?>

        </div>
        </div>

    </fieldset>
</form>

    <h2 id="comments" style="text-align:center">Reviews</h2>


    <?php if($reviews != null):?>

        <?php
        foreach($reviews as $r):?>
            <?php if($r != null):?>

                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align:center;">
                 <?php if($r['user_id'] == $user_id ):?>
                       <h3 class="panel-title"><?php echo $r['username']; ?><b style="margin-left:40px">Quality Rating:</b> <?php echo $r['rating_quality']; ?>
                                <b style="margin-left:40px">Customer Service Rating:</b> <?php echo $r['rating_service']; ?>
                            <a href="delete_review.php?comment_id=<?php echo $r['id']?>&product_id=<?php echo $r['product_id']?>"
                            style="color: #18bc9c;" class="pull-right" >Delete
                    </a></h3>

                    <?php else:?>
                              <h3 class="panel-title"><?php echo $r['username']; ?><b style="margin-left:40px">Quality Rating:</b> <?php echo $r['rating_quality']; ?>
                                <b style="margin-left:40px">Customer Service Rating:</b> <?php echo $r['rating_service']; ?>
                            </h3>

                   <?php endif;?>

                    </div>
                    <div class="panel-body" style="text-align:center;">
                        <?php echo $r['text']; ?>
                    </div>

                </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>
</div>

<script src="lib/lib/jquery/dist/jquery.min.js")"></script>
<script src="lib/lib/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="lib/lib/star-rating.min.js"></script>
<script src="lib/lib/DataTables-1.10.7/media/js/jquery.dataTables.min.js"></script>
<script src="lib/lib/main.js"></script>
<script>


    $("#savecomment").on('submit',(function(e) {
        console.log('save-comment click');

           var id  = $( "#product_details" ).attr( "data-id" );
//        var username  = $( "#product_details" ).attr( "data-username" );
//        var company = $( "#product_details" ).attr( "data-company" );
        var textarea = $('.review_text').val();
        var userid = $( "#product_details" ).attr( "data-userid" );

        //console.log(id);

//        var dataString = 'id='+ id
//            + '&user_name=' + $_SESSION['user_name'];

        var data = {'id': id, 'rating_quality': $( "#input-quality" ).val(), 'user_id': userid,
            'rating_service': $( "#input-service" ).val(), username: $( "#product_details" ).attr( "data-username"),
        company: $( "#product_details" ).attr( "data-company"), text: textarea };

        $.ajax({
            url: "save_review.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            //dataType: 'json',
            success: function(data)   // A function to be called if request succeeds
            {
               console.log(data);
//                location.href = "http://www.tugceakin.com/onlinemarket/";
               window.location.reload();

            }
            ,
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
        }
    });
        e.preventDefault();
    }));

</script>
</body>
</html>