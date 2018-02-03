<?php echo $header; ?>

<?php if( $history != "" )foreach($history as $order) {  ?>

<a href="?page=register/user/receipt&id=<?php echo $order['orderid']; ?>" >
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="thumbnail">
          <img src="view/images/1.jpg" class="img-responsive" >
            <div class="container" style="padding-top:5px;">
                <div  class="col-xs-4 col-sm-4">
                    <h5>Date: <?php echo $order['cdate']; ?></h5>
                </div>
                 <div class="col-xs-4 col-sm-4">
                     <h5>Amount: <?php echo $order['payment']; ?></h5>
                </div>
                <div class="col-xs-4 col-sm-4">
                     <h5>Status: <?php echo $reason[$order['status']]; ?></h5>
                </div>
            </div>
        </div>
      </div>
    </div>
</a>

<?php } ?>

<?php echo $footer; ?>