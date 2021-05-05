 <?php
 /**
  * Plugin Name: Inventariado
  * Author: Pedro Suárez
  * Description: Plugin creado por alumno de 2º Desarrollador de Aplicaciones Web, cómo Proyecto Integrado del grado. El plugin genera un shortcode para el formulario.
  */

register_activation_hook(__FILE__, 'Inv_Plugin_init');

function Inv_Plugin_init()
{
    // Nombra la tabla en la BBDD
    global $wpdb;
    $tabla_inventario = $wpdb->prefix .'inventario';
    $charset_collate = $wpdb->get_charset_collate();

    //Prepara la consulta que vamos a lanzar para crear la tabla

    $query = "CREATE TABLE IF NOT EXISTS $tabla_inventario (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        correo varchar(100) NOT NULL,
        tipo_material int(4) NOT NULL,
        estado_material int(4) NOT NULL,
        cantidad_material int(4) NOT NULL,
        disponibilidad int(4) NOT NULL,
        precio int(4) NOT NULL,
        /* ip varchar(300), */
        create_at datetime NOT NULL,
        UNIQUE (id)
        ) $charset_collate";
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query);
}

  // Definir el shortcode que proyecta el formulario
  add_shortcode('inv_plugin_form', 'Inv_Plugin_form');
  

  function Inv_Plugin_form()
  {
      global $wpdb;

      if(!empty($_POST)
        && $_POST['nombre'] != ''
        && is_email($_POST['correo']) != ''
        && $_POST['tipo_material'] != ''
        && $_POST['estado_material'] != ''
        && $_POST['cantidad_material'] != ''
        && $_POST['cantidad_material'] != ''
        && $_POST['disponibilidad'] != ''
        && $_POST['precio'] != ''
      ){
            $tabla_inventario = $wpdb->prefix .'inventario';
            $nombre = sanitize_text_field($_POST['nombre']);
            $correo = sanitize_email($_POST['correo']);
            $tipo_material = (int)$_POST['tipo_material'];
            $estado_material = (int)$_POST['estado_material'];
            $cantidad_material = (int)$_POST['cantidad_material'];
            $disponibilidad = (int)$_POST['disponibilidad'];
            $precio = (int)$_POST['precio'];
            //$ip = Inv_Obtener_Ip_usuario();
            $create_at =date('Y-m-d H:i:s');

            $wpdb->insert($tabla_inventario, 
                array(
                    'nombre' => $nombre, 
                    'correo' => $correo, 
                    'tipo_material' => $tipo_material, 
                    'estado_material' => $estado_material, 
                    'cantidad_material' => $cantidad_material, 
                    'disponibilidad' => $disponibilidad, 
                    'precio' => $precio, 
                    'create_at' => $create_at, 
                )
            );          
      }
      ob_start();
      ?>
    <form action="<?php get_the_permalink(); ?>" method="post" class="cuestionario">
        <?php wp_nonce_field('graba_inventario', 'inventario_nonce')?>
        <div class="form-input">
            <label for="nombre">Nombre</label>
            <br><input type="text" name="nombre" required="required">
        </div>
        <div class="form-input">
            <label for="correo">Correo</label>
            <br><input type="email" name="correo" id="correo">
        </div>
        <div class="form-input">
            <label for="tipo_material">Dime que tipo de material quieres meter</label>
            <br><input type="radio" name="tipo_material" value="1" required>Campismo
            <br><input type="radio" name="tipo_material" value="2" required>Agua
            <br><input type="radio" name="tipo_material" value="3" required>Electricidad
            <br><input type="radio" name="tipo_material" value="4" required>Oficina           
        </div>
        <div class="form-input">
            <label for="estado_material">En que estado se encuentra el material</label>
            <br><input type="radio" name="estado_material" value="1" required>Nuevo
            <br><input type="radio" name="estado_material" value="2" required>Óptimo
            <br><input type="radio" name="estado_material" value="3" required>Regular
            <br><input type="radio" name="estado_material" value="4" required>Mejor no usarlo
        </div>
        <div class="form-input">
            <label for="cantidad_material">Número de objetos que vas a introducir</label>
            <br><input type="number" name="cantidad_material" value="1" required>
        </div>
        <div class="form-input">
            <label for="disponibilidad">Está disponible el material para usarlo</label>
            <br><input type="radio" name="disponibilidad" value="1">Si
            <br><input type="radio" name="disponibilidad" value="1">No
        </div>
        <div class="form-input">
            <label for="precio">Cuanto te ha costado el material</label>
            <br><input type="number" name="precio" value="1" required>
        </div>
        <div class="form-input">
            <br><input type="submit" value="Enviar">
        </div>
        </form>
        <?php
        return ob_get_clean(); 
  }

  add_action("admin_menu", "Inv_inventario_menu");

  /**
   * Agrega el menú del plugin al formulario de wordpress
   * 
   * @return void
   */

   function Inv_inventario_menu()
   {
       add_menu_page("Formulario Inventario", "Inventario", "manage_options",
       "inv_inventario_menu", "Inv_inventario_admin", "dashicons-feedback", 20);
   }

   add_shortcode('inv_inventario_admin', 'Inv_inventario_admin');


   function Inv_inventario_admin()
   {
        global $wpdb;
        $tabla_inventario = $wpdb->prefix . 'inventario';
        $inventario2 = $wpdb->get_results("SELECT * FROM $tabla_inventario");
        echo '<div class="wrap"><h1>Lista de Materiales</h1>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th width="30%">Nombre</th><th>Correo</th>';
        echo '<th>Material</th><th>Estado</th><th>Cantidad</th><th>Disponibilidad</th><th>Precio</th><th>Fecha</th>';
        echo '</tr></thead>';
        echo '<tbody id="the-list">';

        foreach($inventario2 as $inventario)
        {
            $nombre = esc_textarea($inventario->nombre);
            $correo = esc_textarea($inventario->correo);
            $tipo_material = (int)$inventario->tipo_material;
            $estado_material = (int)$inventario->estado_material;
            $cantidad_material = (int)$inventario->cantidad_material;
            $disponibilidad = (int)$inventario->disponibilidad;
            $precio = (int)$inventario->precio;
            $create_at = (int)$inventario->create_at;
            echo "<tr><td>$nombre</td><td>$correo</td><td>$tipo_material</td>";
            echo "<td>$estado_material</td><td>$cantidad_material</td><td>$disponibilidad</td>";
            echo "<td>$precio</td><td>$create_at</td></tr>";
        }
        echo '</tbody></table></div>';
   }


// Vincula la función de borrado con un hook de admin_post
// add_action('admin_post_borra_aspirante', 'Kfp_Borra_Aspirante');
/**
 * Borra un registro de aspirante usando admin-post.php
 * 
 * @return void
 */
/*
function Kfp_Borra_Aspirante()
{
	global $wpdb;
	$url_origen = admin_url('admin.php') . '?page=kfp_aspirante_menu';
	// && current_user_can('manage_options')
	if (isset($_GET['id'])) {
		$id = (int) $_GET['id'];
		$tabla_aspirantes = $wpdb->prefix . 'aspirante';
		$wpdb->delete($tabla_aspirantes, array('id' => $id));
		$status = 'success';
	} else {
		$status = 'error';
	}
	wp_safe_redirect(
		esc_url_raw(
			add_query_arg( 'kfp_aspirante_status', $status, $url_origen )
		)
	);
}
    */
   