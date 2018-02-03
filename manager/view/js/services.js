app.service('dataservice',function($http,$q){
    
    return {
        customerstatusRequest:customerstatusRequest,
        orderstatusRequest:orderstatusRequest,
        showareaRequest:showareaRequest,
        totalorderRequest:totalorderRequest,
        agentratingRequest:agentratingRequest,
        customerHistoryRequest:customerHistoryRequest,
        areachangeRequest:areachangeRequest,
        agentinfoRequest:agentinfoRequest,
        areaidRequest:areaidRequest,
        agentapproveRequest:agentapproveRequest,
        bookingsRequest:bookingsRequest,
        agentRemoveRequest:agentRemoveRequest,
        roleRequest:roleRequest,
        pageRequest:pageRequest,
        getroleRequest:getroleRequest,
        changepermission:changepermission,
        permisssionRequest:permisssionRequest,
        updateRolePermissions:updateRolePermissions,
        viewRoleData:viewRoleData,
        Updateapproval:Updateapproval,
        showslotRequest:showslotRequest
    };
    
    function updateRolePermissions(role,pages,url){
		console.log(JSON.parse(pages));
			
		//	console.log(pages);
			var request = $http({
            method: "get",
			cache:false,
            url:"?route=permission/page/updatepermissions",
            params: {            
				role:role,
				pages:pages,
				url:url
				 
            }
        });
		
        return( request.then( handleSuccess, handleError ) );
		
	}
  //get grid by role  //
	function viewRoleData(role,pages){
		console.log(JSON.parse(pages));
			//console.log(pages);
			var request = $http({
            method: "get",
			cache:false,
            url:"?route=permission/page/get_role_data",
            params: {            
				role:role,
				pages:pages
				
            }
		});
        return( request.then( handleSuccess, handleError ) );
		
	}
	function permisssionRequest() {
		console.log(response.data);
	        var request = $http({
	            method: "get",
	            url: "?route=permisssion/page/updatePermissions",
	            params: {
	                //action: "get"
	            }
	        });
	        return( request.then( handleSuccess, handleError ) );
	   }

	function changepermission(id,cname,role_id,url){
        
	      //console.log("ID & NAME & ROLE url" + id + cname +role);
	        var request = $http({
	            method: "get",
	            url: "?route=permission/page/updatepermissions",
	            params: {
	                action: "get",
	                id:id,
	                cname:cname,
					role_id:role_id,
					url:url
	            }
				
	        });

	        return( request.then( handleSuccess, handleError ) );
	  }
	function getroleRequest() {
        var request = $http({
            method: "get",
			cache:false,
            url: "?route=permission/page/getrole",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    } 
	
    function Updateapproval(agents){
		console.log(JSON.parse(agents));			
		//	console.log(pages);
			var request = $http({
            method: "get",
			cache:false,
            url:"?route=order/status/update_agent_approval",
            params: {            
				agents:agents			 
            }
        });
        return( request.then( handleSuccess, handleError ) );
		
	}
    
 function customerHistoryRequest(custid){
          var request = $http({
            method: "get",
            cache:false,
            url: "?route=order/status/gethistory",
            params: {
                customerid: custid
            }
        });
        return( request.then( handleSuccess, handleError ) );  
 }   
function orderstatusRequest() {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=order/status/getorderstatus",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
    function bookingsRequest() {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=order/status/getbookingstatus",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
function agentRemoveRequest(agent) {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=register/agent/removeagent",
            params: {
                agentid: agent
            }   
        });
        return( request.then( handleSuccess, handleError ) );
    }
     function showslotRequest(area, date) {    
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=order/status/getavailableslots",
            params: {
                areaid: area,
                date: date
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
    function areachangeRequest(area) {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=area/show/changestatus",
            params: {
                areaid: area
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
function areaidRequest() {
    console.log("hello");
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=register/agent/getareaid",
            params: {
                //
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
    
function totalorderRequest() {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=order/status/totalorderstatus",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
 function agentratingRequest() {
   
        
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=register/agentrating/getagentrating",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }

     function agentinfoRequest() {
   
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=register/agent/getagentinfo",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
      function agentapproveRequest() {
   
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=register/agent/agentapprove",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }

    
function showareaRequest() {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=area/show/getshowarea",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
    
function customerstatusRequest() {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=order/status/getcustomerstatus",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
    
function customerstatusRequest() {
        var request = $http({
            method: "get",
            cache:false,
            url: "?route=order/status/getmessagestatus",
            params: {
                //action: "get"
            }
        });
        return( request.then( handleSuccess, handleError ) );
    }
    
function roleRequest() {
	   //  alert("hello");
	        var request = $http({
	            method: "get",
	            url: "?route=order/status/getrole",
	            params: {
	                //action: "get"
	            }
	           });
	        return( request.then( handleSuccess, handleError ) );
	    }
	function pageRequest() {
	   //  alert("hello");
	        var request = $http({
	            method: "get",
	            url: "?route=order/status/getpage",
	            params: {
	                //action: "get"
	            }
	           });
	        return( request.then( handleSuccess, handleError ) );
	    }

    
    
    function handleError( response ) {
        if (! angular.isObject( response.data ) || ! response.data.message ) {
            return( $q.reject( "An unknown error occurred." ) );
        }
            return( $q.reject( response.data.message ) );
    }
    
    function handleSuccess( response ) { 
        
        //console.log(response.data);
        return( response.data );
    }
    
    
});