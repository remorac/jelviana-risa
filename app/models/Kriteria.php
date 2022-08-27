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
        ];
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
}