# INDICE

1. Análisis y explicación del Proyecto de Fin de Grado
    1. Introducción y explicación
    2. Objetivo y finalidad del proyecto

2. Planificación previa
    1. Tecnología utilizada para la realización del Proyecto
    2. Desarrollo del programa

3. Problemas y soluciones
    1. Problemas encontrados a la hora de realizar el proyecto.
    2. Soluciones realizadas.

4. Despliegue de aplicación
    1. Tecnología utilizada finalmente para el despliegue del programa final.

5. Conclusión
    1. Revisión de los objetivos previos
    2. Funcionalidad del programa
    3. Finalidad del proyecto




---

## **1. ANÁLISIS Y EXPLICACIÓN DEL PROYECTO DE FIN DE GRADO**
### 1.1. INTRODUCCIÓN Y EXPLICACIÓN DEL PROYECTO

He realizado una página web para el Grupo Scout al que pertenezco y también he creado una aplicación para gestionar el inventario que tiene el grupo y la solicitud y devolución de los materiales.


  #### Página web
  La página web consta de una serie de apartados:

   - Entradas específicas para conocer tanto la historia del escultismo, el movimiento scout cómo un apartado para la historia de nuestro grupo Scout.
   - Un apartado dónde puedes ver todas las actividades realizadas por el grupo, las futuras actividades a realizar y una breve explicación de lo que hacemos en cada una de ellas.
   - Unos enlaces para poder acceder a nuestras distintas redes sociales.
   - Tiene un apartado para la gestión de la secretaría del grupo, esta consta de una serie de formularios los cuáles genera unos pdfs con los datos que se le introduce en el formulario. Este apartado es bastante interesante ya que se tiene mayor control de los miembros del grupo. Se puede crear cualquier tipo de formulario y modificando el css de la aplicación podemos cambiar el resultado del pdf.
   - Tiene otro apartado también para la tesorería del grupo (cómo son los datos bancarios para poder pasarle las cuentas), otro que sería para tema de salud (un certificado que indica si tiene o no alguna enfermedad y otro documento el cuál permite a los responsables dar un medicamento en específico).
   - Contará también con un apartado de reservas de la nave del grupo.


   ### Inventario del grupo
   Ahora mismo está puesto en una página web en Local y consta de 3 aplicaciones en específico:
   - La primera es una aplicación (realizada a código), la cuál escribe un formulario en la web (a través de un shortcode) y los datos recibidos se guardan en una tabla en la base de datos de mysql, la cuál si no está creada la crea por primera vez con el tipo de dato necesario, y después comprueba si ya está creada y de ser así va ingresando los datos en su orden, la cuál servirá para realizar la entrada de los materiales, esta aplicación también dibuja una tabla en el backend de la web a parte de hacerlo en la base de datos de mysql.
   - La segunda es una aplicación, también realizada a código, del mismo estilo que la anterior pero la diferencia es que esta generará un formulario para la solicitud/devolución de los materiales. Generando también una tabla en la base de datos (si no existiese previametne), una tabla en el backend de wordpress.
   - Por último hacemos uso de la aplicación WpDataTable, la cuál hace una llamada a la base de datos de mysql cogiendo los datos de la tabla que nosotros queramos y así podamos proyectarlo en la página web.

Para finalizar este apartado he escrito una configuración en *"config.php"*, en la cuál escribimos los siguientes comandos:

    - define('WP_DEBUG', true);
    - define('WP_DEBUG_LOG', false);
    - define('WP_DEBUG_LOG', true);
    
      
> El cuál hace que los fallos de la página de WordPress se presenten en un documento "debug.log" que encontraremos en la carpeta de wp-content. Eso se usa ya que hay algunos problemas que el propio sistema de fallos de WordPress no te detecta, pero el debug_log si, por tanto, hacemos que se escriban en un fichero para que podamos leerlo y así corregir los errores pertinentes.


## 1.2. OBJETIVO Y FINALIDAD DEL PROYECTO.

El proyecto tiene diferentes objetivos y finalidades:

