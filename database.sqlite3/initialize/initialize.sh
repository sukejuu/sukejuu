#!/bin/sh
if test -f main
then
  rm main
fi
sqlite3 -cmd ".read initialize.sql" main ".q"
