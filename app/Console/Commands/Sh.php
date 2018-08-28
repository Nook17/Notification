<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Sh extends Command
{
 protected $signature = 'nook:sh';

 protected $description = 'Show All exists tables';

 public function __construct()
 {
  parent::__construct();
 }

 public function handle()
 {
  $tables = DB::select("SHOW TABLES");
//   var_dump($tables);
  foreach ($tables as $table) {
   $this->info("$table->Tables_in_notifi");
  }
 }
}