- Realizar una página web para que se conozca quiénes son los Scout, que hacemos, pero sobre todo que se conozca al grupo Scout de San Benito.
- Tener un control exhaustivo de la participación de los miembros del grupo en las actividades y así tener el control de las autorizaciones para participar en las actividades.
- Tener un control exhaustivo de los documentos, tanto de los miembros del grupo, cómo tener un control también de las solicitudes de admisión.
- Enseñar que hace el grupo Scout en el día a día, realizando también un enlace a las redes sociales del grupo.
- Tener un control del uso de la nave y así también poder dejarlapara alquilar.
- Poder tener un control del inventario del grupo en la web, así también tener el control de los gastos que produce la compra de los materiales.
- Tener un apartado en la web para poder solicitar/devolver un material con el que cuenta el grupo.

---

## **2. PLANIFICACIÓN PREVIA**

### 2.1 TECNOLOGÍA UTILIZADA PARA LA REALIZACIÓN DEL PROYECTO

Para la realización de este proyecto he utilidado diferentes tecnologías:
- El editor de Visual Studio Core para todos los apartados que consta de edición/creación/modificación de código. Lo he usado especialmente en aplicaciones como:
    - Inventariado, aplicación creada para manejar el inventario del grupo.
    - Solicitud/Devolución creada para tener un registro de los materiales que se solicitan y los que se devuelven, al mismo tiempo tener un poco el control del estado de estos.
    - También para la creación de la documentación que está escrita en .md
    - Configuración del apartado de "Debug_log" para que wordpress muestre todos los errores ahí.

- WordPress para el manejo de la web principal del grupo Scout San Benito. Dentro de este WordPress uso aplicaciones cómo:
    - Administrador de los archivos de WP, que sirve para ver el FTP sin tener que entrar en el panel de control, si no desde el mismo WordPress.
    - Editor Tools es un editor de código y un editor en bloque.
    - Diferentes aplicaciones de WooCommerce, las usamos para que se generen las autorizaciones y por si en algún momento queremos vender algún producto también estaría configurado ya.
    - El conjunto de aplicaciones de Contact Form 7, se usará para crear los formularios.
    - ManuSoft aplicación usada para la generación de pdfs en los formularios.
    - Diferentes aplicaciones para la optimización de las fotografías cómo son Regenerate Thumbnails, Photonic Gallery, Smush.
    - Una aplicación también muy importante es la Protección de datos de RGPD ya que hay mucho tráfico de documentación por la web.

- Xampp para el funcionamiento de un wordpress local y luego poder hacer la migración una vez creado completo. Para el acceso a la base de datos de MYSQL.
- GitHub para la subida de los documentos .md, las aplicaciones de Inventario y Solicitud y para la subida de la aplicación wpDatatable.
- Drive para la suibida de la máquina Virtual con las aplicaciones instaladas, la subida del PowerPoint y documentación solicitada.
- VirtualBox para poder hacer una máquina virtual de Windows y así instalar en esta Xampp para el uso de las diferentes aplicaciones.


### 2.2 DESARROLLO DEL PROGRAMA
Empecé el programa creando la página web del grupo con sus diferentes funcionalidades, buscando y modificando las aplicaciones pertinentes para que funcionara tal y cómo tenía pensado en los objetivos.

Después me centré sobre todo en la aplicación del Inventario ya que era algo más específico y más complicado de conseguir. 
Esta aplicación consta de varias partes:

1. A la hora de crear una aplicación para WordPress es importante poner el apartado de **Plugin Name**, **Author** y  **Description** tal cuál, ya que sirve para la documentación previa que se verá en el apartado de *Plugins* en nuestro WordPress, explicando el nombre, el autor y una breve descripción de lo que hace nuestra aplicación. Se le puede añadir más apartado cómo la versión de la aplicación.

2. Llamamos a uno de los hook de wordpress, para ello usamos la función **register_activation_hook**, la cuál necesita dos parametros, el primero es *$file:string* que usará el fichero principal de nuestro Plugin, para indicarle la ruta del fichero usamos la variable de php __FILE__ que nos va a devolver la ruta del fichero que estamos actualmente, *$function:callable* que llamará a la función que le indiquemos que use.

3. Invocamos una variable global de wordpress *$wpdb* a la cuál se le harán las consultas en SQL, para ello primero creamos el nombre de la tabla y para ello usamos la función *$nombreTabla = $wpdb->prefix . "concatenando el nombre que queramos añadirle"* esto tiene cómo resultado *wp_inventario*. Es importante es utilizar el mismo orden que estamos usando en la base de datos, cómo esto puede variar dependiendo del usuario utilizaremos una función de php que nos lo ordena *$charset_collate = $wpdb->get_charset_collate()* y por último escribimos nuestra consulta de SQL.

