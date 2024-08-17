# Installation guide

1. Having docker installed and started you initially start by installing rabbit mq by this command ```# latest RabbitMQ 3.13
docker run -it --rm --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:3.13-management```

2. create file called composer.json 
``` 
{
    "require": {
        "php-amqplib/php-amqplib": "^3.2"
    }
}
```
Run these commands 
3. The  run composer update in terminal 
4. Run php send.php
5. run php receive.php // in an other tab of terminal
Whenever you hit php send.php we expect to see message from receiver.php terminal 

