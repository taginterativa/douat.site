<?php
/**
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'douat_blog');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'root');

/** nome do host do MySQL */
define('DB_HOST', '127.0.0.1');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'T[4 HbNV_r=jBTgN(B$AXT/cO70-;>_-|8*/(2MK#?lLlkFBNC_Sj+c?%yU#z|8h');
define('SECURE_AUTH_KEY',  'l#|(jX,-+PXO ;T+P;J9$%e4etz>9d%koA-&,xMwmJJEG/VCz>j#;S?l/ |YYqBr');
define('LOGGED_IN_KEY',    '{>{mqsq@(kk|{F[;83I.C2|$Y(CZzY^hB(^53.]y<X4hQ+3gh.DP)_Dt~Z{`-r |');
define('NONCE_KEY',        ':[wpi`PU[%$h|%U%TA[n:-F*3^7$1)eo*E`pXI>JH}AWt4r%(+**y~(]_oz`iJs$');
define('AUTH_SALT',        '~9m&WBk.$ O&m$P,M^D=7Fu=#DBsb;Hia@*vd+PFE=hJs%kj|IZsg6H([L9Lx1cA');
define('SECURE_AUTH_SALT', '~6u|GYg=HZ,(S? L/O?/Ep.Iu0;+~JP1}+_&xl42d@6?>QNp-Ts0? lc!NqabVST');
define('LOGGED_IN_SALT',   'A[tRsigHiF2I%FdsDQ4|#];% L!(#mER+|(4>`jW&|cw:,xMleYHzJ-NaZQh}BN`');
define('NONCE_SALT',       'nR6SM*USfluce:N*4uts->AgKCziOWWK&gF(.k@GBJ!B))yEf]r;EyC;]2h2IvGZ');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'blog_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