4. Para crear la consulta usamos la función *$query ="CREATE TABLE IF NOT EXISTS $nombreTabla"*. Y creamos la consulta cómo se puede ver en el "inventariado.php". Por último, una vez cerrada la consulta le volvemos a poner la variable *$charset_collate* para indicarle el orden en el que queremos los datos. Para finalizar vamos a lanzar esta consulta para que se cree la tabla, para ello nos hace falta una función que se llama *dbDelta($query)* pero para asegurarnos de que esté disponible tenemos que poner la función de WordPress *include_once ABSPATH . 'wp-admin/includes/upgrade.php'* esto hace que llame de forma seguro a la función *dbDelta*.
 
5. Para comprobar que la consulta está bien creada y no nos hemos equivocado escribimos las funciones de debug, en nuestro fichero *wp-config.php*, para hacerlo primero activamos las funciones de debug de wordpress:
    - Tenemos que definir una constante *define('WP_DEBUG', true)*, así WordPress sabrá que que queremos activar dicha función.
    - Luego ponemos la función *define('WP_DEBUG_DISPLAY', false)*, para que no se pinten los errores en la pantalla de WordPress, ya que de ser así podría volver un poco loco a aquellas personas que no tengan conocimiento del código y vean nada más que los errores.
    - Para nosotros poder ver dichos errores usamos la función *define('WP_DEBUG_LOG', true)* que enviará los errores a un fichero, el cuál se encuentra en la ruta por defecto del fichero de log, que se encuentra en /wp-content/debug.log

6. En caso de que falle la consulta, podríamos ir a mysql, generarla directamente en el SQL y así sabremos que fallos nos estaría dando.

7. Una vez creada la tabla, haremos que se guarde en ella los datos de los formularios, para ello lo primero es saber si los datos están rellenos. Para ello usamos un *if()*, si vienen rellenos utilizaremos la clase de WordPress **global $wpdb**y el método **$wpdb->insert($nombreTabla, ...)** para poder insertar los datos en nuestra tabla. Comprobamos que los datos no vengan vacíos, y cómo es un formulario también saneamos las respuestas de los usuarios convirtiendo los datos que nos vengan en el formato que nosotros habíamos solicitado.

8. Definimos el shortcode que pinta el formulario, par ello usamos la función **add_shortcode**, la cuál tiene un *$tag:string* el cuál será el resultado de nuestro shortcode, y una función *&callback:callable*, que se usará para llamar a la función que queremos que genere nuestro shortcode.
9. Empezamos a escribir la función dónde se encuentra nuestro formulario, para ello en vez de hacerla mediante echo o print, vamos a usar una función de php que abre un flujo de salida en html y luego lo cierra y al cerrarlo demuestra el html que hayamos escrito, esta función se llama **ob_start()** y después ponemos **return ob_get_clean()** para que nos lo devuelva limpio. Tenemos que cerrar y abrir el <?php ?> cada vez que sea necesario para que así funcione bien nuestro formulario.
10. Vamos a escribir nuestro formulario con un method="post" y ponemos una clase para después editar el css y muy importante poner un action par que cuando alguien envíe el formulario le indiquemos que queremos que devuelva la misma página, para ello ponemos un enlace permanente con una función de php, **get_the_permalink()**. Después empezamos a escribir nuestro formulario con html.

