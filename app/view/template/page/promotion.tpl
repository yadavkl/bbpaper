<?php

echo $header; ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Add Promotion Code:</h3>
    </div>
    <div class="panel-body" >
        <form  action="?page=register/user/refer" method="post">
            <fieldset>
                <legend style="padding-left:15px;">Add Code</legend>
                <div class="form-group">           
                    <div class="col-lg-10">                
                        <input type="text" class="form-control" name="rbid"  placeholder="Promotion Code" required >
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <div style="padding-top:30px"></div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block" style="position: fixed; bottom: 0; width: 47%;">Add Code</button>
                        <a href="<?php echo $home; ?>"><button type="button" id="proceedorder" class="btn-raised btn btn-primary btn-lg btn-block" style="position: fixed; left:49%;bottom: 0;  width: 47%; padding-left: 1px;">Home <i  style="float:right; padding-top: 2.5px;"class="fa fa-arrow-right"></i></button></a>   
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php if($error != ""){ ?>
<div class="panel panel-primary">
    <div class="panel-body" >
         <legend style="padding-left:15px;">Error</legend>
                <div class="form-group">           
                    <div class="col-lg-10">                
                        <?php echo $error; ?>
                    </div>
                </div>                
    </div>
</div>
<?php } ?>

<?php echo $footer; ?>

