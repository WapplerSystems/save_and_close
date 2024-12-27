<?php

namespace WapplerSystems\SaveAndClose\EventListener;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\ModifyButtonBarEvent;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Imaging\IconSize;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;

final class SaveCloseButtonEventListener
{
    public function __invoke(ModifyButtonBarEvent $event): void
    {
        $buttons = $event->getButtons();
        $buttonBar = $event->getButtonBar();
        $saveButton = $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][0] ?? null;

        if ($saveButton instanceof InputButton) {
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
            $language = $this->getLanguageService();
            $title = $language ? $language->sL(
                'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:rm.saveCloseDoc'
            ) : 'save';

            $saveCloseButton = $buttonBar->makeInputButton()
                ->setName('_saveandclosedok')
                ->setValue('1')
                ->setForm($saveButton->getForm())
                ->setDataAttributes([
                    'js' => 'save-and-close-button',
                ])
                ->setTitle($title)
                ->setIcon($iconFactory->getIcon('actions-document-save-close', IconSize::SMALL))
                ->setShowLabelText(true);

            $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][] = $saveCloseButton;
        }

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->loadJavaScriptModule('@save_and_close/form/backend/SaveAndClose.js');

        $event->setButtons($buttons);
    }

    protected function getLanguageService(): ?LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
