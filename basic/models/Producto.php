<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $F_IDPROD
 * @property int $F_IDMARCA
 * @property int $F_IDCAT
 * @property int $F_IDUBICA
 * @property int $F_IDPROV
 * @property string|null $F_NOMBREPROD
 *
 * @property Asigna[] $asignas
 * @property Responsable[] $fIDRESPs
 * @property Categoria $fIDCAT
 * @property Ubicacion $fIDUBICA
 * @property Marca $fIDMARCA
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
            [['F_IDMARCA', 'F_IDCAT', 'F_IDUBICA', 'F_IDPROV'], 'required'],
            [['F_IDMARCA', 'F_IDCAT', 'F_IDUBICA', 'F_IDPROV'], 'integer'],
            [['F_NOMBREPROD'], 'string', 'max' => 100],
            [['F_IDCAT'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['F_IDCAT' => 'F_IDCAT']],
            [['F_IDUBICA'], 'exist', 'skipOnError' => true, 'targetClass' => Ubicacion::className(), 'targetAttribute' => ['F_IDUBICA' => 'F_IDUBICA']],
            [['F_IDMARCA'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['F_IDMARCA' => 'F_IDMARCA']],
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
            'F_IDMARCA' => 'F Idmarca',
            'F_IDCAT' => 'F Idcat',
            'F_IDUBICA' => 'F Idubica',
            'F_IDPROV' => 'F Idprov',
            'F_NOMBREPROD' => 'F Nombreprod',
        ];
    }

    /**
     * Gets query for [[Asignas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignas()
    {
        return $this->hasMany(Asigna::className(), ['F_IDPROD' => 'F_IDPROD']);
    }

    /**
     * Gets query for [[FIDRESPs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDRESPs()
    {
        return $this->hasMany(Responsable::className(), ['F_IDRESP' => 'F_IDRESP'])->viaTable('asigna', ['F_IDPROD' => 'F_IDPROD']);
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
     * Gets query for [[FIDUBICA]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDUBICA()
    {
        return $this->hasOne(Ubicacion::className(), ['F_IDUBICA' => 'F_IDUBICA']);
    }

    /**
     * Gets query for [[FIDMARCA]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFIDMARCA()
    {
        return $this->hasOne(Marca::className(), ['F_IDMARCA' => 'F_IDMARCA']);
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
