<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gap".
 *
 * @property int $id
 * @property int $selisih
 * @property float $bobot
 * @property string $keterangan
 */
class Gap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selisih', 'bobot', 'keterangan'], 'required'],
            [['selisih'], 'integer'],
            [['bobot'], 'number'],
            [['keterangan'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'selisih' => 'Selisih',
            'bobot' => 'Bobot',
            'keterangan' => 'Keterangan',
        ];
    }
}
