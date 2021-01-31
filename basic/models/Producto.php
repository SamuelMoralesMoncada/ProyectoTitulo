<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $F_IDPROD
 * @property int $F_IDCAT
 * @property int $F_IDRESP
 * @property int $F_IDPROV
 * @property string|null $F_NOMBREPROD
 * @property string|null $F_FECHAREGISTROPRO
 * @property string|null $F_NOMBREMARCA
 * @property string|null $F_ESTADO
 * @property string|null $F_DESCRIPRO
 *
 * @property Categoria $fIDCAT
 * @property Responsable $fIDRESP
 * @property Proveedor $fIDPROV
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_IDCAT', 'F_IDRESP', 'F_IDPROV'], 'required'],
            [['F_IDCAT', 'F_IDRESP', 'F_IDPROV'], 'integer'],
            [['F_FECHAREGISTROPRO'], 'safe'],
            [['F_NOMBREPROD', 'F_NOMBREMARCA', 'F_DESCRIPRO'], 'string', 'max' => 100],
            [['F_ESTADO'], 'string', 'max' => 50],
            [['F_IDCAT'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['F_IDCAT' => 'F_IDCAT']],
            [['F_IDRESP'], 'exist', 'skipOnError' => true, 'targetClass' => Responsable::className(), 'targetAttribute' => ['F_IDRESP' => 'F_IDRESP']],
            [['F_IDPROV'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['F_IDPROV' => 'F_IDPROV']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'F_IDPROD' => 'F Idprod',
            'F_IDCAT' => 'F Idcat',
            'F_IDRESP' => 'F Idresp',
            'F_IDPROV' => 'F Idprov',
            'F_NOMBREPROD' => 'F Nombreprod',
            'F_FECHAREGISTROPRO' => 'F Fecharegistropro',
            'F_NOMBREMARCA' => 'F Nombremarca',
            'F_ESTADO' => 'F Estado',
            'F_DESCRIPRO' => 'F Descripro',
        ];
    }

    /**
     * Gets query for [[FIDCAT]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDCAT()
    {
        return $this->hasOne(Categoria::className(), ['F_IDCAT' => 'F_IDCAT']);
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

    /**
     * Gets query for [[FIDPROV]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDPROV()
    {
        return $this->hasOne(Proveedor::className(), ['F_IDPROV' => 'F_IDPROV']);
    }
}
