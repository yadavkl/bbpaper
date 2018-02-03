<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Order Info:</h3>
    </div>
    <div>
    <table class=" panel-body table">
        <tr>
            <td><h5><strong> Pick Up Date: </strong></h5></td>
            <td> <h5><?php echo $order[0]['bookeddate']; ?></h5></td>
        </tr>
        <tr>
            <td><h5><strong> Pick Up Time: </strong></h5></td>
            <td><h5> <?php echo $order[0]['bookedslot']; ?> </h5> </td>
        </tr>
        <tr>
            <td> <h5><strong> Pick Up Location: </strong></h5></td>
            <td><h5><?php echo $order[0]['area']; ?></h5></td>
        </tr>
    </table>
    <table class=" panel-body table">
        <tr>
            <td align="center" style="width:80px;"><img class="img-circle" style="width:70px; height:70px"src="view/images/<?php echo $order[0]['image']; ?>" alt="Responsive image"> </td>
                        
            <td align="left"> 
                <h5> <strong> Name: </strong><?php echo $order[0]['agentname']; ?></h5>   
                <h5> <strong> Phone: </strong><a href="tel:<?php echo $order[0]['phone']; ?>" > <?php echo $order[0]['phone']; ?> </a> </h5>     
            </td>
        </tr>
    </table>
    </div>
</div>