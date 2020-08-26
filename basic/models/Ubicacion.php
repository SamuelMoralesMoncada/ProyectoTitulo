<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubicacion".
 *
 * @property int $F_IDUBICA
 * @property string|null $F_NOMBREUBICA
 *
 * @property Producto[] $productos
 */
class Ubicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ubicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_NOMBREUBICA'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_IDUBICA' => 'F Idubica',
            'F_NOMBREUBICA' => 'F Nombreubica',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['F_IDUBICA' => 'F_IDUBICA']);
    }
}
