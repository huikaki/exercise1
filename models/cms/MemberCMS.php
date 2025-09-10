<?php

namespace app\models\cms;

use app\models\Member;
use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $maid_no Maid Number like PMAT8245/1.0
 * @property string $name Full Name
 * @property int $age Age in years
 * @property string $nationality e.g. FILIPINO
 * @property string $gender M for Male, F for Female
 * @property string $marital_status Marital Status
 * @property int $height_cm Height in cm
 * @property int $weight_kg Weight in kg
 * @property string $education Education level, e.g. UNIVERSITY
 * @property string|null $chinese_zodiac e.g. DRAGON
 * @property string|null $religion e.g. CATHOLIC
 * @property string|null $horoscope e.g. CANCER
 * @property int|null $work_experience_years Total years of work experience
 * @property string|null $languages JSON or comma-separated: e.g. Cantonese:Fair,English:Good
 * @property string|null $skills JSON or comma-separated: e.g. Caring babies:Yes,Cooking:Yes
 * @property string|null $previous_employment JSON array of past jobs: e.g. [{"employer":1,"location":"PHILIPPINES","period":"2021-2024"}]
 * @property string|null $profile_photo URL to profile image, e.g. /uploads/i1.jpg
 * @property string $status Status of the member
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MemberCMS extends \yii\db\ActiveRecord
{
    // public $skills;
    protected $publishModelClass = Member::class;
    /**
     * ENUM field values
     */
    const GENDER_M = 'M';
    const GENDER_F = 'F';
    const MARITAL_STATUS_SINGLE = 'SINGLE';
    const MARITAL_STATUS_MARRIED = 'MARRIED';
    const MARITAL_STATUS_DIVORCED = 'DIVORCED';
    const MARITAL_STATUS_WIDOWED = 'WIDOWED';
    const STATUS_AVAILABLE = 'AVAILABLE';
    const STATUS_HIRED = 'HIRED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_TERMINATED = 'TERMINATED';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chinese_zodiac', 'religion', 'horoscope',  'profile_photo'], 'default', 'value' => null],
            [['work_experience_years'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 'AVAILABLE'],
            [['languages', 'skills', 'previous_employment'], 'safe'],
            // languages 係 string type
            [['maid_no', 'name', 'age', 'nationality', 'gender', 'marital_status', 'height_cm', 'weight_kg', 'education'], 'required'],
            [['age', 'height_cm', 'weight_kg', 'work_experience_years'], 'integer'],
            [['gender', 'marital_status',  'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['maid_no', 'nationality', 'chinese_zodiac', 'religion', 'horoscope'], 'string', 'max' => 50],
            [['name', 'education'], 'string', 'max' => 100],
            [['profile_photo'], 'string', 'max' => 255],
            ['gender', 'in', 'range' => array_keys(self::optsGender())],
            ['marital_status', 'in', 'range' => array_keys(self::optsMaritalStatus())],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['maid_no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'maid_no' => 'Maid No',
            'name' => 'Name',
            'age' => 'Age',
            'nationality' => 'Nationality',
            'gender' => 'Gender',
            'marital_status' => 'Marital Status',
            'height_cm' => 'Height Cm',
            'weight_kg' => 'Weight Kg',
            'education' => 'Education',
            'chinese_zodiac' => 'Chinese Zodiac',
            'religion' => 'Religion',
            'horoscope' => 'Horoscope',
            'work_experience_years' => 'Work Experience Years',
            'languages' => 'Languages',
            'skills' => 'Skills',
            'previous_employment' => 'Previous Employment',
            'profile_photo' => 'Profile Photo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /**
     * column gender ENUM value labels
     * @return string[]
     */
    public static function optsGender()
    {
        return [
            self::GENDER_M => 'M',
            self::GENDER_F => 'F',
        ];
    }

    /**
     * column marital_status ENUM value labels
     * @return string[]
     */
    public static function optsMaritalStatus()
    {
        return [
            self::MARITAL_STATUS_SINGLE => 'SINGLE',
            self::MARITAL_STATUS_MARRIED => 'MARRIED',
            self::MARITAL_STATUS_DIVORCED => 'DIVORCED',
            self::MARITAL_STATUS_WIDOWED => 'WIDOWED',
        ];
    }

    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_AVAILABLE => 'AVAILABLE',
            self::STATUS_HIRED => 'HIRED',
            self::STATUS_PENDING => 'PENDING',
            self::STATUS_TERMINATED => 'TERMINATED',
        ];
    }

    /**
     * @return string
     */
    public function displayGender()
    {
        return self::optsGender()[$this->gender];
    }

    /**
     * @return bool
     */
    public function isGenderM()
    {
        return $this->gender === self::GENDER_M;
    }

    public function setGenderToM()
    {
        $this->gender = self::GENDER_M;
    }

    /**
     * @return bool
     */
    public function isGenderF()
    {
        return $this->gender === self::GENDER_F;
    }

    public function setGenderToF()
    {
        $this->gender = self::GENDER_F;
    }

    /**
     * @return string
     */
    public function displayMaritalStatus()
    {
        return self::optsMaritalStatus()[$this->marital_status];
    }

    /**
     * @return bool
     */
    public function isMaritalStatusSingle()
    {
        return $this->marital_status === self::MARITAL_STATUS_SINGLE;
    }

    public function setMaritalStatusToSingle()
    {
        $this->marital_status = self::MARITAL_STATUS_SINGLE;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusMarried()
    {
        return $this->marital_status === self::MARITAL_STATUS_MARRIED;
    }

    public function setMaritalStatusToMarried()
    {
        $this->marital_status = self::MARITAL_STATUS_MARRIED;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusDivorced()
    {
        return $this->marital_status === self::MARITAL_STATUS_DIVORCED;
    }

    public function setMaritalStatusToDivorced()
    {
        $this->marital_status = self::MARITAL_STATUS_DIVORCED;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusWidowed()
    {
        return $this->marital_status === self::MARITAL_STATUS_WIDOWED;
    }

    public function setMaritalStatusToWidowed()
    {
        $this->marital_status = self::MARITAL_STATUS_WIDOWED;
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusAvailable()
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function setStatusToAvailable()
    {
        $this->status = self::STATUS_AVAILABLE;
    }

    /**
     * @return bool
     */
    public function isStatusHired()
    {
        return $this->status === self::STATUS_HIRED;
    }

    public function setStatusToHired()
    {
        $this->status = self::STATUS_HIRED;
    }

    /**
     * @return bool
     */
    public function isStatusPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function setStatusToPending()
    {
        $this->status = self::STATUS_PENDING;
    }
    // 喺 Member.php 入面加呢啲方法

    public function afterFind()
    {
        parent::afterFind();
        // 處理 languages
        $this->languages = is_string($this->languages) && !empty($this->languages) ? json_decode($this->languages, true) : [];
        if (!is_array($this->languages)) {
            $this->languages = [];
        }


        // 處理 skills
        // 假設 skills 是存儲在數據庫中的 JSON 字段
        if (!empty($this->skills)) {
            $this->skills = json_decode($this->skills, true);
        } else {
            $this->skills = [];
        }

        // previous_employment
        if (!empty($this->previous_employment)) {
            $this->previous_employment = json_decode($this->previous_employment, true);
        } else {
            $this->previous_employment = [];
        }
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // 處理 languages
            if (is_array($this->languages)) {
                $this->languages = json_encode($this->languages);
            } else {
                $this->languages = json_encode([]); // 確保不為 NULL
            }

            // 處理 skills
            if (is_array($this->skills)) {
                $this->skills = json_encode($this->skills);
            }

            if (is_array($this->previous_employment)) {
                $this->previous_employment = json_encode($this->previous_employment);
            } else {
                $this->previous_employment = json_encode([]); // 確保不為 NULL
            }
            return true;
        }
        return false;
    }

    // 加一個新方法嚟取得 languages 陣列
    public function getLanguagesArray()
    {
        if (is_array($this->languages)) {
            return $this->languages ?: [];
        }
        return $this->languages ? json_decode($this->languages, true) : [];
    }


    public function getSkillsArray()
    {
        $availableSkills = [
            'Caring babies',
            'Caring toddler',
            'Caring children',
            'Caring elderly',
            'Cooking',
            'Household Cleaning & Organization',
            'Other Household Tasks & Management',
            'Personal Qualities & Soft Skills',
            'Driving'
        ];

        $skills = $this->skills;

        $skillsMap = array_column($skills, 'value', 'skill');
        \Yii::debug($skillsMap, 'skills_map');

        $result = [];
        foreach ($availableSkills as $skill) {
            $result[] = [
                'skill' => $skill,
                'value' => isset($skillsMap[$skill]) ? filter_var($skillsMap[$skill], FILTER_VALIDATE_BOOLEAN) : false
            ];
        }

        \Yii::debug($result, 'skills_array');
        return $result;
    }

    public function getPreviousArray()
    {
        if (is_array($this->previous_employment)) {
            return $this->previous_employment ?: [];
        }
        return $this->previous_employment ? json_decode($this->previous_employment, true) : [];
    }
    /**
     * @return bool
     */
    public function isStatusTerminated()
    {
        return $this->status === self::STATUS_TERMINATED;
    }

    public function setStatusToTerminated()
    {
        $this->status = self::STATUS_TERMINATED;
    }
}
