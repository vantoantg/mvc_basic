<?php

/*
 *  Created by Tona Nguyen
 *  Email: nguyennguyen.vt88@gmail.com
 *  Phone: 0932.252.414
 *  Address: VN, HCMC
 *  Website: https://jobsvina.com/
 */

namespace lib\base;

use app\models\JobCategories;
use app\models\Locations;
use app\models\Pages;
use app\models\UserJobs;
use Carbon\Carbon;
use Symfony\Component\Yaml\Yaml;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Response;

/**
 * Class Helper
 */
class Helper
{
    /**
     * @var object Helper
     */
    protected static $_instance;

    public function init()
    {
    }

    /**
     * @param bool $refresh
     *
     * @return Helper|object
     */
    public static function getInstance($refresh = false)
    {
        if ($refresh || !(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @param bool $domainNameOnly
     *
     * @return string
     */
    public function siteURL($domainNameOnly = false)
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
            $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $domainName = $_SERVER['HTTP_HOST'];
        if ($domainNameOnly) {
            return $domainName;
        }

        return $protocol.$domainName;
    }

    /**
     * @return mixed
     */
    public function getBrowser()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * @return mixed
     */
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return mixed
     */
    public static function getIpClient()
    {
        return $_SERVER['SERVER_ADDR'];
    }

    /**
     * @return string
     */
    public static function getCurrentUrl()
    {
        return 'http'.(($_SERVER['SERVER_PORT'] == 443) ? 's://' : '://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public static function getCookie($name)
    {
        $return = explode('~', $name);
        if (!isset($_COOKIE[$name])) {
            return $return[0];
        } else {
            return $return[1];
        }
    }

    /**
     * @param $array
     *
     * @return \stdClass
     */
    public function arrayToObject($array)
    {
        $object = new \stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::getInstance()->arrayToObject($value);
            }
            $object->$key = $value;
        }

        return $object;
    }

    /**
     * @param $object
     *
     * @return array
     */
    public function objectToArray($object)
    {
        $arrays = [];
        foreach ($object as $key => $value) {
            if (is_object($value)) {
                $value = self::getInstance()->objectToArray($value);
            }
            $arrays[$key] = $value;
        }

        return $arrays;
    }

    /**
     * @param $strUrl
     *
     * @return string
     */
    public function checkUrlHttp($strUrl)
    {
        $arrParsedUrl = parse_url($strUrl);
        if (!empty($arrParsedUrl['scheme'])) {
            // Contains http:// schema
            if ($arrParsedUrl['scheme'] === 'http') {
            } // Contains https:// schema
            else {
                if ($arrParsedUrl['scheme'] === 'https') {
                }
            }

            return $strUrl;
        } else {
            return 'http://'.$strUrl;
        }
    }


    /**
     * Function used to create a slug associated to an "ugly" string.
     *
     * @param string $string the string to transform.
     *
     * @return string the resulting slug.
     */
    public function createSlug($string)
    {
        $string = self::getInstance()->stripUnicode($string);
        $table = [
            '�' => 'S',
            '�' => 's',
            '?' => 'Dj',
            '?' => 'dj',
            '�' => 'Z',
            '�' => 'z',
            '?' => 'C',
            '?' => 'c',
            '?' => 'C',
            '?' => 'c',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'A',
            '�' => 'C',
            '�' => 'E',
            '�' => 'E',
            '�' => 'E',
            '�' => 'E',
            '�' => 'I',
            '�' => 'I',
            '�' => 'I',
            '�' => 'I',
            '�' => 'N',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'O',
            '�' => 'U',
            '�' => 'U',
            '�' => 'U',
            '�' => 'U',
            '�' => 'Y',
            '�' => 'B',
            '�' => 'Ss',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'a',
            '�' => 'c',
            '�' => 'e',
            '�' => 'e',
            '�' => 'e',
            '�' => 'e',
            '�' => 'i',
            '�' => 'i',
            '�' => 'i',
            '�' => 'i',
            '�' => 'o',
            '�' => 'n',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'o',
            '�' => 'u',
            '�' => 'u',
            '�' => 'u',
            '�' => 'y',
            '�' => 'y',
            '�' => 'b',
            '�' => 'y',
            '?' => 'R',
            '?' => 'r',
            '/' => '-',
            ' ' => '-',
            '.' => '',
            ',' => '',
            '"' => '',
            "'" => '',
            ';' => '',
            ':' => '-',
            '@' => '-',
            '#' => '',
            '(' => '-',
            ')' => '-',
            '[' => '',
            ']' => '',
        ];

        // -- Remove duplicated spaces
        $string = preg_replace(['/\s{2,}/', '/[\t\n]/'], ' ', $string);

        // -- Returns the slug
        $str = strtolower(strtr($string, $table));
        $str = '@@-'.$str.'-@@';
        $str = str_replace('_', '-', $str);
        $str = str_replace('--', '-', $str);
        $str = str_replace('---', '-', $str);
        $str = str_replace('----', '-', $str);
        $str = str_replace('@@-', '', $str);
        $str = str_replace('-@@', '', $str);

        return $str;
    }

    /**
     * @param $str
     *
     * @return mixed
     */
    public function stripUnicode($str)
    {
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $str);
        $str = preg_replace('/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/', 'E', $str);
        $str = preg_replace('/(Ì|Í|Ị|Ỉ|Ĩ)/', 'I', $str);
        $str = preg_replace('/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/', 'O', $str);
        $str = preg_replace('/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/', 'U', $str);
        $str = preg_replace('/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/', 'Y', $str);
        $str = preg_replace('/(Đ)/', 'D', $str);
        $str = str_replace('  ', ' ', $str);
        $str = str_replace('   ', ' ', $str);
        $str = str_replace('    ', ' ', $str);
        $str = str_replace('     ', ' ', $str);
        $str = str_replace('      ', ' ', $str);
        $str = str_replace('       ', ' ', $str);
        $str = str_replace('        ', ' ', $str);
        $str = str_replace('         ', ' ', $str);
        $str = str_replace('          ', ' ', $str);
        $str = str_replace('           ', ' ', $str);

        return $str;
    }

    /**
     * @param $str
     * @param int $words
     *
     * @return string
     */
    public function cutStringSpace($str, $words = 20)
    {
        if ($str) {
            $string = '';
            $arr = explode(' ', $str);
            if (count($arr) > $words) {
                for ($i = 0; $i < $words; $i++) {
                    $string .= ' '.$arr[$i];
                }

                return trim($string.'...');
            }

            return $str;
        }
    }

    public function checkWordInString($string, $needle = '')
    {
        if (strpos($string, $needle) !== false) {
            return true;
        }

        return false;
    }

    /**
     * @param $code
     *
     * @return bool|string
     */
    public function getCode($code)
    {
        return Helper::getInstance()->encrypt($code, false);
    }

    /**
     * @param $code
     *
     * @return bool|string
     */
    public function setCode($code)
    {
        return Helper::getInstance()->encrypt($code);
    }

    /**
     * @param string $param
     * @param int $flags
     * @return bool|mixed
     */
    public function yamlGet($param = 'all', $flags = 0)
    {
        $data = Yaml::parseFile(getenv('CONFIG_YAML'), $flags);

        if ($param == 'all') {
            return $data;
        }

        if (isset($data[$param])) {
            return $data[$param];
        } else {
            return false;
        }
    }

    /**
     * @param $data
     * @param int $flags
     * @param null $context
     * @return bool
     */
    public function yamlSet($data, $flags = 0, $context = null)
    {
        if (!$data) {
            return false;
        }

        if (file_put_contents(getenv('CONFIG_YAML'), Yaml::dump($data), $flags, $context)) {
            return true;
        }

        return false;
    }

    /**
     * @param $param
     * @param $value
     * @param bool $forceSave
     * @param int $flags
     * @param null $context
     * @return bool
     */
    public function yamlGetAndSet($param, $value, $forceSave = false, $flags = 0, $context = null)
    {
        $data = $this->yamlGet();

        if (!isset($data[$param]) && $forceSave == false) {
            return false;
        }

        $data[$param] = $value;
        $this->yamlSet($data, $flags, $context);

        return false;
    }

    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
