<?php

return array_replace_recursive(
    array(
        'yii.debug' => true,
        'yii.trace_level' => 3,
    ),
    (file_exists(__DIR__ . '/overrides/params.php') ? require(__DIR__ . '/overrides/params.php') : array())
);