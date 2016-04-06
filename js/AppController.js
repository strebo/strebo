app.controller('AppController', ['$scope', 'DataService', function($scope, DataService) {
    $scope.detailview = false;
    $scope.view = 1;
    var feed = DataService.getPosts();
    var index = 0;

    var networks;
    var networkIndex = 0;

    var mode = 0;

    $scope.showF = true;
    $scope.showL = true;

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

    $scope.$on('setCurrentItemByNetwork', function(post, data) {
        mode = 1;
        networks = DataService.getPostsByNetwork();
        index = data.index;
        networkIndex = data.networkIndex;
        setFeedByNetworkItemAsDetail();
        check();
    });

    $scope.$on('setCurrentItem', function(post, data) {
        mode = 0;
        index = data;
        $scope.currentItem = feed[index];
        check();
    });

    function updateDetailView() {
        $scope.$apply(function () {
            if(mode == 0) $scope.currentItem = feed[index];
            else if(mode == 1) setFeedByNetworkItemAsDetail();
            check();
        });
    }

    function previousItem() {
        index = Math.max(0, index-1);
        if(mode == 0) $scope.currentItem = feed[index];
        else if(mode == 1) setFeedByNetworkItemAsDetail();
        check();
    }

    function nextItem() {
        if(mode == 0) {
            index = Math.min(feed.length-1, index+1);
            $scope.currentItem = feed[index];
        } else if(mode == 1) {
            index = Math.min(networks[networkIndex].feed.length-1, index+1);
            setFeedByNetworkItemAsDetail();
        }
        check();
    }

    function setFeedByNetworkItemAsDetail() {
        networks[networkIndex].feed[index].socialNetwork = {};
        networks[networkIndex].feed[index].socialNetwork.color = networks[networkIndex].color;
        networks[networkIndex].feed[index].socialNetwork.icon = networks[networkIndex].icon;
        $scope.currentItem = networks[networkIndex].feed[index];
    }

    function check() {
        if(index == 0) $scope.showF = false;
        else $scope.showF = true;

        if((mode == 0 && index == (feed.length - 1)) || (mode == 1 && index == (networks[networkIndex].feed.length - 1))) $scope.showL = false;
        else $scope.showL = true;
    }
}]);