GameServer Rpg 游戏服务端
===============================

workman 实现双向实时通信 <br/>
redis 实现游戏角色属性快速计算 <br/>
yii 作为MVC框架<br/>
![示例图片](https://github.com/boolean-wang/GameServer/blob/master/frontend/resource/example/2017-04-19_013247.png)
代码结构
-------------------

```
common
    config/              公用项目配置
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          数据库迁移
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    behaviors/           提供行为扩展 
    config/              当前应用配置
    controllers/         基本的 curd
    GatewayWorker/       workman 双向实时通信
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    service/             service层  controller 不直接操作model
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
