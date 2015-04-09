<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quotation;

/**
 * QuotationSearch represents the model behind the search form about `app\models\Quotation`.
 */


class QuotationSearch extends Quotation
{
    /**
     * @inheritdoc
     */

    //public  $client_name;
    public  $company;


    public function rules()
    {
        return [
            [['id', 'client_company_id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['ref', 'project_name', 'date', 'po_no', 'status', 'supervisor_name'], 'safe'],
            [['clients.client_name'],'safe'],
            [['company.company_name'],'safe'],
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

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['company.company_name', 'clients.client_name']);
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
        $query = Quotation::find();
        $query->joinWith(['clients', 'company']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['clients.client_name'] = [
            'asc' => ['clients.client_name' => SORT_ASC],
            'desc' => ['clients.client_name' => SORT_DESC],
        ];

       $dataProvider->sort->attributes['company.company_name'] = [
            'asc' => ['company.company_name' => SORT_ASC],
            'desc' => ['company.company_name' => SORT_DESC],
        ];

        /*$dataProvider->setSort([
            'attributes' => [
                'id',
                'ref',
                'company' => [
                    'asc' => ['company.company_name' => SORT_ASC],
                    'desc' => ['company.company_name' => SORT_DESC],
                    'label' => 'Country Name'
                ]
            ]
        ]);*/

        if (!($this->load($params) && $this->validate())) {

            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'date' => $this->date,
            'client_company_id' => $this->client_company_id,
            'user_id' => $this->user_id,
        ]);



        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'project_name', $this->project_name])
            ->andFilterWhere(['like', 'po_no', $this->po_no])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'supervisor_name', $this->supervisor_name])
            ->andFilterWhere(['like', 'clients.client_name', $this->getAttribute('clients.client_name')])
            ->andFilterWhere(['like', 'company.company_name', $this->getAttribute('company.company_name')]);


        return $dataProvider;
    }
}
