app.filter('differenceFilter', function () {
        return function (time) {
            var dateGet = new Date();
            if (time !== undefined) {
                time = JSON.parse(time);
                var postDate = new Date(time.year, time.month-1, time.day, time.hour, time.minute, time.second);
                var timeDiffSec = Math.round(Math.abs(dateGet - postDate) / 1000);
                var timeDiffMin = Math.round(Math.abs(timeDiffSec) / 60);
                var timeDiffHour = Math.round(Math.abs(timeDiffMin) / 60);
                var timeDiffDay = Math.round(Math.abs(timeDiffHour) / 24);
                var timeDiffMonth = Math.round(Math.abs(timeDiffDay) / 30);
                var timeDiffYear = Math.round(Math.abs(timeDiffMonth) / 12);
                var formattedTime = '';
                if (timeDiffSec < 60) {
                    formattedTime = "just now";
                } else if (timeDiffMin < 60) {
                    formattedTime = timeDiffMin + ( timeDiffMin===1 ? " minute " : " minutes " ) + "ago";
                } else if (timeDiffHour < 24) {
                    formattedTime = timeDiffHour + ( timeDiffHour===1 ? " hour " : " hours " ) + "ago";
                } else if (timeDiffDay < 30) {
                    formattedTime = timeDiffDay + ( timeDiffDay===1 ? " day " : " days " ) + "ago";
                } else if (timeDiffMonth < 12) {
                    formattedTime = timeDiffMonth + ( timeDiffMonth===1 ? " month " : " months " ) + "ago";
                } else if (timeDiffYear !== 0) {
                    formattedTime = timeDiffYear + ( timeDiffYear===1 ? " year " : " years " ) + "ago";
                } else {
                    formattedTime = '';
                }
                return formattedTime;
            }

        }
    }
)
;