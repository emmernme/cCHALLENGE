<?php
/**
 * Grunnkonfigurasjonen til WordPress.
 *
 * Denne filen brukes av koden som lager wp-config.php i løpet av installasjonen.
 * Du trenger ikke å bruke nettstedet til å gjøre det, du trenger bare
 * å kopiere denne filen til "wp-config.php" og fylle inn verdiene.
 *
 * Filen inneholder følgende konfigurasjoner:
 *
 * * MySQL-innstillinger
 * * Hemmelige nøkler
 * * Tabellprefiks for database
 * * ABSPATH
 * 
 * @link https://codex.wordpress.org/Editing_wp-config.php
 * 
 * @package WordPress
 */

// ** MySQL-innstillinger - Dette får du fra din nettjener ** //
/** Navnet på WordPress-databasen */
define('DB_NAME', 'emmern');

/** MySQL-databasens brukernavn */
define('DB_USER', 'emmern');

/** MySQL-databasens passord */
define('DB_PASSWORD', 'fliseKattsprett1');

/** MySQL-tjener */
define('DB_HOST', 'emmern.mysql.domeneshop.no');

/** Tegnsettet som skal brukes i databasen for å lage tabeller. */
define('DB_CHARSET', 'utf8mb4');

/** Databasens "Collate"-type. La denne være hvis du er i tvil. */
define('DB_COLLATE', '');

/**#@+
 * Autentiseringsnøkler og salter.
 *
 * Endre disse til unike nøkler!
 * Du kan generere nøkler med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan når som helst endre disse nøklene for å gjøre aktive cookies ugyldige. Dette vil tvinge alle brukere å logge inn igjen.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xG@|2{fDzw|}<|jgwP-h9;z)zwbBLp(rq?gu4h:|z_+D `[NO+x0O$|7vjg%B`N`');
define('SECURE_AUTH_KEY',  '*[0P56E#{xg/|T_J{cT[t@~.Q*Tx^l@czBN8~X`S_5ILfsn=QWP0JDyxg+bXH8Pz');
define('LOGGED_IN_KEY',    '`&/gcd:m|PMdp,0bp[ik6pB*|o*W~xH6,E#lb-x~e!s)L@ jm:R*+j%;LXG.tDi;');
define('NONCE_KEY',        '(a|<{&5KiVRh<{Jblq /-w,A=|hwtI82d5Je%-l85e|w1X9t(;`)L0v! jAc+(qn');
define('AUTH_SALT',        '=TjBD6v+ju-#t)d{]JI`?fB42JNb.OHFAdrm.:G<g2ytcs`;j~[c)]pvw,mLiNW|');
define('SECURE_AUTH_SALT', 'F?c5O-KkF*;^ Blazd:|;CrGM{U]O(kb?7OI+P$oaLrg-~ va}[K^B?s%d|3m3n ');
define('LOGGED_IN_SALT',   '1zpS+Y> i7(f*r_pXuYUJ>Pl1Ke5iFftpu^y6q}/!1{z(wYKDph C]|9XPa5~{)T');
define('NONCE_SALT',       'YFm7]4;^+jQZ$|B7cD],?`lAh#3oI-/S$g~_<Jd*09mH|)/2#|;Ip<_dB4-R[wX-');

/**#@-*/

/**
 * WordPress-databasens tabellprefiks.
 *
 * Du kan ha flere installasjoner i en databasehvis du gir dem hver deres unike
 * prefiks. Kun tall, bokstaver og understrek (_), takk!
 */
$table_prefix  = 'wp_';

/**
 * For utviklere: WordPress-feilsøkingstilstand.
 *
 * Sett denne til "true" for å aktivere visning av meldinger under utvikling.
 * Det er sterkt anbefalt at utvidelses- og tema-utviklere bruker WP_DEBUG
 * i deres utviklermiljøer.
 * 
 * For informasjon om andre konstanter som kan benyttes under utvikling,
 * besøk vår Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
 // Enable WP_DEBUG mode
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
