<?php

namespace Sprint\Migration;


class PrivateSection20260708131500 extends Version
{
    protected $author = "admin";

    protected $description = "Поле приватного раздела";

    protected $moduleVersion = "5.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'IBLOCK_catalog:gallery_SECTION',
  'FIELD_NAME' => 'UF_PRIVATE',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => '',
      1 => '',
    ),
    'LABEL_CHECKBOX' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Скрыть товара раздела в родительских разделах',
    'ru' => 'Скрыть товара раздела в родительских разделах',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Скрыть товара раздела в родительских разделах',
    'ru' => 'Скрыть товара раздела в родительских разделах',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Скрыть товара раздела в родительских разделах',
    'ru' => 'Скрыть товара раздела в родительских разделах',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
    }

}
