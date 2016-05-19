if(Url.get.debug)
    var debug = true;
if(Url.get.trace)
    var trace = true;

console.debug = function(a) {
    debug && (typeof a === "string") && console.log(a);
    debug && (typeof a === "object") && console.table(a);
    trace && console.trace("...");
};