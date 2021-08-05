<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Test Laravel

### 1) Visualiza las siguientes estructuras de tablas.

Invoice (id, date, user_id, seller_id, type)  
Product (id, invoice_id, name, quantity, price)  
En base a esas estructuras, genera utilizando Eloquent, las consultas para obtener la siguiente información:

- Obtener precio total de la factura

  `$invoice = 1; //id de invoice a consultar`  
  `$query = Invoice::where('invoices.id',$invoice)`  
  `->leftJoin('products','products.invoice_id','=','invoices.id')`  
  `->groupBy('invoices.id')`  
  `->selectRaw('sum(products.price * products.quantity) as total, invoices.id')->first()`  
  `//show total`  
  `$query->total;`
- Obtener todos id de las facturas que tengan productos con cantidad mayor a 100.  
  `Invoice::whereHas('products',function($query){`  
  `$query->where('quantity','>',100);`  
  `})->select('id')->get();`
- Obtener todos los nombres de los productos cuyo valor final sea superior a $1.000.000 CLP.  
  
  `Product::whereRaw('quantity * price > 1000000')->select('name')->get();`

### 2) Indica paso a paso los comandos para una instalación básica de Laravel que me permita ver la página principal (recuerda describir qué hace cada comando).

`composer create-project laravel/laravel new-project`

Este comando te creará la carpeta de tu nuevo proyecto, que tendrá el nombre en este caso de "new-project" y dentro de
tal directorio colocará todos los archivos del proyecto Laravel.

`cd new-project`

Accedemos a la carpeta del proyecto

`php artisan serve`

Este comando ejecuta la aplicación en un servidor de desarrollo incluido por defecto en Laravel. Por tanto debemos hacer
clic en la URL que nos muestra para explorar la aplicación en el navegador. Para detener la ejecución presiona Ctrl + C

Al ejecutar ese comando nos aparecerá un mensaje con la ruta del servidor recién instanciado, algo
como [http://127.0.0.1:8000](http://127.0.0.1:8000/)

### 3) Explícanos ¿qué es "Laravel Jetstream"? y ¿qué permite "Livewire" a los programadores?

Uno de los objetivos de un programador es ahorrar tiempo, teniendo una base sólida para comenzar nuevos proyectos es más
que suficiente. Algunos sistemas tan simples como el gestor de sesiones y doble factor de sesión llevarían horas de
programación. Pero con Laravel JetsStream sus módulos lo permitiran en tan solo unos minutos.

Jetstream ofrece una mesa de trabajo prediseñada para comenzar a desarrollar aplicaciones con Laravel, nos ayuda a tener una base solida para iniciar nuestros proyectos, acortando así los tiempos de desarrollo.

Livewire permite a los desarrolladores crear componentes Laravel que pueden comunicarse automaticamente entre la vista y
el controlador, de modo que se produzcan comportamientos dinámicos sin usar Javascript.

Por medio de componentes Livewire que se puede escribir con vistas de Blade, es posible conversar entre el cliente y el
servidor de una manera sencilla y sin necesidad de recargar la página. Gracias a Livewire el navegador puede reaccionar
dinámicamente a los cambios en los modelos del lado del servidor, mediante Ajax, pero sin usar Javascript.

Livewire permite realizar sitios web con una experiencia de usuario avanzada, similares a los que se realizaria con
sistemas como Vue o React, pero de una manera extremadamente más sencilla. 
