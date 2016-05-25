app.controller('AppController', ['$scope', 'DataService', '$rootScope', function($scope, DataService, $rootScope) {

    $scope.detailview = false;
    $scope.view = 1;
    $scope.locationSetting = 0;
    $rootScope.loaderview = true;
    $rootScope.serverError = false;

    var sections = ["trend board", "personal board", "search"];

    $scope.sectionName = sections[0];

    $scope.switchToSection = function(sectionIndex) {
        $scope.sectionName = sections[sectionIndex];
        DataService.setMode(sectionIndex);
    };

    var feed = DataService.getPosts();
    var index = 0;

    var networks;
    var networkIndex = 0;
    var network_keys = [];

    var mode = 0;

    $scope.showF = true;
    $scope.showL = true;

    $scope.location = $rootScope.locations[DataService.getLocation()];

    $scope.openLocationSettings = function() {
        $scope.locationSetting = ($scope.locationSetting + 1) % 2;
    };

    $scope.setLocation = function(lindex) {
        $scope.location = $rootScope.locations[lindex];
        $scope.locationSetting = 0;
        DataService.setLocation(lindex);
    };

    $scope.switchView = function() {
        $scope.view = ($scope.view + 1) % 2;
    };

    var handler = function(e){
        // Right Arrow
        if(e.keyCode === 39) {
            nextItem();
            updateDetailView();
            e.preventDefault();
        }
        // Left Arrow
        else if(e.keyCode === 37) {
            previousItem();
            updateDetailView();
            e.preventDefault();
        }
        
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
        if(!state)
            $scope.currentItem = undefined;
    });

    $scope.$on('search', function (event, state) {
        if(state)
            search();
    });

    function search() {
        $scope.switchToSection(2);
        $scope.setSearchView(false);
    }

    $scope.$on('setSearchView', function (event, state) {
        $scope.searchview = state;
    });

    $scope.setSearchView = function (state) {
        $scope.searchview = state;
        if(state)
            setTimeout(function() {
                angular.element('#searchview-query').focus();
            },0);
    };

    $scope.$on('setCurrentItemByNetwork', function(post, data) {
        mode = 1;
        networks = DataService.getPostsByNetwork();
        network_keys = Object.keys( networks );
        index = data.index;
        networkIndex = data.networkIndex;
        updateDetailViewWA();
    });

    $scope.$on('setCurrentItem', function(post, data) {
        mode = 0;
        index = data;
        feed = DataService.getPosts();
        updateDetailViewWA();
    });

    function updateDetailViewWA() {
        if(mode === 0)
            $scope.currentItem = feed[index];
        else if(mode === 1)
            setFeedByNetworkItemAsDetail();
        check();
    }

    function updateDetailView() {
        $scope.$apply(function () {
            updateDetailViewWA();
        });
    }

    function previousItem() {
        index = Math.max(0, index-1);
        updateDetailView();
    }

    function nextItem() {
        if(mode === 0)
            index = Math.min(feed.length-1, index+1);
        else if(mode === 1)
            index = Math.min(networks[network_keys[networkIndex]].feed.length-1, index+1);
        updateDetailView();
    }

    function setFeedByNetworkItemAsDetail() {
        networks[network_keys[networkIndex]].feed[index].socialNetwork = networks[network_keys[networkIndex]];
        $scope.currentItem = networks[network_keys[networkIndex]].feed[index];
    }

    function check() {
        (index === 0) ? $scope.showF = false : $scope.showF = true;
        ((mode === 0 && index === (feed.length - 1)) || (mode === 1 && index === (networks[network_keys[networkIndex]].feed.length - 1))) ?  $scope.showL = false : $scope.showL = true;
    }

    $scope.isAdBlockActive = isAdBlockActive || false;
}]);