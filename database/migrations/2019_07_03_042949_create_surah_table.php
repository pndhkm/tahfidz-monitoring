<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_surah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surah_name');
            $table->integer('total_ayat');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        // Data yang ingin dimasukkan
        $data = [
            [1, 'Al-Fatihah', 7],
            [2, 'Al-Baqarah', 286],
            [3, 'Ali-Imran', 200],
            [4, 'An-Nisa’', 176],
            [5, 'Al-Ma’idah', 120],
            [6, 'Al-An’am', 165],
            [7, 'Al-A’raf', 206],
            [8, 'Al-Anfal', 75],
            [9, 'At-Taubah', 129],
            [10, 'Yunus', 109],
            [11, 'Hud', 123],
            [12, 'Yusuf', 111],
            [13, 'Ar-Ra’d', 43],
            [14, 'Ibrahim', 52],
            [15, 'Al-Hijr', 99],
            [16, 'An-Nahl', 128],
            [17, 'Al-Isra’', 111],
            [18, 'Al-Kahfi', 110],
            [19, 'Maryam', 98],
            [20, 'Ta Ha', 135],
            [21, 'Al-Anbiya’', 112],
            [22, 'Al-Hajj', 78],
            [23, 'Al-Mu’minun', 118],
            [24, 'An-Nur', 64],
            [25, 'Al-Furqan', 77],
            [26, 'Asy-Syu’ara’', 227],
            [27, 'An-Naml', 93],
            [28, 'Al-Qasas', 88],
            [29, 'Al-Ankabut', 69],
            [30, 'Ar-Ruu', 60],
            [31, 'Luqman', 34],
            [32, 'As-Sajdah', 30],
            [33, 'Al-Ahzab', 73],
            [34, 'Saba’', 54],
            [35, 'Fatir', 45],
            [36, 'Ya sin', 83],
            [37, 'Ash-Shaaffat', 182],
            [38, 'Shad', 88],
            [39, 'Az-Zumar', 75],
            [40, 'Al-Mu’min', 85],
            [41, 'Fushshilat', 54],
            [42, 'Asy-Syura', 53],
            [43, 'Az-Zukhruf', 89],
            [44, 'Ad-Dukhan', 59],
            [45, 'Al-Jaatsiyah', 37],
            [46, 'Al-Ahqaf', 35],
            [47, 'Muhammad', 38],
            [48, 'Al-Fath', 29],
            [49, 'Al-Hujurat', 18],
            [50, 'Qaaf', 45],
            [51, 'Adz-dzariyat', 60],
            [52, 'Ath-Thuur', 49],
            [53, 'An-Najm', 62],
            [54, 'Al-Qamar', 55],
            [55, 'Ar-Rahman', 78],
            [56, 'Al-Waqi’ah', 96],
            [57, 'Al-Hadid', 29],
            [58, 'Al-Mujadilah', 22],
            [59, 'Al-Hasyr', 24],
            [60, 'Al-Mumtahanah', 13],
            [61, 'Ash-shaf', 14],
            [62, 'Al-Jumu’ah', 11],
            [63, 'Al-Munafiqun', 11],
            [64, 'At-taghabun', 18],
            [65, 'Ath-Thalaq', 12],
            [66, 'At-Tahrim', 12],
            [67, 'Al-Mulk', 30],
            [68, 'Al-Qalam', 52],
            [69, 'Al-Haqqah', 52],
            [70, 'Al-Ma’arij', 44],
            [71, 'Nuh', 28],
            [72, 'Al-Jin', 28],
            [73, 'Al-Muzammil', 20],
            [74, 'Al-Muddatstsir', 56],
            [75, 'Al-Qiyamah', 40],
            [76, 'Al-Insan', 31],
            [77, 'Al-Mursalat', 50],
            [78, 'An-Naba’', 40],
            [79, 'An-Nazi’at', 46],
            [80, '‘Abasa', 42],
            [81, 'At-Takwir', 29],
            [82, 'Al-Infithar', 19],
            [83, 'Al-Muthaffifin', 36],
            [84, 'Al-Insyiqaq', 25],
            [85, 'Al-Buruj', 22],
            [86, 'Ath-Thariq', 17],
            [87, 'Al-A’laa', 19],
            [88, 'Al-Ghasyiyah', 26],
            [89, 'Al-Fajr', 30],
            [90, 'Al-Balad', 20],
            [91, 'Asy-Syams', 15],
            [92, 'Al-Lail', 21],
            [93, 'Adh-Dhuha', 11],
            [94, 'Al-Insyirah', 8],
            [95, 'At-Tin', 8],
            [96, 'Al-‘Alaq', 19],
            [97, 'Al-Qadr', 5],
            [98, 'Al-Bayyinah', 8],
            [99, 'Al-Zalzalah', 8],
            [100, 'Al-‘Adiyat', 11],
            [101, 'Al-Qari’ah', 11],
            [102, 'At-Takatsur', 8],
            [103, 'Al-‘Ashr', 3],
            [104, 'Al-Humazah', 9],
            [105, 'Al-Fil', 5],
            [106, 'Quraysh', 4],
            [107, 'Al-Ma’un', 7],
            [108, 'Al-Kautsar', 3],
            [109, 'Al-Kafirun', 6],
            [110, 'An-Nashr', 3],
            [111, 'Al-Lahab', 5],
            [112, 'Al-Ikhlas', 4],
            [113, 'Al-Falaq', 5],
            [114, 'An-Nas', 6]
        ];

        // Memasukkan data ke dalam tabel
        foreach ($data as $row) {
            DB::table('tbl_surah')->insert([
                'id' => $row[0],
                'surah_name' => $row[1],
                'total_ayat' => $row[2],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_surah');
    }
}
