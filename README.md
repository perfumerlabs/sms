What is it
==========

This is a container providing API to send sms through external SMS providers.
Currently only [SMSC.RU](https://smsc.ru/) provider is supported.
It is recommended to set up this container to work in conjunction with [Queue](https://github.com/perfumerlabs/queue) container.

Installation
============

```bash
docker run \
-p 80:80/tcp \
-e SMS_HOST=example.com \
-e SMS_PROVIDER=smscru \
-e SMS_DUMMY=false \
-e SMSCRU_SENDER=sender \
-e SMSCRU_USERNAME=username \
-e SMSCRU_PASSWORD=password \
-d perfumerlabs/sms:v1.0.0
```

Environment variables
=====================

- SMS_HOST - server domain (without http://). Required.
- SMS_PROVIDER - Sms provider to use. Required. Currently the only value is "smscru".
- SMS_DUMMY - If this is "true", sms will not be sent, but response will be as sms was successfully sent. Useful in development configurations. Optional. Default is "false".
- SMSCRU_SENDER - [smsc.ru](https://smsc.ru) provider sender name for sms. Required, if this provider is used.
- SMSCRU_USERNAME - [smsc.ru](https://smsc.ru) provider login. Required, if this provider is used.
- SMSCRU_PASSWORD - [smsc.ru](https://smsc.ru) provider password. Required, if this provider is used.
- PHP_PM_MAX_CHILDREN - number of FPM workers. Default value is 10.
- PHP_PM_MAX_REQUESTS - number of FPM max requests. Default value is 500.

Volumes
=======

This image has no volumes.

If you want to make any additional configuration of container, mount your bash script to /opt/setup.sh. This script will be executed on container setup.

Supported providers for now
===========================

1. [smsc.ru](https://smsc.ru) - code "smscru"

Feel free to request support for any other sms providers.

API Reference
=============

### Send sms

`POST /sms`

Parameters (json):
- phones [array|string,required] - phones to send to, without "+".
- message [string,required] - message text to send.

Request example:
```javascript
{
    "phones": ["77011234567", "77070001234"],
    "message": "Hello, world!"
}
```

Response example:

```javascript
{
    "status": true
}
```