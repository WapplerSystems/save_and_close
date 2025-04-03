
class SaveAndClose {
  constructor () {
    // I have added the data-js attribute to the button so I can select it like that
    this.button = document.querySelector('[data-js=save-and-close-button]')
    if (this.button) {
      import('@typo3/backend/form-engine.js').then((form) => {
        this.button.addEventListener('click', (e) => {
          e.preventDefault()
          const FormEngine = form.default;
          FormEngine.saveAndCloseDocument()
        })
      })
    }
  }
}

export default new SaveAndClose()
