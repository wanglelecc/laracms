
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


var token = document.head.querySelector('meta[name="csrf-token"]');
layui.$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token.content
    }
});

window.jsUrlHelper = {
    getUrlParam : function(url, ref) {
        var str = "";

        // 如果不包括此参数
        if (url.indexOf(ref) == -1)
            return "";

        str = url.substr(url.indexOf('?') + 1);

        arr = str.split('&');
        for (i in arr) {
            var paired = arr[i].split('=');

            if (paired[0] == ref) {
                return paired[1];
            }
        }

        return "";
    },
    putUrlParam : function(url, ref, value) {

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
    },
    delUrlParam : function(url, ref) {

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
};