<?php

namespace WapplerSystems\SaveAndClose\EventListener;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\ModifyButtonBarEvent;
use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Imaging\IconSize;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Page\PageRenderer;

final readonly class SaveCloseButtonEventListener
{
    public function __construct(
        private IconFactory $iconFactory,
        private PageRenderer $pageRenderer,
    ) {}

    public function __invoke(ModifyButtonBarEvent $event): void
    {
        $buttons = $event->getButtons();
        $buttonBar = $event->getButtonBar();
        $saveButton = $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][0] ?? null;

        if ($saveButton instanceof InputButton) {
            $title = $this->getLanguageService()?->sL(
                'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:rm.saveCloseDoc'
            ) ?? 'Save and close';

            $saveCloseButton = $buttonBar->makeInputButton()
                ->setName('_saveandclosedok')
                ->setValue('1')
                ->setForm($saveButton->getForm())
                ->setDataAttributes([
                    'js' => 'save-and-close-button',
                ])
                ->setTitle($title)
                ->setIcon($this->iconFactory->getIcon('actions-document-save-close', IconSize::SMALL))
                ->setShowLabelText(true);

            $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][] = $saveCloseButton;
        }

        $this->pageRenderer->loadJavaScriptModule('@save_and_close/form/backend/SaveAndClose.js');

        $event->setButtons($buttons);
    }

    private function getLanguageService(): ?LanguageService
    {
        return $GLOBALS['LANG'] ?? null;
    }
}