<?php

namespace app\components;

use Yii;
use DateTime;

class Utility
{

    const LANG_EN = 'en-US';
    const LANG_TC = 'zh-TW';
    const LANG_SC = 'zh-CN';

    const URL_LANG_EN = 'en';
    const URL_LANG_TC = 'tc';
    const URL_LANG_SC = 'sc';

    const SYSTEM_USER_ID = 0;
    const DEFAULT_DIRECTORY_RIGHTS = 0775;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const APPROVE_STATUS_PENDING = 1;
    const APPROVE_STATUS_ACCEPT = 2;
    const APPROVE_STATUS_REJECT = 3;
    const IS_DELETED_YES = 1;
    const IS_DELETED_NO = 0;
    const OPTION_YES = 1;
    const OPTION_NO = 2;
    const URL_TARGET_SAME_WINDOW = 1;
    const URL_TARGET_NEW_WINDOW = 2;
    const OPTION_ON = 1;
    const OPTION_OFF = 2;

    public static function getSystemEnvironment()
    {
        return isset(Yii::$app->params['environment']) && !empty(Yii::$app->params['environment']) ? Yii::$app->params['environment'] : null;
    }

    public static function getSystemEnvironmentColor()
    {
        return isset(Yii::$app->params['environment_font_color']) && !empty(Yii::$app->params['environment_font_color']) ? Yii::$app->params['environment_font_color'] : null;
    }

    public function getDefaultLanguage()
    {
        return static::LANG_TC;
    }

    public function getUrlLanguage()
    {
        return $this->toUrlLang(Yii::$app->language);
    }

    public function toSystemLang($lang = null)
    {
        switch ($lang) {
            case static::URL_LANG_EN:
                $systemLang = static::LANG_EN;
                break;
            case static::URL_LANG_TC:
                $systemLang = static::LANG_TC;
                break;
            default:
                $systemLang = $this->getDefaultLanguage();
                break;
        }
        return $systemLang;
    }

    public function toUrlLang($lang = null)
    {
        switch ($lang) {
            case static::LANG_EN:
                $urlLang = static::URL_LANG_EN;
                break;
            case static::LANG_TC:
                $urlLang = static::URL_LANG_TC;
                break;
            default:
                $urlLang = $this->toUrlLang($this->getDefaultLanguage());
                break;
        }
        return $urlLang;
    }

    public function getFieldNameByLang($fieldName)
    {

        switch (Yii::$app->language) {
            case Utility::LANG_EN:
                $fieldName .= '_en';
                break;
            case Utility::LANG_TC:
                $fieldName .= '_tc';
                break;
            case Utility::URL_LANG_SC:
                $fieldName .= '_sc';
                break;
            default:
                $fieldName .= '_tc';
                break;
        }

        return $fieldName;
    }



    public static function frontendDateFormat($value, $withYear = true)
    {
        $date = new DateTime($value);
        switch (Yii::$app->language) {
            case Utility::LANG_EN:
                $format = 'jS M';
                if ($withYear) {
                    $format .= ' Y';
                }
                break;
            case Utility::LANG_TC:
                $format = $withYear ? 'Y年n月j日' : 'n月j日';
                break;
            default:
                $format = $withYear ? 'Y年n月j日' : 'n月j日';
                break;
        }

        return $date->format($format);
    }

    public static function frontendTimeFormat($value, $withAMPM = false)
    {
        $date = new DateTime($value);
        $hour = (int)$date->format('H');
        $minute = $date->format('i');

        switch (Yii::$app->language) {
            case Utility::LANG_EN:
                $format = 'H:i';
                if ($withAMPM) {
                    $format .= 'H:i A ';
                }
                break;
            case Utility::LANG_TC:
                $period = $hour < 12 ? '上午' : '下午';
                $format = $withAMPM ? $period . ' H:i' : 'H:i';
                break;
            default:
                $period = $hour < 12 ? '上午' : '下午';
                $format = $withAMPM ? $period . ' H:i' : 'H:i';
                break;
        }

        return $date->format($format);
    }

    public function generateRandomPasscode($length = 6)
    {
        return sprintf('%0' . $length . 'd', random_int(0, intval(str_repeat('9', $length))));
    }
}
