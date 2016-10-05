<?php

namespace suPnPsu\reserveRoom\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use suPnPsu\reserveRoom\models\RoomReserve;

/**
 * RoomReserveSearch represents the model behind the search form about `suPnPsu\reserveRoom\models\RoomReserve`.
 */
class RoomReserveSearch extends RoomReserve
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'status', 'user_id', 'confirmed_by', 'confirmed_at', 'returned_by', 'returned_at', 'note', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['subject', 'date_start', 'date_end', 'time_start', 'time_end', 'confirmed_comment', 'returned_comment','date_range'], 'safe'],
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
    
    public $date_start;
    
    public $date_range;

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RoomReserve::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'room_id' => $this->room_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'confirmed_by' => $this->confirmed_by,
            'confirmed_at' => $this->confirmed_at,
            'returned_by' => $this->returned_by,
            'returned_at' => $this->returned_at,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);
        
        list($date1,$time1) = @explode(' ', $this->date_range);
        
        $query->andFilterWhere(['>=','date(date_start)',$date1]);
        $query->andFilterWhere(['>=','time(time_start)' ,$time1]);
        //$query->andFilterWhere(['<=','time(time_end)', $time1]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'confirmed_comment', $this->confirmed_comment])
            ->andFilterWhere(['like', 'returned_comment', $this->returned_comment]);

        return $dataProvider;
    }
}
