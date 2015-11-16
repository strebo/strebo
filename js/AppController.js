app.controller('AppController', ['$scope', function($scope) {
    $scope.detailview = false;
    $scope.view = 1;
    $(document).ready(function() {
        $('#view-switch').click(function() {
            $scope.view = ($scope.view + 1) % 2;
            $scope.$apply();
        });
    });

    $scope.$on('setDetailView', function (event, state) {
        $scope.detailview = state;
    });

    $scope.$on('setCurrentItem', function(post, data) {
        $scope.currentItem = data;
        console.log(data);
    });
}]);