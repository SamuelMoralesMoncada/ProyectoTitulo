<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responsable".
 *
 * @property int $F_IDRESP
 * @property string|null $F_NOMBRERESP
 *
 * @property Producto[] $productos
 */
class Responsable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_NOMBRERESP'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_IDRESP' => 'F Idresp',
            'F_NOMBRERESP' => 'F Nombreresp',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['F_IDRESP' => 'F_IDRESP']);
    }
}
