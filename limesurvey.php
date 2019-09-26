<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8"/>
<title>Limesurvey.sh</title>
</head>
<body>
<?php

$domena=$_POST['domena'];
$nusers=$_POST['nusers'];

echo "<h2>Required Domena: $domena</h2>";
echo "<h2>Number of usuarios: $nusers</h2>";

shell_exec("cd /root/gatling-tests-framework/src/test/scala/basic")
shell_exec("website=$(cat TestSurvey.scala | sed -n -e '/baseUrl/p' | sed 's/.*\/\(.*\)\"/\1/' | tr -d ')')")
echo "<h2>Previous Domena: $website</h2>"

shell_exec("sed -i -e "s/${website}/${domena}/g" TestSurvey.scala")


//shell_exec("notepad.exe");
shell_exec("cd ~/gatling-tests-framework");
shell_exec("mvn gatling:test -Dusers=$nusers -Dmaxduration=60 -Dgatling.simulationClass=basic.TestSurvey");

?>
</body>
</html>