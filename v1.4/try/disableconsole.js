(function(){
 
    var _z = console;
    console.log(_z);
    Object.defineProperty( window, "console", {
    get : function(){
        console.log("in get");
        if( _z._commandLineAPI ){
            throw "Sorry, Can't exceute scripts!";
        }
        return _z; 
    },
    set : function(val){
        console.log("in set");
        _z = val;
    }
    });
 
})();