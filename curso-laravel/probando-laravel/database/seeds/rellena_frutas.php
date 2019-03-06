<?php

use Illuminate\Database\Seeder;

class rellena_frutas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for($i=0;$i<=40;$i++){

        	DB::table("notas")->insert(array(

        		'title'=>"Mi nota " .$i,
        		'descripcion' =>"La descripcion".$i
        	));
        }

        $this->command->info("Correcto");
    }
}
