app.filter('numberFilter', function () {
    return function (number) {
        if (Number.isInteger(number)) {
            return number.toLocaleString();
        }
        return "";
    };
});