<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form about `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_employee'], 'integer'],
            [['company_name', 'address', 'established_date', 'contact_no', 'email', 'website', 'quotation_header_image', 'quotation_table_header_color', 'quotation_table_sub_header_color', 'quotation_watermark_image', 'bill_header_image', 'bill_table_header_color', 'bill_table_sub_header_color', 'bill_watermark_image'], 'safe'],
            [['company_vat'], 'number'],
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
        $query = Company::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'established_date' => $this->established_date,
            'total_employee' => $this->total_employee,
            'company_vat' => $this->company_vat,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'quotation_header_image', $this->quotation_header_image])
            ->andFilterWhere(['like', 'quotation_table_header_color', $this->quotation_table_header_color])
            ->andFilterWhere(['like', 'quotation_table_sub_header_color', $this->quotation_table_sub_header_color])
            ->andFilterWhere(['like', 'quotation_watermark_image', $this->quotation_watermark_image])
            ->andFilterWhere(['like', 'bill_header_image', $this->bill_header_image])
            ->andFilterWhere(['like', 'bill_table_header_color', $this->bill_table_header_color])
            ->andFilterWhere(['like', 'bill_table_sub_header_color', $this->bill_table_sub_header_color])
            ->andFilterWhere(['like', 'bill_watermark_image', $this->bill_watermark_image]);

        return $dataProvider;
    }
}
