app.controller('AppController', ['$scope', function($scope) {
    $scope.detailview = false;
    $scope.view = 1;

    $scope.switchView = function() {
        $scope.view = ($scope.view + 1) % 2;
    };

    $scope.$on('setDetailView', function (event, state) {
        $scope.detailview = state;
    });

    $scope.$on('setCurrentItem', function(post, data) {
        $scope.currentItem = data;
        console.log(data);
    });
}]);