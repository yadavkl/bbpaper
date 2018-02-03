<?php echo $header; ?>
    <form  action="?page=register/user/register" method="post">
    <fieldset>
        <legend style="padding-left:15px;">Register</legend>
         <div class="form-group">
            <label for="Area" class="col-lg-2 control-label">Service Areas</label>
            <div class="col-lg-10">
                <select class="form-control" name="area" id="sel1" required>
                     <option value="" disable="disabled">--Select--</option>
                    <?php foreach($arealist as $area){ ?>
                    <option value="<?php echo $area['areaname'];?>"><?php echo $area['areaname'];?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="firstname"  placeholder="Firstname" required autofocus>
                 <input type="text" class="form-control" name="lastname"  placeholder="Lastname" required >
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label floating-label">Email</label>
            <div class="col-lg-10">
                <input type="email" class="form-control" name="email"  placeholder="Email Address" required >
            </div>
        </div>
        <div class="form-group">
            <label for="phone" class="col-lg-2 control-label">Contact Number</label>
            <div class="col-lg-10">
                <input type="tel" maxlength='10' autocomplete="on" class="form-control" name="mobile" placeholder="Mobile Number" required>
            </div>
        </div>
        <div class="form-group">
            <label for="Address" class="col-lg-2 control-label">Address</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="house" placeholder="House Number" required>
                <input type="text" class="form-control" name="street" placeholder="Street Name " required>
                <input type="text" class="form-control" name="loc" placeholder="Location/Area/Zone" required>
                <input type="text" class="form-control" name="land"placeholder="Landmark (Optional)" >
                <input type="tel" pattern="[0-9]*" maxlength='6' class="form-control" name="pin" placeholder="Pincode" required>
            </div>
        </div>
        <?php if( !$isrefered  ) { ?>
        <div class="form-group">
            <label for="phone" class="col-lg-2 control-label">Promotion Code</label>
            <div class="col-lg-10">
                <input type="text" maxlength='6' autocomplete="on" class="form-control" name="referedby" placeholder="Promotion Code" required>
            </div>
        </div>
        <?php } ?>
        <div class="form-group">
            <div>
                <div style="padding-top:30px"></div>
                <button type="submit" class="btn btn-lg btn-primary btn-block" style="position: fixed; bottom: 0; width: 97%;">Register</button>
            </div>
        </div>
</fieldset>
</form>

<?php echo $footer; ?>