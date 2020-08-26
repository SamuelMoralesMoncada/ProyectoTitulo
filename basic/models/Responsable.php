<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responsable".
 *
 * @property int $F_IDRESP
 * @property string|null $F_NOMBRERESP
 *
 * @property Asigna[] $asignas
 * @property Producto[] $fIDPRODs
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
            [['F_NOMBRERESP'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_IDRESP' => 'Código',
            'F_NOMBRERESP' => 'Nombre responsable',
        ];
    }

    /**
     * Gets query for [[Asignas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignas()
    {
        return $this->hasMany(Asigna::className(), ['F_IDRESP' => 'F_IDRESP']);
    }

    /**
     * Gets query for [[FIDPRODs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDPRODs()
    {
        return $this->hasMany(Producto::className(), ['F_IDPROD' => 'F_IDPROD'])->viaTable('asigna', ['F_IDRESP' => 'F_IDRESP']);
    }
}
