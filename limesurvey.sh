#!/bin/bash
echo "Que domena?:"
read domena
echo "Quantos ususarios?:"
read nusers
cd /root/gatling-tests-framework/src/test/scala/basic
website=$(cat TestSurvey.scala | sed -n -e '/baseUrl/p' | sed 's/.*\/\(.*\)\"/\1/' | tr -d ')')
echo "Previous Domena: $website"
echo "Required Domena: $domena"
echo "$nusers users"

sed -i -e "s/${website}/${domena}/g" TestSurvey.scala

cd ~/gatling-tests-framework
mvn gatling:test -Dusers=$nusers -Dmaxduration=60 -Dgatling.simulationClass=basic.TestSurvey
