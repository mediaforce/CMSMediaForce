<?php 

namespace CmsBase\Helper;

class SlugHelper {
	public static function is_utf8( $string ){
	    return preg_match('%^(?:
	                      [\x09\x0A\x0D\x20-\x7E] |
	                      [\xC2-\xDF][\x80-\xBF] |
	                      \xE0[\xA0-\xBF][\x80-\xBF] |
	                      [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} |
	                      \xED[\x80-\x9F][\x80-\xBF] |
	                      \xF0[\x90-\xBF][\x80-\xBF]{2} |
	                      [\xF1-\xF3][\x80-\xBF]{3} |
	                      \xF4[\x80-\x8F][\x80-\xBF]{2})*$%xs',
	                      $string);
	}
	 
	/**
	 * Remove diacritics (accents) from a string.
	 * @param string $string
	 * @return string
	 */
	public static function remove_diacritics($string) {
	    return preg_replace(array('/\xc3[\x80-\x85]/', //upper case
	                              '/\xc3\x87/',
	                              '/\xc3[\x88-\x8b]/',
	                              '/\xc3[\x8c-\x8f]/',
	                              '/\xc3([\x92-\x96]|\x98)/',
	                              '/\xc3[\x99-\x9c]/',
	                              '/\xc3[\xa0-\xa5]/', //lower case
	                              '/\xc3\xa7/',
	                              '/\xc3[\xa8-\xab]/',
	                              '/\xc3[\xac-\xaf]/',
	                              '/\xc3([\xb2-\xb6]|\xb8)/',
	                              '/\xc3[\xb9-\xbc]/'),
	                        str_split('ACEIOUaceiou', 1),
	                        self::is_utf8( $string ) ? $string : utf8_encode($string));
	}
	 
	/**
	 * Creates a "slug" from a string
	 * @param string $string
	 * @return string
	 */
	public static function slug($string) {
	    return preg_replace(array('/[^a-z0-9]/', '/-{2,}/'), '-', strtolower(self::remove_diacritics($string)));
	}
}