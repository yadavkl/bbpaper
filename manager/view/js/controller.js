app.controller('orderstatusController',function($scope,dataservice){
    $scope.orders=[];
    $scope.search={cdate:''};
    
    loadOrderStatusData();
    
    function applyOrderData(orders){
        
        $scope.orders=orders;   
        console.log($scope.orders);
    }
    
    function loadOrderStatusData(){
       dataservice.orderstatusRequest().then(function(orders){
            applyOrderData(orders);
       
       }); 
    }
});



app.controller('orderbycustomerController',function($scope,dataservice){
    
    $scope.customers=[];
    $scope.history=[];
    
    loadCustomerStatusData();
    
    function applyCustomerData(customers){
        
        $scope.customers=customers;   
        console.log($scope.customers);
    }
    
    function loadCustomerStatusData(){
       dataservice.orderstatusRequest().then(function(customers){
            applyCustomerData(customers);
       
       }); 
    }
    function applyHistoryData(historyData){
        $scope.history = historyData;
        console.log(historyData);
    }
    function loadCustomerHistoryData(custid){
       dataservice.customerHistoryRequest(custid).then(function(historyData){
        applyHistoryData(historyData);
       }); 
    }
    $scope.onHistory=function(custid){
        loadCustomerHistoryData(custid)
    }
});

app.controller('messageController',function($scope,dataservice){
    
    $scope.customers=[];
    loadmessageData();
    
    function applyMessageData(customers){
        
        $scope.customers=customers;   
        console.log($scope.customers);
    }
    
    function loadmessageData(){
       dataservice.orderstatusRequest().then(function(customers){
            applyMessageData(customers);
       
       }); 
    }    

});
app.controller('agentapproveController',function($scope,dataservice){
    
    $scope.agents=[];
    loadagentData();
    
    function applyAgentData(agents){
        
        $scope.agents=agents;   
        console.log($scope.agents);
    }
    
    function loadagentData(){
       dataservice.agentapproveRequest().then(function(agents){
            applyAgentData(agents);
       
       }); 
    }    

});
app.controller('totalorderController',function($scope,dataservice){
    
    $scope.orders=[];
    loadorderData();
    
    function applyTotalData(orders){
        
        $scope.orders=orders;  
        
        console.log($scope.orders);
       
    }
    
    function loadorderData(){
        
       dataservice.totalorderRequest().then(function(orders){
           
            applyTotalData(orders);
           
       
       }); 
    }
 
});
app.controller('agentratingController',function($scope,dataservice){
    
    $scope.agents=[];
    loadAgentData();
     
    function applyAgentData(agents){
        
        $scope.agents=agents;   
        console.log($scope.agents);
    }
    
    function loadAgentData(){
            dataservice.agentratingRequest().then(function(agents){
            applyAgentData(agents);
     
       }); 
    }    

});
app.controller('agentinfoController',function($scope,dataservice,$route){
    
    $scope.agents=[];
    loadinfoData();
     
    function applyinfoData(agents){
        
        $scope.agents=agents;   
        console.log($scope.agents);
    }
    
    function loadinfoData(){
            dataservice.agentinfoRequest().then(function(agents){
            applyinfoData(agents);
     
       }); 
    }
      function applyRemoveData(RemoveData){
        $scope.removes = RemoveData;
        console.log(RemoveData);
    }
    function loadRemoveData(agent){
       dataservice.agentRemoveRequest(agent).then(function(RemoveData){
        applyRemoveData(RemoveData);

       }); 
    }
    $scope.Remove=function(agent){
        console.log(agent);
        loadRemoveData(agent);
          $route.reload();

    }       

});

app.controller('showareaController',function($scope,dataservice,$route){
    
    $scope.areas=[];
    $scope.changes=[];
    loadareaData();

     
    function applyAreaData(areas){
        
        $scope.areas=areas;   
        console.log($scope.areas);
    }
    
    function loadareaData(){
            dataservice.showareaRequest().then(function(areas){
            applyAreaData(areas);
     
       }); 
    }
    function applyChangeData(ChangeData){
        $scope.changes = ChangeData;
        console.log(ChangeData);
    }
    function loadChangeData(area){
       dataservice.areachangeRequest(area).then(function(ChangeData){
        applyChangeData(ChangeData);

       }); 
    }
    $scope.Change=function(area){
        console.log(area);
        loadChangeData(area);
          $route.reload();

    }    
    

});
app.controller('addareaController',function($scope,dataservice){
    
});
app.controller('createorderController',function($scope,dataservice){
    $scope.bookings=[];
    $scope.selecteddate;
    $scope.selectedareaid;
    $scope.slots=[];
    
     
    function applyBookingData(bookings){
        
        $scope.bookings=bookings;   
        console.log($scope.bookings);
    }
    
    function loadBookingData(){
            dataservice.bookingsRequest().then(function(bookings){
            applyBookingData(bookings);
     
       }); 
    }
    $scope.areas=[];
    loadareaData();

     
    function applyAreaData(areas){
        
        $scope.areas=areas;   
        console.log($scope.areas);
    }
    
    function loadareaData(){
            dataservice.showareaRequest().then(function(areas){
            applyAreaData(areas);
     
       }); 
    }  

     function applyslotdata(slots){
        
        $scope.slots=slots;   
        console.log($scope.slots);
    }
    
    function loadslotdata(){
            dataservice.showslotRequest($scope.selectedareaid,$scope.selecteddate).then(function(slots) {
                applyslotdata(slots);
            });     
               
       
    } 

    $scope.onAreaChange=function() {

        loadBookingData();
    }

    $scope.onChange=function(){
        loadslotdata();

      
    }    
});
app.controller('registeragentController',function($scope,dataservice){
    $scope.areas=[];
    loadAreaId();
     
    function applyAreaId(areas){
        
        $scope.areas=areas;   
        console.log($scope.areas);
    }
    
    function loadAreaId(){
            dataservice.areaidRequest().then(function(areas){
            applyAreaId(areas);
     
       }); 
    }  
});

app.controller('pagepermissionController',function($scope,dataservice){
    
    $scope.pages=[];
	$scope.selectedRole="";	
	$scope.pagePermission="";
	$scope.role=[]; 
	
    loadroleData(); 
    loadpageData(); 

	
    function applypageData(pages){        
        $scope.pages=pages;   
    }    
    function loadpageData(){       
       dataservice.pageRequest().then(function(pages){
		     var name = angular.element($('#url')).val();
			// $scope.pagePermission=name;  
			// alert($scope.pagePermission);	
              applypageData(pages);        
       
       }); 
    }	
        function applyroleData(role){        
        $scope.role=role;   

    }    
    function loadroleData(){       
       dataservice.roleRequest().then(function(role){
            applyroleData(role);        
       
       }); 
    }
	
	$scope.onRoleChange=function(rolename){
		
		$scope.selectedRole=rolename;
		 dataservice.viewRoleData($scope.selectedRole,angular.toJson($scope.pages)).
		 then(function(data){
			applypageData(data); 
		 });
		 
	}
	$scope.onSubmit=function(){
dataservice.updateRolePermissions($scope.selectedRole,angular.toJson($scope.pages));
alert('Permissions Updated');
	}
    // $scope.onPermissionChange=function(pageid,attr){
        // dataservice.changepermission(pageid,attr);
    // }
    
   /* $scope.chiliSpicyData = function() {
      
       dataservice.chiliSpicyDataRequest().then(function(pages){
            chiliSpicyData(pages);           
       
       }); 
    
   };   */   

});