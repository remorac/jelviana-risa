<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kriteria".
 *
 * @property int $id
 * @property string $nama
 * @property int $jenis
 *
 * @property User $id0
 * @property PemeriksaanKriteria[] $pemeriksaanKriterias
 * @property Subkriteria[] $subkriterias
 */
class Kriteria extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;

    const JENIS_CORE      = 1;
    const JENIS_SECONDARY = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kriteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'jenis'], 'required'],
            [['jenis'], 'integer'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'jenis' => 'Jenis',
            'jenisText' => 'Jenis',
            'targetSubkriteriaNama' => 'Subkriteria Target',
            'targetSubkriteriaNilai' => 'Nilai Target',
        ];
    }

    /**
     * Gets query for [[PemeriksaanKriterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaanKriterias()
    {
        return $this->hasMany(PemeriksaanKriteria::className(), ['kriteria_id' => 'id']);
    }

    /**
     * Gets query for [[Subkriterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubkriterias()
    {
        return $this->hasMany(Subkriteria::className(), ['kriteria_id' => 'id']);
    }

    public function setSubkriterias($value)
    {
        $this->loadRelated('subkriterias', $value);
    }

    public static function jenisOptions($index = null)
    {
        $array = [
            self::JENIS_CORE      => 'Core Factor',
            self::JENIS_SECONDARY => 'Secondary Factor',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === null) return $array;
        return null;
    }

    public function getJenisText()
    {
        return self::jenisOptions($this->jenis);
    }

    public function getTargetSubkriteria()
    {
        return Subkriteria::findOne([
            'kriteria_id' => $this->id,
            'target' => 1,
        ]);
    }

    public function getTargetSubkriteriaNama()
    {
        if ($this->targetSubkriteria) return $this->targetSubkriteria->nama;
        return null;
    }

    public function getTargetSubkriteriaNilai()
    {
        if ($this->targetSubkriteria) return $this->targetSubkriteria->nilai;
        return null;
    }
}
