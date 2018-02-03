<html>

    <head>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body style="padding-top:50px">


        <div class="container">
            <form class="form-horizontal" action="?route=dashboard/register/user" method="post">
                <fieldset>
                    <h2 >Register </h2>
                    <div class="form-group">
                        <label for="inputName" class="col-lg-2 control-label">User Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="username" required placeholder="User Name" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" required placeholder="Password" required >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputFirstname" class="col-lg-2 control-label">First Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="firstname" required placeholder="First Name" required >
                        </div>
                    </div>   
                    
                    <div class="form-group">
                        <label for="inputLastName" class="col-lg-2 control-label">Last Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="lastname" required placeholder="Last Name" required >
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputNumber" class="col-lg-2 control-label">Mobile</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" ng-minlength="10" ng-maxlength="10"  id="phone" name="phone" placeholder="Enter Phone Number" required>
                        </div>
                    </div>   
                    
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">

                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html> 
