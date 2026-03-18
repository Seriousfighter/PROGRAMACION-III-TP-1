# Reserva de PASTELERIA

El dominio de la aplicación es la industria pastelera, enfocándose en la gestión de pedidos personalizados de tortas. El sistema conecta a clientes con pastelerías o reposteros para gestionar todo el ciclo de la reserva: desde la personalización de sabores y diseños hasta la coordinación de la fecha de entrega.

Su propósito es simplificar y agilizar el proceso de reserva, reemplazando la comunicación desorganizada de redes sociales por una plataforma centralizada. Los clientes pueden cotizar y personalizar su torta de manera intuitiva, mientras que los vendedores organizan su producción y pagan de forma eficiente.

## INTEGRANTES
    -Klehr, Indira Ayelén 18375
    -Schneider, Alan Nahuel 18379
    -Juárez, Pablo 18391 
    -Jacob, Jose Waldemar 18393
## Objetivo

    -LA APP PERMITIRA LA RESERVA DE TORTAS
    -PERMITIENDO LA SELECCION DE SUS INGREDIENTES

## USUARIOS

    -ADMINISTRADOR (PANIFICADOR)
    -CLIENTE

## MVP
    RESOLVIENDO EL PROBLEMA DE LA PUNTUALIDAD DE LA DEMANDA DE PASTELERIA
    CON UN ALCANCE INICIAL PARA CLIENTELA FRECUENTE PERO ESCALABLE 

### ENTIDADES 
    -TORTAS 
        -NOMBRE VARCHAR
        -TAMAÑO VARCHAR
    -INGREDIENTES
        -NOMBRE VARCHAR
  
### RELACION ##
    TORTA:INGREDIENTES
    1:N

    
### ADMINISTRADOR:
    -TAMANIO TORTA(S.M.L.)
        -CREAR
        -EDITA
        -ELIMINA
        -MUESTRA
    -INGREDIENTES
        -CREA
        -EDITA
        -ELIMINA
        -MUESTRA
### CLIENTE
    -PEDIDO
        -CREAR
        -EDITA
        -MOSTRAR
        -ELIMINAR

## HISTORIA DE USUARIOS

    -Como administrador puedo sacar y poner rellenos.
    -Como administrador puedo poner listo o disponible el pedido
    -Como cliente puedo encargar una torta con mis gustos favoritos
    -Como cliente puedo cancelar pedidos.
    -Como cliente puedo elegir tamanio y peso

## ENDPOINT 
    -GET /INGREDIENTES DEVUELVE LA VISTA CON LA LISTA DE INGREDIENTES
    -POST /PEDIDOS CREA EL PEDIDO DE LA TORTA CON INGREDIENTES
    -POST /INGREDIENTES CREA UN INGREDIENTE
    -GET/INGREDIENTE/{ID} DEVUELVE UN INGREDIENTE (PARA MOSTRARLO)
    -PUT/PATCH /INGREDIENTE/{ID} REALIZA UN CAMBIO EN EL INGREDIENTE

### ADMINISTRADOR

### CLIENTE