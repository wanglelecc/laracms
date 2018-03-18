class helper{

    static test(){
        console.log('Helper test ...');
    }

    static repeat(str , n){
        return new Array(n+1).join(str);
    }
}
module.exports = helper;
