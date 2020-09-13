#!/usr/bin/env sh

docker run --rm -v $(pwd):/app composer dump-autoload
