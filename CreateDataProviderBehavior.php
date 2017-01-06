<?php
namespace app\components;

use yii\base\Behavior;
use yii\data\ActiveDataProvider;

class CreateDataProviderBehavior extends Behavior
{
    /**
     * Create ActiveDataProvider
     * @param \yii\db\ActiveQuery $query
     * @param array $pagination
     * @return \yii\data\ActiveDataProvider
     */
    public function createDataProvider($query,$pagination=false)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
        ]);
        return $dataProvider ;
    }

}
