<?php

/**
 * 本脚本用于包含public目录中的公共实体类，减少代码重复
*/

AiCore::parseXxxFormatFromDirAndAutoIncludeTheir('../public/'.ENTITY_DIR, 'entity');
