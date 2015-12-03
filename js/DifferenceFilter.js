app.filter('differenceFilter', function ($sce) {
        return function (time) {
            var dateGet = new Date();
            if (time != undefined) {
                var matches = time.match(/(?!":")[0-9]+/g);
                var postDay = matches[0];
                var postMonth = matches[1];
                postMonth = parseInt(postMonth);
                postMonth = postMonth -1;
                var postYear = matches[2];
                var postHour = matches[3];
                var postMinute = matches[4];
                var postSecond = matches[5];
                var postDate = new Date(postYear, postMonth, postDay, postHour, postMinute, postSecond);
                var timeDiffSec = Math.round(Math.abs((dateGet - postDate)) / 1000);
                var timeDiffMin = Math.round(Math.abs(timeDiffSec) / 60);
                var timeDiffHour = Math.round(Math.abs(timeDiffMin) / 60);
                var timeDiffDay = Math.round(Math.abs(timeDiffHour) / 24);
                var timeDiffMonth = (Math.round(Math.abs(timeDiffDay) / 30));
                var timeDiffYear = Math.round(Math.abs(timeDiffMonth) / 12);
                if (timeDiffSec <= 60) {
                    return time = "just now";
                } else if (timeDiffMin <= 60) {
                    return time = timeDiffMin + " m ago";
                } else if (timeDiffHour <= 24) {
                    return time = timeDiffHour + " h ago";
                } else if (timeDiffDay <= 30) {
                    return time = timeDiffDay + " days ago";
                } else if (timeDiffMonth <= 12) {
                    return time = timeDiffMonth + " months ago";
                } else {
                    return time = timeDiffYear + " years ago";
                }
            }

        }
    }
)
;