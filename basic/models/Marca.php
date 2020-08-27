<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property int $F_IDMARCA
 * @property string|null $F_NOMBREMARCA
 *
 * @property Producto[] $productos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_NOMBREMARCA'], 'string', 'max' => 100],
            [['F_NOMBREMARCA'],'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_IDMARCA' => 'Código',
            'F_NOMBREMARCA' => 'Nombre marca',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['F_IDMARCA' => 'F_IDMARCA']);
    }
}
