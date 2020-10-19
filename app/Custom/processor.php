<?php
ob_start();
for($i=1;$i<=5;$i++) {
    
    for($j=1; $j<=17; $j++) {
        echo "\t\t[\n";
        echo "\t\t\t'role_id' => {$i},\n";
        echo "\t\t\t'permission_id' => {$j},\n";
        echo "\t\t\t'activated' => 1,\n";
        echo "\t\t\t'created_at' => date(\"Y-m-d H:i:s\"),\n";
        echo "\t\t\t'updated_at' => date(\"Y-m-d H:i:s\"),\n";
        echo "\t\t],\n";
    }
    
}
$text = ob_get_clean();
file_put_contents("pedro.txt", $text);
