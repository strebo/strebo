app.controller('DetailController', ['$scope', 'DataService', '$sce', function($scope, DataService, $sce) {
        SC.initialize({
            client_id: 'd08c99a67fa0518806f5fe1f4bf36792'
        });

    var track_url = 'https://soundcloud.com/mustdiemusic/flux-pavilion-emotional-must-die-remix';
    SC.oEmbed(track_url, { auto_play: false }).then(function(oEmbed) {
        $scope.media = $sce.trustAsHtml($(oEmbed.html).attr('class','center')[0].outerHTML);
        $scope.apply();
    });

    $scope.hideDetailView = function() {
        $scope.$emit('setDetailView',false);
    };

    $scope.nextItem = function() {
        $scope.$emit('nextItem');
    };

    $scope.previousItem = function() {
        $scope.$emit('previousItem');
    };

}])
    .directive('detailView', function() {
        return {
            restrict: 'E',
            templateUrl: '/js/DetailView.html'
        };
    });