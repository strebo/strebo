if(Url.get.debug)
    var debug = true;

console.debug = function(a) {
    debug && console.log(a);
}