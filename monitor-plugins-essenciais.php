<?php
/*
Plugin Name: Monitor de Plugins Essenciais
Description: Monitora a desativação de plugins críticos e envia alerta por e-mail.
Version: 1.0.0
Author: MSA Consultoria
Author URI: https://www.msaconsultoria.com
License: GPL2
Text Domain: monitor-plugins-essenciais
*/

if (!defined('ABSPATH')) {
    exit; // Evita acesso direto
}

add_action('deactivated_plugin', function($plugin, $network_wide) {
    // Lista dos plugins essenciais (caminho exato da pasta/arquivo principal)
    $plugins_essenciais = [
        'elementor/elementor.php',
        'classic-editor/classic-editor.php',
        // Adicione aqui outros plugins críticos
        // 'pasta-plugin/arquivo-principal.php',
    ];

    // Se o plugin desativado não é essencial, não faz nada
    if (!in_array($plugin, $plugins_essenciais, true)) {
        return;
    }

    // E-mail de destino
    $to = 'webmaster@msaconsultoria.com';

    // Assunto
    $subject = 'ALERTA: Plugin essencial desativado no site';

    // Mensagem
    $site_name = get_bloginfo('name');
    $site_url  = get_site_url();
    $user      = wp_get_current_user();

    $message  = "Atenção,\n\n";
    $message .= "Um plugin ESSENCIAL foi desativado no site:\n\n";
    $message .= "Site: {$site_name}\n";
    $message .= "URL: {$site_url}\n";
    $message .= "Plugin desativado: {$plugin}\n\n";

    if ($user && $user->ID) {
        $message .= "Usuário responsável: {$user->user_login} ({$user->user_email})\n";
    } else {
        $message .= "Usuário responsável: não identificado (possível processo automatizado ou acesso direto ao banco).\n";
    }

    $message .= "\nRecomenda-se verificar o painel imediatamente.\n";

    // Cabeçalhos (from = admin_email do site)
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
    ];

    wp_mail($to, $subject, $message, $headers);
}, 10, 2);
