(function() {
  let $forms = [
    id('index-contacts-form')
  ];
  const cvForms = qa('.cv-popup__form, .contact-popup__form', document.body, true);
  if (cvForms) {
    $forms = $forms.concat(cvForms);
  }
  const patterns = {
    tel: /\+7\([0-9]{3}\)[0-9]{3}\-[0-9]{2}\-[0-9]{2}/,
    email: /^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z])+$/,
    msg: /[^\<\>\[\]%\&'`]+$/
  };

  const formValidator = function(params) {
    const $form = params.form;
    const $formBtn = params.formBtn;
    const $uploadFilesBlock = params.uploadFilesBlock;
    const errorsClass = "invalid";
    const defaultError = "Field error";
    const errorsTag = "p";
    // Rules from jquery.validate
    const rules = {
      file: {
        required: true
      },
      name: {
        required: true,
      },
      tel: {
        required: true,
        // pattern: patterns.tel,
        // or: 'email'
      },
      email: {
        required: true,
        pattern: patterns.email,
        // or: 'tel'
      },
      msg: {
        required: true,
        pattern: patterns.msg,
      },
      policy: {
        required: true,
      },
    };
    const messages = {
      file: {
        required: 'Upload your CV'
      },
      tel: {
        // required: 'Введите ваш телефон или E-mail',
        required: "Enter your phone",
        // pattern: "Укажите верный телефон",
      },
      name: {
        required: "Enter your name",
      },
      email: {
        // required: 'Введите ваш E-mail или телефон',
        required: "Enter your E-mail",
        pattern: "Invalid E-mail",
      },
      msg: {
        required: "Type a message",
        pattern: "Invalid message",
      },
      policy: {
        required: "Accept privacy policy",
      }
    };

    const initValidator = function() {
      const $formElements = $form.elements;
      $form.setAttribute("novalidate", "");
      $form.validatie = false;

      if ($formBtn) {
        $formBtn.addEventListener("click", function(e) {
          if ($form.file && $form.file.multiple) {
            if (!$form['file[]']) {
              $form.file.removeAttribute('data-value');
            }

            $form.file.value = '';
            // check filetypes
            // if ($form.file.value) {
            // let fileTypes = $form.file.getAttribute('data-type');
            // if (fileTypes) {
            // fileTypes = fileTypes.split('|');
            // }
            // }
          }
          validationForm();

          if ($form.validatie === false) {
            e.preventDefault();
          } else {
            $form.classList.add("loading");
            $formBtn.blur();
            $form.blur();
            $form.removeEventListener("change", validationForm);
            $form.removeEventListener("input", validationForm);
          }
        });
      }
      if (!document.wpcf7submit) {
        document.addEventListener("wpcf7submit", submitHandler);
        document.wpcf7submit = true;
      }

      $form.addEventListener("input", toggleInputsClass);

      const fileInput = q('[type="file"]', $form);

      if (fileInput) {
        $form.file = fileInput;
        $form.elements.file = fileInput;
        if (fileInput.multiple) {
          $form.addEventListener('click', function(e) {
            const target = e.target;
            const parent = target.closest('.remove-file');
            if (parent) {
              if (!$form['file[]']) {
                $form.file.removeAttribute('data-value');
              }
            }
          });
        }
      }

    };

    /**
     * Function searches only for the elements that are specified in the rules.
     * @param {HTMLFormElement} $form
     * @returns {object} {fieldName: fieldValue}
     */
    const getFormData = function($form) {
      const formElements = $form.elements;
      const data = {};

      for (const formElementName in rules) {
        const formElement = formElements[formElementName];

        if (formElement) {
          // const formElementEndingRule = rules[formElementName].ending || formElement.getAttribute('data-ending');
          if (formElement.type === 'file' && formElement.multiple) {
            const multifileField = formElements['file[]'];
            if (multifileField) {
              let multifileFieldValue = [];
              if (multifileField.constructor === HTMLInputElement) {
                multifileFieldValue = multifileField.value;
              } else {
                for (let i = 0, len = multifileField.length; i < len; i++) {
                  multifileFieldValue[multifileFieldValue.length] = multifileField.value;
                }
                if (multifileFieldValue) {
                  multifileFieldValue = multifileFieldValue.join();
                } else {
                  multifileFieldValue = '';
                }
              }
              formElement.setAttribute('data-value', multifileFieldValue);
            }
          }
          let formElementValue = formElement.value || formElement.getAttribute('data-value') || '';

          // if (formElementEndingRule) {
          // formElementValue = formElementValue.replace(formElementEndingRule, '');
          // }

          data[formElementName] = formElementValue;
        }
      }

      // console.log(data);

      return data;
    };

    /**
     * Function of validating form.
     * @description Show or hide errors, set form.validate to true or false
     */
    const validationForm = function() {
      // console.log('validationForm');
      const errors = {};
      const thisForm = $form;
      const values = getFormData(thisForm);
      const setErrorMessage = function($formElement, elementName, messageType) {
        errors[elementName] = messages[elementName][messageType] || $formElement.getAttribute('data-message-' + messageType) || defaultError;
      };

      for (const elementName in values) {
        const rule = rules[elementName];
        const $formElement = thisForm[elementName];
        const elementValue = values[elementName];
        const elementValueLength = elementValue.length;
        const or = rule.or;
        const $orFormElement = thisForm[or];

        if (rule) {
          if ($formElement.hasAttribute("required") || rule.required === true) {
            const elementType = $formElement.type;
            const pattern = rule.pattern;
            const min = +(rule.min || $formElement.getAttribute('min'));
            const max = +(rule.max || $formElement.getAttribute('max'));
            const minlength = rule.minlength || +$formElement.getAttribute('minlength');
            const maxlength = rule.maxlength || +$formElement.getAttribute('maxlength');
            const isCheckboxOrRadio = elementType === "checkbox" || elementType === "radio";
            const isNumberOrRange = elementType === "number" || elementType === "range";

            // Validation multifile
            // if (elementType === 'file' && $formElement.multiple) {
            //   if ($form['file[]'] && $formElement.hasAttribute('data-value')) {
            //     hideError($formElement);
            //   }
            // }

            // Validation required
            if ((isCheckboxOrRadio && !$formElement.checked) || elementValue === "") {
              if (or && $orFormElement) {
                if ($orFormElement.value === "") {
                  setErrorMessage($formElement, elementName, 'required');
                  continue;
                }
              } else {
                setErrorMessage($formElement, elementName, 'required');
                continue;
              }
            }

            // Validation min & max
            if (isNumberOrRange) {
              if (min && elementValue < min) {
                setErrorMessage($formElement, elementName, 'min');
                continue;
              }
              if (max && elementValue > max) {
                setErrorMessage($formElement, elementName, 'max');
                continue;
              }
            }

            // Validation minlength & maxlength
            if (elementType === "text" || elementType === "password" || $formElement.tagName === "TEXTAREA") {
              if (minlength && elementValueLength < minlength) {
                setErrorMessage($formElement, elementName, 'minlength');
                continue;
              }
              if (maxlength && elementValueLength > maxlength) {
                setErrorMessage($formElement, elementName, 'maxlength');
                continue;
              }
            }

            // Validation pattern
            if (!isCheckboxOrRadio && pattern) {
              if (elementValue !== "" && pattern.test(elementValue) === false) {
                setErrorMessage($formElement, elementName, 'pattern');
                continue;
              }
            }

            hideError($formElement);
          }
        }
      }

      if (Object.keys(errors).length == 0) {
        // thisForm.removeEventListener("change", validationForm);
        // thisForm.removeEventListener("input", validationForm);
        $form.validatie = true;
      } else {
        thisForm.addEventListener("change", validationForm);
        thisForm.addEventListener("input", validationForm);
        showErrors(thisForm, errors);
        $form.validatie = false;
      }
    };

    const showErrors = function($parent, errors) {
      let $formElements;
      if ($parent.constructor === HTMLFormElement) {
        $formElements = $parent.elements;
      } else {

      }

      for (const elementName in errors) {
        const errorText = errors[elementName] || defaultError;
        const $errorElement = `<${errorsTag} class="${errorsClass}">${errorText}</${errorsTag}>`;
        const $formElement = $formElements[elementName];
        const $nextElement = $formElement.nextElementSibling;

        if ($nextElement && $nextElement.classList.contains(errorsClass)) {
          if ($nextElement.textContent !== errorText) {
            $nextElement.textContent = errorText;
          }
          continue;
        } else {
          $formElement.insertAdjacentHTML("afterend", $errorElement);
        }

        $formElement.classList.add(errorsClass);
      }
    };

    const hideError = function($formElement) {
      const $nextElement = $formElement.nextElementSibling;
      $formElement.classList.remove(errorsClass);
      if ($nextElement && $nextElement.classList.contains(errorsClass)) {
        $nextElement.parentElement.removeChild($nextElement);
      }
    };

    const submitHandler = function(event) {
      console.log(event);
      const $form = q("#" + event.detail.id + ">form") || event.target;
      const eventType = event.type;
      const parentPopup = $form.closest('.popup') || $form.closest('.index-contacts');

      if ($form.tagName !== 'FORM') {
        $form = q('form', $form);
      }

      if ($form.classList.contains('sent')) {
        $form.reset();

        const $formElements = $form.elements;

        for (let i = 0, len = $formElements.length; i < len; i++) {
          hideError($formElements[i]);
          $formElements[i].classList.remove("filled");
        }

        // if ($uploadFilesBlock) {
        //   $uploadFilesBlock.innerHTML = "";
        // }
        // if ($form === $quizForm) {
        //   id('quiz').resetQuiz();
        // }

        // setTimeout(function() {
        //   $form.classList.remove("sent");
        // }, 3000);

        // thanksPopup.openPopup();
        // thanksPopupTimer = setTimeout(function() {
        //   thanksPopup.closePopup();
        // }, 3000);

        if (parentPopup) {
          parentPopup.classList.add('success');
          parentPopup.addEventListener('click', function(e) {
            if (e.target.classList.contains('success-block__btn')) {
              parentPopup.classList.remove('success');
            }
          });
        }

        console.log("sent");
      } else if ($form.classList.contains('failed')) {
        if (parentPopup) {
          parentPopup.classList.add('fail');
          parentPopup.addEventListener('click', function(e) {
            if (e.target.classList.contains('fail-block__btn')) {
              parentPopup.classList.remove('fail');
            }
          });
        }
        console.log("fail");
      }

      $form.classList.remove("loading");

    };

    const toggleInputsClass = function(e) {
      // console.log('toggleInputsClass');
      const $input = e.target;
      const type = $input.type;
      const files = $input.files;
      const value = $input.value;

      switch (type) {
        case 'text':
        case 'email':
        case 'tel':
        case 'number':
          $input.classList.toggle('filled', value !== '');
          break;
        case 'file':
          let uploadedFiles = "";
          for (let i = 0, len = files.length; i < len; i++) {
            uploadedFiles +=
              '<span class="uploadedfiles__file"><span class="uploadedfiles__file-text">' +
              files[i].name +
              "</span></span>";
          }
          // if ($uploadFilesBlock) {
          //   $uploadFilesBlock.innerHTML = uploadedFiles;
          // }
          break;
        default:
          if ($input.tagName === 'TEXTAREA') {
            $input.classList.toggle('filled', value !== '');
          }
          break;
      }
    };

    initValidator();
  };

  for (let i = $forms.length - 1; i >= 0; i--) {
    const form = $forms[i];
    if (form) {
      const formBtn = q(".btn", form) || q('.btn[form="' + form.id + '"]');
      if (form) {
        formValidator({
          form: form,
          formBtn: formBtn,
          uploadFilesBlock: q(".files-upload-block", form),
          filesInput: q('input[type="file"]', form)
        });
      }
    }
  }
})();