angular.
  module('mro').
  controller('physiciansCtrl', physiciansCtrl);

  function physiciansCtrl($http, $scope, $filter, $anchorScroll, $location, anchorService){
    $scope.patient_orders = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];

    $scope.prevResultSID = '';
    
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    $scope.sortDesc = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = true; //if true make it false and vice versa
    }

    $scope.clearPDf = function(){
      window.location = '/';
      
      // $scope.patient_id = null;
      // $scope.specimen_ids = [];
      // $scope.counter = 0;
      // $scope.start_date = $filter('date')(new Date(), "yyyy-MM-dd");
      // angular.element( document ).find('#pdfHolder').empty();
      // $scope.toggle = !$scope.toggle;
      // console.log('here');
    }
    $scope.getPdf = function(specimen_id, pid, test_group_id, release_date) {
      // Show hidden buttons
      $scope.toggle = true;
      $scope.prevResultBtn = false;
      // Get orders of selected patient
      if(!$scope.patient_id){
        $scope.start_date = '2019-06-01';
        $scope.prevResultSID = specimen_id;
        $scope.patient_id = pid;
        $scope.test_group_id = test_group_id;
        $scope.release_date = release_date;
        $scope.getPatientOrders(1);
        var sortByExam = 'examinations';
        $scope.sortDesc(sortByExam);
      }

      // Get PDF
      $scope.pdfUrl='/patients/getPdf/'+specimen_id;
      var pdfHolder = angular.element( document ).find('#pdfHolder').empty();
      pdfHolder.append(
        '<div class="col-xs-12" id="anchorpdfDiv-'+specimen_id+'"><object data='+$scope.pdfUrl+' type="application/pdf" width="100%" height="800px" >'+ 
          '<p>It appears you dont have a PDF plugin for this browser.'+
           'No biggie... you can <a href="'+$scope.pdfUrl+'">click here to'+
          'download the PDF file.</a></p>'+  
        '</object></div>'
      );
      
      // Get Prev. Result
      $http({
          method : "POST",
          url : '/physicians/getPrevResult',
          data: { patient_id: pid, specimen_id: specimen_id, test_group_id: test_group_id, release_date: release_date}
        }).then(function mySuccess(response) {
          console.log(response);
          var pdfHolder = angular.element( document ).find('#pdfHolder');
          pdfHolder.append(response.data.body);
          angular.element( document ).find('#deltacheck').hide();
        }, function myError(response) {
            alert(response.statusText);
        });
        anchorService.gotoAnchor("pdfDiv-"+specimen_id);
    };

    $scope.prevResult = function() {
      $scope.prevResultBtn = !$scope.prevResultBtn;
      angular.element( document ).find('#deltacheck').toggle();
      // if(!$scope.prevResultBtn)
      //   angular.element( document ).find('#pdfDiv').removeClass('col-xs-6').addClass("col-xs-12");
      // else
      //   angular.element( document ).find('#pdfDiv').removeClass('col-xs-12').addClass("col-xs-6");
    };

    $scope.getPatientOrders = function(pageNumber){

      if(pageNumber===undefined){
        pageNumber = '1';
      }

      $http({
        method : "POST",
        url : '/physicians/getPatientOrders/'+pageNumber,
        data: { start_date: $scope.start_date , end_date: $scope.end_date, first_name: $scope.firstname, last_name: $scope.lastname, patient_id: $scope.patient_id}
      }).then(function mySuccess(response) {
        // console.log(response.data.data.data);

        respo_data = response.data.data;
        if(response.data.error.status)
            alert(response.data.error.message)
        else{
          
          if(respo_data !== null){
            // Combine all test result examination
            angular.forEach(respo_data.data, function(patient_order_val, patient_order_key) {
              respo_data.data[patient_order_key].TestOrder.examinations = "";
              angular.forEach(patient_order_val.TestOrder.TestResult, function(tr_val, tr_key) {
                respo_data.data[patient_order_key].TestOrder.examinations += tr_val.TestGroup.name;
                respo_data.data[patient_order_key].TestOrder.examination_internal_ids = tr_val.TestGroup.internal_id;
              });
            });
     

            $scope.patient_orders        = respo_data.data;
            $scope.totalPages   = respo_data.last_page;
            $scope.currentPage  = respo_data.current_page;

            // Pagination Range
            var pages = [];

            for(var i=1;i<=respo_data.last_page;i++) {          
              pages.push(i);
            }

            $scope.range = pages;
          }else{
            $scope.patient_orders=[];
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
  .directive('patientOrdersPagination', function(){  
     return{
        restrict: 'E',
        template: '<ul class="pagination">'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPatientOrders(1)">«</a></li>'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPatientOrders(currentPage-1)">‹ Prev</a></li>'+
          '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
              '<a href="javascript:void(0)" ng-click="getPatientOrders(i)">{{i}}</a>'+
          '</li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPatientOrders(currentPage+1)">Next ›</a></li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPatientOrders(totalPages)">»</a></li>'+
        '</ul>'
     };
  });

