<?php

/**
 * Example module.
 */

declare(strict_types=1);

namespace ExampleNamespace;

use Fisharebest\Webtrees\Contracts\ElementInterface;
use Fisharebest\Webtrees\Elements\AddressWebPage;
use Fisharebest\Webtrees\Elements\CustomElement;
use Fisharebest\Webtrees\Elements\EmptyElement;
use Fisharebest\Webtrees\Elements\NameOfRepository;
use Fisharebest\Webtrees\Elements\SourceDescriptiveTitle;
use Fisharebest\Webtrees\Elements\SubmitterText;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTagsInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTagsTrait;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;

/**
 * Class ExampleModuleCustomTags
 *
 * This example shows how to create a custom module.
 * All the functions are optional.  Just implement the ones you need.
 *
 * Modules *must* implement ModuleCustomInterface.  They *may* also implement other interfaces.
 */
class ExampleModuleCustomTags extends AbstractModule implements ModuleCustomTagsInterface, ModuleCustomInterface
{
    // For every module interface that is implemented, the corresponding trait *should* also use be used.
    use ModuleCustomTrait;
    use ModuleCustomTagsTrait;

    /**
     * How should this module be identified in the control panel, etc.?
     *
     * @return string
     */
    public function title(): string
    {
        return I18N::translate('Custom tags');
    }

    /**
     * A sentence describing what this module does.
     *
     * @return string
     */
    public function description(): string
    {
        return I18N::translate('This module provides some custom tags');
    }

    /**
     * The person or organisation who created this module.
     *
     * @return string
     */
    public function customModuleAuthorName(): string
    {
        return 'Greg Roach';
    }

    /**
     * The version of this module.
     *
     * @return string
     */
    public function customModuleVersion(): string
    {
        return '1.0.0';
    }

    /**
     * A URL that will provide the latest version of this module.
     *
     * @return string
     */
    public function customModuleLatestVersionUrl(): string
    {
        return 'https://github.com/webtrees/example-module-custom-tags/raw/main/latest-version.txt';
    }

    /**
     * Where to get support for this module.  Perhaps a github repository?
     *
     * @return string
     */
    public function customModuleSupportUrl(): string
    {
        return 'https://github.com/webtrees/example-module-custom-tags';
    }

    /**
     * Additional/updated translations.
     *
     * @param string $language
     *
     * @return array<string>
     */
    public function customTranslations(string $language): array
    {
        switch ($language) {
            case 'fr':
            case 'fr-CA':
                return [
                    'Mother tongue' => 'Langue maternelle',
                ];

            default:
                return [];
        }
    }

    /**
     * @return array<string,ElementInterface>
     */
    public function customTags(): array
    {
        return [
            'FAM:DATA'       => new EmptyElement(I18N::translate('Data'), ['TEXT' => '0:1']),
            'FAM:TEXT'       => new SubmitterText(I18N::translate('Text')),
            'INDI:COMM'      => new CustomElement(I18N::translate('Comment'), ['URL' => '0:1']),
            'INDI:COMM:URL'  => new AddressWebPage(I18N::translate('URL')),
            'INDI:DATA'      => new EmptyElement(I18N::translate('Data'), ['TEXT' => '0:1']),
            'INDI:DATA:TEXT' => new SubmitterText(I18N::translate('Text')),
            'INDI:_MTNG'     => new CustomElement(I18N::translate('Mother tongue')),
            'SOUR:AUTH:NOTE' => new SubmitterText(I18N::translate('Note')),
            'REPO:NAME:_HEB' => new NameOfRepository(I18N::translate('Hebrew name')),
            'SOUR:TITL:_HEB' => new SourceDescriptiveTitle(I18N::translate('Hebrew title')),
        ];
    }

    /**
     * @return array<string,array<int,array<int,string>>>
     */
    public function customSubTags(): array
    {
        return [
            'FAM'       => [['DATA', '0:M']],
            'INDI'      => [['_MTNG', '0:1'], ['COMM', '0:M'], ['DATA', '0:M']],
            'REPO:NAME' => [['_HEB', '0:1']],
            'SOUR:TITL' => [['_HEB', '0:1']],
        ];
    }
}
