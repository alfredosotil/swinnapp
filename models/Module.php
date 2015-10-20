<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "module".
 *
 * @property integer $id
 * @property string $iconfa
 * @property string $label
 * @property string $description
 * @property string $controller
 * @property integer $active
 * @property integer $type_id
 *
 * @property Access[] $accesses
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'description', 'controller', 'active', 'type_id'], 'required'],
            [['active', 'type_id'], 'integer'],
            [['iconfa'], 'string', 'max' => 100],
            [['label', 'controller'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iconfa' => 'Iconfa',
            'label' => 'Label',
            'description' => 'Description',
            'controller' => 'Controller',
            'active' => 'Active',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses()
    {
        return $this->hasMany(Access::className(), ['module_id' => 'id']);
    }
}
