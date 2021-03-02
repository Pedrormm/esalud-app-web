<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class PiecenewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('piecenews')->delete();
        
        \DB::table('piecenews')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Un ‘eco’ permitiría obviar las biopsias para pacientes con VIH y hepatitis C',
            'content' => 'Prácticamente todo paciente prefiere un escáner a un pinchazo. Y si encima la información que se obtiene es más útil, quedan pocas dudas. Eso es lo que sucede con el fibroscán, una técnica de imagen que permite medir el grado de fibrosis del hígado (su endurecimiento o pérdida de funcionalidad producido por la hepatitis C), si se compara con el sistema tradicional: una punción.',
                'date' => '2014-03-18',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Un gel vaginal protege contra el VIH después de la relación sexual',
            'content' => 'Los geles vaginales con antivirales (los llamados microbicidas) son una de las esperanzas para frenar la expansión del VIH. Básicamente consisten en cremas que deben actuar destruyendo el virus antes de que llegue a las mucosas de la mujer y se asiente. Así, ellas tendrán el control de la infección, sobre todo en entornos en los que les cuesta negociar el uso del preservativo con su pareja. Pero, hasta ahora, se estaban ensayando los geles para usarlos antes de la relación. La posibilidad de que funcionen después, como publica Science Translational Medicine de un ensayo en macacos, da aún más opciones.',
                'date' => '2014-03-13',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}