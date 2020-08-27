<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asigna".
 *
 * @property int $F_IDPROD
 * @property int $F_IDRESP
 * @property string|null $F_FECHAASIGNA
 *
 * @property Producto $fIDPROD
 * @property Responsable $fIDRESP
 */
class Asigna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asigna';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_IDPROD', 'F_IDRESP','F_FECHAASIGNA'], 'required'],
            [['F_IDPROD', 'F_IDRESP'], 'integer'],
            [['F_FECHAASIGNA'], 'safe'],
            [['F_IDPROD', 'F_IDRESP'], 'unique', 'targetAttribute' => ['F_IDPROD', 'F_IDRESP']],
            [['F_IDPROD'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['F_IDPROD' => 'F_IDPROD']],
            [['F_IDRESP'], 'exist', 'skipOnError' => true, 'targetClass' => Responsable::className(), 'targetAttribute' => ['F_IDRESP' => 'F_IDRESP']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_IDPROD' => 'F Idprod',
            'F_IDRESP' => 'F Idresp',
            'F_FECHAASIGNA' => 'F Fechaasigna',
        ];
    }

    /**
     * Gets query for [[FIDPROD]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDPROD()
    {
        return $this->hasOne(Producto::className(), ['F_IDPROD' => 'F_IDPROD']);
    }

    /**
     * Gets query for [[FIDRESP]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDRESP()
    {
        return $this->hasOne(Responsable::className(), ['F_IDRESP' => 'F_IDRESP']);
    }
}
