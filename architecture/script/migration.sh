#!/usr/bin/env sh

#cat m | sed "s!^i !\$table->increments('!"  | \
# sed "s!^s !\$table->string('!" | \
# sed "s!^e !\$table->enum('!" | \
# sed "s!^b !\$table->boolean('!" | \
# sed "s!^f !\$table->integer('!" 
IFS=$'\n'
for a in $(cat m)
do
 type=$(echo $a | cut -d' ' -f1)
 name=$(echo $a | cut -d' ' -f2)
 fieldsno=$(echo $a | grep -o ' ' | wc -l)
 echo $fieldsno
 case $type in
  i)
   echo "\$table->increments('$name');"
   ;;
  s)
   if [ $fieldsno -eq 2 ]; then
    field=$(echo $a | cut -d' ' -f3)
    case $field in
     u)
      echo "\$table->string('$name')->unique();"
      ;;
     n)
      echo "\$table->string('$name')->nullable();"
      ;;
    esac
   else
    echo "\$table->string('$name');"
   fi
   ;;
 esac
done
