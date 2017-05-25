#!/bin/bash -e

set -o nounset

#----------------------------------------------------------------------#
# This script runs small PHP and Python scripts to make a comparison
# between NumPy and NumPhp. At the end, it prints duration for each 
# script and a global counter.
#
# Usage
# -----
#
# ./bench.sh
# Executes all scripts
#
# ./bench.sh ndarray
# Executes all scripts whose filename contains "ndarray"
#----------------------------------------------------------------------#

cd "$(dirname "$0")"
echo "" > "output.txt"

if [[ -z "${1+x}" ]]; then
  NP_FILTER=""
else
  NP_FILTER="$1"
fi

# PHP
for SCRIPT in php/*${NP_FILTER}*
do
  if [ -f "$SCRIPT" ]
  then
    d0=$(date +%s%6N)
    php "$SCRIPT" > "/dev/null"
    d1=$(date +%s%6N)
    printf "%s %'d ns\n" "$SCRIPT" "$(((d1-d0)))" >> "output.txt"
    printf "."
  fi
done

printf "\n"

# Python
for SCRIPT in python/*${NP_FILTER}*
do
  if [ -f "$SCRIPT" ]
  then
    d0=$(date +%s%6N)
    python "$SCRIPT" > "/dev/null"
    d1=$(date +%s%6N)
    printf "%s %'d ns\n" "$SCRIPT" "$(((d1-d0)))" >> "output.txt"
    printf "."
  fi
done


# merge times
php_time=$(column -t output.txt | grep php    | awk '{print $2}' \
          | tr -d ",| " | awk '{ sum += $1 } END { print sum }')
pyt_time=$(column -t output.txt | grep python | awk '{print $2}' \
          | tr -d ",| " | awk '{ sum += $1 } END { print sum }')

# List all tests results
if [ ! -z "$php_time" ] || [ ! -z "$pyt_time" ]
then
  # output
  printf "\n\n"
  column -t output.txt
fi

# Summary benchmark
if [ ! -z "$php_time" ] && [ ! -z "$pyt_time" ]
then
  # calc ratio
  php_prct=$(awk "BEGIN {printf \"%.2f\", \
          100 * $php_time / ($php_time + $pyt_time)}")
  pyt_prct=$(awk "BEGIN {printf \"%.2f\", \
          100 * $pyt_time / ($php_time + $pyt_time)}")
  
  # NumPhp & NumPy comparison
  printf "\n\n"
  ( printf "Global  %s   %s \n" "NumPhp"    "NumPy"     ; \
    printf "(ns)    %'d  %'d\n" "$php_time" "$pyt_time" ; \
    printf "(%%)    %s   %s \n" "$php_prct" "$pyt_prct" ) \
  | column -t
fi

printf "\n"

# garbage
rm output.txt
