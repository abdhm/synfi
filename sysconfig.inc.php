<?php
/**
 * SENAYAN application global configuration file
 *
 * Copyright (C) 2010  Arie Nugraha (dicarve@yahoo.com), Hendro Wicaksono (hendrowicaksono@yahoo.com), Wardiyono (wynerst@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
    die("can not access this file directly");
} else if (INDEX_AUTH != 1) {
    die("can not access this file directly");
}

// be sure that magic quote is off
@ini_set('magic_quotes_gpc', false);
@ini_set('magic_quotes_runtime', false);
@ini_set('magic_quotes_sybase', false);
// force disabling magic quotes
if (get_magic_quotes_gpc()) {
  function stripslashes_deep($value)
  {
    $value = is_array($value)?array_map('stripslashes_deep', $value):stripslashes($value);
    return $value;
  }

  $_POST = array_map('stripslashes_deep', $_POST);
  $_GET = array_map('stripslashes_deep', $_GET);
  $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
  $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}
// turn off all error messages for security reason
@ini_set('display_errors', false);
// check if safe mode is on
if ((bool) ini_get('safe_mode')) {
    define('SENAYAN_IN_SAFE_MODE', 1);
}

// set default timezone
// for a list of timezone, please see PHP Manual at "List of Supported Timezones" section
@date_default_timezone_set('Asia/Jakarta');

// senayan version
define('SENAYAN_VERSION', 'SLiMS 8.3.1 (Akasia)');

// senayan session cookies name
define('COOKIES_NAME', 'SenayanAdmin');
define('MEMBER_COOKIES_NAME', 'SenayanMember');

// alias for DIRECTORY_SEPARATOR
define('DS', DIRECTORY_SEPARATOR);

// senayan base dir
define('SB', realpath(dirname(__FILE__)).DS);

// absolute path for simbio platform
define('SIMBIO', SB.'simbio2'.DS);

// senayan library base dir
define('LIB', SB.'lib'.DS);

// senayan web doc root dir
/* Custom base URL */
$sysconf['baseurl'] = '';
$temp_senayan_web_root_dir = preg_replace('@admin.*@i', '', str_replace('\\', '/', dirname(@$_SERVER['PHP_SELF'])));
define('SWB', $sysconf['baseurl'].$temp_senayan_web_root_dir.(preg_match('@\/$@i', $temp_senayan_web_root_dir)?'':'/'));

// javascript library web root dir
define('JWB', SWB.'js/');

// simbio main class inclusion
require SIMBIO.'simbio.inc.php';
// simbio security class
require SIMBIO.'simbio_UTILS'.DS.'simbio_security.inc.php';
// we must include utility library first
require LIB.'utility.inc.php';

/* session login timeout in second */
$sysconf['session_timeout'] = 7200;

/* default application language */
$sysconf['default_lang'] = 'en_US';
$sysconf['spellchecker_enabled'] = true;

/* HTTP header */
//header('Content-type: text/html; charset=UTF-8');

/* Dynamic Content */
$sysconf['content']['allowable_tags'] = '<p><a><cite><code><em><strong><cite><blockquote><fieldset><legend>'
    .'<h3><hr><br><table><tr><td><th><thead><tbody><tfoot><div><span><img><object><param>';

