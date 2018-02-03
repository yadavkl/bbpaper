<!-- Your site ends -->

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script src="view/javascript/ripples.min.js"></script>
<script src="view/javascript/material.min.js"></script>
<script>
    $(document).ready(function() {
        // This command is used to initialize some elements and make them work properly
        $('#date').prop('selectedIndex',0);
        $("#tview").hide(); 
        
        $.material.init();
        
        $("#schedulelater").submit(function(event){
        
            var obj = $(this).serializeArray();
            window.location="?page=register/user/book&"+obj[0].name+"="+obj[0].value;
            event.preventDefault();
        }); 

        $("#pickupnow").submit(function(event){
        
            var obj = $(this).serializeArray();
            window.location="?page=register/user/booknow&"+obj[0].name+"="+obj[0].value;
            event.preventDefault();
        }); 
        
        $('#deleteaddress').on('click',function(event){
        	
             var obj = $("input[name=address]:checked").val();
             window.location="?page=register/user/removeinfo&address="+obj; 
             event.preventDefault();       
        });
        
        $("#time").attr("disabled", true);
        
        $("#date").change(function(){            
            var date = $("#date").val();      
            $.get("?page=register/user/slots&date="+date, function(data, status){              
                $("#time").attr("disabled", false);
                $("#time").empty();
                data = JSON.parse(data);
                for( var i=0; i< data.length; i++){                
                    $("#time").append(new Option(data[i]['slot']));                    
                }
            });
               
        });
        
        $("#infobutton").click(function(){
        
	$("#infobutton").addClass("wobble");
            if ( $("#tview").is(':visible') ){
                $("#tview").hide();
            }else{
                    $("#tview").show();
            }
        });
        
        $("#tview").click(function(){
            $("#tview").hide();
        });
    
    });
</script>
</body>
</html>