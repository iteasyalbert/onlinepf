angular.
  module('mro').
  controller('physiciansCtrl', physiciansCtrl);

  function physiciansCtrl($http, $scope, $filter, $interval){
    $scope.patients = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];
    $scope.filter_status = null;
    $scope.patient_name = '';
    
    // $interval(function() {
    //   $scope.getPatients();
    // }, 10000);
    $scope.submit = function($event){
      var keyCode = $event.which || $event.keyCode;
      if (keyCode === 13) {
          $scope.getPatients();
      }

    }
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    $scope.sortDesc = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = true; //if true make it false and vice versa
    }

    $scope.getPatients = function(pageNumber){
      console.log($scope.filter_status);
      if(pageNumber===undefined){
        pageNumber = '1';
      }

      $http({
        method : "POST",
        url : '/physicians/getPatients/'+pageNumber,
        data: {  filter_status: $scope.filter_status, patient_name: $scope.patient_name }
      }).then(function mySuccess(response) {
        // console.log(response);

        respo_data = response.data.data;
        if(response.data.error.status)
            alert(response.data.error.message)
        else{
          
          if(respo_data !== null){

            $scope.patients        = respo_data.data;
            $scope.totalPages   = respo_data.last_page;
            $scope.currentPage  = respo_data.current_page;

            // Pagination Range
            var pages = [];

            for(var i=1;i<=respo_data.last_page;i++) {          
              pages.push(i);
            }

            $scope.range = pages;
          }else{
            $scope.patients=[];
            $scope.range = [];
          }
        }
      }, function myError(response) {
          alert(response.statusText);
      });
    };
  };
  angular.
  module('mro')
  .directive('patientsPagination', function(){  
     return{
        restrict: 'E',
        template: '<ul class="pagination">'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPatients(1)">«</a></li>'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPatients(currentPage-1)">‹ Prev</a></li>'+
          '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
              '<a href="javascript:void(0)" ng-click="getPatients(i)">{{i}}</a>'+
          '</li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPatients(currentPage+1)">Next ›</a></li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPatients(totalPages)">»</a></li>'+
        '</ul>'
     };
  });