// Zend Barcode Engine
$sysconf['zend_barcode_engine'] = true;
// Zend Barcode Engine Encoding selection
// $barcodes_encoding['CODE25'] = array('code25', 'Code 2 or 5 Industrial (may result in barcode creation error)');
// $barcodes_encoding['CODE25I'] = array('code25interleaved', 'Code 2 or 5 Interleaved (may result in barcode creation error)');
$barcodes_encoding['code39'] = array('code39', 'Code 39');
$barcodes_encoding['code128'] = array('code128', 'Code 128');
// $barcodes_encoding['EAN2'] = array('ean2', 'Ean 2 (may result in barcode creation error)');
// $barcodes_encoding['EAN5'] = array('ean5', 'Ean 5 (may result in barcode creation error)');
// $barcodes_encoding['EAN8'] = array('ean8', 'Ean 8');
// $barcodes_encoding['EAN13'] = array('ean13', 'Ean 13 (may result in barcode creation error)');
// $barcodes_encoding['IDENTCODE'] = array('identcode', 'Identcode (may result in barcode creation error)');
// $barcodes_encoding['ITF14'] = array('itf14', 'ITF-14 (may result in barcode creation error)');
// $barcodes_encoding['LEITCODE'] = array('leitcode', 'Leitcode (may result in barcode creation error)');
// $barcodes_encoding['PLANET'] = array('planet', 'Planet (may result in barcode creation error)');
// $barcodes_encoding['POSTNET'] = array('postnet', 'Postnet (may result in barcode creation error)');
// $barcodes_encoding['ROYALMAIL'] = array('royalmail', 'Royalmail (may result in barcode creation error)');
// $barcodes_encoding['UPCA'] = array('upca', 'UPC-A (may result in barcode creation error)');
// $barcodes_encoding['UPCE'] = array('upce', 'UPC-E (may result in barcode creation error)');
$sysconf['barcode_encoding'] = $barcodes_encoding['code128'][0];

/* FILE UPLOADS */
// $sysconf['max_upload'] = intval(ini_get('upload_max_filesize'))*1024;
// $post_max_size = intval(ini_get('post_max_size'))*1024;
// if ($sysconf['max_upload'] > $post_max_size) {
//     $sysconf['max_upload'] = $post_max_size-1024;
// }
// $sysconf['max_image_upload'] = 500;
// allowed image file to upload
// $sysconf['allowed_images'] = array('.jpeg', '.jpg', '.gif', '.png', '.JPEG', '.JPG', '.GIF', '.PNG');
// // allowed file attachment to upload
// $sysconf['allowed_file_att'] = array('.pdf', '.rtf', '.txt',
//     '.odt', '.odp', '.ods', '.doc', '.xls', '.ppt',
//     '.avi', '.mpeg', '.mp4', '.flv', '.mvk',
//     '.jpg', '.jpeg', '.png', '.gif',
//     '.docx', '.pptx', '.xlsx',
//     '.ogg', '.mp3', '.xml', '.mrc');
// $sysconf['allowed_images_mimetype'] = array(
//   'image/jpeg', 'image/png',
// );

/* FILE ATTACHMENT MIMETYPES */
// $sysconf['mimetype']['docx'] = 'application/msword';
// $sysconf['mimetype']['js'] = 'application/javascript';
// $sysconf['mimetype']['json'] = 'application/json';
// $sysconf['mimetype']['doc'] = 'application/msword';
// $sysconf['mimetype']['dot'] = 'application/msword';
// $sysconf['mimetype']['ogg'] = 'application/ogg';
// $sysconf['mimetype']['pdf'] = 'application/pdf';
// $sysconf['mimetype']['rdf'] = 'application/rdf+xml';
// $sysconf['mimetype']['rss'] = 'application/rss+xml';
// $sysconf['mimetype']['rtf'] = 'application/rtf';
// $sysconf['mimetype']['xls'] = 'application/vnd.ms-excel';
// $sysconf['mimetype']['xlt'] = 'application/vnd.ms-excel';
// $sysconf['mimetype']['chm'] = 'application/vnd.ms-htmlhelp';
// $sysconf['mimetype']['ppt'] = 'application/vnd.ms-powerpoint';
// $sysconf['mimetype']['pps'] = 'application/vnd.ms-powerpoint';
// $sysconf['mimetype']['odc'] = 'application/vnd.oasis.opendocument.chart';
// $sysconf['mimetype']['odf'] = 'application/vnd.oasis.opendocument.formula';
// $sysconf['mimetype']['odg'] = 'application/vnd.oasis.opendocument.graphics';
// $sysconf['mimetype']['odi'] = 'application/vnd.oasis.opendocument.image';
// $sysconf['mimetype']['odp'] = 'application/vnd.oasis.opendocument.presentation';
// $sysconf['mimetype']['ods'] = 'application/vnd.oasis.opendocument.spreadsheet';
// $sysconf['mimetype']['odt'] = 'application/vnd.oasis.opendocument.text';
// $sysconf['mimetype']['swf'] = 'application/x-shockwave-flash';
// $sysconf['mimetype']['zip'] = 'application/zip';
// $sysconf['mimetype']['mp3'] = 'audio/mpeg';
// $sysconf['mimetype']['jpg'] = 'image/jpeg';
// $sysconf['mimetype']['gif'] = 'image/gif';
// $sysconf['mimetype']['png'] = 'image/png';
// $sysconf['mimetype']['flv'] = 'video/x-flv';
// $sysconf['mimetype']['mp4'] = 'video/mp4';
// $sysconf['mimetype']['xml'] = 'text/xml';
// $sysconf['mimetype']['mrc'] = 'text/marc';

