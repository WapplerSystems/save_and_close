<?php

namespace WapplerSystems\SaveAndClose\EventListener;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\ModifyButtonBarEvent;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;

class AddButton
{
    /**
     * @param ModifyButtonBarEvent $event
     */
    public function __invoke(ModifyButtonBarEvent $event): void {

        $showSaveAndView = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('save_and_close', 'saveAndView');
        $showSaveAndClose = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('save_and_close', 'saveAndClose');
        $showSaveAndNew = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('save_and_close', 'saveAndNew');


        $buttons = $event->getButtons();
        $buttonBar = $event->getButtonBar();
        $saveButton = $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][0] ?? null;
        if ($saveButton instanceof InputButton) {
            /** @var IconFactory $iconFactory */
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);

            if ($showSaveAndClose === '1') {
                $saveCloseButton = $buttonBar->makeInputButton()
                    ->setName('_saveandclosedok')
                    ->setValue('1')
                    ->setForm($saveButton->getForm())
                    ->setTitle($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:rm.saveCloseDoc'))
                    ->setIcon($iconFactory->getIcon('actions-document-save-close', Icon::SIZE_SMALL))
                    ->setShowLabelText(true);
                $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][] = $saveCloseButton;
            }

            if ($showSaveAndView === '1') {
                $saveViewButton = $buttonBar->makeInputButton()
                    ->setName('_savedokview')
                    ->setValue('1')
                    ->setForm($saveButton->getForm())
                    ->setTitle($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:rm.saveDocShow'))
                    ->setIcon($iconFactory->getIcon('actions-document-save-view', Icon::SIZE_SMALL))
                    ->setShowLabelText(true);
                $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][] = $saveViewButton;
            }

            if ($showSaveAndNew === '1') {
                $saveViewButton = $buttonBar->makeInputButton()
                    ->setName('_savedoknew')
                    ->setValue('1')
                    ->setForm($saveButton->getForm())
                    ->setTitle($this->getLanguageService()->sL('LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:rm.saveNewDoc'))
                    ->setIcon($iconFactory->getIcon('actions-document-save-new', Icon::SIZE_SMALL))
                    ->setShowLabelText(true);
                $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][] = $saveNewButton;
            }
        }
        $event->setButtons($buttons);

    }

    /**
     * Returns the language service
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}
