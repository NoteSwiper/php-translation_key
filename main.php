<?php
function GetTranslated(string $key, string|null $languageCode = null, bool|null $showoriginonerror = false): string|null|array {
	$langCode = $languageCode;
	$showorigin = $showoriginonerror;
	if (!isset($langCode)) {
		$langCode = $_GET['lang'] ?? "en";
	}
	if (!isset($showoriginonerror)) {
		$showorigin = $_GET['key_err'] ?? false;
	}
	$translations = json_decode(file_get_contents("C:/xampp/www/files/translations.json"),true);
	$is_key_set = isset($translations[$key]);
	$is_lang_set = isset($translations[$key][$langCode]);
	if ($is_key_set == true && $is_lang_set == true) {
		return $translations[$key][$langCode];
	} elseif ($is_key_set == true && $is_lang_set == false) {
		return $showorigin ? $translations[$key]['en'] : "<p style=\"color: red;\">Translation key: $key is not translated on $langCode yet.<br />Change the parameter \"showorigin\" true to show original text.</p>";
	} elseif ($is_key_set == false && $is_lang_set == false) {
		return "<p style=\"color: red;\">Unknown translation key: $key</p>";
	} else {
		return "<p style=\"color: red;\">Unexcepted error.</p>";
	}
}
