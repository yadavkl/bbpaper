
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script src="view/javascript/ripples.min.js"></script>
<script src="view/javascript/material.min.js"></script>
<script>
    $(document).ready(function() {        
        $.material.init();   
        
        
        $(document).bind('click',function(event){
            if(event.target.name == 'completepickup' ){
                $('#selecteduser').val(event.target.value);
                $('#promotional').val(0);
                $.get( "?page=register/agent/useramount", { statusid: event.target.value } ).done(function( data ) {
//alert(data);
                    $('#promotional').val(data);
                });
                event.preventDefault();
            }
            if(event.target.name == 'cancelpickup'){
                $('#canceluser').val(event.target.value);
                event.preventDefault();
            }
            
        }); 
        
        
    });
</script>
</body>

</html>
