<?php 

/**
 * Return the envato licence code
 * @return [type] [description]
 */
function wpvq_get_licence()
{
    $options    =  get_option( 'wpvq_settings' );
    $code       =  (isset($options['wpvq_text_field_envato_code'])) ? $options['wpvq_text_field_envato_code']:'';
    return $code;
}

/**
 * Get the HTML code of a $file in the /view directory
 * @param  [type] $file [description]
 * @return [type]       [description]
 */
function wpvq_get_view($file)
{
    $file = WP_PLUGIN_DIR . '/wp-viral-quiz/views/' . $file;
    ob_start();
    include($file);
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

/**
 * Useful snippets
 */

/**
 * Get information about the picture by using it ID
 * @param  [type] $attachment_id [description]
 * @return [type]                [description]
 */
function wp_get_attachment( $attachment_id ) {

    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}


/**
 * Addons snippets
 */

function wpvq_is_addon_active($slug)
{
    return (is_plugin_active($slug . '/' . $slug . '.php'));
}

function wpvq_is_addon_installed($slug)
{
    return (file_exists(WP_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php'));
}

/**
 * Parse tags for social share sentences
 * @param  [type] $sentence [description]
 * @param  [type] $quiz     [description]
 * @return [type]           [description]
 */
function parse_share_tags_settings($sentence, $quiz)
{
    // same shortcode for user as the one we need on backoffice, so it's useless
    $sentence = str_replace('%%score%%', '%%score%%', $sentence);
    $sentence = str_replace('%%personality%%', '%%personality%%', $sentence);

    // Variables
    $sentence = str_replace('%%total%%', $quiz->countQuestions(), $sentence);
    $sentence = str_replace('%%quizname%%', $quiz->getName(), $sentence);
    $sentence = str_replace('%%quizlink%%', get_permalink(), $sentence);

    return $sentence;
}

/**
 * Get the full absolute domain (with port, protocol, ...)
 * @uses echo url_origin($_SERVER)
 */
function url_origin($s, $use_forwarded_host=false) {
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}


/**
 * Replace ' by "
 * @param  [type] $string [description]
 * @return [type]         [description]
 */
function wpvq_delete_quotes($string) {
	$string = str_replace("'", "‘", $string);
	$string = str_replace('"', "”", $string);
	return $string; 
}

/**
 * Anonymous-like function, used in usort callback (arg2)
 */
function wpvq_usort_callback_function($a, $b) { 
    return $a->getScoreCondition() < $b->getScoreCondition(); 
}