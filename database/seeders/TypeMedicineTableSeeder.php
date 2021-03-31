<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class TypeMedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        \DB::table('type_medicines')->insert(

            [
                [
                    'name' => 'Abacavir',               
                ],
                [
                    'name' => 'Abacavir / Lamivudina',               
                ],
                [
                    'name' => 'Abacavir / Lamivudina / Zidovudina', 
                ],
                [
                    'name' => 'ABC/3TC',  
                ],
                [
                    'name' => 'Aciclovir', 
                ],
                [
                    'name' => 'Albendazol', 
                ],
                [
                    'name' => 'AMD-070',
                ],
                [
                    'name' => 'Amdoxovir',  
                ],
                [
                    'name' => 'Amlodipina',  
                ],
                [
                    'name' => 'Anfotericina B', 
                ],
                [
                    'name' => 'Aspirina',  
                ],
                [
                    'name' => 'Aptivus',  
                ],
                [
                    'name' => 'Astodrímero',  
                ],
                [
                    'name' => 'Atazanavir',
                ],
                [
                    'name' => 'Atorvastatina',
                ],
                [
                    'name' => 'Atripla', 
                ],
                [
                    'name' => 'Azitromicina',
                ],
                [
                    'name' => 'BMS-663068',
                ],
                [
                    'name' => 'BMS-986001',
                ],
                [
                    'name' => 'Boceprevir',  
                ],
                [
                    'name' => 'Carbopol 974P',
                ],
                [
                    'name' => 'Carragaén', 
                ],
                [
                    'name' => 'Carragenina lambda',
                ],
                [
                    'name' => 'Cenicriviroc',
                ],
                [
                    'name' => 'Ciprofloxacina',
                ],
                [
                    'name' => 'Claritromicina',  
                ],
                [
                    'name' => 'Clindamicina',
                ],
                [
                    'name' => 'Clorhidrato de etambutol', 
                ],
                [
                    'name' => 'Clorhidrato de moxifloxacina',
                ],
                [
                    'name' => 'Clorhidrato de rilpivirina',
                ],
                [
                    'name' => 'Clorhidrato de valaciclovir',
                ],
                [
                    'name' => 'Clorhidrato de valganciclovir',  
                ],
                [
                    'name' => 'Clotrimazol',
                ],
                [
                    'name' => 'Combivir', 
                ],
                [
                    'name' => 'Complera',
                ],
                [
                    'name' => 'Crixivan',
                ],
                [
                    'name' => 'Cytovene IV',
                ],
                [
                    'name' => 'Dapivirina',  
                ],
                [
                    'name' => 'Darunavir',
                ],
                [
                    'name' => 'Delavirdina', 
                ],
                [
                    'name' => 'Dexelvucitabina',
                ],
                [
                    'name' => 'Didanosina',
                ],
                [
                    'name' => 'Dolutegravir',
                ],
                [
                    'name' => 'Doxiciclina',
                ],
                [
                    'name' => 'Edurant',  
                ],
                [
                    'name' => 'Efavirenz',
                ],
                [
                    'name' => 'Efavirenz / Emtricitabina / Fumarato de Disoproxilo de Tenofovir', 
                ],
                [
                    'name' => 'Efavirenz / Emtricitabina/ Tenofovir',
                ],
                [
                    'name' => 'Efavirenz / Emtricitabina/ Tenofovir DF',
                ],
                [
                    'name' => 'EFV / FTC/ TDF',
                ],
                [
                    'name' => 'Elvitegravir',  
                ],
                [
                    'name' => 'Elvitegravir / Cobicistat / Emtricitabina / Fumarato de Disoproxilo de Tenofovir',
                ],
                [
                    'name' => 'Elvucitabina', 
                ],
                [
                    'name' => 'Emtricitabina',
                ],
                [
                    'name' => 'Emtricitabina / Clorhidrato de Rilpivirina / Fumarato de Disoproxilo de Tenofovir',
                ],
                [
                    'name' => 'Emtricitabina / Fumarato de Disoproxilo de Tenofovir',
                ],
                [
                    'name' => 'Emtricitabina / Rilpivirina / Fumarato de Disoproxilo de Tenofovir',  
                ],
                [
                    'name' => 'Emtricitabina / Rilpivirina / Tenofovir',
                ],
                [
                    'name' => 'Emtriva', 
                ],
                [
                    'name' => 'Enfuvirtida',
                ],
                [
                    'name' => 'Engerix-B',
                ],
                [
                    'name' => 'Epivir',
                ],
                [
                    'name' => 'Epzicom',  
                ],
                [
                    'name' => 'Eritromicina',
                ],
                [
                    'name' => 'Espectinomicina',
                ],
                [
                    'name' => 'Estavudina',
                ],
                [
                    'name' => 'Etravirina', 
                ],
                [
                    'name' => 'EVG / COBI / FTC / TDF',
                ],
                [
                    'name' => 'Famciclovir',
                ],
                [
                    'name' => 'Flucitosina',
                ],
                [
                    'name' => 'Fluconazol',  
                ],
                [
                    'name' => 'Fosamprenavir',
                ],
                [
                    'name' => 'Foscarnet sódico', 
                ],
                [
                    'name' => 'Fosfato de primaquina',
                ],
                [
                    'name' => 'FTC / RPV / TDF',
                ],
                [
                    'name' => 'Fumarato de Disoproxilo de Tenofovir',
                ],
                [
                    'name' => 'Fuzeon',
                ],
                [
                    'name' => 'Ganciclovir', 
                ],
                [
                    'name' => 'Ganciclovir sódico',
                ],
                [
                    'name' => 'Gentamicina',
                ],
                [
                    'name' => 'Ibalizumab',
                ],
                [
                    'name' => 'Ibuprofeno',
                ],
                [
                    'name' => 'Imiquimod',
                ],
                [
                    'name' => 'INCB-9471',
                ],
                [
                    'name' => 'Indinavir', 
                ],
                [
                    'name' => 'Intelence',
                ],
                [
                    'name' => 'Interferón pegilado alfa-2a',
                ],
                [
                    'name' => 'Interferón pegilado alfa-2b',
                ],
                [
                    'name' => 'Invirase',
                ],
                [
                    'name' => 'Isentress', 
                ],
                [
                    'name' => 'Isoniazida',
                ],
                [
                    'name' => 'Itraconazol',
                ],
                [
                    'name' => 'Kaletra',
                ],
                [
                    'name' => 'Lamivudina',
                ],
                [
                    'name' => 'Lamivudina / Zidovudina', 
                ],
                [
                    'name' => 'Lansoprazol',
                ],
                [
                    'name' => 'Lersivirina',
                ],
                [
                    'name' => 'Levofloxacina',
                ],
                [
                    'name' => 'Lexiva',
                ],
                [
                    'name' => 'Lexotiroxina sódica',
                ],
                [
                    'name' => 'Lopinavir / Ritonavir',
                ],
                [
                    'name' => 'Maraviroc', 
                ],
                [
                    'name' => 'Metronidazol', 
                ],
                [
                    'name' => 'Miconazol',
                ],
                [
                    'name' => 'MPC-4326',
                ],
                [
                    'name' => 'Nelfinavir',
                ],
                [
                    'name' => 'Nevirapina',
                ],
                [
                    'name' => 'Nitrato de butoconazol', 
                ],
                [
                    'name' => 'Nitrofurantoína', 
                ],
                [
                    'name' => 'Norvir',
                ],
                [
                    'name' => 'Omeprazol',
                ],
                [
                    'name' => 'Paracetamol',
                ],
                [
                    'name' => 'PC-515',
                ],
                [
                    'name' => 'Pirazinamida',
                ],
                [
                    'name' => 'Pirimetamina',
                ],
                [
                    'name' => 'Potasio de Raltegravir', 
                ],
                [
                    'name' => 'Prezista',
                ],
                [
                    'name' => 'PRO-140',
                ],
                [
                    'name' => 'PRO-2000',
                ],
                [
                    'name' => 'Profármaco del BMS-626529',
                ],
                [
                    'name' => 'QUAD', 
                ],
                [
                    'name' => 'Racivir',
                ],
                [
                    'name' => 'RAL',
                ],
                [
                    'name' => 'Raltegravir',
                ],
                [
                    'name' => 'Ramipril',
                ],
                [
                    'name' => 'Recombivax HB',
                ],
                [
                    'name' => 'Rescriptor', 
                ],
                [
                    'name' => 'Retrovir',
                ],
                [
                    'name' => 'Reyataz',
                ],
                [
                    'name' => 'Ribarivina',
                ],
                [
                    'name' => 'Rifabutina',
                ],
                [
                    'name' => 'Rilpivirina', 
                ],
                [
                    'name' => 'Ritonavir',
                ],
                [
                    'name' => 'RPV',
                ],
                [
                    'name' => 'Salbutamol',
                ],
                [
                    'name' => 'Saquinavir',
                ],
                [
                    'name' => 'Selzentry',
                ],
                [
                    'name' => 'Simvastatina',
                ],
                [
                    'name' => 'S/GSK1265744', 
                ],
                [
                    'name' => 'SPL-7013',
                ],
                [
                    'name' => 'Stribild',
                ],
                [
                    'name' => 'Sulfadiazina',
                ],
                [
                    'name' => 'Sulfametoxazol - Trimetoprima',
                ],
                [
                    'name' => 'Sulfato de Abacavir / Lamivudina', 
                ],
                [
                    'name' => 'Sustiva',
                ],
                [
                    'name' => 'Telaprevir',
                ],
                [
                    'name' => 'Tenofovir / Alafenamida',
                ],
                [
                    'name' => 'Tenofovir (microbicida)',
                ],
                [
                    'name' => 'Terconazol', 
                ],
                [
                    'name' => 'Tipranavir',
                ],
                [
                    'name' => 'Tivicay',
                ],
                [
                    'name' => 'Trizivir',
                ],
                [
                    'name' => 'Truvada',
                ],
                [
                    'name' => 'Twinrix', 
                ],
                [
                    'name' => 'Vacuna contra el Covid-19 AstraZen./U.',
                ],
                [
                    'name' => 'Vacuna contra el Covid-19 CureVac',
                ],
                [
                    'name' => 'Vacuna contra el Covid-19 Janssen/J&J',
                ],
                [
                    'name' => 'Vacuna contra el Covid-19 Moderna ARN',
                ],
                [
                    'name' => 'Vacuna contra el Covid-19 Novavax',
                ],
                [
                    'name' => 'Vacuna contra el Covid-19 Pfizer/BioNTech',
                ],
                [
                    'name' => 'Vacuna contra el Covid-19 Sanofi Pasteur/GSK',
                ],
                [
                    'name' => 'Vacuna contra la hepatitis A y la hepatitis B',
                ],
                [
                    'name' => 'Vacuna contra la hepatitis B',
                ],
                [
                    'name' => 'Vacuna de virus vivos contra la varicela',
                ],
                [
                    'name' => 'Varivax',
                ],
                [
                    'name' => 'Vicriviroc', 
                ],
                [
                    'name' => 'Videx',
                ],
                [
                    'name' => 'Videx EC',
                ],
                [
                    'name' => 'Viracept',
                ],
                [
                    'name' => 'Viramune',
                ],
                [
                    'name' => 'Viramune XR', 
                ],
                [
                    'name' => 'Viread',
                ],
                [
                    'name' => 'Voriconazol',
                ],
                [
                    'name' => 'Zerit',
                ],
                [
                    'name' => 'Ziagen',
                ],
                [
                    'name' => 'Zidovudina', 
                ],
                
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
