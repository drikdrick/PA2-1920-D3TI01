<?php

namespace backend\modules\dimx\models;

use Yii;

/**
 * This is the model class for table "dimx_dim".
 *
 * @property integer $dim_id
 * @property string $nim
 * @property string $no_usm
 * @property string $jalur
 * @property string $user_name
 * @property string $kbk_id
 * @property integer $ref_kbk_id
 * @property string $kpt_prodi
 * @property integer $id_kur
 * @property integer $tahun_kurikulum_id
 * @property string $nama
 * @property string $tgl_lahir
 * @property string $tempat_lahir
 * @property string $gol_darah
 * @property integer $golongan_darah_id
 * @property string $jenis_kelamin
 * @property integer $jenis_kelamin_id
 * @property string $agama
 * @property integer $agama_id
 * @property string $alamat
 * @property string $kabupaten
 * @property string $kode_pos
 * @property string $email
 * @property string $telepon
 * @property string $hp
 * @property string $hp2
 * @property string $no_ijazah_sma
 * @property string $nama_sma
 * @property integer $asal_sekolah_id
 * @property string $alamat_sma
 * @property string $kabupaten_sma
 * @property string $telepon_sma
 * @property string $kodepos_sma
 * @property integer $thn_masuk
 * @property string $status_akhir
 * @property string $nama_ayah
 * @property string $nama_ibu
 * @property string $no_hp_ayah
 * @property string $no_hp_ibu
 * @property string $alamat_orangtua
 * @property string $pekerjaan_ayah
 * @property integer $pekerjaan_ayah_id
 * @property string $keterangan_pekerjaan_ayah
 * @property string $penghasilan_ayah
 * @property integer $penghasilan_ayah_id
 * @property string $pekerjaan_ibu
 * @property integer $pekerjaan_ibu_id
 * @property string $keterangan_pekerjaan_ibu
 * @property string $penghasilan_ibu
 * @property integer $penghasilan_ibu_id
 * @property string $nama_wali
 * @property string $pekerjaan_wali
 * @property integer $pekerjaan_wali_id
 * @property string $keterangan_pekerjaan_wali
 * @property string $penghasilan_wali
 * @property integer $penghasilan_wali_id
 * @property string $alamat_wali
 * @property string $telepon_wali
 * @property string $no_hp_wali
 * @property string $pendapatan
 * @property double $ipk
 * @property integer $anak_ke
 * @property integer $dari_jlh_anak
 * @property integer $jumlah_tanggungan
 * @property double $nilai_usm
 * @property integer $score_iq
 * @property string $rekomendasi_psikotest
 * @property string $foto
 * @property string $kode_foto
 * @property integer $user_id
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $asrama_id
 * @property integer $kelas_id
 *
 * @property AbsnAbsensi[] $absnAbsensis
 * @property AdakMahasiswaAssistant[] $adakMahasiswaAssistants
 * @property AdakRegistrasi[] $adakRegistrasis
 * @property AskmIzinBermalam[] $askmIzinBermalams
 * @property AskmIzinKeluar[] $askmIzinKeluars
 * @property AskmIzinPenggunaanRuangan[] $askmIzinPenggunaanRuangans
 * @property AskmIzinTambahanJamKolaboratif[] $askmIzinTambahanJamKolaboratifs
 * @property DimxAlumni[] $dimxAlumnis
 * @property MrefRAgama $agama0
 * @property MrefRAsalSekolah $asalSekolah
 * @property MrefRGolonganDarah $golonganDarah
 * @property MrefRJenisKelamin $jenisKelamin
 * @property MrefRPekerjaan $pekerjaanAyah
 * @property MrefRPekerjaan $pekerjaanIbu
 * @property MrefRPekerjaan $pekerjaanWali
 * @property MrefRPenghasilan $penghasilanAyah
 * @property MrefRPenghasilan $penghasilanIbu
 * @property MrefRPenghasilan $penghasilanWali
 * @property InstProdi $refKbk
 * @property KrkmRTahunKurikulum $tahunKurikulum
 * @property SysxUser $user
 * @property AdakKelas $kelas
 * @property AskmAsrama $asrama
 * @property DimxDimPmb[] $dimxDimPmbs
 * @property DimxDimPmbDaftar[] $dimxDimPmbDaftars
 * @property DimxDimTrnonLulus[] $dimxDimTrnonLuluses
 * @property DimxHistoriProdi[] $dimxHistoriProdis
 * @property KmhsDetailKasus[] $kmhsDetailKasuses
 * @property KmhsMasterKasus[] $kmhsMasterKasuses
 * @property KmhsNilaiPerilaku[] $kmhsNilaiPerilakus
 * @property KmhsNilaiPerilakuArsip[] $kmhsNilaiPerilakuArsips
 * @property KmhsNilaiPerilakuAs[] $kmhsNilaiPerilakuAs
 * @property KmhsNilaiPerilakuSummary[] $kmhsNilaiPerilakuSummaries
 * @property KmhsNilaiPerilakuTs[] $kmhsNilaiPerilakuTs
 * @property NlaiExtMhs[] $nlaiExtMhs
 * @property NlaiNilai[] $nlaiNilais
 * @property NlaiNilaiKomponenTambahan[] $nlaiNilaiKomponenTambahans
 * @property NlaiNilaiPraktikum[] $nlaiNilaiPraktikums
 * @property NlaiNilaiQuis[] $nlaiNilaiQuis
 * @property NlaiNilaiTugas[] $nlaiNilaiTugas
 * @property NlaiNilaiUas[] $nlaiNilaiUas
 * @property NlaiNilaiUts[] $nlaiNilaiUts
 * @property NlaiUasDetail[] $nlaiUasDetails
 * @property NlaiUtsDetail[] $nlaiUtsDetails
 * @property PrklBeritaAcaraDaftarHadir[] $prklBeritaAcaraDaftarHadirs
 * @property PrklInfoTa[] $prklInfoTas
 * @property PrklKrsMhs[] $prklKrsMhs
 */
