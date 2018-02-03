<?php echo $header; ?>
<form id="<?php echo $formid;?>">
    <fieldset>
       <legend style="padding-left:15px; padding-top:10px;">Select/Add Address</legend>
    </fieldset>
    </div>
        <table class="table table-bordered " >
            <?php for($i=0; $i < count($info); $i++)
            {
            ?>
            <tr>
                <td style="text-align:center; padding-top:14px;">
                    <input type="radio" name="address" value="<?php echo $info[$i]['customerinfoid'];?>" checked> 
                </td>
                <td>
                    <h5>
                    <?php 
                        echo $info[$i]['firstname']." ";  echo $info[$i]['lastname'].",";?></br>
                        <?php
                        echo $info[$i]['house']." ";  echo $info[$i]['street'].",";?></br>
                        <?php
                        echo $info[$i]['location']." ";  echo $info[$i]['area'].",\n";?></br>
                        <?php
                        echo $info[$i]['landmark']." ";  echo $info[$i]['pincode']."\n";
                    ?>
                    </h5>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        
 
    	<div style="text-align:left;">
        <a href="?page=register/user/userinfo" type="button" class="btn btn-default btn-sm form-group">
        <span class="glyphicon glyphicon-plus">  <span>
        </span>
        </span> Add new Address </a>
        
        <?php if( count($info) > 0) { ?>
        
        <a href="?page=register/user/removeinfo" id='deleteaddress' type="submit" class="btn btn-default btn-sm form-group">
        <span class="glyphicon glyphicon-minus"><span>
        </span>
        </span> Remove Address </a>
        
        <?php } ?>

    </div></br>     
       
    <?php if( count($info) != 0 ){ ?>
    
    <div class="form-group">
        <div style="padding-top:30px"></div>
        <?php echo $button; ?>
        
    </div>
    <?php } ?>
    
</form>

<?php echo $footer; ?>