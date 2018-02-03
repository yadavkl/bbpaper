<?php

echo $header; ?>
<div style="padding-top:15px">          
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Customer Details</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0;foreach($orders as $order){ ?> 
            <tr>
                <td><?php echo ++$i; ?></td>
                <td> <?php echo $order['customer']?></td>
                <td> <?php echo $order['time']?></td>
                <td>

                    <div class="icon-preview">
                        <button id='completepickup<?php echo $i; ?>' type="button" name="completepickup" value="<?php echo $order['statusid']; ?>" class="mdi-action-done" data-toggle="modal" data-target="#myModal"></button> </br></br>
                        <button id='cancelpickup<?php echo $i; ?>' type="button" name="cancelpickup" value="<?php echo $order['statusid']; ?>::<?php echo $order['time']; ?>::<?php echo $order['date']; ?>::<?php echo $order['areaid']; ?>" class="mdi-content-clear" data-toggle="modal" data-target="#cancelModal"></button>
                    </div>

                </td>
            </tr>
           <?php } ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<form action="?page=register/agent/complete" method="post">
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Enter Details</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group row">
                        <input type="number" step="0.01" min='0' class="form-control" name='weight' placeholder="Enter Quantity" aria-label="Quantity (to the nearest Gram)" required>
                        <span class="input-group-addon">Kg</span>
                    </div>   
                    <div class="input-group row">
                        <span class="input-group-addon">Order ID</span>
                        <input id='selecteduser' type="text" class="form-control" name='statusid' readonly>                 
                    </div>
                    
                    <div class="input-group row">
                        <span class="input-group-addon">Promotional Amount Rs. </span>
                        <input id='promotional' type="text" class="form-control" name='promotionamount' value="" readonly>                 
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="?page=register/agent/cancel" method="post">
    <div class="modal" id="cancelModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Enter Cancellation Details</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group row">

                        <input type="text" class="form-control" name='reason' placeholder="Reason for cancellation" aria-label="Cancellation Reason" required>
                        <span class="input-group-addon"></span>

                    </div>  
                    <div class="input-group row">
                        <span class="input-group-addon">Order ID</span>
                        <input id='canceluser' type="text" value="" class="form-control" name='statusid' readonly>                 
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div>
    <button type="button" data-toggle="modal" data-target="#message" class="btn btn-primary btn-lg btn-block" data-dismiss="modal" style="position: fixed; bottom: 0; width: 97%;">Send message</button>    
</div>
<form action="?page=register/agent/sendmessage" method="post">
    <div style="padding-top:30px">
        <div class="modal" id="message" style="padding-top:100px">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Please Confirm</h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to send message to all?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" >Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php echo $footer; ?>