class DimxDim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dimx_dim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_kbk_id', 'id_kur', 'tahun_kurikulum_id', 'golongan_darah_id', 'jenis_kelamin_id', 'agama_id', 'asal_sekolah_id', 'thn_masuk', 'pekerjaan_ayah_id', 'penghasilan_ayah_id', 'pekerjaan_ibu_id', 'penghasilan_ibu_id', 'pekerjaan_wali_id', 'penghasilan_wali_id', 'anak_ke', 'dari_jlh_anak', 'jumlah_tanggungan', 'score_iq', 'user_id', 'deleted', 'asrama_id', 'kelas_id'], 'integer'],
            [['nama', 'asrama_id', 'kelas_id'], 'required'],
            [['tgl_lahir', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['alamat', 'alamat_sma', 'alamat_orangtua', 'keterangan_pekerjaan_ayah', 'keterangan_pekerjaan_ibu', 'keterangan_pekerjaan_wali', 'alamat_wali'], 'string'],
            [['ipk', 'nilai_usm'], 'number'],
            [['nim', 'kodepos_sma'], 'string', 'max' => 8],
            [['no_usm'], 'string', 'max' => 15],
            [['jalur', 'kbk_id', 'telepon_wali'], 'string', 'max' => 20],
            [['user_name', 'kpt_prodi'], 'string', 'max' => 10],
            [['nama', 'tempat_lahir', 'kabupaten', 'email', 'telepon', 'hp', 'hp2', 'nama_sma', 'telepon_sma', 'status_akhir', 'nama_ayah', 'nama_ibu', 'no_hp_ayah', 'no_hp_ibu', 'penghasilan_ayah', 'penghasilan_ibu', 'nama_wali', 'pekerjaan_wali', 'penghasilan_wali', 'no_hp_wali', 'pendapatan', 'foto'], 'string', 'max' => 50],
            [['gol_darah'], 'string', 'max' => 2],
            [['jenis_kelamin'], 'string', 'max' => 1],
            [['agama'], 'string', 'max' => 30],
            [['kode_pos'], 'string', 'max' => 5],
            [['no_ijazah_sma', 'kabupaten_sma', 'pekerjaan_ayah', 'pekerjaan_ibu', 'kode_foto'], 'string', 'max' => 100],
            [['rekomendasi_psikotest'], 'string', 'max' => 4],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['nim'], 'unique'],
            [['agama_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRAgama::className(), 'targetAttribute' => ['agama_id' => 'agama_id']],
            [['asal_sekolah_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRAsalSekolah::className(), 'targetAttribute' => ['asal_sekolah_id' => 'asal_sekolah_id']],
            [['golongan_darah_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRGolonganDarah::className(), 'targetAttribute' => ['golongan_darah_id' => 'golongan_darah_id']],
            [['jenis_kelamin_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRJenisKelamin::className(), 'targetAttribute' => ['jenis_kelamin_id' => 'jenis_kelamin_id']],
            [['pekerjaan_ayah_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRPekerjaan::className(), 'targetAttribute' => ['pekerjaan_ayah_id' => 'pekerjaan_id']],
            [['pekerjaan_ibu_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRPekerjaan::className(), 'targetAttribute' => ['pekerjaan_ibu_id' => 'pekerjaan_id']],
            [['pekerjaan_wali_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRPekerjaan::className(), 'targetAttribute' => ['pekerjaan_wali_id' => 'pekerjaan_id']],
            [['penghasilan_ayah_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRPenghasilan::className(), 'targetAttribute' => ['penghasilan_ayah_id' => 'penghasilan_id']],
            [['penghasilan_ibu_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRPenghasilan::className(), 'targetAttribute' => ['penghasilan_ibu_id' => 'penghasilan_id']],
            [['penghasilan_wali_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRPenghasilan::className(), 'targetAttribute' => ['penghasilan_wali_id' => 'penghasilan_id']],
            [['ref_kbk_id'], 'exist', 'skipOnError' => true, 'targetClass' => InstProdi::className(), 'targetAttribute' => ['ref_kbk_id' => 'ref_kbk_id']],
            [['tahun_kurikulum_id'], 'exist', 'skipOnError' => true, 'targetClass' => KrkmRTahunKurikulum::className(), 'targetAttribute' => ['tahun_kurikulum_id' => 'tahun_kurikulum_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => SysxUser::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['kelas_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdakKelas::className(), 'targetAttribute' => ['kelas_id' => 'kelas_id']],
            [['asrama_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmAsrama::className(), 'targetAttribute' => ['asrama_id' => 'asrama_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dim_id' => 'Dim ID',
            'nim' => 'Nim',
            'no_usm' => 'No Usm',
            'jalur' => 'Jalur',
            'user_name' => 'User Name',
            'kbk_id' => 'Kbk ID',
            'ref_kbk_id' => 'Ref Kbk ID',
            'kpt_prodi' => 'Kpt Prodi',
            'id_kur' => 'Id Kur',
            'tahun_kurikulum_id' => 'Tahun Kurikulum ID',
            'nama' => 'Nama',
            'tgl_lahir' => 'Tgl Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'gol_darah' => 'Gol Darah',
            'golongan_darah_id' => 'Golongan Darah ID',
            'jenis_kelamin' => 'Jenis Kelamin',
            'jenis_kelamin_id' => 'Jenis Kelamin ID',
            'agama' => 'Agama',
            'agama_id' => 'Agama ID',
            'alamat' => 'Alamat',
            'kabupaten' => 'Kabupaten',
            'kode_pos' => 'Kode Pos',
            'email' => 'Email',
            'telepon' => 'Telepon',
            'hp' => 'Hp',
            'hp2' => 'Hp2',
            'no_ijazah_sma' => 'No Ijazah Sma',
            'nama_sma' => 'Nama Sma',
            'asal_sekolah_id' => 'Asal Sekolah ID',
            'alamat_sma' => 'Alamat Sma',
            'kabupaten_sma' => 'Kabupaten Sma',
            'telepon_sma' => 'Telepon Sma',
            'kodepos_sma' => 'Kodepos Sma',
            'thn_masuk' => 'Thn Masuk',
            'status_akhir' => 'Status Akhir',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            'no_hp_ayah' => 'No Hp Ayah',
            'no_hp_ibu' => 'No Hp Ibu',
            'alamat_orangtua' => 'Alamat Orangtua',
            'pekerjaan_ayah' => 'Pekerjaan Ayah',
            'pekerjaan_ayah_id' => 'Pekerjaan Ayah ID',
            'keterangan_pekerjaan_ayah' => 'Keterangan Pekerjaan Ayah',
            'penghasilan_ayah' => 'Penghasilan Ayah',
            'penghasilan_ayah_id' => 'Penghasilan Ayah ID',
            'pekerjaan_ibu' => 'Pekerjaan Ibu',
            'pekerjaan_ibu_id' => 'Pekerjaan Ibu ID',
            'keterangan_pekerjaan_ibu' => 'Keterangan Pekerjaan Ibu',
            'penghasilan_ibu' => 'Penghasilan Ibu',
            'penghasilan_ibu_id' => 'Penghasilan Ibu ID',
            'nama_wali' => 'Nama Wali',
            'pekerjaan_wali' => 'Pekerjaan Wali',
            'pekerjaan_wali_id' => 'Pekerjaan Wali ID',
            'keterangan_pekerjaan_wali' => 'Keterangan Pekerjaan Wali',
            'penghasilan_wali' => 'Penghasilan Wali',
            'penghasilan_wali_id' => 'Penghasilan Wali ID',
            'alamat_wali' => 'Alamat Wali',
            'telepon_wali' => 'Telepon Wali',
            'no_hp_wali' => 'No Hp Wali',
            'pendapatan' => 'Pendapatan',
            'ipk' => 'Ipk',
            'anak_ke' => 'Anak Ke',
            'dari_jlh_anak' => 'Dari Jlh Anak',
            'jumlah_tanggungan' => 'Jumlah Tanggungan',
            'nilai_usm' => 'Nilai Usm',
            'score_iq' => 'Score Iq',
            'rekomendasi_psikotest' => 'Rekomendasi Psikotest',
            'foto' => 'Foto',
            'kode_foto' => 'Kode Foto',
            'user_id' => 'User ID',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'asrama_id' => 'Asrama ID',
            'kelas_id' => 'Kelas ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsnAbsensis()
    {
        return $this->hasMany(AbsnAbsensi::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdakMahasiswaAssistants()
    {
        return $this->hasMany(AdakMahasiswaAssistant::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdakRegistrasis()
    {
        return $this->hasMany(AdakRegistrasi::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinBermalams()
    {
        return $this->hasMany(AskmIzinBermalam::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinKeluars()
    {
        return $this->hasMany(AskmIzinKeluar::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinPenggunaanRuangans()
    {
        return $this->hasMany(AskmIzinPenggunaanRuangan::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinTambahanJamKolaboratifs()
    {
        return $this->hasMany(AskmIzinTambahanJamKolaboratif::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimxAlumnis()
    {
        return $this->hasMany(DimxAlumni::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgama0()
    {
        return $this->hasOne(MrefRAgama::className(), ['agama_id' => 'agama_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsalSekolah()
    {
        return $this->hasOne(MrefRAsalSekolah::className(), ['asal_sekolah_id' => 'asal_sekolah_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGolonganDarah()
    {
        return $this->hasOne(MrefRGolonganDarah::className(), ['golongan_darah_id' => 'golongan_darah_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisKelamin()
    {
        return $this->hasOne(MrefRJenisKelamin::className(), ['jenis_kelamin_id' => 'jenis_kelamin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPekerjaanAyah()
    {
        return $this->hasOne(MrefRPekerjaan::className(), ['pekerjaan_id' => 'pekerjaan_ayah_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPekerjaanIbu()
    {
        return $this->hasOne(MrefRPekerjaan::className(), ['pekerjaan_id' => 'pekerjaan_ibu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPekerjaanWali()
    {
        return $this->hasOne(MrefRPekerjaan::className(), ['pekerjaan_id' => 'pekerjaan_wali_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenghasilanAyah()
    {
        return $this->hasOne(MrefRPenghasilan::className(), ['penghasilan_id' => 'penghasilan_ayah_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenghasilanIbu()
    {
        return $this->hasOne(MrefRPenghasilan::className(), ['penghasilan_id' => 'penghasilan_ibu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenghasilanWali()
    {
        return $this->hasOne(MrefRPenghasilan::className(), ['penghasilan_id' => 'penghasilan_wali_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKbk()
    {
        return $this->hasOne(InstProdi::className(), ['ref_kbk_id' => 'ref_kbk_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahunKurikulum()
    {
        return $this->hasOne(KrkmRTahunKurikulum::className(), ['tahun_kurikulum_id' => 'tahun_kurikulum_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(SysxUser::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(AdakKelas::className(), ['kelas_id' => 'kelas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsrama()
    {
        return $this->hasOne(AskmAsrama::className(), ['asrama_id' => 'asrama_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimxDimPmbs()
    {
        return $this->hasMany(DimxDimPmb::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimxDimPmbDaftars()
    {
        return $this->hasMany(DimxDimPmbDaftar::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimxDimTrnonLuluses()
    {
        return $this->hasMany(DimxDimTrnonLulus::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimxHistoriProdis()
    {
        return $this->hasMany(DimxHistoriProdi::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKmhsDetailKasuses()
    {
        return $this->hasMany(KmhsDetailKasus::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKmhsMasterKasuses()
    {
        return $this->hasMany(KmhsMasterKasus::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKmhsNilaiPerilakus()
    {
        return $this->hasMany(KmhsNilaiPerilaku::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKmhsNilaiPerilakuArsips()
    {
        return $this->hasMany(KmhsNilaiPerilakuArsip::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKmhsNilaiPerilakuAs()
    {
        return $this->hasMany(KmhsNilaiPerilakuAs::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKmhsNilaiPerilakuSummaries()
    {
        return $this->hasMany(KmhsNilaiPerilakuSummary::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKmhsNilaiPerilakuTs()
    {
        return $this->hasMany(KmhsNilaiPerilakuTs::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiExtMhs()
    {
        return $this->hasMany(NlaiExtMhs::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiNilais()
    {
        return $this->hasMany(NlaiNilai::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiNilaiKomponenTambahans()
    {
        return $this->hasMany(NlaiNilaiKomponenTambahan::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiNilaiPraktikums()
    {
        return $this->hasMany(NlaiNilaiPraktikum::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiNilaiQuis()
    {
        return $this->hasMany(NlaiNilaiQuis::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiNilaiTugas()
    {
        return $this->hasMany(NlaiNilaiTugas::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiNilaiUas()
    {
        return $this->hasMany(NlaiNilaiUas::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiNilaiUts()
    {
        return $this->hasMany(NlaiNilaiUts::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiUasDetails()
    {
        return $this->hasMany(NlaiUasDetail::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNlaiUtsDetails()
    {
        return $this->hasMany(NlaiUtsDetail::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrklBeritaAcaraDaftarHadirs()
    {
        return $this->hasMany(PrklBeritaAcaraDaftarHadir::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrklInfoTas()
    {
        return $this->hasMany(PrklInfoTa::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrklKrsMhs()
    {
        return $this->hasMany(PrklKrsMhs::className(), ['dim_id' => 'dim_id']);
    }
}
