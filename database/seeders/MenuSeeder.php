<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // ==========================================
            // 1. MENU PAKETAN KELUARGA (ID Kategori: 1)
            // ==========================================
            [
                'name' => 'Paket Nyeruit 3-5 pax',
                'menu_category_id' => 1,
                'price' => 230000,
                'description' => 'Nasi, Ikan Mujair, Sambal, Lalap, Tahu, Tempe, Tempoyak, Ikan Asin, Teh'
            ],
            [
                'name' => 'Paket Ngeriung (Liwetan) 3-5 pax',
                'menu_category_id' => 1,
                'price' => 300000,
                'description' => 'Nasi Liwet, Ayam Goreng Pejantan, Tempe, Tahu, Sambal, Lalap, Jukut Goreng, Ikan Asin, Kerupuk, Teh'
            ],
            [
                'name' => 'Paket Bebek Tepi Empang 3-5 pax',
                'menu_category_id' => 1,
                'price' => 320000,
                'description' => 'Nasi Daun Jeruk, Bebek, Tempe, Tahu, Sambal, Lalap, Jukut Goreng, Teh'
            ],
            [
                'name' => 'Paket Seafood 3-5 Pax',
                'menu_category_id' => 1,
                'price' => 350000,
                'description' => 'Nasi Putih/Daun Jeruk, Ikan Kuwe, Kerang Hijau, Kerang Dara, 2 macam sambal, Kangkung Balacan, Buah, Teh'
            ],

            // ==========================================
            // 2. MENU PAKET PERORANG (ID Kategori: 2)
            // ==========================================
            [
                'name' => 'Paket Rice Bowl Ayam',
                'menu_category_id' => 2,
                'price' => 30435,
                'description' => 'Pilihan saus: Asam Manis / Pedas Manis / Sambal Matah'
            ],
            [
                'name' => 'Paket Rice Bowl Gurame',
                'menu_category_id' => 2,
                'price' => 30435,
                'description' => 'Pilihan saus: Asam Manis / Saus Mangga / Sambal Matah'
            ],
            [
                'name' => 'Paket Kids Meal Fried Chicken',
                'menu_category_id' => 2,
                'price' => 30435,
                'description' => 'Nasi, Fried Chicken, Susu'
            ],

            // ==========================================
            // 3. MENU SPESIAL PAKET HEMAT (ID Kategori: 3)
            // ==========================================
            ['name' => 'Paket Nasi Liwet (Hemat)', 'menu_category_id' => 3, 'price' => 48000, 'description' => 'Nasi Liwet, Tahu/Tempe, Ikan Asin, Jukut Goreng, Lalapan, Sambal'],
            ['name' => 'Paket Nasi Timbel (Hemat)', 'menu_category_id' => 3, 'price' => 45000, 'description' => 'Nasi Timbel, Sayur Asem, Tahu/Tempe, Ikan Asin, Lalapan, Sambal'],
            ['name' => 'Paket Pecak Mujair (Hemat)', 'menu_category_id' => 3, 'price' => 35000, 'description' => 'Nasi, Ikan Mujair, Kuah Pecak, Bakwan, Lalapan, Sambal'],
            ['name' => 'Paket Bebek Pinggir Empang (Hemat)', 'menu_category_id' => 3, 'price' => 50000, 'description' => 'Nasi Liwet, Jukut Goreng, Tahu/Tempe, Lalapan, Sambal'],

            // ==========================================
            // 4. SEAFOOD - IKAN LAUT & KEPITING (ID Kategori: 4)
            // ==========================================
            ['name' => 'Kakap Merah (/ons)', 'menu_category_id' => 4, 'price' => 25217, 'description' => 'Pilihan olahan: Bakar / Goreng. Pilihan sambal: Sambal Kecap, Sambal Matah, Sambal Rica-Rica, Sambal Dabu-Dabu, Saus Asam Manis'],
            ['name' => 'Bawal Laut (/ons)', 'menu_category_id' => 4, 'price' => 24348, 'description' => 'Pilihan olahan: Bakar / Goreng. Pilihan sambal: Sambal Kecap, Sambal Matah, Sambal Rica-Rica, Sambal Dabu-Dabu, Saus Asam Manis'],
            ['name' => 'Ikan Kuwe (/ons)', 'menu_category_id' => 4, 'price' => 22609, 'description' => 'Pilihan olahan: Bakar / Goreng. Pilihan sambal: Sambal Kecap, Sambal Matah, Sambal Rica-Rica, Sambal Dabu-Dabu, Saus Asam Manis'],
            ['name' => 'Kerang Hijau (/porsi)', 'menu_category_id' => 4, 'price' => 30435, 'description' => 'Pilihan saus: Asam Manis, Saus Lada Hitam, Saus Mentega'],
            ['name' => 'Kerang Dara (/porsi)', 'menu_category_id' => 4, 'price' => 34783, 'description' => 'Pilihan saus: Asam Manis, Saus Lada Hitam, Saus Mentega'],
            ['name' => 'Kepiting (/ekor)', 'menu_category_id' => 4, 'price' => 150000, 'description' => 'Pilihan saus: Asam Manis, Saus Lada Hitam, Saus Mentega'],
            ['name' => 'Udang Goreng Tepung', 'menu_category_id' => 4, 'price' => 52174, 'description' => 'Udang segar digoreng dengan tepung krispi'],
            ['name' => 'Udang Mayonaise', 'menu_category_id' => 4, 'price' => 53913, 'description' => 'Udang krispi dengan baluran saus mayonaise gurih'],
            ['name' => 'Udang Saus Mentega / Padang', 'menu_category_id' => 4, 'price' => 56552, 'description' => 'Udang dimasak dengan pilihan Saus Mentega atau Saus Padang'],
            ['name' => 'Udang Bakar', 'menu_category_id' => 4, 'price' => 70435, 'description' => 'Udang bakar bumbu khas Lubana'],
            ['name' => 'Cumi Goreng Tepung', 'menu_category_id' => 4, 'price' => 52174, 'description' => 'Cumi empuk digoreng dengan tepung bumbu'],
            ['name' => 'Cumi Saus Mentega / Padang', 'menu_category_id' => 4, 'price' => 56552, 'description' => 'Cumi dimasak dengan pilihan Saus Mentega atau Saus Padang'],

            // ==========================================
            // 5. IKAN AIR TAWAR (ID Kategori: 5)
            // ==========================================
            ['name' => 'Gurame (/ons)', 'menu_category_id' => 5, 'price' => 19130, 'description' => 'Pilihan olahan: Goreng / Bakar / Pecak / Rica-Rica'],
            ['name' => 'Nila Merah (/ons)', 'menu_category_id' => 5, 'price' => 14783, 'description' => 'Pilihan olahan: Goreng / Bakar / Pecak / Rica-Rica'],
            ['name' => 'Ikan Emas (/ons)', 'menu_category_id' => 5, 'price' => 13913, 'description' => 'Pilihan olahan: Goreng / Bakar / Pecak / Rica-Rica'],
            ['name' => 'Gurame Asam Manis / Saus Mangga', 'menu_category_id' => 5, 'price' => 21739, 'description' => 'Menu rekomendasi khas Lubana Sengkol dengan potongan mangga segar'],

            // ==========================================
            // 6. MENU SATUAN KHAS & COBEK (ID Kategori: 6)
            // ==========================================
            ['name' => 'Pindang Patin Nanas (/ons)', 'menu_category_id' => 6, 'price' => 14783, 'description' => 'Khas Lampung, kuah segar dengan nanas'],
            ['name' => 'Gurame Seruit (/ons)', 'menu_category_id' => 6, 'price' => 19130, 'description' => 'Khas Lampung, olahan sambal seruit'],
            ['name' => 'Nila Merah Seruit (/ons)', 'menu_category_id' => 6, 'price' => 14783, 'description' => 'Khas Lampung dengan sambal seruit'],
            ['name' => 'Ayam Bakar / Goreng Kremes Pejantan (/ekor)', 'menu_category_id' => 6, 'price' => 100000, 'description' => 'Khas Sunda, satu ekor ayam pejantan'],
            ['name' => 'Cobek Ayam Pejantan (Bakar/Goreng)', 'menu_category_id' => 6, 'price' => 30000, 'description' => 'Disajikan di atas cobek tanah liat'],
            ['name' => 'Cobek Bebek (Bakar/Goreng)', 'menu_category_id' => 6, 'price' => 45217, 'description' => 'Daging bebek empuk bumbu cobek'],
            ['name' => 'Cobek Iga (Bakar/Goreng)', 'menu_category_id' => 6, 'price' => 65000, 'description' => 'Iga sapi bakar/goreng dengan sambal cobek hangat'],
            ['name' => 'Cobek Kulit', 'menu_category_id' => 6, 'price' => 18000, 'description' => 'Kulit ayam krispi di atas cobek'],
            ['name' => 'Cobek Usus', 'menu_category_id' => 6, 'price' => 18000, 'description' => 'Usus goreng bumbu cobek'],
            ['name' => 'Cobek Ati Ampela', 'menu_category_id' => 6, 'price' => 18000, 'description' => 'Ati ampela goreng di atas cobek'],

            // ==========================================
            // 7. AYAM & LAUK SATUAN (ID Kategori: 7)
            // ==========================================
            ['name' => 'Ayam Bakar / Goreng Negeri (/ptg)', 'menu_category_id' => 7, 'price' => 20000, 'description' => 'Per potong ayam negeri'],
            ['name' => 'Ayam Crispy (/ptg)', 'menu_category_id' => 7, 'price' => 13913, 'description' => 'Ayam goreng tepung renyah satuan'],
            ['name' => 'Ayam Crispy Geprek (/ptg)', 'menu_category_id' => 7, 'price' => 21739, 'description' => 'Ayam crispy ditumbuk dengan sambal korek pedas'],
            ['name' => 'Ayam Mentega (/porsi)', 'menu_category_id' => 7, 'price' => 43478, 'description' => 'Potongan ayam dengan saus mentega manis gurih'],
            ['name' => 'Ikan Asin (/porsi)', 'menu_category_id' => 7, 'price' => 14783, 'description' => 'Lauk pendamping pelengkap nasi'],
            ['name' => 'Tempe Goreng (/6 pcs)', 'menu_category_id' => 7, 'price' => 13044, 'description' => 'Satu porsi isi 6 potong tempe goreng'],
            ['name' => 'Tahu Goreng (/3 pcs)', 'menu_category_id' => 7, 'price' => 13044, 'description' => 'Satu porsi isi 3 potong tahu goreng'],

            // ==========================================
            // 8. SAYURAN (ID Kategori: 8)
            // ==========================================
            ['name' => 'Kangkung Cah Balacan', 'menu_category_id' => 8, 'price' => 23479, 'description' => 'Tumis kangkung dengan terasi balacan'],
            ['name' => 'Kangkung Cah Tauco', 'menu_category_id' => 8, 'price' => 21739, 'description' => 'Tumis kangkung bumbu tauco gurih'],
            ['name' => 'Kangkung Plecing', 'menu_category_id' => 8, 'price' => 21739, 'description' => 'Kangkung rebus dengan sambal plecing pedas'],
            ['name' => 'Genjer Cah Balacan', 'menu_category_id' => 8, 'price' => 26087, 'description' => 'Tumis sayur genjer segar bumbu balacan'],
            ['name' => 'Toge Cah Ikan Asin', 'menu_category_id' => 8, 'price' => 30435, 'description' => 'Tumis tauge renyah dengan gurihnya potongan ikan asin'],
            ['name' => 'Capcay Ayam', 'menu_category_id' => 8, 'price' => 30435, 'description' => 'Aneka sayuran tumis dengan potongan daging ayam'],
            ['name' => 'Capcay Seafood', 'menu_category_id' => 8, 'price' => 37392, 'description' => 'Aneka sayuran dengan tambahan udang dan cumi'],
            ['name' => 'Sapo Tahu Spesial', 'menu_category_id' => 8, 'price' => 55000, 'description' => 'Tahu sutra jepang dimasak kuah kental hangat'],
            ['name' => 'Soto Ayam', 'menu_category_id' => 8, 'price' => 30435, 'description' => 'Soto kuah kuning bening tradisional'],
            ['name' => 'Sop Ayam', 'menu_category_id' => 8, 'price' => 30435, 'description' => 'Sop sayuran bening dengan potongan ayam'],
            ['name' => 'Sop Bakso', 'menu_category_id' => 8, 'price' => 27826, 'description' => 'Sop bening dengan bakso sapi kenyal'],
            ['name' => 'Sayur Asem', 'menu_category_id' => 8, 'price' => 20870, 'description' => 'Sayur asem segar tradisional'],
            ['name' => 'Karedok', 'menu_category_id' => 8, 'price' => 20870, 'description' => 'Sayuran mentah segar dengan siraman bumbu kacang'],

            // ==========================================
            // 9. NASI & MIE (ID Kategori: 9)
            // ==========================================
            ['name' => 'Nasi Putih', 'menu_category_id' => 9, 'price' => 8696, 'description' => 'Satu porsi nasi putih hangat'],
            ['name' => 'Nasi Liwet', 'menu_category_id' => 9, 'price' => 12174, 'description' => 'Nasi gurih rempah khas sunda'],
            ['name' => 'Nasi Daun Jeruk', 'menu_category_id' => 9, 'price' => 12174, 'description' => 'Nasi hangat dengan aroma irisan daun jeruk'],
            ['name' => 'Nasi Goreng Spesial', 'menu_category_id' => 9, 'price' => 39130, 'description' => 'Nasi goreng bumbu lengkap khas restoran'],
            ['name' => 'Nasi Goreng Seafood', 'menu_category_id' => 9, 'price' => 34783, 'description' => 'Nasi goreng dengan isian seafood segar'],
            ['name' => 'Mie Goreng Spesial', 'menu_category_id' => 9, 'price' => 34783, 'description' => 'Mie goreng bumbu racikan spesial'],
            ['name' => 'Mie Kuah Spesial', 'menu_category_id' => 9, 'price' => 34783, 'description' => 'Mie dengan kuah kaldu hangat yang gurih'],
            ['name' => 'Kwetiau Goreng Spesial', 'menu_category_id' => 9, 'price' => 34783, 'description' => 'Kwetiau kenyal digoreng bumbu spesial'],

            // ==========================================
            // 10. SAMBAL & PELENGKAP (ID Kategori: 10)
            // ==========================================
            ['name' => 'Sambal Rampai Khas Lubana', 'menu_category_id' => 10, 'price' => 13044, 'description' => 'Sambal mentah rampai segar yang sangat pedas'],
            ['name' => 'Sambal Tempoyak', 'menu_category_id' => 10, 'price' => 13043, 'description' => 'Sambal fermentasi durian khas Sumatra/Lampung'],
            ['name' => 'Sambal Mangga', 'menu_category_id' => 10, 'price' => 13044, 'description' => 'Sambal dengan sensasi asam segar serutan mangga muda'],
            ['name' => 'Sambal Terasi', 'menu_category_id' => 10, 'price' => 10435, 'description' => 'Sambal matang bumbu terasi bakar'],
            ['name' => 'Sambal Kecap', 'menu_category_id' => 10, 'price' => 6956, 'description' => 'Kecap manis dengan potongan cabai rawit dan bawang'],
            ['name' => 'Lalapan', 'menu_category_id' => 10, 'price' => 6956, 'description' => 'Aneka sayuran mentah segar pendamping makan'],
            ['name' => 'Jukut Goreng', 'menu_category_id' => 10, 'price' => 15000, 'description' => 'Sayuran jukut yang digoreng kering gurih'],
            ['name' => 'Pete Goreng / Bakar', 'menu_category_id' => 10, 'price' => 17391, 'description' => 'Satu papan pete diolah goreng atau bakar'],
            ['name' => 'Terong Bakar / Goreng', 'menu_category_id' => 10, 'price' => 13044, 'description' => 'Terong ungu dipotong dan dibakar/digoreng'],
            ['name' => 'Telur Dadar', 'menu_category_id' => 10, 'price' => 14783, 'description' => 'Telur dadar goreng polos'],

            // ==========================================
            // 11. SNACK & CEMILAN UTAMA (ID Kategori: 11)
            // ==========================================
            ['name' => 'Tahu Isi (/3 pcs)', 'menu_category_id' => 11, 'price' => 14783, 'description' => 'Gorengan tahu isi sayuran renyah isi 3 buah'],
            ['name' => 'Tahu Sumedang (/10 pcs)', 'menu_category_id' => 11, 'price' => 20000, 'description' => 'Satu porsi tahu sumedang goreng isi 10 buah'],
            ['name' => 'Tempe Mendoan (/3 pcs)', 'menu_category_id' => 11, 'price' => 14783, 'description' => 'Tempe mendoan lebar khas banyumas isi 3 lembar'],
            ['name' => 'Bakwan (/3 pcs)', 'menu_category_id' => 11, 'price' => 14783, 'description' => 'Bakwan sayur goreng garing isi 3 buah'],
            ['name' => 'Pisang Goreng (/6 pcs)', 'menu_category_id' => 11, 'price' => 20000, 'description' => 'Cemilan pisang goreng manis hangat isi 6 buah'],
            ['name' => 'Cireng Bumbu Rujak', 'menu_category_id' => 11, 'price' => 20000, 'description' => 'Cireng kenyal hangat disajikan dengan cocolan bumbu rujak pedas manis'],
            ['name' => 'Jamur Crispy', 'menu_category_id' => 11, 'price' => 21739, 'description' => 'Jamur tiram goreng tepung krispi garing'],
            ['name' => 'Chicken Popcorn', 'menu_category_id' => 11, 'price' => 22609, 'description' => 'Potongan ayam kecil dibalur tepung renyah'],
            ['name' => 'Singkong Keju', 'menu_category_id' => 11, 'price' => 24348, 'description' => 'Singkong goreng empuk merekah ditaburi parutan keju'],
            ['name' => 'Onion Ring', 'menu_category_id' => 11, 'price' => 21739, 'description' => 'Bawang bombay goreng tepung krispi bentuk cincin'],
            ['name' => 'Tahu Lada Garam', 'menu_category_id' => 11, 'price' => 24348, 'description' => 'Potongan tahu goreng dibumbui cabai, bawang, dan lada garam kering'],
            ['name' => 'Buah Potong Segar', 'menu_category_id' => 11, 'price' => 20000, 'description' => 'Aneka buah potong musiman yang segar'],
            ['name' => 'Rujak Buah', 'menu_category_id' => 11, 'price' => 21739, 'description' => 'Potongan buah segar dengan siraman bumbu rujak kacang pedas'],
            ['name' => 'Pisang Keren (Keju Gula Aren)', 'menu_category_id' => 11, 'price' => 24348, 'description' => 'Pisang goreng spesial dengan topping parutan keju dan saus gula aren cair'],

            // ==========================================
            // 12. JAJANAN MORO-MORO (ID Kategori: 12)
            // ==========================================
            ['name' => 'Otak Otak Bakar / porsi', 'menu_category_id' => 12, 'price' => 50000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Otak - Otak goreng / porsi', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Siomay', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Batagor', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Tahu Gejrot / porsi', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Rujak Potong / porsi', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Roti Bakar / porsi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Pisang Lumer / porsi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sosis Bakar Mini / pcs', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sosis Bakar Jumbo / pcs', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Kentang Spiral / porsi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sosis Kentang Spiral / porsi', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'French Fries / porsi', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Roti Cane / porsi', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Kebab Sapi / porsi', 'menu_category_id' => 12, 'price' => 12000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Dimsum / porsi', 'menu_category_id' => 12, 'price' => 27000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Burger / porsi', 'menu_category_id' => 12, 'price' => 22000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Cheese Burger / porsi', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Zuppa Soup / porsi', 'menu_category_id' => 12, 'price' => 21000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Zuppa Soup besar / porsi', 'menu_category_id' => 12, 'price' => 30000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Takoyaki Mix', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Harga variatif 25k/35k/45k berdasarkan jumlah isi'],
            ['name' => 'Takoyaki Octopus', 'menu_category_id' => 12, 'price' => 30000, 'description' => 'Harga variatif 30k/40k/50k berdasarkan jumlah isi'],
            ['name' => 'Jasuke / porsi', 'menu_category_id' => 12, 'price' => 23000, 'description' => 'Jagung Susu Keju Moro-Moro'],
            ['name' => 'Donat Kentang (3pcs)', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Cilok / Porsi', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sempol Ayam / Porsi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Hotdog / Porsi', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Pizza Mini', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sosis Telur Mini / pcs', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sosis Telur Jumbo', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Corndog Sosis Mozarella', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Corndog Mozarella', 'menu_category_id' => 12, 'price' => 26000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Corndog Sosis / Pcs', 'menu_category_id' => 12, 'price' => 23000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sosis Kentang', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Popcorn Aneka Rasa / porsi', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Kue cubit / Porsi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Kue Ape / Porsi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Kue Pancong / Porsi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Martabak Mini / Porsi', 'menu_category_id' => 12, 'price' => 25000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Sotong / Porsi', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Keju Aroma / Porsi', 'menu_category_id' => 12, 'price' => 15000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Risol Mayo / Ayam (3pcs)', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Cireng Isi', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Bakso Bakar', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Timus Ubi (Bola Ubi)', 'menu_category_id' => 12, 'price' => 20000, 'description' => 'Jajanan Moro-Moro'],
            ['name' => 'Es Cendol Lubana / Pcs', 'menu_category_id' => 12, 'price' => 12000, 'description' => 'Jajanan Moro-Moro'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
