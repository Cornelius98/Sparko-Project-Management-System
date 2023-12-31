<?php 
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
require_once('classes/config/initDBConnection.php');
require_once('classes/file upload/fileupload.class.php');
require_once('classes/accounts/user/UserAccountPull.class.php');
require_once('classes/accounts/user/UserAccountPush.class.php');
require_once('classes/accounts/administrator/AdminiAccountPull.class.php');
require_once('classes/accounts/administrator/AdminiAccountPush.class.php');
require_once('classes/errors/errors.class.php');
require_once('classes/sanitize/sanitize.class.php');
require_once('classes/products/productPush.class.php');
require_once('classes/products/productPull.class.php');
require_once('classes/products/productUpdate.class.php');
require_once('classes/products/productDelete.class.php');
require_once('classes/sessions/user/userSessionPush.class.php');
require_once('classes/sessions/administrator/adminiSessionsPush.class.php');
require_once('classes/activity manager/activity.class.php');
require_once('templates/admin/atemplates.php');
require_once('templates/ux/ux.php');
require_once('libraries/auth/emails/user/uactivation_email.php');
require_once('libraries/auth/emails/user/ureset_email.php');
require_once('classes/utils/utils.class.php');

use DBTemplates\DBConnectionTemplate;
use AccountsManager\UserAccountPull;
use AccountsManager\UserAccountPush;
use AccountsManager\AdminiAccountPull;
use AccountsManager\AdminiAccountPush;
use ErrorManager\AdministratorErros;
use ErrorManager\AdvertiserErros;
use SanitizeManager\NameSanitizer;
use SanitizeManager\PasswordSanitize;
use SanitizeManager\RecognizeNumberEmailSanitize;
use SanitizeManager\DescriptionSanitize;
use SanitizeManager\MonieSanitize;
use SanitizeManager\GeocoordSanitize;
use UserSessionManager\UserSessionPush;
use AdminiSessionManager\AdminiSessionPush;
use ActivityManager\User AS UserActivity;
use ActivityManager\Administrator AS AdministratorActivity;
use TemplateManager\AdminiTemplates\AdminiTemplate;
use TemplateManager\UserTemplates\UXTemplate;
use ProductManager\ProductPush;
use ProductManager\ProductPull;
use ProductManager\ProductUpdate;
use ProductManager\ProductSearch;
use ProductManager\ProductDelete;
use UtilityManager\UtilityPull;

$DBConnectionTemplates = new DBConnectionTemplate();
$UserAccountPull = new UserAccountPull();
$UserAccountPush = new UserAccountPush();
$AdminiAccountPull = new AdminiAccountPull();
$AdminiAccountPush = new AdminiAccountPush();
$UserErrorsPool = new AdvertiserErros();
$AdminiErrorsPool = new AdministratorErros();
$NameSanitizer = new NameSanitizer();
$PasswordSanitize = new PasswordSanitize();
$RecognizeNumberEmailSanitize = new RecognizeNumberEmailSanitize();
$DescriptionSanitize = new DescriptionSanitize();
$MonieSanitize = new MonieSanitize();
$GeocoordSanitize = new GeocoordSanitize();
$UserSessionPush = new UserSessionPush();
$AdminiSessionPush = new AdminiSessionPush();
$UserActivity = new UserActivity();
$AdministratorActivity = new AdministratorActivity();
$UXviewTemplate = new UXTemplate();
$AdminiUXTemplate = new AdminiTemplate();
$FileUploadHandler = new FileUploadHandler();
$ProductPush = new ProductPush();
$ProductPull = new ProductPull();
$ProductUpdate = new ProductUpdate();
$ProductDelete = new ProductDelete();
$Utility = new UtilityPull();
?>