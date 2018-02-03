<?php

echo $header; ?>
<form action="?page=register/user/placeorder" method="post" onsubmit="document.getElementById('confirmorder').disabled = true;
        document.getElementById('confirmorder').value = 'Submitting, please wait...';">

    <fieldset>
        <legend style="padding-left:15px; padding-top:10px;">Pick Up Date & Time</legend>
        <div class="container" style="background-color:white; padding-top:10px;">
            <div class="form-group">
                <label for="selectDate" class="col-lg-2 control-label">Select Date</label>
                <div class="col-lg-10">
                    <select class="form-control" name="date" id="date">
                        <option selected="true" disabled="disabled">PickUp Date</option>
                        <!--option><?php echo $today;?></option-->
                        <option><?php echo $tomorrow;?></option>
                        <option><?php echo $nextday;?></option>
                        <option><?php echo $nexttonext;?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selectDate" class="col-lg-2 control-label">Select Time</label>
                <div class="col-lg-10">
                    <select class="form-control" name="slot" id="time">   
                        <option selected="true" disabled="disabled">PickUp Time</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="selectDate" class="col-lg-2 control-label">You have earned promotional Amount Rs. <?php echo $amount ?> </label>
                <div class="col-lg-10">
                    <input type="checkbox" name="redeme" value="yes" >Reimbers Promotional Amount
                </div>
            </div>

        </div>
        <div style="padding-top:30px"><?php echo $message;?></div>
        <button id="confirmorder" class="btn btn-lg btn-primary btn-block" value="Confirm" style="position: fixed; bottom: 0; width: 47%;">Confirm </button>

    </fieldset>
</form>
<a href="<?php echo $homepageurl; ?>"><button class="btn btn-lg btn-primary btn-block" style="position: fixed; left:49%;bottom: 0; width: 47%;padding-left: 1px;">No Thanks </button></a>
<?php echo $footer; ?>