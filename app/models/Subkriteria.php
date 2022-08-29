<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subkriteria".
 *
 * @property int $id
 * @property int $kriteria_id
 * @property string $nama
 * @property int $nilai
 * @property int $target
 *
 * @property Kriteria $kriteria
 * @property PemeriksaanSubkriteria[] $pemeriksaanSubkriterias
 */
class Subkriteria extends \yii\db\ActiveRecord
{
    const TARGET_TIDAK = 0;
    const TARGET_YA    = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subkriteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [[/* 'kriteria_id', */ 'nama', 'nilai', 'target'], 'required'],
            [['kriteria_id', 'nilai', 'target'], 'integer'],
            [['nama'], 'string', 'max' => 100],
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
            'kriteria_id' => 'Kriteria',
            'nama' => 'Nama',
            'nilai' => 'Nilai',
            'target' => 'Target',
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
     * Gets query for [[PemeriksaanKriterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaanKriterias()
    {
        return $this->hasMany(PemeriksaanKriteria::className(), ['subkriteria_id' => 'id']);
    }

    public static function targetOptions($index = null)
    {
        $array = [
            self::TARGET_TIDAK => 'Tidak',
            self::TARGET_YA    => 'Ya',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === null) return $array;
        return null;
    }

    public function getTargetText()
    {
        return self::targetOptions($this->target);
    }
}
