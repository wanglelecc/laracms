<script>
    layui.cache.page = 'user';
    layui.cache.user = {
        username: '游客'
        ,uid: -1
        ,avatar: '../../res/images/avatar/00.jpg'
        ,experience: 83
        ,sex: '男'
    };
    layui.config({
        version: "3.0.0"
        ,base: '/vendor/laracms/plugins/layui/mods/'
    }).extend({
        fly: 'index'
    }).use(['fly']);



</script>