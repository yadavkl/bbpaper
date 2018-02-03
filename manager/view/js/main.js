var app = angular.module("rdwala",['ngRoute']);

 app.filter('sumByKey', function() {
        return function(data, key) {
            if (typeof(data) === 'undefined' || typeof(key) === 'undefined') {
                return 0;
            }
 
            var sum = 0;
            for (var i = data.length - 1; i >= 0; i--) {
                sum += parseInt(data[i][key]);
            }
 
            return sum;
        };
    });

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/orderstatus', {
        templateUrl: 'view/html/orderstatus.html',
        controller: 'orderstatusController'
      }).
    when('/orderbycustomer',{
        templateUrl: 'view/html/orderbycustomer.html',
        controller: 'orderbycustomerController'
    }).
    when('/addarea',{
        templateUrl: 'view/html/addarea.html',
        controller: 'addareaController'
    }).
    when('/message',{
        templateUrl: 'view/html/message.html',
        controller: 'messageController'
    }). 
    when('/registeragent',{
        templateUrl: 'view/html/registeragent.html',
        controller: 'registeragentController'
    }).
    when('/showarea',{
        templateUrl: 'view/html/showarea.html',
        controller: 'showareaController'
    }).
    when('/totalorder',{
        templateUrl: 'view/html/totalorder.html',
        controller: 'totalorderController'
    }).
     when('/agentrating',{
        templateUrl: 'view/html/agentrating.html',
        controller: 'agentratingController'
    }).
      when('/agentInfo',{
        templateUrl: 'view/html/agentInfo.html',
        controller: 'agentinfoController'
    }).
       when('/agentapprove',{
        templateUrl: 'view/html/agentapprove.html',
        controller: 'agentapproveController'
    }).
        when('/createorder',{
        templateUrl: 'view/html/createorder.html',
        controller: 'createorderController'
    }).
    when('/pagepermission',{
        templateUrl: 'view/html/pagepermission.html',
        controller: 'pagepermissionController'
    }).
     otherwise({
       redirectTo: 'view/html/orderstatus.html'
      });
  }]);


