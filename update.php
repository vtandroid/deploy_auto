<?php

	$cmd="mkdir tmp;cd tmp;wget https://github.com/vtandroid/deploy_auto/archive/dev1.zip;unzip -o dev1.zip;cp -r deploy_auto-dev1/* ../;cd ..;rm -rf tmp;";
	echo shell_exec($cmd);
?>