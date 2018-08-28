<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Rename extends Command
{
 protected $signature = 'nook:rename
    {from : Old name table}
    {to : New name table}
    {optional_argument?}
    {argument_with_default=:default}
    {--t|table}
    {--o|option_with_value=}
    {--a|option_with_array=*}
    {--d|option_with_value_and_default=:default}
    ';

 protected $description = 'Rename table';

 public function __construct()
 {
  parent::__construct();
 }

 public function handle()
 {
  $from = $this->argument('from');
  $to   = $this->argument('to');

//   $ption_with_value_and_default = $this->option('queue');
  //   $option_with_value            = $this->options();

  DB::statement("ALTER TABLE $from RENAME TO $to");

  $this->info("Table $from rename to $to");

//   $this->line('Metoda - line');
  //   $this->info('Metoda - info');
  //   $this->comment('Metoda - comment');
  //   $this->question('Metoda - question');
  //   $this->error('Metoda - error');

 }
}
