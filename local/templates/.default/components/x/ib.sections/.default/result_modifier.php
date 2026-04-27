<?

foreach ($arResult['ITEMS'] as $i=>&$dctItem) {
    if (isset($dctItem['PICTURE']) && $dctItem['PICTURE'] > 0) {
        $dctItem['PICTURE'] = \CFile::GetFileArray($dctItem['PICTURE']);
        $dctItem['PICTURE']['SRC_MOBILE'] = \CFile::ResizeImageGet(
                $dctItem['PICTURE'],
                ['width' => 193, 'height' => 193],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            )['src'];
    }
}

