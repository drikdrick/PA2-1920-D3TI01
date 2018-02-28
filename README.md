CIS-LITE 
==========

Merupakan framework yang digunakan untuk mengembangan aplikasi CIS yang menggunakan framework Yii 2. CIS-LITE hanya memiliki fungsi-fungsi dasar dari framework CIS (Systemx-core) yang dapat digunakan untuk membangun modul yang nantinya dapat diintegrasikan dengan mudah ke CIS.

Fungsionalitas yang didukung mencakup:
- Theme custom based on  ADMIN-LTE
- User management (list, create)
- Simple Menu management


Tujuan dari penggunan framework ini adalan untuk memberikan batasan-batasan pengimplementasian modul CIS yang akan menyederhanakan proses implementasi. Batasan dan penyederhanaan ini nantinya diharapkan akan menjadikan developer bisa focus ke proses pengembangan fungsionalitas modul yang dikembangkan.

Developer tidak perlu memikirkan hal berikut:
- Bagaimana mengatur role? tidak perlu dan tidak ada, nantinya akan dikonfigurasi pada saat integrasi
- Bagaimana mengatur tampilan? hanya menggunakan tampilan standard sesuai dengan widget-widget yang dimiliki oleh ADMIN-LTE
- Bagaimana membuat menu? tidak perlu, hanya perlu mendefinisikan sebuah array menu
- Bagimana mengatur privilege? hak akses? tidak perlu, hanya focus ke fungsionalitas saja

Proses pengaturan privilege/hak merupakan hal yang sangat penting dalam aplikasi, tetapi hal tersebut tidak menjadi perhatian utama dalam proses pengembangan modul CIS. Proses tersebut telah dilakukan secara otomatis oleh aplikasi CIS (note: fungsionalitas tersebut tidak ada dalam framework ini).

Namun, ada hal yang  sangat penting yang harus dilakukan oleh developer yaitu: sesuai dengan konsep MVC, action harus didefinisikan sampai unit terkecil dan tidak boleh ada percabangan/kondisi if-else dalam action yang menggunakan role/privilege sebagai parameter kondisi.

Contoh yang dihindari/salah:
```php
public function actionView($id){
	//check apakah user mahasiswa atau pegawai
	if(\Yii::$app->getUser()->role->name == 'mahasiswa'){
		//TODO: Tampilkan sesuatu untuk mahasiswa
	}else if(\Yii::$app->getUser()->role->name == 'admin'){
		//TODO: Tampilkan sesuatu untuk admin
	}
}
```

Contoh yang benar:
```php
/**
 * action-id: view-by-mahasiswa
 * action-desc: Menampilkan sesuatu untuk mahasiswa
 */
public function actionViewByMahasiswa($id){
	//TODO: Tampilkan sesuatu untuk mahasiswa
}

/**
 * action-id: view-by-admin
 * action-desc: Menampilkan sesuatu untuk Admin
 */
public function actionViewByAdmin($id){
	//TODO: Tampilkan sesuatu untuk admin
}
```

Untuk membarikan tampilan yang berbeda maka harus dibuat 2 menu yang berbeda untuk masing-masing action.

Q: Tetapi bagimana supaya mahasiswa tidak bisa mengakses menu admin? 
A: Tidak perlu diatur dalam proses pengembangan ini, anda cukup menyajikan fungsionalitas yang benar



TECHNICAL-GUIDE
===============
WARNING
-------

ANDA HANYA BOLEH MENG-EDIT FILE:
- file yang berada dalam modul anda
- file *-local.php

Selain file tersebut, file lain tidak boleh anda edit, terutama file composer.json. dengan kata lain, anda tidak boleh menambahkan extension menggunakan composer. Hal ini akan menimbulkan konflik pada saat integrasi aplikasi.

Q: Bagaimana jika saya ingin menggunakakan library javascript tertentu?
A: Tambahkan sebagai ASSET di modul anda, silahkan lihat contoh modul yang sudah ada (xdev).

REQUIREMENTS
------------

Versi minimum php yang didukung adalah 5.6 tetapi anda diharuskan menggunakan PHP versi >= 7.1


INSTALLATION
------------

1. Clone proyek dari gitlab
2. Siapkan database CIS dengan menggunakan struktur yang telah diberikan (database hanya memiliki tabel kosong)
2. Ikuti panduan GETTING STARTED yii dibawah (panduan Yii 2)
3. login menggunakan user: root, password:root

GETTING STARTED
---------------

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for backend `/path/to/yii-application/backend/web/` and using the URL `http://backend/`

MASALAH?
--------

Jika ada masalah, silahkan buat create sebagai issue di proyek gitlab ini. TIM SDI tidak melayani pertanyaan pribadi. Tujuaanya supaya pertanyaan/solusi yang ada bisa digunakan oleh orang lain yang mungkin memiliki masalah yang sama.

