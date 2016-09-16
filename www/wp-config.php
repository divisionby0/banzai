<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'banzai');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'K3y?6~FA lLO=39f6.F!C3zW!r&6<|M+/Z4(*@[7El}<VqhR@8P!1wR*W,@7o,,7');
define('SECURE_AUTH_KEY',  '35+b@lDw>M+!SD)MM#%g~pvFp_&oW)lQb|G.-olN,X>*RmdsA7YUYG?k0!vs4~cw');
define('LOGGED_IN_KEY',    'nsOi2~{`2#]EhD](!}Lg:O8!i=Ba(a/<>IwxT3h?EFEzu5B d{N8iae]({Hj^?6N');
define('NONCE_KEY',        ',$qsH70^]4riuYz?Q6]^`F{NJ^xN6?04qa|Gg D>_@QmnmA&.]bys88.U9P]bvD|');
define('AUTH_SALT',        '7tIW8e.f^#cc:xXw+9Q8z2Gw>b!?EFbA,h-m]<UR:cv/A0#5XA}d/p&;jC9lVaI.');
define('SECURE_AUTH_SALT', '*U_$qdk~-M_R#2m0q*)(kONLMgbX~j#Gr29?HT.G*Lr,q~JZK$mL4naQmcNC%O>u');
define('LOGGED_IN_SALT',   '[639yGLxxDaNy;.hS~B[WHGBa?sv?4u;~@fHFdG@I,%Vk&`bgGmI8=P,?xMLxZg5');
define('NONCE_SALT',       '3U9<c72?xadm_[}qI=kv$FBdg%`-MWS1Ib;4YwL&/r<^{mnV|TDiI`zCW,$:kdh(');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
