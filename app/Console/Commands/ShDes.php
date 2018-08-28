<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShDes extends Command
{
 protected $signature = 'nook:shDes';

 protected $description = 'Show structure table';

 public function __construct()
 {
  parent::__construct();
 }

 public function handle()
 {
  $header = ['Field', 'Type', 'Null', 'Key', 'Default', 'Extra'];
  $tables = DB::select("SHOW TABLES");
  foreach ($tables as $table) {
   $tab[] = $table->Tables_in_notifi;
  }
  // $name = $this->ask('write the name of the table to show');
  // $name = $this->secret('write the name of the table to show');
  $name = $this->anticipate('write the name of the table to show', $tab);
  if (Schema::hasTable($name)) {
   $tables = DB::select("DESCRIBE $name");
   foreach ($tables as $table) {
    $rows[] = (array) $table;
   }
   $this->question($name, $this->comment('Teble :'));
   $this->table($header, $rows);
  } else {
   $this->comment('Tabel :');
   $this->error($name);
   $this->comment('Does not exist !!!');
  }
 }
}
