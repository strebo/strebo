app.filter('hashFilter', function () {
    return function (text) {
        if (text != null)
            text = text.replace(/(^|\s)(#[^\s\\]+)/g, '$1<span class="hashcolor">$2</span>');
        return text;
    };
});