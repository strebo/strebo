app.filter('urlFilter', ['$sce', function ($sce) {
    return function (text) {
        if (text != null) var matches = text.match(/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/g);

        if (matches == null) return text;
        else {
            matches.forEach(function (match) {
                var link = encodeURI(match);
                link = '<a target="_blank" href="' + link + '">' + link.toString() + '</a>';
                text = text.replace(match, link);
            });
            return text;
        }
    };
}]);