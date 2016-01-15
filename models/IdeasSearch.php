<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ideas;

/**
 * IdeasSearch represents the model behind the search form about `app\models\Ideas`.
 */
class IdeasSearch extends Ideas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ideaorder', 'ideaparent', 'active'], 'integer'],
            [['ideadescription', 'ideacreate', 'ideastart', 'ideaend', 'iconfa'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ideas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ideaorder' => $this->ideaorder,
            'ideaparent' => $this->ideaparent,
            'ideacreate' => $this->ideacreate,
            'ideastart' => $this->ideastart,
            'ideaend' => $this->ideaend,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'ideadescription', $this->ideadescription])
            ->andFilterWhere(['like', 'iconfa', $this->iconfa]);

        return $dataProvider;
    }
}
