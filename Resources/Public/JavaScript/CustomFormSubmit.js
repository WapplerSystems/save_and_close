let form = document.getElementById('EditDocumentController');
if (form) {
  form.addEventListener('submit', (event) => {

    if (event.submitter.name === '_saveandclosedok') {

      let closeDocInput = form.querySelector('input[name="closeDoc"]');
      if (closeDocInput) {
        closeDocInput.value = '1';
      }
      let doSaveInput = form.querySelector('input[name="doSave"]');
      if (doSaveInput) {
        doSaveInput.value = '1';
      }

    }

  });
}


