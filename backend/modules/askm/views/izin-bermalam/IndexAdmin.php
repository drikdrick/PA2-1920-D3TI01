<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\ToolsColumn;
use backend\modules\models\Asrama;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\search\IzinBermalamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Izin Bermalam';
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="izin-bermalam-index">

    <?= $uiHelper->renderContentHeader($this->title);?>
    <?= $uiHelper->renderLine(); ?>

    <?php

        $toolbarItemMenu =  
            "
            <a href='".Url::to(['izin-bermalam/izin-by-admin-index'])."' class='btn btn-info'><i class='fa fa-history'></i><span class='toolbar-label'>Daftar Request</span></a>
            <a href='".Url::to(['izin-bermalam/izin-by-admin-add'])."' class='btn btn-success'><i class='fa fa-book'></i><span class='toolbar-label'>Request IB</span></a>
            <a href='".Url::to(['izin-bermalam/excel'])."' class='btn btn-warning'><i class='fa fa-archive'></i><span class='toolbar-label'>Rekapitulasi IB</span></a>
            "
            ;

    ?>

    <?=Yii::$app->uiHelper->renderToolbar([
    'pull-left' => true,
    'groupTemplate' => ['groupStatusExpired'],
    'groups' => [
        'groupStatusExpired' => [
            'template' => ['filterStatus'],
            'buttons' => [
                'filterStatus' => $toolbarItemMenu,
            ]
        ],
    ],
    ]) ?>

    <br>

    <?=$uiHelper->beginContentRow() ?>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
                <h4>Pniel</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countPniel; ?></i>
                </div>

              <p>Request Masuk</p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=4&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
                <h4>Kapernaum</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countKapernaum; ?></i>
                </div>

              <p>Request Masuk</p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=2&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
                <h4>Silo</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countSilo; ?></i>
                </div>

              <p>Request Masuk</p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=1&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
                <h4>Betfage</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countBetvage; ?></i>
                </div>

              <p>Request Masuk</p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=3&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    <?=$uiHelper->endContentRow() ?>

    <?=$uiHelper->beginContentRow() ?>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-fuchsia">
            <div class="inner">
                <h4>Anthiokia</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countAnthiokia; ?></i>
                </div>

              <p>Request Masuk</p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=5&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
                <h4>Mahanaim</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countMahanaim; ?></i>
                </div>

              <p>Request Masuk </p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=8&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
                <h4>Mamre</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countMamre; ?></i>
                </div>

              <p>Request Masuk</p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=7&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
                <h4>Nazareth</h4>

                <div class="icon">
                    <i class="ion" style="color: #fff"><?php echo $countNazareth; ?></i>
                </div>

              <p>Request Masuk</p>
            </div>

            <a href="izin-by-admin-index?IzinBermalamSearch%5Bdim_asrama%5D=6&IzinBermalamSearch%5Bstatus_request_id%5D=1" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    <?=$uiHelper->endContentRow() ?>

    <?=$uiHelper->beginContentRow() ?>
        
        <?=$uiHelper->beginContentBlock(['id' => 'grid-system2',
             'header' => 'Pedoman Izin Bermalam',
              'width' => 12,
              'type' => 'danger'
              ]); ?>
              <ul>
                    <li>
                        Mahasiswa diberikan Izin Bermalam di Luar Kampus (IBL) di hari Jumat atau
                        Sabtu atau di hari lain dimana keesokan harinya tidak ada kegiatan akademik
                        atau kegiatan lainnya yang tidak mengharuskan mahasiswa berada di kampus
                        IT Del.
                    </li>
                    <li>
                        Mahasiswa yang IBL wajib menjaga nama baik IT Del di luar kampus.
                    </li>
                    <li>
                        Mahasiswa mengisi pengajuan IBL di Aplikasi CIS
                        (https://cis.del.ac.id/askm/izin-bermalam) selambatnya H-2. Dan mencetak form IBL untuk
                        ditandatangani Bapak/Ibu Asrama dan ditunjukan di Pos Satpam saat keluar
                        kampus.
                    </li>
                    <li>
                        Pada saat kembali ke kampus, mahasiswa mengumpulkan kertas IBL yang
                        telah ditandatangani oleh orangtua di Pos Satpam untuk selanjutnya
                        dikumpulkan dan direkap oleh Pembina Asrama.
                    </li>
                    <li>
                        Apabila terdapat kegiatan Badan Eksekutif Mahasiswa (BEM) yang
                        mengharuskan seluruh mahasiswa mengikuti kegiatan tersebut, maka
                        mahasiswa tidak diperbolehkan IBL.
                    </li>
                    <li>
                        Mahasiswa yang tidak mengajukan IBL sesuai ketentuan pada butir 3 (tiga)
                        tidak diizinkan untuk IBL kecuali dalam kondisi mendesak (emergency)
                        seperti sakit atau ada keluarga meninggal
                    </li>
              </ul>
        <?= $uiHelper->endContentBlock()?>

    <?=$uiHelper->endContentRow() ?>

</div>