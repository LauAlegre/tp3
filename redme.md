 Documentación de la API

 Productos

##Obtener Todos los Productos##

 Endpoint: /productos
Método HTTP: GET
Descripción: Obtiene una lista de todos los productos.

Parámetros:
 order (opcional): Orden de clasificación (ASC o DESC).
 sort (opcional): Campo de clasificación (por ejemplo, product_id, nombre_producto).

Respuesta:
Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si no se encuentran productos)

Ejemplo:
http GET http://example.com/productos


##Obtener Producto por ID##

Endpoint: /productos/:ID
Método HTTP: GET
Descripción: Obtiene un producto específico por ID.
Parámetros:

ID: ID del producto.
Respuesta:

Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si el producto con el ID especificado no existe)
Ejemplo: 
GET http://example.com/productos/1

##Eliminar Producto##

Endpoint: /productos/:ID
Método HTTP: DELETE
Descripción: Elimina un producto por ID.
Parámetros:

ID: ID del producto.
Respuesta:

Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si el producto con el ID especificado no existe)
Ejemplo:
DELETE http://example.com/productos/1

##Actualizar Producto##

Endpoint: /productos/:ID
Método HTTP: PUT
Descripción: Actualiza un producto por ID.
Parámetros:

ID: ID del producto.
Cuerpo de la Petición:
{
  "nombre_producto": "Nuevo Nombre",
  "tipo_de_product": "Nuevo Tipo",
  "precio": 19.99,
  "descripcion_product": "Nueva Descripción",
  "id_marca": 2
}
Respuesta:

Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si el producto con el ID especificado no existe)
Ejemplo:
PUT http://example.com/productos/1
Content-Type: application/json

{
  "nombre_producto": "Nuevo Nombre",
  "tipo_de_product": "Nuevo Tipo",
  "precio": 19.99,
  "descripcion_product": "Nueva Descripción",
  "id_marca": 2
}

##Crear Producto##

Endpoint: /productos
Método HTTP: POST
Descripción: Crea un nuevo producto.
Cuerpo de la Petición:
{
  "nombre_producto": "Nuevo Producto",
  "tipo_de_product": "Tipo",
  "precio": 29.99,
  "descripcion_product": "Descripción",
  "id_marca": 3
}

Respuesta:

Código de Éxito: 201 Creado
Código de Error: 400 Solicitud Incorrecta (si faltan campos obligatorios)

Ejemplo:
POST http://example.com/productos
Content-Type: application/json

{
  "nombre_producto": "Nuevo Producto",
  "tipo_de_product": "Tipo",
  "precio": 29.99,
  "descripcion_product": "Descripción",
  "id_marca": 3
}

###Marcas###

##Obtener Todas las Marcas##

Endpoint: /marcas
Método HTTP: GET
Descripción: Obtiene una lista de todas las marcas.
Parámetros:

order (opcional): Orden de clasificación (ASC o DESC).
sort (opcional): Campo de clasificación (por ejemplo, id_marca, marca).
Respuesta:

Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si no se encuentran marcas)
Ejemplo:

GET http://example.com/marcas

##Obtener Marca por ID##

Endpoint: /marcas/:ID
Método HTTP: GET
Descripción: Obtiene una marca específica por ID.
Parámetros:

ID: ID de la marca.
Respuesta:

Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si la marca con el ID especificado no existe)

Ejemplo:
GET http://example.com/marcas/1

##Eliminar Marca##

Endpoint: /marcas/:ID
Método HTTP: DELETE
Descripción: Elimina una marca por ID.
Parámetros:

ID: ID de la marca.
Respuesta:

Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si la marca con el ID especificado no existe)

Ejemplo:
DELETE http://example.com/marcas/1

##Actualizar Marca##
Endpoint: /marcas/:ID
Método HTTP: PUT
Descripción: Actualiza una marca por ID.
Parámetros:

ID: ID de la marca.
Cuerpo de la Petición:
{
  "marca": "Nueva Marca",
  "descripcion": "Nueva Descripción",
  "sede": "Nueva Sede"
}

Respuesta:

Código de Éxito: 200 OK
Código de Error: 404 No Encontrado (si la marca con el ID especificado no existe)

Ejemplo:
PUT http://example.com/marcas/1
Content-Type: application/json

{
  "marca": "Nueva Marca",
  "descripcion": "Nueva Descripción",
  "sede": "Nueva Sede"
}

##Crear Marca##

Endpoint: /marcas
Método HTTP: POST
Descripción: Crea una nueva marca.
Cuerpo de la Petición:
{
  "marca": "Nueva Marca",
  "descripcion": "Descripción de la Marca",
  "sede": "Sede de la Marca"
}

Respuesta:

Código de Éxito: 201 Creado
Código de Error: 400 Solicitud Incorrecta (si faltan campos obligatorios)
Ejemplo:

POST http://example.com/marcas
Content-Type: application/json

{
  "marca": "Nueva Marca",
  "descripcion": "Descripción de la Marca",
  "sede": "Sede de la Marca"
}












