<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrucciones para Consumir API de Talentpitch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        pre {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            overflow-x: auto;
        }
        code {
            color: #c7254e;
            background-color: #f9f2f4;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<h1>Instrucciones para Consumir API de TalentPitch</h1>
<br>
<p>La URL que se usara para consumir la api es la siguiente:</p>
<a href="https://talentpitch-bdc75c6805c9.herokuapp.com/api/">https://talentpitch-bdc75c6805c9.herokuapp.com/api/</a>

<br>
<br>
<p>La api se usa para consumir.
    <code>
        <br>
        <br>*users
        <br>*challenges
        <br>*videos
        <br>
    </code>

    <br>todas se usan de la misma forma  y se muestra como ejemplo users
</p>

<h1>users</h1>

<pre><code>https://talentpitch-bdc75c6805c9.herokuapp.com/api/users</code></pre>


<h2>1. Paginacion GET</h2>
<p>Para obtener datos de la API:</p>
<p>se le pasa un parametro <b>paginate=5</b></p>
<pre><code>https://talentpitch-bdc75c6805c9.herokuapp.com/api/users?paginate=5</code></pre>

<h2>RESPUESTA</h2>

<pre><code>
        {
	"current_page": 1,
	"data": [
		{
			"id": 1,
			"name": "John Smith",
			"email": "john.smith@example.com",
			"image_path": "\/images\/john_smith.jpg",
			"created_at": "2024-08-06T21:26:01.000000Z",
			"updated_at": "2024-08-06T21:26:01.000000Z"
		},
		{
			"id": 2,
			"name": "Emily Brown",
			"email": "emily.brown@example.com",
			"image_path": "\/images\/emily_brown.jpg",
			"created_at": "2024-08-06T21:26:01.000000Z",
			"updated_at": "2024-08-06T21:26:01.000000Z"
		},
		{
			"id": 3,
			"name": "Michael Johnson",
			"email": "michael.johnson@example.com",
			"image_path": "\/images\/michael_johnson.jpg",
			"created_at": "2024-08-06T21:26:01.000000Z",
			"updated_at": "2024-08-06T21:26:01.000000Z"
		},
		{
			"id": 4,
			"name": "Sarah Davis",
			"email": "sarah.davis@example.com",
			"image_path": "\/images\/sarah_davis.jpg",
			"created_at": "2024-08-06T21:26:01.000000Z",
			"updated_at": "2024-08-06T21:26:01.000000Z"
		},
		{
			"id": 5,
			"name": "David Wilson",
			"email": "david.wilson@example.com",
			"image_path": "\/images\/david_wilson.jpg",
			"created_at": "2024-08-06T21:26:01.000000Z",
			"updated_at": "2024-08-06T21:26:01.000000Z"
		}
	],
	"first_page_url": "http:\/\/127.0.0.1:8000\/api\/users?page=1",
	"from": 1,
	"last_page": 1,
	"last_page_url": "http:\/\/127.0.0.1:8000\/api\/users?page=1",
	"links": [
		{
			"url": null,
			"label": "&laquo; Previous",
			"active": false
		},
		{
			"url": "http:\/\/127.0.0.1:8000\/api\/users?page=1",
			"label": "1",
			"active": true
		},
		{
			"url": null,
			"label": "Next &raquo;",
			"active": false
		}
	],
	"next_page_url": null,
	"path": "http:\/\/127.0.0.1:8000\/api\/users",
	"per_page": 5,
	"prev_page_url": null,
	"to": 5,
	"total": 5
}
    </code></pre>


<h2>2. User get</h2>
<p>Para obtener datos de la API:</p>
<p>Debe pasar id del usuario a consultar</p>
<pre><code>https://talentpitch-bdc75c6805c9.herokuapp.com/api/users/5</code></pre>

<h2>RESPUESTA</h2>

<pre><code>
        {
	"id": 5,
	"name": "David Wilson",
	"email": "david.wilson@example.com",
	"image_path": "\/images\/david_wilson.jpg",
	"created_at": "2024-08-06T21:26:01.000000Z",
	"updated_at": "2024-08-06T21:26:01.000000Z"
}
</code></pre>


<h2>3. Crear user POST</h2>
<p>Para crear datos en la API:</p>
<p>enviar los campos relacionados</p>
<pre><code>https://talentpitch-bdc75c6805c9.herokuapp.com/api/users


{
    "name": "Nombre",
    "email": "correo electronico",
    "image_path": "ruta de la imagen"
}</code></pre>

<h2>4. Actualizar user PUT</h2>
<p>Para actualizar datos de la API:</p>
<p>enviar los campos relacionados</p>
<pre><code>https://talentpitch-bdc75c6805c9.herokuapp.com/api/users/5

{
    "name": "Nombre actualizar",
    "email": "correo electronico actualizar",
    "image_path": "ruta actualizar"
}
    </code></pre>

<h2>5. Eliminar user DELETE</h2>
<p>Para eliminar datos de la API:</p>
<p>enviar los campos relacionados</p>
<pre><code>https://talentpitch-bdc75c6805c9.herokuapp.com/api/users/5</code></pre>

<h2>.ENV</h2>
<p>
    Se muestra estructura del .env con una key para openAI temporal para la prueba
</p>
<pre><code>

APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:cimaGShSKrHTtq6GyC0OyErJTdZ4qgvxdr96acNJ5/Q=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=blonze2d5mrbmcgf.cbetxkdyhwsb.us-east-1.rds.amazonaws.com
DB_PORT=3306
DB_DATABASE=epo5yd1jxf4skmug
DB_USERNAME=taiersfz2sunocsp
DB_PASSWORD=cbv93fcqgndppogf

_DB_CONNECTION=mysql
_DB_HOST=127.0.0.1
_DB_PORT=3306
_DB_DATABASE=talentpitch
_DB_USERNAME=root
_DB_PASSWORD=root

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

</code></pre>
</body>
</html>
