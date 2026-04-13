# Save and Close for TYPO3

Adds the "Save and close" button back to the TYPO3 backend. The button was removed from core in TYPO3 v12 but is still useful for editors who want to save a record and immediately return to the previous view.

![TYPO3](https://img.shields.io/badge/TYPO3-14-orange)
![License](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)

## Installation

```bash
composer require wapplersystems/save_and_close
```

## Requirements

- TYPO3 v14
- PHP 8.2+

## What it does

The extension adds a "Save and close" button to the button bar of every record editing form in the TYPO3 backend. Clicking it saves the current record and redirects back to the previous module view — just like the old core button did.

No configuration needed. Install the extension and the button appears automatically.

## License

GPL-2.0-or-later