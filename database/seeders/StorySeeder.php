<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Minangkabau, Legenda, Jawa, Betawi, Jawa Tengah, Jawa Barat, Fabel, Hikayat,
        Story::create([
            'title' => "Jaka Tarub",
            "thumbnail" => "/assets/stories/jakatarub.png",
            "route" => "/story/jaka-tarub",
            "description" => "Legenda Jaka Tarub adalah salah satu cerita rakyat yang diabadikan dalam naskah populer Sastra Jawa Baru, Babad Tanah Jawi.\n\n" .
                             "Kisah ini berputar pada kehidupan tokoh utama yang bernama Jaka Tarub (\"pemuda dari Tarub\"). Setelah dewasa ia digelari Ki Ageng Tarub. Ki Ageng Tarub adalah tokoh yang dianggap sebagai leluhur dinasti Mataram, dinasti yang menguasai politik tanah Jawa - sebagian atau seluruhnya - sejak abad ke-17 hingga sekarang. Menurut sumber masyarakat di desa Widodaren, Gerih, Ngawi, peristiwa ini terjadi di desa tersebut.",
            "categories" => ["Jawa", "Jawa Tengah"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);

        Story::create([
            'title' => "Kancil dan Mentimun",
            "thumbnail" => "/assets/stories/kancildantimun.png",
            "route" => "/story/kancil-dan-mentimun",
            "description" => "Si Kancil yang cerdik selalu dapat lolos dari bahaya, namun pada Dongeng cerita si kancil mencuri timun kali ini si Kancil berada dalam kondisi yang sangat menghawatirkan. Mampukah di kembali lolos dari bahaya seperti pada cerita si kancil dan buaya ataukah si Kancil akan mengalami nasib yang naas. Untuk lebih jelas nasib hewan cerdik ini mari kita ikuti bersama sama fabel cerita si kancil yang cerdik mencuri mentimun.",
            "categories" => ["Fabel"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);

        Story::create([
            'title' => "Keong Emas",
            "thumbnail" => "/assets/stories/keongmas.png",
            "route" => "/story/keong-emas",
            "description" => "Keong Emas adalah dongeng Jawa terkenal tentang seorang putri yang secara ajaib berubah dengan cangkang siput emas. Dongeng ini adalah bagian dari Panji Jawa yang diceritakan secara turun-temurun tentang pangeran Panji Asmoro Bangun (dikenal sebagai Raden Inu Kertapati) dan permaisurinya, puti Dewi Sekartaji (dikenal sebagai Dewi Chandra Kirana).",
            "categories" => ["Jawa", "Legenda"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);

        Story::create([
            'title' => "Lutung Kasarung",
            "thumbnail" => "/assets/stories/lutungkasarung.png",
            "route" => "/story/lutung-kasarung",
            "description" => "Lutung Kasarung adalah cerita rakyat Sunda dari Jawa Barat, Indonesia. Bertempat di Kerajaan Pasir Batang, film ini menceritakan kisah lutung ajaib (sejenis monyet hitam) yang membantu seorang putri cantik, Purbasari Ayuwangi, ketika kakak perempuannya berusaha merampas statusnya sebagai putri mahkota. Lutung Kasarung dalam bahasa Sunda yang secara harfiah berarti \"Kera yang Hilang\", berasal dari syair Sunda kuno.",
            "categories" => ["Jawa Tengah", "Fabel"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);

        Story::create([
            'title' => "Malin Kundang",
            "thumbnail" => "/assets/stories/malinkundang.png",
            "route" => "/story/malin-kundang",
            "description" => "Malin Kundang, juga disebut Si Tanggang dan Nahkoda Manis, adalah bargian dari dongeng Asian Tenggara yang mengisahkan tentang hukuman seorang anak yang tidak bersyukur. Seorang pelaut dari keluarga miskin, Sang Protagonis menyelinap ke kapal dagang, akhirnya menjadi kaya, menikahi seorang putri, dan memperoleh galleon sendiri. Sekembalinya ke desa asalnya, dia malu dengan masa lalunya yang miskis dan menolak untuk mengakui ibunya yang sudah lanjut usia. Dengan amarah, ibunya mengutuknya, dan ketika dia berlayar, dia dan kapalnya berubah menjadi batu.",
            "categories" => ["Legenda", "Minangkabau"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);

        Story::create([
            'title' => "Si Buta dari Gua Hantu",
            "thumbnail" => "/assets/stories/sibutadariguahantu.png",
            "route" => "/story/si-buta-dari-gua-hantu",
            "description" => "Si Buta Dari Gua Hantu adalah karakter utama dalam serial cerita silat yang diciptakan oleh komikus Ganes TH dari Indonesia pada tahun 1960-an. Komik ini pertama kali terbit pada tahun 1967 dan dicetak ulang kembali pada tahun 2005. Komik ini adalah salah satu komik silat pertama karya komikus Indonesia yang telah memopulerkan cerita silat khas nusantara. Komik ini begitu populer sehingga diadaptasi menjadi sebuah film layar lebar bergenre film laga pada tahun 1970 dengan judul yang sama.\n\n",
            "categories" => ["Legenda", "Jagoan"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);

        Story::create([
            'title' => "Si Pitung",
            "thumbnail" => "/assets/stories/sipitung.png",
            "route" => "/story/si-pitung",
            "description" => "Si Pitung lahir pada tahun 1866 di kampung Pengumben, sebuah permukiman kumuh di Rawabelong, dekat Stasiun Palmerah sekarang ini. Putra keempat pasangan Bang Piung dan Mbak Pinah ini bernama asli Salihoen. Menurut riwayat lisan, julukan \"Si Pitung\" berasal dari frasa Jawa \"pituan pitulung\" yang berarti \"tujuh sekawan tolong-menolong\". Semasa kanak-kanak, Salihoen berguru di pesantren Hadji Naipin, tempat ia diajari mengaji, dilatih pencak silat, dan dibiasakan untuk selalu waspada terhadap keadaan di sekitarnya.",
            "categories" => ["Jagoan", "Betawi", "Legenda"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);

        Story::create([
            'title' => "Timun Emas",
            "thumbnail" => "/assets/stories/timunmas.png",
            "route" => "/story/timun-emas",
            "description" => "Timun Mas atau Timun Emas (Jawa: \"mentimun emas\"). Adalah cerita rakyat Jawa menceritakan kisah seorang gadis pemberani yang mencoba untuk bertahan dan melarikan diri dari raksasa hijau jahat yang mencoba untuk menangkap dan memakannya.",
            "categories" => ["Legenda", "Jawa"],
            "rating" => 0,
            "total_views" => rand(0, 200),
            "total_favorites" => 0,
            "total_pages" => 0,
        ]);
    }
}
