<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $F_IDPROV
 * @property string|null $F_NOMBREPROV
 * @property string $F_DIRECCIONPRO
 * @property string $F_ANTIGUEDADPRO
 * @property int $F_FONOPRO
 *
 * @property Producto[] $productos
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_NOMBREPROV','F_DIRECCIONPRO', 'F_ANTIGUEDADPRO', 'F_FONOPRO'], 'required'],
            [['F_ANTIGUEDADPRO'], 'safe'],
            [['F_FONOPRO'], 'integer'],
            [['F_NOMBREPROV', 'F_DIRECCIONPRO'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_IDPROV' => 'Código',
            'F_NOMBREPROV' => 'Nombre proveedor',
            'F_DIRECCIONPRO' => 'Dirección',
            'F_ANTIGUEDADPRO' => 'Antiguedad',
            'F_FONOPRO' => 'Fono contacto',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['F_IDPROV' => 'F_IDPROV']);
    }
}
