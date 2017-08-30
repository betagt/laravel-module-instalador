<?php

namespace Betagt\LaravelModuleInstaller;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class LaravelModuleInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $name = $package->getPrettyName();
        $split = explode("/", $name);

        if (count($split) !== 2) {
            throw new \Exception("Ensure your package's name is in 1 ".json_encode($split)." the format <vendor>/<name>-<module>");
        }

        $nameToUse = $split[1];
        $splitNameToUse = preg_split('/[-_]/',$nameToUse);
		$text = "";
        if (count($splitNameToUse) > 1) {
            foreach($splitNameToUse as $v){
				$text .= ucfirst($v);
			}
        }else{
			$text = ucfirst($splitNameToUse[0]);
			
		}

        return 'Modules/' . $text;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'laravel-module' === $packageType;
    }
}
