#!/usr/bin/env 

docker run --rm -v $(pwd):/app composer require $1 
