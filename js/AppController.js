app.controller('AppController', ['$scope', function($scope) {
    $scope.view = 1;
    $(document).ready(function() {
        $('#view-switch').click(function() {
            $scope.view = ($scope.view + 1) % 2;
            $scope.$apply();
        });
    });
}]);