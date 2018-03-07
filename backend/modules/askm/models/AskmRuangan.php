<?php

namespace backend\modules\askm\models;

use Yii;

/**
 * This is the model class for table "askm_ruangan".
 *
 * @property integer $ruangan_id
 * @property string $name
 * @property integer $izin_tambahan_jam_kolaboratif_id
 *
 * @property AskmIzinTambahanJamKolaboratif $izinTambahanJamKolaboratif
 */
class AskmRuangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_ruangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['izin_tambahan_jam_kolaboratif_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['izin_tambahan_jam_kolaboratif_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmIzinTambahanJamKolaboratif::className(), 'targetAttribute' => ['izin_tambahan_jam_kolaboratif_id' => 'izin_tambahan_jam_kolaboratif_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ruangan_id' => 'Ruangan ID',
            'name' => 'Name',
            'izin_tambahan_jam_kolaboratif_id' => 'Izin Tambahan Jam Kolaboratif ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIzinTambahanJamKolaboratif()
    {
        return $this->hasOne(AskmIzinTambahanJamKolaboratif::className(), ['izin_tambahan_jam_kolaboratif_id' => 'izin_tambahan_jam_kolaboratif_id']);
    }
}
