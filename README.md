Ejercicio con Symfony 3.4
========================

Enunciado
--------------

Se tiene una plataforma de venta on line compuesta por una API REST y distintas aplicaciones clientes que hacen uso
de esta API.

Cuando un usuario finaliza un pedido desde una aplicación móvil esta lanza una petición con los siguientes datos:

* Nombre y apellidos del cliente
* Email (Único por cliente)
* Teléfono
* Dirección de entrega (solo puede existir una por pedido)
* Fecha de compra
* Fecha de entrega
* Franja de hora seleccionada para la entrega
* Importe total
* Productos seleccionados con sus atributos (al menos 5 productos)
* * Nombre
* * Descripción
* * Unidades
* * Precio
* * Tienda de venta

Por otro lado los usuarios pueden ver, una vez finalizado un pedido, qué productos hay de una determinada tienda.

Según esta especificación se va crear dos puntos de entrada:

* POST /products: servicio donde las aplicaciones envían los datos para finalizar una compra.
* GET /products/order/{x}/shop/{y}: servicio donde las aplicaciones obtienen la información del pedido (x) y los productos de una tienda (y).

Tanto para el envió de datos como la obtención de datos se va a utilizar el formato JSON.

* /products *

* Sólo va a gestionar las peticiones POST. Cualquier otro tipo dara como resultado un código de error HTTP 404.
* El email debe ser único. Si el email ya está registrado la API devolverá un código de error HTTP 409 con un mensaje.
* Si la finalización del pedido se ha hecho con éxito se devuelve un código de error HTTP 200.

Ejemplo de entrada de datos JSON:

{
	"customer": {
		"name_and_surname": "Tony Stark",
		"email": "tony@starkindustries.com",
		"phone_number": "+9966666666"
	},
	"order": {
		"address": "10880 Malibu Point, Florida",
		"bought_at": "2018-01-01 12:00:01",
		"deliver_date": "2018-01-02",
		"deliver_hours": "11:00-13:15",
		"price": "25.03",
		"items": [
			{
				"name": "Carrots",
				"description": "Purple carrots bag.",
				"amount": "1",
				"price": "1.20",
				"shop_id": "1"
			},
			{
				"name": "Onion",
				"description": "Onions from Cuenca.",
				"amount": "3",
				"price": "1.80",
				"shop_id": "1"
			},
			{
				"name": "Avocado",
				"description": "Avocado from Brasil.",
				"amount": "4",
				"price": "4.50",
				"shop_id": "1"
			},
			{
				"name": "Banana",
				"description": "Banana from Canaria.",
				"amount": "6",
				"price": "1.50",
				"shop_id": "1"
			},
			{
				"name": "Orange",
				"description": "Orange from Valencia.",
				"amount": "1",
				"price": "1.30",
				"shop_id": "2"
			}
		]
	}
}

* /products/order/{x}/shop/{y} *

* Si el pedido no existe se devuelve un código HTTP 404.
* Si el pedido existe y no hay productos de esa tienda se devuelve un código HTTP 200 con un resultado de array vacio.
* Si el pedido existe y hay products de la tienda se devuelve un código HTTP 200 con un JSON con el siguiente formato:

Ejemplo de respuesta JSON:
{"products":[{"order_id":35,"shop_id":1,"name":"Carrots","description":"Purple carrots bag.","amount":1,"price":"1.20"},{"order_id":35,"shop_id":1,"name":"Onion","description":"Onions from Cuenca.","amount":3,"price":"1.80"},{"order_id":35,"shop_id":1,"name":"Avocado","description":"Avocado from Brasil.","amount":4,"price":"4.50"},{"order_id":35,"shop_id":1,"name":"Banana","description":"Banana from Canaria.","amount":6,"price":"1.50"}]}




Symfony Standard Edition
========================

**WARNING**: This distribution does not support Symfony 4. See the
[Installing & Setting up the Symfony Framework][15] page to find a replacement
that fits you best.

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev env) - Adds code generation
    capabilities

  * [**WebServerBundle**][14] (in dev env) - Adds commands for running applications
    using the PHP built-in web server

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/3.4/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.4/doctrine.html
[8]:  https://symfony.com/doc/3.4/templating.html
[9]:  https://symfony.com/doc/3.4/security.html
[10]: https://symfony.com/doc/3.4/email.html
[11]: https://symfony.com/doc/3.4/logging.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: https://symfony.com/doc/current/setup/built_in_web_server.html
[15]: https://symfony.com/doc/current/setup.html
