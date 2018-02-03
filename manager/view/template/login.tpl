<html>

    <head>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body style="padding-top:150px">
                <!-- Navigation -->
        <!-- Your site -->
        <div class="col-md-6 col-md-offset-3">
     <div class="panel panel-primary" >
         <div class="panel-heading">
        <h3 class="panel-title">Please Login <a href="?route=dashboard/register" style="float:right;">register</a></h3>
    </div>
         <div class="panel-body">         
            <form class="col-xs-6 col-sm-12" method="post" action="?route=dashboard/home/login">
                <div class="form-group" >
                    <label class="sr-only" for="contact-name">Username</label>
                    <input type="text" name="username" placeholder="Username..." class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="contact-email">Passowrd</label>
                    <input type="password" name="password" placeholder="Password..." class="form-control" id="password">
                </div>
                <div class="form-group"> 
                    <input type="submit" name="submit" value="LOGIN" class="btn btn-block btn-primary">
                    
                </div>
                
            </form>
    </br>
</div>  
</div>
</div>
 <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html> 