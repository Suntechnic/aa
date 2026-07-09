<?php
namespace App\Gallery;

class Sections
{
    public static function getPrivateSectionsId (?string $ExcludeSectionCode=null): array
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        // получим ID разделов у которых установлена галочка UF_PRIVATE
        $arFilter = [
                'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
                'ACTIVE' => 'Y',
                'UF_PRIVATE' => 1
            ];
        if ($ExcludeSectionCode) $arFilter['!CODE'] = $ExcludeSectionCode;

        $arSelect = ['ID'];
        $arSections = \CIBlockSection::GetList([], $arFilter, false, $arSelect);
        $arSectionsId = [];
        while ($arSection = $arSections->GetNext()) {
            $arSectionsId[] = $arSection['ID'];
        }

        return $arSectionsId;
    }


    /**
     * Возвращает путь из секций
     * @param int $SectionId - ID раздела
     */
    private static $_memoizing = [];
    public static function getPath (int $SectionId): array
    {
        if (!self::$_memoizing['getSectionsPath:'.$SectionId]) {
            $lstSection = [];
            \Bitrix\Main\Loader::includeModule('iblock');
            while ($SectionId) {
                if ($dctSection = \CIBlockSection::GetList([], 
                        ['ID' => $SectionId,'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery')],
                        false,
                        ['ID', 'IBLOCK_ID','IBLOCK_SECTION_ID', 'NAME', 'SECTION_PAGE_URL', 'CODE']
                    )->getNext()) {
                    $lstSection[] = $dctSection;
                }
                $SectionId = $dctSection['IBLOCK_SECTION_ID'];
            }
            self::$_memoizing['getSectionsPath:'.$SectionId] = array_reverse($lstSection);
        }
        return self::$_memoizing['getSectionsPath:'.$SectionId];
    }
}