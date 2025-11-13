# Monitor de Plugins Essenciais (WordPress)

Plugin WordPress para monitorar a **desativação de plugins críticos** e enviar um **alerta por e-mail** sempre que isso acontecer.

## Funcionalidades

- Monitora plugins definidos como essenciais.
- Envia e-mail de alerta ao desativar um plugin crítico.
- Inclui informações do site e do usuário que realizou a ação.

## Como usar

1. Faça o download ou clone este repositório.
2. Coloque a pasta do plugin em `wp-content/plugins/`.
3. Ative o plugin no painel do WordPress.
4. Edite o arquivo `monitor-plugins-essenciais.php` e ajuste:
   - Lista de plugins essenciais.
   - E-mail de destino do alerta (variável `$to`).

## Lista de plugins essenciais

Edite o array `$plugins_essenciais` no código:

```php
$plugins_essenciais = [
    'elementor/elementor.php',
    'elementor-pro/elementor-pro.php',
    'envato-elements/envato-elements.php',
    'simple-history/index.php',
];
