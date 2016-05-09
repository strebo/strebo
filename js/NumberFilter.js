app.filter('numberFilter', function () {
    return function (number) {
        if (number !== undefined) {
            return number.toLocaleString();
        }
        ;
        return "";
    };
});