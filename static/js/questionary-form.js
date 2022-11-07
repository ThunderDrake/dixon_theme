document.addEventListener('DOMContentLoaded', ()=>{
    if(document.querySelector('#questionary_form')) {
    const validation = new JustValidate('#questionary_form');
    
    const inputMask = new Inputmask('+7 (999) 999-99-99');
    const dateMask = new Inputmask('99.99.9999');
    inputMask.mask(document.querySelector('.questionary__input--phone'));
    dateMask.mask(document.querySelector('.questionary__input--birthday'));
    dateMask.mask(document.querySelector('.questionary__input--education-end'));
    validation
    .addField('.questionary__input--name', [
        {
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
    .addField('.questionary__input--phone', [
        {
        rule: 'required',
        errorMessage: 'Телефон обязателен для заполнения',
        },
        {
        rule: 'function',
        validator: function() {
            const phone = document.querySelector('.questionary__input--phone').inputmask.unmaskedvalue();
            return phone.length === 10;
        },
        errorMessage: 'Введите корректный номер телефона'
        },
    ])
    .addField('.questionary__input--birthday', [
        {
        rule: 'required',
        errorMessage: 'Введите дату рождения',
        },
        {
        rule: 'function',
        validator: function() {
            const phone = document.querySelector('.questionary__input--birthday').inputmask.unmaskedvalue();
            return phone.length === 8;
        },
        errorMessage: 'Введите дату рождения'
        },
    ])
    .addField('.questionary__input--citizenship', [
        {
        rule: 'minLength',
        value: 3,
        },
        {
        rule: 'maxLength',
        value: 30,
        },
        {
        rule: 'required',
        errorMessage: 'Гражданство обязательно для заполнения',
        },
    ]);
    validation.onSuccess((ev) => {
    let formData = new FormData(ev.target);
    formData.append('action', 'questionary_form_action');
    formData.append('nonce', questionary_form_object.nonce);
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            document.querySelector('#questionary_form .questionary__submit').textContent = 'Отправлено!';
            setTimeout(()=>{
                document.querySelector('#questionary_form .questionary__submit').textContent = 'Отправить заявку'
            }, 3000)
            console.log('Отправлено');
        }
        }
    }

    xhr.open('POST', questionary_form_object.url, true);
    xhr.send(formData);

    ev.target.reset();
    })
}
})
