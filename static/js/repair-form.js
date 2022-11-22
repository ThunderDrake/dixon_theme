document.addEventListener('DOMContentLoaded', ()=>{
    if(document.querySelector('#repair_form')) {
    const validation = new JustValidate('#repair_form');
    
    const inputMask = new Inputmask('+7 (999) 999-99-99');
    
    inputMask.mask(document.querySelector('.repair__form-field-input--phone'));
    validation
    .addField('.repair__form-field-input--name', [
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
    .addField('.repair__form-field-input--phone', [
        {
        rule: 'required',
        errorMessage: 'Телефон обязателен для заполнения',
        },
        {
        rule: 'function',
        validator: function() {
            const phone = document.querySelector('.repair__form-field-input--phone').inputmask.unmaskedvalue();
            return phone.length === 10;
        },
        errorMessage: 'Введите корректный номер телефона'
        },
    ])

    validation.onSuccess((ev) => {
    let formData = new FormData(ev.target);
    formData.append('action', 'repair_form_action');
    formData.append('nonce', repair_form_object.nonce);
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            document.querySelector('#repair_form .repair__form-submit').textContent = 'Отправлено!';
            setTimeout(()=>{
                document.querySelector('#repair_form .repair__form-submit').textContent = 'Отправить заявку'
            }, 3000)
            console.log('Отправлено');
        }
        }
    }

    xhr.open('POST', repair_form_object.url, true);
    xhr.send(formData);

    ev.target.reset();
    })
}
})
