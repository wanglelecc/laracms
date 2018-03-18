## 关于LaraCMS

LaraCMS 是在学习 laravel 过程中产生的一个业余作品，试图通过简单的方式，快速构建一套基本的企业站同时保留很灵活的扩展能力和优雅的代码方式，当然这些都得益Laravel的优秀设计。同时LaraCMS 也是一个学习Laravel 不错的参考示例。


### 使用对象
有一定基础的 Laravel 开发者，非普通站长。

### 预览

<p><img src="http://img.56br.com/images/laracms-login.jpg"></p>
<p><img src="http://img.56br.com/images/laracms-main.jpg"></p>
<p><img src="http://img.56br.com/images/laracms.jpg"></p>

> UI 使用的 LayUI, 前端Logo还未来得及更改，请无视。

## 使用方式

```shell
composer update
php artisan migrate
php artisan db:seed
```
执行完就可以访问了。
http://<example.com>/administrator

> 注：要先配置好数据库，默认用户: admin@56br.com / 123456

## 说明
由于LaraCMS还未开发完成。所以谨慎使用。具体的开发文档，后续补充。

目前已完成的功能模块：
- 用户管理
- 权限管理
- 角色管理
- 站点信息
- 友情链接
- 栏目导航
- 分类管理
- 文章管理
- 页面管理
- 幻灯管理
- 微信公众号管理（微信接口已开发完毕，可能还需要debug）
- 前端模块（用户部分暂未完成）
- 前端API