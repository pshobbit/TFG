<?php
/**
 * Plugin Name:  KFP Aspirantes
 * Description:  Formulario para valorar el nivel de partida de los alumnos aspirantes. Utiliza el shortcode [kfp_aspirante_form] para que el formulario aparezca en la página o el post que desees.
 * Version:      0.1.1
 * Author:       Juanan Ruiz
 * Author URI:   https://kungfupress.com/
 * PHP Version:  5.6
 *
 * @category Form
 * @package  KFP
 * @author   Juanan Ruiz <juananruizrivas@gmail.com>
 * @license  GPLv2 http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://kungfupress.com
 */

// Cuando el plugin se active se crea la tabla del mismo si no existe
register_activation_hook(__FILE__, 'Kfp_Aspirante_init');

/**
 * Realiza las acciones necesarias para configurar el plugin cuando se activa
 *
 * @return void
 */
function Kfp_Aspirante_init()
{
    global $wpdb; // Este objeto global nos permite trabajar con la BD de WP
    // Crea la tabla si no existe
    $tabla_aspirantes = $wpdb->prefix . 'aspirante';
    $charset_collate = $wpdb->get_charset_collate();
    $query = "CREATE TABLE IF NOT EXISTS 'wp_aspirante' (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        correo varchar(100) NOT NULL,
        tipo_material int(4) NOT NULL,
        estado_material int(4) NOT NULL,
        cantidad_material int(4) NOT NULL,
        disponibilidad int(4) NOT NULL,
        precio int(4) NOT NULL,
        motivacion text,
        aceptacion smallint(4) NOT NULL,
        ip varchar(300),
        created_at datetime NOT NULL,
        UNIQUE (id)
        ) $charset_collate;";
    // La función dbDelta que nos permite crear tablas de manera segura se
    // define en el fichero upgrade.php que se incluye a continuación
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query);
}

// El formulario puede insertarse en cualquier sitio con este shortcode
// El código de la función que carga el shortcode hace una doble función:
// 1-Graba los datos en la tabla si ha habido un envío desde el formulario
// 2-Muestra el formulario

add_shortcode('kfp_aspirante_form', 'Kfp_Aspirante_form');

/**
 * Crea y procesa el formulario que rellenan los aspirantes
 *
 * @return string
 */
function Kfp_Aspirante_form()
{
    global $wpdb; // Este objeto global nos permite trabajar con la BD de WP
    // Si viene del formulario  grabamos en la base de datos
    if (!empty($_POST)
        && $_POST['nombre'] != ''
        && is_email($_POST['correo'])
        && $_POST['tipo_material'] != ''
        && $_POST['estado_material'] != ''
        && $_POST['cantidad_material'] != ''
        && $_POST['disponibilidad'] != ''
        && $_POST['precio'] != ''
        && $_POST['aceptacion'] == '1'
    ) {
        $tabla_aspirantes = $wpdb->prefix . 'aspirante';
        $nombre = sanitize_text_field($_POST['nombre']);
        $correo = $_POST['correo'];
        $tipo_material = (int) $_POST['tipo_material'];
        $estado_material = (int) $_POST['estado_material'];
        $cantidad_material = (int) $_POST['cantidad_material'];
        $disponibilidad = (int) $_POST['disponibilidad'];
        $precio = (int) $_POST['precio'];
        $motivacion = sanitize_text_field($_POST['motivacion']);
        $aceptacion = (int) $_POST['aceptacion'];
        $ip = Kfp_Obtener_IP_usuario();
        $created_at = date('Y-m-d H:i:s');

        print_r($_POST);
        print_r($tabla_aspirantes);
        echo ("Holaaaaaaaaaaaa");
        $wpdb->insert(
            $tabla_aspirantes,
            array(
                'nombre' => $nombre,
                'correo' => $correo,
                'tipo_material' => $tipo_material,
                'estado_material' => $estado_material,
                'cantidad_material' => $cantidad_material,
                'disponibilidad' => $disponibilidad,
                'precio' => $precio,
                'motivacion' => $motivacion,
                'aceptacion' => $aceptacion,
                'ip' => $ip,
                'created_at' => $created_at,
            )
        );
        echo "<p class='exito'><b>Tus datos han sido registrados</b>. Gracias
            por tu interés. En breve contactaré contigo.<p>";
    }
    // Carga esta hoja de estilo para poner más bonito el formulario
    wp_enqueue_style('css_aspirante', plugins_url('style.css', __FILE__));
    ob_start();
    ?>
    <form action="<?php get_the_permalink();?>" method="post" id="form_aspirante"
        class="cuestionario">
        <?php wp_nonce_field('graba_aspirante', 'aspirante_nonce');?>
        <div class="form-input">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div class="form-input">
            <label for='correo'>Correo</label>
            <input type="email" name="correo" id="correo">
        </div>
        <div class="form-input">
            <label for="tipo_material">tipo_material</label>
            <input type="radio" name="tipo_material" value="1" required> Nada
            <br><input type="radio" name="tipo_material" value="2" required> Estoy
                aprendiendo
            <br><input type="radio" name="tipo_material" value="3" required> Tengo
                experiencia
            <br><input type="radio" name="tipo_material" value="4" required> Lo
                domino al dedillo
        </div>
        <div class="form-input">
            <label for="estado_material">estado_material</label>
            <input type="radio" name="estado_material" value="1" required> Nada
            <br><input type="radio" name="estado_material" value="2" required> Estoy
                aprendiendo
            <br><input type="radio" name="estado_material" value="3" required> Tengo
                experiencia
            <br><input type="radio" name="estado_material" value="4" required> Lo
                domino al dedillo
        </div>
        <div class="form-input">
            <label for="cantidad_material">cantidad_material</label>
            <input type="number" name="cantidad_material" value="1" required>
        </div>
        <div class="form-input">
            <label for="disponibilidad">disponibilidad</label>
            <input type="radio" name="disponibilidad" value="1" required> Nada
            <br><input type="radio" name="disponibilidad" value="2" required> Estoy
                aprendiendo
            <br><input type="radio" name="disponibilidad" value="3" required> Tengo
                experiencia
            <br><input type="radio" name="disponibilidad" value="4" required> Lo domino
                al dedillo
        </div>
        <div class="form-input">
            <label for="precio">precio</label>
            <input type="number" name="precio" value="1" required> Nada
        </div>
        <div class="form-input">
            <label for="motivacion">¿Porqué quieres aprender a programar en
                    WordPress?</label>
            <textarea name="motivacion" id="motivacion" required></textarea>
        </div>
        <div class="form-input">
            <label for="aceptacion">Mi nombre es Fulano de Tal y Cual y me
                comprometo a custodiar de manera responsable los datos que vas
                a enviar. Su única finalidad es la de participar en el proceso
                explicado más arriba.
                En cualquier momento puedes solicitar el acceso, la rectificación
                o la eliminación de tus datos desde esta página web.</label>
            <input type="checkbox" id="aceptacion" name="aceptacion" value="1"
            required> Entiendo y acepto las condiciones
        </div>

        <div class="form-input">
            <input type="submit" value="Enviar">
        </div>
    </form>
    <?php

    return ob_get_clean();
}

