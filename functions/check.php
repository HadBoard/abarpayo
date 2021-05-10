<?
include "database.php";
$action = new Action();

$image = 'iVBORw0KGgoAAAANSUhEUgAAAHgAAAAUAQMAAAB'
. '8nGuwAAAABlBMVEX///8AAP94wDzzAAAACXBIWX'
. 'MAAA7EAAAOxAGVKw4bAAAAgUlEQVQYlWNgIBHYM'
. 'TDwMDB8gDEYkkEU4wwog4HhAIx/AMqX4+c5/rDh'
. '4x4w4wHDAWPJ3h7DxhnPwAwDhuOJG87zsD/mOQB'
. 'mMDAcrt9/nv1hM88BMOMBw+EEA94GQxAfxDBgSD'
. 'acceYMUP8BMMOAwU6evyf9YcOHA2DGA1K9QykAA'
. 'NIrNwD/nKH3AAAAAElFTkSuQmCC';

$image = str_replace('data:image/png;base64,', '', $image);
$image = str_replace(' ', '+', $image);
$data = base64_decode($image);
$name = $action->get_token(10) . '.jpg';
$file = '../admin/users/' . $name;
file_put_contents($file, $data);
// $command = $action -> user_profile($id,$name);