<!--<?php
include "php/user_session.php";
?> -->

<html ng-app="rdwala">

    <head>
 
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="view/css/style.css" rel="stylesheet">
        <link href="view/css/bootstrap-datepicker.min.css">
        
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
         <script src="view/js/moment-with-locales.min.js"></script>        
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="view/lib/bootstrap-datepicker.min.js"></script>       
        <script src="view/lib/angular.min.js"></script>
        <script src="view/lib/angular-route.min.js"></script>
        <script src="view/js/main.js"></script>
        <script src="view/js/services.js"></script>
        <script src="view/js/controller.js"></script>
        


    </head>

<body>
<!-- Navigation -->        
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
       <a class="navbar-brand" href="#orderstatus"><strong>DASHBOARD</strong></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
         <li class="dropdown">
          <a href="#orderstatus" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Order Details<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="#createorder">Create Order</a></li>
            <li><a href="#orderstatus">Order Status</a></li>
            <li><a href="#orderbycustomer">Order By Customer</a></li> 
            <li><a href="#totalorder">Total Order</a></li>
          </ul>
         </li>
          
          <li class="dropdown">
          <a href="#agentrating" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agent<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#agentrating">Agent Rating</a></li>
            <li><a href="#registeragent">Register Agent</a></li>
            <li><a href="#agentInfo">Agent Info</a></l
            <li><a href="#agentapprove">Approve Agent</a></li>
          </ul>
         </li>
         <li class="dropdown">
          <a href="#showarea" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Area<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="#addarea">Add Area</a></li>
          <li><a href="#showarea">Show Area</a></li>
          </ul>
         </li>
          <li><a href="#message">Message</a></li>
          <li><a href="#pagepermission">Page Permission</a></li>
        
         
            </ul>
        <ul class="nav navbar-nav navbar-right">
             <li><a>Welcome {{username}}</a></li>
             <li><a href="?route=dashboard/home/logout">Log Out</a></li> 
        </ul>      
    </div>
<!-- /.navbar-collapse -->
  </div>
<!-- /.container-fluid -->
</nav>
<!-- Navigation -->
    
        <div class="container" ng-view></div>
    
<!-- Your site ends -->
        
        <script>
            $(document).ready(function() {  
             
                
            });
        </script>

    </body>

</html>