<?php
 /**
  * Plugin Name: Inventariado
  * Author: Pedro Suárez
  * Description: Plugin creado por alumno de 2º Desarrollador de Aplicaciones Web, cómo Proyecto Integrado del grado. El plugin genera un shortcode para el formulario. Usad el Shortcode [inv_plugin_form]
  * Version: 0.1.1
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
        tipo_material varchar(200) NOT NULL,
        estado_material varchar(40) NOT NULL,
        cantidad_material int(4) NOT NULL,
        precio int(4) NOT NULL,
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
        && $_POST['tipo_material'] != ''
        && $_POST['estado_material'] != ''
        && $_POST['cantidad_material'] != ''
        && $_POST['precio'] != ''
      ){
            $tabla_inventario = $wpdb->prefix .'inventario';
            $nombre = sanitize_text_field($_POST['nombre']);
            $tipo_material = sanitize_text_field($_POST['tipo_material']);
            $estado_material = sanitize_text_field($_POST['estado_material']);
            $cantidad_material = (int)$_POST['cantidad_material'];
            $precio = (int)$_POST['precio'];
            $create_at =date('Y-m-d H:i:s');

            $wpdb->insert($tabla_inventario, 
                array(
                    'nombre' => $nombre, 
                    'tipo_material' => $tipo_material, 
                    'estado_material' => $estado_material, 
                    'cantidad_material' => $cantidad_material, 
                    'precio' => $precio, 
                    'create_at' => $create_at, 
                )
            );
      }
      wp_enqueue_style('css_aspirante', plugins_url('style.css', __FILE__));
      ob_start();
      ?>
    <form action="<?php get_the_permalink(); ?>" method="post" class="cuestionario">
        <?php wp_nonce_field('graba_inventario', 'inventario_nonce')?>
        <div class="form-input">
            <label for="nombre">Material a ingresar:</label>
            <br><input type="text" name="nombre" required="required">
        </div>
        <div class="form-input">
            <label for="tipo_material">Tipo de material quieres meter:</label>
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
            <label for="estado_material">Estado del material</label>
            <select name="estado_material">
                <br><option value="Bueno">Bueno</option>
                <br><option value="Optimo">Óptimo</option>
                <br><option value="Malo">Malo/Hay que reponerlo</option>
            </select>                     
        </div>
        <div class="form-input">
            <label for="cantidad_material">Cantidad del material</label>
            <br><input type="number" name="cantidad_material" value="0" required>
        </div>
        <div class="form-input">
            <label for="precio">Coste del material</label>
            <br><input type="number" name="precio" value="0" required>
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
        echo '<thead><tr><th width="18%">Nombre</th>';
        echo '<th>Material</th><th>Estado</th><th>Cantidad</th>
        <th>Precio</th><th>Fecha</th>';
        echo '</tr></thead>';
        echo '<tbody id="the-list">';

        foreach($inventario2 as $inventario)
        {
            $nombre = esc_textarea($inventario->nombre);
            $tipo_material = esc_textarea($inventario->tipo_material);
            $estado_material = esc_textarea($inventario->estado_material);
            $cantidad_material = (int)$inventario->cantidad_material;           
            $precio = (int)$inventario->precio;
            $create_at = (int)$inventario->create_at;
            echo "<tr><td>$nombre</td><td>$tipo_material</td>";
            echo "<td>$estado_material</td><td>$cantidad_material</td>";
            echo "<td>$precio</td><td>$create_at</td></tr>";
        }
        echo '</tbody></table></div>';
   }

   