<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Profil Matching</h1>

        <p class="lead">Sistem Pendukung Keputusan Identifikasi Awal Gejala COVID-19.</p>
        <br>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/pasien']) ?>">Mulai Pemeriksaan</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">

                <p>
                    Pendemi COVID-19 sampai saat ini belum mereda, Wabah ini telah meluas hampir di seluruh negara didunia, gejala awal penderita yang disebabkan oleh gangguan pernapasan akut coronavirus 2 (SARS-CoV-2).
                    Perlu sebuah metode untuk dapat menentukan gejala awal dari penderita COVID-19 apakah itu gejala COVID-19 atau demam biasa.
                    Penelitian ini dilakukan melalui pengolahan data penderita COVID-19 yang bersumber dari Puskemas VI Koto Selatan, berdasarkan dari hasil Swab dan identifikasi gejala COVID-19 pada pasien yang dilakukan oleh petugas kesehatan yang bertugas pada Puskesmas VI Koto Selatan, selanjutnya data diolah menggunakan Software Sistem Pendukung Keputusan  untuk mengetahui gejala awal COVID-19. Metode yang digunakan untuk menentukan gejala awal pada penderita COVID-19 adalah metode Profile Matching.
                    Hasil dari pengujian Sistem Pendukung Keputusan yang telah dilakukan dalam mengidentifikasi gejala awal penderita COVID-19 di Puskemas VI Koto Selatan keseluruhan dapat membantu petugas Kesehatan seperti Dokter, Perawat, dan Bidan dalam menentukan gejala pada penderita COVID-19.
                </p>

                <p><a class="btn btn-outline-secondary d-none" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
