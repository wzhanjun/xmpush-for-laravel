## xmpush for laravel 

小米推送laravel包


#### 安装

	composer require wzj/xmpush-for-laravel


##### 添加服务提供者

	 Wzj\Push\XMPushServiceProvider::class,


#####  生成配置文件

	php artisan vendor:publish --provider="Wzj\Push\XMPushServiceProvider::class"