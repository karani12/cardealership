## Car Dealership

> This is a car dealership that has been established to have different services for users and cars.

- It uses JWT for authentication
- Communication of the services is through restful API.
- The car-service has a validateToken middleware that checks if the token is valid.
- The car-service uses pusher to notify the user when a car is added/updated/deleted.

## Installation

```sh
git clone 

cd cardealership

cd user-service

composer install

php artisan migrate

php artisan serve

```

```sh

cd cardealership
cd car-service

composer install

php artisan migrate

php artisan serve

```

## Usage example

The user-service has the following endpoints:

- POST /api/auth/register
- POST /api/auth/login
- GET /api/auth/logout
- GET /api/auth/validate

The car-service has the following endpoints:

- POST /api/cars
- GET /api/cars
- GET /api/cars/{car}
- PUT /api/cars/{car}
- DELETE /api/cars/{car}

## Development setup

The app assumes the following approach:

> These are two separate services that are running on different ports. The user-service is running on port 8000 and the car-service is running on port 8001.

Register the user service url in the car service .env file

```sh
AUTH_DOMAIN=http://localhost:8000/api/auth
```

## Meta

I could have used same database for the services but decided to just use separate sqlite databases for each service.

The Car model has observer that listens for the created, updated and deleted events and broadcasts the event to the pusher channel.

Since laravel has many files in its structure, it is more suited for the MVC architecture and I was not sure how to separate the services into different folders.



> Remember to set the pusher credentials in the .env file of the car-service

```sh
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

Test the pusher notifications using postman or any other tool to say create and have an index.html file that listens for the pusher event.

add your key and cluster to the index.html file

The events to the channels are :

`user-{userId}`
and events are `car-added`, `car-updated`, `car-deleted`

```html
<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('KEY', {
      cluster: 'CLUSTER'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>
```


### improvements

- use a single database for the services to avoid duplication of data + use appropriate relationships
- put a modular structure for the services
- use a queue to handle the pusher notifications
- use a queue to handle the events for the car model


