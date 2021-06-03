# TÍTULOS
## HEAADING LEVEL2
### HEADING LEVEL3...

**bold**
*italic*

***very important (italic, bold)***

>Blockquotes
- / + / * List 
1. List Ordered
    1. List ordered too
2. ....

=====================================================

# INDICE

1. Análisis y explicación del Proyecto de Fin de Grado
    1. Introducción y explicación
    2. Objetivo y finalidad del proyecto

2. Planificación previa
    1. Tecnología utilizada para la realización del Proyecto
    2. Desarrollo del programa

3. Problemas y soluciones
    1. Problemas encontrados a la hora de realizar el proyecto.
    2. Soluciones realizadas a dichos problemas.

4. Despliegue de aplicación
    1. Tecnología utilizada finalmente para el despliegue del programa final.

5. Conclusión
    1. Revisión de los objetivos previos
    2. Funcionalidad del programa
    3. Finalidad del proyecto



========================================================


## **ANÁLISIS Y EXPLICACIÓN DEL PROYECTO DE FIN DE GRADO**
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


   #### Inventario del grupo
   Ahora mismo está puesto en una página web en Local y consta de 3 aplicaciones en específico:
   - La primera es una aplicación (realizada a código), la cuál escribe un formulario en la web (a través de un shortcode) y los datos recibidos se guardan en una tabla en la base de datos de mysql, la cuál si no está creada la crea por primera vez con el tipo de dato necesario, y después comprueba si ya está creada y de ser así va ingresando los datos en su orden, la cuál servirá para realizar la entrada de los materiales, esta aplicación también dibuja una tabla en el backend de la web a parte de hacerlo en la base de datos de mysql.
   - La segunda es una aplicación, también realizada a código, del mismo estilo que la anterior pero la diferencia es que esta generará un formulario para la solicitud/devolución de los materiales. Generando también una tabla en la base de datos (si no existiese previametne), una tabla en el backend de wordpress.
   - Por último hacemos uso de la aplicación WpDataTable, la cuál hace una llamada a la base de datos de mysql cogiendo los datos de la tabla que nosotros queramos y así podamos proyectarlo en la página web.

   Para finalizar este apartado he escrito una configuración en *"config.php"*, en la cuál escribimos los siguientes comandos:
       > define('WP_DEBUG', true);
       > define('WP_DEBUG_LOG', false);
       > define('WP_DEBUG_LOG', true);
    
    El cuál hace que los fallos de la página de WordPress se presenten en un documento *"debug.log"* que encontraremos en la carpeta de wp-content. Eso se usa ya que hay algunos problemas que el propio sistema de fallos de WordPress no te detecta, pero el debug_log si, por tanto, hacemos que se escriban en un fichero para que podamos leerlo y así corregir los errores pertinentes.



### 1.2. OBJETIVO Y FINALIDAD DEL PROYECTO.

    El proyecto tiene diferentes objetivos y finalidades:
    - Realizar una página web para que se conozca quiénes son los Scout, que hacemos, pero sobre todo que se conozca al grupo Scout de San Benito.
    - Tener un control exhaustivo de la participación de los miembros del grupo en las actividades y así tener el control de las autorizaciones para participar en las actividades.
    - Tener un control exhaustivo de los documentos, tanto de los miembros del grupo, cómo tener un control también de las solicitudes de admisión.
    - Enseñar que hace el grupo Scout en el día a día, realizando también un enlace a las redes sociales del grupo.
    - Tener un control del uso de la nave y así también poder dejarlapara alquilar.
    - Poder tener un control del inventario del grupo en la web, así también tener el control de los gastos que produce la compra de los materiales.
    - Tener un apartado en la web para poder solicitar/devolver un material con el que cuenta el grupo.


## **ANÁLISIS Y EXPLICACIÓN DEL PROYECTO DE FIN DE GRADO**

    

