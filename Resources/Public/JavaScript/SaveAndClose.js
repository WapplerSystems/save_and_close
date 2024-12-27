import FormEngine from '@typo3/backend/form-engine.js'

class SaveAndClose {
  constructor () {
    // I have added the data-js attribute to the button so I can select it like that
    this.button = document.querySelector('[data-js=save-and-close-button]')
    this.#addEvents()
  }

  #addEvents () {
    this.button?.addEventListener('click', (e) => {
      e.preventDefault()
      FormEngine.saveAndCloseDocument()
    })
  }
}

export default new SaveAndClose()
