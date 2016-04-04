app.controller('AppController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.detailview = false;
    $scope.view = 1;
    var feed = DataService.getPosts();
    var index = 0;

    $scope.switchView = function() {
        $scope.view = ($scope.view + 1) % 2;
    };

    var handler = function(e){
        if(e.keyCode === 39) nextItem(); // Right Arrow
        else if(e.keyCode === 37) previousItem(); // Left Arrow
        updateDetailView();
    };
    var $doc = angular.element(document);
    $doc.on('keydown', handler);
    $scope.$on('$destroy',function(){
        $doc.off('keydown', handler);
    });

    $scope.$on('previousItem', previousItem);
    $scope.$on('nextItem', nextItem);

    $scope.$on('setDetailView', function (event, state) {
        $scope.detailview = state;
    });

    $scope.$on('setCurrentItem', function(post, data) {
        index = data;
        $scope.currentItem = feed[index];
        console.log(data);
    });

    function updateDetailView() {
        $scope.$apply(function () {
            $scope.currentItem = feed[index];
        });
    }

    function previousItem() {
        index = Math.max(0, index-1);
        $scope.currentItem = feed[index];
    }

    function nextItem() {
        index = Math.min(feed.length-1, index+1);
        $scope.currentItem = feed[index];
    }
}]);