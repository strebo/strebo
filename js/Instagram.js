$(document).ready(function () {
    $("#social-network-connector-instagram").click(function () {
        login()
    });
});
var code = null;
var authenticateInstagram = function (callback) {

    var popupWidth = 700,
        popupHeight = 500,
        popupLeft = (window.screen.width - popupWidth) / 2,
        popupTop = (window.screen.height - popupHeight) / 2;

    var popup = window.open('instagram_auth.php', '', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + popupLeft + ',top=' + popupTop + '');
    popup.onload = function () {

        if (window.location.hash.length === 0) {
            popup.open('https://api.instagram.com/oauth/authorize/?client_id=c12bbe37871f443ca257ef54a131a777&redirect_uri=http://strebo.net&response_type=code', '_self');
        }

        var interval = setInterval(function () {
            try {

                if (popup.location.hash.length) {
                    clearInterval(interval);
                    code = popup.location.hash.slice(14);
                    document.getElementById('#social-network-connector-instagram').innerHTML = '<div class="center"><i class="fa fa-instagram"></i></div><div class="connector-status box-shadow connected"></div>';

                    $.get("http://strebo.net/Strebo/SocialNetworks/index.php", function (data) {
                        alert(data);
                    });

                    popup.close();
                    if (callback !== undefined && typeof callback === 'function') callback();
                }
            }
            catch (evt) {
                //permission denied
            }
        }, 100);
    }
};
function login_callback() {
    alert("You are successfully logged in to Instagram!");
}
function login() {
    authenticateInstagram(
        login_callback //optional - a callback function
    );
    return false;
}