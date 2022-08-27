<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_subkriteria".
 *
 * @property int $id
 * @property int $pemeriksaan_id
 * @property int $subkriteria_id
 * @property int $nilai_profil
 *
 * @property Pemeriksaan $pemeriksaan
 * @property Subkriteria $subkriteria
 */
class PemeriksaanSubkriteria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_subkriteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pemeriksaan_id', 'subkriteria_id', 'nilai_profil'], 'required'],
            [['pemeriksaan_id', 'subkriteria_id', 'nilai_profil'], 'integer'],
            [['pemeriksaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pemeriksaan::className(), 'targetAttribute' => ['pemeriksaan_id' => 'id']],
            [['subkriteria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subkriteria::className(), 'targetAttribute' => ['subkriteria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pemeriksaan_id' => 'Pemeriksaan',
            'subkriteria_id' => 'Subkriteria',
            'nilai_profil' => 'Nilai Profil',
        ];
    }

    /**
     * Gets query for [[Pemeriksaan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::className(), ['id' => 'pemeriksaan_id']);
    }

    /**
     * Gets query for [[Subkriteria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubkriteria()
    {
        return $this->hasOne(Subkriteria::className(), ['id' => 'subkriteria_id']);
    }
}
