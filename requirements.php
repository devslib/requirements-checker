<?php

$requiredExtensions = [
    'http',
    'httpd',
    'fileinfo',
    'bcmath',
    'mbstring'
];

$requiredFunctions = [
    'file_get_contents',
    'file_put_contentss',
    'file_put_contentssss'
];

$requiredPhpVersion = '7.4.5';

// Check extensions
$extensions = [];
$missingExtensions = [];

foreach($requiredExtensions as $e){
    if(extension_loaded($e)) $extensions[$e] = true;
    else{
        $extensions[$e] = false;
        $missingExtensions[] = $e;
    }
}

// Check functions
$functions = [];
$missingFunctions = [];

foreach($requiredFunctions as $f){
    if(function_exists($f)) $functions[$f] = true;
    else {
        $functions[$f] = false;
        $missingFunctions[] = $f;
    }
}

// Check PHP version
$phpVersion = version_compare(phpversion(), $requiredPhpVersion) >= 0;


function __($string){
    echo $string;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Requirements</title>
    <link href="tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-mono overflow-hidden">
            <div class="w-full lg:w-3/6 sm:w-5/6 xs:w-11/12">
                <div class="text-center my-5">
                    <h1 class="font-sans font-bold text-lg text-gray-600">Requirement Checker</h1>
                </div>
                <div class="rounded my-6">
                    <table class="bg-white shadow-md min-w-max w-full table-auto mb-5">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left font-sans" colspan="2">PHP Version</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <span>Minimum required</span>
                                    <span class="bg-blue-200 text-blue-800 py-1 px-3 rounded-full font-bold"><?php __($requiredPhpVersion) ?></span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span>Installed</span>
                                    <span class="<?php echo $phpVersion ? "bg-green-200 text-green-800" : "bg-red-200 text-red-800" ?> py-1 px-3 rounded-full font-bold"><?php __(phpversion()) ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if(!empty($extensions)) : ?>
                    <table class="bg-white shadow-md min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left font-sans" colspan="2">
                                    <div class="flex justify-between">
                                        <div class="block w-2/1">
                                            <span>Extensions</span>
                                        </div>
                                        <div class="block w-2/1" title="<?php __(count($missingExtensions) . " extension(s) missing") ?>">
                                            <?php echo count($extensions) - count($missingExtensions) . "/" .  count($extensions); ?>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <?php foreach($extensions as $e => $installed) : ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        <span><?php __($e) ?></span>
                                    </td>
                                    <td class="py-3 px-6">
                                        <span class="<?php echo $installed ? "bg-green-200 text-green-600" : "bg-red-200 text-red-600" ?> py-1 px-3 rounded-full text-xs">
                                            <?php echo $installed ? "Installed" : "Not installed"; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left text-center" colspan="2">
                                    <div class="font-sans font-normal">Missing extension<?php echo count($missingExtensions) > 1 ? 's':'' ?>: 
                                        <?php 
                                            echo implode(", ", $missingExtensions);
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php endif; ?>

                    <?php if(!empty($functions)) : ?>
                    <table class="bg-white shadow-md min-w-max w-full table-auto mt-5">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left font-sans" colspan="2">
                                    <div class="flex justify-between">
                                        <div class="block w-2/1">
                                            <span>Functions</span>
                                        </div>
                                        <div class="block w-2/1" title="<?php __(count($missingFunctions) . " functions(s) missing") ?>">
                                            <?php echo count($functions) - count($missingFunctions) . "/" .  count($functions); ?>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <?php foreach($functions as $f => $enabled) : ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        <span><?php __($f) ?></span>
                                    </td>
                                    <td class="py-3 px-6">
                                        <span class="<?php echo $enabled ? "bg-green-200 text-green-600" : "bg-red-200 text-red-600" ?> py-1 px-3 rounded-full text-xs">
                                            <?php echo $enabled ? "Enabled" : "Disabled"; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left text-center" colspan="2">
                                    <div class="font-sans font-normal">Missing function<?php echo count($missingFunctions) > 1 ? 's':'' ?>: 
                                        <?php 
                                            echo implode(", ", $missingFunctions);
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
