
class SaveAndClose {
  constructor () {
    this.initDocHeaderButton()
    this.initContextualEditButton()
  }

  initDocHeaderButton () {
    const button = document.querySelector('[data-js=save-and-close-button]')
    if (button) {
      import('@typo3/backend/form-engine.js').then((form) => {
        button.addEventListener('click', (e) => {
          e.preventDefault()
          form.default.saveAndCloseDocument()
        })
      })
    }
  }

  initContextualEditButton () {
    const actionsContainer = document.querySelector('.contextual-record-edit-actions')
    if (!actionsContainer) return

    const saveButton = actionsContainer.querySelector('[name="_savedok"]')
    const closeButton = actionsContainer.querySelector('.t3js-contextual-close')
    if (!saveButton || !closeButton) return

    import('@typo3/backend/form-engine.js').then((form) => {
      const btn = document.createElement('button')
      btn.type = 'button'
      btn.className = 'btn btn-default'

      const iconEl = saveButton.querySelector('typo3-backend-icon')
      const iconHtml = iconEl
        ? '<typo3-backend-icon identifier="actions-document-save-close" size="small"></typo3-backend-icon>'
        : ''
      const closeLabel = closeButton.querySelector('.contextual-record-edit-button-label')?.textContent?.trim() || ''
      const saveLabel = saveButton.querySelector('.contextual-record-edit-button-label')?.textContent?.trim() || ''
      const label = saveLabel && closeLabel ? saveLabel + ' & ' + closeLabel : 'Save & Close'

      btn.innerHTML = iconHtml + '<span class="contextual-record-edit-button-label">' + label + '</span>'
      btn.addEventListener('click', (e) => {
        e.preventDefault()
        form.default.saveAndCloseDocument()
      })
      closeButton.before(btn)
    })
  }
}
export default new SaveAndClose()