add_action("admin_menu", "Kfp_Aspirante_menu");

/**
 * Agrega el menú del plugin al formulario de WordPress
 *
 * @return void
 */
function Kfp_Aspirante_menu()
{
    add_menu_page("Formulario Aspirantes", "PluginPedro", "manage_options",
        "kfp_aspirante_menu", "Kfp_Aspirante_admin", "dashicons-feedback", 75);
}



add_shortcode('kfp_aspirante_admin', 'Kfp_Aspirante_admin');

/**
 * Crea y procesa el formulario que rellenan los aspirantes
 *
 * @return string
 */
function Kfp_Aspirante_admin()
{
    global $wpdb;
    $tabla_aspirantes = $wpdb->prefix . 'aspirante';
    $aspirantes = $wpdb->get_results("SELECT * FROM $tabla_aspirantes");
    echo '<div class="wrap"><h1>INVENTARIO</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th width="30%">Nombre</th><th>Correo</th>';
    echo '<th>tipo_material</th><th>estado_material</th><th>cantidad</th><th>disponibilidad</th><th>precio</th>';
    echo '</tr></thead>';
    echo '<tbody id="the-list">';
    foreach ($aspirantes as $aspirante) {
        $nombre = esc_textarea($aspirante->nombre);
        $correo = esc_textarea($aspirante->correo);
        $motivacion = esc_textarea($aspirante->motivacion);
        $tipo_material = (int) $aspirante->tipo_material;
        $estado_material = (int) $aspirante->estado_material;
        $cantidad_material = (int) $aspirante->cantidad_material;
        $disponibilidad = (int) $aspirante->disponibilidad;
        $precio = (int) $aspirante->precio;
        $total = $tipo_material + $estado_material + $cantidad_material + $disponibilidad + $precio;
        echo "<tr><td><a href='#' title='$motivacion'>$nombre</a></td>";
        echo "<td>$correo</td><td>$tipo_material</td><td>$estado_material</td>";
        echo "<td>$cantidad_material</td><td>$disponibilidad</td><td>$precio</td>";
     
    }
    echo '</tbody></table></div>';
}

/**
 * Devuelve la IP del usuario que está visitando la página
 * Código fuente: https://stackoverflow.com/questions/6717926/function-to-get-user-ip-address
 *
 * @return string
 */
function Kfp_Obtener_IP_usuario()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED',
        'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                    return $ip;
                }
            }
        }
    }
}