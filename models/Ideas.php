<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ideas".
 *
 * @property integer $id
 * @property string $ideadescription
 * @property integer $ideaorder
 * @property integer $ideaparent
 * @property string $ideacreate
 * @property string $ideastart
 * @property string $ideaend
 * @property string $iconfa
 * @property integer $active
 */
class Ideas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ideas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ideadescription', 'ideaorder', 'ideaparent'], 'required'],
            [['id', 'ideaorder', 'ideaparent', 'active'], 'integer'],
            [['ideacreate', 'ideastart', 'ideaend'], 'safe'],
            [['ideadescription'], 'string', 'max' => 500],
            [['iconfa'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ideadescription' => Yii::t('app', 'Idea description'),
            'ideaorder' => Yii::t('app', 'Idea order'),
            'ideaparent' => Yii::t('app', 'Idea parent'),
            'ideacreate' => Yii::t('app', 'Idea create'),
            'ideastart' => Yii::t('app', 'Idea start'),
            'ideaend' => Yii::t('app', 'Idea end'),
            'iconfa' => Yii::t('app', 'Icon fa'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @inheritdoc
     * @return IdeasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IdeasQuery(get_called_class());
    }
}
