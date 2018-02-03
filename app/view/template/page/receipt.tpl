<?php echo $header; ?>

<div class="panel panel-primary">
    <div class="panel-heading">
         <h2 class="panel-title"><strong>Receipt</strong></h2>
    </div>
    <div class="panel-body">
        <p>Dear User, Thank you for ordering with Buy Bye Paper!!</p>
        <p> Your Transaction Id is rdwala<?php echo $details['orderid']; ?></p>
    </div>
</div>

<div class="container">
	<table class="table table-bordered thumbnail">
		<thead>
		  <tr>
			<th>Rate</th>
			<th>Weight</th>
			<th>Total</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td>Rs. <?php 
                if( $details['status'] == 1 && $details['quantity'] != 0 ){
                    echo ( $details['payment']/$details['quantity']) ; 
                }else{
                    echo "0";
                }
            
            ?></td>
			<td><?php echo $details['quantity']; ?> Kg</td>
			<td>Rs. <?php echo $details['payment']; ?></td>
		  </tr>
			<tr>
			<td></td>
				<td><strong>Grand Total : </strong> </td>
			<td> <strong>Rs. <?php echo $details['payment']; ?></strong></td>				
		  </tr>
		</tbody>
	</table>
</div></br>

<div class="container">

    <div class="thumbnail" style="padding-left:15px;"></br>
        
        <p><strong> Order Status :</strong><?php echo $reason[$details['status']]; ?></p>
        <?php 
        	if( $details['status'] == 3){
        ?>
        	<p><strong> Cancel Date :</strong><?php echo $details['cdate']; ?></p>
        	<p><strong> Cancellation Reason:</strong>You had cancelled order.</p>
	<?php
        	}
        	else if( $details['status'] == 2){

        ?>
        	<p><strong> Cancel Date :</strong><?php echo $details['cdate']; ?></p>
        	<p><strong> Cancellation Reason:</strong><?php echo $reason[$details['comment']]; ?></p>
        	
        <?php }else{ ?>
        	<p><strong> Pickup Date :</strong><?php echo $details['cdate']; ?></p>
        <?php } ?>
        <p> We would like to hear from you again.</p>    
    </div>
    
</div>

<?php echo $footer; ?>