/* PRICE CURRENCIES SETTING */
$sysconf['currencies'] = array( array('0', 'NONE'), 'Rupiah', 'USD', 'Euro', 'DM', 'Pounds', 'Yen', 'Won', 'Yuan', 'SGD', 'Bath', 'Ruppee', 'Taka', 'AUD');

/* RESERVE PERIODE (In Days) */
$sysconf['reserve_expire_periode'] = 7;

/* HTTPS Setting */
$sysconf['https_enable'] = false;
$sysconf['https_port'] = 443;

/* Date Format Setting for OPAC */
$sysconf['date_format'] = 'Y-m-d'; /* Produce 2009-12-31 */
// $sysconf['date_format'] = 'd-M-Y'; /* Produce 31-Dec-2009 */

$sysconf['pdf']['viewer'] = 'pdfjs'; # 'pdfjs'
$sysconf['allow_pdf_download'] = true;


/**
 * LDAP Specific setting for User
 */
if (($sysconf['auth']['user']['method'] === 'LDAP') OR ($sysconf['auth']['member']['method'] === 'LDAP')) {
  $sysconf['auth']['user']['ldap_server'] = '127.0.0.1'; // LDAP server
  $sysconf['auth']['user']['ldap_base_dn'] = 'ou=slims,dc=diknas,dc=go,dc=id'; // LDAP base DN
  $sysconf['auth']['user']['ldap_suffix'] = ''; // LDAP user suffix
  $sysconf['auth']['user']['ldap_bind_dn'] = 'uid=#loginUserName,'.$sysconf['auth']['user']['ldap_base_dn']; // Binding DN
  $sysconf['auth']['user']['ldap_port'] = null; // optional LDAP server connection port, use null or false for default
  $sysconf['auth']['user']['ldap_options'] = array(
      array(LDAP_OPT_PROTOCOL_VERSION, 3),
      array(LDAP_OPT_REFERRALS, 0)
      ); // optional LDAP server options
  $sysconf['auth']['user']['ldap_search_filter'] = '(|(uid=#loginUserName)(cn=#loginUserName*))'; // LDAP search filter, #loginUserName will be replaced by the real login name
  $sysconf['auth']['user']['userid_field'] = 'uid'; // LDAP field for username
  $sysconf['auth']['user']['fullname_field'] = 'cn'; // LDAP field for full name
  $sysconf['auth']['user']['mail_field'] = 'mail'; // LDAP field for e-mail
  /**
   * LDAP Specific setting for member
   * By default same as User
   */
  $sysconf['auth']['member']['ldap_server'] = &$sysconf['auth']['user']['ldap_server']; // LDAP server
  $sysconf['auth']['member']['ldap_base_dn'] = &$sysconf['auth']['user']['ldap_base_dn']; // LDAP base DN
  $sysconf['auth']['member']['ldap_suffix'] = &$sysconf['auth']['user']['ldap_suffix']; // LDAP user suffix
  $sysconf['auth']['member']['ldap_bind_dn'] = &$sysconf['auth']['user']['ldap_bind_dn']; // Binding DN
  $sysconf['auth']['member']['ldap_port'] = &$sysconf['auth']['user']['ldap_port']; // optional LDAP server connection port, use null or false for default
  $sysconf['auth']['member']['ldap_options'] = &$sysconf['auth']['user']['ldap_options']; // optional LDAP server options
  $sysconf['auth']['member']['ldap_search_filter'] = &$sysconf['auth']['user']['ldap_search_filter']; // LDAP search filter, #loginUserName will be replaced by the real login name
  $sysconf['auth']['member']['userid_field'] = &$sysconf['auth']['user']['userid_field']; // LDAP field for username
  $sysconf['auth']['member']['fullname_field'] = &$sysconf['auth']['user']['fullname_field']; // LDAP field for full name
  $sysconf['auth']['member']['mail_field'] = &$sysconf['auth']['user']['mail_field']; // LDAP field for e-mail
}

