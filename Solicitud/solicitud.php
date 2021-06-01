
<?php
 /**
  * Plugin Name: Solicitud-Inventariado
  * Author: Pedro Suárez
  * Description: Plugin creado por alumno de 2º Desarrollador de Aplicaciones Web, cómo Proyecto Integrado del grado. El plugin genera un shortcode para el formulario. Usad el Shortcode [sol_plugin_form]
  */

register_activation_hook(__FILE__, 'Sol_Plugin_init');

function Sol_Plugin_init()
{
    // Nombra la tabla en la BBDD
    global $wpdb;
    $tabla_solicitud = $wpdb->prefix .'solicitud';
    $charset_collate = $wpdb->get_charset_collate();

    //Prepara la consulta que vamos a lanzar para crear la tabla

    $query = "CREATE TABLE IF NOT EXISTS $tabla_solicitud (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        tipo_formulario varchar(40) NOT NULL,
        material varchar(100) NOT NULL,
        tipo_material varchar(200) NOT NULL,
        rama_solicitante varchar(40) NOT NULL,
        estado_material varchar(4) NOT NULL,
        cantidad_material int(4) NOT NULL,
        fecha datetime NOT NULL,
        create_at datetime NOT NULL,
        UNIQUE (id)
        ) $charset_collate";
    include ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query);
}
    

  // Definir el shortcode que proyecta el formulario
  add_shortcode('sol_plugin_form', 'Sol_Plugin_form');
  

  function Sol_Plugin_form()
  {
      global $wpdb;
      
      if(!empty($_POST)
        && $_POST['nombre'] != ''
        && $_POST['tipo_formulario'] != ''
        && $_POST['material'] != ''
        && $_POST['tipo_material'] != ''
        && $_POST['rama_solicitante'] != ''
        && $_POST['estado_material'] != ''
        && $_POST['cantidad_material'] != ''
        && $_POST['fecha'] != ''         
      ){
            $tabla_solicitud = $wpdb->prefix .'solicitud';
            $nombre = sanitize_text_field($_POST['nombre']);
            $tipo_formulario = sanitize_text_field($_POST['tipo_formulario']);
            $material = sanitize_text_field($_POST['material']);
            $tipo_material = sanitize_text_field($_POST['tipo_material']);
            $rama_solicitante = sanitize_text_field($_POST['rama_solicitante']);
            $estado_material = sanitize_text_field($_POST['estado_material']);
            $cantidad_material = (int)$_POST['cantidad_material'];
            $fecha = date('Y-m-d H:i:s');
            $create_at = date('Y-m-d H:i:s');

            $wpdb->insert($tabla_solicitud, 
                array(
                    'nombre' => $nombre, 
                    'tipo_formulario' => $tipo_formulario, 
                    'material' => $material,                   
                    'tipo_material' => $tipo_material, 
                    'rama_solicitante' => $rama_solicitante, 
                    'estado_material' => $estado_material, 
                    'cantidad_material' => $cantidad_material, 
                    'fecha' => $fecha,
                    'create_at' => $create_at, 
                )
            );  
      }
      wp_enqueue_style('css_aspirante', plugins_url('style.css', __FILE__));
      ob_start();
      ?>
    <form action="<?php get_the_permalink(); ?>" method="post" class="cuestionario">
        <?php wp_nonce_field('graba_solicitud', 'solicitud_nonce')?>
        <div class="form-input">
            <label for="nombre">Nombre de la persona solicitante</label>
            <input type="text" name="nombre" required="required">
        </div>  
        <div class="form-input">
             <label for="tipo_formulario">Tipo de formulario a rellenar:</label>
             <select name="tipo_formulario">
                 <option value="Solicitud">Solicitud de Materiales</option>
                 <option value="Devolucion">Devolución de Material</option>
             </select>                     
         </div>
        <div class="form-input">
            <label for="material">MATERIAL SOLICITADO</label>
            <input type="text" name="material" required="required">
        </div> 
        <div class="form-input">
             <label for="tipo_material">Tipo de material quieres:</label>
             <select name="tipo_material">
                 <br><option value="Campismo">Campismo</option>
                 <br><option value="Agua">Agua</option>
                 <br><option value="Electricidad">Electricidad</option>
                 <br><option value="Oficina">Oficina</option>
                 <br><option value="Estructura">Estructura</option>
                 <br><option value="Ramas">Ramas</option>
                 <option value="Otro">Otro</option>
             </select>                     
         </div>
         <div class="form-input">
             <label for="rama_solicitante">Rama a la que perteneces:</label>
             <select name="rama_solicitante">
                 <br><option value="Castores">Castores</option>
                 <br><option value="Lobatos">Lobatos</option>
                 <br><option value="Rangers">Rangers</option>
                 <br><option value="Pioneros">Pioneros</option>
                 <br><option value="Rutas">Rutas</option>
                 <br><option value="Responsables">Responsables</option>
                 <br><option value="Otro">Otros</option>
             </select>                     
         </div>
         <div class="form-input">
            <label for="estado_material">Estado del material</label>
            <select name="estado_material">
                <br><option value="Bueno">Bueno</option>
                <br><option value="Optimo">Óptimo</option>
                <br><option value="Malo">Malo/Hay que reponerlo</option>
            </select>                     
        </div>
        <div class="form-input">
            <label for="cantidad_material">Cantidad de material que vas a solicitar/devolver: </label>
            <input type="number" name="cantidad_material" value="1" required>
        </div>
        <div class="form-input">
            <label for="fecha">Fecha de solicitud/Devolución</label>
            <br><input type="date" name="fecha" value="2021-06-01" required>
        </div>
        <br>
        <div class="form-input">
            <br><input type="submit" value="Enviar">
        </div>
        </form>
        <?php
        return ob_get_clean();
  }

  add_action("admin_menu", "Sol_solicitud_menu");

  /**
   * Agrega el menú del plugin al formulario de wordpress
   * 
   * @return void
   */

   function Sol_solicitud_menu()
   {
       add_menu_page("Formulario Solicitud", "Solicitud-Devolución", "manage_options",
       "sol_solicitud_menu", "Sol_solicitud_admin", "dashicons-clipboard", 20);
   }

   add_shortcode('sol_solicitud_admin', 'Sol_solicitud_admin');


   function Sol_solicitud_admin()
   {
        global $wpdb;
        $tabla_solicitud = $wpdb->prefix . 'solicitud';
        $solicitud2 = $wpdb->get_results("SELECT * FROM $tabla_solicitud");
        echo '<div class="wrap"><h1>Lista de Materiales</h1>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th width="10%">Nombre</th>';
        echo '<th>Tipo_Formulario</th><th>Material</th><th>Tipo_Material</th>
        <th>Rama_Solicitante</th><th>Estado_material</th><th>Cantidad_Material</th>
        <th>Fecha</th>';
        echo '</tr></thead>';
        echo '<tbody id="the-list">';

        foreach($solicitud2 as $solicitud)
        {
            $nombre = esc_textarea($solicitud->nombre);
            $tipo_formulario = esc_textarea($solicitud->tipo_formulario);
            $material = esc_textarea($solicitud->material);
            $tipo_material = esc_textarea($solicitud->tipo_material);
            $rama_solicitante = esc_textarea($solicitud->rama_solicitante);
            $estado_material = (int)$solicitud->estado_material;
            $cantidad_material = (int)$solicitud->cantidad_material;           
            $fecha = (int)$solicitud->fecha;
            $create_at = (int)$solicitud->create_at;
            echo "<tr><td>$nombre</td><td>$tipo_formulario</td>";
            echo "<td>$material</td><td>$tipo_material</td><td>$rama_solicitante</td>";
            echo "<td>$estado_material</td><td>$cantidad_material</td><td>$fecha</td></tr>";
        }
        echo '</tbody></table></div>';
   }