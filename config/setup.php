<?php 
class Configuration{
	public static function getSettings(){
	$settings_file = __DIR__ . '/settings.yml';
		if (!file_exists($settings_file)){
			return false;			
		}
		return Spyc::YAMLLoad($settings_file);
	}
}
// $settings_file = __DIR__ . '/settings.yml';
// $app->get('/install/database', function($req, $res){
// 	$res->write('Atta!!!!');
// });


// $sf = fopen (__DIR__ . '/../config/settings.yml', 'w');
// fwrite($sf, Spyc::YAMLDump($settings));
// fclose($sf);