/**
 * Captcha Settings
 */
// Captcha settings for Senayan Management Console (aka Librarian Login)
$sysconf['captcha']['smc']['enable'] = false; // value can be 'true' or 'false'
$sysconf['captcha']['smc']['type'] = 'recaptcha'; // value can be 'recaptcha' (at this time)
if ($sysconf['captcha']['smc']['enable']) {
    include_once LIB.$sysconf['captcha']['smc']['type'].DS.'smc_settings.inc.php';
}

// Captcha settings for Member Login
$sysconf['captcha']['member']['enable'] = false; // value can be 'true' or 'false'
$sysconf['captcha']['member']['type'] = 'recaptcha'; // value can be 'recaptcha' (at this time)
if ($sysconf['captcha']['member']['enable']) {
    include_once LIB.$sysconf['captcha']['member']['type'].DS.'member_settings.inc.php';
}

/**
 * Mailing Settings
 */
$sysconf['mail']['enable'] = true;
$sysconf['mail']['server'] = 'ssl://smtp.gmail.com:465'; // SMTP server
$sysconf['mail']['server_port'] = 465; // the SMTP port
$sysconf['mail']['auth_enable'] = true; // enable SMTP authentication
$sysconf['mail']['auth_username'] = 'admin'; // SMTP account username
$sysconf['mail']['auth_password'] = 'admin'; // SMTP account password
$sysconf['mail']['from'] = 'admin@localhost';
$sysconf['mail']['from_name'] = 'SLiMS Administrator';
$sysconf['mail']['reply_to'] = &$sysconf['mail']['from'];
$sysconf['mail']['reply_to_name'] = &$sysconf['mail']['from_name'];

// IP based access limitation
$sysconf['ipaccess']['general'] = 'all'; // donot change this unless you know what you are doing
$sysconf['ipaccess']['opac'] = 'all'; // donot change this unless you know what you are doing
$sysconf['ipaccess']['opac-member'] = 'all'; // donot change this unless you know what you are doing
$sysconf['ipaccess']['smc'] = 'all';
$sysconf['ipaccess']['smc-bibliography'] = 'all';
$sysconf['ipaccess']['smc-circulation'] = 'all';
$sysconf['ipaccess']['smc-membership'] = 'all';
$sysconf['ipaccess']['smc-masterfile'] = 'all';
$sysconf['ipaccess']['smc-stocktake'] = 'all';
$sysconf['ipaccess']['smc-system'] = 'all';
$sysconf['ipaccess']['smc-reporting'] = 'all';
$sysconf['ipaccess']['smc-serialcontrol'] = 'all';

// check if session is auto started and then destroy it
if ($is_auto = @ini_get('session.auto_start')) { define('SESSION_AUTO_STARTED', $is_auto); }
if (defined('SESSION_AUTO_STARTED')) { @session_destroy(); }


