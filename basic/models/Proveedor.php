<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $F_IDPROV
 * @property string|null $F_NOMBREPROV
 * @property string|null $F_DIRECCIONPRO
 * @property string|null $F_ANTIGUEDADPRO
 * @property int|null $F_FONOPRO
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
            [['F_ANTIGUEDADPRO'], 'safe'],
            [['F_NOMBREPROV', 'F_DIRECCIONPRO', 'F_ANTIGUEDADPRO', 'F_FONOPRO'], 'required'],
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
            'F_IDPROV' => 'Id Proveedor',
            'F_NOMBREPROV' => 'Nombre Proveedor',
            'F_DIRECCIONPRO' => 'Dirección Proveedor',
            'F_ANTIGUEDADPRO' => 'Antiguedad',
            'F_FONOPRO' => 'Teléfono contacto',
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
