app.filter('numberFilter', function ($sce) {
    return function (number) {
        return number.toLocaleString();
    };
});