<?php

namespace app\models\cms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\cms\MemberCMS;

/**
 * MemberCMSSearch represents the model behind the search form of `app\models\cms\MemberCMS`.
 */
class MemberCMSSearch extends MemberCMS
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'height_cm', 'weight_kg', 'work_experience_years'], 'integer'],
            [['maid_no', 'name', 'nationality', 'gender', 'marital_status', 'education', 'chinese_zodiac', 'religion', 'horoscope', 'languages', 'skills', 'previous_employment', 'profile_photo', 'status', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = MemberCMS::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'age' => $this->age,
            'height_cm' => $this->height_cm,
            'weight_kg' => $this->weight_kg,
            'work_experience_years' => $this->work_experience_years,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'maid_no', $this->maid_no])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'chinese_zodiac', $this->chinese_zodiac])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'horoscope', $this->horoscope])
            ->andFilterWhere(['like', 'languages', $this->languages])
            ->andFilterWhere(['like', 'skills', $this->skills])
            ->andFilterWhere(['like', 'previous_employment', $this->previous_employment])
            ->andFilterWhere(['like', 'profile_photo', $this->profile_photo])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
