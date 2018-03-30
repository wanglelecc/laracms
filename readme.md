## LaraCMS 后台管理系统 

> 新增预览：https://www.56br.com/

基于 laravel 5.5 开发，包含了 内容管理 和 API服务两部分。（又一个重复的轮子 :joy:）

LaraCMS 是在学习 laravel （ web 开发实战进阶 + 实战构架 API 服务器） 过程中产生的一个业余作品，试图通过简单的方式，快速构建一套基本的企业站同时保留很灵活的扩展能力和优雅的代码方式，当然这些都得益Laravel的优秀设计。同时LaraCMS 也是一个学习Laravel 不错的参考示例。


### 使用对象
有一定基础的 Laravel 开发者，非普通站长。

### 预览

<p><img src="http://img.56br.com/images/laracms-login.jpg"></p>
<p><img src="http://img.56br.com/images/laracms-main.jpg"></p>
<p><img src="http://img.56br.com/images/laracms.jpg"></p>

- http://img.56br.com/images/laracms-login.jpg
- http://img.56br.com/images/laracms-main.jpg
- http://img.56br.com/images/laracms.jpg

> UI 使用的 LayUI, 前端Logo还未来得及更改，请无视。

## 使用方式

```shell
composer update
php artisan migrate
php artisan db:seed
php artisan storage:link
```
执行完就可以访问了（要先配置好虚拟主机）。
http://example.com/administrator

> 注：要先配置好数据库，默认用户: admin@56br.com / 123456

## 说明
由于 LaraCMS 还未开发完成。所以谨慎使用。具体的开发文档，后续补充。

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
- 微信公众号管理
- 前端模块（用户部分暂未完成）
- 前端 API

> 注：自动代码生成工具请使用，make:laracms-administrator 具体用法与 make:scaffold 一致。

Github 地址 https://github.com/wanglelecc/laracms
