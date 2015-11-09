$(document).ready(function(){
                 $("#social-network-connector-instagram").click(function(){login()});   
                });
                var code = null;
            var authenticateInstagram = function(instagramClientId, instagramRedirectUri, callback) {
            
            var popupWidth = 700,
                popupHeight = 500,
                popupLeft = (window.screen.width - popupWidth) / 2,
                popupTop = (window.screen.height - popupHeight) / 2;
            
            var popup = window.open('instagram_auth.php', '', 'width='+popupWidth+',height='+popupHeight+',left='+popupLeft+',top='+popupTop+'');
            popup.onload = function() {
        
                if(window.location.hash.length == 0) {
                    popup.open('https://api.instagram.com/oauth/authorize/?client_id='+instagramClientId+'&redirect_uri='+instagramRedirectUri+'&response_type=code', '_self');
                }
                
                var interval = setInterval(function() {
                    try {
                        
                        if(popup.location.hash.length) {
                            clearInterval(interval);
                            code = popup.location.hash.slice(14);
                            document.getElementById('social-network-connector-instagram').innerHTML='<div class="center"><i class="fa fa-instagram"></i></div><div class="connector-status box-shadow connected"></div>';
                            
                            jQuery.ajax({
                                type: "POST",
                                url: 'http://strebo.net/Strebo/SocialNetworks/Instagram.php',
                                dataType: 'json',
                                data: {functionname: 'getPersonalFeed', arguments: [$code]},

                                success: function (obj, textstatus) {
                                              if( !('error' in obj) ) {
                                                  yourVariable = obj.result;
                                              }
                                              else {
                                                  console.log(obj.error);
                                              }
                                        }
                            });

                            popup.close();
                            if(callback != undefined && typeof callback == 'function') callback();
                        }
                    }
                    catch(evt) {
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
                'c12bbe37871f443ca257ef54a131a777', //instagram client ID
                'http://strebo.net', //instagram redirect URI
                login_callback //optional - a callback function
            );
            return false;
        }



                