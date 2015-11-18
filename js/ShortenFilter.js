app.filter('shortenTo', ["$filter", "$sce", function ($filter, $sce) {
    return function (input, limit) {
        if (input.length <= limit) return input;
        return $filter('limitTo')(input, limit) + ' ...'; //$sce.trustAsHtml(' &#8230;');
    };
}]);