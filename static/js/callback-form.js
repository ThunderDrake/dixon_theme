document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#callback_form')) {
        const validation = new JustValidate('#callback_form');
        const inputMask = new Inputmask('+7 (999) 999-99-99');

        inputMask.mask(document.querySelector('.form__input--phone'));
        validation
            .addField('.form__input--name', [{
                    rule: 'minLength',
                    value: 3,
                },
                {
                    rule: 'maxLength',
                    value: 30,
                },
                {
                    rule: 'required',
                    errorMessage: 'Имя обязательно для заполнения',
                },
            ])
            .addField('.form__input--phone', [{
                    rule: 'required',
                    errorMessage: 'Телефон обязателен для заполнения',
                },
                {
                    rule: 'function',
                    validator: function () {
                        const phone = document.querySelector('.form__input--phone').inputmask.unmaskedvalue();
                        return phone.length === 10;
                    },
                    errorMessage: 'Введите корректный номер телефона'
                },
            ])
            .addField('.form__input--policy', [{
                rule: 'required',
                errorMessage: 'Нужно принять политику персональных данных',
            }, ])

        validation.onSuccess((ev) => {
            let formData = new FormData(ev.target);
            formData.append('action', 'callback_form_action');
            formData.append('nonce', callback_form_object.nonce);
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        document.querySelector('#callback_form .form__button').textContent = 'Отправлено!';
                        setTimeout(() => {
                            document.querySelector('#callback_form .form__button').textContent = 'Оставить заявку';
                        }, 3000)
                        console.log('Отправлено');
                    }
                }
            }

            xhr.open('POST', callback_form_object.url, true);
            xhr.send(formData);

            ev.target.reset();
        })
    }

    if (document.querySelector('#callback_form_home')) {
        const validation = new JustValidate('#callback_form_home');
        const inputMask = new Inputmask('+7 (999) 999-99-99');

        inputMask.mask(document.querySelector('.form__input--phone'));
        validation
            .addField('.form__input--name', [{
                    rule: 'minLength',
                    value: 3,
                },
                {
                    rule: 'maxLength',
                    value: 30,
                },
                {
                    rule: 'required',
                    errorMessage: 'Имя обязательно для заполнения',
                },
            ])
            .addField('.form__input--phone', [{
                    rule: 'required',
                    errorMessage: 'Телефон обязателен для заполнения',
                },
                {
                    rule: 'function',
                    validator: function () {
                        const phone = document.querySelector('.form__input--phone').inputmask.unmaskedvalue();
                        return phone.length === 10;
                    },
                    errorMessage: 'Введите корректный номер телефона'
                },
            ])

        validation.onSuccess((ev) => {
            let formData = new FormData(ev.target);
            formData.append('action', 'callback_form_action');
            formData.append('nonce', callback_form_object.nonce);
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        document.querySelector('#callback_form_home .form__button').textContent = 'Отправлено!';
                        setTimeout(() => {
                            document.querySelector('#callback_form_home .form__button').textContent = 'Оставить заявку';
                        }, 3000)
                        console.log('Отправлено');
                    }
                }
            }

            xhr.open('POST', callback_form_object.url, true);
            xhr.send(formData);

            ev.target.reset();
        })
    }

    if(document.querySelector('#register_form')) {
        const inputMask = new Inputmask('+7 (999) 999-99-99');
        inputMask.mask(document.querySelector('.form__input--phone'));
    }
})