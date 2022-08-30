<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan".
 *
 * @property int $id
 * @property int $pasien_id
 * @property string $tanggal
 *
 * @property Pasien $pasien
 * @property PemeriksaanKriteria[] $pemeriksaanKriterias
 */
class Pemeriksaan extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pasien_id', 'tanggal'], 'required'],
            [['pasien_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['pasien_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::className(), 'targetAttribute' => ['pasien_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pasien_id' => 'Pasien',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * Gets query for [[Pasien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['id' => 'pasien_id']);
    }

    /**
     * Gets query for [[PemeriksaanKriterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaanKriterias()
    {
        return $this->hasMany(PemeriksaanKriteria::className(), ['pemeriksaan_id' => 'id']);
    }

    public function setPemeriksaanKriterias($value)
    {
        $this->loadRelated('pemeriksaanKriterias', $value);
    }

    public function getCoreCount()
    {
        $return = 0;
        foreach ($this->pemeriksaanKriterias as $pemeriksaanKriteria) {
            if ($pemeriksaanKriteria->kriteria->jenis === 1) $return ++;
        }
        return $return;
    }

    public function getCoreSum()
    {
        $return = 0;
        foreach ($this->pemeriksaanKriterias as $pemeriksaanKriteria) {
            if ($pemeriksaanKriteria->kriteria->jenis === 1) $return += $pemeriksaanKriteria->gap->bobot;
        }
        return $return;
    }
    public function getCoreSumDetail()
    {
        $return = [];
        foreach ($this->pemeriksaanKriterias as $pemeriksaanKriteria) {
            if ($pemeriksaanKriteria->kriteria->jenis === 1) $return[] = $pemeriksaanKriteria->gap->bobot;
        }
        return implode('+', $return);
    }

    public function getCoreAverage()
    {
        return $this->coreSum / $this->coreCount;
    }
    public function getCoreAverageDetail()
    {
        return '('.$this->getCoreSumDetail().') / '.$this->coreCount;
    }

    public function getSecondaryCount()
    {
        $return = 0;
        foreach ($this->pemeriksaanKriterias as $pemeriksaanKriteria) {
            if ($pemeriksaanKriteria->kriteria->jenis === 2) $return ++;
        }
        return $return;
    }

    public function getSecondarySum()
    {
        $return = 0;
        foreach ($this->pemeriksaanKriterias as $pemeriksaanKriteria) {
            if ($pemeriksaanKriteria->kriteria->jenis === 2) $return += $pemeriksaanKriteria->gap->bobot;
        }
        return $return;
    }
    public function getSecondarySumDetail()
    {
        $return = [];
        foreach ($this->pemeriksaanKriterias as $pemeriksaanKriteria) {
            if ($pemeriksaanKriteria->kriteria->jenis === 2) $return[] = $pemeriksaanKriteria->gap->bobot;
        }
        return implode('+', $return);
    }

    public function getSecondaryAverage()
    {
        return $this->secondarySum / $this->secondaryCount;
    }
    public function getSecondaryAverageDetail()
    {
        return '('.$this->getSecondarySumDetail().') / '.$this->secondaryCount;
    }

    public function getResult()
    {
        return ($this->coreAverage * 0.7) + ($this->secondaryAverage * 0.3);
    }
    public function getResultDetail()
    {
        return '('.Yii::$app->formatter->asDecimal($this->coreAverage, 2).' * '.'70%) + ('.Yii::$app->formatter->asDecimal($this->secondaryAverage, 2).' * 30%)';
    }
    public function getResultText()
    {
        return $this->result >= Yii::$app->params['threshold'] ? '<span class="text-danger">Terindikasi COVID-19</span>' : '<span class="text-success">Tidak Terindikasi COVID-19</span>';
    }
}
