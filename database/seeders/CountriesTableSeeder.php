<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('countries')->insert(
            [
                [
                    'id'=>'1',
                    'name'=>'Afghanistan',
                    'short_name'=>'af',
                    'long_name'=>'Afghanistan (‫افغانستان‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'2',
                    'name'=>'Albania',
                    'short_name'=>'al',
                    'long_name'=>'Albania (Shqipëri)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'3',
                    'name'=>'Algeria',
                    'short_name'=>'dz',
                    'long_name'=>'Algeria (‫الجزائر‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'4',
                    'name'=>'American Samoa',
                    'short_name'=>'as',
                    'long_name'=>'American Samoa',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'5',
                    'name'=>'Andorra',
                    'short_name'=>'ad',
                    'long_name'=>'Andorra',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'6',
                    'name'=>'Angola',
                    'short_name'=>'ao',
                    'long_name'=>'Angola',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'7',
                    'name'=>'Anguilla',
                    'short_name'=>'ai',
                    'long_name'=>'Anguilla',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'8',
                    'name'=>'Antigua and Barbuda',
                    'short_name'=>'ag',
                    'long_name'=>'Antigua and Barbuda',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'9',
                    'name'=>'Argentina',
                    'short_name'=>'ar',
                    'long_name'=>'Argentina',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'10',
                    'name'=>'Armenia',
                    'short_name'=>'am',
                    'long_name'=>'Armenia (Հայաստան)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'11',
                    'name'=>'Aruba',
                    'short_name'=>'aw',
                    'long_name'=>'Aruba',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'12',
                    'name'=>'Australia',
                    'short_name'=>'au',
                    'long_name'=>'Australia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'13',
                    'name'=>'Austria',
                    'short_name'=>'at',
                    'long_name'=>'Austria (Österreich)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'14',
                    'name'=>'Azerbaijan',
                    'short_name'=>'az',
                    'long_name'=>'Azerbaijan (Azərbaycan)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'15',
                    'name'=>'Bahamas',
                    'short_name'=>'bs',
                    'long_name'=>'Bahamas',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'16',
                    'name'=>'Bahrain',
                    'short_name'=>'bh',
                    'long_name'=>'Bahrain (‫البحرين‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'17',
                    'name'=>'Bangladesh',
                    'short_name'=>'bd',
                    'long_name'=>'Bangladesh (বাংলাদেশ)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'18',
                    'name'=>'Barbados',
                    'short_name'=>'bb',
                    'long_name'=>'Barbados',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'19',
                    'name'=>'Belarus',
                    'short_name'=>'by',
                    'long_name'=>'Belarus (Беларусь)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'20',
                    'name'=>'Belgium',
                    'short_name'=>'be',
                    'long_name'=>'Belgium (België)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'21',
                    'name'=>'Belize',
                    'short_name'=>'bz',
                    'long_name'=>'Belize',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'22',
                    'name'=>'Benin',
                    'short_name'=>'bj',
                    'long_name'=>'Benin (Bénin)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'23',
                    'name'=>'Bermuda',
                    'short_name'=>'bm',
                    'long_name'=>'Bermuda',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'24',
                    'name'=>'Bhutan',
                    'short_name'=>'bt',
                    'long_name'=>'Bhutan (འབྲུག)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'25',
                    'name'=>'Bolivia',
                    'short_name'=>'bo',
                    'long_name'=>'Bolivia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'26',
                    'name'=>'Bosnia and Herzegovina',
                    'short_name'=>'ba',
                    'long_name'=>'Bosnia and Herzegovina (Босна и Херцеговина)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'27',
                    'name'=>'Botswana',
                    'short_name'=>'bw',
                    'long_name'=>'Botswana',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'28',
                    'name'=>'Brazil',
                    'short_name'=>'br',
                    'long_name'=>'Brazil (Brasil)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'29',
                    'name'=>'British Indian Ocean Territory',
                    'short_name'=>'io',
                    'long_name'=>'British Indian Ocean Territory',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'30',
                    'name'=>'British Virgin Islands',
                    'short_name'=>'vg',
                    'long_name'=>'British Virgin Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'31',
                    'name'=>'Brunei',
                    'short_name'=>'bn',
                    'long_name'=>'Brunei',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'32',
                    'name'=>'Bulgaria',
                    'short_name'=>'bg',
                    'long_name'=>'Bulgaria (България)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'33',
                    'name'=>'Burkina Faso',
                    'short_name'=>'bf',
                    'long_name'=>'Burkina Faso',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'34',
                    'name'=>'Burundi',
                    'short_name'=>'bi',
                    'long_name'=>'Burundi (Uburundi)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'35',
                    'name'=>'Cambodia',
                    'short_name'=>'kh',
                    'long_name'=>'Cambodia (កម្ពុជា)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'36',
                    'name'=>'Cameroon', 
                    'short_name'=>'cm',
                    'long_name'=>'Cameroon (Cameroun)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'37',
                    'name'=>'Canada',
                    'short_name'=>'ca',
                    'long_name'=>'Canada',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'38',
                    'name'=>'Cape Verde',
                    'short_name'=>'cv',
                    'long_name'=>'Cape Verde (Kabu Verdi)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'39',
                    'name'=>'Caribbean Netherlands',
                    'short_name'=>'bq',
                    'long_name'=>'Caribbean Netherlands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'40',
                    'name'=>'Cayman Islands',
                    'short_name'=>'ky',
                    'long_name'=>'Cayman Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'41',
                    'name'=>'Central African Republic',
                    'short_name'=>'cf',
                    'long_name'=>'Central African Republic (République centrafricaine)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'42',
                    'name'=>'Chad',
                    'short_name'=>'td',
                    'long_name'=>'Chad (Tchad)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'43',
                    'name'=>'Chile',
                    'short_name'=>'cl',
                    'long_name'=>'Chile',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'44',
                    'name'=>'China',
                    'short_name'=>'cn',
                    'long_name'=>'China (中国)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'45',
                    'name'=>'Christmas Island',
                    'short_name'=>'cx',
                    'long_name'=>'Christmas Island',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'46',
                    'name'=>'Cocos Islands',
                    'short_name'=>'cc',
                    'long_name'=>'Cocos (Keeling) Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'47',
                    'name'=>'Colombia',
                    'short_name'=>'co',
                    'long_name'=>'Colombia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'48',
                    'name'=>'Comoros',
                    'short_name'=>'km',
                    'long_name'=>'Comoros (‫جزر القمر‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'49',
                    'name'=>'Congo (DRC)',
                    'short_name'=>'cd',
                    'long_name'=>'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'50',
                    'name'=>'Congo (Republic)',
                    'short_name'=>'cg',
                    'long_name'=>'Congo (Republic) (Congo-Brazzaville)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'51',
                    'name'=>'Cook Islands',
                    'short_name'=>'ck',
                    'long_name'=>'Cook Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'52',
                    'name'=>'Costa Rica',
                    'short_name'=>'cr',
                    'long_name'=>'Costa Rica',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'53',
                    'name'=>'Côte d’Ivoire',
                    'short_name'=>'ci',
                    'long_name'=>'Côte d’Ivoire',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'54',
                    'name'=>'Croatia',
                    'short_name'=>'hr',
                    'long_name'=>'Croatia (Hrvatska)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'55',
                    'name'=>'Cuba',
                    'short_name'=>'cu',
                    'long_name'=>'Cuba',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'56',
                    'name'=>'Curaçao',
                    'short_name'=>'cw',
                    'long_name'=>'Curaçao',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'57',
                    'name'=>'Cyprus',
                    'short_name'=>'cy',
                    'long_name'=>'Cyprus (Κύπρος)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'58',
                    'name'=>'Czech Republic',
                    'short_name'=>'cz',
                    'long_name'=>'Czech Republic (Česká republika)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'59',
                    'name'=>'Denmark',
                    'short_name'=>'dk',
                    'long_name'=>'Denmark (Danmark)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'60',
                    'name'=>'Djibouti',
                    'short_name'=>'dj',
                    'long_name'=>'Djibouti',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'61',
                    'name'=>'Dominica',
                    'short_name'=>'dm',
                    'long_name'=>'Dominica',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'62',
                    'name'=>'Dominican Republic',
                    'short_name'=>'do',
                    'long_name'=>'Dominican Republic (República Dominicana)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'63',
                    'name'=>'Ecuador',
                    'short_name'=>'ec',
                    'long_name'=>'Ecuador',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'64',
                    'name'=>'Egypt',
                    'short_name'=>'eg',
                    'long_name'=>'Egypt (‫مصر‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'65',
                    'name'=>'El Salvador',
                    'short_name'=>'sv',
                    'long_name'=>'El Salvador',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'66',
                    'name'=>'Equatorial Guinea',
                    'short_name'=>'gq',
                    'long_name'=>'Equatorial Guinea (Guinea Ecuatorial)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'67',
                    'name'=>'Eritrea',
                    'short_name'=>'er',
                    'long_name'=>'Eritrea',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'68',
                    'name'=>'Estonia',
                    'short_name'=>'ee',
                    'long_name'=>'Estonia (Eesti)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'69',
                    'name'=>'Ethiopia',
                    'short_name'=>'et',
                    'long_name'=>'Ethiopia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'70',
                    'name'=>'Falkland Islands',
                    'short_name'=>'fk',
                    'long_name'=>'Falkland Islands (Islas Malvinas)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'71',
                    'name'=>'Faroe Islands',
                    'short_name'=>'fo',
                    'long_name'=>'Faroe Islands (Føroyar)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'72',
                    'name'=>'Fiji',
                    'short_name'=>'fj',
                    'long_name'=>'Fiji',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'73',
                    'name'=>'Finland',
                    'short_name'=>'fi',
                    'long_name'=>'Finland (Suomi)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'74',
                    'name'=>'France',
                    'short_name'=>'fr',
                    'long_name'=>'France',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'75',
                    'name'=>'French Guiana',
                    'short_name'=>'gf',
                    'long_name'=>'French Guiana (Guyane française)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'76',
                    'name'=>'French Polynesia',
                    'short_name'=>'pf',
                    'long_name'=>'French Polynesia (Polynésie française)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'77',
                    'name'=>'Gabon',
                    'short_name'=>'ga',
                    'long_name'=>'Gabon',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'78',
                    'name'=>'Gambia',
                    'short_name'=>'gm',
                    'long_name'=>'Gambia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'79',
                    'name'=>'Georgia',
                    'short_name'=>'ge',
                    'long_name'=>'Georgia (საქართველო)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'80',
                    'name'=>'Germany',
                    'short_name'=>'de',
                    'long_name'=>'Germany (Deutschland)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'81',
                    'name'=>'Ghana',
                    'short_name'=>'gh',
                    'long_name'=>'Ghana (Gaana)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'82',
                    'name'=>'Gibraltar',
                    'short_name'=>'gi',
                    'long_name'=>'Gibraltar',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'83',
                    'name'=>'Greece',
                    'short_name'=>'gr',
                    'long_name'=>'Greece (Ελλάδα)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'84',
                    'name'=>'Greenland',
                    'short_name'=>'gl',
                    'long_name'=>'Greenland (Kalaallit Nunaat)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'85',
                    'name'=>'Grenada',
                    'short_name'=>'gd',
                    'long_name'=>'Grenada',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'86',
                    'name'=>'Guadeloupe',
                    'short_name'=>'gp',
                    'long_name'=>'Guadeloupe',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'87',
                    'name'=>'Guam',
                    'short_name'=>'gu',
                    'long_name'=>'Guam',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'88',
                    'name'=>'Guatemala',
                    'short_name'=>'gt',
                    'long_name'=>'Guatemala',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'89',
                    'name'=>'Guernsey',
                    'short_name'=>'gg',
                    'long_name'=>'Guernsey',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'90',
                    'name'=>'Guinea',
                    'short_name'=>'gn',
                    'long_name'=>'Guinea (Guinée)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'91',
                    'name'=>'Guinea-Bissau',
                    'short_name'=>'gw',
                    'long_name'=>'Guinea-Bissau (Guiné Bissau)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'92',
                    'name'=>'Guyana',
                    'short_name'=>'gy',
                    'long_name'=>'Guyana',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'93',
                    'name'=>'Haiti',
                    'short_name'=>'ht',
                    'long_name'=>'Haiti',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'94',
                    'name'=>'Honduras',
                    'short_name'=>'hn',
                    'long_name'=>'Honduras',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'95',
                    'name'=>'Hong Kong',
                    'short_name'=>'hk',
                    'long_name'=>'Hong Kong (香港)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'96',
                    'name'=>'Hungary',
                    'short_name'=>'hu',
                    'long_name'=>'Hungary (Magyarország)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'97',
                    'name'=>'Iceland',
                    'short_name'=>'is',
                    'long_name'=>'Iceland (Ísland)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'98',
                    'name'=>'India',
                    'short_name'=>'in',
                    'long_name'=>'India (भारत)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'99',
                    'name'=>'Indonesia',
                    'short_name'=>'id',
                    'long_name'=>'Indonesia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'100',
                    'name'=>'Iran',
                    'short_name'=>'ir',
                    'long_name'=>'Iran (‫ایران‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'101',
                    'name'=>'Iraq',
                    'short_name'=>'iq',
                    'long_name'=>'Iraq (‫العراق‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'102',
                    'name'=>'Ireland',
                    'short_name'=>'ie',
                    'long_name'=>'Ireland',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'103',
                    'name'=>'Isle of Man',
                    'short_name'=>'im',
                    'long_name'=>'Isle of Man',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'104',
                    'name'=>'Israel',
                    'short_name'=>'il',
                    'long_name'=>'Israel (‫ישראל‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'105',
                    'name'=>'Italy',
                    'short_name'=>'it',
                    'long_name'=>'Italy (Italia)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'106',
                    'name'=>'Jamaica',
                    'short_name'=>'jm',
                    'long_name'=>'Jamaica',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'107',
                    'name'=>'Japan',
                    'short_name'=>'jp',
                    'long_name'=>'Japan (日本)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'108',
                    'name'=>'Jersey',
                    'short_name'=>'je',
                    'long_name'=>'Jersey',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'109',
                    'name'=>'Jordan',
                    'short_name'=>'jo',
                    'long_name'=>'Jordan (‫الأردن‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'110',
                    'name'=>'Kazakhstan',
                    'short_name'=>'kz',
                    'long_name'=>'Kazakhstan (Казахстан)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'111',
                    'name'=>'Kenya',
                    'short_name'=>'ke',
                    'long_name'=>'Kenya',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'112',
                    'name'=>'Kiribati',
                    'short_name'=>'ki',
                    'long_name'=>'Kiribati',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'113',
                    'name'=>'Kosovo',
                    'short_name'=>'xk',
                    'long_name'=>'Kosovo',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'114',
                    'name'=>'Kuwait',
                    'short_name'=>'kw',
                    'long_name'=>'Kuwait (‫الكويت‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'115',
                    'name'=>'Kyrgyzstan',
                    'short_name'=>'kg',
                    'long_name'=>'Kyrgyzstan (Кыргызстан)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'116',
                    'name'=>'Laos',
                    'short_name'=>'la',
                    'long_name'=>'Laos (ລາວ)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'117',
                    'name'=>'Latvia',
                    'short_name'=>'lv',
                    'long_name'=>'Latvia (Latvija)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'118',
                    'name'=>'Lebanon',
                    'short_name'=>'lb',
                    'long_name'=>'Lebanon (‫لبنان‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'119',
                    'name'=>'Lesotho',
                    'short_name'=>'ls',
                    'long_name'=>'Lesotho',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'120',
                    'name'=>'Liberia',
                    'short_name'=>'lr',
                    'long_name'=>'Liberia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'121',
                    'name'=>'Libya',
                    'short_name'=>'ly',
                    'long_name'=>'Libya (‫ليبيا‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'122',
                    'name'=>'Liechtenstein',
                    'short_name'=>'li',
                    'long_name'=>'Liechtenstein',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'123',
                    'name'=>'Lithuania',
                    'short_name'=>'lt',
                    'long_name'=>'Lithuania (Lietuva)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'124',
                    'name'=>'Luxembourg',
                    'short_name'=>'lu',
                    'long_name'=>'Luxembourg',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'125',
                    'name'=>'Macau',
                    'short_name'=>'mo',
                    'long_name'=>'Macau (澳門)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'126',
                    'name'=>'Macedonia',
                    'short_name'=>'mk',
                    'long_name'=>'Macedonia (FYROM) (Македонија)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'127',
                    'name'=>'Madagascar',
                    'short_name'=>'mg',
                    'long_name'=>'Madagascar (Madagasikara)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'128',
                    'name'=>'Malawi',
                    'short_name'=>'mw',
                    'long_name'=>'Malawi',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'129',
                    'name'=>'Malaysia',
                    'short_name'=>'my',
                    'long_name'=>'Malaysia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'130',
                    'name'=>'Maldives',
                    'short_name'=>'mv',
                    'long_name'=>'Maldives',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'131',
                    'name'=>'Mali',
                    'short_name'=>'ml',
                    'long_name'=>'Mali',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'132',
                    'name'=>'Malta',
                    'short_name'=>'mt',
                    'long_name'=>'Malta',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'133',
                    'name'=>'Marshall Islands',
                    'short_name'=>'mh',
                    'long_name'=>'Marshall Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'134',
                    'name'=>'Martinique',
                    'short_name'=>'mq',
                    'long_name'=>'Martinique',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'135',
                    'name'=>'Mauritania',
                    'short_name'=>'mr',
                    'long_name'=>'Mauritania (‫موريتانيا‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'136',
                    'name'=>'Mauritius',
                    'short_name'=>'mu',
                    'long_name'=>'Mauritius (Moris)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'137',
                    'name'=>'Mayotte',
                    'short_name'=>'yt',
                    'long_name'=>'Mayotte',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'138',
                    'name'=>'Mexico',
                    'short_name'=>'mx',
                    'long_name'=>'Mexico (México)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'139',
                    'name'=>'Micronesia',
                    'short_name'=>'fm',
                    'long_name'=>'Micronesia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'140',
                    'name'=>'Moldova',
                    'short_name'=>'md',
                    'long_name'=>'Moldova (Republica Moldova)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'141',
                    'name'=>'Monaco',
                    'short_name'=>'mc',
                    'long_name'=>'Monaco',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'142',
                    'name'=>'Mongolia',
                    'short_name'=>'mn',
                    'long_name'=>'Mongolia (Монгол)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'143',
                    'name'=>'Montenegro',
                    'short_name'=>'me',
                    'long_name'=>'Montenegro (Crna Gora)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'144',
                    'name'=>'Montserrat',
                    'short_name'=>'ms',
                    'long_name'=>'Montserrat',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'145',
                    'name'=>'Morocco',
                    'short_name'=>'ma',
                    'long_name'=>'Morocco (‫المغرب‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'146',
                    'name'=>'Mozambique',
                    'short_name'=>'mz',
                    'long_name'=>'Mozambique (Moçambique)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'147',
                    'name'=>'Myanmar',
                    'short_name'=>'mm',
                    'long_name'=>'Myanmar (Burma) (မြန်မာ)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'148',
                    'name'=>'Namibia',
                    'short_name'=>'na',
                    'long_name'=>'Namibia (Namibië)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'149',
                    'name'=>'Nauru',
                    'short_name'=>'nr',
                    'long_name'=>'Nauru',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'150',
                    'name'=>'Nepal',
                    'short_name'=>'np',
                    'long_name'=>'Nepal (नेपाल)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'151',
                    'name'=>'Netherlands',
                    'short_name'=>'nl',
                    'long_name'=>'Netherlands (Nederland)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'152',
                    'name'=>'New Caledonia',
                    'short_name'=>'687',
                    'long_name'=>'New Caledonia (Nouvelle-Calédonie)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'153',
                    'name'=>'New Zealand',
                    'short_name'=>'nz',
                    'long_name'=>'New Zealand',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'154',
                    'name'=>'Nicaragua',
                    'short_name'=>'ni',
                    'long_name'=>'Nicaragua',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'155',
                    'name'=>'Niger',
                    'short_name'=>'ne',
                    'long_name'=>'Niger (Nijar)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'156',
                    'name'=>'Nigeria',
                    'short_name'=>'ng',
                    'long_name'=>'Nigeria',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'157',
                    'name'=>'Niue',
                    'short_name'=>'nu',
                    'long_name'=>'Niue',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'158',
                    'name'=>'Norfolk Island',
                    'short_name'=>'nf',
                    'long_name'=>'Norfolk Island',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'159',
                    'name'=>'North Korea',
                    'short_name'=>'kp',
                    'long_name'=>'North Korea (조선 민주주의 인민 공화국)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'160',
                    'name'=>'Northern Mariana Islands',
                    'short_name'=>'mp',
                    'long_name'=>'Northern Mariana Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'161',
                    'name'=>'Norway',
                    'short_name'=>'no',
                    'long_name'=>'Norway (Norge)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'162',
                    'name'=>'Oman',
                    'short_name'=>'om',
                    'long_name'=>'Oman (‫عُمان‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'163',
                    'name'=>'Pakistan',
                    'short_name'=>'pk',
                    'long_name'=>'Pakistan (‫پاکستان‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'164',
                    'name'=>'Palau',
                    'short_name'=>'pw',
                    'long_name'=>'Palau',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'165',
                    'name'=>'Palestine',
                    'short_name'=>'ps',
                    'long_name'=>'Palestine (‫فلسطين‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'166',
                    'name'=>'Panama',
                    'short_name'=>'pa',
                    'long_name'=>'Panama (Panamá)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'167',
                    'name'=>'Papua New Guinea',
                    'short_name'=>'pg',
                    'long_name'=>'Papua New Guinea',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'168',
                    'name'=>'Paraguay',
                    'short_name'=>'py',
                    'long_name'=>'Paraguay',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'169',
                    'name'=>'Peru',
                    'short_name'=>'pe',
                    'long_name'=>'Peru (Perú)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'170',
                    'name'=>'Philippines',
                    'short_name'=>'ph',
                    'long_name'=>'Philippines',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'171',
                    'name'=>'Poland',
                    'short_name'=>'pl',
                    'long_name'=>'Poland (Polska)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'172',
                    'name'=>'Portugal',
                    'short_name'=>'pt',
                    'long_name'=>'Portugal',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'173',
                    'name'=>'Puerto Rico',
                    'short_name'=>'pr',
                    'long_name'=>'Puerto Rico',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'174',
                    'name'=>'Qatar',
                    'short_name'=>'qa',
                    'long_name'=>'Qatar (‫قطر‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'175',
                    'name'=>'Réunion',
                    'short_name'=>'re',
                    'long_name'=>'Réunion (La Réunion)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'176',
                    'name'=>'Romania',
                    'short_name'=>'ro',
                    'long_name'=>'Romania (România)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'177',
                    'name'=>'Russia',
                    'short_name'=>'ru',
                    'long_name'=>'Russia (Россия)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'178',
                    'name'=>'Rwanda',
                    'short_name'=>'rw',
                    'long_name'=>'Rwanda',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'179',
                    'name'=>'Saint Barthélemy',
                    'short_name'=>'bl',
                    'long_name'=>'Saint Barthélemy',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'180',
                    'name'=>'Saint Helena',
                    'short_name'=>'sh',
                    'long_name'=>'Saint Helena',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'181',
                    'name'=>'Saint Kitts and Nevis"',
                    'short_name'=>'kn',
                    'long_name'=>'Saint Kitts and Nevis"',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'182',
                    'name'=>'Saint Lucia',
                    'short_name'=>'lc',
                    'long_name'=>'Saint Lucia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'183',
                    'name'=>'Saint Martin',
                    'short_name'=>'mf',
                    'long_name'=>'Saint Martin (Saint-Martin (partie française))',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'184',
                    'name'=>'Saint Pierre and Miquelon',
                    'short_name'=>'pm',
                    'long_name'=>'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'185',
                    'name'=>'Saint Vincent and the Grenadines',
                    'short_name'=>'vc',
                    'long_name'=>'Saint Vincent and the Grenadines',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'186',
                    'name'=>'Samoa',
                    'short_name'=>'ws',
                    'long_name'=>'Samoa',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'187',
                    'name'=>'San Marino',
                    'short_name'=>'sm',
                    'long_name'=>'San Marino',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'188',
                    'name'=>'São Tomé and Príncipe',
                    'short_name'=>'st',
                    'long_name'=>'São Tomé and Príncipe (São Tomé e Príncipe)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'189',
                    'name'=>'Saudi Arabia',
                    'short_name'=>'sa',
                    'long_name'=>'Saudi Arabia (‫المملكة العربية السعودية‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'190',
                    'name'=>'Senegal',
                    'short_name'=>'sn',
                    'long_name'=>'Senegal (Sénégal)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'191',
                    'name'=>'Serbia',
                    'short_name'=>'rs',
                    'long_name'=>'Serbia (Србија)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'192',
                    'name'=>'Seychelles',
                    'short_name'=>'sc',
                    'long_name'=>'Seychelles',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'193',
                    'name'=>'Sierra Leone',
                    'short_name'=>'sl',
                    'long_name'=>'Sierra Leone',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'194',
                    'name'=>'Singapore',
                    'short_name'=>'sg',
                    'long_name'=>'Singapore',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'195',
                    'name'=>'Sint Maarten',
                    'short_name'=>'sx',
                    'long_name'=>'Sint Maarten',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'196',
                    'name'=>'Slovakia',
                    'short_name'=>'sk',
                    'long_name'=>'Slovakia (Slovensko)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'197',
                    'name'=>'Slovenia',
                    'short_name'=>'si',
                    'long_name'=>'Slovenia (Slovenija)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'198',
                    'name'=>'Solomon Islands',
                    'short_name'=>'sb',
                    'long_name'=>'Solomon Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'199',
                    'name'=>'Somalia',
                    'short_name'=>'so',
                    'long_name'=>'Somalia (Soomaaliya)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'200',
                    'name'=>'South Africa',
                    'short_name'=>'za',
                    'long_name'=>'South Africa',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'201',
                    'name'=>'South Korea',
                    'short_name'=>'kr',
                    'long_name'=>'South Korea (대한민국)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'202',
                    'name'=>'South Sudan',
                    'short_name'=>'ss',
                    'long_name'=>'South Sudan (‫جنوب السودان‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'203',
                    'name'=>'Spain',
                    'short_name'=>'es',
                    'long_name'=>'Spain (España)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'204',
                    'name'=>'Sri Lanka',
                    'short_name'=>'lk',
                    'long_name'=>'Sri Lanka (ශ්‍රී ලංකාව)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'205',
                    'name'=>'Sudan',
                    'short_name'=>'sd',
                    'long_name'=>'Sudan (‫السودان‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'206',
                    'name'=>'Suriname',
                    'short_name'=>'sr',
                    'long_name'=>'sr',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'207',
                    'name'=>'Svalbard and Jan Mayen',
                    'short_name'=>'sj',
                    'long_name'=>'Svalbard and Jan Mayen',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'208',
                    'name'=>'Swaziland',
                    'short_name'=>'sz',
                    'long_name'=>'Swaziland',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'209',
                    'name'=>'Sweden',
                    'short_name'=>'se',
                    'long_name'=>'Sweden (Sverige)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'210',
                    'name'=>'Switzerland',
                    'short_name'=>'ch',
                    'long_name'=>'Switzerland (Schweiz)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'211',
                    'name'=>'Syria',
                    'short_name'=>'sy',
                    'long_name'=>'Syria (‫سوريا‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'212',
                    'name'=>'Taiwan',
                    'short_name'=>'tw',
                    'long_name'=>'Taiwan (台灣)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'213',
                    'name'=>'Tajikistan',
                    'short_name'=>'tj',
                    'long_name'=>'Tajikistan',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'214',
                    'name'=>'Tanzania',
                    'short_name'=>'tz',
                    'long_name'=>'Tanzania',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'215',
                    'name'=>'Thailand',
                    'short_name'=>'th',
                    'long_name'=>'Thailand (ไทย)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'216',
                    'name'=>'Timor-Leste',
                    'short_name'=>'tl',
                    'long_name'=>'Timor-Leste',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'217',
                    'name'=>'Togo',
                    'short_name'=>'tg',
                    'long_name'=>'Togo',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'218',
                    'name'=>'Tokelau',
                    'short_name'=>'tk',
                    'long_name'=>'Tokelau',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'219',
                    'name'=>'Tonga',
                    'short_name'=>'to',
                    'long_name'=>'Tonga',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'220',
                    'name'=>'Trinidad and Tobago',
                    'short_name'=>'tt',
                    'long_name'=>'Trinidad and Tobago',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'221',
                    'name'=>'Tunisia',
                    'short_name'=>'tn',
                    'long_name'=>'Tunisia (‫تونس‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'222',
                    'name'=>'Turkey',
                    'short_name'=>'tr',
                    'long_name'=>'Turkey (Türkiye)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'223',
                    'name'=>'Turkmenistan',
                    'short_name'=>'tm',
                    'long_name'=>'Turkmenistan',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'224',
                    'name'=>'Turks and Caicos Islands',
                    'short_name'=>'tc',
                    'long_name'=>'Turks and Caicos Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'225',
                    'name'=>'Tuvalu',
                    'short_name'=>'tv',
                    'long_name'=>'Tuvalu',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'226',
                    'name'=>'U.S. Virgin Islands',
                    'short_name'=>'vi',
                    'long_name'=>'U.S. Virgin Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'227',
                    'name'=>'Uganda',
                    'short_name'=>'ug',
                    'long_name'=>'Uganda',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'228',
                    'name'=>'Ukraine',
                    'short_name'=>'ua',
                    'long_name'=>'Ukraine (Україна)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'229',
                    'name'=>'United Arab Emirates',
                    'short_name'=>'ae',
                    'long_name'=>'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'230',
                    'name'=>'United Kingdom',
                    'short_name'=>'gb',
                    'long_name'=>'United Kingdom',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'231',
                    'name'=>'United States',
                    'short_name'=>'us',
                    'long_name'=>'United States',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'232',
                    'name'=>'Uruguay',
                    'short_name'=>'uy',
                    'long_name'=>'Uruguay',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'233',
                    'name'=>'Uzbekistan',
                    'short_name'=>'uz',
                    'long_name'=>'Uzbekistan (Oʻzbekiston)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'234',
                    'name'=>'Vanuatu',
                    'short_name'=>'vu',
                    'long_name'=>'Vanuatu',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'235',
                    'name'=>'Vatican City',
                    'short_name'=>'va',
                    'long_name'=>'Vatican City (Città del Vaticano)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'236',
                    'name'=>'Venezuela',
                    'short_name'=>'ve',
                    'long_name'=>'Venezuela',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'237',
                    'name'=>'Vietnam',
                    'short_name'=>'vn',
                    'long_name'=>'Vietnam (Việt Nam)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'238',
                    'name'=>'Wallis and Futuna',
                    'short_name'=>'wf',
                    'long_name'=>'Wallis and Futuna (Wallis-et-Futuna)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'239',
                    'name'=>'Western Sahara',
                    'short_name'=>'eh',
                    'long_name'=>'Western Sahara (‫الصحراء الغربية‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'240',
                    'name'=>'Yemen',
                    'short_name'=>'ye',
                    'long_name'=>'Yemen (‫اليمن‬‎)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'241',
                    'name'=>'Zambia',
                    'short_name'=>'zm',
                    'long_name'=>'Zambia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'242',
                    'name'=>'Zimbabwe',
                    'short_name'=>'zw',
                    'long_name'=>'Zimbabwe',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>'243',
                    'name'=>'Åland Islands',
                    'short_name'=>'ax',
                    'long_name'=>'Åland Islands',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
            ]
        );

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
