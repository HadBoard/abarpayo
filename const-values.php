<? require_once "functions/database.php";
$action = new Action();

$default = (isset($_SESSION['default_city'])) ? $_SESSION['default_city'] : 426;

$register_score = (int)$action->get_system('score_register');
$wallet_increase_score = (int)$action->get_system('score_wallet');
$invitation_score = (int)$action->get_system('score_invite');
$guild_score = (int)$action->get_system('score_guild_by_guild');
$user_guild_score = (int)$action->get_system('score_guild_by_user');
$marketer_guild_score = (int)$action->get_system('score_guild_by_marketer');

$marketer_register_score = (int)$action->get_system('score_marketer_register');
$marketer_wallet_increase_score = (int)$action->get_system('score_marketer_wallet');
$marketer_invitation_score = (int)$action->get_system('score_marketer_invite');

