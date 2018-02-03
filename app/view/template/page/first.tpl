<?php echo $header; ?>
<!--div>
    <img style="box-shadow: 0px 2px 5px #888888;" src="view/images/1.jpg" class="img-responsive" alt="">
</div-->
    <div style="padding-top:10px"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Today's Rate:<?php if($promotionurl !=""){?><a href="<?php echo $promotionurl; ?>" style="float:right">Promotion Code</a><?php }?></h3>
        </div>
        <div class="panel-body" >
        <?php 
        for( $i=0; $i < count($rates); $i++){
            echo $rates[$i]['name']; 
            ?>: Rs. <?php 
            echo $rates[$i]['rate'];
            ?></br>
            <?php
            } 
        ?>            
        </div>
    </div>
<?php echo $orderinfo; ?>
<?php echo $referapp; ?>

<div style="padding-top:30px">
    <div class="modal" id="cancel" style="padding-top:100px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
         
                <h4 class="modal-title">Please Confirm</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to cancel the order?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelorder" class="btn btn-default" >Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

            </div>
        </div>
    </div>
</div>
</div>
    <div class="transparentveiw" id="tview">
        <div class="div_help_pos animated bounceInUp">Help</div><a href="?page=register/user/help"  type="button" class="btn btn-danger btn-circle btn_help_pos animated bounceInUp" ><i class="glyphicon glyphicon-thumbs-up"></i></a>
       <div class="div_history_pos animated bounceInUp">History</div><a href="?page=register/user/history" type="button" class="btn btn-danger btn-circle btn_history_pos animated bounceInUp" ><i class="glyphicon glyphicon-header"></i></a>
       <div class="div_why_pos animated bounceInUp">Know more</div><a href="?page=register/user/why" type="button" class="btn btn-danger btn-circle btn_why_pos animated bounceInUp" ><i class="glyphicon glyphicon-question-sign"></i></a>
       <div class="div_address_pos animated bounceInUp">Pickup Later</div><a href="?page=register/user/checkout" type="button" class="btn btn-danger btn-circle btn_address_pos animated bounceInUp" ><i class="glyphicon glyphicon-time"></i></a>
       <div class="div_address_pos_now animated bounceInUp">Pickup Now</div><a href="?page=register/user/checkoutnow" type="button" class="btn btn-danger btn-circle btn_address_pos_now animated bounceInUp" ><i class="glyphicon glyphicon-play-circle"></i></a>
    </div>
    <button type="button" class="btn btn-danger btn-circle btn-xl btn_pos animated bounceInUp" id="infobutton"><i class="glyphicon glyphicon glyphicon-info-sign"></i></button>
    
<?php echo $button; ?> 
<?php echo $footer; ?>