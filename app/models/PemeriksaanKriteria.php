<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_kriteria".
 *
 * @property int $id
 * @property int $pemeriksaan_id
 * @property int $kriteria_id
 * @property int $subkriteria_id
 *
 * @property Kriteria $kriteria
 * @property Pemeriksaan $pemeriksaan
 * @property Subkriteria $subkriteria
 */
class PemeriksaanKriteria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_kriteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [[/* 'pemeriksaan_id', */ 'kriteria_id', 'subkriteria_id'], 'required'],
            [['pemeriksaan_id', 'kriteria_id', 'subkriteria_id'], 'integer'],
            [['subkriteria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subkriteria::className(), 'targetAttribute' => ['subkriteria_id' => 'id']],
            [['pemeriksaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pemeriksaan::className(), 'targetAttribute' => ['pemeriksaan_id' => 'id']],
            [['kriteria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kriteria::className(), 'targetAttribute' => ['kriteria_id' => 'id']],
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
            'kriteria_id' => 'Kriteria',
            'subkriteria_id' => 'Subkriteria',
        ];
    }

    /**
     * Gets query for [[Kriteria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKriteria()
    {
        return $this->hasOne(Kriteria::className(), ['id' => 'kriteria_id']);
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

    public function getNilaiProfil()
    {
        return $this->subkriteria ? $this->subkriteria->nilai : 0;
    }

    public function getNilaiTarget()
    {
        return Subkriteria::findOne([
            'kriteria_id' => $this->kriteria_id,
            'target' => 1,
        ]) ? Subkriteria::findOne([
            'kriteria_id' => $this->kriteria_id,
            'target' => 1,
        ])->nilai : 0;
    }

    public function getSelisih()
    {
        return $this->nilaiProfil - $this->nilaiTarget;
    }

    public function getGap()
    {
        return Gap::findOne(['selisih' => $this->selisih]);
    }
}
