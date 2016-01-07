# Tableme API Calls

Steps to creat an order.

1. Request for oauth token
------

```
POST /oauth/access_token HTTP/1.1
Host: <hostname>
Cache-Control: no-cache
Content-Type: application/x-www-form-urlencoded

client_id=<client_id>&client_secret=<client_secret>&username=<username>&password=<password>&grant_type=password
```

2. Get restaurant details. 
------

```
GET /v1/restaurants?access token=<oauth_token> HTTP/1.1
Host: <hostname>
Postman-Token: 3c581f1c-16a2-0e2b-deb4-ed3ddb7aebb0
```

3. Request for time availability.
------

```
GET /v1/restaurants/times?access token=<oauth_token>&restaurant_slug=<restaurant_slug> HTTP/1.1
Host: <hostname>
Cache-Control: no-cache
```

4. Reserve this table. This won't create an order but instead it will reserve (or hold) the table for your for 10 or 20 minutes.
------

```
POST /v1/reserve HTTP/1.1
Host: <hostname>
Content-Type: application/json
Cache-Control: no-cache

{
    "access_token": "<oauth_token>",
    "time": "18:00:00",
    "cover": "1",
    "menus": {
        "0":{
            "count": "1",
            "id": "125"
        }
    },
    "restaurant_slug": "<restaurant_slug>"
}
```

5. Complete the reservation by calling the order api
------

```
POST /v1/order HTTP/1.1
Host: <hostname>
Cache-Control: no-cache
Content-Type: application/x-www-form-urlencoded

billing_fname=<first_name>&billing_lname=<last_name>&billing_email=<email>&billing_phone=<phone>&hold_id=<reserve_id>&access+token=<oauth_token>
```

## Sample calls

Refer to index.php and API/DemoApi.php

## API Documentation

Refer to [documentation.html](documentation.html)
