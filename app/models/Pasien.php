<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id
 * @property string $nama
 * @property int $umur
 * @property string $alamat
 *
 * @property Pemeriksaan[] $pemeriksaans
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'umur', 'alamat'], 'required'],
            [['umur'], 'integer'],
            [['nama'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 200],
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
            'umur' => 'Umur',
            'alamat' => 'Alamat',
        ];
    }

    /**
     * Gets query for [[Pemeriksaans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::className(), ['pasien_id' => 'id']);
    }
}
