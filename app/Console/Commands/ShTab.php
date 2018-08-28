<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShTab extends Command
{
 protected $signature = 'nook:shTab';

 protected $description = 'Choice table to show';

 public function __construct()
 {
  parent::__construct();
 }

 public function handle()
 {
  $tables = DB::select("SHOW TABLES");
  foreach ($tables as $table) {
   $tab[] = $table->Tables_in_notifi;
  }
  $choice_table = $this->choice('Indicate the table to display', $tab);

  $header       = DB::getSchemaBuilder()->getColumnListing($choice_table);
  $table_select = DB::table($choice_table)->get();
  if ($table_select->first()) {
   foreach ($table_select as $row) {
    $rows[] = (array) $row;
   }
   $this->question($choice_table, $this->comment('Teble :'));
   $this->table($header, $rows);
  } else {
   $this->info('Table ' . $choice_table . ' is empty !!!');
  }

 }
}
