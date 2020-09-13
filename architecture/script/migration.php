#!/usr/bin/env php
<?php

function camelize($input, $separator = ' ')
{
 return str_replace($separator, '', ucwords($input, $separator));
}

class Migration {
 protected $specification_prefix = '   $table->';
 protected $factory_prefix = '   ';
 protected $factory_suffix = ',';
 protected $factories = [
  's' => '\'$1\' => $faker->sentence',
  'b' => '\'$1\' => $faker->boolean',
  'c' => '\'$1\' => $faker->sentence',
  'n' => '\'$1\' => $faker->randomDigit',
  'e' => '\'$1\' => $faker->randomElement(array($2))',
  'k' => '\'$1\' => app\$2::inrandomorder()->first()->id',
 ];
 protected $specification_suffix = ";";
 protected $specifications = [
  'i' => [ "increments('id')"],
  's' => [ "string('$1')"],
  'c' => [ "string('$1', $2)"],
  'b' => [ "boolean('$1')"],
  'd' => [ "decimal('$1', $2, $3)"],
  'n' => [ "integer('$1')"],
  'f' => [ "float('$1')"],
  'k' => [ "integer('$1_id')->unsigned()", "foreign('$1_id')->references('id')->on('$2')"],
  'e' => [ "enum('$1', array($2))"],
  't' => [ "timestamps()"],
 ];
 protected $specification_parameter_prefix = '->';
 protected $specification_parameters = [
  'u' => 'unique()',
  'd' => "default($)",
  'n' => 'nullable()',
  's' => 'unsigned()',
 ];
 protected $schema;
 public function __construct($file)
 {
  $modelname =`head -n1 $file`;
  $modelname = preg_replace('/\s+/', ' ', trim($modelname));
  $modelname = camelize($modelname);
  $tablename =`cat $file | sed -n 2p`;
  $tablename = preg_replace('/\s+/', ' ', trim($tablename));
  $options =`cat $file | sed -n 3p`;
  $options = preg_replace('/\s+/', ' ', trim($options));
  $specs = file_get_contents($file);
  $specs = explode("\n", $specs);
  $c=0;
  $migname = date('Y_m_d_his', time()).'_create_'.str_replace(' ','_', $tablename).'_table.php';
  `cp ./script/template/migration.php ../database/migrations/$migname`;
  $seedername = '../database/seeds/'.camelize($modelname).'Seeder.php';
  $factoryname = '../database/factories/'.camelize($modelname).'Factory.php';
  if (is_numeric($options)) {
  `cp ./script/template/seederf.php $seedername`;
  `cp ./script/template/factory.php $factoryname`;
  } else {
  `cp ./script/template/seeder.php $seedername`;
  }
  foreach ($specs as $spec)
  {
   if ($c < 3) { $c++; continue; }
   if (!$spec) continue;
   $spec = explode(" ", $spec);
   foreach($this->specifications as $key => $value) {
    if ($key == $spec[0]) {
     if (sizeof($value) > 1) {
      foreach($value as $v) {
       $this->schema .= $this->specification_prefix;
       $str = $v;
       for ($i = 1; $i <= substr_count($v, '$'); $i++) {
        $str = str_replace('$'.$i, str_replace('.', ' ', $spec[$i]), $str);
       }
       $this->schema .= $str.$this->specification_suffix.PHP_EOL;
      }
      $fct = str_replace('$1', $spec[1], $this->factories[$key]);
      $fct = str_replace('$2', camelize($spec[1]), $fct);
      if ($fct)
      {
      $this->facts .= $this->factory_prefix;
      $this->facts .= $fct.$this->factory_suffix.PHP_EOL;
      }
     } else {
      $this->schema .= $this->specification_prefix;
      $str = $value[0];
      for ($i = 1; $i <= substr_count($value[0], '$'); $i++) {
       $str = str_replace('$'.$i, str_replace('.', ' ', $spec[$i]), $str);
       $str = str_replace('-', "'", $str);
      }
      $this->schema .= $str;
      $fct = str_replace('$1', $spec[1], $this->factories[$key]);
      if ($key == 'e') {
      $spec[2] = str_replace('-', "'", $spec[2]);
      $fct = str_replace('$2', str_replace('.', ' ', $spec[2]), $fct);
      }
      if ($fct)
      {
      $this->facts .= $this->factory_prefix;
      $this->facts .= $fct.$this->factory_suffix.PHP_EOL;
      }
      if ((sizeof($spec) - 1) > substr_count($value[0], '$')) {
       $j = substr_count($value[0], '$') + 1; 
       while($j < sizeof($spec))
       {
        foreach($this->specification_parameters as $k1 => $v1) {
         if ($k1 == $spec[$j]) {
          $str1 = $v1;
          $str1 = str_replace('$', str_replace('.' , ' ', $spec[$j+1]), $str1);
          $str1 = str_replace('-', "'" , $str1);
          $this->schema .= $this->specification_parameter_prefix.$str1;
          $j+=2;
         }
        }
       }
      }
      $this->schema .= $this->specification_suffix.PHP_EOL;
     }
     break;
    }
   }
  }
  $out = file_get_contents("../database/migrations/$migname");
  $out = str_replace('$1', camelize($tablename), $out);
  $out = str_replace('$2', str_replace(' ', '_', $tablename), $out);
  $out = str_replace('$3', substr($this->schema, 0, -1), $out);
  file_put_contents("../database/migrations/$migname", $out);
  if (is_numeric($options)) {
  $out = file_get_contents("$seedername");
  $out = str_replace('$1', camelize($modelname), $out);
  $out = str_replace('$2', $options, $out);
  file_put_contents($seedername, $out);
  $out = file_get_contents("$factoryname");
  $out = str_replace('$1', camelize($modelname), $out);
  $out = str_replace('$2',  substr($this->facts, 0, -1), $out);
  file_put_contents($factoryname, $out);
  } else {
  $out = file_get_contents("$seedername");
  $out = str_replace('$1', camelize($modelname), $out);
  $out = str_replace('$2', str_replace(' ', '_', $tablename), $out);
  file_put_contents($seedername, $out);
  }
 }
}

$m = new Migration($argv[1]);