11. Añadimos la función de wordpress **wp_enqueue_style('css_aspirante', plugins_url('fichero.css'__FILE__)**, el cuál nos cogerá el archivo css, de la carpeta dónde se encuentra nuestro plugin y lo usará cómo hoja de estilo para nuestro formulario. Esta es una función php por eso tiene que estar antes del **ob_start()**.

12. La función *wp_nonce_field('graba_inventario', 'inventario_nonce')* de php crea unos campos ocultos en el formulario con un tokken para verificar la validez del formulario. 

13. Para crear la página de administración de nuestra aplicación en WordPress usamos la función **add_action** *("admin_menu", "NombreFuncion")*, después desarrollamos la función. Esta función debe añadir una página de menú, para esto  usamos la función **add_menu_page** *("Nombre que tenga el panel de administración", "Texto que aparece en el menú izquierdo", "nivel de privilegios", "slug" , "función encargada de pintar en el panel de administración", "url con icono, o dachicons de wordpress", numero para localización del menú)*


14. Se define la función comentada anteriormente, esta imprimirá el código html que necesitamos para pintar una tabla dónde entrarán todos los registros, realizar una consulta SQL para mostrar todos los registros que se han grabado y recorrer con un bucle los registros para irlos mostrando y después pues ya cerrar el html. Volvemos a usar la variable de **global $wpdb**  cómo siempre hacemos cuando trabajamos con la base de datos, preparamos una variable que me va a almacenar el nombre de la tabla dónde hemos ido guardando los registros **$nombreTabla = $wpdb->prefix . 'tabla'**, realizamos la consulta con una variable nueva a la base de datos *$variable = $wpdb->get_resutls("SELECT * FROM $nombreTabla")*, después empezamos a crear el panel de administración con diferentes *echo* y por último creamos un *foreach($variable as $tabla*), para hacer el bucle dependiendo de los datos que se generan en el formulario tendremos que usar *esc_textarea* si es tipo texto o *(int)* si es tipo número, cerramos el bucle dibujando el cierre de la tabla.


Una vez finalizado el Inventario, me centré en Solicitud/Devolución ya que una vez conseguido el inventario, este tenía un poco la misma dinámica pero con datos diferentes. 
Esta aplicación consta de varias partes:

1. A la hora de crear una aplicación para WordPress es importante poner el apartado de **Plugin Name**, **Author** y  **Description** tal cuál, ya que sirve para la documentación previa que se verá en el apartado de *Plugins* en nuestro WordPress, explicando el nombre, el autor y una breve descripción de lo que hace nuestra aplicación. Se le puede añadir más apartado cómo la versión de la aplicación.

2. Llamamos a uno de los hook de wordpress, para ello usamos la función **register_activation_hook**, la cuál necesita dos parametros, el primero es *$file:string* que usará el fichero principal de nuestro Plugin, para indicarle la ruta del fichero usamos la variable de php __FILE__ que nos va a devolver la ruta del fichero que estamos actualmente, *$function:callable* que llamará a la función que le indiquemos que use.

3. Invocamos una variable global de wordpress *$wpdb* a la cuál se le harán las consultas en SQL, para ello primero creamos el nombre de la tabla y para ello usamos la función *$nombreTabla = $wpdb->prefix . "concatenando el nombre que queramos añadirle"* esto tiene cómo resultado *wp_inventario*. Es importante es utilizar el mismo orden que estamos usando en la base de datos, cómo esto puede variar dependiendo del usuario utilizaremos una función de php que nos lo ordena *$charset_collate = $wpdb->get_charset_collate()* y por último escribimos nuestra consulta de SQL.

4. Para crear la consulta usamos la función *$query ="CREATE TABLE IF NOT EXISTS $nombreTabla"*. Y creamos la consulta cómo se puede ver en el "inventariado.php". Por último, una vez cerrada la consulta le volvemos a poner la variable *$charset_collate* para indicarle el orden en el que queremos los datos. Para finalizar vamos a lanzar esta consulta para que se cree la tabla, para ello nos hace falta una función que se llama *dbDelta($query)* pero para asegurarnos de que esté disponible tenemos que poner la función de WordPress *include_once ABSPATH . 'wp-admin/includes/upgrade.php'* esto hace que llame de forma seguro a la función *dbDelta*.
 
5. Para comprobar que la consulta está bien creada y no nos hemos equivocado escribimos las funciones de debug, en nuestro fichero *wp-config.php*, para hacerlo primero activamos las funciones de debug de wordpress:
    - Tenemos que definir una constante *define('WP_DEBUG', true)*, así WordPress sabrá que que queremos activar dicha función.
    - Luego ponemos la función *define('WP_DEBUG_DISPLAY', false)*, para que no se pinten los errores en la pantalla de WordPress, ya que de ser así podría volver un poco loco a aquellas personas que no tengan conocimiento del código y vean nada más que los errores.
    - Para nosotros poder ver dichos errores usamos la función *define('WP_DEBUG_LOG', true)* que enviará los errores a un fichero, el cuál se encuentra en la ruta por defecto del fichero de log, que se encuentra en /wp-content/debug.log

6. En caso de que falle la consulta, podríamos ir a mysql, generarla directamente en el SQL y así sabremos que fallos nos estaría dando.

7. Una vez creada la tabla, haremos que se guarde en ella los datos de los formularios, para ello lo primero es saber si los datos están rellenos. Para ello usamos un *if()*, si vienen rellenos utilizaremos la clase de WordPress **global $wpdb**y el método **$wpdb->insert($nombreTabla, ...)** para poder insertar los datos en nuestra tabla. Comprobamos que los datos no vengan vacíos, y cómo es un formulario también saneamos las respuestas de los usuarios convirtiendo los datos que nos vengan en el formato que nosotros habíamos solicitado.

8. Definimos el shortcode que pinta el formulario, par ello usamos la función **add_shortcode**, la cuál tiene un *$tag:string* el cuál será el resultado de nuestro shortcode, y una función *&callback:callable*, que se usará para llamar a la función que queremos que genere nuestro shortcode.
9. Empezamos a escribir la función dónde se encuentra nuestro formulario, para ello en vez de hacerla mediante echo o print, vamos a usar una función de php que abre un flujo de salida en html y luego lo cierra y al cerrarlo demuestra el html que hayamos escrito, esta función se llama **ob_start()** y después ponemos **return ob_get_clean()** para que nos lo devuelva limpio. Tenemos que cerrar y abrir el <?php ?> cada vez que sea necesario para que así funcione bien nuestro formulario.
10. Vamos a escribir nuestro formulario con un method="post" y ponemos una clase para después editar el css y muy importante poner un action par que cuando alguien envíe el formulario le indiquemos que queremos que devuelva la misma página, para ello ponemos un enlace permanente con una función de php, **get_the_permalink()**. Después empezamos a escribir nuestro formulario con html.

11. Añadimos la función de wordpress **wp_enqueue_style('css_aspirante', plugins_url('fichero.css'__FILE__)**, el cuál nos cogerá el archivo css, de la carpeta dónde se encuentra nuestro plugin y lo usará cómo hoja de estilo para nuestro formulario. Esta es una función php por eso tiene que estar antes del **ob_start()**.

12. La función *wp_nonce_field('graba_inventario', 'inventario_nonce')* de php crea unos campos ocultos en el formulario con un tokken para verificar la validez del formulario. 

13. Para crear la página de administración de nuestra aplicación en WordPress usamos la función **add_action** *("admin_menu", "NombreFuncion")*, después desarrollamos la función. Esta función debe añadir una página de menú, para esto  usamos la función **add_menu_page** *("Nombre que tenga el panel de administración", "Texto que aparece en el menú izquierdo", "nivel de privilegios", "slug" , "función encargada de pintar en el panel de administración", "url con icono, o dachicons de wordpress", numero para localización del menú)*


14. Se define la función comentada anteriormente, esta imprimirá el código html que necesitamos para pintar una tabla dónde entrarán todos los registros, realizar una consulta SQL para mostrar todos los registros que se han grabado y recorrer con un bucle los registros para irlos mostrando y después pues ya cerrar el html. Volvemos a usar la variable de **global $wpdb**  cómo siempre hacemos cuando trabajamos con la base de datos, preparamos una variable que me va a almacenar el nombre de la tabla dónde hemos ido guardando los registros **$nombreTabla = $wpdb->prefix . 'tabla'**, realizamos la consulta con una variable nueva a la base de datos *$variable = $wpdb->get_resutls("SELECT * FROM $nombreTabla")*, después empezamos a crear el panel de administración con diferentes *echo* y por último creamos un *foreach($variable as $tabla*), para hacer el bucle dependiendo de los datos que se generan en el formulario tendremos que usar *esc_textarea* si es tipo texto o *(int)* si es tipo número, cerramos el bucle dibujando el cierre de la tabla.

---

## **3. PROBLEMAS Y SOLUCIONES**
### 3.1 PROBLEMAS ENCONTRADOS A LA HORA DE REALIZAR EL PROYECTO

### 3.2 SOLUCIONES REALIZADAS


## **4. DESPLIEGUE DE LA APLICACIÓN**
### 4.1 TECNOLOGÍA UTILIZADA FINALMENTE PARA EL DESPLIEGUE DEL PROGRAMA FINAL


## **5. CONCLUSIÓN**
### 5.1. REVISIÓN DE LOS OBJETIVOS PREVIOS
### 5.2 FUNCIONALIDAD DEL PROGRAMA
### 5.3 FINALIDAD DEL PROYECTO