app.filter('numberFilter', function ($sce) {
    return function (number) {
        if (number != undefined) {return number.toLocaleString()};
        return "";
    };
});