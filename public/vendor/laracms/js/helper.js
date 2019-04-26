class helper{

    static test(){
        console.log('Helper test ...');
    }

    static byteToSize(bytes) {
        let decimals = 2;
        var size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];

        var floor = Math.floor((bytes.toString().length-1)/3);

        return (bytes/Math.pow(1024,floor)).toFixed(decimals) + ' ' + size[floor];
    }

    static repeat(str , n){
        return new Array(n+1).join(str);
    }

    static getUrlParam(url, ref) {
        var str = "";

        // 如果不包括此参数
        if (url.indexOf(ref) == -1)
            return "";

        str = url.substr(url.indexOf('?') + 1);

        var arr = str.split('&');
        for (i in arr) {
            var paired = arr[i].split('=');

            if (paired[0] == ref) {
                return paired[1];
            }
        }

        return "";
    }

    static putUrlParam(url, ref, value) {
        // 如果没有参数
        if (url.indexOf('?') == -1)
            return url + "?" + ref + "=" + value;

        // 如果不包括此参数
        if (url.indexOf(ref) == -1)
            return url + "&" + ref + "=" + value;

        var arr_url = url.split('?');

        var base = arr_url[0];

        var arr_param = arr_url[1].split('&');

        for (i = 0; i < arr_param.length; i++) {

            var paired = arr_param[i].split('=');

            if (paired[0] == ref) {
                paired[1] = value;
                arr_param[i] = paired.join('=');
                break;
            }
        }

        return base + "?" + arr_param.join('&');
    }

    static delUrlParam(url, ref) {

        // 如果不包括此参数
        if (url.indexOf(ref) == -1)
            return url;

        var arr_url = url.split('?');

        var base = arr_url[0];

        var arr_param = arr_url[1].split('&');

        var index = -1;

        for (i = 0; i < arr_param.length; i++) {

            var paired = arr_param[i].split('=');

            if (paired[0] == ref) {

                index = i;
                break;
            }
        }

        if (index == -1) {
            return url;
        } else {
            arr_param.splice(index, 1);
            return base + "?" + arr_param.join('&');
        }
    }
}
module.exports = helper;
